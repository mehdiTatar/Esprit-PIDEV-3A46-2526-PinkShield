package tn.esprit.controllers;

import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ListChangeListener;
import javafx.fxml.FXML;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import tn.esprit.entities.Comment;
import tn.esprit.services.BlogPostService;
import tn.esprit.services.CommentService;

import java.time.format.DateTimeFormatter;
import java.util.*;
import java.util.stream.Collectors;

public class AdminCommentListController {

    private static final int PAGE_SIZE = 10;

    // Table & controls
    @FXML private TableView<Comment>           commentsTable;
    @FXML private TableColumn<Comment, String> colPost;
    @FXML private TableColumn<Comment, String> colAuthor;
    @FXML private TableColumn<Comment, String> colEmail;
    @FXML private TableColumn<Comment, String> colContent;
    @FXML private TableColumn<Comment, String> colDate;
    @FXML private TextField                    searchField;
    // Stats
    @FXML private HBox                         statsStrip;
    // Pagination
    @FXML private Button                       btnFirst;
    @FXML private Button                       btnPrev;
    @FXML private Label                        pageLabel;
    @FXML private Button                       btnNext;
    @FXML private Button                       btnLast;
    // Footer
    @FXML private Label                        statusLabel;

    private final CommentService  commentService  = new CommentService();
    private final BlogPostService blogPostService = new BlogPostService();

    private List<Comment> allComments  = new ArrayList<>();
    private List<Comment> currentList  = new ArrayList<>();
    private int           currentPage  = 0;

    // ── Init ──────────────────────────────────────────────────
    @FXML
    public void initialize() {
        setupColumns();

        commentsTable.getSortOrder().addListener((ListChangeListener<TableColumn<Comment, ?>>) c -> {
            currentList = sortList(currentList);
            updateTable();
        });

        allComments  = commentService.getAll();
        currentList  = new ArrayList<>(allComments);
        buildStats();
        updateTable();
    }

    // ── Column cell factories ─────────────────────────────────
    private void setupColumns() {
        colPost.setCellValueFactory(d ->
                new SimpleStringProperty("Post #" + d.getValue().getBlogPostId()));
        colAuthor.setCellValueFactory(d ->
                new SimpleStringProperty(d.getValue().getAuthorName()));
        colEmail.setCellValueFactory(d ->
                new SimpleStringProperty(d.getValue().getAuthorEmail()));
        colContent.setCellValueFactory(d -> {
            String c = d.getValue().getContent();
            return new SimpleStringProperty(c.length() > 70 ? c.substring(0, 70) + "…" : c);
        });
        colDate.setCellValueFactory(d -> {
            Comment c = d.getValue();
            return new SimpleStringProperty(c.getCreatedAt() != null
                    ? c.getCreatedAt().toLocalDateTime().format(DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm"))
                    : "N/A");
        });
    }

    // ── Inline stats strip ────────────────────────────────────
    private void buildStats() {
        int total       = allComments.size();
        int newWeek     = commentService.countRecent(7);
        int postsWithCm = commentService.countPostsWithComments();
        int totalPosts  = blogPostService.countAll();
        String avg      = totalPosts > 0
                ? String.valueOf(Math.round((double) total / totalPosts * 10.0) / 10.0)
                : "0";

        statsStrip.getChildren().setAll(
                statChip(String.valueOf(total),     "Total Comments",     "#14b8a6"),
                statChip(String.valueOf(newWeek),    "New This Week",      "#3b82f6"),
                statChip(String.valueOf(postsWithCm),"Posts Commented",    "#a855f7"),
                statChip(avg,                        "Avg Comments/Post",  "#f59e0b")
        );
    }

    private VBox statChip(String value, String label, String color) {
        VBox chip = new VBox(3);
        chip.setAlignment(Pos.CENTER);
        chip.getStyleClass().add("stat-chip");
        chip.setStyle("-fx-border-color:" + color + "55;");

        Label val = new Label(value);
        val.setStyle("-fx-text-fill:" + color + ";-fx-font-size:20px;-fx-font-weight:bold;");

        Label lbl = new Label(label);
        lbl.getStyleClass().add("stats-kpi-label");

        chip.getChildren().addAll(val, lbl);
        return chip;
    }

    // ── Filter ────────────────────────────────────────────────
    @FXML
    public void handleSearch() {
        String keyword = searchField.getText().trim().toLowerCase();

        currentList = keyword.isEmpty()
                ? new ArrayList<>(allComments)
                : allComments.stream()
                        .filter(c -> c.getAuthorName().toLowerCase().contains(keyword)
                                || c.getAuthorEmail().toLowerCase().contains(keyword)
                                || c.getContent().toLowerCase().contains(keyword)
                                || String.valueOf(c.getBlogPostId()).contains(keyword))
                        .collect(Collectors.toList());

        currentList = sortList(currentList);
        currentPage = 0;
        updateTable();
    }

    // ── Column-header sort ────────────────────────────────────
    private List<Comment> sortList(List<Comment> list) {
        List<TableColumn<Comment, ?>> order = commentsTable.getSortOrder();
        if (order.isEmpty()) return list;

        TableColumn<Comment, ?> col = order.get(0);
        Comparator<Comment> cmp;
        if      (col == colPost)    cmp = Comparator.comparingInt(Comment::getBlogPostId);
        else if (col == colAuthor)  cmp = Comparator.comparing(Comment::getAuthorName,  String.CASE_INSENSITIVE_ORDER);
        else if (col == colEmail)   cmp = Comparator.comparing(Comment::getAuthorEmail, String.CASE_INSENSITIVE_ORDER);
        else if (col == colContent) cmp = Comparator.comparing(Comment::getContent,     String.CASE_INSENSITIVE_ORDER);
        else if (col == colDate)    cmp = Comparator.comparing(
                c -> c.getCreatedAt() != null ? c.getCreatedAt().getTime() : 0L);
        else return list;

        if (col.getSortType() == TableColumn.SortType.DESCENDING) cmp = cmp.reversed();
        List<Comment> sorted = new ArrayList<>(list);
        sorted.sort(cmp);
        return sorted;
    }

    // ── Pagination ────────────────────────────────────────────
    private void updateTable() {
        int total      = currentList.size();
        int totalPages = Math.max(1, (int) Math.ceil((double) total / PAGE_SIZE));
        if (currentPage >= totalPages) currentPage = totalPages - 1;

        int from = currentPage * PAGE_SIZE;
        int to   = Math.min(from + PAGE_SIZE, total);

        commentsTable.setItems(FXCollections.observableArrayList(
                total == 0 ? List.of() : currentList.subList(from, to)));

        pageLabel.setText("Page " + (currentPage + 1) + " / " + totalPages);
        btnFirst.setDisable(currentPage == 0);
        btnPrev.setDisable(currentPage == 0);
        btnNext.setDisable(currentPage >= totalPages - 1);
        btnLast.setDisable(currentPage >= totalPages - 1);

        String range = total == 0 ? "0" : (from + 1) + "–" + to;
        statusLabel.setText("Showing " + range + " of " + total + " comment(s)");
    }

    @FXML public void handleFirst() {
        currentPage = 0;
        updateTable();
    }
    @FXML public void handlePrev() {
        if (currentPage > 0) { currentPage--; updateTable(); }
    }
    @FXML public void handleNext() {
        int tp = (int) Math.ceil((double) currentList.size() / PAGE_SIZE);
        if (currentPage < tp - 1) { currentPage++; updateTable(); }
    }
    @FXML public void handleLast() {
        currentPage = Math.max(0, (int) Math.ceil((double) currentList.size() / PAGE_SIZE) - 1);
        updateTable();
    }

    // ── Delete ────────────────────────────────────────────────
    @FXML
    public void handleDelete() {
        Comment sel = commentsTable.getSelectionModel().getSelectedItem();
        if (sel == null) {
            Alert a = new Alert(Alert.AlertType.WARNING, "Please select a comment to delete.", ButtonType.OK);
            a.setHeaderText(null); a.showAndWait();
            return;
        }
        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION,
                "Delete comment by " + sel.getAuthorName() + "?", ButtonType.YES, ButtonType.NO);
        confirm.setHeaderText(null);
        if (confirm.showAndWait().filter(b -> b == ButtonType.YES).isPresent()) {
            if (commentService.delete(sel.getId())) {
                allComments  = commentService.getAll();
                currentList  = new ArrayList<>(allComments);
                buildStats();
                handleSearch();          // re-apply any active search
            } else {
                statusLabel.setText("Failed to delete comment.");
            }
        }
    }
}
