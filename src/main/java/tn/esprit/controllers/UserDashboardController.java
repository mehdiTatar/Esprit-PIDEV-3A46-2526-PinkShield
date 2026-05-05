package tn.esprit.controllers;

import javafx.application.Platform;
import javafx.concurrent.Task;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Pos;
import javafx.scene.control.Alert;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextField;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Region;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import tn.esprit.entities.User;
import tn.esprit.services.AppointmentService;
import tn.esprit.services.OpenAiChatService;
import tn.esprit.services.UserService;
import tn.esprit.utils.AppNavigator;
import tn.esprit.utils.FormValidator;

import java.io.IOException;
import java.time.format.DateTimeFormatter;

public class UserDashboardController {
    private static final DateTimeFormatter PROFILE_TIMESTAMP_FORMAT = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    @FXML private Label welcomeLabel;
    @FXML private Label feedbackLabel;
    @FXML private Label dashboardRoleLabel;
    @FXML private Label totalAppointmentsLabel;
    @FXML private Label upcomingAppointmentsLabel;
    @FXML private Label patientNameSummaryLabel;
    @FXML private Label patientEmailSummaryLabel;
    @FXML private Label patientPhoneSummaryLabel;
    @FXML private Label patientAddressSummaryLabel;
    @FXML private Label chatStatusLabel;
    @FXML private TextField fullNameField;
    @FXML private TextField emailField;
    @FXML private TextField phoneField;
    @FXML private TextField addressField;
    @FXML private PasswordField passwordField;
    @FXML private TextField accountIdField;
    @FXML private TextField faceImagePathField;
    @FXML private TextField faceTokenField;
    @FXML private TextField createdAtField;
    @FXML private TextField chatInputField;

    @FXML private StackPane mainContent;
    @FXML private VBox dashboardView;
    @FXML private VBox profileEditView;
    @FXML private VBox chatLauncherBox;
    @FXML private VBox chatWidget;
    @FXML private VBox chatMessagesBox;
    @FXML private Button navDashboard;
    @FXML private Button navAppointments;
    @FXML private Button navProfileEdit;
    @FXML private Button navBlog;
    @FXML private Button navProducts;
    @FXML private Button navWishlist;
    @FXML private Button navDailyCheckIn;
    @FXML private Button chatLauncherButton;
    @FXML private Button chatSendButton;
    @FXML private ScrollPane chatMessagesScrollPane;

    private final UserService userService = new UserService();
    private final AppointmentService appointmentService = new AppointmentService();
    private final OpenAiChatService openAiChatService = new OpenAiChatService();
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
        if (user == null) {
            return;
        }

        welcomeLabel.setText("Welcome back, " + user.getFullName());
        dashboardRoleLabel.setText("Patient dashboard");
        populateProfile();
        populateDashboardSummary();
        updateAppointmentCards();
        initializeChatbotConversation();
    }

    @FXML
    public void showDashboard() {
        updateNavStyles(navDashboard);
        populateDashboardSummary();
        updateAppointmentCards();
        mainContent.getChildren().setAll(dashboardView);
    }

    @FXML
    public void showProfileEdit() {
        updateNavStyles(navProfileEdit);
        populateProfile();
        FormValidator.setMessage(feedbackLabel, "", true);
        mainContent.getChildren().setAll(profileEditView);
    }

    @FXML
    public void showBlog() {
        updateNavStyles(navBlog);
        loadView("/fxml/blog_list.fxml");
    }

    @FXML
    public void showAppointments() {
        updateNavStyles(navAppointments);
        loadView("/fxml/appointment_list.fxml");
    }

    @FXML
    public void showProducts() {
        updateNavStyles(navProducts);
        loadView("/fxml/product_list.fxml");
    }

    @FXML
    public void showWishlist() {
        updateNavStyles(navWishlist);
        loadView("/fxml/wishlist.fxml");
    }

    @FXML
    public void showDailyCheckIn() {
        updateNavStyles(navDailyCheckIn);
        loadView("/fxml/daily_tracking.fxml");
    }

    @FXML
    public void handleEditProfile() {
        populateProfile();
        FormValidator.setMessage(feedbackLabel, "", true);
    }

    @FXML
    public void handleSaveProfile() {
        if (loggedInUser == null) {
            return;
        }

        FormValidator.clearStates(fullNameField, emailField, phoneField, addressField);

        String fullName = fullNameField.getText().trim();
        String email = emailField.getText().trim();
        String phone = phoneField.getText().trim();
        String address = addressField.getText().trim();
        String password = passwordField.getText();

        if (fullName.length() < 3) {
            FormValidator.markInvalid(fullNameField);
            FormValidator.setMessage(feedbackLabel, "Full name must contain at least 3 characters.", true);
            return;
        }
        if (!FormValidator.isValidEmail(email)) {
            FormValidator.markInvalid(emailField);
            FormValidator.setMessage(feedbackLabel, "Enter a valid email address.", true);
            return;
        }
        if (!FormValidator.isValidPhone(phone)) {
            FormValidator.markInvalid(phoneField);
            FormValidator.setMessage(feedbackLabel, "Phone number must contain 8 to 20 digits.", true);
            return;
        }
        if (address.isEmpty()) {
            FormValidator.markInvalid(addressField);
            FormValidator.setMessage(feedbackLabel, "Address is required.", true);
            return;
        }
        if (!password.isBlank() && password.length() < 8) {
            FormValidator.markInvalid(passwordField);
            FormValidator.setMessage(feedbackLabel, "Password must contain at least 8 characters.", true);
            return;
        }

        loggedInUser.setFullName(fullName);
        loggedInUser.setEmail(email);
        loggedInUser.setPhone(phone);
        loggedInUser.setAddress(address);
        if (!password.isBlank()) {
            loggedInUser.setPassword(password);
        }

        String validationMessage = userService.validateUser(loggedInUser, loggedInUser.getPassword(), true);
        if (validationMessage != null) {
            if (validationMessage.toLowerCase().contains("email")) {
                FormValidator.markInvalid(emailField);
            }
            FormValidator.setMessage(feedbackLabel, validationMessage, true);
            return;
        }

        if (userService.updateUser(loggedInUser)) {
            welcomeLabel.setText("Welcome back, " + loggedInUser.getFullName());
            populateDashboardSummary();
            FormValidator.setMessage(feedbackLabel, "Profile updated successfully.", false);
        } else {
            FormValidator.setMessage(feedbackLabel, "Failed to update profile.", true);
        }
    }

    @FXML
    public void handleLogout() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/login.fxml"));
            Scene scene = AppNavigator.createScene(loader.load(), getClass());

            Stage stage = (Stage) mainContent.getScene().getWindow();
            AppNavigator.applyStage(stage, scene, "PinkShield Login");
        } catch (IOException e) {
            showAlert("Error", "Failed to load login page.", Alert.AlertType.ERROR);
            e.printStackTrace();
        }
    }

    @FXML
    public void handleOpenChatbot() {
        showChatWidget(true);
        initializeChatbotConversation();
        updateChatAvailabilityHint();
        Platform.runLater(() -> {
            chatInputField.requestFocus();
            scrollChatToBottom();
        });
    }

    @FXML
    public void handleCloseChatbot() {
        showChatWidget(false);
        setChatStatus("", false);
    }

    @FXML
    public void handleResetChatbot() {
        previousChatResponseId = null;
        chatMessagesBox.getChildren().clear();
        setChatStatus("", false);
        initializeChatbotConversation();
        updateChatAvailabilityHint();
        Platform.runLater(() -> {
            chatInputField.clear();
            chatInputField.requestFocus();
            scrollChatToBottom();
        });
    }

    @FXML
    public void handleSendChatMessage() {
        if (chatRequestInFlight) {
            return;
        }

        if (loggedInUser == null) {
            setChatStatus("Sign in to use the assistant.", true);
            return;
        }

        String message = chatInputField.getText() == null ? "" : chatInputField.getText().trim();
        if (message.isEmpty()) {
            setChatStatus("Type a message before sending.", true);
            return;
        }
        if (message.length() > 500) {
            setChatStatus("Keep your message under 500 characters.", true);
            return;
        }

        addChatBubble(message, true);
        chatInputField.clear();
        setChatBusy(true, "PinkShield AI is responding...");

        Task<OpenAiChatService.ChatResponse> task = new Task<>() {
            @Override
            protected OpenAiChatService.ChatResponse call() {
                return openAiChatService.sendMessage(message, previousChatResponseId, loggedInUser.getFullName());
            }
        };

        task.setOnSucceeded(event -> {
            OpenAiChatService.ChatResponse response = task.getValue();
            setChatBusy(false, "");

            if (response == null) {
                setChatStatus("The assistant returned an empty response.", true);
                addChatBubble("I could not generate a reply for that request.", false);
                return;
            }

            if (!response.success()) {
                setChatStatus(response.errorMessage(), true);
                addChatBubble("I could not answer that request. Check the assistant status and try again.", false);
                return;
            }

            if (!response.fallbackUsed()) {
                previousChatResponseId = response.responseId();
            }
            if (response.statusMessage() != null && !response.statusMessage().isBlank()) {
                setChatStatus(response.statusMessage(), false);
            } else {
                setChatStatus("", false);
            }
            addChatBubble(response.assistantText(), false);
        });

        task.setOnFailed(event -> {
            setChatBusy(false, "");
            Throwable exception = task.getException();
            String messageText = exception == null || exception.getMessage() == null || exception.getMessage().isBlank()
                    ? "Assistant request failed."
                    : exception.getMessage();
            setChatStatus(messageText, true);
            addChatBubble("The assistant request failed before a reply was returned.", false);
        });

        Thread thread = new Thread(task, "pinkshield-chatbot-request");
        thread.setDaemon(true);
        thread.start();
    }

    private void populateProfile() {
        fullNameField.setText(loggedInUser.getFullName());
        emailField.setText(loggedInUser.getEmail());
        phoneField.setText(loggedInUser.getPhone() == null ? "" : loggedInUser.getPhone());
        addressField.setText(loggedInUser.getAddress() == null ? "" : loggedInUser.getAddress());
        passwordField.clear();
        accountIdField.setText(String.valueOf(loggedInUser.getId()));
        faceImagePathField.setText(loggedInUser.getFaceImagePath() == null ? "" : loggedInUser.getFaceImagePath());
        faceTokenField.setText(loggedInUser.getFaceToken() == null ? "" : loggedInUser.getFaceToken());
        createdAtField.setText(loggedInUser.getCreatedAt() == null
                ? ""
                : loggedInUser.getCreatedAt().toLocalDateTime().format(PROFILE_TIMESTAMP_FORMAT));
    }

    private void populateDashboardSummary() {
        if (loggedInUser == null) {
            return;
        }
        patientNameSummaryLabel.setText("Name: " + loggedInUser.getFullName());
        patientEmailSummaryLabel.setText("Email: " + loggedInUser.getEmail());
        patientPhoneSummaryLabel.setText("Phone: " + (loggedInUser.getPhone() == null || loggedInUser.getPhone().isBlank()
                ? "Not provided"
                : loggedInUser.getPhone()));
        patientAddressSummaryLabel.setText("Address: " + (loggedInUser.getAddress() == null || loggedInUser.getAddress().isBlank()
                ? "Not provided"
                : loggedInUser.getAddress()));
    }

    private void updateAppointmentCards() {
        totalAppointmentsLabel.setText(String.valueOf(appointmentService.countAppointmentsByPatient(loggedInUser.getId())));
        upcomingAppointmentsLabel.setText(String.valueOf(appointmentService.countUpcomingAppointmentsByPatient(loggedInUser.getId())));
    }

    private void initializeChatbotConversation() {
        if (!chatMessagesBox.getChildren().isEmpty()) {
            return;
        }

        String patientName = loggedInUser == null || loggedInUser.getFullName() == null || loggedInUser.getFullName().isBlank()
                ? "there"
                : loggedInUser.getFullName().trim();
        addChatBubble("Hello " + patientName + ". I can help with appointments, daily check-ins, profile updates, the blog, and general wellness guidance inside PinkShield.", false);
    }

    private void updateChatAvailabilityHint() {
        if (!openAiChatService.isConfigured()) {
            setChatStatus("Add your OpenAI API key in openai.properties to enable live AI replies.", true);
            return;
        }

        if (!chatRequestInFlight) {
            setChatStatus("", false);
        }
    }

    private void showChatWidget(boolean visible) {
        chatWidget.setVisible(visible);
        chatWidget.setManaged(visible);
        chatLauncherBox.setVisible(!visible);
        chatLauncherBox.setManaged(!visible);
    }

    private void setChatBusy(boolean busy, String statusMessage) {
        chatRequestInFlight = busy;
        chatInputField.setDisable(busy);
        chatSendButton.setDisable(busy);
        chatLauncherButton.setDisable(busy);
        if (busy) {
            setChatStatus(statusMessage, false);
        }
    }

    private void setChatStatus(String message, boolean error) {
        boolean hasMessage = message != null && !message.isBlank();
        chatStatusLabel.setText(hasMessage ? message : "");
        chatStatusLabel.setVisible(hasMessage);
        chatStatusLabel.setManaged(hasMessage);
        chatStatusLabel.getStyleClass().remove("chat-status-error");
        chatStatusLabel.getStyleClass().remove("chat-status-info");
        if (hasMessage) {
            chatStatusLabel.getStyleClass().add(error ? "chat-status-error" : "chat-status-info");
        }
    }

    private void addChatBubble(String text, boolean userMessage) {
        HBox row = new HBox();
        row.setAlignment(userMessage ? Pos.CENTER_RIGHT : Pos.CENTER_LEFT);
        row.getStyleClass().add("chat-message-row");

        Label bubble = new Label(text);
        bubble.setWrapText(true);
        bubble.setMaxWidth(250);
        bubble.getStyleClass().add("chat-message-bubble");
        bubble.getStyleClass().add(userMessage ? "chat-message-user" : "chat-message-assistant");

        row.getChildren().add(bubble);
        chatMessagesBox.getChildren().add(row);
        scrollChatToBottom();
    }

    private void scrollChatToBottom() {
        Platform.runLater(() -> {
            chatMessagesScrollPane.layout();
            chatMessagesScrollPane.setVvalue(1.0);
        });
    }

    private void loadView(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent view = loader.load();

            Object controller = loader.getController();
            if (controller instanceof BlogListController) {
                ((BlogListController) controller).setCurrentUser(loggedInUser);
            } else if (controller instanceof BlogDetailController) {
                ((BlogDetailController) controller).setCurrentUser(loggedInUser);
            } else if (controller instanceof AppointmentListController) {
                ((AppointmentListController) controller).setCurrentUser(loggedInUser);
            } else if (controller instanceof ProductListController) {
                ((ProductListController) controller).setCurrentUser(loggedInUser);
            } else if (controller instanceof WishlistController) {
                ((WishlistController) controller).setCurrentUser(loggedInUser);
            } else if (controller instanceof DailyTrackingController) {
                ((DailyTrackingController) controller).setCurrentUser(loggedInUser);
            }

            mainContent.getChildren().setAll(view);
        } catch (IOException e) {
            showAlert("Error", "Could not load view: " + fxmlPath, Alert.AlertType.ERROR);
            e.printStackTrace();
        }
    }

    private void updateNavStyles(Button activeBtn) {
        navDashboard.getStyleClass().remove("active");
        navAppointments.getStyleClass().remove("active");
        navProfileEdit.getStyleClass().remove("active");
        navBlog.getStyleClass().remove("active");
        navProducts.getStyleClass().remove("active");
        navWishlist.getStyleClass().remove("active");
        navDailyCheckIn.getStyleClass().remove("active");
        activeBtn.getStyleClass().add("active");
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}
