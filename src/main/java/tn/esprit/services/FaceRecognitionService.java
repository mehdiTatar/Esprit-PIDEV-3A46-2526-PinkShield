package tn.esprit.services;

import java.io.BufferedInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.StandardCopyOption;
import java.util.List;
import java.util.Map;
import java.util.Properties;
import java.util.UUID;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class FaceRecognitionService {
    private static final String DETECT_URL = "https://api-us.faceplusplus.com/facepp/v3/detect";
    private static final String COMPARE_URL = "https://api-us.faceplusplus.com/facepp/v3/compare";
    private static final String CONFIG_FILE = "facepp.properties";
    private static final List<String> SUPPORTED_EXTENSIONS = List.of(".jpg", ".jpeg", ".png");
    private static final Pattern FACE_TOKEN_PATTERN = Pattern.compile("\"face_token\"\\s*:\\s*\"([^\"]+)\"");
    private static final Pattern CONFIDENCE_PATTERN = Pattern.compile("\"confidence\"\\s*:\\s*([0-9]+(?:\\.[0-9]+)?)");
    private static final Pattern ERROR_PATTERN = Pattern.compile("\"error_message\"\\s*:\\s*\"([^\"]+)\"");

    public FaceEnrollmentResult processUploadedFace(Path photoPath, String userKey) {
        if (photoPath == null || !Files.isRegularFile(photoPath)) {
            return new FaceEnrollmentResult(null, null, "Select a valid face image.");
        }

        String extension = fileExtension(photoPath.getFileName().toString());
        if (!SUPPORTED_EXTENSIONS.contains(extension.toLowerCase())) {
            return new FaceEnrollmentResult(null, null, "Use a JPG or PNG image for face enrollment.");
        }

        try {
            Path storageDirectory = ensureStorageDirectory();
            String sanitizedKey = sanitizeKey(userKey);
            String filename = "face_" + sanitizedKey + "_" + System.currentTimeMillis() + extension;
            Path storedImage = storageDirectory.resolve(filename);
            Files.copy(photoPath, storedImage, StandardCopyOption.REPLACE_EXISTING);

            String relativePath = Path.of("images", "faces", filename).toString().replace('\\', '/');
            FaceApiConfig config = loadConfig();
            if (!config.isConfigured()) {
                return new FaceEnrollmentResult(
                        null,
                        relativePath,
                        "Face API keys are missing. The account was created, but face login is not configured yet."
                );
            }

            FaceApiResponse detectResponse = callFaceApi(
                    DETECT_URL,
                    Map.of(
                            "api_key", config.apiKey(),
                            "api_secret", config.apiSecret()
                    ),
                    Map.of("image_file", storedImage)
            );

            if (!detectResponse.success()) {
                return new FaceEnrollmentResult(
                        null,
                        relativePath,
                        "Face image saved, but Face++ detection failed: " + detectResponse.message()
                );
            }

            String faceToken = extractString(detectResponse.body(), FACE_TOKEN_PATTERN);
            if (faceToken == null || faceToken.isBlank()) {
                return new FaceEnrollmentResult(
                        null,
                        relativePath,
                        "Face image saved, but no detectable face token was returned by Face++."
                );
            }

            return new FaceEnrollmentResult(faceToken, relativePath, null);
        } catch (IOException e) {
            return new FaceEnrollmentResult(null, null, "Failed to store the selected face image: " + e.getMessage());
        }
    }

    public FaceComparisonResult compareFaces(String storedImagePath, Path livePhotoPath) {
        if (storedImagePath == null || storedImagePath.isBlank()) {
            return new FaceComparisonResult(0.0, "No enrolled face image was found for this account.");
        }
        if (livePhotoPath == null || !Files.isRegularFile(livePhotoPath)) {
            return new FaceComparisonResult(0.0, "Select a valid live face image.");
        }

        FaceApiConfig config = loadConfig();
        if (!config.isConfigured()) {
            return new FaceComparisonResult(0.0, "Face API keys are missing. Update facepp.properties first.");
        }

        Path storedAbsolutePath = resolveStoredImagePath(storedImagePath);
        if (!Files.isRegularFile(storedAbsolutePath)) {
            return new FaceComparisonResult(0.0, "The enrolled face image file is missing from local storage.");
        }

        try {
            FaceApiResponse compareResponse = callFaceApi(
                    COMPARE_URL,
                    Map.of(
                            "api_key", config.apiKey(),
                            "api_secret", config.apiSecret()
                    ),
                    Map.of(
                            "image_file1", storedAbsolutePath,
                            "image_file2", livePhotoPath
                    )
            );

            if (!compareResponse.success()) {
                return new FaceComparisonResult(0.0, "Face comparison failed: " + compareResponse.message());
            }

            Double confidence = extractNumber(compareResponse.body(), CONFIDENCE_PATTERN);
            if (confidence == null) {
                return new FaceComparisonResult(0.0, "Face++ did not return a confidence score.");
            }

            return new FaceComparisonResult(confidence, null);
        } catch (IOException e) {
            return new FaceComparisonResult(0.0, "Face comparison failed: " + e.getMessage());
        }
    }

    public boolean isConfigured() {
        return loadConfig().isConfigured();
    }

    public double getMatchThreshold() {
        return loadConfig().matchThreshold();
    }

    private Path ensureStorageDirectory() throws IOException {
        Path directory = Path.of(System.getProperty("user.dir"), "images", "faces");
        Files.createDirectories(directory);
        return directory;
    }

    private Path resolveStoredImagePath(String storedImagePath) {
        Path path = Path.of(storedImagePath);
        if (path.isAbsolute()) {
            return path;
        }
        return Path.of(System.getProperty("user.dir")).resolve(path).normalize();
    }

    private FaceApiConfig loadConfig() {
        Properties fileProperties = loadProperties();
        String apiKey = readSetting("FACE_API_KEY", "", fileProperties);
        String apiSecret = readSetting("FACE_API_SECRET", "", fileProperties);
        double threshold = readDoubleSetting("FACE_MATCH_THRESHOLD", 70.0, fileProperties);
        return new FaceApiConfig(apiKey, apiSecret, threshold);
    }

    private Properties loadProperties() {
        Properties properties = new Properties();

        try (InputStream resourceStream = FaceRecognitionService.class.getClassLoader().getResourceAsStream(CONFIG_FILE)) {
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

    private double readDoubleSetting(String key, double defaultValue, Properties fileProperties) {
        String rawValue = readSetting(key, Double.toString(defaultValue), fileProperties);
        try {
            return Double.parseDouble(rawValue);
        } catch (NumberFormatException e) {
            return defaultValue;
        }
    }

    private FaceApiResponse callFaceApi(String url, Map<String, String> textFields, Map<String, Path> fileFields) throws IOException {
        String boundary = "----PinkShieldFaceBoundary" + UUID.randomUUID();
        HttpURLConnection connection = (HttpURLConnection) new URL(url).openConnection();
        connection.setConnectTimeout(30000);
        connection.setReadTimeout(30000);
        connection.setRequestMethod("POST");
        connection.setDoOutput(true);
        connection.setRequestProperty("Content-Type", "multipart/form-data; boundary=" + boundary);

        try (OutputStream output = connection.getOutputStream()) {
            for (Map.Entry<String, String> field : textFields.entrySet()) {
                writeTextPart(output, boundary, field.getKey(), field.getValue());
            }
            for (Map.Entry<String, Path> fileField : fileFields.entrySet()) {
                writeFilePart(output, boundary, fileField.getKey(), fileField.getValue());
            }
            output.write(("--" + boundary + "--\r\n").getBytes(StandardCharsets.UTF_8));
            output.flush();
        }

        int statusCode = connection.getResponseCode();
        try (InputStream responseStream = statusCode >= 400 ? connection.getErrorStream() : connection.getInputStream()) {
            String responseBody = responseStream == null
                    ? ""
                    : new String(responseStream.readAllBytes(), StandardCharsets.UTF_8);
            String errorMessage = extractString(responseBody, ERROR_PATTERN);
            if (statusCode >= 400) {
                return new FaceApiResponse(false, responseBody, errorMessage == null ? "HTTP " + statusCode : errorMessage);
            }
            return new FaceApiResponse(true, responseBody, errorMessage);
        } finally {
            connection.disconnect();
        }
    }

    private void writeTextPart(OutputStream output, String boundary, String name, String value) throws IOException {
        String part = "--" + boundary + "\r\n"
                + "Content-Disposition: form-data; name=\"" + name + "\"\r\n\r\n"
                + value + "\r\n";
        output.write(part.getBytes(StandardCharsets.UTF_8));
    }

    private void writeFilePart(OutputStream output, String boundary, String fieldName, Path filePath) throws IOException {
        String mimeType = detectMimeType(filePath);
        String header = "--" + boundary + "\r\n"
                + "Content-Disposition: form-data; name=\"" + fieldName + "\"; filename=\"" + filePath.getFileName() + "\"\r\n"
                + "Content-Type: " + mimeType + "\r\n\r\n";
        output.write(header.getBytes(StandardCharsets.UTF_8));

        try (InputStream input = new BufferedInputStream(Files.newInputStream(filePath))) {
            input.transferTo(output);
        }

        output.write("\r\n".getBytes(StandardCharsets.UTF_8));
    }

    private String detectMimeType(Path filePath) throws IOException {
        String mimeType = Files.probeContentType(filePath);
        return mimeType == null || mimeType.isBlank() ? "application/octet-stream" : mimeType;
    }

    private String sanitizeKey(String rawKey) {
        String source = rawKey == null || rawKey.isBlank() ? "user" : rawKey;
        return source.replaceAll("[^A-Za-z0-9_-]", "_");
    }

    private String fileExtension(String filename) {
        int lastDot = filename.lastIndexOf('.');
        if (lastDot < 0 || lastDot == filename.length() - 1) {
            return ".jpg";
        }
        return filename.substring(lastDot).toLowerCase();
    }

    private String extractString(String responseBody, Pattern pattern) {
        if (responseBody == null || responseBody.isBlank()) {
            return null;
        }

        Matcher matcher = pattern.matcher(responseBody);
        if (!matcher.find()) {
            return null;
        }
        return matcher.group(1);
    }

    private Double extractNumber(String responseBody, Pattern pattern) {
        String rawValue = extractString(responseBody, pattern);
        if (rawValue == null) {
            return null;
        }

        try {
            return Double.parseDouble(rawValue);
        } catch (NumberFormatException e) {
            return null;
        }
    }

    public record FaceEnrollmentResult(String faceToken, String imagePath, String message) {
    }

    public record FaceComparisonResult(double confidence, String message) {
        public boolean isSuccessful() {
            return message == null || message.isBlank();
        }
    }

    private record FaceApiConfig(String apiKey, String apiSecret, double matchThreshold) {
        private boolean isConfigured() {
            return apiKey != null && !apiKey.isBlank()
                    && apiSecret != null && !apiSecret.isBlank();
        }
    }

    private record FaceApiResponse(boolean success, String body, String message) {
    }
}
