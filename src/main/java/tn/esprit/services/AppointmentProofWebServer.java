package tn.esprit.services;

import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpServer;
import tn.esprit.entities.Appointment;

import java.io.IOException;
import java.io.OutputStream;
import java.net.Inet4Address;
import java.net.InetAddress;
import java.net.InetSocketAddress;
import java.net.NetworkInterface;
import java.nio.charset.StandardCharsets;
import java.time.format.DateTimeFormatter;
import java.util.Enumeration;
import java.util.Map;
import java.util.concurrent.ConcurrentHashMap;

public final class AppointmentProofWebServer {
    private static final DateTimeFormatter DATE_FORMAT = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");
    private static final int PREFERRED_PORT = 8765;
    private static volatile AppointmentProofWebServer instance;

    private final HttpServer server;
    private final String baseUrl;
    private final Map<Integer, Appointment> appointmentsById = new ConcurrentHashMap<>();
    private final AppointmentLocationService locationService = new AppointmentLocationService();

    private AppointmentProofWebServer() throws IOException {
        server = createServer();
        server.createContext("/appointment", this::serveAppointmentProof);
        server.setExecutor(null);
        server.start();
        baseUrl = "http://" + resolveReachableHost() + ":" + server.getAddress().getPort();
    }

    public static AppointmentProofWebServer getInstance() throws IOException {
        AppointmentProofWebServer current = instance;
        if (current != null) {
            return current;
        }

        synchronized (AppointmentProofWebServer.class) {
            if (instance == null) {
                instance = new AppointmentProofWebServer();
            }
            return instance;
        }
    }

    public String registerAppointment(Appointment appointment) {
        if (appointment == null) {
            return baseUrl + "/appointment/not-found";
        }
        appointmentsById.put(appointment.getId(), appointment);
        return baseUrl + "/appointment/" + appointment.getId();
    }

    private void serveAppointmentProof(HttpExchange exchange) throws IOException {
        String[] parts = exchange.getRequestURI().getPath().split("/");
        if (parts.length < 3) {
            send(exchange, 404, "Appointment proof not found.");
            return;
        }

        int appointmentId;
        try {
            appointmentId = Integer.parseInt(parts[2]);
        } catch (NumberFormatException e) {
            send(exchange, 404, "Appointment proof not found.");
            return;
        }

        Appointment appointment = appointmentsById.get(appointmentId);
        if (appointment == null) {
            send(exchange, 404, buildMissingHtml(appointmentId));
            return;
        }

        send(exchange, 200, buildProofHtml(appointment));
    }

    private void send(HttpExchange exchange, int statusCode, String body) throws IOException {
        byte[] bytes = body.getBytes(StandardCharsets.UTF_8);
        exchange.getResponseHeaders().set("Content-Type", "text/html; charset=UTF-8");
        exchange.getResponseHeaders().set("Cache-Control", "no-store, no-cache, must-revalidate");
        exchange.sendResponseHeaders(statusCode, bytes.length);
        try (OutputStream outputStream = exchange.getResponseBody()) {
            outputStream.write(bytes);
        }
    }

    private String buildProofHtml(Appointment appointment) {
        String date = appointment.getAppointmentDate() == null
                ? "N/A"
                : appointment.getAppointmentDate().toLocalDateTime().format(DATE_FORMAT);
        String status = safe(appointment.getStatus()).toLowerCase();

        return """
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>PinkShield Appointment Proof</title>
                    <style>
                        * { box-sizing: border-box; }
                        body {
                            margin: 0;
                            min-height: 100vh;
                            font-family: Arial, Helvetica, sans-serif;
                            color: #172033;
                            background: linear-gradient(135deg, #fff7fb 0%, #eef8ff 100%);
                            padding: 22px;
                        }
                        .card {
                            max-width: 760px;
                            margin: 0 auto;
                            background: #ffffff;
                            border: 1px solid #dbe5f1;
                            border-radius: 24px;
                            overflow: hidden;
                            box-shadow: 0 22px 60px rgba(17, 31, 52, 0.14);
                        }
                        .header {
                            padding: 34px 24px;
                            text-align: center;
                            color: #ffffff;
                            background: linear-gradient(135deg, #db4f8b 0%, #3b78d8 100%);
                        }
                        .brand { font-size: 28px; font-weight: 900; }
                        .subtitle { margin-top: 8px; font-size: 14px; font-weight: 700; opacity: .92; }
                        .content { padding: 24px; }
                        .status-row { text-align: center; margin-bottom: 22px; }
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
                        .grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
                        .item { border: 1px solid #e4ebf4; border-radius: 16px; padding: 16px; background: #fbfdff; }
                        .wide { grid-column: 1 / -1; }
                        .label { color: #7b8da8; font-size: 11px; font-weight: 900; text-transform: uppercase; margin-bottom: 6px; }
                        .value { color: #172033; font-size: 16px; font-weight: 800; line-height: 1.4; }
                        .footer { margin-top: 22px; color: #6b7d95; font-size: 12px; font-weight: 700; text-align: center; }
                        @media (max-width: 640px) { .grid { grid-template-columns: 1fr; } .brand { font-size: 23px; } }
                    </style>
                </head>
                <body>
                    <main class="card">
                        <section class="header">
                            <div class="brand">PinkShield Appointment Proof</div>
                            <div class="subtitle">Official consultation booking document</div>
                        </section>
                        <section class="content">
                            <div class="status-row"><span class="status %s">%s</span></div>
                            <div class="grid">
                                <div class="item"><div class="label">Appointment ID</div><div class="value">%s</div></div>
                                <div class="item"><div class="label">Date & Time</div><div class="value">%s</div></div>
                                <div class="item"><div class="label">Patient</div><div class="value">%s</div></div>
                                <div class="item"><div class="label">Doctor</div><div class="value">%s</div></div>
                                <div class="item wide"><div class="label">Clinic Location</div><div class="value">%s</div></div>
                                <div class="item wide"><div class="label">Notes</div><div class="value">%s</div></div>
                            </div>
                            <div class="footer">This page is served by the PinkShield app while it is running.</div>
                        </section>
                    </main>
                </body>
                </html>
                """.formatted(
                html(status),
                html(status),
                appointment.getId(),
                html(date),
                html(safe(appointment.getPatientName())),
                html(safe(appointment.getDoctorName())),
                html(locationService.getClinicAddress()),
                html(safe(appointment.getNotes()).isBlank() ? "No additional notes." : appointment.getNotes())
        );
    }

    private String buildMissingHtml(int appointmentId) {
        return """
                <!DOCTYPE html>
                <html><head><meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Appointment Proof Unavailable</title></head>
                <body style="font-family:Arial;padding:28px;background:#f4f7fb;color:#172033;">
                <h1>PinkShield Appointment Proof</h1>
                <p>Appointment #%s is not available from this app session.</p>
                <p>Open PinkShield, select the appointment again, then scan the refreshed QR code.</p>
                </body></html>
                """.formatted(appointmentId);
    }

    private String resolveReachableHost() {
        try {
            Enumeration<NetworkInterface> interfaces = NetworkInterface.getNetworkInterfaces();
            String fallbackAddress = null;
            while (interfaces.hasMoreElements()) {
                NetworkInterface networkInterface = interfaces.nextElement();
                if (!isUsableInterface(networkInterface)) {
                    continue;
                }
                Enumeration<InetAddress> addresses = networkInterface.getInetAddresses();
                while (addresses.hasMoreElements()) {
                    InetAddress address = addresses.nextElement();
                    if (!(address instanceof Inet4Address) || address.isLoopbackAddress()) {
                        continue;
                    }
                    String hostAddress = address.getHostAddress();
                    if (address.isSiteLocalAddress()) {
                        return hostAddress;
                    }
                    if (fallbackAddress == null) {
                        fallbackAddress = hostAddress;
                    }
                }
            }
            if (fallbackAddress != null) {
                return fallbackAddress;
            }
        } catch (IOException ignored) {
            // Fallback below.
        }
        return "localhost";
    }

    private HttpServer createServer() throws IOException {
        try {
            return HttpServer.create(new InetSocketAddress("0.0.0.0", PREFERRED_PORT), 0);
        } catch (IOException preferredPortError) {
            System.err.println("Appointment proof port " + PREFERRED_PORT + " unavailable, using a fallback port: "
                    + preferredPortError.getMessage());
            return HttpServer.create(new InetSocketAddress("0.0.0.0", 0), 0);
        }
    }

    private boolean isUsableInterface(NetworkInterface networkInterface) throws IOException {
        if (!networkInterface.isUp() || networkInterface.isLoopback() || networkInterface.isVirtual()) {
            return false;
        }
        String searchable = (safe(networkInterface.getName()) + " " + safe(networkInterface.getDisplayName())).toLowerCase();
        return !searchable.contains("virtual")
                && !searchable.contains("vmware")
                && !searchable.contains("virtualbox")
                && !searchable.contains("hyper-v")
                && !searchable.contains("docker")
                && !searchable.contains("wsl")
                && !searchable.contains("vpn")
                && !searchable.contains("tunnel")
                && !searchable.contains("bluetooth")
                && !searchable.contains("loopback");
    }

    private String safe(String value) {
        return value == null ? "" : value;
    }

    private String html(String value) {
        return safe(value)
                .replace("&", "&amp;")
                .replace("<", "&lt;")
                .replace(">", "&gt;")
                .replace("\"", "&quot;");
    }
}
