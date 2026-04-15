package org.example;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;

import java.sql.SQLException;
import java.sql.Timestamp;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.ArrayList;

public class AppointmentUserController {

    @FXML
    private TextField txtPatientName;
    @FXML
    private TextField txtPatientEmail;
    @FXML
    private TextField txtDoctorName;
    @FXML
    private DatePicker datePicker;
    @FXML
    private TextArea txtNotes;
    @FXML
    private TableView<Appointment> table;
    @FXML
    private TableColumn<Appointment, String> colDate;
    @FXML
    private TableColumn<Appointment, String> colDoctor;
    @FXML
    private TableColumn<Appointment, String> colStatus;
    @FXML
    private TableColumn<Appointment, String> colNotes;

    private ServiceAppointment service;
    private ObservableList<Appointment> appointmentList;

    @FXML
    public void initialize() {
        service = new ServiceAppointment();

        initializeTableColumns();
        loadAppointments();
    }

    private void initializeTableColumns() {
        colDate.setCellValueFactory(cellData -> {
            Timestamp timestamp = cellData.getValue().getAppointment_date();
            String formatted = timestamp != null ?
                timestamp.toLocalDateTime().format(DateTimeFormatter.ofPattern("yyyy-MM-dd HH:mm")) : "N/A";
            return new javafx.beans.property.SimpleStringProperty(formatted);
        });

        colDoctor.setCellValueFactory(cellData ->
            new javafx.beans.property.SimpleStringProperty(cellData.getValue().getDoctor_name()));

        colStatus.setCellValueFactory(cellData ->
            new javafx.beans.property.SimpleStringProperty(cellData.getValue().getStatus()));

        colNotes.setCellValueFactory(cellData ->
            new javafx.beans.property.SimpleStringProperty(cellData.getValue().getNotes() != null ? cellData.getValue().getNotes() : ""));
    }

    private void loadAppointments() {
        try {
            // For demo purposes, load all appointments. In a real app, you'd filter by user
            ArrayList<Appointment> appointments = service.afficherAll();
            appointmentList = FXCollections.observableArrayList(appointments);
            table.setItems(appointmentList);
        } catch (SQLException e) {
            System.out.println("Database connection error - showing demo appointments: " + e.getMessage());
            loadDemoAppointments();
        } catch (NullPointerException e) {
            System.out.println("Database not ready - showing demo appointments: " + e.getMessage());
            loadDemoAppointments();
        }
    }

    private void loadDemoAppointments() {
        appointmentList = FXCollections.observableArrayList();

        // Add some demo appointments
        try {
            appointmentList.add(new Appointment(
                "john@example.com", "John Doe", "dr.smith@clinic.com", "Dr. Smith",
                Timestamp.valueOf(LocalDateTime.now().plusDays(1).withHour(10).withMinute(0)),
                "pending", "Annual checkup"
            ));

            appointmentList.add(new Appointment(
                "jane@example.com", "Jane Smith", "dr.brown@clinic.com", "Dr. Brown",
                Timestamp.valueOf(LocalDateTime.now().plusDays(2).withHour(14).withMinute(30)),
                "confirmed", "Follow-up visit"
            ));

        } catch (Exception e) {
            System.out.println("Error creating demo appointments: " + e.getMessage());
        }

        table.setItems(appointmentList);
    }

    @FXML
    public void handleAjouter() {
        if (!validateInput()) {
            return;
        }

        try {
            String patientName = txtPatientName.getText();
            String patientEmail = txtPatientEmail.getText();
            String doctorName = txtDoctorName.getText();
            LocalDate selectedDate = datePicker.getValue();
            String notes = txtNotes.getText();

            // For demo, create a default time and doctor email
            LocalDateTime appointmentDateTime = LocalDateTime.of(selectedDate, java.time.LocalTime.of(10, 0));
            String doctorEmail = "doctor@clinic.com"; // Default doctor email
            String status = "pending";

            Timestamp appointmentTimestamp = Timestamp.valueOf(appointmentDateTime);

            Appointment appointment = new Appointment(
                    patientEmail, patientName, doctorEmail, doctorName,
                    appointmentTimestamp, status, notes
            );

            service.ajouter(appointment);
            showInfoAlert("Success", "Appointment booked successfully!");

            clearFields();
            loadAppointments();

        } catch (SQLException e) {
            showErrorAlert("Database Error", "Could not book appointment: " + e.getMessage());
        } catch (Exception e) {
            showErrorAlert("Error", "Could not book appointment: " + e.getMessage());
        }
    }

    private boolean validateInput() {
        String patientName = txtPatientName.getText();
        String patientEmail = txtPatientEmail.getText();
        String doctorName = txtDoctorName.getText();
        LocalDate selectedDate = datePicker.getValue();

        if (patientName.isEmpty() || patientEmail.isEmpty() || doctorName.isEmpty() || selectedDate == null) {
            showWarningAlert("Validation Error", "All fields are required. Please fill in all fields.");
            return false;
        }

        if (!patientEmail.contains("@")) {
            showWarningAlert("Validation Error", "Patient email must be a valid email address.");
            return false;
        }

        if (selectedDate.isBefore(LocalDate.now())) {
            showWarningAlert("Validation Error", "Appointment date cannot be in the past.");
            return false;
        }

        return true;
    }

    private void clearFields() {
        txtPatientName.clear();
        txtPatientEmail.clear();
        txtDoctorName.clear();
        txtNotes.clear();
        datePicker.setValue(null);
    }

    private void showWarningAlert(String title, String content) {
        Alert alert = new Alert(Alert.AlertType.WARNING);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    private void showErrorAlert(String title, String content) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    private void showInfoAlert(String title, String content) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }
}
