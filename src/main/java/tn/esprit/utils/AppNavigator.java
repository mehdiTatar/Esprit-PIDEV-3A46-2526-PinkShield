package tn.esprit.utils;

import javafx.fxml.FXMLLoader;
import javafx.geometry.Rectangle2D;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Screen;
import javafx.stage.Stage;

import java.io.IOException;

public final class AppNavigator {
    // Default dimensions
    public static final double APP_WIDTH = 1240;
    public static final double APP_HEIGHT = 820;
    public static final double MIN_WIDTH = 800;
    public static final double MIN_HEIGHT = 600;

    private AppNavigator() {
    }

    /**
     * Calculate optimal window size based on screen dimensions
     * Uses 85% of screen width/height or default size, whichever is smaller
     */
    private static double getOptimalWidth() {
        Rectangle2D screenBounds = Screen.getPrimary().getVisualBounds();
        double screenWidth = screenBounds.getWidth();
        double optimalWidth = screenWidth * 0.85;
        return Math.min(optimalWidth, APP_WIDTH);
    }

    private static double getOptimalHeight() {
        Rectangle2D screenBounds = Screen.getPrimary().getVisualBounds();
        double screenHeight = screenBounds.getHeight();
        double optimalHeight = screenHeight * 0.85;
        return Math.min(optimalHeight, APP_HEIGHT);
    }

    public static Scene createScene(Parent root, Class<?> resourceBase) {
        double width = getOptimalWidth();
        double height = getOptimalHeight();
        Scene scene = new Scene(root, width, height);
        scene.getStylesheets().add(resourceBase.getResource("/css/style.css").toExternalForm());
        return scene;
    }

    public static Parent load(Class<?> resourceBase, String fxmlPath) throws IOException {
        FXMLLoader loader = new FXMLLoader(resourceBase.getResource(fxmlPath));
        return loader.load();
    }

    public static void applyStage(Stage stage, Scene scene, String title) {
        double optimalWidth = getOptimalWidth();
        double optimalHeight = getOptimalHeight();

        stage.setTitle(title);
        stage.setScene(scene);
        stage.setWidth(optimalWidth);
        stage.setHeight(optimalHeight);
        stage.setMinWidth(MIN_WIDTH);
        stage.setMinHeight(MIN_HEIGHT);
        stage.setResizable(true);
        stage.centerOnScreen();
        stage.show();
    }
}
