package tn.esprit.services;

import tn.esprit.entities.Appointment;

import java.io.File;
import java.io.IOException;
import java.nio.charset.StandardCharsets;
import java.nio.file.Files;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.List;

public class AppointmentPdfService {
    private static final DateTimeFormatter APPOINTMENT_DATE_FORMAT = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");
    private static final DateTimeFormatter GENERATED_AT_FORMAT = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm:ss");

    private final AppointmentLocationService locationService = new AppointmentLocationService();

    public void exportAppointmentProof(Appointment appointment, File outputFile) throws IOException {
        if (appointment == null) {
            throw new IOException("No appointment was provided for PDF export.");
        }
        if (outputFile == null) {
            throw new IOException("No destination file was selected.");
        }

        String appointmentDate = appointment.getAppointmentDate() == null
                ? "N/A"
                : appointment.getAppointmentDate().toLocalDateTime().format(APPOINTMENT_DATE_FORMAT);

        List<String> lines = new ArrayList<>();
        lines.add("PinkShield");
        lines.add("Appointment Proof");
        lines.add(" ");
        lines.add("Appointment ID: " + appointment.getId());
        lines.add("Patient: " + safeValue(appointment.getPatientName()));
        lines.add("Doctor: " + safeValue(appointment.getDoctorName()));
        lines.add("Date & Time: " + appointmentDate);
        lines.add("Status: " + safeValue(appointment.getStatus()));
        lines.add("Location: " + locationService.getClinicAddress());
        lines.add("Notes: " + safeValue(appointment.getNotes(), "No additional notes."));
        lines.add(" ");
        lines.add("Generated: " + LocalDateTime.now().format(GENERATED_AT_FORMAT));
        lines.add(" ");
        lines.add("This document confirms the appointment booking registered in PinkShield.");

        String contentStream = buildTextContentStream(lines);
        Files.write(outputFile.toPath(), buildMinimalPdf(contentStream));
    }

    private byte[] buildMinimalPdf(String contentStream) {
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

    private String buildTextContentStream(List<String> lines) {
        StringBuilder stream = new StringBuilder();
        stream.append("BT\n")
                .append("/F1 12 Tf\n")
                .append("50 790 Td\n");

        for (int index = 0; index < lines.size(); index++) {
            if (index > 0) {
                stream.append("0 -18 Td\n");
            }
            stream.append("(")
                    .append(pdfEscape(toAscii(lines.get(index))))
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

    private String safeValue(String value) {
        return safeValue(value, "N/A");
    }

    private String safeValue(String value, String fallback) {
        return value == null || value.isBlank() ? fallback : value;
    }
}
