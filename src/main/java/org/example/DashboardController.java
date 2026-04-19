package org.example;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Node;
import javafx.scene.control.ToggleButton;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.StackPane;
import javafx.application.Platform;
import javafx.scene.layout.VBox;
import javafx.scene.layout.HBox;
import javafx.scene.control.Label;

import java.io.IOException;
import java.net.URL;

public class DashboardController {

    private static final String DARK_MODE_CLASS = "dark-mode";

    @FXML
    private BorderPane rootPane;

    @FXML
    private StackPane contentArea;

    @FXML
    private ToggleButton nightModeToggle;

    private boolean darkModeEnabled;

    @FXML
    public void initialize() {
        NavigationManager.getInstance().registerContentArea(contentArea);
        NavigationManager.getInstance().setDarkMode(darkModeEnabled);
        loadWelcomeDashboard();
        applyThemeClass(rootPane);
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
        Platform.exit();
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
