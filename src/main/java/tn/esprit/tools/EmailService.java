package tn.esprit.tools;

import tn.esprit.entities.BlogPost;
import tn.esprit.entities.Comment;

import jakarta.mail.*;
import jakarta.mail.internet.InternetAddress;
import jakarta.mail.internet.MimeMessage;
import java.util.Properties;

/**
 * Sends an email to the blog post author whenever a new comment is posted
 * on one of their articles.
 *
 * The method returns immediately — the SMTP handshake runs on a short-lived
 * daemon thread so the JavaFX UI thread is never blocked.
 *
 * Configure in app.properties:
 *   mail.smtp.host     = smtp.gmail.com
 *   mail.smtp.port     = 587
 *   mail.from.email    = your-sender@gmail.com
 *   mail.from.password = Gmail App Password (16 chars, no spaces)
 */
public final class EmailService {

    private static final String BRAND   = "#c0396b";
    private static final String BG      = "#1a1a2e";
    private static final String CARD_BG = "#16213e";
    private static final String TEXT    = "#e8e8e8";

    private EmailService() {}

    // ── Public API ────────────────────────────────────────────

    /**
     * Notifies the blog post author that someone commented on their article.
     * Returns immediately; email is sent on a daemon thread.
     */
    public static void notifyPostAuthor(BlogPost post, Comment comment) {
        String to = post.getAuthorEmail();
        if (to == null || to.isBlank()) {
            System.err.println("[EmailService] Post has no author email — skipping notification.");
            return;
        }
        String subject = "New comment on your article: " + post.getTitle();
        String body    = buildHtml(post, comment);
        fireAndForget(to, subject, body);
    }

    // ── Thread dispatch ───────────────────────────────────────

    private static void fireAndForget(String to, String subject, String htmlBody) {
        Thread t = new Thread(() -> {
            try {
                send(to, subject, htmlBody);
                System.out.println("[EmailService] Sent to " + to + " — " + subject);
            } catch (Exception e) {
                System.err.println("[EmailService] Failed: " + e.getMessage());
            }
        });
        t.setDaemon(true);
        t.setName("email-notify");
        t.start();
    }

    // ── SMTP ──────────────────────────────────────────────────

    private static void send(String to, String subject, String htmlBody)
            throws Exception {

        String host     = AppConfig.getMailSmtpHost();
        int    port     = AppConfig.getMailSmtpPort();
        String fromAddr = AppConfig.getMailFromEmail();
        String password = AppConfig.getMailFromPassword();

        if (fromAddr.isEmpty() || password.isEmpty()) {
            System.err.println("[EmailService] mail.from.email / mail.from.password not configured in app.properties.");
            return;
        }

        Properties props = new Properties();
        props.put("mail.smtp.host",              host);
        props.put("mail.smtp.port",              String.valueOf(port));
        props.put("mail.smtp.auth",              "true");
        props.put("mail.smtp.starttls.enable",   "true");
        props.put("mail.smtp.starttls.required", "true");
        props.put("mail.smtp.ssl.protocols",     "TLSv1.2 TLSv1.3");
        props.put("mail.smtp.connectiontimeout", "10000");
        props.put("mail.smtp.timeout",           "15000");
        props.put("mail.smtp.writetimeout",      "10000");

        Session session = Session.getInstance(props, new Authenticator() {
            @Override
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication(fromAddr, password);
            }
        });

        MimeMessage msg = new MimeMessage(session);
        msg.setFrom(new InternetAddress(fromAddr, "PinkShield Blog"));
        msg.setRecipients(Message.RecipientType.TO, InternetAddress.parse(to, false));
        msg.setSubject(subject, "UTF-8");
        msg.setContent(htmlBody, "text/html; charset=UTF-8");

        Transport.send(msg);
    }

    // ── HTML template ─────────────────────────────────────────

    private static String buildHtml(BlogPost post, Comment comment) {
        String authorName     = esc(post.getAuthorName());
        String postTitle      = esc(post.getTitle());
        String commenterName  = esc(comment.getAuthorName());
        String commenterEmail = esc(comment.getAuthorEmail());
        String commentText    = esc(comment.getContent());

        return "<!DOCTYPE html>" +
            "<html lang='en'><head><meta charset='UTF-8'>" +
            "<meta name='viewport' content='width=device-width,initial-scale=1'></head>" +
            "<body style='margin:0;padding:0;background:" + BG + ";font-family:Segoe UI,Arial,sans-serif;'>" +

            // Outer table
            "<table width='100%' cellpadding='0' cellspacing='0' border='0'" +
            " style='background:" + BG + ";padding:36px 0;'><tr><td align='center'>" +

            // Card
            "<table width='600' cellpadding='0' cellspacing='0' border='0'" +
            " style='background:" + CARD_BG + ";border-radius:12px;overflow:hidden;" +
            " border:1px solid #2a2a4a;max-width:600px;'>" +

            // Pink header stripe
            "<tr><td style='background:" + BRAND + ";padding:24px 32px;'>" +
            "<h1 style='margin:0;color:#fff;font-size:22px;font-weight:700;letter-spacing:1px;'>" +
            "PinkShield Blog</h1>" +
            "<p style='margin:4px 0 0;color:rgba(255,255,255,0.85);font-size:13px;'>New Comment Notification</p>" +
            "</td></tr>" +

            // Body
            "<tr><td style='padding:32px;color:" + TEXT + ";'>" +
            "<p style='margin:0 0 16px;font-size:16px;'>Hi <strong>" + authorName + "</strong>,</p>" +
            "<p style='margin:0 0 24px;font-size:15px;line-height:1.7;'>" +
            "Someone just left a comment on your article " +
            "<strong style='color:" + BRAND + ";'>&ldquo;" + postTitle + "&rdquo;</strong>." +
            "</p>" +

            // Comment box
            "<div style='background:#0f0f23;border-left:4px solid " + BRAND + ";" +
            " border-radius:6px;padding:16px 20px;margin-bottom:28px;'>" +
            "<p style='margin:0 0 8px;font-size:13px;color:#aaa;'>" +
            "<strong style='color:" + TEXT + ";'>" + commenterName + "</strong>" +
            " &lt;" + commenterEmail + "&gt;</p>" +
            "<p style='margin:0;font-size:14px;line-height:1.7;color:" + TEXT + ";'>" +
            commentText + "</p>" +
            "</div>" +

            "<p style='margin:0;font-size:13px;color:#888;'>" +
            "You can view and manage all comments from the Admin Panel.</p>" +
            "</td></tr>" +

            // Footer
            "<tr><td style='background:#0f0f23;padding:16px 32px;text-align:center;" +
            " border-top:1px solid #2a2a4a;'>" +
            "<p style='margin:0;font-size:12px;color:#555;'>" +
            "You received this because you are the author of this post. " +
            "&copy; 2025 PinkShield Blog.</p>" +
            "</td></tr>" +

            "</table></td></tr></table></body></html>";
    }

    private static String esc(String s) {
        if (s == null) return "";
        return s.replace("&", "&amp;")
                .replace("<", "&lt;")
                .replace(">", "&gt;")
                .replace("\"", "&quot;")
                .replace("'", "&#39;");
    }
}
