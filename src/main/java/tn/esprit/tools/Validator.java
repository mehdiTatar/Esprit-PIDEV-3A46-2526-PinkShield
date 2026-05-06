package tn.esprit.tools;

import javafx.scene.control.Control;
import javafx.scene.control.Label;

import java.util.regex.Pattern;

public final class Validator {

    private static final Pattern EMAIL = Pattern.compile(
            "^[a-zA-Z0-9._%+\\-]+@[a-zA-Z0-9.\\-]+\\.[a-zA-Z]{2,}$");

    private Validator() {}

    // ── Rule helpers ──────────────────────────────────────────

    public static boolean isValidEmail(String v) {
        return v != null && EMAIL.matcher(v.trim()).matches();
    }

    /** Letters (any language), spaces, apostrophes, hyphens. */
    public static boolean isAlphaSpace(String v) {
        return v != null && v.trim().matches("[\\p{L} '\\-]+");
    }

    // ── Field state helpers ───────────────────────────────────

    /** Mark a field invalid — red border + show error text below it. */
    public static void markError(Control field, Label errLabel, String message) {
        field.getStyleClass().removeAll("input-field-valid", "input-field-error");
        field.getStyleClass().add("input-field-error");
        if (errLabel != null) {
            errLabel.setText(message);
            errLabel.setVisible(true);
            errLabel.setManaged(true);
        }
    }

    /** Mark a field valid — green border + hide error label. */
    public static void markValid(Control field, Label errLabel) {
        field.getStyleClass().removeAll("input-field-error", "input-field-valid");
        field.getStyleClass().add("input-field-valid");
        if (errLabel != null) {
            errLabel.setText("");
            errLabel.setVisible(false);
            errLabel.setManaged(false);
        }
    }

    /** Remove any validation styling + hide error label (used while typing). */
    public static void clearMark(Control field, Label errLabel) {
        field.getStyleClass().removeAll("input-field-error", "input-field-valid");
        if (errLabel != null) {
            errLabel.setText("");
            errLabel.setVisible(false);
            errLabel.setManaged(false);
        }
    }
}
