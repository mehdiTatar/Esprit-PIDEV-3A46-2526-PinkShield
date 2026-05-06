package tn.esprit.controllers;

import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Parent;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.FlowPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Priority;
import javafx.scene.layout.Region;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import tn.esprit.entities.BlogPost;
import tn.esprit.services.BlogPostService;
import tn.esprit.services.CommentService;
import tn.esprit.tools.AppConfig;

import java.io.File;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Comparator;
import java.util.List;
import java.util.Map;
import java.util.stream.Collectors;

public class FrontHomeController {
    @FXML private FlowPane postsContainer;
    @FXML private TextField searchField;
    @FXML private Label postCountLabel;
    @FXML private ComboBox<String> sortCombo;
    @FXML private ComboBox<String> roleCombo;

    private final BlogPostService blogPostService = new BlogPostService();
    private final CommentService  commentService  = new CommentService();
    private List<BlogPost> allPosts;

    @FXML
    public void initialize() {
        sortCombo.setItems(FXCollections.observableArrayList(
                "Newest First", "Oldest First", "A → Z", "Z → A", "Most Commented"));
        sortCombo.setValue("Newest First");

        roleCombo.setItems(FXCollections.observableArrayList(
                "All Roles", "Admin", "Doctor", "User"));
        roleCombo.setValue("All Roles");

        sortCombo.setOnAction(e -> applyFilters());
        roleCombo.setOnAction(e -> applyFilters());

        allPosts = blogPostService.getAll();
        renderPosts(allPosts);
    }

    @FXML
    public void handleSearch() { applyFilters(); }

    @FXML
    public void handleReset() {
        searchField.clear();
        sortCombo.setValue("Newest First");
        roleCombo.setValue("All Roles");
        renderPosts(allPosts);
    }

    private void applyFilters() {
        String keyword = searchField.getText().trim();
        String role    = roleCombo.getValue();
        String sort    = sortCombo.getValue();

        List<BlogPost> result = keyword.isEmpty()
                ? new ArrayList<>(allPosts)
                : blogPostService.search(keyword);

        if (!"All Roles".equals(role)) {
            result = result.stream()
                    .filter(p -> role.equalsIgnoreCase(p.getAuthorRole()))
                    .collect(Collectors.toList());
        }

        if ("Most Commented".equals(sort)) {
            Map<Integer, Integer> counts = commentService.getCountsByPost();
            result.sort(Comparator.comparingInt(
                    (BlogPost p) -> counts.getOrDefault(p.getId(), 0)).reversed());
        } else {
            Comparator<BlogPost> cmp = switch (sort) {
                case "Oldest First" -> Comparator.comparing(
                        p -> p.getCreatedAt() != null ? p.getCreatedAt().getTime() : 0L);
                case "A → Z"        -> Comparator.comparing(
                        BlogPost::getTitle, String.CASE_INSENSITIVE_ORDER);
                case "Z → A"        -> Comparator.comparing(
                        BlogPost::getTitle, String.CASE_INSENSITIVE_ORDER).reversed();
                default             -> Comparator.comparing(
                        (BlogPost p) -> p.getCreatedAt() != null ? p.getCreatedAt().getTime() : 0L,
                        Comparator.reverseOrder());
            };
            result.sort(cmp);
        }
        renderPosts(result);
    }

    private void renderPosts(List<BlogPost> posts) {
        postsContainer.getChildren().clear();
        postCountLabel.setText(posts.size() + " article" + (posts.size() != 1 ? "s" : "") + " found");
        if (posts.isEmpty()) {
            Label empty = new Label("No posts match your search.");
            empty.getStyleClass().add("no-content-label");
            postsContainer.getChildren().add(empty);
            return;
        }
        for (BlogPost post : posts) {
            postsContainer.getChildren().add(createPostCard(post));
        }
    }

    private VBox createPostCard(BlogPost post) {
        VBox card = new VBox(0);
        card.getStyleClass().add("post-card");
        card.setPrefWidth(320);
        card.setMaxWidth(320);

        // ── Image banner ──────────────────────────────────────
        File imgFile = AppConfig.resolveImageFile(post.getImagePath());
        if (imgFile != null && imgFile.exists()) {
            try {
                ImageView iv = new ImageView(
                        new Image(imgFile.toURI().toString(), 320, 170, false, true, true));
                iv.setFitWidth(320);
                iv.setFitHeight(170);
                iv.setPreserveRatio(false);
                card.getChildren().add(iv);
            } catch (Exception ignored) {
                card.getChildren().add(colorBanner(post.getAuthorRole()));
            }
        } else {
            card.getChildren().add(colorBanner(post.getAuthorRole()));
        }

        // ── Text content ──────────────────────────────────────
        VBox content = new VBox(10);
        content.setPadding(new Insets(14, 16, 16, 16));

        HBox cardHeader = new HBox(8);
        cardHeader.setAlignment(Pos.CENTER_LEFT);
        String roleStr = post.getAuthorRole() != null ? post.getAuthorRole() : "user";
        Label roleLabel = new Label(roleStr.toUpperCase());
        roleLabel.getStyleClass().addAll("badge", roleStr.toLowerCase());

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);

        String dateStr = post.getCreatedAt() != null
                ? post.getCreatedAt().toLocalDateTime().format(DateTimeFormatter.ofPattern("dd MMM yyyy"))
                : "";
        Label dateLabel = new Label(dateStr);
        dateLabel.getStyleClass().add("card-meta");
        cardHeader.getChildren().addAll(roleLabel, spacer, dateLabel);

        Label titleLabel = new Label(post.getTitle());
        titleLabel.getStyleClass().add("card-title");
        titleLabel.setWrapText(true);

        String raw = post.getContent() != null ? post.getContent() : "";
        String excerpt = raw.length() > 120 ? raw.substring(0, 120) + "…" : raw;
        Label excerptLabel = new Label(excerpt);
        excerptLabel.getStyleClass().add("card-excerpt");
        excerptLabel.setWrapText(true);

        Label authorLabel = new Label("By " + post.getAuthorName());
        authorLabel.getStyleClass().add("card-meta");

        Button readBtn = new Button("Read More →");
        readBtn.getStyleClass().add("btn-primary");
        readBtn.setMaxWidth(Double.MAX_VALUE);
        readBtn.setOnAction(e -> openPost(post));

        content.getChildren().addAll(cardHeader, titleLabel, excerptLabel, authorLabel, readBtn);
        card.getChildren().add(content);
        return card;
    }

    /** Colored gradient placeholder when there is no image. */
    private Region colorBanner(String role) {
        Region banner = new Region();
        banner.setPrefSize(320, 6);
        String color = switch (role != null ? role.toLowerCase() : "user") {
            case "admin"  -> "#c0396b";
            case "doctor" -> "#14b8a6";
            default       -> "#3b82f6";
        };
        banner.setStyle("-fx-background-color: " + color + ";");
        return banner;
    }

    private void openPost(BlogPost post) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/front_blog_detail.fxml"));
            Parent view = loader.load();
            FrontBlogDetailController ctrl = loader.getController();
            ctrl.setPost(post);
            StackPane mainContent = (StackPane) postsContainer.getScene().lookup("#mainContent");
            mainContent.getChildren().setAll(view);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
