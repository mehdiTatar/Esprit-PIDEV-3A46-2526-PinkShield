package tn.esprit.services;

import tn.esprit.entities.Appointment;

import java.net.URLEncoder;
import java.nio.charset.StandardCharsets;
import java.time.format.DateTimeFormatter;
import java.util.Map;
import java.util.concurrent.ConcurrentHashMap;

public class AppointmentQrCodeService {
    private static final DateTimeFormatter QR_DATE_FORMAT = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    private final AppointmentLocationService locationService = new AppointmentLocationService();
    private final AppointmentPdfService appointmentPdfService = new AppointmentPdfService();
    private final Map<String, String> hostedProofUrlCache = new ConcurrentHashMap<>();

    public String buildQrCodeUrl(Appointment appointment) {
        String payload = buildProofUrl(appointment);
        String encodedPayload = URLEncoder.encode(payload, StandardCharsets.UTF_8);
        return "https://api.qrserver.com/v1/create-qr-code/?size=220x220&margin=0&data=" + encodedPayload;
    }

    public String buildProofUrl(Appointment appointment) {
        try {
            return hostedProofUrlCache.computeIfAbsent(cacheKey(appointment), ignored -> {
                try {
                    return appointmentPdfService.exportAppointmentProofHostedUrl(appointment);
                } catch (Exception e) {
                    throw new RuntimeException(e);
                }
            });
        } catch (RuntimeException e) {
            System.err.println("Could not create hosted appointment PDF proof: " + e.getMessage());
        }

        try {
            return AppointmentProofWebServer.getInstance().registerAppointment(appointment);
        } catch (Exception e) {
            System.err.println("Could not start appointment proof web server: " + e.getMessage());
            return buildPayload(appointment);
        }
    }

    private String cacheKey(Appointment appointment) {
        if (appointment == null) {
            return "null";
        }
        return appointment.getId() + "|"
                + safeValue(appointment.getStatus()) + "|"
                + (appointment.getAppointmentDate() == null ? "" : appointment.getAppointmentDate().getTime());
    }

    private String buildPayload(Appointment appointment) {
        String date = appointment.getAppointmentDate() == null
                ? "N/A"
                : appointment.getAppointmentDate().toLocalDateTime().format(QR_DATE_FORMAT);

        return "PinkShield Appointment\n"
                + "ID: " + appointment.getId() + "\n"
                + "Patient: " + safeValue(appointment.getPatientName()) + "\n"
                + "Doctor: " + safeValue(appointment.getDoctorName()) + "\n"
                + "Date: " + date + "\n"
                + "Status: " + safeValue(appointment.getStatus()) + "\n"
                + "Location: " + locationService.getClinicAddress() + "\n"
                + "Map: " + locationService.getDirectionsUrl();
    }

    private String safeValue(String value) {
        return value == null ? "" : value;
    }
}
