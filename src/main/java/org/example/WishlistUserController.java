package org.example;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.VBox;
import javafx.scene.layout.HBox;
import javafx.application.Platform;
import javafx.animation.PauseTransition;
import javafx.util.Duration;

import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

public class WishlistUserController {

    @FXML
    private TextField searchBar;
    @FXML
    private TableView<WishlistDisplayItem> table;
    @FXML
    private TableColumn<WishlistDisplayItem, Integer> colId;
    @FXML
    private TableColumn<WishlistDisplayItem, String> colParapharmacieId;
    @FXML
    private TableColumn<WishlistDisplayItem, String> colPrice;
    @FXML
    private TableColumn<WishlistDisplayItem, String> colAddedAt;
    @FXML
    private TableColumn<WishlistDisplayItem, String> colAction;
    @FXML
    private Label totalPriceLabel;

    // Tab buttons
    @FXML
    private Button wishlistTabBtn;
    @FXML
    private Button transactionTabBtn;

    // Tab content containers
    @FXML
    private VBox wishlistTabContent;
    @FXML
    private VBox transactionTabContent;

    // Action and checkout sections
    @FXML
    private HBox actionButtonsBox;
    @FXML
    private VBox checkoutBox;

    // Transaction history table
    @FXML
    private TableView<TransactionDisplayItem> transactionTable;
    @FXML
    private TableColumn<TransactionDisplayItem, Integer> transactionColId;
    @FXML
    private TableColumn<TransactionDisplayItem, String> transactionColDate;
    @FXML
    private TableColumn<TransactionDisplayItem, String> transactionColPrice;
    @FXML
    private TableColumn<TransactionDisplayItem, String> transactionColStatus;
    @FXML
    private Label totalTransactionsLabel;

    // Payment form fields
    @FXML
    private TextField cardholderNameField;
    @FXML
    private TextField cardNumberField;
    @FXML
    private TextField expiryDateField;
    @FXML
    private TextField cvvField;
    @FXML
    private Label orderItemsLabel;
    @FXML
    private Label orderTotalLabel;
    @FXML
    private Button downloadReceiptBtn;

    private ServiceWishlist serviceWishlist;
    private ServiceParapharmacie serviceParapharmacie;
    private ServiceTransactionHistory serviceTransactionHistory;
    private ObservableList<WishlistDisplayItem> wishlistList;
    private FilteredList<WishlistDisplayItem> filteredList;
    
    // Last transaction total (for receipt generation)
    private double lastTransactionTotal = 0.0;

    @FXML
    public void initialize() {
        serviceWishlist = new ServiceWishlist();
        serviceParapharmacie = new ServiceParapharmacie();
        serviceTransactionHistory = new ServiceTransactionHistory();

        initializeTableColumns();
        initializeTransactionTable();
        loadWishlist();
        loadTransactionHistory();
        setupRealTimeSearch();
        
        // Set default tab to Wishlist
        showWishlistTab();
    }

    private void initializeTableColumns() {
        colId.setCellValueFactory(new PropertyValueFactory<>("id"));
        colParapharmacieId.setCellValueFactory(new PropertyValueFactory<>("productName"));
        colPrice.setCellValueFactory(cellData ->
                new javafx.beans.property.SimpleStringProperty(formatPrice(cellData.getValue().getPrice())));

        colAddedAt.setCellValueFactory(cellData -> {
            java.sql.Timestamp timestamp = cellData.getValue().getAddedAt();
            String formatted = timestamp != null ?
                timestamp.toLocalDateTime().toLocalDate().toString() : "N/A";
            return new javafx.beans.property.SimpleStringProperty(formatted);
        });

        colAction.setCellFactory(column -> new TableCell<WishlistDisplayItem, String>() {
            private final Button deleteButton = new Button("Delete");

            {
                deleteButton.setStyle("-fx-background-color: #ff6b6b; -fx-text-fill: white; -fx-font-size: 12; -fx-padding: 5 10;");
                deleteButton.setOnAction(event -> {
                    WishlistDisplayItem item = getTableView().getItems().get(getIndex());
                    handleDelete(item);
                });
            }

            @Override
            protected void updateItem(String item, boolean empty) {
                super.updateItem(item, empty);
                if (empty) {
                    setGraphic(null);
                } else {
                    setGraphic(deleteButton);
                }
            }
        });
    }

    /**
     * Initialize transaction history table columns
     */
    private void initializeTransactionTable() {
        transactionColId.setCellValueFactory(new PropertyValueFactory<>("id"));
        transactionColDate.setCellValueFactory(new PropertyValueFactory<>("date"));
        transactionColPrice.setCellValueFactory(new PropertyValueFactory<>("amount"));
        transactionColStatus.setCellValueFactory(new PropertyValueFactory<>("status"));
    }

    /**
     * Load transaction history for the current logged-in user
     */
    private void loadTransactionHistory() {
        try {
            UserSession session = UserSession.getInstance();
            if (!session.isLoggedIn()) {
                ObservableList<TransactionDisplayItem> emptyList = FXCollections.observableArrayList();
                transactionTable.setItems(emptyList);
                return;
            }

            // Get the current user's ID
            int userId = session.getUserId();

            // Load transactions from the database for this specific user
            ArrayList<TransactionHistory> userTransactions = serviceTransactionHistory.getByUserId(userId);
            ArrayList<TransactionDisplayItem> displayItems = new ArrayList<>();

            // Convert TransactionHistory to TransactionDisplayItem for display
            for (TransactionHistory transaction : userTransactions) {
                String dateStr = transaction.getTransaction_date() != null ?
                        transaction.getTransaction_date().toLocalDateTime().toLocalDate().toString() : "N/A";
                String amountStr = String.format("%.2f", transaction.getAmount());

                displayItems.add(new TransactionDisplayItem(
                        transaction.getId(),
                        dateStr,
                        amountStr,
                        transaction.getStatus()
                ));
            }

            ObservableList<TransactionDisplayItem> transactionsList = FXCollections.observableArrayList(displayItems);
            transactionTable.setItems(transactionsList);
            updateTransactionSummary(userTransactions);

            System.out.println("✅ Loaded " + displayItems.size() + " transactions for user " + userId);

        } catch (SQLException e) {
            System.err.println("❌ Database error loading transaction history: " + e.getMessage());
            ObservableList<TransactionDisplayItem> emptyList = FXCollections.observableArrayList();
            transactionTable.setItems(emptyList);
        } catch (Exception e) {
            System.err.println("❌ Error loading transaction history: " + e.getMessage());
            ObservableList<TransactionDisplayItem> emptyList = FXCollections.observableArrayList();
            transactionTable.setItems(emptyList);
        }
    }

    /**
     * Update transaction summary label with total spent
     */
    private void updateTransactionSummary(ArrayList<TransactionHistory> transactions) {
        double total = 0.0;
        for (TransactionHistory transaction : transactions) {
            if ("Completed".equals(transaction.getStatus())) {
                total += transaction.getAmount();
            }
        }
        totalTransactionsLabel.setText(String.format("Total Spent: %.2f TND", total));
    }

    private void loadWishlist() {
        try {
            UserSession session = UserSession.getInstance();
            if (!session.isLoggedIn()) {
                wishlistList = FXCollections.observableArrayList();
                filteredList = new FilteredList<>(wishlistList, p -> true);
                table.setItems(filteredList);
                updateTotalPrice();
                showWarningAlert("Authentication Required", "Please sign in to view your wishlist.");
                return;
            }

            ArrayList<Wishlist> wishlists = serviceWishlist.getByUserId(session.getUserId());

            Map<Integer, Parapharmacie> productById = loadProductMap();
            ArrayList<WishlistDisplayItem> displayItems = new ArrayList<>();
            for (Wishlist wishlist : wishlists) {
                Parapharmacie product = productById.get(wishlist.getParapharmacie_id());
                String productName = product != null ? product.getNom() : "Product #" + wishlist.getParapharmacie_id();
                double price = product != null ? product.getPrix() : 0.0;

                displayItems.add(new WishlistDisplayItem(
                        wishlist.getId(),
                        wishlist.getUser_id(),
                        wishlist.getParapharmacie_id(),
                        productName,
                        price,
                        wishlist.getAdded_at()
                ));
            }

            wishlistList = FXCollections.observableArrayList(displayItems);
            filteredList = new FilteredList<>(wishlistList, p -> true);
            table.setItems(filteredList);
            updateTotalPrice();
            updateOrderSummary();
        } catch (SQLException e) {
            System.out.println("Database connection error - showing empty wishlist: " + e.getMessage());
            wishlistList = FXCollections.observableArrayList();
            filteredList = new FilteredList<>(wishlistList, p -> true);
            table.setItems(filteredList);
            updateTotalPrice();
        } catch (NullPointerException e) {
            System.out.println("Database not ready - showing empty wishlist: " + e.getMessage());
            wishlistList = FXCollections.observableArrayList();
            filteredList = new FilteredList<>(wishlistList, p -> true);
            table.setItems(filteredList);
            updateTotalPrice();
        }
    }

    private Map<Integer, Parapharmacie> loadProductMap() throws SQLException {
        ArrayList<Parapharmacie> products = serviceParapharmacie.afficherAll();
        Map<Integer, Parapharmacie> productById = new HashMap<>();
        for (Parapharmacie product : products) {
            productById.put(product.getId(), product);
        }
        return productById;
    }

    private void setupRealTimeSearch() {
        searchBar.textProperty().addListener((observable, oldValue, newValue) -> {
            if (filteredList == null) {
                return;
            }

            filteredList.setPredicate(item -> {
                if (newValue == null || newValue.isEmpty()) {
                    return true;
                }

                String lowerCaseFilter = newValue.toLowerCase();
                String productName = item.getProductName() != null ? item.getProductName().toLowerCase() : "";
                String id = String.valueOf(item.getId());
                String price = formatPrice(item.getPrice()).toLowerCase();

                return productName.toLowerCase().contains(lowerCaseFilter) ||
                       id.contains(lowerCaseFilter) ||
                       price.contains(lowerCaseFilter);
            });

            updateTotalPrice();
        });
    }

    /**
     * Handle clicking the Wishlist tab button
     */
    @FXML
    public void handleWishlistTab() {
        showWishlistTab();
    }

    /**
     * Handle clicking the Transaction History tab button
     */
    @FXML
    public void handleTransactionHistoryTab() {
        showTransactionHistoryTab();
    }

    /**
     * Show the Wishlist tab
     */
    private void showWishlistTab() {
        wishlistTabContent.setVisible(true);
        wishlistTabContent.setManaged(true);
        transactionTabContent.setVisible(false);
        transactionTabContent.setManaged(false);
        actionButtonsBox.setVisible(true);
        actionButtonsBox.setManaged(true);
        checkoutBox.setVisible(true);
        checkoutBox.setManaged(true);
        
        // Update button styles
        wishlistTabBtn.setStyle("-fx-padding: 10 20; -fx-font-weight: bold; -fx-background-color: #e84393; -fx-text-fill: white;");
        transactionTabBtn.setStyle("-fx-padding: 10 20; -fx-font-weight: bold; -fx-background-color: transparent; -fx-text-fill: #2d3436;");
        
        searchBar.setVisible(true);
        searchBar.setManaged(true);
    }

    /**
     * Show the Transaction History tab
     */
    private void showTransactionHistoryTab() {
        wishlistTabContent.setVisible(false);
        wishlistTabContent.setManaged(false);
        transactionTabContent.setVisible(true);
        transactionTabContent.setManaged(true);
        actionButtonsBox.setVisible(false);
        actionButtonsBox.setManaged(false);
        checkoutBox.setVisible(false);
        checkoutBox.setManaged(false);
        
        // Update button styles
        wishlistTabBtn.setStyle("-fx-padding: 10 20; -fx-font-weight: bold; -fx-background-color: transparent; -fx-text-fill: #2d3436;");
        transactionTabBtn.setStyle("-fx-padding: 10 20; -fx-font-weight: bold; -fx-background-color: #e84393; -fx-text-fill: white;");
        
        searchBar.setVisible(false);
        searchBar.setManaged(false);
    }

    @FXML
    public void handleSupprimer() {
        WishlistDisplayItem selected = table.getSelectionModel().getSelectedItem();
        if (selected == null) {
            showWarningAlert("No Selection", "Please select a wishlist item to remove.");
            return;
        }

        handleDelete(selected);
    }

    private void handleDelete(WishlistDisplayItem item) {
        if (!UserSession.getInstance().isLoggedIn()) {
            showWarningAlert("Authentication Required", "Please sign in to perform this action.");
            return;
        }

        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Remove Item");
        confirmation.setHeaderText("Remove from Wishlist");
        confirmation.setContentText("Are you sure you want to remove this item from your wishlist?");

        confirmation.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                try {
                    serviceWishlist.supprimer(item.getId());
                    showInfoAlert("Success", "Item removed from wishlist!");
                    loadWishlist();
                } catch (SQLException e) {
                    showErrorAlert("Database Error", "Could not remove item: " + e.getMessage());
                } catch (Exception e) {
                    showErrorAlert("Error", "Could not remove item: " + e.getMessage());
                }
            }
        });
    }

    @FXML
    public void handleRefresh() {
        loadWishlist();
        showInfoAlert("Refreshed", "Wishlist reloaded!");
    }

    @FXML
    public void handlePayment() {
        // Validate payment fields
        if (!validatePaymentForm()) {
            return;
        }

        // Check if wishlist is empty
        if (wishlistList == null || wishlistList.isEmpty()) {
            showWarningAlert("Empty Wishlist", "Please add items to your wishlist before proceeding to payment.");
            return;
        }

        // Calculate total
        double total = 0.0;
        for (WishlistDisplayItem item : wishlistList) {
            try {
                total += item.getPrice();
            } catch (Exception e) {
                System.err.println("Error parsing price: " + e.getMessage());
            }
        }

        // Store total for receipt generation
        lastTransactionTotal = total;

        // Simulate payment processing
        showInfoAlert("Payment Processing", "Processing payment of " + String.format("%.2f", total) + " TND...");

        // Clear the wishlist after successful payment
        try {
            // Save transaction to database for the current user
            UserSession session = UserSession.getInstance();
            if (session.isLoggedIn()) {
                boolean transactionSaved = serviceTransactionHistory.saveTransaction(
                        session.getUserId(),
                        total,
                        "Completed"
                );
                if (!transactionSaved) {
                    System.err.println("⚠️ Warning: Transaction not saved to database");
                }
            }

            for (WishlistDisplayItem item : new ArrayList<>(wishlistList)) {
                serviceWishlist.supprimer(item.getId());
            }

            // Clear all form fields
            cardholderNameField.clear();
            cardNumberField.clear();
            expiryDateField.clear();
            cvvField.clear();

            // Send notification
            String notificationMessage = String.format("✅ Payment of %.2f TND successful. Your medicines are being prepared!", total);
            NotificationManager.getInstance().addNotification(notificationMessage);

            // Reload the wishlist and transactions
            loadWishlist();
            loadTransactionHistory();

            // Show success message
            showInfoAlert("Payment Successful", "Your payment has been processed successfully!\n\nTotal: " + String.format("%.2f", total) + " TND\n\nYour medicines are being prepared and will be delivered soon.");

        } catch (SQLException e) {
            showErrorAlert("Payment Error", "An error occurred while processing your payment: " + e.getMessage());
        }
    }

    /**
     * Handle download receipt button click
     * Generates and downloads a PDF receipt for the last transaction
     * Uses CompletableFuture for background processing
     */
    @FXML
    public void handleDownloadReceipt() {
        if (lastTransactionTotal <= 0) {
            showWarningAlert("No Transaction", "Please complete a payment first to download a receipt.");
            return;
        }

        // Get patient name from user session or form
        UserSession session = UserSession.getInstance();
        String patientName = session.isLoggedIn() ? session.getName() : cardholderNameField.getText().trim();
        
        if (patientName == null || patientName.isEmpty()) {
            showWarningAlert("Patient Name Required", "Please enter your name to generate the receipt.");
            return;
        }

        // Change button text to indicate processing
        if (downloadReceiptBtn != null) {
            downloadReceiptBtn.setText("⏳ Generating PDF...");
            downloadReceiptBtn.setDisable(true);
        }

        // Execute PDF generation asynchronously (non-blocking)
        PdfReceiptService.generateAndDownloadPdfAsync(patientName, lastTransactionTotal)
                .thenAccept(success -> {
                    // Update UI on JavaFX thread using Platform.runLater()
                    Platform.runLater(() -> {
                        if (downloadReceiptBtn != null) {
                            if (success) {
                                downloadReceiptBtn.setText("✅ PDF Opened!");
                                showInfoAlert("Receipt Generated", "Your receipt PDF has been generated and opened in your browser.");
                            } else {
                                downloadReceiptBtn.setText("❌ Generation Failed");
                                showErrorAlert("PDF Error", "Could not generate the receipt PDF. Please try again.");
                            }
                            // Revert button after 3 seconds
                            PauseTransition pause = new PauseTransition(Duration.seconds(3));
                            pause.setOnFinished(e -> {
                                downloadReceiptBtn.setText("📄 Download Receipt");
                                downloadReceiptBtn.setDisable(false);
                            });
                            pause.play();
                        }
                    });
                })
                .exceptionally(throwable -> {
                    Platform.runLater(() -> {
                        if (downloadReceiptBtn != null) {
                            downloadReceiptBtn.setText("❌ Error");
                            downloadReceiptBtn.setDisable(false);
                        }
                        showErrorAlert("Error", "An unexpected error occurred: " + throwable.getMessage());
                    });
                    return null;
                });
    }

    /**
     * Validate the payment form before processing
     */
    private boolean validatePaymentForm() {
        String cardholderName = cardholderNameField.getText().trim();
        String cardNumber = cardNumberField.getText().trim();
        String expiryDate = expiryDateField.getText().trim();
        String cvv = cvvField.getText().trim();

        if (cardholderName.isEmpty()) {
            showWarningAlert("Validation Error", "Please enter the cardholder name.");
            return false;
        }

        if (cardNumber.isEmpty()) {
            showWarningAlert("Validation Error", "Please enter a valid card number.");
            return false;
        }

        // Simple card number validation (not real Luhn algorithm, just for mockup)
        String cleanedCardNumber = cardNumber.replaceAll("\\D", "");
        if (cleanedCardNumber.length() < 13 || cleanedCardNumber.length() > 19) {
            showWarningAlert("Validation Error", "Card number must be between 13 and 19 digits.");
            return false;
        }

        if (expiryDate.isEmpty()) {
            showWarningAlert("Validation Error", "Please enter the expiry date (MM/YY).");
            return false;
        }

        if (cvv.isEmpty() || cvv.length() < 3) {
            showWarningAlert("Validation Error", "Please enter a valid CVV (3-4 digits).");
            return false;
        }

        return true;
    }

    /**
     * Update the order summary labels
     */
    private void updateOrderSummary() {
        if (wishlistList == null) {
            orderItemsLabel.setText("0 items");
            orderTotalLabel.setText("0.00 TND");
            return;
        }

        int itemCount = wishlistList.size();
        double total = 0.0;

        for (WishlistDisplayItem item : wishlistList) {
            try {
                total += item.getPrice();
            } catch (Exception e) {
                System.err.println("Error parsing price: " + e.getMessage());
            }
        }

        orderItemsLabel.setText(itemCount + " item" + (itemCount != 1 ? "s" : ""));
        orderTotalLabel.setText(String.format("%.2f", total) + " TND");
    }

    private void updateTotalPrice() {
        if (totalPriceLabel == null || filteredList == null) {
            return;
        }

        double total = 0.0;
        for (WishlistDisplayItem item : filteredList) {
            total += item.getPrice();
        }

        totalPriceLabel.setText("Total: " + formatPrice(total));
    }

    private String formatPrice(double price) {
        return String.format(Locale.US, "%.2f TND", price);
    }

    private void showWarningAlert(String title, String content) {
        Alert alert = new Alert(Alert.AlertType.WARNING);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    private void showErrorAlert(String title, String content) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    private void showInfoAlert(String title, String content) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }
}
