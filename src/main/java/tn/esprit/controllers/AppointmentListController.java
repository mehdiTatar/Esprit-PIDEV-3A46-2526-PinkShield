package tn.esprit.controllers;

import javafx.application.Platform;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ComboBox;
import javafx.scene.control.DateCell;
import javafx.scene.control.DatePicker;
import javafx.scene.control.Dialog;
import javafx.scene.control.Label;
import javafx.scene.control.TableCell;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.FileChooser;
import javafx.util.StringConverter;
import tn.esprit.entities.Appointment;
import tn.esprit.entities.User;
import tn.esprit.services.AppointmentLocationService;
import tn.esprit.services.AppointmentPdfService;
import tn.esprit.services.AppointmentQrCodeService;
import tn.esprit.services.AppointmentService;
import tn.esprit.services.AppointmentWeatherService;
import tn.esprit.services.UserService;
import tn.esprit.utils.FormValidator;

import java.awt.Desktop;
import java.io.IOException;
import java.net.URI;
import java.sql.Timestamp;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.Comparator;
import java.util.List;
import java.util.Locale;
import java.util.stream.Collectors;

public class AppointmentListController {
    private static final DateTimeFormatter TABLE_DATE_FORMAT = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");
    private static final DateTimeFormatter TIME_INPUT_FORMAT = DateTimeFormatter.ofPattern("HH:mm");

    @FXML private Label pageTitleLabel;
    @FXML private Label pageSubtitleLabel;
    @FXML private TableView<Appointment> appointmentsTable;
    @FXML private TableColumn<Appointment, String> dateColumn;
    @FXML private TableColumn<Appointment, String> doctorPatientColumn;
    @FXML private TableColumn<Appointment, String> statusColumn;
    @FXML private TableColumn<Appointment, String> notesColumn;
    @FXML private TableColumn<Appointment, Void> actionsColumn;
    @FXML private ComboBox<String> statusFilter;
    @FXML private TextField searchField;
    @FXML private Button bookAppointmentButton;
    @FXML private Label selectedAppointmentTitleLabel;
    @FXML private Label selectedAppointmentMetaLabel;
    @FXML private Label selectedAppointmentStatusLabel;
    @FXML private Label clinicNameLabel;
    @FXML private Label clinicAddressLabel;
    @FXML private Label mapStatusLabel;
    @FXML private ImageView qrCodeImageView;
    @FXML private ImageView clinicMapImageView;

    @FXML private Label formTitle;
    @FXML private Label feedbackLabel;
    @FXML private ComboBox<User> doctorCombo;
    @FXML private DatePicker datePicker;
    @FXML private TextField timeField;
    @FXML private TextArea notesArea;
    @FXML private Label weatherSummaryLabel;
    @FXML private Label weatherMetaLabel;
    @FXML private Label clinicSummaryLabel;

    private final AppointmentService appointmentService = new AppointmentService();
    private final UserService userService = new UserService();
    private final AppointmentLocationService locationService = new AppointmentLocationService();
    private final AppointmentWeatherService weatherService = new AppointmentWeatherService();
    private final AppointmentQrCodeService qrCodeService = new AppointmentQrCodeService();
    private final AppointmentPdfService appointmentPdfService = new AppointmentPdfService();
    private final ObservableList<Appointment> allAppointments = FXCollections.observableArrayList();
    private User currentUser;

    @FXML
    public void initialize() {
        if (appointmentsTable != null) {
            setupTable();
            setupFilters();
            setupAppointmentSelection();
            populateClinicCopy();
            loadClinicMapPreview();
            updateSelectedAppointmentPreview(null);
        }

        if (doctorCombo != null) {
            loadDoctors();
            datePicker.setDayCellFactory(picker -> new DateCell() {
                @Override
                public void updateItem(LocalDate item, boolean empty) {
                    super.updateItem(item, empty);
                    setDisable(empty || item.isBefore(LocalDate.now()));
                }
            });
            FormValidator.attachClearOnInput(feedbackLabel, timeField, doctorCombo);
            if (notesArea != null) {
                notesArea.textProperty().addListener((obs, oldValue, newValue) -> FormValidator.setMessage(feedbackLabel, "", true));
            }
            populateClinicCopy();
            handleRefreshWeather();
        }
    }

    public void setCurrentUser(User user) {
        currentUser = user;
        updatePageCopy();

        if (bookAppointmentButton != null) {
            boolean canBook = user != null && UserService.ROLE_USER.equals(user.getRole());
            bookAppointmentButton.setManaged(canBook);
            bookAppointmentButton.setVisible(canBook);
        }

        if (appointmentsTable != null) {
            loadAppointments();
        }
    }

    @FXML
    public void handleNewAppointment() {
        loadSubView("/fxml/appointment_form.fxml");
    }

    @FXML
    public void handleOpenCalendar() {
        loadSubView("/fxml/appointment_calendar.fxml");
    }

    @FXML
    public void handleOpenParapharmacy() {
        loadSubView("/fxml/product_list.fxml");
    }

    @FXML
    public void handleOpenClinicMap() {
        try {
            if (!Desktop.isDesktopSupported() || !Desktop.getDesktop().isSupported(Desktop.Action.BROWSE)) {
                showAlert("Map unavailable", "Desktop browsing is not supported on this machine.", Alert.AlertType.WARNING);
                return;
            }

            Desktop.getDesktop().browse(URI.create(locationService.getDirectionsUrl()));
        } catch (IOException e) {
            showAlert("Map unavailable", "The clinic map could not be opened.", Alert.AlertType.ERROR);
        }
    }

    @FXML
    public void handleRefreshWeather() {
        if (weatherSummaryLabel == null && weatherMetaLabel == null) {
            return;
        }

        if (weatherSummaryLabel != null) {
            weatherSummaryLabel.setText("Loading clinic weather...");
        }
        if (weatherMetaLabel != null) {
            weatherMetaLabel.setText("Fetching the latest conditions for the appointment location.");
        }

        weatherService.fetchCurrentWeatherAsync().whenComplete((snapshot, throwable) -> Platform.runLater(() -> {
            if (throwable != null || snapshot == null) {
                if (weatherSummaryLabel != null) {
                    weatherSummaryLabel.setText("Weather unavailable");
                }
                if (weatherMetaLabel != null) {
                    weatherMetaLabel.setText("Check your internet connection and try again.");
                }
                return;
            }

            if (weatherSummaryLabel != null) {
                weatherSummaryLabel.setText(snapshot.summary());
            }
            if (weatherMetaLabel != null) {
                weatherMetaLabel.setText(snapshot.detail());
            }
        }));
    }

    @FXML
    public void handleDownloadPdf() {
        Appointment appointment = null;

        if (appointmentsTable != null) {
            appointment = appointmentsTable.getSelectionModel().getSelectedItem();
        }
        if (appointment == null) {
            appointment = findLatestAppointmentForCurrentUser();
        }
        if (appointment == null) {
            showAlert("No appointment", "Select or create an appointment before exporting the PDF proof.", Alert.AlertType.WARNING);
            return;
        }

        exportAppointmentPdf(appointment);
    }

    @FXML
    public void handleConfirmBooking() {
        if (currentUser == null) {
            showAlert("Error", "You must be logged in to book an appointment.", Alert.AlertType.ERROR);
            return;
        }

        User doctor = doctorCombo.getValue();
        LocalDate date = datePicker.getValue();
        String timeText = timeField.getText().trim();
        String notes = notesArea.getText().trim();

        if (doctor == null) {
            FormValidator.markInvalid(doctorCombo);
            FormValidator.setMessage(feedbackLabel, "Doctor selection is required.", true);
            return;
        }
        if (date == null) {
            FormValidator.setMessage(feedbackLabel, "Appointment date is required.", true);
            return;
        }
        if (date.isBefore(LocalDate.now())) {
            FormValidator.setMessage(feedbackLabel, "Appointment date cannot be in the past.", true);
            return;
        }
        if (timeText.isEmpty()) {
            FormValidator.markInvalid(timeField);
            FormValidator.setMessage(feedbackLabel, "Appointment time is required.", true);
            return;
        }

        LocalTime time;
        try {
            time = LocalTime.parse(timeText, TIME_INPUT_FORMAT);
        } catch (DateTimeParseException e) {
            FormValidator.markInvalid(timeField);
            FormValidator.setMessage(feedbackLabel, "Time must use the HH:mm format.", true);
            return;
        }

        LocalDateTime dateTime = LocalDateTime.of(date, time);
        if (dateTime.isBefore(LocalDateTime.now())) {
            FormValidator.setMessage(feedbackLabel, "Appointment date and time must be in the future.", true);
            return;
        }

        Timestamp appointmentTimestamp = Timestamp.valueOf(dateTime);
        if (appointmentService.hasAppointmentConflict(doctor.getId(), appointmentTimestamp, null)) {
            FormValidator.setMessage(feedbackLabel, "This doctor already has an appointment at the selected date and time.", true);
            return;
        }
        if (appointmentService.hasPatientDuplicate(currentUser.getId(), doctor.getId(), appointmentTimestamp, null)) {
            FormValidator.setMessage(feedbackLabel, "This appointment already exists for the same doctor, patient, and time.", true);
            return;
        }

        Appointment appointment = new Appointment(
                currentUser.getId(),
                doctor.getId(),
                currentUser.getFullName(),
                buildDoctorDisplayName(doctor),
                appointmentTimestamp,
                "pending",
                notes
        );

        if (appointmentService.addAppointment(appointment)) {
            Appointment savedAppointment = findMatchingAppointment(currentUser.getId(), doctor.getId(), appointmentTimestamp);
            Alert downloadPrompt = new Alert(
                    Alert.AlertType.CONFIRMATION,
                    "Appointment booked successfully. Download the PDF proof now?",
                    ButtonType.YES,
                    ButtonType.NO
            );
            downloadPrompt.setHeaderText("Appointment confirmed");
            downloadPrompt.showAndWait().ifPresent(type -> {
                if (type == ButtonType.YES && savedAppointment != null) {
                    exportAppointmentPdf(savedAppointment);
                }
            });
            handleBackToList();
        } else {
            showAlert("Error", "Failed to book appointment.", Alert.AlertType.ERROR);
        }
    }

    @FXML
    public void handleCancelForm() {
        handleBackToList();
    }

    private void updatePageCopy() {
        if (pageTitleLabel == null || pageSubtitleLabel == null) {
            return;
        }

        if (currentUser == null) {
            pageTitleLabel.setText("Appointments");
            pageSubtitleLabel.setText("Manage consultations and review appointment history.");
            return;
        }

        switch (currentUser.getRole()) {
            case UserService.ROLE_ADMIN -> {
                pageTitleLabel.setText("Appointments Management");
                pageSubtitleLabel.setText("Review, confirm, reschedule, complete, or cancel appointments across the platform.");
            }
            case UserService.ROLE_DOCTOR -> {
                pageTitleLabel.setText("Doctor Appointments");
                pageSubtitleLabel.setText("Manage your patient bookings, confirmations, reschedules, and completions.");
            }
            default -> {
                pageTitleLabel.setText("My Appointments");
                pageSubtitleLabel.setText("Book consultations, check the clinic weather, and keep your e-ticket ready.");
            }
        }
    }

    private void setupTable() {
        dateColumn.setCellValueFactory(cellData -> new SimpleStringProperty(
                cellData.getValue().getAppointmentDate().toLocalDateTime().format(TABLE_DATE_FORMAT)
        ));

        doctorPatientColumn.setCellValueFactory(cellData -> new SimpleStringProperty(
                buildCounterpartLabel(cellData.getValue())
        ));

        statusColumn.setCellValueFactory(cellData -> new SimpleStringProperty(cellData.getValue().getStatus()));
        statusColumn.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(String item, boolean empty) {
                super.updateItem(item, empty);
                getStyleClass().removeAll(
                        "status-pill",
                        "status-pending",
                        "status-confirmed",
                        "status-postponed",
                        "status-completed",
                        "status-cancelled"
                );

                if (empty || item == null) {
                    setText(null);
                    return;
                }

                String normalizedStatus = item.toLowerCase(Locale.ROOT);
                setText(normalizedStatus.toUpperCase(Locale.ROOT));
                getStyleClass().add("status-pill");
                getStyleClass().add("status-" + normalizedStatus);
            }
        });

        notesColumn.setCellValueFactory(cellData -> new SimpleStringProperty(
                cellData.getValue().getNotes() == null || cellData.getValue().getNotes().isBlank()
                        ? "No notes"
                        : cellData.getValue().getNotes()
        ));

        actionsColumn.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty || getIndex() < 0 || getIndex() >= getTableView().getItems().size()) {
                    setGraphic(null);
                    return;
                }
                setGraphic(buildActionButtons(getTableView().getItems().get(getIndex())));
            }
        });
    }

    private void setupFilters() {
        statusFilter.setItems(FXCollections.observableArrayList("All", "pending", "confirmed", "postponed", "completed", "cancelled"));
        statusFilter.setValue("All");
        statusFilter.valueProperty().addListener((obs, oldValue, newValue) -> applyFilters());

        if (searchField != null) {
            searchField.textProperty().addListener((obs, oldValue, newValue) -> applyFilters());
        }
    }

    private void setupAppointmentSelection() {
        appointmentsTable.getSelectionModel().selectedItemProperty().addListener((obs, oldValue, newValue) ->
                updateSelectedAppointmentPreview(newValue));
    }

    private VBox buildActionButtons(Appointment appointment) {
        VBox actions = new VBox(6);

        if (currentUser == null) {
            return actions;
        }

        String role = currentUser.getRole();
        String status = safeValue(appointment.getStatus()).toLowerCase(Locale.ROOT);
        boolean isCancelled = "cancelled".equals(status);
        boolean isCompleted = "completed".equals(status);
        boolean isConfirmed = "confirmed".equals(status);

        if (UserService.ROLE_USER.equals(role)) {
            if (!isCancelled && !isCompleted) {
                actions.getChildren().add(createActionButton("Cancel", true, event -> handleCancelAppointment(appointment)));
            }
            return actions;
        }

        if (!isConfirmed && !isCancelled && !isCompleted) {
            actions.getChildren().add(createActionButton("Confirm", false, event -> updateStatus(appointment, "confirmed")));
        }
        if (!isCancelled && !isCompleted) {
            actions.getChildren().add(createActionButton("Reschedule", false, event -> openRescheduleDialog(appointment)));
            actions.getChildren().add(createActionButton("Cancel", true, event -> updateStatus(appointment, "cancelled")));
        }
        if (!isCompleted && !isCancelled) {
            actions.getChildren().add(createActionButton("Complete", false, event -> updateStatus(appointment, "completed")));
        }

        return actions;
    }

    private Button createActionButton(String text, boolean danger, javafx.event.EventHandler<javafx.event.ActionEvent> handler) {
        Button button = new Button(text);
        button.getStyleClass().add("button");
        if (danger) {
            button.getStyleClass().add("danger-button");
        } else {
            button.getStyleClass().add("secondary");
        }
        button.setStyle("-fx-font-size: 10; -fx-padding: 6 10; -fx-min-width: 110;");
        button.setOnAction(handler);
        return button;
    }

    private void loadAppointments() {
        if (currentUser == null || appointmentsTable == null) {
            return;
        }

        List<Appointment> appointments = switch (currentUser.getRole()) {
            case UserService.ROLE_ADMIN -> appointmentService.getAllAppointments();
            case UserService.ROLE_DOCTOR -> appointmentService.getAppointmentsByDoctor(currentUser.getId());
            default -> appointmentService.getAppointmentsByPatient(currentUser.getId());
        };

        allAppointments.setAll(appointments);
        applyFilters();
    }

    private Appointment findLatestAppointmentForCurrentUser() {
        if (currentUser == null) {
            return null;
        }

        List<Appointment> appointments = switch (currentUser.getRole()) {
            case UserService.ROLE_ADMIN -> appointmentService.getAllAppointments();
            case UserService.ROLE_DOCTOR -> appointmentService.getAppointmentsByDoctor(currentUser.getId());
            default -> appointmentService.getAppointmentsByPatient(currentUser.getId());
        };

        return appointments.stream()
                .max(Comparator.comparing(Appointment::getAppointmentDate))
                .orElse(null);
    }

    private Appointment findMatchingAppointment(int patientId, int doctorId, Timestamp appointmentTimestamp) {
        return appointmentService.getAppointmentsByPatient(patientId).stream()
                .filter(item -> item.getDoctorId() == doctorId)
                .filter(item -> appointmentTimestamp.equals(item.getAppointmentDate()))
                .findFirst()
                .orElseGet(this::findLatestAppointmentForCurrentUser);
    }

    private void applyFilters() {
        if (appointmentsTable == null) {
            return;
        }

        String selectedStatus = statusFilter == null ? "All" : statusFilter.getValue();
        String query = searchField == null || searchField.getText() == null
                ? ""
                : searchField.getText().trim().toLowerCase(Locale.ROOT);

        List<Appointment> filtered = allAppointments.stream()
                .filter(appointment -> selectedStatus == null
                        || "All".equalsIgnoreCase(selectedStatus)
                        || selectedStatus.equalsIgnoreCase(appointment.getStatus()))
                .filter(appointment -> query.isEmpty() || matchesSearch(appointment, query))
                .sorted(Comparator.comparing(Appointment::getAppointmentDate))
                .collect(Collectors.toList());

        appointmentsTable.setItems(FXCollections.observableArrayList(filtered));
        syncAppointmentSelection(filtered);
    }

    private void syncAppointmentSelection(List<Appointment> filtered) {
        if (filtered.isEmpty()) {
            appointmentsTable.getSelectionModel().clearSelection();
            updateSelectedAppointmentPreview(null);
            return;
        }

        Appointment selected = appointmentsTable.getSelectionModel().getSelectedItem();
        if (selected == null || filtered.stream().noneMatch(item -> item.getId() == selected.getId())) {
            appointmentsTable.getSelectionModel().select(filtered.get(0));
            return;
        }

        updateSelectedAppointmentPreview(selected);
    }

    private boolean matchesSearch(Appointment appointment, String query) {
        return safeValue(appointment.getPatientName()).toLowerCase(Locale.ROOT).contains(query)
                || safeValue(appointment.getDoctorName()).toLowerCase(Locale.ROOT).contains(query)
                || safeValue(appointment.getStatus()).toLowerCase(Locale.ROOT).contains(query)
                || safeValue(appointment.getNotes()).toLowerCase(Locale.ROOT).contains(query);
    }

    private void loadDoctors() {
        List<User> doctors = userService.getAllUsers().stream()
                .filter(user -> UserService.ROLE_DOCTOR.equals(user.getRole()))
                .sorted(Comparator.comparing(user -> safeValue(user.getFullName()), String.CASE_INSENSITIVE_ORDER))
                .collect(Collectors.toList());

        doctorCombo.setItems(FXCollections.observableArrayList(doctors));
        doctorCombo.setConverter(new StringConverter<>() {
            @Override
            public String toString(User user) {
                if (user == null) {
                    return "";
                }
                String speciality = user.getSpeciality() == null || user.getSpeciality().isBlank()
                        ? "General consultation"
                        : user.getSpeciality();
                return buildDoctorDisplayName(user) + " - " + speciality;
            }

            @Override
            public User fromString(String string) {
                return null;
            }
        });
    }

    private void populateClinicCopy() {
        if (clinicNameLabel != null) {
            clinicNameLabel.setText(locationService.getClinicName());
        }
        if (clinicAddressLabel != null) {
            clinicAddressLabel.setText(locationService.getClinicAddress());
        }
        if (clinicSummaryLabel != null) {
            clinicSummaryLabel.setText(locationService.getClinicName() + " - " + locationService.getClinicAddress());
        }
    }

    private void loadClinicMapPreview() {
        if (clinicMapImageView == null) {
            return;
        }

        if (mapStatusLabel != null) {
            mapStatusLabel.setText("Loading clinic map preview...");
        }
        tryMapPreview(locationService.getStaticPreviewUrls(), 0);
    }

    private void tryMapPreview(List<String> urls, int index) {
        if (clinicMapImageView == null) {
            return;
        }
        if (index >= urls.size()) {
            if (mapStatusLabel != null) {
                mapStatusLabel.setText("Map preview unavailable. Use the Open clinic map button for directions.");
            }
            clinicMapImageView.setImage(null);
            return;
        }

        Image image = new Image(urls.get(index), 460, 240, false, true, true);
        clinicMapImageView.setImage(image);

        image.errorProperty().addListener((obs, oldValue, newValue) -> {
            if (Boolean.TRUE.equals(newValue)) {
                Platform.runLater(() -> tryMapPreview(urls, index + 1));
            }
        });
        image.progressProperty().addListener((obs, oldValue, newValue) -> {
            if (newValue.doubleValue() >= 1.0 && !image.isError() && mapStatusLabel != null) {
                mapStatusLabel.setText("Clinic preview loaded. Open the map for live directions.");
            }
        });
    }

    private void updateSelectedAppointmentPreview(Appointment appointment) {
        if (selectedAppointmentTitleLabel == null || selectedAppointmentMetaLabel == null || selectedAppointmentStatusLabel == null) {
            return;
        }

        if (appointment == null) {
            selectedAppointmentTitleLabel.setText("Select an appointment");
            selectedAppointmentMetaLabel.setText("Pick a row to generate the e-ticket QR code and review the visit details.");
            applyStatusBadge(selectedAppointmentStatusLabel, null);
            if (qrCodeImageView != null) {
                qrCodeImageView.setImage(null);
            }
            return;
        }

        selectedAppointmentTitleLabel.setText(buildCounterpartLabel(appointment));
        selectedAppointmentMetaLabel.setText(
                appointment.getAppointmentDate().toLocalDateTime().format(TABLE_DATE_FORMAT)
                        + " • " + locationService.getClinicAddress()
        );
        applyStatusBadge(selectedAppointmentStatusLabel, appointment.getStatus());

        if (qrCodeImageView != null) {
            qrCodeImageView.setImage(new Image(qrCodeService.buildQrCodeUrl(appointment), 220, 220, true, true, true));
        }
    }

    private void exportAppointmentPdf(Appointment appointment) {
        FileChooser fileChooser = new FileChooser();
        fileChooser.setTitle("Save appointment proof");
        fileChooser.getExtensionFilters().add(new FileChooser.ExtensionFilter("PDF files", "*.pdf"));
        fileChooser.setInitialFileName(buildPdfFileName(appointment));

        if (pageTitleLabel != null && pageTitleLabel.getScene() != null) {
            java.io.File selectedFile = fileChooser.showSaveDialog(pageTitleLabel.getScene().getWindow());
            savePdfToFile(appointment, selectedFile);
            return;
        }
        if (formTitle != null && formTitle.getScene() != null) {
            java.io.File selectedFile = fileChooser.showSaveDialog(formTitle.getScene().getWindow());
            savePdfToFile(appointment, selectedFile);
        }
    }

    private void savePdfToFile(Appointment appointment, java.io.File selectedFile) {
        if (selectedFile == null) {
            return;
        }

        try {
            appointmentPdfService.exportAppointmentProof(appointment, selectedFile);
            showAlert("PDF saved", "Appointment proof saved successfully.", Alert.AlertType.INFORMATION);
        } catch (IOException e) {
            showAlert("PDF error", "The appointment PDF could not be generated.", Alert.AlertType.ERROR);
        }
    }

    private String buildPdfFileName(Appointment appointment) {
        String datePart = appointment.getAppointmentDate() == null
                ? "appointment"
                : appointment.getAppointmentDate().toLocalDateTime().toLocalDate().toString();
        return "appointment-proof-" + appointment.getId() + "-" + datePart + ".pdf";
    }

    private void applyStatusBadge(Label label, String status) {
        label.getStyleClass().removeAll(
                "table-meta",
                "status-pill",
                "status-pending",
                "status-confirmed",
                "status-postponed",
                "status-completed",
                "status-cancelled"
        );

        if (status == null || status.isBlank()) {
            label.setText("QR preview ready after selection");
            label.getStyleClass().add("table-meta");
            return;
        }

        label.setText(status.toUpperCase(Locale.ROOT));
        label.getStyleClass().add("status-pill");
        label.getStyleClass().add("status-" + status.toLowerCase(Locale.ROOT));
    }

    private String buildCounterpartLabel(Appointment appointment) {
        if (currentUser == null) {
            return appointment.getDoctorName();
        }

        return switch (currentUser.getRole()) {
            case UserService.ROLE_ADMIN -> appointment.getPatientName() + " -> " + appointment.getDoctorName();
            case UserService.ROLE_DOCTOR -> appointment.getPatientName();
            default -> appointment.getDoctorName();
        };
    }

    private String buildDoctorDisplayName(User doctor) {
        if (doctor == null) {
            return "Doctor";
        }

        String fullName = safeValue(doctor.getFullName()).isBlank()
                ? (safeValue(doctor.getFirstName()) + " " + safeValue(doctor.getLastName())).trim()
                : doctor.getFullName().trim();
        return fullName.startsWith("Dr.") ? fullName : "Dr. " + fullName;
    }

    private void handleCancelAppointment(Appointment appointment) {
        Alert confirm = new Alert(
                Alert.AlertType.CONFIRMATION,
                "Cancel this appointment with " + appointment.getDoctorName() + "?",
                ButtonType.YES,
                ButtonType.NO
        );
        confirm.setHeaderText("Cancel appointment");
        confirm.showAndWait().ifPresent(type -> {
            if (type == ButtonType.YES) {
                updateStatus(appointment, "cancelled");
            }
        });
    }

    private void updateStatus(Appointment appointment, String status) {
        if (appointmentService.updateStatus(appointment.getId(), status)) {
            loadAppointments();
        } else {
            showAlert("Error", "The appointment status could not be updated.", Alert.AlertType.ERROR);
        }
    }

    private void openRescheduleDialog(Appointment appointment) {
        Dialog<ButtonType> dialog = new Dialog<>();
        dialog.setTitle("Reschedule appointment");
        dialog.setHeaderText("Choose a new date and time");
        dialog.getDialogPane().getButtonTypes().addAll(ButtonType.OK, ButtonType.CANCEL);

        DatePicker rescheduleDatePicker = new DatePicker(appointment.getAppointmentDate().toLocalDateTime().toLocalDate());
        rescheduleDatePicker.setDayCellFactory(picker -> new DateCell() {
            @Override
            public void updateItem(LocalDate item, boolean empty) {
                super.updateItem(item, empty);
                setDisable(empty || item.isBefore(LocalDate.now()));
            }
        });

        TextField rescheduleTimeField = new TextField(appointment.getAppointmentDate().toLocalDateTime().toLocalTime().format(TIME_INPUT_FORMAT));
        rescheduleTimeField.setPromptText("HH:mm");

        VBox content = new VBox(12,
                new Label("Appointment date"),
                rescheduleDatePicker,
                new Label("Appointment time"),
                rescheduleTimeField
        );
        content.setStyle("-fx-padding: 12;");
        dialog.getDialogPane().setContent(content);

        dialog.showAndWait().ifPresent(result -> {
            if (result != ButtonType.OK) {
                return;
            }

            LocalDate selectedDate = rescheduleDatePicker.getValue();
            if (selectedDate == null) {
                showAlert("Validation", "Please choose a new appointment date.", Alert.AlertType.WARNING);
                return;
            }

            LocalTime selectedTime;
            try {
                selectedTime = LocalTime.parse(rescheduleTimeField.getText().trim(), TIME_INPUT_FORMAT);
            } catch (DateTimeParseException e) {
                showAlert("Validation", "Time must use the HH:mm format.", Alert.AlertType.WARNING);
                return;
            }

            LocalDateTime newDateTime = LocalDateTime.of(selectedDate, selectedTime);
            if (newDateTime.isBefore(LocalDateTime.now())) {
                showAlert("Validation", "The new appointment slot must be in the future.", Alert.AlertType.WARNING);
                return;
            }

            Timestamp newTimestamp = Timestamp.valueOf(newDateTime);
            if (appointmentService.hasAppointmentConflict(appointment.getDoctorId(), newTimestamp, appointment.getId())) {
                showAlert("Conflict", "This doctor already has an appointment at the selected date and time.", Alert.AlertType.WARNING);
                return;
            }
            if (appointmentService.hasPatientDuplicate(appointment.getPatientId(), appointment.getDoctorId(), newTimestamp, appointment.getId())) {
                showAlert("Duplicate", "An appointment already exists for the same patient, doctor, and time.", Alert.AlertType.WARNING);
                return;
            }

            if (appointmentService.rescheduleAppointment(appointment.getId(), newTimestamp, "postponed")) {
                loadAppointments();
            } else {
                showAlert("Error", "The appointment could not be rescheduled.", Alert.AlertType.ERROR);
            }
        });
    }

    private void handleBackToList() {
        loadSubView("/fxml/appointment_list.fxml");
    }

    private void loadSubView(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent view = loader.load();

            Object controller = loader.getController();
            if (controller instanceof AppointmentListController appointmentListController) {
                appointmentListController.setCurrentUser(currentUser);
            } else if (controller instanceof AppointmentCalendarController appointmentCalendarController) {
                appointmentCalendarController.setCurrentUser(currentUser);
            } else if (controller instanceof ProductListController productListController) {
                productListController.setCurrentUser(currentUser);
            }

            StackPane mainContent = null;
            if (appointmentsTable != null && appointmentsTable.getScene() != null) {
                mainContent = (StackPane) appointmentsTable.getScene().lookup("#mainContent");
            } else if (formTitle != null && formTitle.getScene() != null) {
                mainContent = (StackPane) formTitle.getScene().lookup("#mainContent");
            }

            if (mainContent != null) {
                mainContent.getChildren().setAll(view);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private String safeValue(String value) {
        return value == null ? "" : value;
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}
