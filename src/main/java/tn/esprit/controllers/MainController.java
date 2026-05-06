package tn.esprit.controllers;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;
import tn.esprit.entities.User;
import tn.esprit.tools.SessionManager;

public class MainController {

    @FXML private StackPane mainContent;
    @FXML private Label     userNameLabel;
    @FXML private Button    adminPanelBtn;

    @FXML
    public void initialize() {
        loadView("/fxml/front_home.fxml");
    }

    /** Called by LoginController right after this FXML is loaded. */
    public void setCurrentUser(User user) {
        SessionManager.setCurrentUser(user);
        userNameLabel.setText(user.getFullName());

        // Admin Panel is only available to admins
        boolean isAdmin = "admin".equals(user.getRole());
        adminPanelBtn.setVisible(isAdmin);
        adminPanelBtn.setManaged(isAdmin);
    }

    @FXML
    public void showFrontOffice() {
        loadView("/fxml/front_home.fxml");
    }

    @FXML
    public void showBackOffice() {
        loadView("/fxml/admin_layout.fxml");
    }

    @FXML
    public void handleLogout() {
        SessionManager.logout();
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/login.fxml"));
            Parent root = loader.load();
            Scene scene = new Scene(root);
            scene.getStylesheets().add(
                    getClass().getResource("/css/style.css").toExternalForm());
            Stage stage = (Stage) mainContent.getScene().getWindow();
            stage.setScene(scene);
            stage.setTitle("PinkShield — Sign In");
            stage.setMinWidth(420);
            stage.setMinHeight(520);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void loadView(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent view = loader.load();
            mainContent.getChildren().setAll(view);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
