package tn.esprit.controllers;

import javafx.beans.property.SimpleObjectProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TableCell;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextField;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import tn.esprit.entities.User;
import tn.esprit.entities.WishlistDisplayItem;
import tn.esprit.services.UserService;
import tn.esprit.services.WishlistService;

import java.io.IOException;
import java.sql.Timestamp;
import java.time.format.DateTimeFormatter;
import java.util.Comparator;
import java.util.List;
import java.util.Locale;
import java.util.stream.Collectors;

public class WishlistController {
    private static final DateTimeFormatter DATE_FORMAT = DateTimeFormatter.ofPattern("dd/MM/yyyy");

    @FXML private TextField searchField;
    @FXML private Label feedbackLabel;
    @FXML private Label totalItemsLabel;
    @FXML private Label totalValueLabel;
    @FXML private Label wishlistTitleLabel;
    @FXML private TableView<WishlistDisplayItem> wishlistTable;
    @FXML private TableColumn<WishlistDisplayItem, Integer> idCol;
    @FXML private TableColumn<WishlistDisplayItem, String> productCol;
    @FXML private TableColumn<WishlistDisplayItem, String> categoryCol;
    @FXML private TableColumn<WishlistDisplayItem, Double> priceCol;
    @FXML private TableColumn<WishlistDisplayItem, Timestamp> addedAtCol;
    @FXML private TableColumn<WishlistDisplayItem, Void> actionsCol;
    @FXML private VBox patientOnlyNotice;

    private final WishlistService wishlistService = new WishlistService();
    private final ObservableList<WishlistDisplayItem> allItems = FXCollections.observableArrayList();
    private User currentUser;

    @FXML
    public void initialize() {
        setupTable();
        if (searchField != null) {
            searchField.textProperty().addListener((obs, oldValue, newValue) -> applyFilter());
        }
        updateFeedback("", false);
        togglePatientOnlyState(false);
    }

    public void setCurrentUser(User user) {
        currentUser = user;
        if (wishlistTitleLabel != null && user != null) {
            wishlistTitleLabel.setText(UserService.ROLE_USER.equals(user.getRole()) ? "Your Wishlist" : "Wishlist");
        }
        loadWishlist();
    }

    @FXML
    public void handleRefresh() {
        loadWishlist();
    }

    @FXML
    public void handleBackToShop() {
        loadSubView("/fxml/product_list.fxml");
    }

    private void setupTable() {
        if (wishlistTable == null) {
            return;
        }

        idCol.setCellValueFactory(cellData -> new SimpleObjectProperty<>(cellData.getValue().getId()));
        productCol.setCellValueFactory(cellData -> new SimpleStringProperty(cellData.getValue().getProductName()));
        categoryCol.setCellValueFactory(cellData -> new SimpleStringProperty(cellData.getValue().getCategory()));
        priceCol.setCellValueFactory(cellData -> new SimpleObjectProperty<>(cellData.getValue().getPrice()));
        addedAtCol.setCellValueFactory(cellData -> new SimpleObjectProperty<>(cellData.getValue().getAddedAt()));

        priceCol.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(Double item, boolean empty) {
                super.updateItem(item, empty);
                setText(empty || item == null ? null : String.format(Locale.US, "%.2f TND", item));
            }
        });

        addedAtCol.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(Timestamp item, boolean empty) {
                super.updateItem(item, empty);
                setText(empty || item == null ? null : item.toLocalDateTime().toLocalDate().format(DATE_FORMAT));
            }
        });

        actionsCol.setCellFactory(column -> new TableCell<>() {
            private final Button removeButton = new Button("Remove");

            {
                removeButton.getStyleClass().addAll("button", "danger-button");
                removeButton.setStyle("-fx-font-size: 11; -fx-padding: 7 12;");
                removeButton.setOnAction(event -> {
                    WishlistDisplayItem item = getTableView().getItems().get(getIndex());
                    handleRemove(item);
                });
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                setGraphic(empty ? null : removeButton);
            }
        });
    }

    private void loadWishlist() {
        if (currentUser == null) {
            allItems.clear();
            wishlistTable.setItems(allItems);
            updateMetrics();
            updateFeedback("Sign in to access the wishlist.", true);
            togglePatientOnlyState(true);
            return;
        }

        if (!UserService.ROLE_USER.equals(currentUser.getRole())) {
            allItems.clear();
            wishlistTable.setItems(allItems);
            updateMetrics();
            updateFeedback("Wishlist is available only for patient accounts.", true);
            togglePatientOnlyState(true);
            return;
        }

        if (!wishlistService.isAvailable()) {
            allItems.clear();
            wishlistTable.setItems(allItems);
            updateMetrics();
            updateFeedback("Wishlist storage is unavailable. Check the database connection.", true);
            togglePatientOnlyState(false);
            return;
        }

        allItems.setAll(wishlistService.getDisplayItemsByUser(currentUser.getId()));
        togglePatientOnlyState(false);
        applyFilter();

        if (allItems.isEmpty()) {
            updateFeedback("Your wishlist is empty. Save products from the parapharmacy page.", false);
        } else {
            updateFeedback("", false);
        }
    }

    private void applyFilter() {
        String query = searchField == null || searchField.getText() == null
                ? ""
                : searchField.getText().trim().toLowerCase(Locale.ROOT);

        List<WishlistDisplayItem> filtered = allItems.stream()
                .filter(item -> matches(item, query))
                .sorted(Comparator.comparing(WishlistDisplayItem::getAddedAt, Comparator.nullsLast(Comparator.reverseOrder())))
                .collect(Collectors.toList());

        wishlistTable.setItems(FXCollections.observableArrayList(filtered));
        updateMetrics(filtered);
    }

    private boolean matches(WishlistDisplayItem item, String query) {
        if (query.isEmpty()) {
            return true;
        }

        return item.getProductName().toLowerCase(Locale.ROOT).contains(query)
                || item.getCategory().toLowerCase(Locale.ROOT).contains(query)
                || String.valueOf(item.getId()).contains(query)
                || String.format(Locale.US, "%.2f", item.getPrice()).contains(query);
    }

    private void handleRemove(WishlistDisplayItem item) {
        if (currentUser == null || !UserService.ROLE_USER.equals(currentUser.getRole())) {
            showAlert("Access denied", "Only patients can remove wishlist items.", Alert.AlertType.WARNING);
            return;
        }

        if (!wishlistService.removeItem(item.getId(), currentUser.getId())) {
            showAlert("Error", "The wishlist item could not be removed.", Alert.AlertType.ERROR);
            return;
        }

        loadWishlist();
    }

    private void updateMetrics() {
        updateMetrics(wishlistTable == null || wishlistTable.getItems() == null ? List.of() : wishlistTable.getItems());
    }

    private void updateMetrics(List<WishlistDisplayItem> items) {
        int count = items == null ? 0 : items.size();
        double total = items == null ? 0.0 : items.stream().mapToDouble(WishlistDisplayItem::getPrice).sum();

        totalItemsLabel.setText(String.valueOf(count));
        totalValueLabel.setText(String.format(Locale.US, "%.2f TND", total));
    }

    private void togglePatientOnlyState(boolean show) {
        if (patientOnlyNotice != null) {
            patientOnlyNotice.setManaged(show);
            patientOnlyNotice.setVisible(show);
        }
        if (wishlistTable != null) {
            wishlistTable.setDisable(show);
        }
    }

    private void updateFeedback(String message, boolean error) {
        if (feedbackLabel == null) {
            return;
        }

        boolean hasMessage = message != null && !message.isBlank();
        feedbackLabel.setText(hasMessage ? message : "");
        feedbackLabel.setManaged(hasMessage);
        feedbackLabel.setVisible(hasMessage);
        feedbackLabel.getStyleClass().removeAll("chat-status-error", "chat-status-info");
        if (hasMessage) {
            feedbackLabel.getStyleClass().add(error ? "chat-status-error" : "chat-status-info");
        }
    }

    private void loadSubView(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent view = loader.load();

            Object controller = loader.getController();
            if (controller instanceof ProductListController productListController) {
                productListController.setCurrentUser(currentUser);
            } else if (controller instanceof WishlistController wishlistController) {
                wishlistController.setCurrentUser(currentUser);
            }

            if (searchField != null && searchField.getScene() != null) {
                StackPane mainContent = (StackPane) searchField.getScene().lookup("#mainContent");
                if (mainContent != null) {
                    mainContent.getChildren().setAll(view);
                }
            }
        } catch (IOException e) {
            showAlert("Error", "Could not load view: " + fxmlPath, Alert.AlertType.ERROR);
            e.printStackTrace();
        }
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}
