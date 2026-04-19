package org.example;

import javafx.animation.FadeTransition;
import javafx.animation.ParallelTransition;
import javafx.animation.TranslateTransition;
import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.ToggleGroup;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.scene.control.ToggleButton;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import javafx.util.Duration;

import java.io.IOException;

public class AuthController {

    @FXML private VBox loginBox;
    @FXML private VBox registerBox;

    @FXML private TextField txtLoginEmail;
    @FXML private PasswordField txtLoginPassword;
    @FXML private TextField txtLoginPasswordVisible;

    @FXML private TextField txtRegisterFullName;
    @FXML private TextField txtRegisterEmail;
    @FXML private PasswordField txtRegisterPassword;
    @FXML private PasswordField txtRegisterConfirmPassword;
    @FXML private TextField txtRegisterLicenseId;
    @FXML private ComboBox<String> cmbRegisterSpecialty;

    @FXML private VBox doctorFieldsBox;
    @FXML private ToggleButton btnPatientMode;
    @FXML private ToggleButton btnDoctorMode;
    @FXML private HBox roleHeader;

    private final ToggleGroup roleGroup = new ToggleGroup();

    @FXML private Label loginErrorLabel;
    @FXML private Label registerErrorLabel;

    @FXML private Button btnTogglePassword;

    private final ServiceUser userService = new ServiceUser();
    private boolean showPassword;

    private static final java.util.List<String> SPECIALTIES = java.util.Arrays.asList(
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
    );

    @FXML
    public void initialize() {
        btnPatientMode.setToggleGroup(roleGroup);
        btnDoctorMode.setToggleGroup(roleGroup);
        btnPatientMode.setSelected(true);
        cmbRegisterSpecialty.setItems(FXCollections.observableArrayList(SPECIALTIES));
        registerBox.setVisible(false);
        registerBox.setManaged(false);
        txtLoginPasswordVisible.setVisible(false);
        txtLoginPasswordVisible.setManaged(false);
        applyRoleMode();
        applyTheme(false);
    }

    @FXML
    private void switchToRegister() {
        switchForm();
    }

    @FXML
    private void switchToLogin() {
        switchForm();
    }

    private void switchForm() {
        boolean registerVisible = registerBox.isManaged() && registerBox.isVisible();
        if (registerVisible) {
            switchForm(loginBox, registerBox);
        } else {
            switchForm(registerBox, loginBox);
        }
    }

    private void switchForm(VBox toShow, VBox toHide) {
        clearMessages();

        TranslateTransition slideOut = new TranslateTransition(Duration.millis(220), toHide);
        slideOut.setFromX(0);
        slideOut.setToX(-30);

        FadeTransition fadeOut = new FadeTransition(Duration.millis(220), toHide);
        fadeOut.setFromValue(1);
        fadeOut.setToValue(0);

        ParallelTransition out = new ParallelTransition(slideOut, fadeOut);
        out.setOnFinished(event -> {
            toHide.setVisible(false);
            toHide.setManaged(false);
            toHide.setOpacity(1);
            toHide.setTranslateX(0);

            toShow.setManaged(true);
            toShow.setVisible(true);
            toShow.setOpacity(0);
            toShow.setTranslateX(30);

            TranslateTransition slideIn = new TranslateTransition(Duration.millis(260), toShow);
            slideIn.setFromX(30);
            slideIn.setToX(0);

            FadeTransition fadeIn = new FadeTransition(Duration.millis(260), toShow);
            fadeIn.setFromValue(0);
            fadeIn.setToValue(1);

            new ParallelTransition(slideIn, fadeIn).play();
        });

        out.play();
    }

    @FXML
    private void handleSignIn() {
        clearMessages();

        String email = txtLoginEmail.getText() == null ? "" : txtLoginEmail.getText().trim();
        String password = getLoginPassword();
        String selectedSection = getSelectedRole();

        if (email.isEmpty() || password.isEmpty() || selectedSection.isEmpty()) {
            showError(loginErrorLabel, "Email, password, and section are required.");
            return;
        }

        AuthUser user = userService.authenticateUser(email, password);
        if (user == null) {
            showError(loginErrorLabel, "Invalid credentials.");
            return;
        }

        String expectedRole = "DOCTOR".equals(selectedSection) ? "ADMIN" : "PATIENT";
        if (!expectedRole.equalsIgnoreCase(user.getRole())) {
            showError(loginErrorLabel, "This account does not belong to the selected section.");
            return;
        }

        if ("ADMIN".equalsIgnoreCase(user.getRole())) {
            openScreen("/AdminDashboard.fxml", "PinkShield - Admin Dashboard");
        } else {
            openScreen("/Dashboard.fxml", "PinkShield - Dashboard");
        }
    }

    @FXML
    private void handleSignUp() {
        clearMessages();

        String fullName = safeText(txtRegisterFullName);
        String email = safeText(txtRegisterEmail);
        String password = safeText(txtRegisterPassword);
        String confirm = safeText(txtRegisterConfirmPassword);
        String selectedSection = getSelectedRole();
        String licenseId = safeText(txtRegisterLicenseId);
        String specialty = cmbRegisterSpecialty.getValue() == null ? "" : cmbRegisterSpecialty.getValue().trim();

        if (fullName.isEmpty() || email.isEmpty() || password.isEmpty() || confirm.isEmpty() || selectedSection.isEmpty()) {
            showError(registerErrorLabel, "Please fill in all fields.");
            return;
        }

        if (!password.equals(confirm)) {
            showError(registerErrorLabel, "Passwords do not match.");
            return;
        }

        String role = "DOCTOR".equals(selectedSection) ? "ADMIN" : "PATIENT";
        boolean created;
        if ("ADMIN".equals(role)) {
            if (specialty.isEmpty() || licenseId.isEmpty()) {
                showError(registerErrorLabel, "Specialty and Medical License ID are required for doctors.");
                return;
            }
            if (!licenseId.matches("\\d+")) {
                showError(registerErrorLabel, "Medical License ID must be numeric.");
                return;
            }
            created = userService.registerAdmin(fullName, email, specialty, licenseId, password);
        } else {
            created = userService.registerWithRole(fullName, email, password, role);
        }

        if (!created) {
            showError(registerErrorLabel, "This email is already registered.");
            return;
        }

        clearRegisterFields();
        switchToLogin();
        showError(loginErrorLabel, "Account created. Sign in with your section.");
        loginErrorLabel.getStyleClass().add("auth-info-label");
    }

    @FXML
    private void toggleLoginPasswordVisibility() {
        showPassword = !showPassword;

        if (showPassword) {
            txtLoginPasswordVisible.setText(txtLoginPassword.getText());
            txtLoginPasswordVisible.setVisible(true);
            txtLoginPasswordVisible.setManaged(true);
            txtLoginPassword.setVisible(false);
            txtLoginPassword.setManaged(false);
            btnTogglePassword.setText("🙈");
        } else {
            txtLoginPassword.setText(txtLoginPasswordVisible.getText());
            txtLoginPassword.setVisible(true);
            txtLoginPassword.setManaged(true);
            txtLoginPasswordVisible.setVisible(false);
            txtLoginPasswordVisible.setManaged(false);
            btnTogglePassword.setText("👁");
        }
    }

    private void openScreen(String fxmlPath, String title) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent root = loader.load();
            Stage stage = (Stage) loginBox.getScene().getWindow();
            stage.setScene(new Scene(root, 1400, 800));
            stage.setTitle(title);
            stage.show();
        } catch (IOException e) {
            showError(loginErrorLabel, "Unable to open dashboard.");
        }
    }

    private String getLoginPassword() {
        return showPassword ? safeText(txtLoginPasswordVisible) : safeText(txtLoginPassword);
    }

    private String safeText(TextField field) {
        return field.getText() == null ? "" : field.getText().trim();
    }

    private void clearRegisterFields() {
        txtRegisterFullName.clear();
        txtRegisterEmail.clear();
        txtRegisterPassword.clear();
        txtRegisterConfirmPassword.clear();
        txtRegisterLicenseId.clear();
        cmbRegisterSpecialty.getSelectionModel().clearSelection();
    }

    @FXML
    private void handlePatientMode() {
        applyRoleMode();
        applyTheme(false);
    }

    @FXML
    private void handleDoctorMode() {
        applyRoleMode();
        applyTheme(true);
    }

    private void applyRoleMode() {
        boolean doctorSelected = btnDoctorMode != null && btnDoctorMode.isSelected();
        if (doctorFieldsBox != null) {
            doctorFieldsBox.setVisible(doctorSelected);
            doctorFieldsBox.setManaged(doctorSelected);
        }
    }

    private void applyTheme(boolean isDoctor) {
        if (loginBox != null) {
            if (isDoctor) {
                loginBox.getStyleClass().remove("auth-patient-theme");
                loginBox.getStyleClass().add("auth-doctor-theme");
            } else {
                loginBox.getStyleClass().remove("auth-doctor-theme");
                loginBox.getStyleClass().add("auth-patient-theme");
            }
        }
        if (registerBox != null) {
            if (isDoctor) {
                registerBox.getStyleClass().remove("auth-patient-theme");
                registerBox.getStyleClass().add("auth-doctor-theme");
            } else {
                registerBox.getStyleClass().remove("auth-doctor-theme");
                registerBox.getStyleClass().add("auth-patient-theme");
            }
        }
    }

    private String getSelectedRole() {
        return btnDoctorMode != null && btnDoctorMode.isSelected() ? "DOCTOR" : "PATIENT";
    }

    private void clearMessages() {
        clearMessage(loginErrorLabel);
        clearMessage(registerErrorLabel);
    }

    private void clearMessage(Label label) {
        label.setText("");
        label.setOpacity(0);
        label.getStyleClass().remove("auth-info-label");
    }

    private void showError(Label label, String message) {
        label.setText(message);
        FadeTransition fade = new FadeTransition(Duration.millis(220), label);
        fade.setFromValue(0);
        fade.setToValue(1);
        fade.play();
    }
}


