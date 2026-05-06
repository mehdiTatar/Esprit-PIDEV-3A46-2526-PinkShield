package tn.esprit.controllers;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import tn.esprit.entities.Transaction;
import tn.esprit.entities.User;
import tn.esprit.services.PdfReceiptGenerator;
import tn.esprit.services.TransactionService;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.util.List;
import java.util.Locale;

/**
 * Controller for Transaction History View
 * Displays all past payment transactions for the current user
 */
public class TransactionHistoryController {

    @FXML
    private TableView<Transaction> transactionTable;
    @FXML
    private TableColumn<Transaction, Integer> colId;
    @FXML
    private TableColumn<Transaction, String> colTransactionId;
    @FXML
    private TableColumn<Transaction, String> colCardholderName;
    @FXML
    private TableColumn<Transaction, String> colCardLastFour;
    @FXML
    private TableColumn<Transaction, Double> colAmount;
    @FXML
    private TableColumn<Transaction, Integer> colItems;
    @FXML
    private TableColumn<Transaction, String> colStatus;
    @FXML
    private TableColumn<Transaction, String> colDate;
    @FXML
    private TableColumn<Transaction, Void> colActions;
    
    @FXML
    private Label totalSpentLabel;
    @FXML
    private Label totalTransactionsLabel;
    @FXML
    private Label filterStatusCombo;
    
    private final TransactionService transactionService = new TransactionService();
    private final PdfReceiptGenerator pdfReceiptGenerator = new PdfReceiptGenerator();
    private ObservableList<Transaction> transactionItems;
    private User currentUser;

    @FXML
    public void initialize() {
        setupTableColumns();
    }

    public void setCurrentUser(User user) {
        currentUser = user;
        if (user != null) {
            loadTransactions();
        }
    }

    private void setupTableColumns() {
        colId.setCellValueFactory(new PropertyValueFactory<>("id"));
        colTransactionId.setCellValueFactory(new PropertyValueFactory<>("transactionId"));
        colCardholderName.setCellValueFactory(new PropertyValueFactory<>("cardholderName"));
        
        colCardLastFour.setCellValueFactory(cellData -> 
                new javafx.beans.property.SimpleStringProperty("****" + cellData.getValue().getCardLastFour()));
        
        colAmount.setCellValueFactory(new PropertyValueFactory<>("totalAmount"));
        colItems.setCellValueFactory(new PropertyValueFactory<>("itemCount"));
        
        colStatus.setCellValueFactory(cellData -> {
            String status = cellData.getValue().getStatus();
            return new javafx.beans.property.SimpleStringProperty(status != null ? status : "UNKNOWN");
        });
        
        colDate.setCellValueFactory(cellData -> {
            java.sql.Timestamp timestamp = cellData.getValue().getCreatedAt();
            String formatted = timestamp != null ? 
                    timestamp.toLocalDateTime().toLocalDate().toString() : "N/A";
            return new javafx.beans.property.SimpleStringProperty(formatted);
        });

        colActions.setCellFactory(column -> new TableCell<Transaction, Void>() {
            private final Button downloadBtn = new Button("📥 Download");
            private final Button detailsBtn = new Button("📋 Details");

            {
                downloadBtn.setStyle("-fx-background-color: #0984e3; -fx-text-fill: white; -fx-font-size: 10; -fx-padding: 5 8;");
                detailsBtn.setStyle("-fx-background-color: #27ae60; -fx-text-fill: white; -fx-font-size: 10; -fx-padding: 5 8;");

                downloadBtn.setOnAction(event -> handleDownloadReceipt(getTableView().getItems().get(getIndex())));
                detailsBtn.setOnAction(event -> handleViewDetails(getTableView().getItems().get(getIndex())));
            }

            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty) {
                    setGraphic(null);
                } else {
                    javafx.scene.layout.HBox hbox = new javafx.scene.layout.HBox(5);
                    hbox.getChildren().addAll(downloadBtn, detailsBtn);
                    setGraphic(hbox);
                }
            }
        });
    }

    private void loadTransactions() {
        try {
            if (currentUser == null) return;
            
            List<Transaction> transactions = transactionService.getTransactionsByUserId(currentUser.getId());
            transactionItems = FXCollections.observableArrayList(transactions);
            transactionTable.setItems(transactionItems);
            
            updateStatistics();
        } catch (Exception e) {
            showAlert("Error", "Could not load transactions: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    private void updateStatistics() {
        if (transactionItems == null || transactionItems.isEmpty()) {
            totalTransactionsLabel.setText("0 transactions");
            totalSpentLabel.setText("0.00 TND");
            return;
        }

        int count = transactionItems.size();
        double total = transactionService.getTotalSpent(currentUser.getId());
        
        totalTransactionsLabel.setText(count + " transaction" + (count != 1 ? "s" : ""));
        totalSpentLabel.setText(formatPrice(total));
    }

    @FXML
    private void handleDownloadReceipt(Transaction transaction) {
        if (transaction == null) {
            showAlert("No Receipt", "Please choose a transaction first.", Alert.AlertType.WARNING);
            return;
        }

        try {
            File downloadsDir = new File(System.getProperty("user.home"), "Downloads");
            File receiptFile = new File(downloadsDir, "Receipt_" + safeFilePart(transaction.getTransactionId()) + ".pdf");
            pdfReceiptGenerator.generateReceipt(transaction, receiptFile.getAbsolutePath());
            showAlert("Success", "Receipt downloaded to:\n" + receiptFile.getAbsolutePath(), Alert.AlertType.INFORMATION);
        } catch (RuntimeException e) {
            showAlert("Error", "Could not generate receipt: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    private String safeFilePart(String value) {
        String normalized = value == null || value.isBlank() ? "transaction" : value.trim();
        return normalized.replaceAll("[^A-Za-z0-9._-]", "_");
    }

    @FXML
    private void handleViewDetails(Transaction transaction) {
        if (transaction == null) return;

        String details = "Transaction Details\n"
                + "==================\n\n"
                + "Transaction ID: " + transaction.getTransactionId() + "\n"
                + "Cardholder: " + transaction.getCardholderName() + "\n"
                + "Card: ****" + transaction.getCardLastFour() + "\n"
                + "Amount: " + formatPrice(transaction.getTotalAmount()) + "\n"
                + "Items: " + transaction.getItemCount() + "\n"
                + "Status: " + transaction.getStatus() + "\n"
                + "Date: " + (transaction.getCreatedAt() != null ? 
                    transaction.getCreatedAt().toLocalDateTime().toLocalDate() : "N/A") + "\n"
                + "\nReceipt File: " + (transaction.getReceiptFileName() != null ? 
                    transaction.getReceiptFileName() : "N/A");

        showAlert("Transaction Details", details, Alert.AlertType.INFORMATION);
    }

    @FXML
    private void handleRefresh() {
        loadTransactions();
        showAlert("Refreshed", "Transaction history reloaded", Alert.AlertType.INFORMATION);
    }

    @FXML
    private void handleExportAll() {
        try {
            if (transactionItems == null || transactionItems.isEmpty()) {
                showAlert("Empty", "No transactions to export", Alert.AlertType.WARNING);
                return;
            }

            StringBuilder csv = new StringBuilder();
            csv.append("Transaction ID,Cardholder,Card Last 4,Amount (TND),Items,Status,Date\n");

            for (Transaction t : transactionItems) {
                csv.append(t.getTransactionId()).append(",")
                   .append(t.getCardholderName()).append(",")
                   .append(t.getCardLastFour()).append(",")
                   .append(String.format("%.2f", t.getTotalAmount())).append(",")
                   .append(t.getItemCount()).append(",")
                   .append(t.getStatus()).append(",")
                   .append(t.getCreatedAt() != null ? t.getCreatedAt().toLocalDateTime().toLocalDate() : "N/A")
                   .append("\n");
            }

            String fileName = "TransactionHistory_" + LocalDate.now() + ".csv";
            File downloadsDir = new File(System.getProperty("user.home"), "Downloads");
            File exportFile = new File(downloadsDir, fileName);
            Files.write(exportFile.toPath(), csv.toString().getBytes());

            showAlert("Success", "Transaction history exported to:\n" + exportFile.getAbsolutePath(), Alert.AlertType.INFORMATION);
        } catch (Exception e) {
            showAlert("Error", "Could not export transactions: " + e.getMessage(), Alert.AlertType.ERROR);
        }
    }

    private String formatPrice(double price) {
        return String.format(Locale.US, "%.2f TND", price);
    }

    private void showAlert(String title, String content, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }
}

