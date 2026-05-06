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

    private final Api2PdfService api2PdfService = new Api2PdfService();
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

        String html = buildAppointmentProofHtml(appointment, appointmentDate);
        try {
            Files.write(outputFile.toPath(), api2PdfService.convertHtmlToPdf(html));
        } catch (IOException e) {
            System.err.println("API2PDF failed for appointment proof, using fallback: " + e.getMessage());
            Files.write(outputFile.toPath(), buildFallbackAppointmentPdf(appointment, appointmentDate));
        }
    }

    public String exportAppointmentProofHostedUrl(Appointment appointment) throws IOException {
        if (appointment == null) {
            throw new IOException("No appointment was provided for hosted PDF export.");
        }

        String appointmentDate = appointment.getAppointmentDate() == null
                ? "N/A"
                : appointment.getAppointmentDate().toLocalDateTime().format(APPOINTMENT_DATE_FORMAT);
        return api2PdfService.convertHtmlToHostedPdfUrl(buildAppointmentProofHtml(appointment, appointmentDate));
    }

    private String buildAppointmentProofHtml(Appointment appointment, String appointmentDate) {
        String status = safeValue(appointment.getStatus(), "pending").toLowerCase();
        String generatedAt = LocalDateTime.now().format(GENERATED_AT_FORMAT);

        return """
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <style>
                        * { box-sizing: border-box; }
                        body {
                            margin: 0;
                            font-family: Arial, Helvetica, sans-serif;
                            color: #172033;
                            background: #f4f7fb;
                        }
                        .receipt {
                            width: 100%;
                            min-height: 100vh;
                            padding: 34px;
                            background: linear-gradient(135deg, #fff7fb 0%, #f3fbff 100%);
                        }
                        .shell {
                            border: 1px solid #dbe5f1;
                            border-radius: 22px;
                            overflow: hidden;
                            background: #ffffff;
                            box-shadow: 0 22px 60px rgba(17, 31, 52, 0.12);
                        }
                        .header {
                            padding: 32px;
                            text-align: center;
                            color: #ffffff;
                            background: linear-gradient(135deg, #db4f8b 0%, #3b78d8 100%);
                        }
                        .brand {
                            font-size: 28px;
                            font-weight: 900;
                            letter-spacing: 0;
                        }
                        .subtitle {
                            margin-top: 8px;
                            font-size: 14px;
                            opacity: 0.92;
                            font-weight: 700;
                        }
                        .content { padding: 30px; }
                        .status-row {
                            text-align: center;
                            margin-bottom: 24px;
                        }
                        .status {
                            display: inline-block;
                            padding: 10px 24px;
                            border-radius: 999px;
                            font-size: 13px;
                            font-weight: 900;
                            text-transform: uppercase;
                        }
                        .pending { background: #fff3cd; color: #9a6700; }
                        .confirmed { background: #dcfce7; color: #166534; }
                        .postponed { background: #f3e8ff; color: #6b21a8; }
                        .cancelled { background: #fee2e2; color: #991b1b; }
                        .completed { background: #dbeafe; color: #1e40af; }
                        .grid {
                            display: grid;
                            grid-template-columns: 1fr 1fr;
                            gap: 16px;
                        }
                        .card {
                            border: 1px solid #e4ebf4;
                            border-radius: 16px;
                            padding: 18px;
                            background: #fbfdff;
                        }
                        .label {
                            font-size: 11px;
                            font-weight: 900;
                            color: #7b8da8;
                            text-transform: uppercase;
                            margin-bottom: 6px;
                        }
                        .value {
                            font-size: 16px;
                            font-weight: 800;
                            color: #172033;
                        }
                        .wide { grid-column: 1 / span 2; }
                        .footer {
                            margin-top: 26px;
                            padding-top: 18px;
                            border-top: 1px solid #e4ebf4;
                            text-align: center;
                            color: #6b7d95;
                            font-size: 12px;
                            font-weight: 700;
                        }
                    </style>
                </head>
                <body>
                    <div class="receipt">
                        <div class="shell">
                            <div class="header">
                                <div class="brand">PinkShield Pharmacy - Appointment Proof</div>
                                <div class="subtitle">Official consultation booking document</div>
                            </div>
                            <div class="content">
                                <div class="status-row">
                                    <span class="status __STATUS_CLASS__">__STATUS_TEXT__</span>
                                </div>
                                <div class="grid">
                                    <div class="card"><div class="label">Appointment ID</div><div class="value">__APPOINTMENT_ID__</div></div>
                                    <div class="card"><div class="label">Date &amp; Time</div><div class="value">__APPOINTMENT_DATE__</div></div>
                                    <div class="card"><div class="label">Patient</div><div class="value">__PATIENT_NAME__</div></div>
                                    <div class="card"><div class="label">Doctor</div><div class="value">__DOCTOR_NAME__</div></div>
                                    <div class="card wide"><div class="label">Clinic Location</div><div class="value">__CLINIC_LOCATION__</div></div>
                                    <div class="card wide"><div class="label">Notes</div><div class="value">__NOTES__</div></div>
                                </div>
                                <div class="footer">
                                    Generated on __GENERATED_AT__<br>
                                    This document confirms the appointment booking registered in PinkShield.
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
                """
                .replace("__STATUS_CLASS__", htmlEscape(status))
                .replace("__STATUS_TEXT__", htmlEscape(status))
                .replace("__APPOINTMENT_ID__", String.valueOf(appointment.getId()))
                .replace("__APPOINTMENT_DATE__", htmlEscape(appointmentDate))
                .replace("__PATIENT_NAME__", htmlEscape(safeValue(appointment.getPatientName())))
                .replace("__DOCTOR_NAME__", htmlEscape(safeValue(appointment.getDoctorName())))
                .replace("__CLINIC_LOCATION__", htmlEscape(locationService.getClinicAddress()))
                .replace("__NOTES__", htmlEscape(safeValue(appointment.getNotes(), "No additional notes.")))
                .replace("__GENERATED_AT__", htmlEscape(generatedAt));
    }

    private byte[] buildFallbackAppointmentPdf(Appointment appointment, String appointmentDate) {
        List<String> lines = new ArrayList<>();
        lines.add("PinkShield Pharmacy - Appointment Proof");
        lines.add("Official consultation booking document");
        lines.add(" ");
        lines.add("STATUS: " + safeValue(appointment.getStatus()).toUpperCase());
        lines.add(" ");
        lines.add("Appointment ID: " + appointment.getId());
        lines.add("Patient: " + safeValue(appointment.getPatientName()));
        lines.add("Doctor: " + safeValue(appointment.getDoctorName()));
        lines.add("Date & Time: " + appointmentDate);
        lines.add("Location: " + locationService.getClinicAddress());
        lines.add("Notes: " + safeValue(appointment.getNotes(), "No additional notes."));
        lines.add(" ");
        lines.add("Generated: " + LocalDateTime.now().format(GENERATED_AT_FORMAT));
        lines.add("This document confirms the appointment booking registered in PinkShield.");

        return buildMinimalPdf(buildTextContentStream(lines));
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

    private String htmlEscape(String value) {
        return value == null ? "" : value
                .replace("&", "&amp;")
                .replace("<", "&lt;")
                .replace(">", "&gt;")
                .replace("\"", "&quot;");
    }

    private String safeValue(String value) {
        return safeValue(value, "N/A");
    }

    private String safeValue(String value, String fallback) {
        return value == null || value.isBlank() ? fallback : value;
    }
}
