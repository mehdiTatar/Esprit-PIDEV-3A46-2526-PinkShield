package tn.esprit.controllers;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import tn.esprit.entities.User;
import tn.esprit.services.AppointmentService;
import tn.esprit.services.UserService;
import tn.esprit.tools.SessionManager;
import tn.esprit.utils.AppNavigator;
import tn.esprit.utils.FormValidator;

import java.io.IOException;
import java.time.format.DateTimeFormatter;

public class DoctorDashboardController {
    private static final DateTimeFormatter TS_FMT = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    @FXML private Label         welcomeLabel;
    @FXML private Label         feedbackLabel;
    @FXML private TextField     firstNameField;
    @FXML private TextField     lastNameField;
    @FXML private TextField     emailField;
    @FXML private TextField     specialityField;
    @FXML private PasswordField passwordField;
    @FXML private TextField     accountIdField;
    @FXML private TextField     createdAtField;
    @FXML private Label         totalAppointmentsLabel;
    @FXML private Label         upcomingAppointmentsLabel;
    @FXML private Label         dashboardRoleLabel;
    @FXML private Label         doctorNameSummaryLabel;
    @FXML private Label         doctorEmailSummaryLabel;
    @FXML private Label         doctorSpecialitySummaryLabel;
    @FXML private StackPane     mainContent;
    @FXML private VBox          dashboardView;
    @FXML private VBox          profileEditView;
    @FXML private Button        navDashboard;
    @FXML private Button        navAppointments;
    @FXML private Button        navProfileEdit;
    @FXML private Button        navBlog;
    @FXML private Button        navProducts;
    @FXML private Button        navDailyCheckIn;

    private final UserService        userService        = new UserService();
    private final AppointmentService appointmentService = new AppointmentService();
    private User loggedInUser;

    @FXML
    public void initialize() {
        FormValidator.attachClearOnInput(feedbackLabel, firstNameField, lastNameField, emailField, specialityField, passwordField);
    }

    public void setLoggedInUser(User user) {
        loggedInUser = user;
        if (user == null) return;
        welcomeLabel.setText("Dr. " + user.getLastName() + ", your workspace is ready");
        if (dashboardRoleLabel != null) dashboardRoleLabel.setText(user.getSpeciality() == null || user.getSpeciality().isBlank() ? "Doctor account" : user.getSpeciality());
        populateProfile(); populateSummary(); updateAppointmentCards();
    }

    @FXML public void showDashboard()  { updateNav(navDashboard);  populateSummary(); updateAppointmentCards(); mainContent.getChildren().setAll(dashboardView); }
    @FXML public void showProfileEdit(){ updateNav(navProfileEdit); populateProfile(); FormValidator.setMessage(feedbackLabel, "", true); mainContent.getChildren().setAll(profileEditView); }
    @FXML public void showBlog()       { updateNav(navBlog);        loadView("/fxml/front_home.fxml"); }   // our blog
    @FXML public void showAppointments()  { updateNav(navAppointments); loadViewWithUser("/fxml/appointment_list.fxml"); }
    @FXML public void showProducts()      { updateNav(navProducts);     loadViewWithUser("/fxml/product_list.fxml"); }
    @FXML public void showDailyCheckIn()  { updateNav(navDailyCheckIn); loadViewWithUser("/fxml/daily_tracking.fxml"); }

    @FXML public void handleResetProfile() { populateProfile(); FormValidator.setMessage(feedbackLabel, "", true); }

    @FXML
    public void handleSaveProfile() {
        if (loggedInUser == null) return;
        FormValidator.clearStates(firstNameField, lastNameField, emailField, specialityField);
        String fn = firstNameField.getText().trim(), ln = lastNameField.getText().trim();
        String email = emailField.getText().trim(), spec = specialityField.getText().trim(), pwd = passwordField.getText();
        if (fn.isEmpty())    { FormValidator.markInvalid(firstNameField); FormValidator.setMessage(feedbackLabel, "First name is required.", true); return; }
        if (ln.isEmpty())    { FormValidator.markInvalid(lastNameField);  FormValidator.setMessage(feedbackLabel, "Last name is required.", true); return; }
        if (!FormValidator.isValidEmail(email)) { FormValidator.markInvalid(emailField); FormValidator.setMessage(feedbackLabel, "Enter a valid email.", true); return; }
        if (spec.isEmpty())  { FormValidator.markInvalid(specialityField); FormValidator.setMessage(feedbackLabel, "Speciality is required.", true); return; }
        if (!pwd.isBlank() && pwd.length() < 8) { FormValidator.markInvalid(passwordField); FormValidator.setMessage(feedbackLabel, "Password must be at least 8 characters.", true); return; }
        loggedInUser.setFirstName(fn); loggedInUser.setLastName(ln); loggedInUser.setFullName((fn+" "+ln).trim());
        loggedInUser.setEmail(email); loggedInUser.setSpeciality(spec);
        if (!pwd.isBlank()) loggedInUser.setPassword(pwd);
        String err = userService.validateUser(loggedInUser, loggedInUser.getPassword(), true);
        if (err != null) { FormValidator.markInvalid(emailField); FormValidator.setMessage(feedbackLabel, err, true); return; }
        if (userService.updateUser(loggedInUser)) {
            welcomeLabel.setText("Dr. " + loggedInUser.getLastName() + ", your workspace is ready");
            if (dashboardRoleLabel != null) dashboardRoleLabel.setText(loggedInUser.getSpeciality());
            populateSummary(); FormValidator.setMessage(feedbackLabel, "Profile updated successfully.", false);
        } else FormValidator.setMessage(feedbackLabel, "Failed to update profile.", true);
    }

    @FXML
    public void handleLogout() {
        try {
            SessionManager.logout();
            Scene scene = AppNavigator.createScene(new FXMLLoader(getClass().getResource("/fxml/login.fxml")).load(), getClass());
            AppNavigator.applyStage((Stage) mainContent.getScene().getWindow(), scene, "PinkShield Login");
        } catch (IOException e) { e.printStackTrace(); }
    }

    private void populateProfile() {
        if (loggedInUser == null || firstNameField == null) return;
        firstNameField.setText(def(loggedInUser.getFirstName())); lastNameField.setText(def(loggedInUser.getLastName()));
        emailField.setText(def(loggedInUser.getEmail())); specialityField.setText(def(loggedInUser.getSpeciality()));
        passwordField.clear(); accountIdField.setText(String.valueOf(loggedInUser.getId()));
        createdAtField.setText(loggedInUser.getCreatedAt() == null ? "" : loggedInUser.getCreatedAt().toLocalDateTime().format(TS_FMT));
    }
    private void populateSummary() {
        if (loggedInUser == null) return;
        if (doctorNameSummaryLabel       != null) doctorNameSummaryLabel.setText("Name: Dr. " + loggedInUser.getFullName());
        if (doctorEmailSummaryLabel      != null) doctorEmailSummaryLabel.setText("Email: " + loggedInUser.getEmail());
        if (doctorSpecialitySummaryLabel != null) doctorSpecialitySummaryLabel.setText("Speciality: " + def(loggedInUser.getSpeciality(), "Not specified"));
    }
    private void updateAppointmentCards() {
        if (totalAppointmentsLabel    != null) totalAppointmentsLabel.setText(String.valueOf(appointmentService.countAppointmentsByDoctor(loggedInUser.getId())));
        if (upcomingAppointmentsLabel != null) upcomingAppointmentsLabel.setText(String.valueOf(appointmentService.countUpcomingAppointmentsByDoctor(loggedInUser.getId())));
    }
    private void loadView(String fxml) {
        try {
            Parent view = new FXMLLoader(getClass().getResource(fxml)).load();
            mainContent.getChildren().setAll(view);
        } catch (IOException e) { e.printStackTrace(); }
    }

    private void loadViewWithUser(String fxml) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxml));
            Parent view = loader.load();
            Object ctrl = loader.getController();
            if (ctrl instanceof AppointmentListController c)     c.setCurrentUser(loggedInUser);
            else if (ctrl instanceof AppointmentCalendarController c) c.setCurrentUser(loggedInUser);
            else if (ctrl instanceof ProductListController c)    c.setCurrentUser(loggedInUser);
            else if (ctrl instanceof DailyTrackingController c)  c.setCurrentUser(loggedInUser);
            mainContent.getChildren().setAll(view);
        } catch (IOException e) { e.printStackTrace(); }
    }
    private void updateNav(Button active) {
        for (Button b : new Button[]{navDashboard, navAppointments, navProfileEdit, navBlog, navProducts, navDailyCheckIn})
            if (b != null) b.getStyleClass().remove("active");
        if (active != null) active.getStyleClass().add("active");
    }
    private String def(String v) { return v == null ? "" : v; }
    private String def(String v, String fallback) { return (v == null || v.isBlank()) ? fallback : v; }
}
