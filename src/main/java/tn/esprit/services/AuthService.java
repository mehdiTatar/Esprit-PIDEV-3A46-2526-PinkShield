package tn.esprit.services;

import tn.esprit.entities.User;
import tn.esprit.utils.MyDB;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.Instant;
import java.time.temporal.ChronoUnit;
import java.util.Locale;
import java.util.Map;
import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.ThreadLocalRandom;

public class AuthService {
    private static final int RESET_CODE_EXPIRATION_MINUTES = 10;
    private static final int RESET_CODE_MAX_ATTEMPTS = 5;
    private static final Map<String, PasswordResetSession> PASSWORD_RESET_SESSIONS = new ConcurrentHashMap<>();

    private final UserService userService = new UserService();
    private final EmailService emailService = new EmailService();

    public User authenticate(String email, String password) {
        Connection connection = MyDB.getInstance().getConnection();
        if (connection == null) {
            return null;
        }

        User user = checkTableForUser(connection, "admin", email, password, UserService.ROLE_ADMIN);
        if (user != null) {
            return user;
        }

        user = checkTableForUser(connection, "doctor", email, password, UserService.ROLE_DOCTOR);
        if (user != null) {
            return user;
        }

        return checkTableForUser(connection, "user", email, password, UserService.ROLE_USER);
    }

    public boolean emailExists(String email) {
        return userService.emailExists(email);
    }

    public String sendPasswordResetCode(String email) {
        String normalizedEmail = normalizeEmail(email);
        if (normalizedEmail.isEmpty()) {
            return "Email is required.";
        }
        if (!userService.emailExists(normalizedEmail)) {
            return "No account was found for that email address.";
        }

        String verificationCode = generateVerificationCode();
        String emailError = emailService.sendPasswordResetCode(normalizedEmail, verificationCode);
        if (emailError != null) {
            return emailError;
        }

        PASSWORD_RESET_SESSIONS.put(
                sessionKey(normalizedEmail),
                new PasswordResetSession(
                        verificationCode,
                        Instant.now().plus(RESET_CODE_EXPIRATION_MINUTES, ChronoUnit.MINUTES)
                )
        );
        return null;
    }

    public String resetPasswordWithCode(String email, String verificationCode, String newPassword) {
        String normalizedEmail = normalizeEmail(email);
        if (normalizedEmail.isEmpty()) {
            return "Email is required.";
        }
        if (verificationCode == null || verificationCode.trim().isEmpty()) {
            return "Verification code is required.";
        }
        if (newPassword == null || newPassword.trim().isEmpty()) {
            return "A new password is required.";
        }

        PasswordResetSession session = getActiveResetSession(normalizedEmail);
        if (session == null) {
            return "Request a new verification code first.";
        }

        if (!session.code().equals(verificationCode.trim())) {
            int attempts = session.registerFailedAttempt();
            if (attempts >= RESET_CODE_MAX_ATTEMPTS) {
                PASSWORD_RESET_SESSIONS.remove(sessionKey(normalizedEmail));
                return "Too many invalid verification attempts. Request a new code.";
            }
            return "Verification code is invalid.";
        }

        String updateError = updatePassword(normalizedEmail, newPassword);
        if (updateError != null) {
            return updateError;
        }

        PASSWORD_RESET_SESSIONS.remove(sessionKey(normalizedEmail));
        return null;
    }

    public boolean resetPassword(String email, String newPassword) {
        return updatePassword(email, newPassword) == null;
    }

    private String updatePassword(String email, String newPassword) {
        Connection connection = MyDB.getInstance().getConnection();
        if (connection == null) {
            return "Database connection is unavailable.";
        }

        String normalizedEmail = normalizeEmail(email);
        if (normalizedEmail.isEmpty() || newPassword == null || newPassword.trim().isEmpty()) {
            return "Email and password are required.";
        }

        boolean updated = updatePasswordForTable(connection, "admin", normalizedEmail, newPassword)
                || updatePasswordForTable(connection, "doctor", normalizedEmail, newPassword)
                || updatePasswordForTable(connection, "user", normalizedEmail, newPassword);

        return updated ? null : "Failed to update the password. Please try again.";
    }

    public boolean register(String fullName, String email, String password, String phone, String address) {
        User user = new User();
        user.setRole(UserService.ROLE_USER);
        user.setFullName(fullName);
        user.setEmail(email);
        user.setPassword(password);
        user.setPhone(phone);
        user.setAddress(address);

        String validationMessage = userService.validateUser(user, password, false);
        return validationMessage == null && userService.createUser(user);
    }

    public boolean registerPatient(String fullName, String email, String password, String phone, String address) {
        return register(fullName, email, password, phone, address);
    }

    public boolean registerDoctor(String firstName, String lastName, String email, String password, String speciality) {
        User user = new User();
        user.setRole(UserService.ROLE_DOCTOR);
        user.setFirstName(firstName);
        user.setLastName(lastName);
        user.setFullName((firstName + " " + lastName).trim());
        user.setEmail(email);
        user.setPassword(password);
        user.setSpeciality(speciality);

        String validationMessage = userService.validateUser(user, password, false);
        return validationMessage == null && userService.createUser(user);
    }

    private User checkTableForUser(Connection connection, String tableName, String email, String password, String role) {
        String query = "SELECT * FROM " + tableName + " WHERE email = ?";
        try (PreparedStatement stmt = connection.prepareStatement(query)) {
            stmt.setString(1, email);
            try (ResultSet rs = stmt.executeQuery()) {
                if (!rs.next()) {
                    return null;
                }

                String storedPassword = rs.getString("password");
                if (!storedPassword.equals(password)) {
                    return null;
                }

                User user = new User();
                user.setId(rs.getInt("id"));
                user.setEmail(rs.getString("email"));
                user.setPassword(storedPassword);
                user.setRole(role);

                if (UserService.ROLE_ADMIN.equals(role)) {
                    user.setFirstName(rs.getString("first_name"));
                    user.setLastName(rs.getString("last_name"));
                    user.setFullName((user.getFirstName() + " " + user.getLastName()).trim());
                } else if (UserService.ROLE_DOCTOR.equals(role)) {
                    user.setFirstName(rs.getString("first_name"));
                    user.setLastName(rs.getString("last_name"));
                    user.setFullName((user.getFirstName() + " " + user.getLastName()).trim());
                    user.setSpeciality(rs.getString("speciality"));
                } else {
                    user.setFullName(rs.getString("full_name"));
                    user.setPhone(rs.getString("phone"));
                    user.setAddress(rs.getString("address"));
                }

                return user;
            }
        } catch (SQLException e) {
            System.err.println("Error during authentication: " + e.getMessage());
            return null;
        }
    }

    private PasswordResetSession getActiveResetSession(String email) {
        String key = sessionKey(email);
        PasswordResetSession session = PASSWORD_RESET_SESSIONS.get(key);
        if (session == null) {
            return null;
        }

        if (session.isExpired()) {
            PASSWORD_RESET_SESSIONS.remove(key);
            return null;
        }

        return session;
    }

    private String generateVerificationCode() {
        return String.format("%06d", ThreadLocalRandom.current().nextInt(0, 1_000_000));
    }

    private String normalizeEmail(String email) {
        return email == null ? "" : email.trim().toLowerCase(Locale.ROOT);
    }

    private String sessionKey(String email) {
        return normalizeEmail(email);
    }

    private boolean updatePasswordForTable(Connection connection, String tableName, String email, String newPassword) {
        String query = "UPDATE " + tableName + " SET password = ? WHERE email = ?";
        try (PreparedStatement stmt = connection.prepareStatement(query)) {
            stmt.setString(1, newPassword);
            stmt.setString(2, email);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("Error updating password in " + tableName + ": " + e.getMessage());
            return false;
        }
    }

    private static final class PasswordResetSession {
        private final String code;
        private final Instant expiresAt;
        private int failedAttempts;

        private PasswordResetSession(String code, Instant expiresAt) {
            this.code = code;
            this.expiresAt = expiresAt;
        }

        private String code() {
            return code;
        }

        private boolean isExpired() {
            return Instant.now().isAfter(expiresAt);
        }

        private int registerFailedAttempt() {
            failedAttempts += 1;
            return failedAttempts;
        }
    }
}
