package org.example;

import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.layout.StackPane;

import java.io.IOException;
import java.net.URL;

public final class NavigationManager {

    private static final NavigationManager INSTANCE = new NavigationManager();
    private static final String DARK_MODE_CLASS = "dark-mode";

    private StackPane contentArea;
    private boolean darkModeEnabled;

    private NavigationManager() {
    }

    public static NavigationManager getInstance() {
        return INSTANCE;
    }

    public void registerContentArea(StackPane contentArea) {
        this.contentArea = contentArea;
    }

    public void setDarkMode(boolean enabled) {
        this.darkModeEnabled = enabled;
        applyDarkModeToCurrentContent();
    }

    public void showAppointments() {
        loadContent("/appointment_USER.fxml");
    }

    public void showAppointmentCalendar() {
        loadContent("/appointment_calendar_USER.fxml");
    }

    public void showParapharmacie() {
        loadContent("/parapharmacie_USER.fxml");
    }

    public void showWishlist() {
        loadContent("/wishlist_USER.fxml");
    }

    public void showRiskAnalyser() {
        loadContent("/risk_analyser_USER.fxml");
    }

    public void showAiSuggestions(String patientNotes) {
        loadTypedContent("/ai_suggestions.fxml", AiSuggestionsController.class,
                controller -> controller.setPatientNotes(patientNotes));
    }

    private void loadContent(String resourcePath) {
        loadTypedContent(resourcePath, Object.class, null);
    }

    private <T> void loadTypedContent(String resourcePath, Class<T> controllerType, TypedControllerInitializer<T> initializer) {
        if (contentArea == null) {
            return;
        }

        try {
            URL resource = getClass().getResource(resourcePath);
            if (resource == null) {
                System.err.println("FXML not found: " + resourcePath);
                return;
            }

            FXMLLoader loader = new FXMLLoader(resource);
            Parent root = loader.load();
            if (initializer != null) {
                T controller = controllerType.cast(loader.getController());
                initializer.init(controller);
            }

            applyTheme(root);
            contentArea.getChildren().setAll(root);
        } catch (IOException e) {
            System.err.println("Error loading view: " + resourcePath);
            System.err.println(e.getMessage());
        }
    }

    private void applyDarkModeToCurrentContent() {
        if (contentArea == null || contentArea.getChildren().isEmpty()) {
            return;
        }
        applyTheme(contentArea.getChildren().getFirst());
    }

    private void applyTheme(Node node) {
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


    @FunctionalInterface
    private interface TypedControllerInitializer<T> {
        void init(T controller);
    }
}

