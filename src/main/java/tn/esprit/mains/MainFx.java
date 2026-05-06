package tn.esprit.mains;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.stage.Stage;
import tn.esprit.utils.AppNavigator;

import java.io.IOException;

public class MainFx extends Application {

    public static void main(String[] args) {
        launch(args);
    }

    @Override
    public void start(Stage primaryStage) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/login.fxml"));
            AppNavigator.applyStage(
                    primaryStage,
                    AppNavigator.createScene(loader.load(), getClass()),
                    "PinkShield"
            );
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
