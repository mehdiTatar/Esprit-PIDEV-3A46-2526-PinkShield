package tn.esprit.entities;

import java.sql.Timestamp;

/**
 * Transaction entity for storing payment transaction history
 */
public class Transaction {
    private int id;
    private int userId;
    private String transactionId;
    private String cardholderName;
    private String cardLastFour;
    private double totalAmount;
    private int itemCount;
    private String status; // SUCCESSFUL, PENDING, FAILED
    private Timestamp createdAt;
    private String receiptFileName;
    private String items; // JSON string of items

    public Transaction() {
    }

    public Transaction(int userId, String transactionId, String cardholderName, String cardLastFour,
                      double totalAmount, int itemCount, String status, String receiptFileName, String items) {
        this.userId = userId;
        this.transactionId = transactionId;
        this.cardholderName = cardholderName;
        this.cardLastFour = cardLastFour;
        this.totalAmount = totalAmount;
        this.itemCount = itemCount;
        this.status = status;
        this.createdAt = new Timestamp(System.currentTimeMillis());
        this.receiptFileName = receiptFileName;
        this.items = items;
    }

    // Getters and Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public String getTransactionId() {
        return transactionId;
    }

    public void setTransactionId(String transactionId) {
        this.transactionId = transactionId;
    }

    public String getCardholderName() {
        return cardholderName;
    }

    public void setCardholderName(String cardholderName) {
        this.cardholderName = cardholderName;
    }

    public String getCardLastFour() {
        return cardLastFour;
    }

    public void setCardLastFour(String cardLastFour) {
        this.cardLastFour = cardLastFour;
    }

    public double getTotalAmount() {
        return totalAmount;
    }

    public void setTotalAmount(double totalAmount) {
        this.totalAmount = totalAmount;
    }

    public int getItemCount() {
        return itemCount;
    }

    public void setItemCount(int itemCount) {
        this.itemCount = itemCount;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public Timestamp getCreatedAt() {
        return createdAt;
    }

    public void setCreatedAt(Timestamp createdAt) {
        this.createdAt = createdAt;
    }

    public String getReceiptFileName() {
        return receiptFileName;
    }

    public void setReceiptFileName(String receiptFileName) {
        this.receiptFileName = receiptFileName;
    }

    public String getItems() {
        return items;
    }

    public void setItems(String items) {
        this.items = items;
    }

    @Override
    public String toString() {
        return "Transaction{" +
                "id=" + id +
                ", userId=" + userId +
                ", transactionId='" + transactionId + '\'' +
                ", cardholderName='" + cardholderName + '\'' +
                ", cardLastFour='" + cardLastFour + '\'' +
                ", totalAmount=" + totalAmount +
                ", itemCount=" + itemCount +
                ", status='" + status + '\'' +
                ", createdAt=" + createdAt +
                ", receiptFileName='" + receiptFileName + '\'' +
                '}';
    }
}

