package tn.esprit.controllers;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.stage.Stage;
import tn.esprit.utils.AppNavigator;

import java.io.IOException;

public class RegisterRoleController {
    private static final String PATIENT_ROLE = "patient";
    private static final String DOCTOR_ROLE  = "doctor";

    @FXML private ToggleButton patientOptionButton;
    @FXML private ToggleButton doctorOptionButton;
    @FXML private Button       continueButton;
    @FXML private Label        roleSummaryTitle;
    @FXML private Label        roleSummaryDescription;

    private final ToggleGroup roleGroup = new ToggleGroup();

    @FXML
    public void initialize() {
        patientOptionButton.setToggleGroup(roleGroup);
        doctorOptionButton.setToggleGroup(roleGroup);
        patientOptionButton.setSelected(true);
        roleGroup.selectedToggleProperty().addListener((obs, o, n) -> {
            if (n == null) patientOptionButton.setSelected(true);
            updateRole();
        });
        updateRole();
    }

    @FXML
    public void handleContinue() {
        String role = DOCTOR_ROLE.equals(getRole()) ? DOCTOR_ROLE : PATIENT_ROLE;
        loadScene(DOCTOR_ROLE.equals(role) ? "/fxml/doctor_register.fxml" : "/fxml/patient_register.fxml",
                  DOCTOR_ROLE.equals(role) ? "PinkShield Doctor Register" : "PinkShield Patient Register");
    }

    @FXML
    public void handleBackToLogin() { loadScene("/fxml/login.fxml", "PinkShield Login"); }

    private void updateRole() {
        boolean patient = PATIENT_ROLE.equals(getRole());
        if (roleSummaryTitle != null) roleSummaryTitle.setText(patient ? "Patient Account" : "Doctor Account");
        if (roleSummaryDescription != null) roleSummaryDescription.setText(patient
                ? "Book appointments, track your health data, and access your personal dashboard."
                : "Manage appointments, connect with patients, and publish health guidance.");
        if (continueButton != null) continueButton.setText(patient ? "Register as Patient" : "Register as Doctor");
    }

    private String getRole() { return doctorOptionButton != null && doctorOptionButton.isSelected() ? DOCTOR_ROLE : PATIENT_ROLE; }

    private void loadScene(String fxml, String title) {
        try {
            Scene scene = AppNavigator.createScene(new FXMLLoader(getClass().getResource(fxml)).load(), getClass());
            AppNavigator.applyStage((Stage) continueButton.getScene().getWindow(), scene, title);
        } catch (IOException e) { e.printStackTrace(); }
    }
}
