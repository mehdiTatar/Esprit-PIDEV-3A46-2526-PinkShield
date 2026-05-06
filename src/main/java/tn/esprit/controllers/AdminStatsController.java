package tn.esprit.controllers;

import javafx.fxml.FXML;
import javafx.geometry.Pos;
import javafx.scene.control.Label;
import javafx.scene.layout.*;
import tn.esprit.entities.BlogPost;
import tn.esprit.services.BlogPostService;
import tn.esprit.services.CommentService;

import java.util.List;
import java.util.Map;

public class AdminStatsController {

    @FXML private VBox statsContainer;

    private final BlogPostService blogPostService = new BlogPostService();
    private final CommentService commentService   = new CommentService();

    @FXML
    public void initialize() {
        buildStats();
    }

    @FXML
    public void handleRefresh() {
        statsContainer.getChildren().clear();
        buildStats();
    }

    // ─── Main builder ────────────────────────────────────────
    private void buildStats() {

        int totalPosts    = blogPostService.countAll();
        int totalComments = commentService.countAll();
        int newPosts7     = blogPostService.countRecent(7);
        int newComments7  = commentService.countRecent(7);
        double avgComments = totalPosts > 0
                ? Math.round((double) totalComments / totalPosts * 10.0) / 10.0
                : 0.0;

        // ── Row 1: KPI cards ──────────────────────────────────
        HBox kpiRow = new HBox(16);
        kpiRow.setAlignment(Pos.TOP_LEFT);
        kpiRow.getChildren().addAll(
                kpiCard("Total Posts",        String.valueOf(totalPosts),    "#c0396b"),
                kpiCard("Total Comments",     String.valueOf(totalComments), "#14b8a6"),
                kpiCard("New Posts (7 days)", String.valueOf(newPosts7),     "#3b82f6"),
                kpiCard("New Comments (7d)",  String.valueOf(newComments7),  "#a855f7"),
                kpiCard("Avg Comments/Post",  String.valueOf(avgComments),   "#f59e0b")
        );

        // ── Row 2: Role chart  +  Most active author ─────────
        Map<String, Integer> roleMap = blogPostService.getRoleDistribution();
        VBox rolePanel = roleChartPanel(roleMap);

        String[] topAuthor = blogPostService.getMostActiveAuthor();
        VBox authorPanel   = authorPanel(topAuthor);

        HBox row2 = new HBox(16);
        HBox.setHgrow(rolePanel,   Priority.ALWAYS);
        HBox.setHgrow(authorPanel, Priority.ALWAYS);
        row2.getChildren().addAll(rolePanel, authorPanel);

        // ── Row 3: Top 5 most commented posts ────────────────
        Map<Integer, Integer> countsByPost = commentService.getCountsByPost();
        List<BlogPost> top5 = blogPostService.getTopByComments(5);
        VBox topPostsPanel = topPostsPanel(top5, countsByPost);

        statsContainer.getChildren().addAll(kpiRow, row2, topPostsPanel);
    }

    // ─── KPI card ────────────────────────────────────────────
    private VBox kpiCard(String label, String value, String accentColor) {
        VBox card = new VBox(8);
        card.setAlignment(Pos.CENTER);
        card.setPrefWidth(160);
        card.setMinWidth(140);
        card.getStyleClass().add("stats-card");
        card.setStyle("-fx-border-color: " + accentColor + "55; -fx-background-color: #0d1e35;");

        Label valueLabel = new Label(value);
        valueLabel.setStyle("-fx-text-fill: " + accentColor + "; -fx-font-size: 34px; -fx-font-weight: bold;");

        Label nameLabel = new Label(label);
        nameLabel.getStyleClass().add("stats-kpi-label");
        nameLabel.setWrapText(true);
        nameLabel.setAlignment(Pos.CENTER);

        card.getChildren().addAll(valueLabel, nameLabel);
        return card;
    }

    // ─── Role distribution bar chart ─────────────────────────
    private VBox roleChartPanel(Map<String, Integer> roleMap) {
        VBox panel = new VBox(14);
        panel.getStyleClass().add("stats-panel");

        Label title = new Label("Posts by Author Role");
        title.getStyleClass().add("stats-panel-title");

        panel.getChildren().add(title);

        if (roleMap.isEmpty()) {
            panel.getChildren().add(noDataLabel());
        } else {
            int maxCount = roleMap.values().stream().mapToInt(Integer::intValue).max().orElse(1);
            String[] colors = {"#c0396b", "#14b8a6", "#3b82f6", "#a855f7", "#f59e0b"};
            int colorIdx = 0;
            for (Map.Entry<String, Integer> entry : roleMap.entrySet()) {
                String color = colors[colorIdx % colors.length];
                panel.getChildren().add(roleBar(
                        capitalize(entry.getKey()),
                        entry.getValue(),
                        maxCount,
                        color));
                colorIdx++;
            }
        }
        return panel;
    }

    private HBox roleBar(String role, int count, int maxCount, String color) {
        HBox row = new HBox(12);
        row.setAlignment(Pos.CENTER_LEFT);

        Label roleLabel = new Label(role);
        roleLabel.setMinWidth(80);
        roleLabel.getStyleClass().add("field-label");

        // Track container
        HBox track = new HBox();
        track.setPrefSize(220, 14);
        track.setMinWidth(220);
        track.setMaxWidth(220);
        track.setStyle("-fx-background-color: #111f36; -fx-background-radius: 7; " +
                       "-fx-min-height: 14; -fx-max-height: 14; -fx-pref-height: 14;");

        // Filled portion
        Region fill = new Region();
        double pct = maxCount > 0 ? (double) count / maxCount : 0;
        double fillWidth = 220 * pct;
        fill.setMinSize(fillWidth, 14);
        fill.setMaxSize(fillWidth, 14);
        fill.setPrefSize(fillWidth, 14);
        fill.setStyle("-fx-background-color: " + color + "; -fx-background-radius: 7;");
        track.getChildren().add(fill);

        Label countLabel = new Label(count + (count == 1 ? " post" : " posts"));
        countLabel.getStyleClass().add("card-meta");

        row.getChildren().addAll(roleLabel, track, countLabel);
        return row;
    }

    // ─── Most active author panel ─────────────────────────────
    private VBox authorPanel(String[] topAuthor) {
        VBox panel = new VBox(14);
        panel.getStyleClass().add("stats-panel");

        Label title = new Label("Most Active Author");
        title.getStyleClass().add("stats-panel-title");
        panel.getChildren().add(title);

        if (topAuthor == null) {
            panel.getChildren().add(noDataLabel());
        } else {
            Label name = new Label(topAuthor[0]);
            name.setStyle("-fx-text-fill: #f0a8c4; -fx-font-size: 20px; -fx-font-weight: bold;");
            name.setWrapText(true);

            Label count = new Label(topAuthor[1] + " post" + (Integer.parseInt(topAuthor[1]) != 1 ? "s" : "") + " published");
            count.getStyleClass().add("card-meta");
            count.setStyle("-fx-text-fill: #8aa4c8; -fx-font-size: 14px;");

            panel.getChildren().addAll(name, count);
        }
        return panel;
    }

    // ─── Top 5 most commented posts ───────────────────────────
    private VBox topPostsPanel(List<BlogPost> posts, Map<Integer, Integer> counts) {
        VBox panel = new VBox(12);
        panel.getStyleClass().add("stats-panel");

        Label title = new Label("Top 5 Most Commented Posts");
        title.getStyleClass().add("stats-panel-title");
        panel.getChildren().add(title);

        if (posts.isEmpty()) {
            panel.getChildren().add(noDataLabel());
            return panel;
        }

        for (int i = 0; i < posts.size(); i++) {
            BlogPost post = posts.get(i);
            int commentCount = counts.getOrDefault(post.getId(), 0);
            panel.getChildren().add(topPostRow(i + 1, post, commentCount));
        }
        return panel;
    }

    private HBox topPostRow(int rank, BlogPost post, int commentCount) {
        HBox row = new HBox(12);
        row.setAlignment(Pos.CENTER_LEFT);
        row.getStyleClass().add("top-post-row");

        Label rankLabel = new Label("#" + rank);
        rankLabel.setMinWidth(30);
        rankLabel.setStyle("-fx-text-fill: #c0396b; -fx-font-weight: bold; -fx-font-size: 15px;");

        Label titleLabel = new Label(post.getTitle());
        titleLabel.setStyle("-fx-text-fill: #ccd6e8; -fx-font-size: 14px;");
        titleLabel.setWrapText(true);
        HBox.setHgrow(titleLabel, Priority.ALWAYS);

        Label commentsLabel = new Label(commentCount + " comment" + (commentCount != 1 ? "s" : ""));
        commentsLabel.setStyle("-fx-text-fill: #14b8a6; -fx-font-weight: bold; -fx-font-size: 13px;");
        commentsLabel.setMinWidth(100);

        row.getChildren().addAll(rankLabel, titleLabel, commentsLabel);
        return row;
    }

    // ─── Helpers ──────────────────────────────────────────────
    private Label noDataLabel() {
        Label l = new Label("No data available yet.");
        l.getStyleClass().add("no-content-label");
        return l;
    }

    private String capitalize(String s) {
        if (s == null || s.isEmpty()) return s;
        return s.substring(0, 1).toUpperCase() + s.substring(1).toLowerCase();
    }
}
