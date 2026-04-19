package org.example;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.scene.control.*;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;

import java.sql.SQLException;
import java.sql.Timestamp;
import java.time.LocalDate;
import java.time.LocalDateTime;
import java.time.YearMonth;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class AdminAppointmentController {

    @FXML private ToggleButton btnManagement;
    @FXML private ToggleButton btnCalendar;
    @FXML private VBox managementTab;
    @FXML private VBox calendarTab;
    @FXML private TableView<Appointment> appointmentsTable;
    @FXML private TableColumn<Appointment, Void> actionsColumn;
    @FXML private ComboBox<String> statusFilter;
    @FXML private TextField searchField;
    @FXML private GridPane calendarGrid;
    @FXML private Label monthLabel;

    private final ServiceAppointment serviceAppointment = new ServiceAppointment();
    private final ToggleGroup tabGroup = new ToggleGroup();
    private YearMonth currentMonth = YearMonth.now();

    @FXML
    public void initialize() {
        btnManagement.setToggleGroup(tabGroup);
        btnCalendar.setToggleGroup(tabGroup);
        btnManagement.setSelected(true);

        statusFilter.setItems(FXCollections.observableArrayList("All Statuses", "Pending", "Confirmed", "Postponed", "Cancelled"));
        statusFilter.setValue("All Statuses");
        statusFilter.setOnAction(e -> loadAppointments());

        searchField.setOnKeyReleased(e -> loadAppointments());

        setupTableActions();
        loadAppointments();
    }

    @FXML
    private void handleManagementTab() {
        managementTab.setVisible(true);
        managementTab.setManaged(true);
        calendarTab.setVisible(false);
        calendarTab.setManaged(false);
    }

    @FXML
    private void handleCalendarTab() {
        managementTab.setVisible(false);
        managementTab.setManaged(false);
        calendarTab.setVisible(true);
        calendarTab.setManaged(true);
        buildCalendar();
    }

    @FXML
    private void loadAppointments() {
        try {
            ArrayList<Appointment> all = serviceAppointment.afficherAll();

            String filter = statusFilter != null && statusFilter.getValue() != null
                    ? statusFilter.getValue()
                    : "All Statuses";
            String search = searchField != null && searchField.getText() != null
                    ? searchField.getText().toLowerCase()
                    : "";

            ObservableList<Appointment> filtered = FXCollections.observableArrayList();
            for (Appointment apt : all) {
                String status = apt.getStatus() == null ? "" : apt.getStatus();
                String patientName = apt.getPatient_name() == null ? "" : apt.getPatient_name();
                boolean statusMatch = filter.equals("All Statuses") || status.equalsIgnoreCase(filter);
                boolean searchMatch = search.isEmpty() || patientName.toLowerCase().contains(search);
                if (statusMatch && searchMatch) {
                    filtered.add(apt);
                }
            }

            appointmentsTable.setItems(filtered);
        } catch (Exception e) {
            appointmentsTable.setItems(FXCollections.observableArrayList());
            showError("Error loading appointments: " + e.getMessage());
        }
    }

    private void setupTableActions() {
        if (actionsColumn == null) {
            return;
        }

        actionsColumn.setCellFactory(col -> new TableCell<>() {
            private final Button confirmBtn = new Button("Confirm");
            private final Button postponeBtn = new Button("Postpone");
            private final Button cancelBtn = new Button("Cancel");
            private final HBox actions = new HBox(5, confirmBtn, postponeBtn, cancelBtn);

            {
                confirmBtn.getStyleClass().add("btn-confirm");
                postponeBtn.getStyleClass().add("btn-postpone");
                cancelBtn.getStyleClass().add("btn-cancel");
                actions.setStyle("-fx-alignment: center;");

                confirmBtn.setOnAction(e -> {
                    Appointment apt = getCurrentAppointment();
                    if (apt != null) updateStatus(apt.getId(), "Confirmed");
                });

                postponeBtn.setOnAction(e -> {
                    Appointment apt = getCurrentAppointment();
                    if (apt != null) openPostponeDialog(apt);
                });

                cancelBtn.setOnAction(e -> {
                    Appointment apt = getCurrentAppointment();
                    if (apt != null) updateStatus(apt.getId(), "Cancelled");
                });
            }

            private Appointment getCurrentAppointment() {
                int index = getIndex();
                if (index < 0 || index >= getTableView().getItems().size()) {
                    return null;
                }
                return getTableView().getItems().get(index);
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty || getIndex() < 0 || getIndex() >= getTableView().getItems().size()) {
                    setGraphic(null);
                } else {
                    setGraphic(actions);
                }
            }
        });
    }

    private void updateStatus(int appointmentId, String newStatus) {
        try {
            Appointment apt = findAppointmentById(appointmentId);
            if (apt != null) {
                apt.setStatus(newStatus);
                serviceAppointment.modifier(apt);
                loadAppointments();
                System.out.println("✅ Appointment " + appointmentId + " updated to " + newStatus);
            }
        } catch (SQLException e) {
            showError("Error updating appointment: " + e.getMessage());
        }
    }

    private void openPostponeDialog(Appointment appointment) {
        Dialog<Timestamp> dialog = new Dialog<>();
        dialog.setTitle("Postpone Appointment");
        dialog.setHeaderText("Select new date and time");

        DatePicker datePicker = new DatePicker(LocalDate.now());
        Spinner<Integer> hourSpinner = new Spinner<>(0, 23, 10);
        Spinner<Integer> minuteSpinner = new Spinner<>(0, 59, 0, 15);

        VBox content = new VBox(10);
        content.setPadding(new Insets(15));
        content.getChildren().addAll(
                new Label("Date:"), datePicker,
                new Label("Time: "), new HBox(5, new Label("Hour:"), hourSpinner, new Label("Min:"), minuteSpinner)
        );

        dialog.getDialogPane().setContent(content);
        dialog.getDialogPane().getButtonTypes().addAll(ButtonType.OK, ButtonType.CANCEL);

        dialog.setResultConverter(bt -> {
            if (bt == ButtonType.OK) {
                LocalDateTime newDateTime = LocalDateTime.of(
                        datePicker.getValue(),
                        java.time.LocalTime.of(hourSpinner.getValue(), minuteSpinner.getValue())
                );
                return Timestamp.valueOf(newDateTime);
            }
            return null;
        });

        dialog.showAndWait().ifPresent(newTimestamp -> {
            try {
                appointment.setAppointment_date(newTimestamp);
                appointment.setStatus("Postponed");
                serviceAppointment.modifier(appointment);
                loadAppointments();
                System.out.println("✅ Appointment postponed to " + newTimestamp);
            } catch (SQLException e) {
                showError("Error postponing appointment: " + e.getMessage());
            }
        });
    }

    private void buildCalendar() {
        calendarGrid.getChildren().clear();
        monthLabel.setText(currentMonth.format(DateTimeFormatter.ofPattern("MMMM yyyy")));

        String[] days = {"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"};
        for (int i = 0; i < 7; i++) {
            Label dayLabel = new Label(days[i]);
            dayLabel.setStyle("-fx-font-weight: bold; -fx-alignment: center; -fx-padding: 5;");
            calendarGrid.add(dayLabel, i, 0);
        }

        LocalDate firstOfMonth = currentMonth.atDay(1);
        int dayOfWeek = firstOfMonth.getDayOfWeek().getValue() % 7;
        LocalDate date = firstOfMonth.minusDays(dayOfWeek);

        try {
            ArrayList<Appointment> allAppointments = serviceAppointment.afficherAll();
            Map<LocalDate, java.util.List<String>> appointmentsByDate = new HashMap<>();
            for (Appointment apt : allAppointments) {
                if (apt.getAppointment_date() == null) {
                    continue;
                }
                LocalDate aptDate = apt.getAppointment_date().toLocalDateTime().toLocalDate();
                String patientName = apt.getPatient_name() == null || apt.getPatient_name().isBlank()
                        ? "Patient"
                        : apt.getPatient_name();
                appointmentsByDate.computeIfAbsent(aptDate, k -> new ArrayList<>()).add(patientName);
            }

            int row = 1;
            while (row <= 6) {
                for (int col = 0; col < 7; col++) {
                    VBox dayCell = createDayCell(date, appointmentsByDate.getOrDefault(date, new ArrayList<>()));
                    calendarGrid.add(dayCell, col, row);
                    date = date.plusDays(1);
                }
                row++;
            }
        } catch (Exception e) {
            showError("Error building calendar: " + e.getMessage());
        }
    }

    private VBox createDayCell(LocalDate date, java.util.List<String> appointments) {
        VBox cell = new VBox(2);
        cell.setStyle("-fx-border-color: #ddd; -fx-border-width: 1; -fx-padding: 5; -fx-background-color: " +
                (date.getMonth() == currentMonth.getMonth() ? "#ffffff" : "#f5f5f5") + ";");
        cell.setMinHeight(80);
        cell.setPrefWidth(100);

        Label dateLabel = new Label(String.valueOf(date.getDayOfMonth()));
        dateLabel.setStyle("-fx-font-weight: bold;");
        cell.getChildren().add(dateLabel);

        for (String name : appointments) {
            Label aptLabel = new Label(name);
            aptLabel.setStyle("-fx-font-size: 10; -fx-text-fill: #0984e3; -fx-wrap-text: true;");
            aptLabel.setWrapText(true);
            cell.getChildren().add(aptLabel);
        }

        return cell;
    }

    @FXML
    private void previousMonth() {
        currentMonth = currentMonth.minusMonths(1);
        buildCalendar();
    }

    @FXML
    private void nextMonth() {
        currentMonth = currentMonth.plusMonths(1);
        buildCalendar();
    }

    private Appointment findAppointmentById(int id) throws SQLException {
        ArrayList<Appointment> all = serviceAppointment.afficherAll();
        return all.stream().filter(a -> a.getId() == id).findFirst().orElse(null);
    }

    private void showError(String message) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle("Error");
        alert.setHeaderText("Operation Failed");
        alert.setContentText(message);
        alert.showAndWait();
    }
}

