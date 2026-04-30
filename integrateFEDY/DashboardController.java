package org.example;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.Node;
import javafx.scene.control.Alert;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ListView;
import javafx.scene.control.ToggleButton;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.scene.layout.HBox;
import javafx.scene.control.Label;
import javafx.application.Platform;
import javafx.stage.Stage;

import java.io.IOException;
import java.net.URL;
import java.util.Optional;

public class DashboardController {

    private static final String DARK_MODE_CLASS = "dark-mode";

    @FXML
    private BorderPane rootPane;

    @FXML
    private StackPane contentArea;

    @FXML
    private ToggleButton nightModeToggle;

    @FXML
    private HBox weatherWarningBox;

    @FXML
    private Label weatherLabel;

    @FXML
    private StackPane notificationBellContainer;

    @FXML
    private Label notificationCountLabel;

    @FXML
    private StackPane notificationBadge;

    @FXML
    private VBox notificationDropdown;

    @FXML
    private ListView<String> notificationsList;

    private boolean darkModeEnabled;
    private final WeatherService weatherService = new WeatherService();

    @FXML
    public void initialize() {
        try {
            System.out.println("🔄 DashboardController initializing...");
            
            NavigationManager.getInstance().registerContentArea(contentArea);
            NavigationManager.getInstance().setDarkMode(darkModeEnabled);
            loadWelcomeDashboard();
            applyThemeClass(rootPane);
            
            // Initialize weather widget with real-time data
            try {
                loadWeatherWidget();
                System.out.println("✅ Weather widget loaded");
            } catch (Exception e) {
                System.err.println("⚠️ Weather widget error: " + e.getMessage());
                // Don't crash app if weather fails
            }
            
            // Initialize notification center
            try {
                initializeNotificationCenter();
                System.out.println("✅ Notification center loaded");
            } catch (Exception e) {
                System.err.println("⚠️ Notification center error: " + e.getMessage());
                // Don't crash app if notifications fail
            }
            
            System.out.println("✅ DashboardController initialized successfully");
        } catch (Exception e) {
            System.err.println("❌ CRITICAL ERROR in DashboardController.initialize(): " + e.getMessage());
            e.printStackTrace();
            throw new RuntimeException("Failed to initialize DashboardController", e);
        }
    }

    /**
     * Initialize notification center with bindings
     */
    private void initializeNotificationCenter() {
        NotificationManager notificationManager = NotificationManager.getInstance();

        // Safely bind the unread count label
        if (notificationCountLabel != null) {
            notificationCountLabel.textProperty().bind(
                    notificationManager.getUnreadCountProperty().asString()
            );
        }

        // Hide badge if count is 0
        if (notificationBadge != null) {
            notificationBadge.managedProperty().bind(
                    notificationManager.getUnreadCountProperty().greaterThan(0)
            );
            notificationBadge.visibleProperty().bind(
                    notificationManager.getUnreadCountProperty().greaterThan(0)
            );
        }

        // Safely bind the notifications list
        if (notificationsList != null) {
            notificationsList.setItems(notificationManager.getNotifications());
            notificationsList.setStyle("-fx-font-size: 12px; -fx-padding: 5;");
        } else {
            System.out.println("⚠️ notificationsList is null - ListView not found in FXML");
        }
        
        System.out.println("✅ Notification Center Initialized");
    }

    /**
     * Toggle the notification dropdown visibility
     */
    @FXML
    public void handleToggleNotifications() {
        try {
            if (notificationDropdown == null) {
                System.out.println("⚠️ notificationDropdown is null");
                return;
            }
            
            boolean isVisible = notificationDropdown.isVisible();
            notificationDropdown.setVisible(!isVisible);
            notificationDropdown.setManaged(!isVisible);

            if (!isVisible) {
                // User opened the notifications - mark as read
                NotificationManager.getInstance().markAsRead();
            }
        } catch (Exception e) {
            System.err.println("❌ Error in handleToggleNotifications: " + e.getMessage());
            e.printStackTrace();
        }
    }

    /**
     * Load weather widget asynchronously
     * Fetches real-time weather from OpenWeatherMap API and updates UI
     */
    private void loadWeatherWidget() {
        if (weatherLabel == null || weatherWarningBox == null) {
            System.out.println("⚠️ Weather widget elements not found in FXML");
            return;
        }

        // Set default message while loading
        weatherLabel.setText("🌍 Loading weather data...");
        weatherWarningBox.setStyle("-fx-background-color: #e8f5e9; -fx-border-color: #4caf50; -fx-border-radius: 8; -fx-padding: 12 18;");

        // Fetch weather asynchronously (non-blocking)
        weatherService.fetchWeatherAsync()
                .thenAccept(weatherText -> {
                    // Update UI on JavaFX thread
                    Platform.runLater(() -> {
                        updateWeatherWidget(weatherText);
                    });
                })
                .exceptionally(throwable -> {
                    System.err.println("❌ Error in weather async call: " + throwable.getMessage());
                    Platform.runLater(this::handleWeatherError);
                    return null;
                });
    }

    /**
     * Update weather widget with real-time weather data
     */
    private void updateWeatherWidget(String weatherText) {
        try {
            // Update label with weather info
            weatherLabel.setText(weatherText);
            
            // Style based on the weather condition
            String style = "-fx-text-fill: #1b5e20; -fx-font-size: 13px; -fx-font-weight: 600;";
            weatherLabel.setStyle(style);

            // Update box background with a pleasant green
            weatherWarningBox.setStyle("-fx-background-color: #e8f5e9; -fx-border-color: #4caf50; -fx-border-radius: 8; -fx-padding: 12 18;");

            System.out.println("✅ Weather widget updated: " + weatherText);
        } catch (Exception e) {
            System.err.println("❌ Error updating weather widget: " + e.getMessage());
            handleWeatherError();
        }
    }

    /**
     * Handle weather service errors
     */
    private void handleWeatherError() {
        try {
            weatherLabel.setText("🌍 Unable to fetch weather data");
            weatherWarningBox.setStyle("-fx-background-color: #fff3cd; -fx-border-color: #ffc107; -fx-border-radius: 8; -fx-padding: 12 18;");
            weatherLabel.setStyle("-fx-text-fill: #856404; -fx-font-size: 13px;");
        } catch (Exception e) {
            System.err.println("❌ Error handling weather error: " + e.getMessage());
        }
    }
    
    private void loadWelcomeDashboard() {
        VBox welcomeBox = new VBox(30);
        welcomeBox.setAlignment(javafx.geometry.Pos.CENTER);
        welcomeBox.getStyleClass().add("welcome-dashboard");
        welcomeBox.setStyle("-fx-padding: 40;");

        Label titleLabel = new Label("Welcome to PinkShield");
        titleLabel.getStyleClass().add("dashboard-title");

        Label subtitleLabel = new Label("Your trusted healthcare companion");
        subtitleLabel.getStyleClass().add("dashboard-subtitle");

        HBox featureBox = new HBox(20);
        featureBox.setAlignment(javafx.geometry.Pos.CENTER);

        VBox appointmentsCard = createFeatureCard("📅 Appointments", "Book and manage your healthcare appointments");
        VBox parapharmacieCard = createFeatureCard("💊 Parapharmacie", "Browse healthcare products and add to wishlist");
        VBox wishlistCard = createFeatureCard("❤️ Wishlist", "View your saved products");

        featureBox.getChildren().addAll(appointmentsCard, parapharmacieCard, wishlistCard);

        welcomeBox.getChildren().addAll(titleLabel, subtitleLabel, featureBox);

        contentArea.getChildren().clear();
        contentArea.getChildren().add(welcomeBox);
        applyThemeClass(welcomeBox);
    }

    private VBox createFeatureCard(String title, String description) {
        VBox card = new VBox(10);
        card.getStyleClass().add("feature-card");
        card.setStyle("-fx-padding: 25; -fx-cursor: hand;");
        card.setPrefWidth(250);
        card.setPrefHeight(120);
        card.setAlignment(javafx.geometry.Pos.TOP_LEFT);

        Label iconLabel = new Label(title.split(" ")[0]);
        iconLabel.getStyleClass().add("feature-icon");

        Label titleLabel = new Label(title);
        titleLabel.getStyleClass().add("feature-title");

        Label descLabel = new Label(description);
        descLabel.getStyleClass().add("feature-description");
        descLabel.setWrapText(true);

        card.getChildren().addAll(iconLabel, titleLabel, descLabel);
        
        card.setOnMouseClicked(e -> {
            if (title.contains("Appointments")) {
                handleAppointments();
            } else if (title.contains("Parapharmacie")) {
                handleParapharmacie();
            } else if (title.contains("Wishlist")) {
                handleWishlist();
            }
        });
        
        return card;
    }

    @FXML
    public void handleToggleNightMode() {
        darkModeEnabled = nightModeToggle != null && nightModeToggle.isSelected();
        if (nightModeToggle != null) {
            nightModeToggle.setText(darkModeEnabled ? "Day Mode" : "Night Mode");
        }
        NavigationManager.getInstance().setDarkMode(darkModeEnabled);
        applyThemeClass(rootPane);
        if (!contentArea.getChildren().isEmpty()) {
            applyThemeClass(contentArea.getChildren().getFirst());
        }
    }

    @FXML
    public void handleAppointments() {
        NavigationManager.getInstance().showAppointments();
    }

    @FXML
    public void handleParapharmacie() {
        NavigationManager.getInstance().showParapharmacie();
    }

    @FXML
    public void handleWishlist() {
        NavigationManager.getInstance().showWishlist();
    }

    @FXML
    public void handleRiskAnalyser() {
        NavigationManager.getInstance().showRiskAnalyser();
    }

    @FXML
    public void handleLogout() {
        if (!confirmLogout()) {
            return;
        }

        UserSession.getInstance().cleanUserSession();

        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/Auth.fxml"));
            Parent root = loader.load();
            Stage stage = (Stage) rootPane.getScene().getWindow();
            stage.setScene(new Scene(root, 1400, 800));
            stage.setTitle("PinkShield - Sign In");
            stage.show();
        } catch (IOException e) {
            System.err.println("Error loading login page: " + e.getMessage());
        }
    }

    private boolean confirmLogout() {
        Alert confirmAlert = new Alert(Alert.AlertType.CONFIRMATION);
        confirmAlert.setTitle("Logout Confirmation");
        confirmAlert.setHeaderText("Are you sure you want to log out?");
        confirmAlert.setContentText("You will be returned to the sign in page.");

        Optional<ButtonType> result = confirmAlert.showAndWait();
        return result.isPresent() && result.get() == ButtonType.OK;
    }

    @FXML
    public void handleDashboard() {
        loadWelcomeDashboard();
    }


    private void applyThemeClass(Node node) {
        if (node == null) {
            return;
        }

        if (darkModeEnabled) {
            if (!node.getStyleClass().contains(DARK_MODE_CLASS)) {
                node.getStyleClass().add(DARK_MODE_CLASS);
            }
        } else {
            node.getStyleClass().remove(DARK_MODE_CLASS);
        }
    }
}
