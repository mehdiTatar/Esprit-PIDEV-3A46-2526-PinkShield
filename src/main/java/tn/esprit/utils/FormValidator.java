package tn.esprit.utils;

import javafx.scene.control.*;
import javafx.scene.layout.VBox;

import java.util.regex.Pattern;

public class FormValidator {

    private static final Pattern EMAIL_PATTERN =
            Pattern.compile("^[A-Za-z0-9+_.-]+@(.+)$");
    private static final Pattern PHONE_PATTERN =
            Pattern.compile("^\\d{8,20}$");

    // ── Static helpers ────────────────────────────────────────

    public static boolean isValidEmail(String email) {
        return EMAIL_PATTERN.matcher(email).matches();
    }

    public static boolean isValidPhone(String phone) {
        return phone != null && PHONE_PATTERN.matcher(phone.replaceAll("\\D", "")).matches();
    }

    public static void markInvalid(Control field) {
        if (field instanceof TextInputControl f) {
            f.setStyle("-fx-border-color: #ff4444; -fx-border-width: 2;");
        } else if (field instanceof ComboBox<?> cb) {
            cb.setStyle("-fx-border-color: #ff4444; -fx-border-width: 2;");
        }
    }

    public static void clearFieldState(Control field) {
        field.setStyle("");
    }

    public static void clearStates(Control... fields) {
        for (Control f : fields) clearFieldState(f);
    }

    public static void setMessage(Label label, String message, boolean isError) {
        if (label == null) return;
        label.setText(message);
        label.setStyle(isError
                ? "-fx-text-fill: #ff6b6b; -fx-padding: 10;"
                : "-fx-text-fill: #4ade80; -fx-padding: 10;");
        label.setVisible(!message.isEmpty());
        label.setManaged(!message.isEmpty());
    }

    public static void attachClearOnInput(Label feedbackLabel, Control... fields) {
        for (Control field : fields) {
            if (field instanceof TextInputControl f) {
                f.textProperty().addListener((obs, o, n) -> setMessage(feedbackLabel, "", true));
            }
        }
    }

    // ── Instance helpers ──────────────────────────────────────

    public void showError(TextInputControl field, String message) {
        field.setStyle("-fx-border-color: #ff4444; -fx-border-width: 2; -fx-padding: 10;");
        getOrCreateLabel(field).setText("⚠ " + message);
        getOrCreateLabel(field).setVisible(true);
    }

    public void clearError(TextInputControl field) {
        field.setStyle("");
        getOrCreateLabel(field).setVisible(false);
    }

    public void showSuccess(TextInputControl field) {
        field.setStyle("-fx-border-color: #22c55e; -fx-border-width: 2;");
    }

    private Label getOrCreateLabel(Control field) {
        Label lbl = (Label) field.getUserData();
        if (lbl == null) {
            lbl = new Label();
            lbl.setWrapText(true);
            lbl.setStyle("-fx-text-fill: #ff6b6b; -fx-font-size: 11; -fx-padding: 4 0 0 0;");
            field.setUserData(lbl);
            if (field.getParent() instanceof VBox parent) {
                parent.getChildren().add(lbl);
            }
        }
        return lbl;
    }
}
