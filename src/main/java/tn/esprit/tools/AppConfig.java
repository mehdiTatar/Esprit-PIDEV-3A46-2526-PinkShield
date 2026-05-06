package tn.esprit.tools;

import java.io.File;
import java.io.InputStream;
import java.util.Properties;

public class AppConfig {

    private static final Properties PROPS = new Properties();

    static {
        try (InputStream is = AppConfig.class.getResourceAsStream("/app.properties")) {
            if (is != null) PROPS.load(is);
        } catch (Exception ignored) {}
    }

    // Root-relative upload path — matches Symfony's structure
    public static final String BLOG_UPLOADS_RELATIVE = "/uploads/blog";

    /**
     * Returns the root directory used as the base for uploads.
     * If symfony.public.dir is set in app.properties, that is used.
     * Otherwise falls back to the project's working directory (project root
     * when launched via 'mvn javafx:run').
     */
    public static String getPublicDir() {
        String configured = PROPS.getProperty("symfony.public.dir", "").trim();
        return configured.isEmpty() ? System.getProperty("user.dir") : configured;
    }

    /** Absolute path to the blog uploads folder on disk. */
    public static String getBlogUploadsDir() {
        return getPublicDir() + BLOG_UPLOADS_RELATIVE;
    }

    /**
     * Resolves a DB image_path (e.g. "/uploads/blog/abc.jpg") to a File.
     * Returns null if the path is blank.
     */
    public static File resolveImageFile(String imagePath) {
        if (imagePath == null || imagePath.isBlank()) return null;
        String full = (getPublicDir() + imagePath)
                .replace("/", File.separator)
                .replace("\\", File.separator);
        return new File(full);
    }

    /** Always ready — falls back to project dir when Symfony is not configured. */
    public static boolean isConfigured() {
        return new File(getPublicDir()).isDirectory();
    }

    /** HuggingFace API token for AI comment moderation (from app.properties). */
    public static String getHuggingFaceApiKey() {
        return PROPS.getProperty("huggingface.api.key", "").trim();
    }

    public static String getMailSmtpHost() {
        return PROPS.getProperty("mail.smtp.host", "smtp.gmail.com").trim();
    }

    public static int getMailSmtpPort() {
        try { return Integer.parseInt(PROPS.getProperty("mail.smtp.port", "587").trim()); }
        catch (NumberFormatException e) { return 587; }
    }

    public static String getMailFromEmail() {
        return PROPS.getProperty("mail.from.email", "").trim();
    }

    public static String getMailFromPassword() {
        return PROPS.getProperty("mail.from.password", "").trim();
    }
}
