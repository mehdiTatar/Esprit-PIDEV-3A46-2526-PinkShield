package tn.esprit.services;

import java.io.IOException;
import java.io.InputStream;
import java.net.URI;
import java.net.URLEncoder;
import java.net.http.*;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Path;
import java.time.Duration;
import java.util.Locale;
import java.util.Properties;
import java.util.regex.*;

public class RecaptchaService {
    private static final String CONFIG_FILE = "recaptcha.properties";
    private static final String VERIFY_URL  = "https://www.google.com/recaptcha/api/siteverify";
    private static final Pattern SUCCESS_PATTERN = Pattern.compile("\"success\"\\s*:\\s*(true|false)", Pattern.CASE_INSENSITIVE);
    private static final Pattern ERROR_CODES     = Pattern.compile("\"error-codes\"\\s*:\\s*\\[(.*?)]", Pattern.CASE_INSENSITIVE | Pattern.DOTALL);

    private final HttpClient http = HttpClient.newBuilder().connectTimeout(Duration.ofSeconds(10)).build();
    private final Config config = loadConfig();

    public boolean isConfigured()        { return !config.siteKey().isBlank() && !config.secretKey().isBlank(); }
    public String  getSiteKey()          { return config.siteKey(); }
    public String  getConfigurationMessage() {
        return isConfigured() ? "" : "reCAPTCHA not configured. Add RECAPTCHA_SITE_KEY and RECAPTCHA_SECRET_KEY in recaptcha.properties.";
    }

    public VerificationResult verifyToken(String token) {
        if (!isConfigured()) return VerificationResult.failure(getConfigurationMessage(), false);
        if (token == null || token.isBlank()) return VerificationResult.failure("Complete the reCAPTCHA check first.", false);
        String body = "secret=" + enc(config.secretKey()) + "&response=" + enc(token);
        HttpRequest req = HttpRequest.newBuilder()
                .uri(URI.create(VERIFY_URL)).timeout(Duration.ofSeconds(12))
                .header("Content-Type", "application/x-www-form-urlencoded")
                .POST(HttpRequest.BodyPublishers.ofString(body, StandardCharsets.UTF_8)).build();
        try {
            HttpResponse<String> res = http.send(req, HttpResponse.BodyHandlers.ofString(StandardCharsets.UTF_8));
            if (res.statusCode() != 200) return VerificationResult.failure("reCAPTCHA HTTP " + res.statusCode(), true);
            return parse(res.body());
        } catch (InterruptedException e) { Thread.currentThread().interrupt(); return VerificationResult.failure("Interrupted.", true); }
        catch (IOException e) { return VerificationResult.failure("Unable to contact Google reCAPTCHA.", false); }
    }

    private VerificationResult parse(String body) {
        Matcher m = SUCCESS_PATTERN.matcher(body);
        if (!m.find()) return VerificationResult.failure("Invalid reCAPTCHA response.", true);
        if (Boolean.parseBoolean(m.group(1).toLowerCase(Locale.ROOT))) return VerificationResult.success("Security challenge verified.");
        Matcher em = ERROR_CODES.matcher(body);
        String codes = em.find() ? em.group(1).replace("\"","").trim().toLowerCase(Locale.ROOT) : "";
        if (codes.contains("timeout-or-duplicate")) return VerificationResult.failure("Challenge expired. Complete again.", true);
        if (codes.contains("missing-input-response")) return VerificationResult.failure("Complete the reCAPTCHA check first.", false);
        return VerificationResult.failure("reCAPTCHA verification failed. Try again.", true);
    }

    private Config loadConfig() {
        Properties p = new Properties();
        try (InputStream is = RecaptchaService.class.getClassLoader().getResourceAsStream(CONFIG_FILE)) {
            if (is != null) p.load(is);
        } catch (IOException ignored) {}
        Path ext = Path.of(System.getProperty("user.dir"), CONFIG_FILE);
        if (Files.exists(ext)) { try (InputStream is = Files.newInputStream(ext)) { p.load(is); } catch (IOException ignored) {} }
        return new Config(readSetting("RECAPTCHA_SITE_KEY", "", p), readSetting("RECAPTCHA_SECRET_KEY", "", p));
    }

    private String readSetting(String key, String def, Properties p) {
        String v = System.getProperty(key); if (v != null && !v.isBlank()) return v.trim();
              v = System.getenv(key);       if (v != null && !v.isBlank()) return v.trim();
              v = p.getProperty(key);       if (v != null && !v.isBlank()) return v.trim();
        return def;
    }

    private String enc(String v) { return URLEncoder.encode(v, StandardCharsets.UTF_8); }

    private record Config(String siteKey, String secretKey) {}

    public record VerificationResult(boolean success, String message, boolean resetRequired) {
        public static VerificationResult success(String msg) { return new VerificationResult(true, msg, true); }
        public static VerificationResult failure(String msg, boolean reset) { return new VerificationResult(false, msg, reset); }
    }
}
