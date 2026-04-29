package tn.esprit.controllers;

import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import tn.esprit.services.AuthService;
import tn.esprit.utils.AppNavigator;
import tn.esprit.utils.FormValidator;

import java.io.IOException;

public class DoctorRegisterController {
    @FXML private Label feedbackLabel;
    @FXML private TextField emailField;
    @FXML private TextField firstNameField;
    @FXML private TextField lastNameField;
    @FXML private ComboBox<String> specialityCombo;
    @FXML private PasswordField passwordField;
    @FXML private PasswordField confirmPasswordField;
    @FXML private Button registerButton;

    private final AuthService authService = new AuthService();

    @FXML
    public void initialize() {
        specialityCombo.setItems(FXCollections.observableArrayList(
                "Cardiology",
                "Dermatology",
                "General Medicine",
                "Gynecology",
                "Neurology",
                "Pediatrics",
                "Psychiatry",
                "Radiology"
        ));

        FormValidator.attachClearOnInput(
                feedbackLabel,
                emailField,
                firstNameField,
                lastNameField,
                passwordField,
                confirmPasswordField
        );
        specialityCombo.valueProperty().addListener((obs, oldValue, newValue) -> {
            specialityCombo.setStyle("");
            FormValidator.setMessage(feedbackLabel, "", true);
        });
    }

    @FXML
    public void handleRegister() {
        clearFeedback();

        String firstName = firstNameField.getText().trim();
        String lastName = lastNameField.getText().trim();
        String email = emailField.getText().trim();
        String speciality = specialityCombo.getValue();
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
        if (speciality == null || speciality.isBlank()) {
            specialityCombo.setStyle("-fx-border-color: #ff6b6b; -fx-border-width: 2;");
            FormValidator.setMessage(feedbackLabel, "Medical speciality is required.", true);
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

        boolean success = authService.registerDoctor(firstName, lastName, email, password, speciality);
        if (!success) {
            FormValidator.setMessage(feedbackLabel, "Registration failed. Check the entered details and try again.", true);
            return;
        }

        showAlert("Success", "Registration successful. Please sign in.", Alert.AlertType.INFORMATION);
        loadScene("/fxml/login.fxml", "PinkShield Login");
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
                passwordField,
                confirmPasswordField
        );
        specialityCombo.setStyle("");
        FormValidator.setMessage(feedbackLabel, "", true);
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
