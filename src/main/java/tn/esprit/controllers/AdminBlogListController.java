package tn.esprit.controllers;

import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ListChangeListener;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Pos;
import javafx.scene.Parent;
import javafx.scene.control.*;
import javafx.scene.layout.HBox;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import tn.esprit.entities.BlogPost;
import tn.esprit.services.BlogPostService;
import tn.esprit.services.CommentService;

import java.time.format.DateTimeFormatter;
import java.util.*;
import java.util.stream.Collectors;

public class AdminBlogListController {

    private static final int PAGE_SIZE = 10;

    // Table & controls
    @FXML private TableView<BlogPost>           postsTable;
    @FXML private TableColumn<BlogPost, String> colTitle;
    @FXML private TableColumn<BlogPost, String> colAuthor;
    @FXML private TableColumn<BlogPost, String> colRole;
    @FXML private TableColumn<BlogPost, String> colDate;
    @FXML private TextField                     searchField;
    @FXML private ComboBox<String>              roleFilterCombo;
    // Stats
    @FXML private HBox                          statsStrip;
    // Pagination
    @FXML private Button                        btnFirst;
    @FXML private Button                        btnPrev;
    @FXML private Label                         pageLabel;
    @FXML private Button                        btnNext;
    @FXML private Button                        btnLast;
    // Footer
    @FXML private Label                         statusLabel;

    private final BlogPostService blogPostService = new BlogPostService();
    private final CommentService  commentService  = new CommentService();

    private List<BlogPost> allPosts    = new ArrayList<>();
    private List<BlogPost> currentList = new ArrayList<>();
    private int            currentPage = 0;

    // ── Init ──────────────────────────────────────────────────
    @FXML
    public void initialize() {
        roleFilterCombo.setItems(FXCollections.observableArrayList(
                "All Roles", "Admin", "Doctor", "User"));
        roleFilterCombo.setValue("All Roles");
        roleFilterCombo.setOnAction(e -> applyFilter());

        setupColumns();

        // Re-sort the current list whenever the user clicks a column header
        postsTable.getSortOrder().addListener((ListChangeListener<TableColumn<BlogPost, ?>>) c -> {
            currentList = sortList(currentList);
            updateTable();
        });

        allPosts    = blogPostService.getAll();
        currentList = new ArrayList<>(allPosts);
        buildStats();
        updateTable();
    }

    // ── Column cell factories ─────────────────────────────────
    private void setupColumns() {
        colTitle.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getTitle()));
        colAuthor.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getAuthorName()));
        colRole.setCellValueFactory(d -> new SimpleStringProperty(
                d.getValue().getAuthorRole() != null ? d.getValue().getAuthorRole() : ""));
        colDate.setCellValueFactory(d -> {
            BlogPost p = d.getValue();
            return new SimpleStringProperty(p.getCreatedAt() != null
                    ? p.getCreatedAt().toLocalDateTime().format(DateTimeFormatter.ofPattern("dd/MM/yyyy"))
                    : "N/A");
        });
    }

    // ── Inline stats strip ────────────────────────────────────
    private void buildStats() {
        int total         = allPosts.size();
        int newWeek       = blogPostService.countRecent(7);
        int totalComments = commentService.countAll();
        String avg        = total > 0
                ? String.valueOf(Math.round((double) totalComments / total * 10.0) / 10.0)
                : "0";

        statsStrip.getChildren().setAll(
                statChip(String.valueOf(total),         "Total Posts",       "#c0396b"),
                statChip(String.valueOf(newWeek),        "New This Week",     "#3b82f6"),
                statChip(String.valueOf(totalComments),  "Total Comments",    "#14b8a6"),
                statChip(avg,                            "Avg Comments/Post", "#f59e0b")
        );
    }

    private VBox statChip(String value, String label, String color) {
        VBox chip = new VBox(3);
        chip.setAlignment(Pos.CENTER);
        chip.getStyleClass().add("stat-chip");
        chip.setStyle("-fx-border-color: " + color + "55;");

        Label val = new Label(value);
        val.setStyle("-fx-text-fill:" + color + ";-fx-font-size:20px;-fx-font-weight:bold;");

        Label lbl = new Label(label);
        lbl.getStyleClass().add("stats-kpi-label");

        chip.getChildren().addAll(val, lbl);
        return chip;
    }

    // ── Filter ────────────────────────────────────────────────
    @FXML
    public void handleSearch() { applyFilter(); }

    private void applyFilter() {
        String keyword = searchField.getText().trim().toLowerCase();
        String role    = roleFilterCombo.getValue();

        currentList = allPosts.stream()
                .filter(p -> {
                    boolean kw = keyword.isEmpty()
                            || p.getTitle().toLowerCase().contains(keyword)
                            || p.getAuthorName().toLowerCase().contains(keyword)
                            || (p.getAuthorEmail() != null && p.getAuthorEmail().toLowerCase().contains(keyword))
                            || p.getContent().toLowerCase().contains(keyword);
                    boolean r = "All Roles".equals(role) || role.equalsIgnoreCase(p.getAuthorRole());
                    return kw && r;
                })
                .collect(Collectors.toList());

        currentList = sortList(currentList);
        currentPage = 0;
        updateTable();
    }

    // ── Column-header sort (applied on top of the filtered list) ──
    private List<BlogPost> sortList(List<BlogPost> list) {
        List<TableColumn<BlogPost, ?>> order = postsTable.getSortOrder();
        if (order.isEmpty()) return list;

        TableColumn<BlogPost, ?> col = order.get(0);
        Comparator<BlogPost> cmp;
        if      (col == colTitle)  cmp = Comparator.comparing(BlogPost::getTitle,     String.CASE_INSENSITIVE_ORDER);
        else if (col == colAuthor) cmp = Comparator.comparing(BlogPost::getAuthorName,String.CASE_INSENSITIVE_ORDER);
        else if (col == colRole)   cmp = Comparator.comparing(
                p -> p.getAuthorRole() != null ? p.getAuthorRole() : "", String.CASE_INSENSITIVE_ORDER);
        else if (col == colDate)   cmp = Comparator.comparing(
                p -> p.getCreatedAt() != null ? p.getCreatedAt().getTime() : 0L);
        else return list;

        if (col.getSortType() == TableColumn.SortType.DESCENDING) cmp = cmp.reversed();
        List<BlogPost> sorted = new ArrayList<>(list);
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

        postsTable.setItems(FXCollections.observableArrayList(
                total == 0 ? List.of() : currentList.subList(from, to)));

        pageLabel.setText("Page " + (currentPage + 1) + " / " + totalPages);
        btnFirst.setDisable(currentPage == 0);
        btnPrev.setDisable(currentPage == 0);
        btnNext.setDisable(currentPage >= totalPages - 1);
        btnLast.setDisable(currentPage >= totalPages - 1);

        String range = total == 0 ? "0" : (from + 1) + "–" + to;
        statusLabel.setText("Showing " + range + " of " + total + " post(s)");
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

    // ── CRUD ──────────────────────────────────────────────────
    @FXML public void handleAdd() { navigateToForm(null); }

    @FXML
    public void handleEdit() {
        BlogPost sel = postsTable.getSelectionModel().getSelectedItem();
        if (sel == null) { alert(Alert.AlertType.WARNING, "No Selection", "Please select a post to edit."); return; }
        navigateToForm(sel);
    }

    @FXML
    public void handleDelete() {
        BlogPost sel = postsTable.getSelectionModel().getSelectedItem();
        if (sel == null) { alert(Alert.AlertType.WARNING, "No Selection", "Please select a post to delete."); return; }

        Alert confirm = new Alert(Alert.AlertType.CONFIRMATION,
                "Delete \"" + sel.getTitle() + "\"?\nThis will also delete all its comments.",
                ButtonType.YES, ButtonType.NO);
        confirm.setHeaderText(null);
        if (confirm.showAndWait().filter(b -> b == ButtonType.YES).isPresent()) {
            if (blogPostService.delete(sel.getId())) {
                allPosts    = blogPostService.getAll();
                currentList = new ArrayList<>(allPosts);
                buildStats();
                applyFilter();
            } else {
                statusLabel.setText("Failed to delete post.");
            }
        }
    }

    private void navigateToForm(BlogPost post) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/admin_blog_form.fxml"));
            Parent view = loader.load();
            AdminBlogFormController ctrl = loader.getController();
            if (post != null) ctrl.setPost(post);
            ((StackPane) postsTable.getScene().lookup("#adminContent")).getChildren().setAll(view);
        } catch (Exception e) { e.printStackTrace(); }
    }

    private void alert(Alert.AlertType t, String title, String msg) {
        Alert a = new Alert(t, msg, ButtonType.OK);
        a.setTitle(title); a.setHeaderText(null); a.showAndWait();
    }
}
