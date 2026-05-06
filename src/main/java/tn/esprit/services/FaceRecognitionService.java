package tn.esprit.services;

import java.io.*;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;
import java.nio.file.*;
import java.util.*;
import java.util.regex.*;

public class FaceRecognitionService {
    private static final String DETECT_URL  = "https://api-us.faceplusplus.com/facepp/v3/detect";
    private static final String COMPARE_URL = "https://api-us.faceplusplus.com/facepp/v3/compare";
    private static final String CONFIG_FILE = "facepp.properties";
    private static final Pattern FACE_TOKEN_PATTERN  = Pattern.compile("\"face_token\"\\s*:\\s*\"([^\"]+)\"");
    private static final Pattern CONFIDENCE_PATTERN  = Pattern.compile("\"confidence\"\\s*:\\s*([0-9]+(?:\\.[0-9]+)?)");
    private static final Pattern ERROR_PATTERN       = Pattern.compile("\"error_message\"\\s*:\\s*\"([^\"]+)\"");
    private static final List<String> SUPPORTED_EXTS = List.of(".jpg", ".jpeg", ".png");

    public FaceEnrollmentResult processUploadedFace(Path photoPath, String userKey) {
        if (photoPath == null || !Files.isRegularFile(photoPath))
            return new FaceEnrollmentResult(null, null, "Select a valid face image.");
        String ext = ext(photoPath.getFileName().toString());
        if (!SUPPORTED_EXTS.contains(ext.toLowerCase()))
            return new FaceEnrollmentResult(null, null, "Use JPG or PNG for face enrollment.");
        try {
            Path dir = ensureDir();
            String filename = "face_" + sanitize(userKey) + "_" + System.currentTimeMillis() + ext;
            Path stored = dir.resolve(filename);
            Files.copy(photoPath, stored, StandardCopyOption.REPLACE_EXISTING);
            String relPath = Path.of("images", "faces", filename).toString().replace('\\', '/');
            FaceApiConfig cfg = config();
            if (!cfg.isConfigured()) return new FaceEnrollmentResult(null, relPath, "Face API not configured — account created without face login.");
            FaceApiResponse detect = call(DETECT_URL, Map.of("api_key", cfg.apiKey(), "api_secret", cfg.apiSecret()), Map.of("image_file", stored));
            if (!detect.success()) return new FaceEnrollmentResult(null, relPath, "Face detected failed: " + detect.message());
            String token = extract(detect.body(), FACE_TOKEN_PATTERN);
            if (token == null || token.isBlank()) return new FaceEnrollmentResult(null, relPath, "No face token returned.");
            return new FaceEnrollmentResult(token, relPath, null);
        } catch (IOException e) { return new FaceEnrollmentResult(null, null, "Failed to store face image: " + e.getMessage()); }
    }

    public FaceComparisonResult compareFaces(String storedPath, Path livePhoto) {
        if (storedPath == null || storedPath.isBlank()) return new FaceComparisonResult(0, "No enrolled face image.");
        if (livePhoto == null || !Files.isRegularFile(livePhoto)) return new FaceComparisonResult(0, "Select a valid live image.");
        FaceApiConfig cfg = config();
        if (!cfg.isConfigured()) return new FaceComparisonResult(0, "Face API not configured.");
        Path abs = resolve(storedPath);
        if (!Files.isRegularFile(abs)) return new FaceComparisonResult(0, "Enrolled face image file missing.");
        try {
            FaceApiResponse r = call(COMPARE_URL,
                    Map.of("api_key", cfg.apiKey(), "api_secret", cfg.apiSecret()),
                    Map.of("image_file1", abs, "image_file2", livePhoto));
            if (!r.success()) return new FaceComparisonResult(0, "Comparison failed: " + r.message());
            String raw = extract(r.body(), CONFIDENCE_PATTERN);
            if (raw == null) return new FaceComparisonResult(0, "No confidence score returned.");
            return new FaceComparisonResult(Double.parseDouble(raw), null);
        } catch (IOException e) { return new FaceComparisonResult(0, "Comparison error: " + e.getMessage()); }
    }

    public boolean isConfigured()      { return config().isConfigured(); }
    public double  getMatchThreshold() { return config().matchThreshold(); }

    private Path ensureDir() throws IOException {
        Path d = Path.of(System.getProperty("user.dir"), "images", "faces");
        Files.createDirectories(d); return d;
    }
    private Path resolve(String p) {
        Path path = Path.of(p);
        return path.isAbsolute() ? path : Path.of(System.getProperty("user.dir")).resolve(path).normalize();
    }
    private FaceApiConfig config() {
        Properties p = new Properties();
        try (InputStream is = FaceRecognitionService.class.getClassLoader().getResourceAsStream(CONFIG_FILE)) { if (is != null) p.load(is); } catch (IOException ignored) {}
        Path ext = Path.of(System.getProperty("user.dir"), CONFIG_FILE);
        if (Files.isRegularFile(ext)) { try (InputStream is = Files.newInputStream(ext)) { p.load(is); } catch (IOException ignored) {} }
        return new FaceApiConfig(read("FACE_API_KEY", "", p), read("FACE_API_SECRET", "", p), readDouble("FACE_MATCH_THRESHOLD", 70.0, p));
    }
    private String read(String key, String def, Properties p) {
        String v = System.getProperty(key); if (v != null && !v.isBlank()) return v.trim();
              v = System.getenv(key);       if (v != null && !v.isBlank()) return v.trim();
              v = p.getProperty(key);       if (v != null && !v.isBlank()) return v.trim();
        return def;
    }
    private double readDouble(String key, double def, Properties p) { try { return Double.parseDouble(read(key, String.valueOf(def), p)); } catch (NumberFormatException e) { return def; } }

    private FaceApiResponse call(String url, Map<String,String> text, Map<String,Path> files) throws IOException {
        String boundary = "----PinkShieldBoundary" + UUID.randomUUID();
        HttpURLConnection conn = (HttpURLConnection) new URL(url).openConnection();
        conn.setConnectTimeout(30000); conn.setReadTimeout(30000);
        conn.setRequestMethod("POST"); conn.setDoOutput(true);
        conn.setRequestProperty("Content-Type", "multipart/form-data; boundary=" + boundary);
        try (OutputStream out = conn.getOutputStream()) {
            for (var e : text.entrySet()) writePart(out, boundary, e.getKey(), e.getValue());
            for (var e : files.entrySet()) writeFile(out, boundary, e.getKey(), e.getValue());
            out.write(("--" + boundary + "--\r\n").getBytes(StandardCharsets.UTF_8));
        }
        int code = conn.getResponseCode();
        try (InputStream rs = code >= 400 ? conn.getErrorStream() : conn.getInputStream()) {
            String body = rs == null ? "" : new String(rs.readAllBytes(), StandardCharsets.UTF_8);
            String err  = extract(body, ERROR_PATTERN);
            return new FaceApiResponse(code < 400, body, err);
        } finally { conn.disconnect(); }
    }
    private void writePart(OutputStream out, String b, String name, String val) throws IOException {
        out.write(("--" + b + "\r\nContent-Disposition: form-data; name=\"" + name + "\"\r\n\r\n" + val + "\r\n").getBytes(StandardCharsets.UTF_8));
    }
    private void writeFile(OutputStream out, String b, String name, Path file) throws IOException {
        String mime = Files.probeContentType(file); if (mime == null) mime = "application/octet-stream";
        out.write(("--" + b + "\r\nContent-Disposition: form-data; name=\"" + name + "\"; filename=\"" + file.getFileName() + "\"\r\nContent-Type: " + mime + "\r\n\r\n").getBytes(StandardCharsets.UTF_8));
        try (InputStream in = new BufferedInputStream(Files.newInputStream(file))) { in.transferTo(out); }
        out.write("\r\n".getBytes(StandardCharsets.UTF_8));
    }
    private String extract(String body, Pattern p) {
        if (body == null || body.isBlank()) return null;
        Matcher m = p.matcher(body); return m.find() ? m.group(1) : null;
    }
    private String ext(String name) { int i = name.lastIndexOf('.'); return i < 0 ? ".jpg" : name.substring(i); }
    private String sanitize(String k) { return (k == null || k.isBlank() ? "user" : k).replaceAll("[^A-Za-z0-9_-]", "_"); }

    public record FaceEnrollmentResult(String faceToken, String imagePath, String message) {}
    public record FaceComparisonResult(double confidence, String message) {
        public boolean isSuccessful() { return message == null || message.isBlank(); }
    }
    private record FaceApiConfig(String apiKey, String apiSecret, double matchThreshold) {
        boolean isConfigured() { return apiKey != null && !apiKey.isBlank() && apiSecret != null && !apiSecret.isBlank(); }
    }
    private record FaceApiResponse(boolean success, String body, String message) {}
}
