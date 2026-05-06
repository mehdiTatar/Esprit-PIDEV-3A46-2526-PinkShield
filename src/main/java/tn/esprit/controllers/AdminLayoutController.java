package tn.esprit.controllers;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Button;
import javafx.scene.layout.StackPane;

public class AdminLayoutController {
    @FXML private StackPane adminContent;
    @FXML private Button btnPosts;
    @FXML private Button btnComments;

    @FXML
    public void initialize() {
        loadAdminView("/fxml/admin_blog_list.fxml");
        setActive(btnPosts);
    }

    @FXML
    public void showPosts() {
        loadAdminView("/fxml/admin_blog_list.fxml");
        setActive(btnPosts);
    }

    @FXML
    public void showComments() {
        loadAdminView("/fxml/admin_comment_list.fxml");
        setActive(btnComments);
    }

    public void loadAdminView(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent view = loader.load();
            adminContent.getChildren().setAll(view);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private void setActive(Button active) {
        btnPosts.getStyleClass().remove("sidebar-btn-active");
        btnComments.getStyleClass().remove("sidebar-btn-active");
        active.getStyleClass().add("sidebar-btn-active");
    }
}
