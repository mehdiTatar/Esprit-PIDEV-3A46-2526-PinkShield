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
import tn.esprit.entities.Transaction;
import tn.esprit.entities.User;
import tn.esprit.entities.WishlistDisplayItem;
import tn.esprit.services.PdfReceiptGenerator;
import tn.esprit.services.TransactionService;
import tn.esprit.services.UserService;
import tn.esprit.services.WishlistService;

import java.io.File;
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
    @FXML private Label transactionCountLabel;
    @FXML private Label transactionTotalLabel;
    @FXML private Label transactionFeedbackLabel;
    @FXML private TableView<Transaction> transactionsTable;
    @FXML private TableColumn<Transaction, String> transactionIdCol;
    @FXML private TableColumn<Transaction, Timestamp> transactionDateCol;
    @FXML private TableColumn<Transaction, Double> transactionAmountCol;
    @FXML private TableColumn<Transaction, Integer> transactionItemsCol;
    @FXML private TableColumn<Transaction, String> transactionStatusCol;
    @FXML private TableColumn<Transaction, Void> transactionActionsCol;

    private final WishlistService wishlistService = new WishlistService();
    private final TransactionService transactionService = new TransactionService();
    private final PdfReceiptGenerator pdfReceiptGenerator = new PdfReceiptGenerator();
    private final ObservableList<WishlistDisplayItem> allItems = FXCollections.observableArrayList();
    private final ObservableList<Transaction> allTransactions = FXCollections.observableArrayList();
    private User currentUser;

    @FXML
    public void initialize() {
        setupTable();
        setupTransactionsTable();
        if (searchField != null) {
            searchField.textProperty().addListener((obs, oldValue, newValue) -> applyFilter());
        }
        updateFeedback("", false);
        updateTransactionFeedback("", false);
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
        loadTransactions();
    }

    @FXML
    public void handleBackToShop() {
        loadSubView("/fxml/product_list.fxml");
    }

    @FXML
    public void handleGoToCheckout() {
        if (currentUser == null) {
            showAlert("Authentication Required", "Please sign in to proceed to checkout.", Alert.AlertType.WARNING);
            return;
        }

        if (!UserService.ROLE_USER.equals(currentUser.getRole())) {
            showAlert("Access Denied", "Only patient accounts can access checkout.", Alert.AlertType.WARNING);
            return;
        }

        if (allItems.isEmpty()) {
            showAlert("Empty Wishlist", "Please add items to your wishlist before proceeding to checkout.", Alert.AlertType.WARNING);
            return;
        }

        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/wishlist_checkout.fxml"));
            Parent view = loader.load();

            Object controller = loader.getController();
            if (controller instanceof WishlistCheckoutController checkoutController) {
                checkoutController.setCurrentUser(currentUser);
            }

            if (searchField != null && searchField.getScene() != null) {
                StackPane mainContent = (StackPane) searchField.getScene().lookup("#mainContent");
                if (mainContent != null) {
                    mainContent.getChildren().setAll(view);
                }
            }
        } catch (IOException e) {
            showAlert("Error", "Could not load checkout page: " + e.getMessage(), Alert.AlertType.ERROR);
            e.printStackTrace();
        }
    }

    private void setupTransactionsTable() {
        if (transactionsTable == null) {
            return;
        }

        transactionIdCol.setCellValueFactory(cellData -> new SimpleStringProperty(cellData.getValue().getTransactionId()));
        transactionDateCol.setCellValueFactory(cellData -> new SimpleObjectProperty<>(cellData.getValue().getCreatedAt()));
        transactionAmountCol.setCellValueFactory(cellData -> new SimpleObjectProperty<>(cellData.getValue().getTotalAmount()));
        transactionItemsCol.setCellValueFactory(cellData -> new SimpleObjectProperty<>(cellData.getValue().getItemCount()));
        transactionStatusCol.setCellValueFactory(cellData -> new SimpleStringProperty(cellData.getValue().getStatus()));

        transactionDateCol.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(Timestamp item, boolean empty) {
                super.updateItem(item, empty);
                setText(empty || item == null ? null : item.toLocalDateTime().toLocalDate().format(DATE_FORMAT));
            }
        });

        transactionAmountCol.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(Double item, boolean empty) {
                super.updateItem(item, empty);
                setText(empty || item == null ? null : String.format(Locale.US, "%.2f TND", item));
            }
        });

        transactionActionsCol.setCellFactory(column -> new TableCell<>() {
            private final Button receiptButton = new Button("Download Receipt");

            {
                receiptButton.getStyleClass().addAll("button", "secondary");
                receiptButton.setStyle("-fx-font-size: 11; -fx-padding: 7 12;");
                receiptButton.setOnAction(event -> {
                    Transaction transaction = getTableView().getItems().get(getIndex());
                    handleDownloadReceipt(transaction);
                });
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                setGraphic(empty ? null : receiptButton);
            }
        });
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
            allTransactions.clear();
            wishlistTable.setItems(allItems);
            transactionsTable.setItems(allTransactions);
            updateMetrics();
            updateTransactionMetrics();
            updateFeedback("Sign in to access the wishlist.", true);
            updateTransactionFeedback("Sign in to access transaction history.", true);
            togglePatientOnlyState(true);
            return;
        }

        if (!UserService.ROLE_USER.equals(currentUser.getRole())) {
            allItems.clear();
            allTransactions.clear();
            wishlistTable.setItems(allItems);
            transactionsTable.setItems(allTransactions);
            updateMetrics();
            updateTransactionMetrics();
            updateFeedback("Wishlist is available only for patient accounts.", true);
            updateTransactionFeedback("Transaction history is available only for patient accounts.", true);
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

        loadTransactions();
    }

    private void loadTransactions() {
        if (transactionsTable == null) {
            return;
        }

        if (currentUser == null || !UserService.ROLE_USER.equals(currentUser.getRole())) {
            allTransactions.clear();
            transactionsTable.setItems(allTransactions);
            updateTransactionMetrics();
            return;
        }

        allTransactions.setAll(transactionService.getTransactionsByUserId(currentUser.getId()));
        transactionsTable.setItems(allTransactions);
        updateTransactionMetrics();

        if (allTransactions.isEmpty()) {
            updateTransactionFeedback("No transactions yet. Your paid wishlist checkouts will appear here.", false);
        } else {
            updateTransactionFeedback("", false);
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

    private void updateTransactionMetrics() {
        int count = allTransactions.size();
        double total = allTransactions.stream()
                .filter(transaction -> "SUCCESSFUL".equalsIgnoreCase(transaction.getStatus()))
                .mapToDouble(Transaction::getTotalAmount)
                .sum();

        if (transactionCountLabel != null) {
            transactionCountLabel.setText(String.valueOf(count));
        }
        if (transactionTotalLabel != null) {
            transactionTotalLabel.setText(String.format(Locale.US, "%.2f TND", total));
        }
    }

    private void handleDownloadReceipt(Transaction transaction) {
        if (transaction == null) {
            showAlert("No transaction", "Please choose a transaction first.", Alert.AlertType.WARNING);
            return;
        }

        try {
            File downloadsDir = new File(System.getProperty("user.home"), "Downloads");
            String fileName = "Receipt_" + safeFilePart(transaction.getTransactionId()) + ".pdf";
            File receiptFile = new File(downloadsDir, fileName);
            pdfReceiptGenerator.generateReceipt(transaction, receiptFile.getAbsolutePath());
            String path = receiptFile.getAbsolutePath();
            showAlert("Receipt downloaded", "Receipt saved to:\n" + path, Alert.AlertType.INFORMATION);
        } catch (RuntimeException e) {
            showAlert("Receipt error", "Could not generate receipt: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    private String safeFilePart(String value) {
        String normalized = value == null || value.isBlank() ? "transaction" : value.trim();
        return normalized.replaceAll("[^A-Za-z0-9._-]", "_");
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

    private void updateTransactionFeedback(String message, boolean error) {
        if (transactionFeedbackLabel == null) {
            return;
        }

        boolean hasMessage = message != null && !message.isBlank();
        transactionFeedbackLabel.setText(hasMessage ? message : "");
        transactionFeedbackLabel.setManaged(hasMessage);
        transactionFeedbackLabel.setVisible(hasMessage);
        transactionFeedbackLabel.getStyleClass().removeAll("chat-status-error", "chat-status-info");
        if (hasMessage) {
            transactionFeedbackLabel.getStyleClass().add(error ? "chat-status-error" : "chat-status-info");
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
