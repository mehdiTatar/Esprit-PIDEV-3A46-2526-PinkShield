package org.example;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.layout.StackPane;
import javafx.application.Platform;
import javafx.scene.layout.VBox;
import javafx.scene.layout.HBox;
import javafx.scene.control.Label;

import java.io.IOException;
import java.net.URL;

public class DashboardController {

    @FXML
    private StackPane contentArea;

    @FXML
    public void initialize() {
        // Load welcome dashboard on startup
        loadWelcomeDashboard();
    }
    
    private void loadWelcomeDashboard() {
        // Create a beautiful welcome dashboard
        VBox welcomeBox = new VBox(30);
        welcomeBox.setAlignment(javafx.geometry.Pos.CENTER);
        welcomeBox.setStyle("-fx-padding: 40; -fx-background-color: linear-gradient(to bottom, #ffe8f5, #f5f6fa);");

        // Welcome Title
        Label titleLabel = new Label("Welcome to PinkShield");
        titleLabel.setStyle("-fx-font-size: 32; -fx-font-weight: bold; -fx-text-fill: #e84393;");

        Label subtitleLabel = new Label("Your trusted healthcare companion");
        subtitleLabel.setStyle("-fx-font-size: 16; -fx-text-fill: #666;");

        // Feature Cards
        HBox featureBox = new HBox(20);
        featureBox.setAlignment(javafx.geometry.Pos.CENTER);

        VBox appointmentsCard = createFeatureCard("📅 Appointments", "Book and manage your healthcare appointments", "#e84393");
        VBox parapharmacieCard = createFeatureCard("💊 Parapharmacie", "Browse healthcare products and add to wishlist", "#ff69b4");
        VBox wishlistCard = createFeatureCard("❤️ Wishlist", "View your saved products", "#ffb142");

        featureBox.getChildren().addAll(appointmentsCard, parapharmacieCard, wishlistCard);

        welcomeBox.getChildren().addAll(titleLabel, subtitleLabel, featureBox);

        contentArea.getChildren().clear();
        contentArea.getChildren().add(welcomeBox);
    }

    private VBox createFeatureCard(String title, String description, String color) {
        VBox card = new VBox(10);
        card.setStyle("-fx-background-color: white; -fx-border-radius: 15; -fx-background-radius: 15; -fx-padding: 25; -fx-effect: dropshadow(gaussian, rgba(232, 67, 147, 0.15), 10, 0, 0, 5); -fx-cursor: hand;");
        card.setPrefWidth(250);
        card.setPrefHeight(120);
        card.setAlignment(javafx.geometry.Pos.TOP_LEFT);

        Label iconLabel = new Label(title.split(" ")[0]);
        iconLabel.setStyle("-fx-font-size: 24;");

        Label titleLabel = new Label(title);
        titleLabel.setStyle("-fx-font-size: 18; -fx-font-weight: bold; -fx-text-fill: " + color + ";");

        Label descLabel = new Label(description);
        descLabel.setStyle("-fx-font-size: 12; -fx-text-fill: #666; -fx-wrap-text: true;");

        card.getChildren().addAll(iconLabel, titleLabel, descLabel);

        return card;
    }

    @FXML
    public void handleAppointments() {
        loadContent("appointment_USER.fxml");
    }

    @FXML
    public void handleParapharmacie() {
        loadContent("parapharmacie_USER.fxml");
    }

    @FXML
    public void handleWishlist() {
        loadContent("wishlist_USER.fxml");
    }

    @FXML
    public void handleLogout() {
        Platform.exit();
    }

    @FXML
    public void handleDashboard() {
        loadWelcomeDashboard();
    }

    private void loadContent(String fxmlFileName) {
        try {
            URL resource = getClass().getResource("/" + fxmlFileName);
            if (resource == null) {
                System.err.println("FXML file not found: " + fxmlFileName);
                return;
            }
            FXMLLoader loader = new FXMLLoader(resource);
            Parent content = loader.load();
            
            contentArea.getChildren().clear();
            contentArea.getChildren().add(content);
        } catch (IOException e) {
            System.err.println("Error loading FXML: " + fxmlFileName);
            e.printStackTrace();
        }
    }
}
