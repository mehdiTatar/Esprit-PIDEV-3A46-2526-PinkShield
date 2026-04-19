package org.example;

import javafx.animation.FadeTransition;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import javafx.util.Duration;

import java.io.IOException;
import java.util.regex.Pattern;

public class AdminSignUpController {

    private static final Pattern EMAIL_PATTERN =
            Pattern.compile("^[A-Za-z0-9+_.-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$");

    @FXML private TextField txtFullName;
    @FXML private TextField txtProfessionalEmail;
    @FXML private ComboBox<String> cmbSpecialty;
    @FXML private TextField txtLicenseId;
    @FXML private PasswordField txtPassword;
    @FXML private PasswordField txtConfirmPassword;
    @FXML private Label lblStatus;

    private final ServiceUser serviceUser = new ServiceUser();

    @FXML
    public void initialize() {
        cmbSpecialty.setItems(FXCollections.observableArrayList(
                "Cardiology",
                "Neurology",
                "Orthopedics",
                "Dermatology",
                "Pediatrics",
                "Internal Medicine",
                "Emergency Medicine",
                "Gynecology",
                "Psychiatry",
                "General Surgery"
        ));
    }

    @FXML
    private void handleRegister() {
        clearStatus();

        String fullName = safeText(txtFullName);
        String email = safeText(txtProfessionalEmail);
        String specialty = cmbSpecialty.getValue();
        String licenseId = safeText(txtLicenseId);
        String password = safeText(txtPassword);
        String confirmPassword = safeText(txtConfirmPassword);

        if (fullName.isEmpty() || email.isEmpty() || specialty == null || licenseId.isEmpty()
                || password.isEmpty() || confirmPassword.isEmpty()) {
            showError("Please complete all required fields.");
            return;
        }

        if (!EMAIL_PATTERN.matcher(email).matches()) {
            showError("Please enter a valid professional email.");
            return;
        }

        if (!licenseId.matches("\\d+")) {
            showError("Medical License ID must be numeric.");
            return;
        }

        if (!password.equals(confirmPassword)) {
            showError("Passwords do not match.");
            return;
        }

        boolean created = serviceUser.registerAdmin(fullName, email, specialty, licenseId, password);
        if (!created) {
            showError("This email is already registered.");
            return;
        }

        showInfo("Admin account created successfully with role ADMIN.");
        clearForm();
    }

    @FXML
    private void handleLoginAsPatient() {
        switchScene("/Auth.fxml", "PinkShield - Sign In");
    }

    private void switchScene(String fxmlPath, String title) {
        try {
            Parent root = FXMLLoader.load(getClass().getResource(fxmlPath));
            Stage stage = (Stage) txtFullName.getScene().getWindow();
            stage.setScene(new Scene(root, 1400, 800));
            stage.setTitle(title);
            stage.show();
        } catch (IOException e) {
            showError("Unable to open requested page.");
        }
    }

    private void clearForm() {
        txtFullName.clear();
        txtProfessionalEmail.clear();
        cmbSpecialty.getSelectionModel().clearSelection();
        txtLicenseId.clear();
        txtPassword.clear();
        txtConfirmPassword.clear();
    }

    private void clearStatus() {
        lblStatus.setText("");
        lblStatus.setOpacity(0);
        lblStatus.getStyleClass().remove("admin-info-label");
    }

    private void showError(String message) {
        lblStatus.setText(message);
        animateStatus();
    }

    private void showInfo(String message) {
        lblStatus.setText(message);
        lblStatus.getStyleClass().add("admin-info-label");
        animateStatus();
    }

    private void animateStatus() {
        FadeTransition fadeTransition = new FadeTransition(Duration.millis(220), lblStatus);
        fadeTransition.setFromValue(0);
        fadeTransition.setToValue(1);
        fadeTransition.play();
    }

    private String safeText(TextField field) {
        return field.getText() == null ? "" : field.getText().trim();
    }
}

