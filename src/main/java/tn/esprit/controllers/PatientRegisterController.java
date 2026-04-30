package tn.esprit.controllers;

import javafx.concurrent.Task;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
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
    @FXML private Label feedbackLabel;
    @FXML private TextField emailField;
    @FXML private TextField firstNameField;
    @FXML private TextField lastNameField;
    @FXML private TextField phoneField;
    @FXML private TextField addressField;
    @FXML private PasswordField passwordField;
    @FXML private PasswordField confirmPasswordField;
    @FXML private Label faceImageNameLabel;
    @FXML private Label faceImageHelperLabel;
    @FXML private Label recaptchaStatusLabel;
    @FXML private Button registerButton;
    @FXML private Button chooseFaceImageButton;
    @FXML private WebView recaptchaWebView;

    private final AuthService authService = new AuthService();
    private final RecaptchaWidget recaptchaWidget = new RecaptchaWidget();
    private Path selectedFaceImagePath;

    @FXML
    public void initialize() {
        FormValidator.attachClearOnInput(
                feedbackLabel,
                emailField,
                firstNameField,
                lastNameField,
                phoneField,
                addressField,
                passwordField,
                confirmPasswordField
        );
        recaptchaWidget.attach(recaptchaWebView, recaptchaStatusLabel);
    }

    @FXML
    public void handleRegister() {
        clearFeedback();

        String firstName = firstNameField.getText().trim();
        String lastName = lastNameField.getText().trim();
        String email = emailField.getText().trim();
        String phone = phoneField.getText().trim();
        String address = addressField.getText().trim();
        String password = passwordField.getText();
        String confirmPassword = confirmPasswordField.getText();

        if (firstName.isEmpty()) {
            showFieldError(firstNameField, "First name is required.");
            return;
        }
        if (lastName.isEmpty()) {
            showFieldError(lastNameField, "Last name is required.");
            return;
        }
        if (!FormValidator.isValidEmail(email)) {
            showFieldError(emailField, "Enter a valid email address.");
            return;
        }
        if (!FormValidator.isValidPhone(phone)) {
            showFieldError(phoneField, "Phone number must contain 8 to 20 digits.");
            return;
        }
        if (address.isEmpty()) {
            showFieldError(addressField, "Address is required.");
            return;
        }
        if (password.length() < 8) {
            showFieldError(passwordField, "Password must contain at least 8 characters.");
            return;
        }
        if (!password.equals(confirmPassword)) {
            FormValidator.markInvalid(passwordField);
            FormValidator.markInvalid(confirmPasswordField);
            FormValidator.setMessage(feedbackLabel, "Password confirmation does not match.", true);
            return;
        }
        if (authService.emailExists(email)) {
            showFieldError(emailField, "This email address already exists.");
            return;
        }
        if (!recaptchaWidget.isConfigured()) {
            FormValidator.setMessage(feedbackLabel, recaptchaWidget.getConfigurationMessage(), true);
            return;
        }
        if (!recaptchaWidget.hasToken()) {
            FormValidator.setMessage(feedbackLabel, "Complete the reCAPTCHA security check first.", true);
            return;
        }

        String fullName = (firstName + " " + lastName).trim();
        registerButton.setDisable(true);
        registerButton.setText("Creating account...");
        chooseFaceImageButton.setDisable(true);

        Path faceImagePath = selectedFaceImagePath;
        Task<AuthService.PatientRegistrationResult> registrationTask = new Task<>() {
            @Override
            protected AuthService.PatientRegistrationResult call() {
                var verification = recaptchaWidget.verifyCurrentToken();
                if (!verification.success()) {
                    return AuthService.PatientRegistrationResult.failure(verification.message());
                }
                return authService.registerPatientWithFace(fullName, email, password, phone, address, faceImagePath);
            }
        };

        registrationTask.setOnSucceeded(event -> {
            registerButton.setDisable(false);
            registerButton.setText("Register as Patient");
            chooseFaceImageButton.setDisable(false);
            recaptchaWidget.reset();

            AuthService.PatientRegistrationResult result = registrationTask.getValue();
            if (!result.success()) {
                FormValidator.setMessage(
                        feedbackLabel,
                        result.message() == null || result.message().isBlank()
                                ? "Registration failed. Check the entered details and try again."
                                : result.message(),
                        true
                );
                return;
            }

            String dialogMessage = result.message() == null || result.message().isBlank()
                    ? "Registration successful. Please sign in."
                    : result.message();
            showAlert("Success", dialogMessage, Alert.AlertType.INFORMATION);
            loadScene("/fxml/login.fxml", "PinkShield Login");
        });

        registrationTask.setOnFailed(event -> {
            registerButton.setDisable(false);
            registerButton.setText("Register as Patient");
            chooseFaceImageButton.setDisable(false);
            recaptchaWidget.reset();
            Throwable error = registrationTask.getException();
            FormValidator.setMessage(
                    feedbackLabel,
                    error == null ? "Registration failed. Please try again." : error.getMessage(),
                    true
            );
        });

        Thread backgroundThread = new Thread(registrationTask, "patient-register-face");
        backgroundThread.setDaemon(true);
        backgroundThread.start();
    }

    @FXML
    public void handleCaptureFaceImage() {
        Stage stage = (Stage) chooseFaceImageButton.getScene().getWindow();
        Path capturedImagePath = WebcamCaptureDialog.captureFaceImage(
                stage,
                getClass(),
                "Patient Face Enrollment",
                "Align your face in the frame and capture a clear front-facing photo."
        );
        if (capturedImagePath == null) {
            return;
        }

        selectedFaceImagePath = capturedImagePath;
        faceImageNameLabel.setText(capturedImagePath.getFileName().toString());
        faceImageHelperLabel.setText("Face captured successfully. Registration will use this front-camera photo.");
    }

    @FXML
    public void handleBackToRoleSelect() {
        loadScene("/fxml/register.fxml", "PinkShield Register");
    }

    @FXML
    public void handleBackToLogin() {
        loadScene("/fxml/login.fxml", "PinkShield Login");
    }

    private void clearFeedback() {
        FormValidator.clearStates(
                firstNameField,
                lastNameField,
                emailField,
                phoneField,
                addressField,
                passwordField,
                confirmPasswordField
        );
        feedbackLabel.setText("");
        feedbackLabel.setManaged(false);
        feedbackLabel.setVisible(false);
    }

    private void showFieldError(TextField field, String message) {
        FormValidator.markInvalid(field);
        FormValidator.setMessage(feedbackLabel, message, true);
    }

    private void showFieldError(PasswordField field, String message) {
        FormValidator.markInvalid(field);
        FormValidator.setMessage(feedbackLabel, message, true);
    }

    private void loadScene(String fxmlPath, String title) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Scene scene = AppNavigator.createScene(loader.load(), getClass());

            Stage stage = (Stage) registerButton.getScene().getWindow();
            AppNavigator.applyStage(stage, scene, title);
        } catch (IOException e) {
            showAlert("Error", "Failed to load " + title + ".", Alert.AlertType.ERROR);
            e.printStackTrace();
        }
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}
