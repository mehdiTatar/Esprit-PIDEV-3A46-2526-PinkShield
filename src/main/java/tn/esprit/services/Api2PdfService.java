package tn.esprit.services;

import java.io.*;
import java.net.HttpURLConnection;
import java.net.URI;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.nio.file.Path;
import java.util.Base64;
import java.util.Properties;

/**
 * API2PDF Service for generating beautiful PDFs with professional styling
 * Uses the API2PDF service for high-quality PDF rendering
 */
public class Api2PdfService {

    private static final String CHROME_ENDPOINT = "https://v2.api2pdf.com/chrome/pdf/html";

    /**
     * Convert HTML to PDF using API2PDF service
     */
    public byte[] convertHtmlToPdf(String htmlContent) throws IOException {
        String jsonPayload = buildPayload(htmlContent);
        String apiKey = readApiKey();
        
        HttpURLConnection connection = (HttpURLConnection) URI.create(CHROME_ENDPOINT).toURL().openConnection();
        connection.setRequestMethod("POST");
        connection.setRequestProperty("Content-Type", "application/json");
        connection.setRequestProperty("Authorization", apiKey);
        connection.setDoOutput(true);
        connection.setConnectTimeout(30000);
        connection.setReadTimeout(30000);

        try (OutputStream os = connection.getOutputStream()) {
            byte[] input = jsonPayload.getBytes(StandardCharsets.UTF_8);
            os.write(input, 0, input.length);
        }

        int statusCode = connection.getResponseCode();
        if (statusCode < 200 || statusCode >= 300) {
            try (InputStream errorStream = connection.getErrorStream()) {
                String errorResponse = errorStream == null ? "" : new String(errorStream.readAllBytes(), StandardCharsets.UTF_8);
                throw new IOException("API2PDF Error (" + statusCode + "): " + errorResponse);
            }
        }

        try (InputStream is = connection.getInputStream()) {
            byte[] responseBytes = is.readAllBytes();
            return extractPdfFromResponse(responseBytes);
        }
    }

    /**
     * Build JSON payload for API2PDF request
     */
    private String buildPayload(String htmlContent) {
        // Escape the HTML for JSON
        String escapedHtml = htmlContent
                .replace("\\", "\\\\")
                .replace("\"", "\\\"")
                .replace("\n", "\\n")
                .replace("\r", "\\r")
                .replace("\t", "\\t");

        return "{"
                + "\"html\":\"" + escapedHtml + "\","
                + "\"options\":{"
                + "\"displayHeaderFooter\":false,"
                + "\"margin\":{\"top\":\"0.5in\",\"bottom\":\"0.5in\",\"left\":\"0.5in\",\"right\":\"0.5in\"},"
                + "\"format\":\"A4\","
                + "\"scale\":1"
                + "}"
                + "}";
    }

    /**
     * Extract PDF bytes from API2PDF response
     * The response is JSON with base64-encoded PDF in 'pdf' field
     */
    private byte[] extractPdfFromResponse(byte[] responseBytes) throws IOException {
        String jsonResponse = new String(responseBytes, StandardCharsets.UTF_8);
        
        String fileUrl = firstJsonValue(jsonResponse, "FileUrl", "fileUrl", "url");
        if (fileUrl != null && !fileUrl.isBlank()) {
            return downloadPdf(fileUrl);
        }

        String pdfBase64 = extractJsonValue(jsonResponse, "pdf");
        if (pdfBase64 == null || pdfBase64.isEmpty()) {
            throw new IOException("No PDF data in API2PDF response");
        }

        return Base64.getDecoder().decode(pdfBase64);
    }

    private byte[] downloadPdf(String fileUrl) throws IOException {
        HttpURLConnection connection = (HttpURLConnection) URI.create(fileUrl).toURL().openConnection();
        connection.setRequestMethod("GET");
        connection.setConnectTimeout(30000);
        connection.setReadTimeout(30000);

        int statusCode = connection.getResponseCode();
        if (statusCode < 200 || statusCode >= 300) {
            throw new IOException("Could not download API2PDF file (" + statusCode + ")");
        }

        try (InputStream inputStream = connection.getInputStream()) {
            return inputStream.readAllBytes();
        }
    }

    public String convertHtmlToHostedPdfUrl(String htmlContent) throws IOException {
        String jsonPayload = buildPayload(htmlContent);
        String apiKey = readApiKey();

        HttpURLConnection connection = (HttpURLConnection) URI.create(CHROME_ENDPOINT).toURL().openConnection();
        connection.setRequestMethod("POST");
        connection.setRequestProperty("Content-Type", "application/json");
        connection.setRequestProperty("Authorization", apiKey);
        connection.setDoOutput(true);
        connection.setConnectTimeout(30000);
        connection.setReadTimeout(30000);

        try (OutputStream os = connection.getOutputStream()) {
            byte[] input = jsonPayload.getBytes(StandardCharsets.UTF_8);
            os.write(input, 0, input.length);
        }

        int statusCode = connection.getResponseCode();
        if (statusCode < 200 || statusCode >= 300) {
            try (InputStream errorStream = connection.getErrorStream()) {
                String errorResponse = errorStream == null ? "" : new String(errorStream.readAllBytes(), StandardCharsets.UTF_8);
                throw new IOException("API2PDF Error (" + statusCode + "): " + errorResponse);
            }
        }

        try (InputStream is = connection.getInputStream()) {
            String jsonResponse = new String(is.readAllBytes(), StandardCharsets.UTF_8);
            String fileUrl = firstJsonValue(jsonResponse, "FileUrl", "fileUrl", "url");
            if (fileUrl == null || fileUrl.isBlank()) {
                throw new IOException("API2PDF did not return a hosted PDF URL.");
            }
            return unescapeJson(fileUrl);
        }
    }

    private String firstJsonValue(String json, String... keys) {
        for (String key : keys) {
            String value = extractJsonValue(json, key);
            if (value != null && !value.isBlank()) {
                return value;
            }
        }
        return null;
    }

    /**
     * Simple JSON value extractor
     */
    private String extractJsonValue(String json, String key) {
        String searchStr = "\"" + key + "\":\"";
        int startIndex = json.indexOf(searchStr);
        if (startIndex == -1) {
            return null;
        }

        startIndex += searchStr.length();
        int endIndex = json.indexOf("\"", startIndex);
        if (endIndex == -1) {
            return null;
        }

        return json.substring(startIndex, endIndex);
    }

    private String unescapeJson(String value) {
        return value
                .replace("\\/", "/")
                .replace("\\\"", "\"")
                .replace("\\\\", "\\");
    }

    /**
     * Convert HTML to PDF and save to file
     */
    public void htmlToPdfFile(String htmlContent, String filePath) throws IOException {
        byte[] pdfBytes = convertHtmlToPdf(htmlContent);
        Files.write(Path.of(filePath), pdfBytes);
    }

    /**
     * Convert HTML to PDF and download to Downloads folder
     */
    public String htmlToPdfDownload(String htmlContent, String fileName) throws IOException {
        byte[] pdfBytes = convertHtmlToPdf(htmlContent);
        File downloadsDir = new File(System.getProperty("user.home"), "Downloads");
        File outputFile = new File(downloadsDir, fileName);
        Files.write(outputFile.toPath(), pdfBytes);
        return outputFile.getAbsolutePath();
    }

    private static String readApiKey() throws IOException {
        String systemValue = System.getProperty("API2PDF_KEY");
        if (systemValue != null && !systemValue.isBlank()) {
            return systemValue.trim();
        }

        String envValue = System.getenv("API2PDF_KEY");
        if (envValue != null && !envValue.isBlank()) {
            return envValue.trim();
        }

        try (InputStream stream = Api2PdfService.class.getResourceAsStream("/api2pdf.properties")) {
            if (stream != null) {
                Properties properties = new Properties();
                properties.load(stream);
                String propertyValue = properties.getProperty("api2pdf.key");
                if (propertyValue != null && !propertyValue.isBlank()) {
                    return propertyValue.trim();
                }
            }
        } catch (IOException e) {
            System.err.println("Could not read API2PDF config: " + e.getMessage());
        }

        throw new IOException("API2PDF_KEY is not configured.");
    }
}

