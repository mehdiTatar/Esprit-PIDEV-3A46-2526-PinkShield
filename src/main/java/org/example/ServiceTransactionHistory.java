package org.example;

import java.sql.*;
import java.util.ArrayList;

/**
 * ServiceTransactionHistory: Handles database operations for transaction history
 * Each transaction is linked to a specific user by user_id
 */
public class ServiceTransactionHistory {
    private Connection cnx;

    public ServiceTransactionHistory() {
        try {
            String url = "jdbc:mysql://localhost:3306/pinkshield_db";
            String user = "root";
            String password = "";

            cnx = DriverManager.getConnection(url, user, password);
            System.out.println("✅ Transaction History Service Connected");
        } catch (SQLException e) {
            System.err.println("❌ Error connecting to database: " + e.getMessage());
        }
    }

    /**
     * Save a new transaction for a user
     */
    public boolean saveTransaction(int userId, double amount, String status) {
        try {
            if (cnx == null || cnx.isClosed()) {
                System.err.println("Database connection is closed");
                return false;
            }

            String query = "INSERT INTO transaction_history (user_id, amount, status, transaction_date) VALUES (?, ?, ?, NOW())";
            PreparedStatement statement = cnx.prepareStatement(query);
            statement.setInt(1, userId);
            statement.setDouble(2, amount);
            statement.setString(3, status);

            int result = statement.executeUpdate();
            statement.close();

            System.out.println("✅ Transaction saved: User " + userId + " - Amount: " + amount + " TND");
            return result > 0;
        } catch (SQLException e) {
            System.err.println("❌ Error saving transaction: " + e.getMessage());
            return false;
        }
    }

    /**
     * Get all transactions for a specific user
     */
    public ArrayList<TransactionHistory> getByUserId(int userId) throws SQLException {
        ArrayList<TransactionHistory> transactions = new ArrayList<>();

        if (cnx == null || cnx.isClosed()) {
            System.err.println("Database connection is closed");
            return transactions;
        }

        String query = "SELECT id, user_id, amount, status, transaction_date FROM transaction_history WHERE user_id = ? ORDER BY transaction_date DESC";
        PreparedStatement statement = cnx.prepareStatement(query);
        statement.setInt(1, userId);

        ResultSet result = statement.executeQuery();

        while (result.next()) {
            TransactionHistory transaction = new TransactionHistory(
                    result.getInt("id"),
                    result.getInt("user_id"),
                    result.getDouble("amount"),
                    result.getString("status"),
                    result.getTimestamp("transaction_date")
            );
            transactions.add(transaction);
        }

        result.close();
        statement.close();

        System.out.println("✅ Loaded " + transactions.size() + " transactions for user " + userId);
        return transactions;
    }
}
