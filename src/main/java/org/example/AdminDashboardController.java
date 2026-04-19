package org.example;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.ToggleButton;
import javafx.scene.control.Label;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;

import java.io.IOException;

public class AdminDashboardController {

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
        if (contentArea != null) {
            contentArea.getChildren().clear();
        }
        applyThemeClass(rootPane);
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
        showEmptyPlaceholder("Appointments");
    }

    @FXML
    public void handleParapharmacie() {
        showEmptyPlaceholder("Parapharmacie");
    }

    @FXML
    public void handleWishlist() {
        showEmptyPlaceholder("Wishlist");
    }

    @FXML
    public void handleRiskAnalyser() {
        showEmptyPlaceholder("Risk Analyser");
    }

    @FXML
    public void handleDashboard() {
        if (contentArea != null) {
            contentArea.getChildren().clear();
        }
    }

    @FXML
    public void handleLogout() {
        try {
            Parent root = FXMLLoader.load(getClass().getResource("/Auth.fxml"));
            Stage stage = (Stage) rootPane.getScene().getWindow();
            stage.setScene(new Scene(root, 1400, 800));
            stage.setTitle("PinkShield - Sign In");
            stage.show();
        } catch (IOException e) {
            e.printStackTrace();
        }
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

    private void showEmptyPlaceholder(String sectionName) {
        if (contentArea == null) {
            return;
        }
        contentArea.getChildren().clear();
    }
}

