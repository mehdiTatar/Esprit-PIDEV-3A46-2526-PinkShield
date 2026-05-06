package tn.esprit.controllers;

import javafx.concurrent.Task;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.web.WebView;
import javafx.stage.Stage;
import tn.esprit.services.AuthService;
import tn.esprit.utils.AppNavigator;
import tn.esprit.utils.FormValidator;
import tn.esprit.utils.RecaptchaWidget;
import tn.esprit.utils.WebcamCaptureDialog;

import java.io.IOException;
import java.nio.file.Path;

public class PatientRegisterController {
    @FXML private Label         feedbackLabel;
    @FXML private TextField     emailField;
    @FXML private TextField     firstNameField;
    @FXML private TextField     lastNameField;
    @FXML private TextField     phoneField;
    @FXML private TextField     addressField;
    @FXML private PasswordField passwordField;
    @FXML private PasswordField confirmPasswordField;
    @FXML private Label         faceImageNameLabel;
    @FXML private Label         faceImageHelperLabel;
    @FXML private Button        chooseFaceImageButton;
    @FXML private Button        registerButton;
    @FXML private WebView       recaptchaWebView;
    @FXML private Label         recaptchaStatusLabel;

    private final AuthService     authService     = new AuthService();
    private final RecaptchaWidget recaptchaWidget = new RecaptchaWidget();
    private Path selectedFaceImagePath;

    @FXML
    public void initialize() {
        FormValidator.attachClearOnInput(feedbackLabel,
                emailField, firstNameField, lastNameField, phoneField, addressField, passwordField, confirmPasswordField);
        recaptchaWidget.attach(recaptchaWebView, recaptchaStatusLabel);
    }

    @FXML
    public void handleCaptureFaceImage() {
        Path p = WebcamCaptureDialog.captureFaceImage(
                chooseFaceImageButton.getScene().getWindow(), getClass(),
                "Face Enrollment", "Center your face and capture a clear photo for face login (optional).");
        if (p == null) return;
        selectedFaceImagePath = p;
        if (faceImageNameLabel   != null) faceImageNameLabel.setText(p.getFileName().toString());
        if (faceImageHelperLabel != null) faceImageHelperLabel.setText("Image captured. Face++ will use this for future sign-ins.");
    }

    @FXML
    public void handleRegister() {
        clearFeedback();
        String firstName = firstNameField.getText().trim(), lastName = lastNameField.getText().trim();
        String email = emailField.getText().trim(), phone = phoneField.getText().trim();
        String address = addressField.getText().trim(), password = passwordField.getText();
        String confirm  = confirmPasswordField.getText();

        if (firstName.isEmpty()) { showErr("First name is required.", firstNameField); return; }
        if (lastName.isEmpty())  { showErr("Last name is required.", lastNameField); return; }
        if (!FormValidator.isValidEmail(email)) { showErr("Enter a valid email address.", emailField); return; }
        if (password.length() < 8) { showErr("Password must be at least 8 characters.", passwordField); return; }
        if (!password.equals(confirm)) { FormValidator.markInvalid(passwordField); showErr("Passwords do not match.", confirmPasswordField); return; }
        if (authService.emailExists(email)) { showErr("This email already exists.", emailField); return; }
        if (!recaptchaWidget.isConfigured()) { FormValidator.setMessage(feedbackLabel, recaptchaWidget.getConfigurationMessage(), true); return; }
        if (!recaptchaWidget.hasToken())     { FormValidator.setMessage(feedbackLabel, "Complete the reCAPTCHA check first.", true); return; }

        registerButton.setDisable(true); registerButton.setText("Creating account...");
        String fullName = (firstName + " " + lastName).trim();
        Path face = selectedFaceImagePath;

        Task<RegResult> task = new Task<>() {
            @Override protected RegResult call() {
                var v = recaptchaWidget.verifyCurrentToken();
                if (!v.success()) return new RegResult(false, v.message(), v.resetRequired());
                var r = authService.registerPatientWithFace(fullName, email, password, phone, address, face);
                return new RegResult(r.success(), r.message(), true);
            }
        };
        task.setOnSucceeded(e -> {
            restore();
            RegResult r = task.getValue();
            if (r.resetCaptcha) recaptchaWidget.reset();
            if (!r.success) { FormValidator.setMessage(feedbackLabel, r.message, true); return; }
            alert("Registration successful. " + (r.message != null && !r.message.isBlank() ? r.message : ""), Alert.AlertType.INFORMATION);
            loadScene("/fxml/login.fxml", "PinkShield Login");
        });
        task.setOnFailed(e -> { restore(); recaptchaWidget.reset(); FormValidator.setMessage(feedbackLabel, "Registration failed.", true); });
        new Thread(task, "patient-register").start();
    }

    @FXML public void handleBackToRoleSelect() { loadScene("/fxml/register.fxml", "PinkShield Register"); }
    @FXML public void handleBackToLogin()       { loadScene("/fxml/login.fxml", "PinkShield Login"); }

    private void showErr(String msg, TextField field) { FormValidator.markInvalid(field); FormValidator.setMessage(feedbackLabel, msg, true); }
    private void clearFeedback() { FormValidator.clearStates(emailField, firstNameField, lastNameField, phoneField, addressField, passwordField, confirmPasswordField); FormValidator.setMessage(feedbackLabel, "", true); }
    private void restore() { registerButton.setDisable(false); registerButton.setText("Register as Patient"); }
    private void loadScene(String fxml, String title) {
        try { Scene s = AppNavigator.createScene(new FXMLLoader(getClass().getResource(fxml)).load(), getClass()); AppNavigator.applyStage((Stage) registerButton.getScene().getWindow(), s, title); }
        catch (IOException e) { e.printStackTrace(); }
    }
    private void alert(String msg, Alert.AlertType t) { Alert a = new Alert(t, msg, ButtonType.OK); a.setHeaderText(null); a.showAndWait(); }
    private record RegResult(boolean success, String message, boolean resetCaptcha) {}
}
