package tn.esprit.services;

import tn.esprit.entities.User;
import tn.esprit.utils.MyDB;

import java.nio.file.Path;
import java.sql.*;
import java.time.Instant;
import java.time.temporal.ChronoUnit;
import java.util.Locale;
import java.util.Map;
import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.ThreadLocalRandom;

public class AuthService {
    private static final int RESET_CODE_EXPIRY_MINUTES = 10;
    private static final int RESET_CODE_MAX_ATTEMPTS   = 5;
    private static final Map<String, ResetSession> RESET_SESSIONS = new ConcurrentHashMap<>();

    private final UserService            userService            = new UserService();
    private final EmailService           emailService           = new EmailService();
    private final FaceRecognitionService faceRecognitionService = new FaceRecognitionService();

    // ── Authenticate ──────────────────────────────────────────

    public User authenticate(String email, String password) {
        Connection conn = MyDB.getInstance().getConnection();
        if (conn == null) return null;
        User u = checkTable(conn, "admin",  email, password, UserService.ROLE_ADMIN);  if (u != null) return u;
              u = checkTable(conn, "doctor", email, password, UserService.ROLE_DOCTOR); if (u != null) return u;
        return    checkTable(conn, "`user`",email, password, UserService.ROLE_USER);
    }

    public boolean emailExists(String email) { return userService.emailExists(email); }

    // ── Password reset ────────────────────────────────────────

    public String sendPasswordResetCode(String email) {
        String ne = ne(email);
        if (ne.isEmpty()) return "Email is required.";
        if (!userService.emailExists(ne)) return "No account found for that email address.";
        String code  = String.format("%06d", ThreadLocalRandom.current().nextInt(0, 1_000_000));
        String error = emailService.sendPasswordResetCode(ne, code);
        if (error != null) return error;
        RESET_SESSIONS.put(ne, new ResetSession(code,
                Instant.now().plus(RESET_CODE_EXPIRY_MINUTES, ChronoUnit.MINUTES)));
        return null;
    }

    public String resetPasswordWithCode(String email, String code, String newPassword) {
        String ne = ne(email);
        if (ne.isEmpty() || code == null || code.isBlank() || newPassword == null || newPassword.isBlank())
            return "All fields are required.";
        ResetSession session = RESET_SESSIONS.get(ne);
        if (session == null || session.isExpired()) { RESET_SESSIONS.remove(ne); return "Request a new verification code first."; }
        if (!session.code.equals(code.trim())) {
            int att = ++session.attempts;
            if (att >= RESET_CODE_MAX_ATTEMPTS) { RESET_SESSIONS.remove(ne); return "Too many invalid attempts. Request a new code."; }
            return "Verification code is invalid.";
        }
        String err = updatePassword(ne, newPassword);
        if (err != null) return err;
        RESET_SESSIONS.remove(ne);
        return null;
    }

    // ── Registration ──────────────────────────────────────────

    public boolean registerPatient(String fullName, String email, String password, String phone, String address) {
        return registerPatientWithFace(fullName, email, password, phone, address, null).success();
    }

    public PatientRegistrationResult registerPatientWithFace(String fullName, String email, String password,
                                                             String phone, String address, Path facePhotoPath) {
        User user = new User();
        user.setRole(UserService.ROLE_USER); user.setFullName(fullName); user.setEmail(email);
        user.setPassword(password); user.setPhone(phone); user.setAddress(address);
        String err = userService.validateUser(user, password, false);
        if (err != null) return PatientRegistrationResult.failure(err);
        if (!userService.createUser(user)) return PatientRegistrationResult.failure("Registration failed. Please try again.");
        if (facePhotoPath == null) return PatientRegistrationResult.success(false, "Registration successful.");
        var fr = faceRecognitionService.processUploadedFace(facePhotoPath, String.valueOf(user.getId()));
        if (fr.imagePath() == null || fr.imagePath().isBlank())
            return PatientRegistrationResult.success(false, fr.message() != null ? fr.message() : "Registration successful, face not stored.");
        userService.updateUserFaceData(user.getId(), fr.imagePath(), fr.faceToken());
        return PatientRegistrationResult.success(fr.faceToken() != null && !fr.faceToken().isBlank(),
                "Registration successful. Face login enabled.");
    }

    public boolean registerDoctor(String firstName, String lastName, String email, String password, String speciality) {
        User user = new User();
        user.setRole(UserService.ROLE_DOCTOR); user.setFirstName(firstName); user.setLastName(lastName);
        user.setFullName((firstName + " " + lastName).trim()); user.setEmail(email);
        user.setPassword(password); user.setSpeciality(speciality);
        String err = userService.validateUser(user, password, false);
        return err == null && userService.createUser(user);
    }

    // ── Face authentication ───────────────────────────────────

    public FaceAuthenticationResult authenticateWithFace(String email, Path livePhoto) {
        String ne = ne(email);
        if (ne.isEmpty()) return FaceAuthenticationResult.failure("Email is required.");
        if (livePhoto == null) return FaceAuthenticationResult.failure("Select a face image.");
        if (!faceRecognitionService.isConfigured()) return FaceAuthenticationResult.failure("Face recognition not configured.");
        User user = userService.getUserByEmail(ne, UserService.ROLE_USER);
        if (user == null || user.getFaceImagePath() == null || user.getFaceImagePath().isBlank())
            return FaceAuthenticationResult.failure("No enrolled face for this account.");
        var cmp = faceRecognitionService.compareFaces(user.getFaceImagePath(), livePhoto);
        if (!cmp.isSuccessful()) return FaceAuthenticationResult.failure(cmp.message());
        if (cmp.confidence() < faceRecognitionService.getMatchThreshold())
            return FaceAuthenticationResult.failure("Face verification failed. Score: " + String.format("%.1f", cmp.confidence()) + "%");
        return new FaceAuthenticationResult(true, user, cmp.confidence(), "Face verified.");
    }

    // ── Internals ─────────────────────────────────────────────

    private User checkTable(Connection conn, String table, String email, String password, String role) {
        try (PreparedStatement ps = conn.prepareStatement("SELECT * FROM " + table + " WHERE email=?")) {
            ps.setString(1, email);
            try (ResultSet rs = ps.executeQuery()) {
                if (!rs.next()) return null;
                if (!rs.getString("password").equals(password)) return null;
                User u = new User();
                u.setId(rs.getInt("id")); u.setEmail(email); u.setPassword(rs.getString("password")); u.setRole(role);
                try { u.setCreatedAt(rs.getTimestamp("created_at")); } catch (SQLException ignored) {}
                if (UserService.ROLE_ADMIN.equals(role)) {
                    u.setFirstName(rs.getString("first_name")); u.setLastName(rs.getString("last_name"));
                    u.setFullName((u.getFirstName() + " " + u.getLastName()).trim());
                } else if (UserService.ROLE_DOCTOR.equals(role)) {
                    u.setFirstName(rs.getString("first_name")); u.setLastName(rs.getString("last_name"));
                    u.setFullName((u.getFirstName() + " " + u.getLastName()).trim());
                    u.setSpeciality(rs.getString("speciality"));
                } else {
                    u.setFullName(rs.getString("full_name")); u.setPhone(rs.getString("phone"));
                    u.setAddress(rs.getString("address"));
                    try { u.setFaceImagePath(rs.getString("face_image_path")); } catch (SQLException ignored) {}
                    try { u.setFaceToken(rs.getString("face_token")); } catch (SQLException ignored) {}
                }
                return u;
            }
        } catch (SQLException e) { System.err.println("checkTable " + table + ": " + e.getMessage()); return null; }
    }

    private String updatePassword(String email, String newPassword) {
        Connection conn = MyDB.getInstance().getConnection();
        if (conn == null) return "Database unavailable.";
        boolean updated = updatePwdTable(conn, "admin", email, newPassword)
                       || updatePwdTable(conn, "doctor", email, newPassword)
                       || updatePwdTable(conn, "`user`", email, newPassword);
        return updated ? null : "Failed to update password.";
    }

    private boolean updatePwdTable(Connection conn, String table, String email, String pwd) {
        try (PreparedStatement ps = conn.prepareStatement("UPDATE " + table + " SET password=? WHERE email=?")) {
            ps.setString(1, pwd); ps.setString(2, email); return ps.executeUpdate() > 0;
        } catch (SQLException e) { return false; }
    }

    private String ne(String email) { return email == null ? "" : email.trim().toLowerCase(Locale.ROOT); }

    // ── Records / inner types ─────────────────────────────────

    public record PatientRegistrationResult(boolean success, boolean faceEnrolled, String message) {
        public static PatientRegistrationResult success(boolean face, String msg) { return new PatientRegistrationResult(true, face, msg); }
        public static PatientRegistrationResult failure(String msg)               { return new PatientRegistrationResult(false, false, msg); }
    }

    public record FaceAuthenticationResult(boolean success, User user, double confidence, String message) {
        public static FaceAuthenticationResult failure(String msg) { return new FaceAuthenticationResult(false, null, 0, msg); }
    }

    private static final class ResetSession {
        final String code; final Instant expiresAt; int attempts;
        ResetSession(String code, Instant expiresAt) { this.code = code; this.expiresAt = expiresAt; }
        boolean isExpired() { return Instant.now().isAfter(expiresAt); }
    }
}
