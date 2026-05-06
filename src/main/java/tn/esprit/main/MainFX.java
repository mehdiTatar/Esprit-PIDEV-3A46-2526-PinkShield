package tn.esprit.main;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.stage.Stage;
import tn.esprit.services.PaymentService;
import tn.esprit.utils.AppNavigator;

/**
 * Main JavaFX Application Entry Point for PinkShield
 * Initializes the application with login screen and payment service
 */
public class MainFX extends Application {

    // Global payment service instance
    private static PaymentService paymentService;

    @Override
    public void start(Stage primaryStage) throws Exception {
        // Initialize global payment service
        paymentService = new PaymentService();

        FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/login.fxml"));
        AppNavigator.applyStage(
                primaryStage,
                AppNavigator.createScene(loader.load(), getClass()),
                "PinkShield - Healthcare & Wellness Platform"
        );
    }

    /**
     * Get the global payment service instance
     */
    public static PaymentService getPaymentService() {
        if (paymentService == null) {
            paymentService = new PaymentService();
        }
        return paymentService;
    }

    public static void main(String[] args) {
        launch(args);
    }
}

