package org.example;

import java.io.File;
import java.io.IOException;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.List;

public class WishlistPdfService {

    private static final DateTimeFormatter DATE_FORMAT = DateTimeFormatter.ofPattern("yyyy-MM-dd");
    private static final DateTimeFormatter TIMESTAMP_FORMAT = DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm:ss");

    /**
     * Export a single wishlist item as a PDF document
     */
    public void exportWishlistItemPdf(WishlistDisplayItem item) throws IOException {
        String fileName = "Wishlist_" + item.getProductName().replaceAll("[^a-zA-Z0-9_-]", "_") + ".pdf";
        String html = getWishlistItemHtmlTemplate(item);
        byte[] pdfBytes = buildPdfFromHtml(html);
        
        File downloadsDir = new File(System.getProperty("user.home"), "Downloads");
        File outputFile = new File(downloadsDir, fileName);
        
        Files.write(outputFile.toPath(), pdfBytes);
    }

    /**
     * Export entire wishlist as PDF
     */
    public void exportWishlistPdf(List<WishlistDisplayItem> wishlistItems, double totalPrice) throws IOException {
        String fileName = "Wishlist_" + LocalDate.now().format(DateTimeFormatter.ofPattern("yyyy-MM-dd")) + ".pdf";
        String html = getWishlistHtmlTemplate(wishlistItems, totalPrice);
        byte[] pdfBytes = buildPdfFromHtml(html);
        
        File downloadsDir = new File(System.getProperty("user.home"), "Downloads");
        File outputFile = new File(downloadsDir, fileName);
        
        Files.write(outputFile.toPath(), pdfBytes);
    }

    /**
     * Create HTML template for a single wishlist item
     */
    private String getWishlistItemHtmlTemplate(WishlistDisplayItem item) {
        String generatedAt = LocalDateTime.now().format(TIMESTAMP_FORMAT);
        String itemColor = "#e84393";

        return "<!DOCTYPE html>"
                + "<html lang='en'>"
                + "<head>"
                + "<meta charset='UTF-8'/>"
                + "<meta name='viewport' content='width=device-width, initial-scale=1.0'/>"
                + "<title>PinkShield Wishlist Item</title>"
                + getWishlistCss(itemColor)
                + "</head>"
                + "<body>"
                + "<div class='sheet'>"
                + getWishlistHeader(itemColor)
                + "<div class='body'>"
                + getItemDetailsSection(item, itemColor)
                + getItemFooter(itemColor, generatedAt)
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
        String tableRows = new StringBuilder();
        
        for (WishlistDisplayItem item : wishlistItems) {
            tableRows.append("<tr>")
                    .append("<td>").append(htmlEscape(item.getProductName())).append("</td>")
                    .append("<td style='text-align: right;'>$").append(String.format("%.2f", item.getPrice())).append(" TND</td>")
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
                + "<p><strong>Total Amount: </strong>$" + String.format("%.2f", totalPrice) + " TND</p>"
                + "</div>"
                + getWishlistFooter(itemColor, generatedAt)
                + "</div>"
                + "</div>"
                + "</body>"
                + "</html>";
    }

    /**
     * Return embedded CSS styling for wishlist PDF
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
                + "  border: 1px solid #e7e8ed; "
                + "  border-radius: 14px; "
                + "  overflow: hidden; "
                + "  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08); "
                + "}"
                + ".header { "
                + "  background: linear-gradient(135deg, " + itemColor + " 0%, #d4357e 100%); "
                + "  color: #fff; "
                + "  padding: 28px 32px; "
                + "  text-align: center; "
                + "  border-bottom: 2px solid rgba(255, 255, 255, 0.1); "
                + "}"
                + ".logo { "
                + "  font-size: 28px; "
                + "  font-weight: 700; "
                + "  letter-spacing: 0.3px; "
                + "  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); "
                + "}"
                + ".body { padding: 32px; }"
                + ".panel { "
                + "  border: 1px solid #e9edf3; "
                + "  border-radius: 10px; "
                + "  padding: 18px; "
                + "  background: #fff; "
                + "  margin-bottom: 20px; "
                + "}"
                + ".panel h4 { "
                + "  margin: 0 0 12px 0; "
                + "  font-size: 12px; "
                + "  text-transform: uppercase; "
                + "  letter-spacing: 0.1em; "
                + "  font-weight: 700; "
                + "  color: " + itemColor + "; "
                + "}"
                + ".line { "
                + "  font-size: 14px; "
                + "  line-height: 1.7; "
                + "  color: #2d3436; "
                + "}"
                + ".line strong { "
                + "  color: #1e272e; "
                + "  display: block; "
                + "  margin-bottom: 4px; "
                + "}"
                + "table { "
                + "  width: 100%; "
                + "  border-collapse: separate; "
                + "  border-spacing: 0; "
                + "  font-size: 13px; "
                + "  margin: 16px 0; "
                + "  border-radius: 8px; "
                + "  overflow: hidden; "
                + "  margin-bottom: 24px; "
                + "}"
                + "th, td { "
                + "  border: 1px solid #e9edf3; "
                + "  padding: 12px 14px; "
                + "  text-align: left; "
                + "}"
                + "th { "
                + "  background: linear-gradient(135deg, #f8f9fc 0%, #f1f2f6 100%); "
                + "  font-weight: 700; "
                + "  color: #1e272e; "
                + "  border-bottom: 2px solid #e9edf3; "
                + "}"
                + "td { background: #fff; }"
                + "tr:last-child td { border-bottom: 2px solid #e9edf3; }"
                + ".total-section { "
                + "  background: #ffeaf4; "
                + "  border: 1px solid " + itemColor + "; "
                + "  border-radius: 8px; "
                + "  padding: 16px; "
                + "  margin-top: 20px; "
                + "  font-size: 14px; "
                + "}"
                + ".total-section p { "
                + "  color: #2d3436; "
                + "  font-weight: 700; "
                + "}"
                + ".footer { "
                + "  margin-top: 24px; "
                + "  padding-top: 16px; "
                + "  border-top: 1px solid #e9edf3; "
                + "  color: #636e72; "
                + "  font-size: 12px; "
                + "  text-align: center; "
                + "}"
                + "</style>";
    }

    private String getWishlistHeader(String itemColor) {
        return "<div class='header'>"
                + "<div class='logo'>❤️ PinkShield Wishlist</div>"
                + "</div>";
    }

    private String getItemDetailsSection(WishlistDisplayItem item, String itemColor) {
        String addedDate = item.getAddedAt() != null 
            ? item.getAddedAt().toLocalDateTime().toLocalDate().toString() 
            : "N/A";

        return "<div class='panel'>"
                + "<h4>Product Details</h4>"
                + "<div class='line'>"
                + "<strong>Product Name:</strong> " + htmlEscape(item.getProductName())
                + "</div>"
                + "<div class='line'>"
                + "<strong>Price:</strong> $" + String.format("%.2f", item.getPrice()) + " TND"
                + "</div>"
                + "<div class='line'>"
                + "<strong>Added to Wishlist:</strong> " + addedDate
                + "</div>"
                + "</div>";
    }

    private String getItemFooter(String itemColor, String generatedAt) {
        return "<div class='footer'>"
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
     * Build minimal PDF from HTML content (fallback method)
     */
    private byte[] buildPdfFromHtml(String html) throws IOException {
        // Build a minimal but valid PDF with the HTML content as text
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
        return value
                .replace("&", "&amp;")
                .replace("<", "&lt;")
                .replace(">", "&gt;")
                .replace("\"", "&quot;")
                .replace("'", "&#39;");
    }
}

