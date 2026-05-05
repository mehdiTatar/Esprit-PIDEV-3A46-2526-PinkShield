package tn.esprit.controllers;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.ToggleButton;
import javafx.scene.control.ToggleGroup;
import javafx.stage.Stage;
import tn.esprit.utils.AppNavigator;

import java.io.IOException;

public class RegisterRoleController {
    private static final String PATIENT_ROLE = "patient";
    private static final String DOCTOR_ROLE = "doctor";

    private static final String TOGGLE_BASE_STYLE =
            "-fx-background-radius: 14; -fx-border-radius: 14; -fx-border-width: 1; "
                    + "-fx-font-size: 13; -fx-font-weight: bold; -fx-padding: 14 24; "
                    + "-fx-min-width: 170; -fx-cursor: hand;";
    private static final String TOGGLE_IDLE_STYLE =
            TOGGLE_BASE_STYLE
                    + " -fx-background-color: #141c2b; -fx-border-color: #293242; -fx-text-fill: #aeb7ca;";
    private static final String PATIENT_ACTIVE_STYLE =
            TOGGLE_BASE_STYLE
                    + " -fx-background-color: #2b1830; -fx-border-color: #e64d92; -fx-text-fill: #ff6ba8;";
    private static final String DOCTOR_ACTIVE_STYLE =
            TOGGLE_BASE_STYLE
                    + " -fx-background-color: #11292c; -fx-border-color: #34d3c4; -fx-text-fill: #63e6da;";

    @FXML private ToggleButton patientOptionButton;
    @FXML private ToggleButton doctorOptionButton;
    @FXML private Button continueButton;
    @FXML private Label roleSummaryTitle;
    @FXML private Label roleSummaryDescription;

    private final ToggleGroup roleToggleGroup = new ToggleGroup();

    @FXML
    public void initialize() {
        patientOptionButton.setToggleGroup(roleToggleGroup);
        doctorOptionButton.setToggleGroup(roleToggleGroup);
        patientOptionButton.setSelected(true);

        roleToggleGroup.selectedToggleProperty().addListener((obs, oldToggle, newToggle) -> {
            if (newToggle == null) {
                patientOptionButton.setSelected(true);
            }
            updateSelectedRole();
        });

        updateSelectedRole();
    }

    @FXML
    public void handleContinue() {
        String selectedRole = getSelectedRole();
        if (PATIENT_ROLE.equals(selectedRole)) {
            loadScene("/fxml/patient_register.fxml", "PinkShield Patient Register");
            return;
        }
        loadScene("/fxml/doctor_register.fxml", "PinkShield Doctor Register");
    }

    @FXML
    public void handleBackToLogin() {
        loadScene("/fxml/login.fxml", "PinkShield Login");
    }

    private void updateSelectedRole() {
        boolean patientSelected = PATIENT_ROLE.equals(getSelectedRole());

        patientOptionButton.setStyle(patientSelected ? PATIENT_ACTIVE_STYLE : TOGGLE_IDLE_STYLE);
        doctorOptionButton.setStyle(patientSelected ? TOGGLE_IDLE_STYLE : DOCTOR_ACTIVE_STYLE);

        if (patientSelected) {
            roleSummaryTitle.setText("Patient Account");
            roleSummaryDescription.setText(
                    "Book appointments, track your health data, and access your personal dashboard."
            );
            continueButton.setText("Register as Patient");
            continueButton.setStyle(
                    "-fx-background-color: linear-gradient(to right, #d54480, #ec5d99); "
                            + "-fx-text-fill: white; -fx-font-size: 15; -fx-font-weight: bold; "
                            + "-fx-background-radius: 14; -fx-padding: 14 24; "
                            + "-fx-effect: dropshadow(gaussian, rgba(213,68,128,0.35), 16, 0.2, 0, 3);"
            );
            return;
        }

        roleSummaryTitle.setText("Doctor Account");
        roleSummaryDescription.setText(
                "Manage appointments, connect with patients, and publish health guidance from one workspace."
        );
        continueButton.setText("Register as Doctor");
        continueButton.setStyle(
                "-fx-background-color: linear-gradient(to right, #1ea79a, #35d1c1); "
                        + "-fx-text-fill: white; -fx-font-size: 15; -fx-font-weight: bold; "
                        + "-fx-background-radius: 14; -fx-padding: 14 24; "
                        + "-fx-effect: dropshadow(gaussian, rgba(30,167,154,0.32), 16, 0.2, 0, 3);"
        );
    }

    private String getSelectedRole() {
        return doctorOptionButton != null && doctorOptionButton.isSelected() ? DOCTOR_ROLE : PATIENT_ROLE;
    }

    private void loadScene(String fxmlPath, String title) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Scene scene = AppNavigator.createScene(loader.load(), getClass());

            Stage stage = (Stage) continueButton.getScene().getWindow();
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
