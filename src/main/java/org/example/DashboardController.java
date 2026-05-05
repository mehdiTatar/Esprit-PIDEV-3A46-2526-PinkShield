package org.example;

import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.ButtonType;
import javafx.scene.control.Label;
import javafx.scene.control.ListView;
import javafx.scene.control.ToggleButton;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;

import java.io.IOException;
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

    @FXML
    private Label zenQuoteLabel;

    @FXML
    private HBox zenAdviceBox;

    private boolean darkModeEnabled;
    private final WeatherService weatherService = new WeatherService();

    @FXML
    public void initialize() {
        try {
            System.out.println("🔄 DashboardController initializing...");

            if (contentArea != null) {
                NavigationManager.getInstance().registerContentArea(contentArea);
            }
            NavigationManager.getInstance().setDarkMode(darkModeEnabled);
            loadWelcomeDashboard();
            applyThemeClass(rootPane);

            try {
                loadWeatherWidget();
                System.out.println("✅ Weather widget loaded");
            } catch (Exception e) {
                System.err.println("⚠️ Weather widget error: " + e.getMessage());
            }

            try {
                initializeNotificationCenter();
                System.out.println("✅ Notification center loaded");
            } catch (Exception e) {
                System.err.println("⚠️ Notification center error: " + e.getMessage());
            }

            try {
                loadZenAdvice();
                System.out.println("✅ Zen advice widget loaded");
            } catch (Exception e) {
                System.err.println("⚠️ Zen advice widget error: " + e.getMessage());
            }

            System.out.println("✅ DashboardController initialized successfully");
        } catch (Exception e) {
            System.err.println("❌ CRITICAL ERROR in DashboardController.initialize(): " + e.getMessage());
            e.printStackTrace();
            throw new RuntimeException("Failed to initialize DashboardController", e);
        }
    }

    private void initializeNotificationCenter() {
        NotificationManager notificationManager = NotificationManager.getInstance();

        if (notificationCountLabel != null) {
            notificationCountLabel.textProperty().bind(notificationManager.getUnreadCountProperty().asString());
        }

        if (notificationBadge != null) {
            notificationBadge.managedProperty().bind(notificationManager.getUnreadCountProperty().greaterThan(0));
            notificationBadge.visibleProperty().bind(notificationManager.getUnreadCountProperty().greaterThan(0));
        }

        if (notificationsList != null) {
            notificationsList.setItems(notificationManager.getNotifications());
            notificationsList.setStyle("-fx-font-size: 12px; -fx-padding: 5;");
        } else {
            System.out.println("⚠️ notificationsList is null - ListView not found in FXML");
        }

        System.out.println("✅ Notification Center Initialized");
    }

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
                NotificationManager.getInstance().markAsRead();
            }
        } catch (Exception e) {
            System.err.println("❌ Error in handleToggleNotifications: " + e.getMessage());
            e.printStackTrace();
        }
    }

    private void loadWeatherWidget() {
        if (weatherLabel == null || weatherWarningBox == null) {
            System.out.println("⚠️ Weather widget elements not found in FXML");
            return;
        }

        weatherLabel.setText("🌍 Loading weather data...");
        weatherWarningBox.setStyle("-fx-background-color: #e8f5e9; -fx-border-color: #4caf50; -fx-border-radius: 8; -fx-padding: 12 18;");

        weatherService.fetchWeatherAsync()
                .thenAccept(weatherText -> Platform.runLater(() -> updateWeatherWidget(weatherText)))
                .exceptionally(throwable -> {
                    System.err.println("❌ Error in weather async call: " + throwable.getMessage());
                    Platform.runLater(this::handleWeatherError);
                    return null;
                });
    }

    private void updateWeatherWidget(String weatherText) {
        try {
            weatherLabel.setText(weatherText);
            weatherLabel.setStyle("-fx-text-fill: #1b5e20; -fx-font-size: 13px; -fx-font-weight: 600;");
            weatherWarningBox.setStyle("-fx-background-color: #e8f5e9; -fx-border-color: #4caf50; -fx-border-radius: 8; -fx-padding: 12 18;");
            System.out.println("✅ Weather widget updated: " + weatherText);
        } catch (Exception e) {
            System.err.println("❌ Error updating weather widget: " + e.getMessage());
            handleWeatherError();
        }
    }

    private void handleWeatherError() {
        try {
            weatherLabel.setText("🌍 Unable to fetch weather data");
            weatherWarningBox.setStyle("-fx-background-color: #fff3cd; -fx-border-color: #ffc107; -fx-border-radius: 8; -fx-padding: 12 18;");
            weatherLabel.setStyle("-fx-text-fill: #856404; -fx-font-size: 13px;");
        } catch (Exception e) {
            System.err.println("❌ Error handling weather error: " + e.getMessage());
        }
    }

    private void loadZenAdvice() {
        if (zenQuoteLabel == null || zenAdviceBox == null) {
            System.out.println("⚠️ Zen advice widget elements not found in FXML");
            return;
        }

        zenQuoteLabel.setText("🧘 Loading wellness tip...");
        zenAdviceBox.setStyle("-fx-padding: 15 18; -fx-background-radius: 12; -fx-border-radius: 12; -fx-background-color: #f0f4ff; -fx-border-color: #7c3aed; -fx-border-width: 1.5;");

        ZenAdviceService.fetchZenAdviceAsync()
                .thenAccept(advice -> Platform.runLater(() -> updateZenAdvice(advice)))
                .exceptionally(throwable -> {
                    System.err.println("❌ Error in zen advice async call: " + throwable.getMessage());
                    Platform.runLater(this::handleZenAdviceError);
                    return null;
                });
    }

    private void updateZenAdvice(String advice) {
        try {
            zenQuoteLabel.setText(advice);
            zenQuoteLabel.setStyle("-fx-font-size: 13px; -fx-font-weight: 600; -fx-text-fill: #6d28d9;");
            zenAdviceBox.setStyle("-fx-padding: 15 18; -fx-background-radius: 12; -fx-border-radius: 12; -fx-background-color: #f0f4ff; -fx-border-color: #7c3aed; -fx-border-width: 1.5;");
            System.out.println("✅ Zen advice widget updated: " + advice);
        } catch (Exception e) {
            System.err.println("❌ Error updating zen advice widget: " + e.getMessage());
            handleZenAdviceError();
        }
    }

    private void handleZenAdviceError() {
        try {
            zenQuoteLabel.setText("💡 Prenez un moment pour respirer profondément aujourd'hui.");
            zenAdviceBox.setStyle("-fx-padding: 15 18; -fx-background-radius: 12; -fx-border-radius: 12; -fx-background-color: #fef3c7; -fx-border-color: #f59e0b; -fx-border-width: 1.5;");
            zenQuoteLabel.setStyle("-fx-font-size: 13px; -fx-font-weight: 600; -fx-text-fill: #92400e;");
        } catch (Exception e) {
            System.err.println("❌ Error handling zen advice error: " + e.getMessage());
        }
    }

    private void loadWelcomeDashboard() {
        if (contentArea == null) {
            return;
        }

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

        if (contentArea != null && !contentArea.getChildren().isEmpty()) {
            applyThemeClass(contentArea.getChildren().get(0));
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
