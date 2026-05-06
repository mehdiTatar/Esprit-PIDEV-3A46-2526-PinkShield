package tn.esprit.controllers;

import javafx.application.Platform;
import javafx.concurrent.Task;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Pos;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.stage.Stage;
import tn.esprit.entities.User;
import tn.esprit.services.AppointmentService;
import tn.esprit.services.OpenAiChatService;
import tn.esprit.services.UserService;
import tn.esprit.tools.SessionManager;
import tn.esprit.utils.AppNavigator;
import tn.esprit.utils.FormValidator;

import java.io.IOException;
import java.time.format.DateTimeFormatter;

public class UserDashboardController {
    private static final DateTimeFormatter TS_FMT = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    @FXML private Label         welcomeLabel;
    @FXML private Label         feedbackLabel;
    @FXML private Label         dashboardRoleLabel;
    @FXML private Label         totalAppointmentsLabel;
    @FXML private Label         upcomingAppointmentsLabel;
    @FXML private Label         patientNameSummaryLabel;
    @FXML private Label         patientEmailSummaryLabel;
    @FXML private Label         patientPhoneSummaryLabel;
    @FXML private Label         patientAddressSummaryLabel;
    @FXML private Label         chatStatusLabel;
    @FXML private TextField     fullNameField;
    @FXML private TextField     emailField;
    @FXML private TextField     phoneField;
    @FXML private TextField     addressField;
    @FXML private PasswordField passwordField;
    @FXML private TextField     accountIdField;
    @FXML private TextField     faceImagePathField;
    @FXML private TextField     faceTokenField;
    @FXML private TextField     createdAtField;
    @FXML private TextField     chatInputField;
    @FXML private StackPane     mainContent;
    @FXML private VBox          dashboardView;
    @FXML private VBox          profileEditView;
    @FXML private VBox          chatLauncherBox;
    @FXML private VBox          chatWidget;
    @FXML private VBox          chatMessagesBox;
    @FXML private Button        navDashboard;
    @FXML private Button        navAppointments;
    @FXML private Button        navProfileEdit;
    @FXML private Button        navBlog;
    @FXML private Button        navProducts;
    @FXML private Button        navWishlist;
    @FXML private Button        navDailyCheckIn;
    @FXML private Button        chatLauncherButton;
    @FXML private Button        chatSendButton;
    @FXML private ScrollPane    chatMessagesScrollPane;

    private final UserService        userService        = new UserService();
    private final AppointmentService appointmentService = new AppointmentService();
    private final OpenAiChatService  openAiChatService  = new OpenAiChatService();
    private User loggedInUser;
    private String previousChatResponseId;
    private boolean chatRequestInFlight;

    @FXML
    public void initialize() {
        FormValidator.attachClearOnInput(feedbackLabel, fullNameField, emailField, phoneField, addressField, passwordField);
        showChatWidget(false);
        setChatStatus("", false);
    }

    public void setLoggedInUser(User user) {
        loggedInUser = user;
        if (user == null) return;
        welcomeLabel.setText("Welcome back, " + user.getFullName());
        if (dashboardRoleLabel != null) dashboardRoleLabel.setText("Patient dashboard");
        populateProfile(); populateSummary(); updateAppointmentCards(); initChat();
    }

    @FXML public void showDashboard()   { updateNav(navDashboard);   populateSummary(); updateAppointmentCards(); mainContent.getChildren().setAll(dashboardView); }
    @FXML public void showProfileEdit() { updateNav(navProfileEdit);  populateProfile(); FormValidator.setMessage(feedbackLabel, "", true); mainContent.getChildren().setAll(profileEditView); }
    @FXML public void showBlog()        { updateNav(navBlog);         loadView("/fxml/front_home.fxml"); }  // our blog
    @FXML public void showAppointments(){ updateNav(navAppointments); loadViewWithUser("/fxml/appointment_list.fxml"); }
    @FXML public void showProducts()    { updateNav(navProducts);     loadViewWithUser("/fxml/product_list.fxml"); }
    @FXML public void showWishlist()    { updateNav(navWishlist);     loadViewWithUser("/fxml/wishlist.fxml"); }
    @FXML public void showDailyCheckIn(){ updateNav(navDailyCheckIn); loadViewWithUser("/fxml/daily_tracking.fxml"); }

    @FXML public void handleEditProfile() { populateProfile(); FormValidator.setMessage(feedbackLabel, "", true); }

    @FXML
    public void handleSaveProfile() {
        if (loggedInUser == null) return;
        FormValidator.clearStates(fullNameField, emailField, phoneField, addressField);
        String name = fullNameField.getText().trim(), email = emailField.getText().trim();
        String phone = phoneField.getText().trim(), address = addressField.getText().trim(), pwd = passwordField.getText();
        if (name.length() < 3) { FormValidator.markInvalid(fullNameField); FormValidator.setMessage(feedbackLabel, "Full name must be at least 3 characters.", true); return; }
        if (!FormValidator.isValidEmail(email)) { FormValidator.markInvalid(emailField); FormValidator.setMessage(feedbackLabel, "Enter a valid email address.", true); return; }
        if (!FormValidator.isValidPhone(phone)) { FormValidator.markInvalid(phoneField); FormValidator.setMessage(feedbackLabel, "Phone must contain 8–20 digits.", true); return; }
        if (address.isEmpty()) { FormValidator.markInvalid(addressField); FormValidator.setMessage(feedbackLabel, "Address is required.", true); return; }
        if (!pwd.isBlank() && pwd.length() < 8) { FormValidator.markInvalid(passwordField); FormValidator.setMessage(feedbackLabel, "Password must be at least 8 characters.", true); return; }
        loggedInUser.setFullName(name); loggedInUser.setEmail(email); loggedInUser.setPhone(phone); loggedInUser.setAddress(address);
        if (!pwd.isBlank()) loggedInUser.setPassword(pwd);
        String err = userService.validateUser(loggedInUser, loggedInUser.getPassword(), true);
        if (err != null) { if (err.toLowerCase().contains("email")) FormValidator.markInvalid(emailField); FormValidator.setMessage(feedbackLabel, err, true); return; }
        if (userService.updateUser(loggedInUser)) { welcomeLabel.setText("Welcome back, " + loggedInUser.getFullName()); populateSummary(); FormValidator.setMessage(feedbackLabel, "Profile updated successfully.", false); }
        else FormValidator.setMessage(feedbackLabel, "Failed to update profile.", true);
    }

    @FXML public void handleLogout() {
        try { SessionManager.logout(); Scene s = AppNavigator.createScene(new FXMLLoader(getClass().getResource("/fxml/login.fxml")).load(), getClass()); AppNavigator.applyStage((Stage) mainContent.getScene().getWindow(), s, "PinkShield Login"); }
        catch (IOException e) { e.printStackTrace(); }
    }

    // ── Chat ──────────────────────────────────────────────────
    @FXML public void handleOpenChatbot()  { showChatWidget(true); initChat(); Platform.runLater(() -> { chatInputField.requestFocus(); scrollChat(); }); }
    @FXML public void handleCloseChatbot() { showChatWidget(false); setChatStatus("", false); }
    @FXML public void handleResetChatbot() { previousChatResponseId = null; chatMessagesBox.getChildren().clear(); setChatStatus("", false); initChat(); Platform.runLater(() -> { chatInputField.clear(); chatInputField.requestFocus(); }); }

    @FXML
    public void handleSendChatMessage() {
        if (chatRequestInFlight || loggedInUser == null) return;
        String msg = chatInputField.getText() == null ? "" : chatInputField.getText().trim();
        if (msg.isEmpty() || msg.length() > 500) return;
        addBubble(msg, true); chatInputField.clear(); setBusy(true, "PinkShield AI is responding…");
        String name = loggedInUser.getFullName(), prevId = previousChatResponseId;
        Task<OpenAiChatService.ChatResponse> t = new Task<>() { @Override protected OpenAiChatService.ChatResponse call() { return openAiChatService.sendMessage(msg, prevId, name); } };
        t.setOnSucceeded(e -> {
            OpenAiChatService.ChatResponse r = t.getValue(); setBusy(false, "");
            if (r == null || !r.success()) { addBubble("I could not answer that. Check the assistant status.", false); return; }
            if (!r.fallbackUsed()) previousChatResponseId = r.responseId();
            if (r.statusMessage() != null && !r.statusMessage().isBlank()) setChatStatus(r.statusMessage(), false);
            addBubble(r.assistantText(), false);
        });
        t.setOnFailed(e -> { setBusy(false, ""); addBubble("The assistant request failed.", false); });
        new Thread(t, "chat-request").start();
    }

    private void initChat() { if (!chatMessagesBox.getChildren().isEmpty()) return; addBubble("Hello " + (loggedInUser == null ? "there" : loggedInUser.getFullName().trim()) + ". How can I help you today?", false); }
    private void showChatWidget(boolean v) { if (chatWidget != null) { chatWidget.setVisible(v); chatWidget.setManaged(v); } if (chatLauncherBox != null) { chatLauncherBox.setVisible(!v); chatLauncherBox.setManaged(!v); } }
    private void setChatStatus(String msg, boolean err) {
        if (chatStatusLabel == null) return; boolean has = msg != null && !msg.isBlank();
        chatStatusLabel.setText(has ? msg : ""); chatStatusLabel.setVisible(has); chatStatusLabel.setManaged(has);
        chatStatusLabel.getStyleClass().removeAll("chat-status-error","chat-status-info");
        if (has) chatStatusLabel.getStyleClass().add(err ? "chat-status-error" : "chat-status-info");
    }
    private void setBusy(boolean busy, String status) { chatRequestInFlight = busy; if (chatInputField != null) chatInputField.setDisable(busy); if (chatSendButton != null) chatSendButton.setDisable(busy); if (chatLauncherButton != null) chatLauncherButton.setDisable(busy); if (busy) setChatStatus(status, false); }
    private void addBubble(String text, boolean user) {
        if (chatMessagesBox == null) return;
        HBox row = new HBox(); row.setAlignment(user ? Pos.CENTER_RIGHT : Pos.CENTER_LEFT); row.getStyleClass().add("chat-message-row");
        Label bubble = new Label(text); bubble.setWrapText(true); bubble.setMaxWidth(250);
        bubble.getStyleClass().addAll("chat-message-bubble", user ? "chat-message-user" : "chat-message-assistant");
        row.getChildren().add(bubble); chatMessagesBox.getChildren().add(row);
        scrollChat();
    }
    private void scrollChat() { Platform.runLater(() -> { if (chatMessagesScrollPane != null) { chatMessagesScrollPane.layout(); chatMessagesScrollPane.setVvalue(1.0); } }); }

    // ── Internals ─────────────────────────────────────────────
    private void populateProfile() {
        if (loggedInUser == null || fullNameField == null) return;
        fullNameField.setText(def(loggedInUser.getFullName())); emailField.setText(def(loggedInUser.getEmail()));
        phoneField.setText(def(loggedInUser.getPhone())); addressField.setText(def(loggedInUser.getAddress()));
        passwordField.clear(); accountIdField.setText(String.valueOf(loggedInUser.getId()));
        if (faceImagePathField != null) faceImagePathField.setText(def(loggedInUser.getFaceImagePath()));
        if (faceTokenField     != null) faceTokenField.setText(def(loggedInUser.getFaceToken()));
        createdAtField.setText(loggedInUser.getCreatedAt() == null ? "" : loggedInUser.getCreatedAt().toLocalDateTime().format(TS_FMT));
    }
    private void populateSummary() {
        if (loggedInUser == null) return;
        if (patientNameSummaryLabel    != null) patientNameSummaryLabel.setText("Name: " + loggedInUser.getFullName());
        if (patientEmailSummaryLabel   != null) patientEmailSummaryLabel.setText("Email: " + loggedInUser.getEmail());
        if (patientPhoneSummaryLabel   != null) patientPhoneSummaryLabel.setText("Phone: " + def(loggedInUser.getPhone(), "Not provided"));
        if (patientAddressSummaryLabel != null) patientAddressSummaryLabel.setText("Address: " + def(loggedInUser.getAddress(), "Not provided"));
    }
    private void updateAppointmentCards() {
        if (totalAppointmentsLabel    != null) totalAppointmentsLabel.setText(String.valueOf(appointmentService.countAppointmentsByPatient(loggedInUser.getId())));
        if (upcomingAppointmentsLabel != null) upcomingAppointmentsLabel.setText(String.valueOf(appointmentService.countUpcomingAppointmentsByPatient(loggedInUser.getId())));
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
            else if (ctrl instanceof WishlistController c)       c.setCurrentUser(loggedInUser);
            else if (ctrl instanceof DailyTrackingController c)  c.setCurrentUser(loggedInUser);
            mainContent.getChildren().setAll(view);
        } catch (IOException e) { e.printStackTrace(); }
    }
    private void updateNav(Button active) {
        for (Button b : new Button[]{navDashboard,navAppointments,navProfileEdit,navBlog,navProducts,navWishlist,navDailyCheckIn})
            if (b != null) b.getStyleClass().remove("active");
        if (active != null) active.getStyleClass().add("active");
    }
    private String def(String v) { return v == null ? "" : v; }
    private String def(String v, String fb) { return (v == null || v.isBlank()) ? fb : v; }
}
