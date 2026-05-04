package org.example;

import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import java.awt.Desktop;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.concurrent.CompletableFuture;

/**
 * PdfReceiptService: Generates medical receipts and converts to PDF
 * 
 * Features:
 * - Generates clean HTML receipt templates
 * - Converts HTML to PDF using free API (api2pdf.com)
 * - Opens PDF automatically in default browser
 * - Non-blocking async operations with CompletableFuture
 * - Error handling with user-friendly messages
 * 
 * API: https://v2018.api2pdf.com/chrome/html
 * Note: Free tier available (100 conversions/month)
 */
public class PdfReceiptService {

    private static final String PDF_API_ENDPOINT = "https://v2018.api2pdf.com/chrome/html";
    // API key from https://app.api2pdf.com/register
    private static final String API_KEY = "47dd0117-8f36-4359-b282-bb2cdeda2d9d";
    
    private static final HttpClient httpClient = HttpClient.newBuilder()
            .version(HttpClient.Version.HTTP_2)
            .followRedirects(HttpClient.Redirect.NORMAL)
            .build();

    /**
     * Generate a clean medical receipt in HTML format
     * 
     * @param patientName Name of the patient
     * @param totalAmount Total amount paid
     * @return HTML string representing the receipt
     */
    public static String generateReceiptHtml(String patientName, double totalAmount) {
        String date = LocalDateTime.now().format(DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss"));
        String receiptId = "RCP-" + System.currentTimeMillis();
        String formattedAmount = String.format("%.2f", totalAmount);
        String escapedName = escapeHtml(patientName);

        return "<!DOCTYPE html>\n" +
                "<html lang=\"en\">\n" +
                "<head>\n" +
                "    <meta charset=\"UTF-8\">\n" +
                "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n" +
                "    <title>PinkShield Medical Receipt</title>\n" +
                "    <style>\n" +
                "        * {\n" +
                "            margin: 0;\n" +
                "            padding: 0;\n" +
                "            box-sizing: border-box;\n" +
                "        }\n" +
                "        body {\n" +
                "            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;\n" +
                "            background-color: #f5f5f5;\n" +
                "            padding: 20px;\n" +
                "        }\n" +
                "        .receipt-container {\n" +
                "            max-width: 600px;\n" +
                "            margin: 0 auto;\n" +
                "            background-color: white;\n" +
                "            padding: 40px;\n" +
                "            border-radius: 10px;\n" +
                "            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);\n" +
                "        }\n" +
                "        .header {\n" +
                "            text-align: center;\n" +
                "            border-bottom: 3px solid #e84393;\n" +
                "            padding-bottom: 20px;\n" +
                "            margin-bottom: 30px;\n" +
                "        }\n" +
                "        .header h1 {\n" +
                "            color: #e84393;\n" +
                "            font-size: 32px;\n" +
                "            margin-bottom: 5px;\n" +
                "        }\n" +
                "        .header p {\n" +
                "            color: #666;\n" +
                "            font-size: 14px;\n" +
                "        }\n" +
                "        .receipt-id {\n" +
                "            background-color: #f0f0f0;\n" +
                "            padding: 15px;\n" +
                "            border-radius: 5px;\n" +
                "            margin-bottom: 20px;\n" +
                "            font-size: 12px;\n" +
                "            color: #666;\n" +
                "        }\n" +
                "        .content {\n" +
                "            margin: 30px 0;\n" +
                "        }\n" +
                "        .row {\n" +
                "            display: flex;\n" +
                "            justify-content: space-between;\n" +
                "            padding: 12px 0;\n" +
                "            border-bottom: 1px solid #eee;\n" +
                "        }\n" +
                "        .row:last-child {\n" +
                "            border-bottom: none;\n" +
                "        }\n" +
                "        .label {\n" +
                "            font-weight: 600;\n" +
                "            color: #333;\n" +
                "        }\n" +
                "        .value {\n" +
                "            color: #666;\n" +
                "            text-align: right;\n" +
                "        }\n" +
                "        .total-row {\n" +
                "            background-color: #f9f9f9;\n" +
                "            padding: 15px;\n" +
                "            border-radius: 5px;\n" +
                "            margin-top: 20px;\n" +
                "            display: flex;\n" +
                "            justify-content: space-between;\n" +
                "            align-items: center;\n" +
                "        }\n" +
                "        .total-row .label {\n" +
                "            font-size: 18px;\n" +
                "            color: #e84393;\n" +
                "        }\n" +
                "        .total-row .value {\n" +
                "            font-size: 24px;\n" +
                "            font-weight: bold;\n" +
                "            color: #e84393;\n" +
                "        }\n" +
                "        .footer {\n" +
                "            text-align: center;\n" +
                "            margin-top: 40px;\n" +
                "            padding-top: 20px;\n" +
                "            border-top: 1px solid #eee;\n" +
                "            color: #999;\n" +
                "            font-size: 12px;\n" +
                "        }\n" +
                "        .status {\n" +
                "            background-color: #d4edda;\n" +
                "            color: #155724;\n" +
                "            padding: 10px;\n" +
                "            border-radius: 5px;\n" +
                "            text-align: center;\n" +
                "            margin: 20px 0;\n" +
                "            font-weight: 600;\n" +
                "        }\n" +
                "    </style>\n" +
                "</head>\n" +
                "<body>\n" +
                "    <div class=\"receipt-container\">\n" +
                "        <div class=\"header\">\n" +
                "            <h1>💊 PinkShield</h1>\n" +
                "            <p>Medical Services Receipt</p>\n" +
                "        </div>\n" +
                "        \n" +
                "        <div class=\"receipt-id\">\n" +
                "            <strong>Receipt ID:</strong> " + receiptId + "\n" +
                "        </div>\n" +
                "        \n" +
                "        <div class=\"status\">\n" +
                "            ✓ Payment Completed Successfully\n" +
                "        </div>\n" +
                "        \n" +
                "        <div class=\"content\">\n" +
                "            <div class=\"row\">\n" +
                "                <span class=\"label\">Patient Name:</span>\n" +
                "                <span class=\"value\">" + escapedName + "</span>\n" +
                "            </div>\n" +
                "            <div class=\"row\">\n" +
                "                <span class=\"label\">Date & Time:</span>\n" +
                "                <span class=\"value\">" + date + "</span>\n" +
                "            </div>\n" +
                "            <div class=\"row\">\n" +
                "                <span class=\"label\">Service Type:</span>\n" +
                "                <span class=\"value\">Medical Service</span>\n" +
                "            </div>\n" +
                "        </div>\n" +
                "        \n" +
                "        <div class=\"total-row\">\n" +
                "            <span class=\"label\">Total Amount:</span>\n" +
                "            <span class=\"value\">" + formattedAmount + " TND</span>\n" +
                "        </div>\n" +
                "        \n" +
                "        <div class=\"footer\">\n" +
                "            <p>Thank you for choosing PinkShield for your healthcare needs.</p>\n" +
                "            <p style=\"margin-top: 10px;\">This is an electronically generated receipt. No signature required.</p>\n" +
                "            <p style=\"margin-top: 10px; color: #ccc;\">Generated on: " + date + "</p>\n" +
                "        </div>\n" +
                "    </div>\n" +
                "</body>\n" +
                "</html>";
    }

    /**
     * Generate receipt and convert to PDF, then open in browser
     * Executes asynchronously to prevent UI blocking
     * 
     * @param patientName Patient name for receipt
     * @param totalAmount Total amount to display
     * @return CompletableFuture<Boolean> - true if successful, false if failed
     */
    public static CompletableFuture<Boolean> generateAndDownloadPdfAsync(String patientName, double totalAmount) {
        return CompletableFuture.supplyAsync(() -> {
            try {
                // Step 1: Generate HTML receipt
                String htmlContent = generateReceiptHtml(patientName, totalAmount);
                System.out.println("✅ Receipt HTML generated successfully");

                // Step 2: Convert HTML to PDF via API
                return generateAndDownloadPdf(htmlContent);
            } catch (Exception e) {
                System.err.println("❌ Error in PDF generation: " + e.getMessage());
                e.printStackTrace();
                return false;
            }
        });
    }

    /**
     * Send HTML to PDF conversion API and open the result
     * 
     * @param htmlContent HTML string to convert to PDF
     * @return true if successful, false if failed
     */
    private static Boolean generateAndDownloadPdf(String htmlContent) {
        try {
            System.out.println("🔄 Sending HTML to PDF API...");

            // Create JSON payload
            JsonObject payload = new JsonObject();
            payload.addProperty("html", htmlContent);

            // Build API URL with API key as query parameter
            String apiUrl = PDF_API_ENDPOINT + "?apiKey=" + API_KEY;

            // Create POST request - API key should be in URL as query parameter
            HttpRequest request = HttpRequest.newBuilder()
                    .uri(new URI(apiUrl))
                    .header("Content-Type", "application/json")
                    .POST(HttpRequest.BodyPublishers.ofString(payload.toString()))
                    .timeout(java.time.Duration.ofSeconds(30))
                    .build();

            // Send request
            HttpResponse<String> response = httpClient.send(request, HttpResponse.BodyHandlers.ofString());

            System.out.println("📡 API Response Status: " + response.statusCode());

            if (response.statusCode() == 200) {
                // Parse response
                JsonObject responseJson = JsonParser.parseString(response.body()).getAsJsonObject();
                
                if (responseJson.has("pdf")) {
                    String pdfUrl = responseJson.get("pdf").getAsString();
                    System.out.println("✅ PDF generated successfully: " + pdfUrl);

                    // Open PDF in default browser
                    openPdfInBrowser(pdfUrl);
                    return true;
                } else if (responseJson.has("url")) {
                    String pdfUrl = responseJson.get("url").getAsString();
                    System.out.println("✅ PDF generated successfully: " + pdfUrl);
                    openPdfInBrowser(pdfUrl);
                    return true;
                } else {
                    System.err.println("❌ Response doesn't contain PDF URL: " + response.body());
                    return false;
                }
            } else {
                System.err.println("❌ API error (Status " + response.statusCode() + "): " + response.body());
                
                // Try fallback: Open HTML in browser directly
                System.out.println("⚠️ API key may be invalid or API limit reached. Using fallback: HTML receipt in browser...");
                return false;
            }
        } catch (Exception e) {
            System.err.println("❌ Error sending request to PDF API: " + e.getMessage());
            
            // Fallback approach: Open HTML in browser directly
            System.out.println("⚠️ Fallback: Opening receipt in browser as HTML...");
            try {
                return openHtmlInBrowser(htmlContent);
            } catch (Exception ex) {
                System.err.println("❌ Fallback also failed: " + ex.getMessage());
                return false;
            }
        }
    }

    /**
     * Open PDF URL in default browser
     */
    private static void openPdfInBrowser(String pdfUrl) throws Exception {
        if (Desktop.isDesktopSupported()) {
            Desktop desktop = Desktop.getDesktop();
            if (desktop.isSupported(Desktop.Action.BROWSE)) {
                desktop.browse(new URI(pdfUrl));
                System.out.println("✅ PDF opened in default browser");
            }
        }
    }

    /**
     * Fallback: Open HTML receipt directly in browser
     * This works even without API key - user can print as PDF from browser
     */
    private static Boolean openHtmlInBrowser(String htmlContent) throws Exception {
        // Save HTML to temporary file
        String tempDir = System.getProperty("java.io.tmpdir");
        String fileName = "PinkShield_Receipt_" + System.currentTimeMillis() + ".html";
        java.nio.file.Path filePath = java.nio.file.Paths.get(tempDir, fileName);
        
        java.nio.file.Files.write(filePath, htmlContent.getBytes(java.nio.charset.StandardCharsets.UTF_8));
        
        if (Desktop.isDesktopSupported()) {
            Desktop desktop = Desktop.getDesktop();
            if (desktop.isSupported(Desktop.Action.BROWSE)) {
                desktop.browse(filePath.toUri());
                System.out.println("✅ Receipt HTML opened in default browser (" + filePath + ")");
                return true;
            }
        }
        return false;
    }

    /**
     * Escape HTML special characters to prevent injection
     */
    private static String escapeHtml(String text) {
        if (text == null) return "";
        return text.replace("&", "&amp;")
                   .replace("<", "&lt;")
                   .replace(">", "&gt;")
                   .replace("\"", "&quot;")
                   .replace("'", "&#39;");
    }
}

