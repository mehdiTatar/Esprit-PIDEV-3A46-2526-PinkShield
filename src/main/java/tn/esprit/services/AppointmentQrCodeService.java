package tn.esprit.services;

import tn.esprit.entities.Appointment;

import java.net.URLEncoder;
import java.nio.charset.StandardCharsets;
import java.time.format.DateTimeFormatter;

public class AppointmentQrCodeService {
    private static final DateTimeFormatter QR_DATE_FORMAT = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    private final AppointmentLocationService locationService = new AppointmentLocationService();

    public String buildQrCodeUrl(Appointment appointment) {
        String payload = buildPayload(appointment);
        String encodedPayload = URLEncoder.encode(payload, StandardCharsets.UTF_8);
        return "https://api.qrserver.com/v1/create-qr-code/?size=220x220&margin=0&data=" + encodedPayload;
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
