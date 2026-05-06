package tn.esprit.utils;

import javafx.geometry.Rectangle2D;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Screen;
import javafx.stage.Stage;

public final class AppNavigator {
    public static final double APP_WIDTH  = 1240;
    public static final double APP_HEIGHT = 820;
    public static final double MIN_WIDTH  = 800;
    public static final double MIN_HEIGHT = 600;

    private AppNavigator() {}

    private static double getOptimalWidth() {
        double screen = Screen.getPrimary().getVisualBounds().getWidth();
        return Math.min(screen * 0.85, APP_WIDTH);
    }

    private static double getOptimalHeight() {
        double screen = Screen.getPrimary().getVisualBounds().getHeight();
        return Math.min(screen * 0.85, APP_HEIGHT);
    }

    public static Scene createScene(Parent root, Class<?> resourceBase) {
        Scene scene = new Scene(root, getOptimalWidth(), getOptimalHeight());
        scene.getStylesheets().add(resourceBase.getResource("/css/style.css").toExternalForm());
        return scene;
    }

    public static void applyStage(Stage stage, Scene scene, String title) {
        stage.setTitle(title);
        stage.setScene(scene);
        stage.setWidth(getOptimalWidth());
        stage.setHeight(getOptimalHeight());
        stage.setMinWidth(MIN_WIDTH);
        stage.setMinHeight(MIN_HEIGHT);
        stage.setResizable(true);
        stage.centerOnScreen();
        stage.show();
    }
}
