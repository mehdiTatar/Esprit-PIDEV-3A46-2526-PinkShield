package tn.esprit.services;

import com.itextpdf.io.font.constants.StandardFonts;
import com.itextpdf.kernel.colors.ColorConstants;
import com.itextpdf.kernel.colors.DeviceRgb;
import com.itextpdf.kernel.font.PdfFont;
import com.itextpdf.kernel.font.PdfFontFactory;
import com.itextpdf.kernel.pdf.PdfDocument;
import com.itextpdf.kernel.pdf.PdfWriter;
import com.itextpdf.layout.Document;
import com.itextpdf.layout.borders.SolidBorder;
import com.itextpdf.layout.element.Cell;
import com.itextpdf.layout.element.Paragraph;
import com.itextpdf.layout.element.Table;
import com.itextpdf.layout.properties.TextAlignment;
import com.itextpdf.layout.properties.UnitValue;
import tn.esprit.entities.Transaction;

import java.io.IOException;
import java.sql.Timestamp;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class PdfReceiptGenerator {
    private static final DeviceRgb PINK = new DeviceRgb(232, 67, 147);
    private static final DeviceRgb LIGHT_PINK = new DeviceRgb(253, 232, 242);
    private static final DeviceRgb DARK_TEXT = new DeviceRgb(45, 52, 54);
    private static final DateTimeFormatter DATE_FORMAT = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");
    private static final Pattern JSON_NAME_PATTERN = Pattern.compile("\"(?:name|productName|product)\"\\s*:\\s*\"([^\"]+)\"");
    private static final Pattern JSON_PRICE_PATTERN = Pattern.compile("\"(?:price|amount|total)\"\\s*:\\s*([0-9]+(?:\\.[0-9]+)?)");

    public void generateReceipt(Transaction transaction, String destPath) {
        if (transaction == null) {
            throw new IllegalArgumentException("Transaction cannot be null");
        }
        if (destPath == null || destPath.isBlank()) {
            throw new IllegalArgumentException("Destination path cannot be empty");
        }

        try {
            PdfWriter writer = new PdfWriter(destPath);
            PdfDocument pdf = new PdfDocument(writer);
            Document document = new Document(pdf);

            PdfFont regular = PdfFontFactory.createFont(StandardFonts.HELVETICA);
            PdfFont bold = PdfFontFactory.createFont(StandardFonts.HELVETICA_BOLD);

            document.add(new Paragraph("PinkShield Pharmacy - Official Receipt")
                    .setFont(bold)
                    .setFontSize(20)
                    .setFontColor(PINK)
                    .setTextAlignment(TextAlignment.CENTER)
                    .setMarginBottom(20));

            Table metadata = new Table(UnitValue.createPercentArray(new float[]{1, 2}))
                    .useAllAvailableWidth()
                    .setMarginBottom(22);

            addMetaRow(metadata, "Transaction ID", valueOrFallback(transaction.getTransactionId(), "N/A"), regular, bold);
            addMetaRow(metadata, "Date", formatDate(transaction.getCreatedAt()), regular, bold);
            addMetaRow(metadata, "Status", valueOrFallback(transaction.getStatus(), "N/A"), regular, bold);
            addMetaRow(metadata, "Cardholder Name", valueOrFallback(transaction.getCardholderName(), "N/A"), regular, bold);
            addMetaRow(metadata, "Card Last Four", formatCard(transaction.getCardLastFour()), regular, bold);
            document.add(metadata);

            document.add(new Paragraph("Purchased Items")
                    .setFont(bold)
                    .setFontSize(14)
                    .setFontColor(DARK_TEXT)
                    .setMarginBottom(8));

            Table itemsTable = new Table(UnitValue.createPercentArray(new float[]{4, 1, 2}))
                    .useAllAvailableWidth()
                    .setMarginBottom(20);

            addHeaderCell(itemsTable, "Item", bold);
            addHeaderCell(itemsTable, "Qty", bold);
            addHeaderCell(itemsTable, "Price", bold);

            for (ReceiptItem item : parseItems(transaction)) {
                addItemRow(itemsTable, item.name(), String.valueOf(item.quantity()), formatAmount(item.price()), regular);
            }
            document.add(itemsTable);

            document.add(new Paragraph("Total Amount: " + formatAmount(transaction.getTotalAmount()))
                    .setFont(bold)
                    .setFontSize(15)
                    .setFontColor(PINK)
                    .setTextAlignment(TextAlignment.RIGHT)
                    .setMarginBottom(24));

            document.add(new Paragraph("Thank you for shopping with PinkShield Pharmacy.")
                    .setFont(regular)
                    .setFontSize(11)
                    .setFontColor(DARK_TEXT)
                    .setTextAlignment(TextAlignment.CENTER));

            document.close();
        } catch (IOException e) {
            throw new RuntimeException("Could not generate receipt PDF", e);
        }
    }

    private List<ReceiptItem> parseItems(Transaction transaction) {
        String rawItems = transaction.getItems();
        List<ReceiptItem> parsedItems = new ArrayList<>();

        if (rawItems != null && !rawItems.isBlank()) {
            String[] lines = rawItems.split("\\R");
            for (String line : lines) {
                ReceiptItem item = parseItemLine(line);
                if (item != null) {
                    parsedItems.add(item);
                }
            }
        }

        if (!parsedItems.isEmpty()) {
            return parsedItems;
        }

        int count = Math.max(1, transaction.getItemCount());
        double unitPrice = transaction.getTotalAmount() / count;
        for (int i = 1; i <= count; i++) {
            parsedItems.add(new ReceiptItem("Purchased item " + i, 1, unitPrice));
        }
        return parsedItems;
    }

    private ReceiptItem parseItemLine(String line) {
        if (line == null || line.isBlank()) {
            return null;
        }

        String trimmed = line.trim();
        if (trimmed.startsWith("{") || trimmed.contains("\":")) {
            return parseJsonLikeItem(trimmed);
        }

        String[] parts = trimmed.split("\\|", 2);
        String name = parts[0].trim();
        double price = parts.length > 1 ? parsePrice(parts[1]) : 0.0;
        return new ReceiptItem(valueOrFallback(name, "Purchased item"), 1, price);
    }

    private ReceiptItem parseJsonLikeItem(String itemText) {
        Matcher nameMatcher = JSON_NAME_PATTERN.matcher(itemText);
        Matcher priceMatcher = JSON_PRICE_PATTERN.matcher(itemText);

        String name = nameMatcher.find() ? nameMatcher.group(1) : "Purchased item";
        double price = priceMatcher.find() ? parsePrice(priceMatcher.group(1)) : 0.0;
        return new ReceiptItem(name, 1, price);
    }

    private double parsePrice(String value) {
        String numeric = value == null ? "" : value.replace("TND", "").replace(",", ".").trim();
        try {
            return Double.parseDouble(numeric);
        } catch (NumberFormatException e) {
            return 0.0;
        }
    }

    private void addMetaRow(Table table, String label, String value, PdfFont regular, PdfFont bold) {
        table.addCell(new Cell()
                .add(new Paragraph(label).setFont(bold).setFontSize(10))
                .setBackgroundColor(LIGHT_PINK)
                .setBorder(new SolidBorder(ColorConstants.WHITE, 1))
                .setPadding(8));

        table.addCell(new Cell()
                .add(new Paragraph(value).setFont(regular).setFontSize(10))
                .setBorder(new SolidBorder(ColorConstants.WHITE, 1))
                .setPadding(8));
    }

    private void addHeaderCell(Table table, String text, PdfFont bold) {
        table.addCell(new Cell()
                .add(new Paragraph(text).setFont(bold).setFontSize(10).setFontColor(ColorConstants.WHITE))
                .setBackgroundColor(PINK)
                .setPadding(8)
                .setTextAlignment(TextAlignment.CENTER));
    }

    private void addItemRow(Table table, String item, String quantity, String price, PdfFont regular) {
        table.addCell(new Cell()
                .add(new Paragraph(valueOrFallback(item, "Purchased item")).setFont(regular).setFontSize(10))
                .setPadding(8));
        table.addCell(new Cell()
                .add(new Paragraph(valueOrFallback(quantity, "1")).setFont(regular).setFontSize(10))
                .setPadding(8)
                .setTextAlignment(TextAlignment.CENTER));
        table.addCell(new Cell()
                .add(new Paragraph(valueOrFallback(price, "0.00 TND")).setFont(regular).setFontSize(10))
                .setPadding(8)
                .setTextAlignment(TextAlignment.RIGHT));
    }

    private String formatDate(Timestamp timestamp) {
        return timestamp == null ? "N/A" : timestamp.toLocalDateTime().format(DATE_FORMAT);
    }

    private String formatCard(String cardLastFour) {
        String value = valueOrFallback(cardLastFour, "");
        return value.isBlank() ? "N/A" : "**** " + value;
    }

    private String formatAmount(double amount) {
        return String.format(Locale.US, "%.2f TND", amount);
    }

    private String valueOrFallback(String value, String fallback) {
        return value == null || value.isBlank() ? fallback : value.trim();
    }

    private record ReceiptItem(String name, int quantity, double price) {
    }
}
