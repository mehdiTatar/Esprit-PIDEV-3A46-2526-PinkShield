package tn.esprit.services;

import java.io.IOException;
import java.io.InputStream;
import java.io.UncheckedIOException;
import java.net.URI;
import java.net.URLEncoder;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Path;
import java.time.Duration;
import java.util.Locale;
import java.util.Properties;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class RecaptchaService {
    private static final String CONFIG_FILE = "recaptcha.properties";
    private static final String VERIFY_URL = "https://www.google.com/recaptcha/api/siteverify";
    private static final Pattern SUCCESS_PATTERN = Pattern.compile("\"success\"\\s*:\\s*(true|false)", Pattern.CASE_INSENSITIVE);
    private static final Pattern ERROR_CODES_PATTERN = Pattern.compile("\"error-codes\"\\s*:\\s*\\[(.*?)\\]", Pattern.CASE_INSENSITIVE | Pattern.DOTALL);

    private final HttpClient httpClient = HttpClient.newBuilder()
            .connectTimeout(Duration.ofSeconds(10))
            .build();

    private final Config config = loadConfig();

    public boolean isConfigured() {
        return !config.siteKey().isBlank() && !config.secretKey().isBlank();
    }

    public String getSiteKey() {
        return config.siteKey();
    }

    public String getConfigurationMessage() {
        return isConfigured()
                ? ""
                : "reCAPTCHA is not configured. Add RECAPTCHA_SITE_KEY and RECAPTCHA_SECRET_KEY in recaptcha.properties.";
    }

    public VerificationResult verifyToken(String token) {
        if (!isConfigured()) {
            return VerificationResult.failure(getConfigurationMessage(), false);
        }

        if (token == null || token.isBlank()) {
            return VerificationResult.failure("Complete the reCAPTCHA security check first.", false);
        }

        String requestBody = "secret=" + urlEncode(config.secretKey()) + "&response=" + urlEncode(token);
        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(VERIFY_URL))
                .timeout(Duration.ofSeconds(12))
                .header("Content-Type", "application/x-www-form-urlencoded")
                .POST(HttpRequest.BodyPublishers.ofString(requestBody, StandardCharsets.UTF_8))
                .build();

        try {
            HttpResponse<String> response = httpClient.send(request, HttpResponse.BodyHandlers.ofString(StandardCharsets.UTF_8));
            if (response.statusCode() != 200) {
                return VerificationResult.failure(
                        "Google reCAPTCHA verification failed with HTTP " + response.statusCode() + ".",
                        true
                );
            }

            return parseVerificationResponse(response.body());
        } catch (InterruptedException e) {
            Thread.currentThread().interrupt();
            return VerificationResult.failure("reCAPTCHA verification was interrupted.", true);
        } catch (IOException e) {
            return VerificationResult.failure("Unable to contact Google reCAPTCHA. Check the internet connection.", false);
        }
    }

    private VerificationResult parseVerificationResponse(String responseBody) {
        Matcher successMatcher = SUCCESS_PATTERN.matcher(responseBody);
        if (!successMatcher.find()) {
            return VerificationResult.failure("Invalid reCAPTCHA verification response.", true);
        }

        boolean success = Boolean.parseBoolean(successMatcher.group(1).toLowerCase(Locale.ROOT));
        if (success) {
            return VerificationResult.success("Security challenge verified.");
        }

        String errorCodes = extractErrorCodes(responseBody);
        return VerificationResult.failure(mapErrorCodesToMessage(errorCodes), true);
    }

    private String extractErrorCodes(String responseBody) {
        Matcher matcher = ERROR_CODES_PATTERN.matcher(responseBody);
        if (!matcher.find()) {
            return "";
        }

        return matcher.group(1)
                .replace("\"", "")
                .replace("'", "")
                .trim()
                .toLowerCase(Locale.ROOT);
    }

    private String mapErrorCodesToMessage(String errorCodes) {
        if (errorCodes.contains("timeout-or-duplicate")) {
            return "The reCAPTCHA challenge expired or was already used. Complete it again.";
        }
        if (errorCodes.contains("missing-input-response")) {
            return "Complete the reCAPTCHA security check first.";
        }
        if (errorCodes.contains("invalid-input-response")) {
            return "The reCAPTCHA response is invalid. Reload the challenge and try again.";
        }
        if (errorCodes.contains("missing-input-secret") || errorCodes.contains("invalid-input-secret")) {
            return "The reCAPTCHA secret key is invalid. Check recaptcha.properties.";
        }
        if (errorCodes.contains("bad-request")) {
            return "The reCAPTCHA request was malformed.";
        }
        return "reCAPTCHA verification failed. Complete the challenge again.";
    }

    private Config loadConfig() {
        Properties properties = new Properties();

        try (InputStream resourceStream = RecaptchaService.class.getClassLoader().getResourceAsStream(CONFIG_FILE)) {
            if (resourceStream != null) {
                properties.load(resourceStream);
            }
        } catch (IOException e) {
            System.err.println("Failed to read classpath " + CONFIG_FILE + ": " + e.getMessage());
        }

        Path externalPath = Path.of(System.getProperty("user.dir"), CONFIG_FILE);
        if (Files.exists(externalPath)) {
            try (InputStream fileStream = Files.newInputStream(externalPath)) {
                properties.load(fileStream);
            } catch (IOException e) {
                throw new UncheckedIOException("Failed to read " + externalPath + ".", e);
            }
        }

        String siteKey = readSetting("RECAPTCHA_SITE_KEY", "", properties);
        String secretKey = readSetting("RECAPTCHA_SECRET_KEY", "", properties);
        return new Config(siteKey, secretKey);
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

    private String urlEncode(String value) {
        return URLEncoder.encode(value, StandardCharsets.UTF_8);
    }

    private record Config(String siteKey, String secretKey) {
    }

    public record VerificationResult(boolean success, String message, boolean resetRequired) {
        public static VerificationResult success(String message) {
            return new VerificationResult(true, message, true);
        }

        public static VerificationResult failure(String message, boolean resetRequired) {
            return new VerificationResult(false, message, resetRequired);
        }
    }
}
