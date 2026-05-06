package tn.esprit.controllers;

import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.*;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.StackPane;
import javafx.stage.FileChooser;
import tn.esprit.entities.BlogPost;
import tn.esprit.services.BlogPostService;
import tn.esprit.tools.AppConfig;
import tn.esprit.tools.Validator;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.StandardCopyOption;

public class AdminBlogFormController {

    @FXML private Label            formTitle;

    // ── Input fields ──────────────────────────────────────────
    @FXML private TextField        titleField;
    @FXML private TextArea         contentField;
    @FXML private TextField        authorNameField;
    @FXML private TextField        authorEmailField;
    @FXML private ComboBox<String> authorRoleCombo;
    @FXML private TextField        imagePathField;
    @FXML private ImageView        imagePreviewView;
    @FXML private Label            imageStatusLabel;

    // ── Per-field error labels ────────────────────────────────
    @FXML private Label            errTitle;
    @FXML private Label            errContent;
    @FXML private Label            errAuthorName;
    @FXML private Label            errAuthorEmail;
    @FXML private Label            errAuthorRole;

    // ── Global save feedback ──────────────────────────────────
    @FXML private Label            feedbackLabel;

    private final BlogPostService blogPostService = new BlogPostService();
    private BlogPost editingPost;

    // ── Init ──────────────────────────────────────────────────
    @FXML
    public void initialize() {
        authorRoleCombo.setItems(FXCollections.observableArrayList("admin", "doctor", "user"));

        // Validate on focus-lost
        titleField.focusedProperty().addListener((o, was, now)       -> { if (!now) validateTitle(); });
        contentField.focusedProperty().addListener((o, was, now)     -> { if (!now) validateContent(); });
        authorNameField.focusedProperty().addListener((o, was, now)  -> { if (!now) validateAuthorName(); });
        authorEmailField.focusedProperty().addListener((o, was, now) -> { if (!now) validateAuthorEmail(); });
        authorRoleCombo.focusedProperty().addListener((o, was, now)  -> { if (!now) validateRole(); });

        // Clear error mark while the user is typing
        titleField.textProperty().addListener((o, p, n)       -> Validator.clearMark(titleField,       errTitle));
        contentField.textProperty().addListener((o, p, n)     -> Validator.clearMark(contentField,     errContent));
        authorNameField.textProperty().addListener((o, p, n)  -> Validator.clearMark(authorNameField,  errAuthorName));
        authorEmailField.textProperty().addListener((o, p, n) -> Validator.clearMark(authorEmailField, errAuthorEmail));
        authorRoleCombo.valueProperty().addListener((o, p, n) -> Validator.clearMark(authorRoleCombo,  errAuthorRole));
    }

    // ── Populate form when editing an existing post ───────────
    public void setPost(BlogPost post) {
        this.editingPost = post;
        formTitle.setText("Edit Post");
        titleField.setText(post.getTitle());
        contentField.setText(post.getContent());
        authorNameField.setText(post.getAuthorName());
        authorEmailField.setText(post.getAuthorEmail());
        authorRoleCombo.setValue(post.getAuthorRole() != null ? post.getAuthorRole().toLowerCase() : null);
        if (post.getImagePath() != null && !post.getImagePath().isBlank()) {
            imagePathField.setText(post.getImagePath());
            showPreview(post.getImagePath());
        }
    }

    // ── Per-field validators ──────────────────────────────────

    private boolean validateTitle() {
        String v = titleField.getText().trim();
        if (v.isEmpty())        { Validator.markError(titleField, errTitle, "Title is required."); return false; }
        if (v.length() < 5)    { Validator.markError(titleField, errTitle, "Title must be at least 5 characters."); return false; }
        if (v.length() > 200)  { Validator.markError(titleField, errTitle, "Title must not exceed 200 characters."); return false; }
        Validator.markValid(titleField, errTitle);
        return true;
    }

    private boolean validateContent() {
        String v = contentField.getText().trim();
        if (v.isEmpty())      { Validator.markError(contentField, errContent, "Content is required."); return false; }
        if (v.length() < 20)  { Validator.markError(contentField, errContent, "Content must be at least 20 characters."); return false; }
        Validator.markValid(contentField, errContent);
        return true;
    }

    private boolean validateAuthorName() {
        String v = authorNameField.getText().trim();
        if (v.isEmpty())               { Validator.markError(authorNameField, errAuthorName, "Author name is required."); return false; }
        if (v.length() < 2)            { Validator.markError(authorNameField, errAuthorName, "Name must be at least 2 characters."); return false; }
        if (v.length() > 80)           { Validator.markError(authorNameField, errAuthorName, "Name must not exceed 80 characters."); return false; }
        if (!Validator.isAlphaSpace(v)){ Validator.markError(authorNameField, errAuthorName, "Name must contain only letters and spaces."); return false; }
        Validator.markValid(authorNameField, errAuthorName);
        return true;
    }

    private boolean validateAuthorEmail() {
        String v = authorEmailField.getText().trim();
        if (v.isEmpty())                  { Validator.markError(authorEmailField, errAuthorEmail, "Email is required."); return false; }
        if (!Validator.isValidEmail(v))   { Validator.markError(authorEmailField, errAuthorEmail, "Enter a valid email (e.g. user@example.com)."); return false; }
        Validator.markValid(authorEmailField, errAuthorEmail);
        return true;
    }

    private boolean validateRole() {
        String v = authorRoleCombo.getValue();
        if (v == null || v.isBlank()) { Validator.markError(authorRoleCombo, errAuthorRole, "Please select a role."); return false; }
        Validator.markValid(authorRoleCombo, errAuthorRole);
        return true;
    }

    /** Validate all fields at once so every error is shown before the user fixes anything. */
    private boolean validateAll() {
        boolean t = validateTitle();
        boolean c = validateContent();
        boolean n = validateAuthorName();
        boolean e = validateAuthorEmail();
        boolean r = validateRole();
        return t && c && n && e && r;
    }

    // ── Image picker ──────────────────────────────────────────

    @FXML
    public void handleBrowseImage() {
        if (!AppConfig.isConfigured()) {
            imageStatusLabel.setText("Uploads folder not found. Edit app.properties first.");
            imageStatusLabel.getStyleClass().setAll("feedback-error");
            return;
        }
        FileChooser fc = new FileChooser();
        fc.setTitle("Select Image");
        fc.getExtensionFilters().add(
                new FileChooser.ExtensionFilter("Image Files", "*.jpg", "*.jpeg", "*.png", "*.gif", "*.webp"));

        File selected = fc.showOpenDialog(imagePathField.getScene().getWindow());
        if (selected == null) return;

        try {
            File dir = new File(AppConfig.getBlogUploadsDir());
            if (!dir.exists()) dir.mkdirs();

            String filename   = System.currentTimeMillis() + "_" + selected.getName().replace(" ", "_");
            File   dest       = new File(dir, filename);
            Files.copy(selected.toPath(), dest.toPath(), StandardCopyOption.REPLACE_EXISTING);

            String storedPath = AppConfig.BLOG_UPLOADS_RELATIVE + "/" + filename;
            imagePathField.setText(storedPath);
            showPreview(storedPath);
            imageStatusLabel.setText("Saved: " + filename);
            imageStatusLabel.getStyleClass().setAll("feedback-success");
        } catch (IOException ex) {
            imageStatusLabel.setText("Error: " + ex.getMessage());
            imageStatusLabel.getStyleClass().setAll("feedback-error");
        }
    }

    @FXML
    public void handleRemoveImage() {
        imagePathField.clear();
        imagePreviewView.setImage(null);
        imagePreviewView.setVisible(false);
        imageStatusLabel.setText("Image removed.");
        imageStatusLabel.getStyleClass().setAll("card-meta");
    }

    private void showPreview(String path) {
        File f = AppConfig.resolveImageFile(path);
        if (f != null && f.exists()) {
            imagePreviewView.setImage(new Image(f.toURI().toString(), 260, 140, true, true, true));
            imagePreviewView.setVisible(true);
        } else {
            imagePreviewView.setVisible(false);
        }
    }

    // ── Save / Cancel ─────────────────────────────────────────

    @FXML
    public void handleSave() {
        if (!validateAll()) {
            feedbackLabel.setText("Please fix the errors highlighted above.");
            feedbackLabel.getStyleClass().setAll("feedback-error");
            return;
        }
        feedbackLabel.setText("");

        String title     = titleField.getText().trim();
        String content   = contentField.getText().trim();
        String name      = authorNameField.getText().trim();
        String email     = authorEmailField.getText().trim();
        String role      = authorRoleCombo.getValue();
        String imagePath = imagePathField.getText().trim();

        boolean success;
        if (editingPost == null) {
            success = blogPostService.add(new BlogPost(title, content, email, name, role,
                    imagePath.isEmpty() ? null : imagePath));
        } else {
            editingPost.setTitle(title);
            editingPost.setContent(content);
            editingPost.setAuthorEmail(email);
            editingPost.setAuthorName(name);
            editingPost.setAuthorRole(role);
            editingPost.setImagePath(imagePath.isEmpty() ? null : imagePath);
            success = blogPostService.update(editingPost);
        }

        if (success) {
            navigateToList();
        } else {
            feedbackLabel.setText("Database error — please try again.");
            feedbackLabel.getStyleClass().setAll("feedback-error");
        }
    }

    @FXML public void handleCancel() { navigateToList(); }

    private void navigateToList() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/admin_blog_list.fxml"));
            Parent view = loader.load();
            ((StackPane) titleField.getScene().lookup("#adminContent")).getChildren().setAll(view);
        } catch (Exception e) { e.printStackTrace(); }
    }
}
