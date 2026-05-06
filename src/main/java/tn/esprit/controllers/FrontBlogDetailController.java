package tn.esprit.controllers;

import javafx.concurrent.Task;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Pos;
import javafx.scene.Parent;
import javafx.scene.control.*;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.*;
import tn.esprit.entities.BlogPost;
import tn.esprit.entities.Comment;
import tn.esprit.entities.User;
import tn.esprit.services.CommentService;
import tn.esprit.tools.AiModerator;
import tn.esprit.tools.AppConfig;
import tn.esprit.tools.EmailService;
import tn.esprit.tools.SessionManager;
import tn.esprit.tools.Validator;

import java.io.File;
import java.time.format.DateTimeFormatter;
import java.util.List;

public class FrontBlogDetailController {

    // ── Post display ──────────────────────────────────────────
    @FXML private ImageView postImageView;
    @FXML private Label     postTitle;
    @FXML private Label     postAuthor;
    @FXML private Label     postDate;
    @FXML private Label     postContent;
    @FXML private VBox      commentsContainer;
    @FXML private Label     commentCount;

    // ── Comment form — session panel (logged-in users) ────────
    @FXML private HBox  commentAsPanel;
    @FXML private Label commentAsLabel;

    // ── Comment form — input panel (guest users) ──────────────
    @FXML private HBox      commentInputsPanel;
    @FXML private TextField commentAuthorName;
    @FXML private TextField commentAuthorEmail;

    // ── Comment form — common ─────────────────────────────────
    @FXML private TextArea  commentContentArea;
    @FXML private Button    postCommentBtn;

    // ── Per-field error labels ────────────────────────────────
    @FXML private Label errCommentName;
    @FXML private Label errCommentEmail;
    @FXML private Label errCommentContent;

    // ── Global feedback ───────────────────────────────────────
    @FXML private Label feedbackLabel;

    private final CommentService commentService = new CommentService();
    private BlogPost currentPost;

    // ── Init ──────────────────────────────────────────────────
    @FXML
    public void initialize() {
        if (SessionManager.isLoggedIn()) {
            // Show "commenting as" chip; hide name/email inputs
            User user = SessionManager.getCurrentUser();
            commentAsLabel.setText(user.getFullName() + "  ·  " + user.getEmail());
            commentAsPanel.setVisible(true);
            commentAsPanel.setManaged(true);
            commentInputsPanel.setVisible(false);
            commentInputsPanel.setManaged(false);
        } else {
            // Show name/email inputs; hide session chip
            commentAsPanel.setVisible(false);
            commentAsPanel.setManaged(false);
            commentInputsPanel.setVisible(true);
            commentInputsPanel.setManaged(true);

            // Validation listeners for guest fields
            commentAuthorName.textProperty().addListener((o, p, n)  -> Validator.clearMark(commentAuthorName,  errCommentName));
            commentAuthorEmail.textProperty().addListener((o, p, n) -> Validator.clearMark(commentAuthorEmail, errCommentEmail));
            commentAuthorName.focusedProperty().addListener((o, was, now)  -> { if (!now) validateName(); });
            commentAuthorEmail.focusedProperty().addListener((o, was, now) -> { if (!now) validateEmail(); });
        }

        // Content field listeners apply regardless of login state
        commentContentArea.textProperty().addListener((o, p, n) -> Validator.clearMark(commentContentArea, errCommentContent));
        commentContentArea.focusedProperty().addListener((o, was, now) -> { if (!now) validateContent(); });
    }

    // ── Load post data ────────────────────────────────────────
    public void setPost(BlogPost post) {
        this.currentPost = post;
        loadPostData();
        loadComments();
    }

    private void loadPostData() {
        File imgFile = AppConfig.resolveImageFile(currentPost.getImagePath());
        if (imgFile != null && imgFile.exists()) {
            try {
                postImageView.setImage(new Image(imgFile.toURI().toString(), 860, 420, true, true, true));
                postImageView.setVisible(true);
                postImageView.setManaged(true);
            } catch (Exception ignored) {
                postImageView.setVisible(false);
                postImageView.setManaged(false);
            }
        } else {
            postImageView.setVisible(false);
            postImageView.setManaged(false);
        }

        postTitle.setText(currentPost.getTitle());
        String role = currentPost.getAuthorRole() != null ? currentPost.getAuthorRole().toUpperCase() : "USER";
        postAuthor.setText("By " + currentPost.getAuthorName() + "  ·  " + role);
        postDate.setText(currentPost.getCreatedAt() != null
                ? currentPost.getCreatedAt().toLocalDateTime()
                        .format(DateTimeFormatter.ofPattern("dd MMMM yyyy  HH:mm"))
                : "");
        postContent.setText(currentPost.getContent());
    }

    // ── Comments list ─────────────────────────────────────────
    private void loadComments() {
        commentsContainer.getChildren().clear();
        List<Comment> comments = commentService.getByPostId(currentPost.getId());
        commentCount.setText(comments.size() + " comment" + (comments.size() != 1 ? "s" : ""));
        if (comments.isEmpty()) {
            Label empty = new Label("No comments yet. Be the first to share your thoughts!");
            empty.getStyleClass().add("no-content-label");
            commentsContainer.getChildren().add(empty);
        } else {
            for (Comment c : comments) commentsContainer.getChildren().add(commentCard(c));
        }
    }

    private VBox commentCard(Comment comment) {
        VBox card = new VBox(8);
        card.getStyleClass().add("comment-card");

        HBox header = new HBox(10);
        header.setAlignment(Pos.CENTER_LEFT);
        Label author = new Label(comment.getAuthorName());
        author.getStyleClass().add("comment-author");
        Region sp = new Region();
        HBox.setHgrow(sp, Priority.ALWAYS);
        Label date = new Label(comment.getCreatedAt() != null
                ? comment.getCreatedAt().toLocalDateTime().format(DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm"))
                : "");
        date.getStyleClass().add("card-meta");
        header.getChildren().addAll(author, sp, date);

        Label content = new Label(comment.getContent());
        content.getStyleClass().add("comment-content");
        content.setWrapText(true);

        card.getChildren().addAll(header, content);
        return card;
    }

    // ── Validators ────────────────────────────────────────────

    private boolean validateName() {
        String v = commentAuthorName.getText().trim();
        if (v.isEmpty())                { Validator.markError(commentAuthorName, errCommentName, "Name is required."); return false; }
        if (v.length() < 2)            { Validator.markError(commentAuthorName, errCommentName, "Name must be at least 2 characters."); return false; }
        if (v.length() > 60)           { Validator.markError(commentAuthorName, errCommentName, "Name must not exceed 60 characters."); return false; }
        if (!Validator.isAlphaSpace(v)){ Validator.markError(commentAuthorName, errCommentName, "Name must contain only letters and spaces."); return false; }
        Validator.markValid(commentAuthorName, errCommentName);
        return true;
    }

    private boolean validateEmail() {
        String v = commentAuthorEmail.getText().trim();
        if (v.isEmpty())               { Validator.markError(commentAuthorEmail, errCommentEmail, "Email is required."); return false; }
        if (!Validator.isValidEmail(v)){ Validator.markError(commentAuthorEmail, errCommentEmail, "Enter a valid email (e.g. user@example.com)."); return false; }
        Validator.markValid(commentAuthorEmail, errCommentEmail);
        return true;
    }

    private boolean validateContent() {
        String v = commentContentArea.getText().trim();
        if (v.isEmpty())      { Validator.markError(commentContentArea, errCommentContent, "Comment cannot be empty."); return false; }
        if (v.length() < 5)   { Validator.markError(commentContentArea, errCommentContent, "Comment must be at least 5 characters."); return false; }
        if (v.length() > 500) { Validator.markError(commentContentArea, errCommentContent, "Comment must not exceed 500 characters (" + v.length() + "/500)."); return false; }
        Validator.markValid(commentContentArea, errCommentContent);
        return true;
    }

    // ── Submit (with AI moderation) ───────────────────────────
    @FXML
    public void handleAddComment() {
        // Validate guest fields only when not logged in
        if (!SessionManager.isLoggedIn()) {
            boolean n = validateName();
            boolean e = validateEmail();
            if (!n || !e) return;
        }
        if (!validateContent()) return;

        // Resolve author identity
        final String name;
        final String email;
        if (SessionManager.isLoggedIn()) {
            User user = SessionManager.getCurrentUser();
            name  = user.getFullName();
            email = user.getEmail();
        } else {
            name  = commentAuthorName.getText().trim();
            email = commentAuthorEmail.getText().trim();
        }

        final String content = commentContentArea.getText().trim();

        // Disable button, show loading
        postCommentBtn.setDisable(true);
        postCommentBtn.setText("Checking…");
        feedbackLabel.setText("Analysing comment for inappropriate content…");
        feedbackLabel.getStyleClass().setAll("feedback-warning");

        // Run AI moderation on a background thread
        Task<AiModerator.Result> task = new Task<>() {
            @Override
            protected AiModerator.Result call() {
                return AiModerator.moderate(content);
            }
        };

        task.setOnSucceeded(evt -> {
            AiModerator.Result result = task.getValue();
            if (result.modified) {
                feedbackLabel.setText("Your comment contains inappropriate language and cannot be posted. Please revise it.");
                feedbackLabel.getStyleClass().setAll("feedback-error");
                resetButton();
                return;
            }
            submitComment(name, email, content);
        });

        task.setOnFailed(evt -> {
            System.err.println("[AiModerator] Task failed: " + task.getException());
            submitComment(name, email, content);
        });

        new Thread(task).start();
    }

    private void submitComment(String name, String email, String content) {
        Comment comment = new Comment();
        comment.setAuthorName(name);
        comment.setAuthorEmail(email);
        comment.setContent(content);
        comment.setBlogPostId(currentPost.getId());

        if (commentService.add(comment)) {
            feedbackLabel.setText("Comment posted successfully!");
            feedbackLabel.getStyleClass().setAll("feedback-success");
            EmailService.notifyPostAuthor(currentPost, comment);
            clearForm();
            loadComments();
        } else {
            feedbackLabel.setText("Failed to post comment. Please try again.");
            feedbackLabel.getStyleClass().setAll("feedback-error");
        }
        resetButton();
    }

    private void clearForm() {
        commentContentArea.clear();
        Validator.clearMark(commentContentArea, errCommentContent);
        if (!SessionManager.isLoggedIn()) {
            commentAuthorName.clear();
            commentAuthorEmail.clear();
            Validator.clearMark(commentAuthorName,  errCommentName);
            Validator.clearMark(commentAuthorEmail, errCommentEmail);
        }
    }

    private void resetButton() {
        postCommentBtn.setDisable(false);
        postCommentBtn.setText("Post Comment");
    }

    // ── Navigation ────────────────────────────────────────────
    @FXML
    public void handleBack() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/front_home.fxml"));
            Parent view = loader.load();
            ((StackPane) postTitle.getScene().lookup("#mainContent")).getChildren().setAll(view);
        } catch (Exception e) { e.printStackTrace(); }
    }
}
