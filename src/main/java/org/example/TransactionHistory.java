package org.example;

import java.sql.Timestamp;

/**
 * TransactionHistory: Represents a transaction record in the database
 * Each transaction belongs to a specific user
 */
public class TransactionHistory {
    private int id;
    private int user_id;
    private double amount;
    private String status;
    private Timestamp transaction_date;

    public TransactionHistory(int id, int user_id, double amount, String status, Timestamp transaction_date) {
        this.id = id;
        this.user_id = user_id;
        this.amount = amount;
        this.status = status;
        this.transaction_date = transaction_date;
    }

    public TransactionHistory(int user_id, double amount, String status) {
        this.user_id = user_id;
        this.amount = amount;
        this.status = status;
        this.transaction_date = new Timestamp(System.currentTimeMillis());
    }

    // Getters and Setters
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getUser_id() {
        return user_id;
    }

    public void setUser_id(int user_id) {
        this.user_id = user_id;
    }

    public double getAmount() {
        return amount;
    }

    public void setAmount(double amount) {
        this.amount = amount;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public Timestamp getTransaction_date() {
        return transaction_date;
    }

    public void setTransaction_date(Timestamp transaction_date) {
        this.transaction_date = transaction_date;
    }

    @Override
    public String toString() {
        return "TransactionHistory{" +
                "id=" + id +
                ", user_id=" + user_id +
                ", amount=" + amount +
                ", status='" + status + '\'' +
                ", transaction_date=" + transaction_date +
                '}';
    }
}

