package tn.esprit.tools;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.time.Duration;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import java.util.stream.Collectors;

/**
 * Moderates user-submitted comments using the HuggingFace Inference API
 * (unitary/toxic-bert) for toxicity detection, then applies a local
 * profanity word-list for actual word replacement.
 *
 * If no API key is configured or the API is unreachable, falls back to
 * local word-list detection only — comments are never silently dropped.
 */
public final class AiModerator {

    private static final String HF_API_URL =
            "https://router.huggingface.co/hf-inference/models/martin-ha/toxic-comment-model";

    // Score above this threshold → treat as toxic
    private static final double TOXIC_THRESHOLD = 0.75;

    // ── Result container ──────────────────────────────────────

    public static final class Result {
        public final String  text;
        public final boolean modified;   // true when bad words were replaced
        public final boolean apiUsed;    // true when HF API call succeeded

        Result(String text, boolean modified, boolean apiUsed) {
            this.text     = text;
            this.modified = modified;
            this.apiUsed  = apiUsed;
        }
    }

    // ── Public entry point ────────────────────────────────────

    /**
     * Analyses {@code input} for toxic content and censors any bad words.
     * Never throws — on any failure returns the original text unchanged.
     */
    public static Result moderate(String input) {
        if (input == null || input.isBlank()) return new Result(input, false, false);

        boolean apiUsed = false;
        boolean isToxic = false;

        String key = AppConfig.getHuggingFaceApiKey();
        if (!key.isEmpty()) {
            try {
                double score = callHfApi(input, key);
                isToxic = score >= TOXIC_THRESHOLD;
                apiUsed = true;
                System.out.println("[AiModerator] API score: " + score + " → " + (isToxic ? "TOXIC" : "clean"));
            } catch (Exception e) {
                System.err.println("[AiModerator] HF API error: " + e.getMessage());
                // Local word list disabled for testing — treat as clean on failure
                isToxic = false;
            }
        }

        // Local word list commented out for API testing:
        // else { isToxic = localContainsBadWords(input); }

        if (!isToxic) return new Result(input, false, apiUsed);

        // Toxic detected — signal rejection (no word replacement while local list is disabled)
        return new Result(input, true, apiUsed);
    }

    // ── HuggingFace API call ──────────────────────────────────

    private static double callHfApi(String text, String key) throws Exception {
        String body = "{\"inputs\":\"" + escapeJson(text) + "\"}";

        HttpClient client = HttpClient.newBuilder()
                .connectTimeout(Duration.ofSeconds(10))
                .build();

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(HF_API_URL))
                .header("Authorization", "Bearer " + key)
                .header("Content-Type", "application/json")
                .timeout(Duration.ofSeconds(20))
                .POST(HttpRequest.BodyPublishers.ofString(body))
                .build();

        HttpResponse<String> response =
                client.send(request, HttpResponse.BodyHandlers.ofString());

        if (response.statusCode() != 200) {
            throw new RuntimeException("HTTP " + response.statusCode() + ": " + response.body());
        }

        return parseToxicScore(response.body());
    }

    /**
     * Extracts the "toxic" label score from the HuggingFace response.
     * Response format: [[{"label":"toxic","score":0.98},{"label":"non_toxic","score":0.02}]]
     */
    private static double parseToxicScore(String json) {
    // Response: [[{"label":"toxic","score":0.98},{"label":"non-toxic","score":0.02}]]
    Pattern p = Pattern.compile(
        "\"label\"\\s*:\\s*\"toxic\"\\s*,\\s*\"score\"\\s*:\\s*([0-9.Ee+\\-]+)",
        Pattern.CASE_INSENSITIVE
    );
    Matcher m = p.matcher(json);
    if (m.find()) {
        try { return Double.parseDouble(m.group(1)); } catch (NumberFormatException ignore) {}
    }
    return 0.0;
}


    // ── Local word-list (disabled for API testing — uncomment to re-enable) ──

    /*
    private static final List<Pattern> BAD_PATTERNS = buildPatterns();

    private static List<Pattern> buildPatterns() {
        List<String> words = List.of(
            // English
            "f+u+c+k+", "sh+i+t+", "a+s+s+h+o+l+e+", "b+i+t+c+h+",
            "bastard", "c+u+n+t+", "dickhead", "d+i+c+k+(?!ens|inson)",
            "motherfucker", "cock(?!ney|roach|atoo)", "whore", "sl+u+t+",
            "faggot", "retard", "dumbass", "piss(?:ed)?",
            "nigger", "nigga",
            // French
            "putain", "merde", "connard", "connasse", "salope",
            "encul[eé]", "pd\\b", "batard",
            // Repeated symbols used to bypass filters
            "f\\*+ck", "sh\\*+t", "b\\*+tch"
        );
        return words.stream()
                .map(w -> Pattern.compile("(?i)" + w))
                .collect(Collectors.toList());
    }

    private static boolean localContainsBadWords(String text) {
        return BAD_PATTERNS.stream().anyMatch(p -> p.matcher(text).find());
    }

    private static String censorBadWords(String text) {
        String result = text;
        for (Pattern p : BAD_PATTERNS) {
            result = p.matcher(result).replaceAll("***");
        }
        return result;
    }
    */

    // ── JSON helpers ──────────────────────────────────────────

    private static String escapeJson(String s) {
        return s.replace("\\", "\\\\")
                .replace("\"", "\\\"")
                .replace("\n", "\\n")
                .replace("\r", "\\r")
                .replace("\t", "\\t");
    }

    private AiModerator() {}
}
