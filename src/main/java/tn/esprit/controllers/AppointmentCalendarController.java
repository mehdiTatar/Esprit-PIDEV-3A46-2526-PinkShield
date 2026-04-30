package tn.esprit.controllers;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Pos;
import javafx.scene.Parent;
import javafx.scene.control.Label;
import javafx.scene.control.Tooltip;
import javafx.scene.layout.ColumnConstraints;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Priority;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import tn.esprit.entities.Appointment;
import tn.esprit.entities.User;
import tn.esprit.services.AppointmentService;
import tn.esprit.services.UserService;

import java.io.IOException;
import java.time.DayOfWeek;
import java.time.LocalDate;
import java.time.YearMonth;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Locale;
import java.util.Map;

public class AppointmentCalendarController {
    private static final DateTimeFormatter MONTH_FORMAT = DateTimeFormatter.ofPattern("MMMM yyyy", Locale.ENGLISH);

    @FXML private Label pageTitleLabel;
    @FXML private Label pageSubtitleLabel;
    @FXML private Label monthLabel;
    @FXML private GridPane calendarGrid;

    private final AppointmentService appointmentService = new AppointmentService();
    private User currentUser;
    private YearMonth currentMonth = YearMonth.now();
    private final Map<LocalDate, List<Appointment>> appointmentsByDate = new LinkedHashMap<>();

    @FXML
    public void initialize() {
        renderCalendar();
    }

    public void setCurrentUser(User user) {
        this.currentUser = user;
        updatePageCopy();
        loadAppointments();
        renderCalendar();
    }

    @FXML
    public void handlePreviousMonth() {
        currentMonth = currentMonth.minusMonths(1);
        renderCalendar();
    }

    @FXML
    public void handleNextMonth() {
        currentMonth = currentMonth.plusMonths(1);
        renderCalendar();
    }

    @FXML
    public void handleRefresh() {
        loadAppointments();
        renderCalendar();
    }

    @FXML
    public void handleBackToList() {
        loadSubView("/fxml/appointment_list.fxml");
    }

    private void updatePageCopy() {
        if (pageTitleLabel == null || pageSubtitleLabel == null) {
            return;
        }

        if (currentUser == null) {
            pageTitleLabel.setText("Appointment Calendar");
            pageSubtitleLabel.setText("Review appointment dates on a monthly schedule.");
            return;
        }

        switch (currentUser.getRole()) {
            case UserService.ROLE_ADMIN -> {
                pageTitleLabel.setText("Appointments Calendar");
                pageSubtitleLabel.setText("Track the full appointment schedule and spot busy days quickly.");
            }
            case UserService.ROLE_DOCTOR -> {
                pageTitleLabel.setText("Doctor Schedule");
                pageSubtitleLabel.setText("Review your upcoming patient bookings month by month.");
            }
            default -> {
                pageTitleLabel.setText("My Appointment Calendar");
                pageSubtitleLabel.setText("See your booked consultations and upcoming doctor visits by date.");
            }
        }
    }

    private void loadAppointments() {
        appointmentsByDate.clear();
        if (currentUser == null) {
            return;
        }

        List<Appointment> appointments = switch (currentUser.getRole()) {
            case UserService.ROLE_ADMIN -> appointmentService.getAllAppointments();
            case UserService.ROLE_DOCTOR -> appointmentService.getAppointmentsByDoctor(currentUser.getId());
            default -> appointmentService.getAppointmentsByPatient(currentUser.getId());
        };

        for (Appointment appointment : appointments) {
            if (appointment.getAppointmentDate() == null) {
                continue;
            }
            LocalDate date = appointment.getAppointmentDate().toLocalDateTime().toLocalDate();
            appointmentsByDate.computeIfAbsent(date, ignored -> new ArrayList<>()).add(appointment);
        }
    }

    private void renderCalendar() {
        if (calendarGrid == null || monthLabel == null) {
            return;
        }

        calendarGrid.getChildren().clear();
        calendarGrid.getColumnConstraints().clear();
        for (int column = 0; column < 7; column++) {
            ColumnConstraints constraints = new ColumnConstraints();
            constraints.setPercentWidth(100.0 / 7.0);
            constraints.setHgrow(Priority.ALWAYS);
            calendarGrid.getColumnConstraints().add(constraints);
        }

        monthLabel.setText(currentMonth.format(MONTH_FORMAT));

        String[] headers = {"Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"};
        for (int column = 0; column < headers.length; column++) {
            Label header = new Label(headers[column]);
            header.getStyleClass().add("calendar-day-header");
            header.setMaxWidth(Double.MAX_VALUE);
            header.setAlignment(Pos.CENTER);
            calendarGrid.add(header, column, 0);
        }

        LocalDate firstDay = currentMonth.atDay(1);
        int firstColumn = firstDay.getDayOfWeek().getValue() - DayOfWeek.MONDAY.getValue();
        int daysInMonth = currentMonth.lengthOfMonth();

        int row = 1;
        int column = Math.max(0, firstColumn);
        for (int day = 1; day <= daysInMonth; day++) {
            LocalDate date = currentMonth.atDay(day);
            calendarGrid.add(createDayCell(date), column, row);

            column++;
            if (column > 6) {
                column = 0;
                row++;
            }
        }
    }

    private VBox createDayCell(LocalDate date) {
        VBox cell = new VBox(6);
        cell.getStyleClass().add("calendar-day-cell");
        cell.setFillWidth(true);
        cell.setMinHeight(96);
        cell.setPrefHeight(112);

        Label dayNumber = new Label(String.valueOf(date.getDayOfMonth()));
        dayNumber.getStyleClass().add("calendar-day-number");
        cell.getChildren().add(dayNumber);

        if (date.equals(LocalDate.now())) {
            cell.getStyleClass().add("calendar-day-today");
        }

        List<Appointment> appointments = appointmentsByDate.get(date);
        if (appointments == null || appointments.isEmpty()) {
            Label emptyLabel = new Label("No appointments");
            emptyLabel.getStyleClass().add("calendar-day-empty");
            cell.getChildren().add(emptyLabel);
            return cell;
        }

        StringBuilder tooltipText = new StringBuilder();
        for (Appointment appointment : appointments) {
            String markerText = currentUser != null && UserService.ROLE_USER.equals(currentUser.getRole())
                    ? appointment.getDoctorName()
                    : appointment.getPatientName();

            Label marker = new Label(shortenMarker(markerText));
            marker.getStyleClass().add("calendar-day-marker");
            cell.getChildren().add(marker);

            if (!tooltipText.isEmpty()) {
                tooltipText.append("\n");
            }
            tooltipText.append(formatTooltipLine(appointment));
        }

        Tooltip.install(cell, new Tooltip(tooltipText.toString()));
        return cell;
    }

    private String shortenMarker(String value) {
        if (value == null || value.isBlank()) {
            return "Appointment";
        }

        String normalized = value.replace("Dr. ", "").trim();
        if (normalized.length() <= 18) {
            return normalized;
        }
        return normalized.substring(0, 18).trim() + "...";
    }

    private String formatTooltipLine(Appointment appointment) {
        String counterpart = currentUser != null && UserService.ROLE_USER.equals(currentUser.getRole())
                ? appointment.getDoctorName()
                : appointment.getPatientName();
        String status = appointment.getStatus() == null ? "pending" : appointment.getStatus();
        String time = appointment.getAppointmentDate() == null
                ? ""
                : appointment.getAppointmentDate().toLocalDateTime().toLocalTime().toString();
        return counterpart + " | " + time + " | " + status;
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
            }

            if (calendarGrid != null && calendarGrid.getScene() != null) {
                StackPane mainContent = (StackPane) calendarGrid.getScene().lookup("#mainContent");
                if (mainContent != null) {
                    mainContent.getChildren().setAll(view);
                }
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
