package tn.esprit.controllers;

import javafx.collections.FXCollections;
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

import java.io.IOException;

public class DoctorRegisterController {
    @FXML private Label              feedbackLabel;
    @FXML private TextField          emailField;
    @FXML private TextField          firstNameField;
    @FXML private TextField          lastNameField;
    @FXML private ComboBox<String>   specialityCombo;
    @FXML private PasswordField      passwordField;
    @FXML private PasswordField      confirmPasswordField;
    @FXML private Label              recaptchaStatusLabel;
    @FXML private Button             registerButton;
    @FXML private WebView            recaptchaWebView;

    private final AuthService     authService     = new AuthService();
    private final RecaptchaWidget recaptchaWidget = new RecaptchaWidget();

    @FXML
    public void initialize() {
        specialityCombo.setItems(FXCollections.observableArrayList(
                "Cardiology","Dermatology","General Medicine","Gynecology",
                "Neurology","Pediatrics","Psychiatry","Radiology"));
        FormValidator.attachClearOnInput(feedbackLabel,
                emailField, firstNameField, lastNameField, passwordField, confirmPasswordField);
        specialityCombo.valueProperty().addListener((o,p,n) -> { specialityCombo.setStyle(""); FormValidator.setMessage(feedbackLabel, "", true); });
        recaptchaWidget.attach(recaptchaWebView, recaptchaStatusLabel);
    }

    @FXML
    public void handleRegister() {
        clearFeedback();
        String fn = firstNameField.getText().trim(), ln = lastNameField.getText().trim();
        String email = emailField.getText().trim(), spec = specialityCombo.getValue();
        String pwd = passwordField.getText(), confirm = confirmPasswordField.getText();

        if (fn.isEmpty())    { showErr("First name is required.", firstNameField); return; }
        if (ln.isEmpty())    { showErr("Last name is required.", lastNameField); return; }
        if (!FormValidator.isValidEmail(email)) { showErr("Enter a valid email address.", emailField); return; }
        if (spec == null || spec.isBlank()) { specialityCombo.setStyle("-fx-border-color:#ff4444;-fx-border-width:2;"); FormValidator.setMessage(feedbackLabel, "Medical speciality is required.", true); return; }
        if (pwd.length() < 8) { showErr("Password must be at least 8 characters.", passwordField); return; }
        if (!pwd.equals(confirm)) { FormValidator.markInvalid(passwordField); showErr("Passwords do not match.", confirmPasswordField); return; }
        if (authService.emailExists(email)) { showErr("This email already exists.", emailField); return; }
        if (!recaptchaWidget.isConfigured()) { FormValidator.setMessage(feedbackLabel, recaptchaWidget.getConfigurationMessage(), true); return; }
        if (!recaptchaWidget.hasToken())     { FormValidator.setMessage(feedbackLabel, "Complete the reCAPTCHA check first.", true); return; }

        registerButton.setDisable(true); registerButton.setText("Creating account...");

        Task<RegResult> task = new Task<>() {
            @Override protected RegResult call() {
                var v = recaptchaWidget.verifyCurrentToken();
                if (!v.success()) return new RegResult(false, v.message(), v.resetRequired());
                boolean ok = authService.registerDoctor(fn, ln, email, pwd, spec);
                return new RegResult(ok, ok ? "Registration successful." : "Registration failed. Check details.", true);
            }
        };
        task.setOnSucceeded(e -> {
            restore(); RegResult r = task.getValue();
            if (r.resetCaptcha) recaptchaWidget.reset();
            if (!r.success) { FormValidator.setMessage(feedbackLabel, r.message, true); return; }
            new Alert(Alert.AlertType.INFORMATION, "Registration successful. Please sign in.", ButtonType.OK).showAndWait();
            loadScene("/fxml/login.fxml", "PinkShield Login");
        });
        task.setOnFailed(e -> { restore(); recaptchaWidget.reset(); FormValidator.setMessage(feedbackLabel, "Registration failed.", true); });
        new Thread(task, "doctor-register").start();
    }

    @FXML public void handleBackToRoleSelect() { loadScene("/fxml/register.fxml", "PinkShield Register"); }
    @FXML public void handleBackToLogin()       { loadScene("/fxml/login.fxml", "PinkShield Login"); }

    private void showErr(String msg, TextField f) { FormValidator.markInvalid(f); FormValidator.setMessage(feedbackLabel, msg, true); }
    private void showErr(String msg, PasswordField f) { FormValidator.markInvalid(f); FormValidator.setMessage(feedbackLabel, msg, true); }
    private void clearFeedback() { FormValidator.clearStates(emailField, firstNameField, lastNameField, passwordField, confirmPasswordField); specialityCombo.setStyle(""); FormValidator.setMessage(feedbackLabel, "", true); }
    private void restore() { registerButton.setDisable(false); registerButton.setText("Register as Doctor"); }
    private void loadScene(String fxml, String title) {
        try { Scene s = AppNavigator.createScene(new FXMLLoader(getClass().getResource(fxml)).load(), getClass()); AppNavigator.applyStage((Stage) registerButton.getScene().getWindow(), s, title); }
        catch (IOException e) { e.printStackTrace(); }
    }
    private record RegResult(boolean success, String message, boolean resetCaptcha) {}
}
