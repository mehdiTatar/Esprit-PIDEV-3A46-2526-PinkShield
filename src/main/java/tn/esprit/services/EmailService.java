package tn.esprit.services;

import jakarta.mail.*;
import jakarta.mail.internet.InternetAddress;
import jakarta.mail.internet.MimeMessage;

import java.io.IOException;
import java.io.InputStream;
import java.nio.file.Files;
import java.nio.file.Path;
import java.util.Properties;

/**
 * Handles password-reset verification code emails.
 * Configured via mail.properties (SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASSWORD, SMTP_FROM).
 */
public class EmailService {
    private static final String CONFIG_FILE = "mail.properties";

    public String sendPasswordResetCode(String recipientEmail, String verificationCode) {
        SmtpConfig cfg = loadConfig();
        if (!cfg.isConfigured()) return "Email not configured. Add SMTP settings in mail.properties.";

        Properties props = new Properties();
        props.put("mail.smtp.host",              cfg.host());
        props.put("mail.smtp.port",              cfg.port());
        props.put("mail.smtp.auth",              Boolean.toString(cfg.auth()));
        props.put("mail.smtp.starttls.enable",   Boolean.toString(cfg.startTls()));
        props.put("mail.smtp.starttls.required", Boolean.toString(cfg.startTls()));
        props.put("mail.smtp.ssl.enable",        Boolean.toString(cfg.ssl()));
        props.put("mail.smtp.ssl.protocols",     "TLSv1.2 TLSv1.3");
        props.put("mail.smtp.ssl.trust",         cfg.host());
        props.put("mail.smtp.connectiontimeout", "10000");
        props.put("mail.smtp.timeout",           "10000");

        Session session = cfg.auth()
                ? Session.getInstance(props, new Authenticator() {
                    @Override protected PasswordAuthentication getPasswordAuthentication() {
                        return new PasswordAuthentication(cfg.user(), cfg.password());
                    }
                })
                : Session.getInstance(props);

        try {
            Message msg = new MimeMessage(session);
            msg.setFrom(new InternetAddress(cfg.from()));
            msg.setRecipients(Message.RecipientType.TO, InternetAddress.parse(recipientEmail));
            msg.setSubject("PinkShield — Password Reset Code");
            msg.setText("Your verification code is: " + verificationCode
                    + "\n\nThis code expires in 10 minutes.\n"
                    + "If you did not request a password reset, ignore this email.");
            Transport.send(msg);
            return null;
        } catch (MessagingException e) {
            return "Failed to send email: " + e.getMessage();
        }
    }

    private SmtpConfig loadConfig() {
        Properties p = new Properties();
        try (InputStream is = EmailService.class.getClassLoader().getResourceAsStream(CONFIG_FILE)) {
            if (is != null) p.load(is);
        } catch (IOException ignored) {}
        Path ext = Path.of(System.getProperty("user.dir"), CONFIG_FILE);
        if (Files.isRegularFile(ext)) {
            try (InputStream is = Files.newInputStream(ext)) { p.load(is); } catch (IOException ignored) {}
        }
        return new SmtpConfig(
                read("SMTP_HOST",     "",    p), read("SMTP_PORT",     "587", p),
                read("SMTP_USER",     "",    p), read("SMTP_PASSWORD",  "",    p),
                read("SMTP_FROM",     "",    p),
                Boolean.parseBoolean(read("SMTP_AUTH",     "true",  p)),
                Boolean.parseBoolean(read("SMTP_STARTTLS", "true",  p)),
                Boolean.parseBoolean(read("SMTP_SSL",      "false", p))
        );
    }

    private String read(String key, String def, Properties p) {
        String v = System.getProperty(key); if (v != null && !v.isBlank()) return v.trim();
              v = System.getenv(key);       if (v != null && !v.isBlank()) return v.trim();
              v = p.getProperty(key);       if (v != null && !v.isBlank()) return v.trim();
        return def;
    }

    private record SmtpConfig(String host, String port, String user, String password, String from,
                               boolean auth, boolean startTls, boolean ssl) {
        boolean isConfigured() {
            if (host.isBlank() || port.isBlank() || from.isBlank()) return false;
            return !auth || (!user.isBlank() && !password.isBlank());
        }
    }
}
