package tn.esprit.services;

import java.io.*;
import java.net.URI;
import java.net.http.*;
import java.nio.charset.StandardCharsets;
import java.nio.file.*;
import java.time.Duration;
import java.util.Properties;
import java.util.regex.*;

public class OpenAiChatService {
    private static final String CONFIG_FILE = "openai.properties";
    private static final String API_URL     = "https://api.openai.com/v1/responses";
    private static final Pattern RESP_ID  = Pattern.compile("\"id\"\\s*:\\s*\"(resp_[^\"]+)\"");
    private static final Pattern OUT_TEXT = Pattern.compile("\"type\"\\s*:\\s*\"output_text\".*?\"text\"\\s*:\\s*\"((?:\\\\.|[^\"])*)\"", Pattern.DOTALL);
    private static final Pattern ERR_MSG  = Pattern.compile("\"message\"\\s*:\\s*\"((?:\\\\.|[^\"])*)\"");

    private final HttpClient http = HttpClient.newBuilder().connectTimeout(Duration.ofSeconds(20)).build();
    private final LocalChatbotService local = new LocalChatbotService();

    public ChatResponse sendMessage(String userMessage, String previousResponseId, String patientName) {
        String msg = userMessage == null ? "" : userMessage.trim();
        if (msg.isEmpty()) return ChatResponse.error("Write a message before sending.");
        OpenAiConfig cfg = config();
        if (!cfg.isConfigured()) return ChatResponse.fallback(local.getResponse(msg), "OpenAI not configured. Using built-in assistant.");
        String body = buildBody(cfg.model(), buildInstructions(patientName), msg, previousResponseId);
        HttpRequest req = HttpRequest.newBuilder().uri(URI.create(API_URL)).timeout(Duration.ofSeconds(60))
                .header("Authorization", "Bearer " + cfg.apiKey()).header("Content-Type", "application/json")
                .POST(HttpRequest.BodyPublishers.ofString(body, StandardCharsets.UTF_8)).build();
        try {
            HttpResponse<String> res = http.send(req, HttpResponse.BodyHandlers.ofString(StandardCharsets.UTF_8));
            if (res.statusCode() >= 400) return ChatResponse.fallback(local.getResponse(msg), "OpenAI unavailable (" + res.statusCode() + "). Using built-in assistant.");
            String responseId = extract(res.body(), RESP_ID);
            String text = extract(res.body(), OUT_TEXT);
            if (text == null || text.isBlank()) return ChatResponse.fallback(local.getResponse(msg), "OpenAI returned no text. Using built-in assistant.");
            return ChatResponse.success(responseId, unescape(text).trim());
        } catch (InterruptedException e) { Thread.currentThread().interrupt(); return ChatResponse.fallback(local.getResponse(msg), "Request interrupted."); }
        catch (IOException e) { return ChatResponse.fallback(local.getResponse(msg), "OpenAI connection failed. Using built-in assistant."); }
    }

    public boolean isConfigured() { return config().isConfigured(); }

    private String buildInstructions(String name) {
        String n = (name == null || name.isBlank()) ? "the patient" : name.trim();
        return "You are PinkShield Assistant inside a JavaFX healthcare application. Help with app navigation, appointments, daily tracking, profile details, and blog resources. Give concise, practical answers. Do not diagnose or prescribe. The signed-in patient is " + n + ".";
    }

    private String buildBody(String model, String instructions, String msg, String prevId) {
        StringBuilder sb = new StringBuilder("{");
        sb.append("\"model\":\"").append(esc(model)).append("\",");
        sb.append("\"instructions\":\"").append(esc(instructions)).append("\",");
        sb.append("\"max_output_tokens\":320,");
        if (prevId != null && !prevId.isBlank()) sb.append("\"previous_response_id\":\"").append(esc(prevId)).append("\",");
        sb.append("\"input\":[{\"role\":\"user\",\"content\":[{\"type\":\"input_text\",\"text\":\"").append(esc(msg)).append("\"}]}]}");
        return sb.toString();
    }

    private OpenAiConfig config() {
        Properties p = new Properties();
        try (InputStream is = OpenAiChatService.class.getClassLoader().getResourceAsStream(CONFIG_FILE)) { if (is != null) p.load(is); } catch (IOException ignored) {}
        Path ext = Path.of(System.getProperty("user.dir"), CONFIG_FILE);
        if (Files.isRegularFile(ext)) { try (InputStream is = Files.newInputStream(ext)) { p.load(is); } catch (IOException ignored) {} }
        return new OpenAiConfig(read("OPENAI_API_KEY","",p), read("OPENAI_MODEL","gpt-4.1-mini",p));
    }

    private String read(String key, String def, Properties p) {
        String v = System.getProperty(key); if (v != null && !v.isBlank()) return v.trim();
              v = System.getenv(key);       if (v != null && !v.isBlank()) return v.trim();
              v = p.getProperty(key);       if (v != null && !v.isBlank()) return v.trim();
        return def;
    }
    private String extract(String body, Pattern pat) { if (body == null) return null; Matcher m = pat.matcher(body); return m.find() ? m.group(1) : null; }
    private String esc(String s) { return (s==null?"":s).replace("\\","\\\\").replace("\"","\\\"").replace("\n","\\n").replace("\r","\\r").replace("\t","\\t"); }
    private String unescape(String s) { return (s==null?"":s).replace("\\n","\n").replace("\\r","\r").replace("\\t","\t").replace("\\\"","\"").replace("\\\\","\\"); }

    public record ChatResponse(String responseId, String assistantText, String errorMessage, String statusMessage, boolean fallbackUsed) {
        public static ChatResponse success(String id, String text)     { return new ChatResponse(id, text, null, null, false); }
        public static ChatResponse error(String msg)                   { return new ChatResponse(null, null, msg, null, false); }
        public static ChatResponse fallback(String text, String status){ return new ChatResponse(null, text, null, status, true); }
        public boolean success() { return errorMessage == null || errorMessage.isBlank(); }
    }
    private record OpenAiConfig(String apiKey, String model) {
        boolean isConfigured() { return apiKey != null && !apiKey.isBlank() && model != null && !model.isBlank(); }
    }
}
