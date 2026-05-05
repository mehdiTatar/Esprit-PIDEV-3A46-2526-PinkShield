package tn.esprit.services;

import java.io.IOException;
import java.io.InputStream;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Path;
import java.time.Duration;
import java.util.Properties;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class OpenAiChatService {
    private static final String CONFIG_FILE = "openai.properties";
    private static final String RESPONSES_URL = "https://api.openai.com/v1/responses";
    private static final Pattern RESPONSE_ID_PATTERN = Pattern.compile("\"id\"\\s*:\\s*\"(resp_[^\"]+)\"");
    private static final Pattern OUTPUT_TEXT_PATTERN = Pattern.compile("\"type\"\\s*:\\s*\"output_text\".*?\"text\"\\s*:\\s*\"((?:\\\\.|[^\"])*)\"", Pattern.DOTALL);
    private static final Pattern ERROR_MESSAGE_PATTERN = Pattern.compile("\"message\"\\s*:\\s*\"((?:\\\\.|[^\"])*)\"");

    private final HttpClient httpClient = HttpClient.newBuilder()
            .connectTimeout(Duration.ofSeconds(20))
            .build();
    private final LocalChatbotService localChatbotService = new LocalChatbotService();

    public ChatResponse sendMessage(String userMessage, String previousResponseId, String patientName) {
        String message = userMessage == null ? "" : userMessage.trim();
        if (message.isEmpty()) {
            return ChatResponse.error("Write a message before sending.");
        }

        OpenAiConfig config = loadConfig();
        if (!config.isConfigured()) {
            return ChatResponse.fallback(
                    localChatbotService.getResponse(message),
                    "OpenAI is not configured. Using the built-in PinkShield assistant."
            );
        }

        String instructions = buildInstructions(patientName);
        String requestBody = buildRequestBody(config.model(), instructions, message, previousResponseId);

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(RESPONSES_URL))
                .timeout(Duration.ofSeconds(60))
                .header("Authorization", "Bearer " + config.apiKey())
                .header("Content-Type", "application/json")
                .POST(HttpRequest.BodyPublishers.ofString(requestBody, StandardCharsets.UTF_8))
                .build();

        try {
            HttpResponse<String> response = httpClient.send(request, HttpResponse.BodyHandlers.ofString(StandardCharsets.UTF_8));
            if (response.statusCode() >= 400) {
                return ChatResponse.fallback(
                        localChatbotService.getResponse(message),
                        "OpenAI is unavailable right now (" + extractErrorMessage(response.body(), response.statusCode()) + "). Using the built-in PinkShield assistant."
                );
            }

            String responseId = extractValue(response.body(), RESPONSE_ID_PATTERN);
            String replyText = extractValue(response.body(), OUTPUT_TEXT_PATTERN);
            if (replyText == null || replyText.isBlank()) {
                return ChatResponse.fallback(
                        localChatbotService.getResponse(message),
                        "OpenAI returned no assistant text. Using the built-in PinkShield assistant."
                );
            }

            return ChatResponse.success(responseId, unescapeJson(replyText).trim());
        } catch (IOException e) {
            return ChatResponse.fallback(
                    localChatbotService.getResponse(message),
                    "OpenAI connection failed. Using the built-in PinkShield assistant."
            );
        } catch (InterruptedException e) {
            Thread.currentThread().interrupt();
            return ChatResponse.fallback(
                    localChatbotService.getResponse(message),
                    "OpenAI request was interrupted. Using the built-in PinkShield assistant."
            );
        }
    }

    public boolean isConfigured() {
        return loadConfig().isConfigured();
    }

    private OpenAiConfig loadConfig() {
        Properties fileProperties = loadProperties();
        String apiKey = readSetting("OPENAI_API_KEY", "", fileProperties);
        String model = readSetting("OPENAI_MODEL", "gpt-4.1-mini", fileProperties);
        return new OpenAiConfig(apiKey, model);
    }

    private Properties loadProperties() {
        Properties properties = new Properties();

        try (InputStream resourceStream = OpenAiChatService.class.getClassLoader().getResourceAsStream(CONFIG_FILE)) {
            if (resourceStream != null) {
                properties.load(resourceStream);
            }
        } catch (IOException e) {
            System.err.println("Failed to read classpath " + CONFIG_FILE + ": " + e.getMessage());
        }

        Path externalPath = Path.of(System.getProperty("user.dir"), CONFIG_FILE);
        if (!Files.isRegularFile(externalPath)) {
            return properties;
        }

        try (InputStream fileStream = Files.newInputStream(externalPath)) {
            properties.load(fileStream);
        } catch (IOException e) {
            System.err.println("Failed to read " + externalPath + ": " + e.getMessage());
        }

        return properties;
    }

    private String readSetting(String key, String defaultValue, Properties fileProperties) {
        String systemValue = System.getProperty(key);
        if (systemValue != null && !systemValue.isBlank()) {
            return systemValue.trim();
        }

        String envValue = System.getenv(key);
        if (envValue != null && !envValue.isBlank()) {
            return envValue.trim();
        }

        String fileValue = fileProperties.getProperty(key);
        if (fileValue != null && !fileValue.isBlank()) {
            return fileValue.trim();
        }

        return defaultValue;
    }

    private String buildInstructions(String patientName) {
        String resolvedName = patientName == null || patientName.isBlank() ? "the patient" : patientName.trim();
        return """
                You are PinkShield Assistant inside a JavaFX healthcare application.
                Help with app navigation, appointments, daily tracking, profile details, blog resources, and parapharmacy features.
                Give concise, practical answers.
                Do not claim to be a doctor and do not provide diagnosis, emergency triage, or medication prescriptions.
                For medical-risk questions, advise the patient to contact a qualified healthcare professional.
                The current signed-in patient is %s.
                """.formatted(resolvedName);
    }

    private String buildRequestBody(String model, String instructions, String userMessage, String previousResponseId) {
        StringBuilder json = new StringBuilder();
        json.append("{");
        json.append("\"model\":\"").append(escapeJson(model)).append("\",");
        json.append("\"instructions\":\"").append(escapeJson(instructions)).append("\",");
        json.append("\"max_output_tokens\":320,");
        if (previousResponseId != null && !previousResponseId.isBlank()) {
            json.append("\"previous_response_id\":\"").append(escapeJson(previousResponseId)).append("\",");
        }
        json.append("\"input\":[{");
        json.append("\"role\":\"user\",");
        json.append("\"content\":[{");
        json.append("\"type\":\"input_text\",");
        json.append("\"text\":\"").append(escapeJson(userMessage)).append("\"");
        json.append("}]");
        json.append("}]");
        json.append("}");
        return json.toString();
    }

    private String extractErrorMessage(String body, int statusCode) {
        String message = extractValue(body, ERROR_MESSAGE_PATTERN);
        return message == null || message.isBlank()
                ? "HTTP " + statusCode
                : unescapeJson(message);
    }

    private String extractValue(String body, Pattern pattern) {
        if (body == null || body.isBlank()) {
            return null;
        }

        Matcher matcher = pattern.matcher(body);
        if (!matcher.find()) {
            return null;
        }

        return matcher.group(1);
    }

    private String escapeJson(String value) {
        String source = value == null ? "" : value;
        return source
                .replace("\\", "\\\\")
                .replace("\"", "\\\"")
                .replace("\r", "\\r")
                .replace("\n", "\\n")
                .replace("\t", "\\t");
    }

    private String unescapeJson(String value) {
        String source = value == null ? "" : value;
        return source
                .replace("\\n", "\n")
                .replace("\\r", "\r")
                .replace("\\t", "\t")
                .replace("\\\"", "\"")
                .replace("\\\\", "\\");
    }

    public record ChatResponse(String responseId, String assistantText, String errorMessage, String statusMessage, boolean fallbackUsed) {
        public static ChatResponse success(String responseId, String assistantText) {
            return new ChatResponse(responseId, assistantText, null, null, false);
        }

        public static ChatResponse error(String errorMessage) {
            return new ChatResponse(null, null, errorMessage, null, false);
        }

        public static ChatResponse fallback(String assistantText, String statusMessage) {
            return new ChatResponse(null, assistantText, null, statusMessage, true);
        }

        public boolean success() {
            return errorMessage == null || errorMessage.isBlank();
        }
    }

    private record OpenAiConfig(String apiKey, String model) {
        private boolean isConfigured() {
            return apiKey != null && !apiKey.isBlank()
                    && model != null && !model.isBlank();
        }
    }
}
