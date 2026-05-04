package org.example;

/**
 * TransactionDisplayItem: Represents a transaction record for display in the wishlist transaction history
 */
public class TransactionDisplayItem {
    private int id;
    private String date;
    private String amount;
    private String status;

    public TransactionDisplayItem(int id, String date, String amount, String status) {
        this.id = id;
        this.date = date;
        this.amount = amount;
        this.status = status;
    }

    // Getters
    public int getId() {
        return id;
    }

    public String getDate() {
        return date;
    }

    public String getAmount() {
        return amount;
    }

    public String getStatus() {
        return status;
    }

    // Setters
    public void setId(int id) {
        this.id = id;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public void setAmount(String amount) {
        this.amount = amount;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    @Override
    public String toString() {
        return "TransactionDisplayItem{" +
                "id=" + id +
                ", date='" + date + '\'' +
                ", amount='" + amount + '\'' +
                ", status='" + status + '\'' +
                '}';
    }
}

