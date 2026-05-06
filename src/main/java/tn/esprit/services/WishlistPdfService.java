package tn.esprit.services;

import tn.esprit.entities.Transaction;
import tn.esprit.entities.WishlistDisplayItem;

import java.io.File;
import java.io.IOException;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.List;

/**
 * PDF Service for generating Wishlist and Receipt PDFs using API2PDF for beautiful rendering
 */
public class WishlistPdfService {

    private static final DateTimeFormatter DATE_FORMAT = DateTimeFormatter.ofPattern("yyyy-MM-dd");
    private static final DateTimeFormatter TIMESTAMP_FORMAT = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss");
    private final Api2PdfService api2PdfService = new Api2PdfService();

    /**
     * Export a payment receipt as PDF using API2PDF
     */
    public String exportPaymentReceiptPdf(String transactionId, String cardholderName, List<WishlistDisplayItem> items, double totalAmount) throws IOException {
        String fileName = "Receipt_" + transactionId + ".pdf";
        String html = getReceiptHtmlTemplate(transactionId, cardholderName, items, totalAmount);
        
        try {
            return api2PdfService.htmlToPdfDownload(html, fileName);
        } catch (IOException e) {
            // Fallback to basic PDF generation if API2PDF fails
            System.err.println("API2PDF failed, using fallback: " + e.getMessage());
            byte[] pdfBytes = buildPdfFromHtml(html);
            File downloadsDir = new File(System.getProperty("user.home"), "Downloads");
            File outputFile = new File(downloadsDir, fileName);
            Files.write(outputFile.toPath(), pdfBytes);
            return outputFile.getAbsolutePath();
        }
    }

    /**
     * Export entire wishlist as PDF using API2PDF
     */
    public String exportWishlistPdf(List<WishlistDisplayItem> wishlistItems, double totalPrice) throws IOException {
        String fileName = "Wishlist_" + LocalDate.now().format(DateTimeFormatter.ofPattern("yyyy-MM-dd")) + ".pdf";
        String html = getWishlistHtmlTemplate(wishlistItems, totalPrice);
        
        try {
            return api2PdfService.htmlToPdfDownload(html, fileName);
        } catch (IOException e) {
            // Fallback to basic PDF generation if API2PDF fails
            System.err.println("API2PDF failed, using fallback: " + e.getMessage());
            byte[] pdfBytes = buildPdfFromHtml(html);
            File downloadsDir = new File(System.getProperty("user.home"), "Downloads");
            File outputFile = new File(downloadsDir, fileName);
            Files.write(outputFile.toPath(), pdfBytes);
            return outputFile.getAbsolutePath();
        }
    }

    /**
     * Rebuild and download a receipt PDF from a saved transaction history row.
     */
    public String exportTransactionReceiptPdf(Transaction transaction) throws IOException {
        if (transaction == null) {
            throw new IOException("Transaction is missing.");
        }

        String transactionId = transaction.getTransactionId() == null || transaction.getTransactionId().isBlank()
                ? "TX-" + transaction.getId()
                : transaction.getTransactionId();
        String fileName = "Receipt_" + transactionId + ".pdf";
        String html = getReceiptHtmlTemplate(
                transactionId,
                transaction.getCardholderName() == null ? "Patient" : transaction.getCardholderName(),
                itemsFromTransaction(transaction),
                transaction.getTotalAmount()
        );

        try {
            return api2PdfService.htmlToPdfDownload(html, fileName);
        } catch (IOException e) {
            System.err.println("API2PDF failed, using fallback: " + e.getMessage());
            byte[] pdfBytes = buildPdfFromHtml(html);
            File downloadsDir = new File(System.getProperty("user.home"), "Downloads");
            File outputFile = new File(downloadsDir, fileName);
            Files.write(outputFile.toPath(), pdfBytes);
            return outputFile.getAbsolutePath();
        }
    }

    private List<WishlistDisplayItem> itemsFromTransaction(Transaction transaction) {
        List<WishlistDisplayItem> items = new ArrayList<>();
        String storedItems = transaction.getItems();

        if (storedItems != null && !storedItems.isBlank()) {
            String[] lines = storedItems.split("\\R");
            for (String line : lines) {
                String trimmed = line.trim();
                if (trimmed.isEmpty()) {
                    continue;
                }

                String[] parts = trimmed.split("\\|", 2);
                String name = parts[0].trim();
                double price = parts.length > 1 ? parsePrice(parts[1]) : 0.0;
                items.add(new WishlistDisplayItem(0, transaction.getUserId(), 0, name, "Purchased item", price, transaction.getCreatedAt()));
            }
        }

        if (!items.isEmpty()) {
            return items;
        }

        int itemCount = Math.max(1, transaction.getItemCount());
        double itemPrice = itemCount == 0 ? transaction.getTotalAmount() : transaction.getTotalAmount() / itemCount;
        for (int i = 1; i <= itemCount; i++) {
            items.add(new WishlistDisplayItem(0, transaction.getUserId(), 0, "Purchased item " + i, "Purchased item", itemPrice, transaction.getCreatedAt()));
        }
        return items;
    }

    private double parsePrice(String value) {
        String numeric = value == null ? "" : value.replace("TND", "").trim();
        try {
            return Double.parseDouble(numeric);
        } catch (NumberFormatException e) {
            return 0.0;
        }
    }

    /**
     * Create HTML template for payment receipt with enhanced styling
     */
    private String getReceiptHtmlTemplate(String transactionId, String cardholderName, List<WishlistDisplayItem> items, double totalAmount) {
        String generatedAt = LocalDateTime.now().format(TIMESTAMP_FORMAT);
        String itemColor = "#e84393";
        StringBuilder tableRows = new StringBuilder();
        
        for (WishlistDisplayItem item : items) {
            tableRows.append("<tr>")
                    .append("<td>").append(htmlEscape(item.getProductName())).append("</td>")
                    .append("<td style='text-align: right;'>").append(String.format("%.2f", item.getPrice())).append(" TND</td>")
                    .append("<td style='text-align: center;'>1</td>")
                    .append("<td style='text-align: right;'>").append(String.format("%.2f", item.getPrice())).append(" TND</td>")
                    .append("</tr>");
        }

        return "<!DOCTYPE html>"
                + "<html lang='en'>"
                + "<head>"
                + "<meta charset='UTF-8'/>"
                + "<meta name='viewport' content='width=device-width, initial-scale=1.0'/>"
                + "<title>PinkShield Payment Receipt</title>"
                + getReceiptCss(itemColor)
                + "</head>"
                + "<body>"
                + "<div class='sheet'>"
                + getReceiptHeader(itemColor)
                + "<div class='receipt-body'>"
                + "<div class='receipt-title'>OFFICIAL RECEIPT</div>"
                + "<div class='transaction-info'>"
                + "<div class='info-grid'>"
                + "<div class='info-item'><span class='info-label'>Transaction ID:</span><br><span class='info-value'>" + htmlEscape(transactionId) + "</span></div>"
                + "<div class='info-item'><span class='info-label'>Cardholder:</span><br><span class='info-value'>" + htmlEscape(cardholderName) + "</span></div>"
                + "<div class='info-item'><span class='info-label'>Date & Time:</span><br><span class='info-value'>" + generatedAt + "</span></div>"
                + "</div>"
                + "</div>"
                + "<div style='margin: 25px 0;'><h2 style='color: #2d3436; margin: 0 0 15px 0; font-size: 16px; text-transform: uppercase; border-bottom: 2px solid " + itemColor + "; padding-bottom: 10px;'>Order Items</h2>"
                + "<table>"
                + "<thead><tr>"
                + "<th style='text-align: left;'>Product</th>"
                + "<th style='text-align: right;'>Unit Price</th>"
                + "<th style='text-align: center;'>Qty</th>"
                + "<th style='text-align: right;'>Total</th>"
                + "</tr></thead>"
                + "<tbody>" + tableRows + "</tbody>"
                + "</table>"
                + "</div>"
                + "<div class='summary-section'>"
                + "<h3 style='margin-top: 0; color: #2d3436;'>Order Summary</h3>"
                + "<div class='summary-rows'>"
                + "<div class='summary-row'><span>Subtotal:</span> <span>" + String.format("%.2f", totalAmount) + " TND</span></div>"
                + "<div class='summary-row'><span>Shipping:</span> <span>FREE</span></div>"
                + "<div class='summary-row'><span>Tax:</span> <span>0.00 TND</span></div>"
                + "<div class='summary-row total'><span>Total Amount:</span> <span>" + String.format("%.2f", totalAmount) + " TND</span></div>"
                + "</div>"
                + "</div>"
                + "<div class='payment-status'>"
                + "<div class='status-badge' style='background-color: #27ae60; color: white; padding: 12px; border-radius: 6px; text-align: center; font-weight: bold; font-size: 16px;'>✓ PAYMENT SUCCESSFUL</div>"
                + "</div>"
                + getReceiptFooter(itemColor, generatedAt)
                + "</div>"
                + "</div>"
                + "</body>"
                + "</html>";
    }

    /**
     * Create HTML template for complete wishlist
     */
    private String getWishlistHtmlTemplate(List<WishlistDisplayItem> wishlistItems, double totalPrice) {
        String generatedAt = LocalDateTime.now().format(TIMESTAMP_FORMAT);
        String itemColor = "#e84393";
        StringBuilder tableRows = new StringBuilder();
        
        for (WishlistDisplayItem item : wishlistItems) {
            tableRows.append("<tr>")
                    .append("<td>").append(htmlEscape(item.getProductName())).append("</td>")
                    .append("<td style='text-align: right;'>").append(String.format("%.2f", item.getPrice())).append(" TND</td>")
                    .append("<td>").append(item.getAddedAt() != null ? item.getAddedAt().toLocalDateTime().toLocalDate() : "N/A").append("</td>")
                    .append("</tr>");
        }

        return "<!DOCTYPE html>"
                + "<html lang='en'>"
                + "<head>"
                + "<meta charset='UTF-8'/>"
                + "<meta name='viewport' content='width=device-width, initial-scale=1.0'/>"
                + "<title>PinkShield Complete Wishlist</title>"
                + getWishlistCss(itemColor)
                + "</head>"
                + "<body>"
                + "<div class='sheet'>"
                + getWishlistHeader(itemColor)
                + "<div class='body'>"
                + "<h2 style='color: #2d3436; margin-bottom: 20px;'>Your Complete Wishlist</h2>"
                + "<table>"
                + "<thead><tr>"
                + "<th>Product Name</th>"
                + "<th style='text-align: right;'>Price</th>"
                + "<th>Added On</th>"
                + "</tr></thead>"
                + "<tbody>" + tableRows + "</tbody>"
                + "</table>"
                + "<div class='total-section'>"
                + "<p><strong>Total Amount: </strong>" + String.format("%.2f", totalPrice) + " TND</p>"
                + "</div>"
                + getWishlistFooter(itemColor, generatedAt)
                + "</div>"
                + "</div>"
                + "</body>"
                + "</html>";
    }

    /**
     * Return enhanced CSS styling for receipt PDF with beautiful design
     */
    private String getReceiptCss(String itemColor) {
        return "<style>"
                + "* { margin: 0; padding: 0; box-sizing: border-box; }"
                + "body { "
                + "  font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif; "
                + "  background: linear-gradient(135deg, #f6f7fb 0%, #eef2f7 100%); "
                + "  color: #2d3436; "
                + "  padding: 26px 12px; "
                + "  line-height: 1.6; "
                + "}"
                + ".sheet { "
                + "  max-width: 900px; "
                + "  margin: 0 auto; "
                + "  background: #ffffff; "
                + "  border: none; "
                + "  border-radius: 16px; "
                + "  overflow: hidden; "
                + "  box-shadow: 0 10px 40px rgba(232, 67, 147, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05); "
                + "}"
                + ".header { "
                + "  background: linear-gradient(135deg, " + itemColor + " 0%, #d4357e 100%); "
                + "  color: #fff; "
                + "  padding: 40px 32px; "
                + "  text-align: center; "
                + "  border-bottom: none; "
                + "  position: relative; "
                + "  overflow: hidden; "
                + "}"
                + ".header::before { "
                + "  content: ''; "
                + "  position: absolute; "
                + "  top: -50%; "
                + "  right: -50%; "
                + "  width: 200%; "
                + "  height: 200%; "
                + "  background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px); "
                + "  background-size: 50px 50px; "
                + "}"
                + ".logo { "
                + "  font-size: 32px; "
                + "  font-weight: 700; "
                + "  letter-spacing: 0.5px; "
                + "  text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); "
                + "  position: relative; "
                + "}"
                + ".receipt-body { padding: 40px; }"
                + ".receipt-title { "
                + "  text-align: center; "
                + "  font-size: 18px; "
                + "  font-weight: 700; "
                + "  color: " + itemColor + "; "
                + "  margin-bottom: 30px; "
                + "  letter-spacing: 2px; "
                + "}"
                + ".transaction-info { "
                + "  background: linear-gradient(135deg, #f8f9fc 0%, #f1f2f6 100%); "
                + "  border: 1px solid #e9edf3; "
                + "  border-radius: 12px; "
                + "  padding: 20px; "
                + "  margin-bottom: 30px; "
                + "}"
                + ".info-grid { "
                + "  display: grid; "
                + "  grid-template-columns: repeat(3, 1fr); "
                + "  gap: 15px; "
                + "}"
                + ".info-item { "
                + "  padding: 10px; "
                + "  background: white; "
                + "  border-radius: 8px; "
                + "  border-left: 3px solid " + itemColor + "; "
                + "}"
                + ".info-label { "
                + "  font-size: 12px; "
                + "  color: #636e72; "
                + "  font-weight: 600; "
                + "  text-transform: uppercase; "
                + "  letter-spacing: 0.5px; "
                + "}"
                + ".info-value { "
                + "  font-size: 14px; "
                + "  font-weight: 700; "
                + "  color: #2d3436; "
                + "  margin-top: 5px; "
                + "}"
                + "table { "
                + "  width: 100%; "
                + "  border-collapse: separate; "
                + "  border-spacing: 0; "
                + "  font-size: 14px; "
                + "  margin: 16px 0; "
                + "  border-radius: 12px; "
                + "  overflow: hidden; "
                + "  margin-bottom: 24px; "
                + "}"
                + "th { "
                + "  background: linear-gradient(135deg, " + itemColor + " 0%, #d4357e 100%); "
                + "  font-weight: 700; "
                + "  color: #ffffff; "
                + "  padding: 14px; "
                + "  text-align: left; "
                + "}"
                + "td { "
                + "  background: #fff; "
                + "  padding: 12px 14px; "
                + "  text-align: left; "
                + "  border-bottom: 1px solid #e9edf3; "
                + "}"
                + "tr:last-child td { border-bottom: none; }"
                + ".summary-section { "
                + "  background: linear-gradient(135deg, #ffeaf4 0%, #fff5fb 100%); "
                + "  border: 2px solid " + itemColor + "; "
                + "  border-radius: 12px; "
                + "  padding: 20px; "
                + "  margin-top: 30px; "
                + "}"
                + ".summary-rows { "
                + "  display: flex; "
                + "  flex-direction: column; "
                + "  gap: 10px; "
                + "}"
                + ".summary-row { "
                + "  display: flex; "
                + "  justify-content: space-between; "
                + "  padding: 8px 0; "
                + "  font-size: 14px; "
                + "  color: #2d3436; "
                + "}"
                + ".summary-row.total { "
                + "  font-size: 16px; "
                + "  font-weight: 700; "
                + "  color: " + itemColor + "; "
                + "  border-top: 2px solid " + itemColor + "; "
                + "  padding-top: 12px; "
                + "}"
                + ".payment-status { "
                + "  margin-top: 30px; "
                + "  text-align: center; "
                + "}"
                + ".status-badge { "
                + "  display: inline-block; "
                + "  background: linear-gradient(135deg, #27ae60 0%, #229954 100%); "
                + "  color: white; "
                + "  padding: 14px 28px; "
                + "  border-radius: 8px; "
                + "  font-weight: 700; "
                + "  font-size: 15px; "
                + "  box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3); "
                + "}"
                + ".footer { "
                + "  margin-top: 40px; "
                + "  padding-top: 20px; "
                + "  border-top: 2px solid #e9edf3; "
                + "  color: #636e72; "
                + "  font-size: 12px; "
                + "  text-align: center; "
                + "  line-height: 1.8; "
                + "}"
                + "</style>";
    }

    /**
     * Return enhanced CSS styling for wishlist PDF with beautiful design
     */
    private String getWishlistCss(String itemColor) {
        return "<style>"
                + "* { margin: 0; padding: 0; box-sizing: border-box; }"
                + "body { "
                + "  font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif; "
                + "  background: linear-gradient(135deg, #f6f7fb 0%, #eef2f7 100%); "
                + "  color: #2d3436; "
                + "  padding: 26px 12px; "
                + "  line-height: 1.6; "
                + "}"
                + ".sheet { "
                + "  max-width: 900px; "
                + "  margin: 0 auto; "
                + "  background: #ffffff; "
                + "  border: none; "
                + "  border-radius: 16px; "
                + "  overflow: hidden; "
                + "  box-shadow: 0 10px 40px rgba(232, 67, 147, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05); "
                + "}"
                + ".header { "
                + "  background: linear-gradient(135deg, " + itemColor + " 0%, #d4357e 100%); "
                + "  color: #fff; "
                + "  padding: 40px 32px; "
                + "  text-align: center; "
                + "  border-bottom: none; "
                + "}"
                + ".logo { "
                + "  font-size: 32px; "
                + "  font-weight: 700; "
                + "  letter-spacing: 0.5px; "
                + "  text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); "
                + "}"
                + ".body { "
                + "  padding: 40px; "
                + "}"
                + "h2 { "
                + "  color: #2d3436; "
                + "  margin-bottom: 20px; "
                + "  font-size: 18px; "
                + "  text-transform: uppercase; "
                + "  border-bottom: 2px solid " + itemColor + "; "
                + "  padding-bottom: 10px; "
                + "}"
                + "table { "
                + "  width: 100%; "
                + "  border-collapse: separate; "
                + "  border-spacing: 0; "
                + "  font-size: 14px; "
                + "  margin: 20px 0; "
                + "  border-radius: 12px; "
                + "  overflow: hidden; "
                + "  margin-bottom: 30px; "
                + "}"
                + "th { "
                + "  background: linear-gradient(135deg, " + itemColor + " 0%, #d4357e 100%); "
                + "  font-weight: 700; "
                + "  color: #ffffff; "
                + "  padding: 14px; "
                + "  text-align: left; "
                + "}"
                + "td { "
                + "  background: #fff; "
                + "  padding: 12px 14px; "
                + "  text-align: left; "
                + "  border-bottom: 1px solid #e9edf3; "
                + "}"
                + "tr:last-child td { border-bottom: none; }"
                + ".total-section { "
                + "  background: linear-gradient(135deg, #ffeaf4 0%, #fff5fb 100%); "
                + "  border: 2px solid " + itemColor + "; "
                + "  border-radius: 12px; "
                + "  padding: 20px; "
                + "  margin-top: 30px; "
                + "  text-align: right; "
                + "}"
                + ".total-section p { "
                + "  color: #2d3436; "
                + "  padding: 8px 0; "
                + "  font-size: 14px; "
                + "}"
                + ".total-section p strong { "
                + "  color: " + itemColor + "; "
                + "  font-size: 16px; "
                + "}"
                + ".footer { "
                + "  margin-top: 40px; "
                + "  padding-top: 20px; "
                + "  border-top: 2px solid #e9edf3; "
                + "  color: #636e72; "
                + "  font-size: 12px; "
                + "  text-align: center; "
                + "  line-height: 1.8; "
                + "}"
                + "</style>";
    }

    private String getReceiptHeader(String itemColor) {
        return "<div class='header'>"
                + "<div class='logo'>❤️ PinkShield Payment Receipt</div>"
                + "</div>";
    }

    private String getWishlistHeader(String itemColor) {
        return "<div class='header'>"
                + "<div class='logo'>❤️ PinkShield Wishlist</div>"
                + "</div>";
    }

    private String getReceiptFooter(String itemColor, String generatedAt) {
        return "<div class='footer'>"
                + "This is your official payment receipt from PinkShield.<br>"
                + "Generated on " + generatedAt + " | PinkShield Medical Services"
                + "</div>";
    }

    private String getWishlistFooter(String itemColor, String generatedAt) {
        return "<div class='footer'>"
                + "This document contains your saved wishlist items from PinkShield.<br>"
                + "Generated on " + generatedAt + " | PinkShield Medical Services"
                + "</div>";
    }

    /**
     * Build minimal PDF from HTML content
     */
    private byte[] buildPdfFromHtml(String html) throws IOException {
        List<String> lines = extractTextFromHtml(html);
        StringBuilder pdf = new StringBuilder();
        List<Integer> offsets = new ArrayList<>();

        pdf.append("%PDF-1.4\n");

        offsets.add(pdf.length());
        pdf.append("1 0 obj\n")
                .append("<< /Type /Catalog /Pages 2 0 R >>\n")
                .append("endobj\n");

        offsets.add(pdf.length());
        pdf.append("2 0 obj\n")
                .append("<< /Type /Pages /Kids [3 0 R] /Count 1 >>\n")
                .append("endobj\n");

        offsets.add(pdf.length());
        pdf.append("3 0 obj\n")
                .append("<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 5 0 R >> >> /Contents 4 0 R >>\n")
                .append("endobj\n");

        String contentStream = buildTextContentStream(lines);
        offsets.add(pdf.length());
        pdf.append("4 0 obj\n")
                .append("<< /Length ").append(contentStream.getBytes(StandardCharsets.US_ASCII).length).append(" >>\n")
                .append("stream\n")
                .append(contentStream)
                .append("\nendstream\n")
                .append("endobj\n");

        offsets.add(pdf.length());
        pdf.append("5 0 obj\n")
                .append("<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\n")
                .append("endobj\n");

        int xrefStart = pdf.length();
        pdf.append("xref\n")
                .append("0 6\n")
                .append("0000000000 65535 f \n");
        for (Integer offset : offsets) {
            pdf.append(String.format("%010d 00000 n \n", offset));
        }

        pdf.append("trailer\n")
                .append("<< /Size 6 /Root 1 0 R >>\n")
                .append("startxref\n")
                .append(xrefStart)
                .append("\n%%EOF");

        return pdf.toString().getBytes(StandardCharsets.US_ASCII);
    }

    private List<String> extractTextFromHtml(String html) {
        List<String> lines = new ArrayList<>();
        String[] parts = html.split("<br>|</p>|</div>|</h\\d>|</tr>|</td>|</th>");
        for (String part : parts) {
            String text = part.replaceAll("<[^>]*>", "").trim();
            if (!text.isEmpty()) {
                lines.add(text);
            }
        }
        return lines;
    }

    private String buildTextContentStream(List<String> lines) {
        StringBuilder stream = new StringBuilder();
        stream.append("BT\n")
                .append("/F1 10 Tf\n")
                .append("50 790 Td\n");

        for (int i = 0; i < lines.size(); i++) {
            if (i > 0) {
                stream.append("0 -15 Td\n");
            }
            stream.append("(")
                    .append(pdfEscape(toAscii(lines.get(i))))
                    .append(") Tj\n");
        }

        stream.append("ET");
        return stream.toString();
    }

    private String pdfEscape(String value) {
        return value.replace("\\", "\\\\")
                .replace("(", "\\(")
                .replace(")", "\\)");
    }

    private String toAscii(String value) {
        StringBuilder ascii = new StringBuilder();
        for (char ch : value.toCharArray()) {
            ascii.append(ch <= 127 ? ch : '?');
        }
        return ascii.toString();
    }

    private String htmlEscape(String value) {
        return (value == null ? "" : value)
                .replace("&", "&amp;")
                .replace("<", "&lt;")
                .replace(">", "&gt;")
                .replace("\"", "&quot;")
                .replace("'", "&#39;");
    }
}

