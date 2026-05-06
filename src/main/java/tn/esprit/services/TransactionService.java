package tn.esprit.services;

import tn.esprit.entities.Transaction;
import tn.esprit.utils.MyDB;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

/**
 * Service for managing transaction history
 */
public class TransactionService {

    private static final String TABLE_NAME = "transactions";

    public TransactionService() {
        initializeTable();
    }

    /**
     * Initialize the transactions table if it doesn't exist
     */
    private void initializeTable() {
        Connection conn;
        try {
            conn = getConnection();
        } catch (SQLException e) {
            System.err.println("Error initializing transactions table: " + e.getMessage());
            return;
        }

        try (Statement stmt = conn.createStatement()) {

            String createTableSQL = "CREATE TABLE IF NOT EXISTS " + TABLE_NAME + " ("
                    + "id INT AUTO_INCREMENT PRIMARY KEY,"
                    + "user_id INT NOT NULL,"
                    + "transaction_id VARCHAR(100) UNIQUE NOT NULL,"
                    + "cardholder_name VARCHAR(255) NOT NULL,"
                    + "card_last_four VARCHAR(4),"
                    + "total_amount DECIMAL(10,2) NOT NULL,"
                    + "item_count INT,"
                    + "status VARCHAR(20),"
                    + "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"
                    + "receipt_file_name VARCHAR(255),"
                    + "items LONGTEXT,"
                    + "INDEX idx_transactions_user_id (user_id),"
                    + "INDEX idx_transactions_created_at (created_at)"
                    + ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            stmt.execute(createTableSQL);

        } catch (SQLException e) {
            System.err.println("Error initializing transactions table: " + e.getMessage());
        }
    }

    /**
     * Save a transaction
     */
    public boolean saveTransaction(Transaction transaction) {
        String sql = "INSERT INTO " + TABLE_NAME
                + " (user_id, transaction_id, cardholder_name, card_last_four, total_amount, item_count, status, receipt_file_name, items)"
                + " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try (PreparedStatement pstmt = getConnection().prepareStatement(sql)) {

            pstmt.setInt(1, transaction.getUserId());
            pstmt.setString(2, transaction.getTransactionId());
            pstmt.setString(3, transaction.getCardholderName());
            pstmt.setString(4, transaction.getCardLastFour());
            pstmt.setDouble(5, transaction.getTotalAmount());
            pstmt.setInt(6, transaction.getItemCount());
            pstmt.setString(7, transaction.getStatus());
            pstmt.setString(8, transaction.getReceiptFileName());
            pstmt.setString(9, transaction.getItems());

            pstmt.executeUpdate();
            return true;

        } catch (SQLException e) {
            System.err.println("Error saving transaction: " + e.getMessage());
            return false;
        }
    }

    /**
     * Get all transactions for a user
     */
    public List<Transaction> getTransactionsByUserId(int userId) {
        String sql = "SELECT * FROM " + TABLE_NAME + " WHERE user_id = ? ORDER BY created_at DESC";
        List<Transaction> transactions = new ArrayList<>();

        try (PreparedStatement pstmt = getConnection().prepareStatement(sql)) {

            pstmt.setInt(1, userId);
            try (ResultSet rs = pstmt.executeQuery()) {
                while (rs.next()) {
                    transactions.add(mapResultSetToTransaction(rs));
                }
            }

        } catch (SQLException e) {
            System.err.println("Error fetching transactions: " + e.getMessage());
        }

        return transactions;
    }

    /**
     * Get a single transaction by ID
     */
    public Transaction getTransactionById(int id) {
        String sql = "SELECT * FROM " + TABLE_NAME + " WHERE id = ?";

        try (PreparedStatement pstmt = getConnection().prepareStatement(sql)) {

            pstmt.setInt(1, id);
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    return mapResultSetToTransaction(rs);
                }
            }

        } catch (SQLException e) {
            System.err.println("Error fetching transaction: " + e.getMessage());
        }

        return null;
    }

    /**
     * Get a transaction by transaction ID
     */
    public Transaction getTransactionByTransactionId(String transactionId) {
        String sql = "SELECT * FROM " + TABLE_NAME + " WHERE transaction_id = ?";

        try (PreparedStatement pstmt = getConnection().prepareStatement(sql)) {

            pstmt.setString(1, transactionId);
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    return mapResultSetToTransaction(rs);
                }
            }

        } catch (SQLException e) {
            System.err.println("Error fetching transaction by transaction_id: " + e.getMessage());
        }

        return null;
    }

    /**
     * Update transaction status
     */
    public boolean updateTransactionStatus(int id, String status) {
        String sql = "UPDATE " + TABLE_NAME + " SET status = ? WHERE id = ?";

        try (PreparedStatement pstmt = getConnection().prepareStatement(sql)) {

            pstmt.setString(1, status);
            pstmt.setInt(2, id);
            pstmt.executeUpdate();
            return true;

        } catch (SQLException e) {
            System.err.println("Error updating transaction status: " + e.getMessage());
            return false;
        }
    }

    /**
     * Delete a transaction
     */
    public boolean deleteTransaction(int id) {
        String sql = "DELETE FROM " + TABLE_NAME + " WHERE id = ?";

        try (PreparedStatement pstmt = getConnection().prepareStatement(sql)) {

            pstmt.setInt(1, id);
            pstmt.executeUpdate();
            return true;

        } catch (SQLException e) {
            System.err.println("Error deleting transaction: " + e.getMessage());
            return false;
        }
    }

    /**
     * Get total transactions for a user
     */
    public int getTransactionCount(int userId) {
        String sql = "SELECT COUNT(*) FROM " + TABLE_NAME + " WHERE user_id = ?";

        try (PreparedStatement pstmt = getConnection().prepareStatement(sql)) {

            pstmt.setInt(1, userId);
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt(1);
                }
            }

        } catch (SQLException e) {
            System.err.println("Error counting transactions: " + e.getMessage());
        }

        return 0;
    }

    /**
     * Get total spent by user
     */
    public double getTotalSpent(int userId) {
        String sql = "SELECT SUM(total_amount) FROM " + TABLE_NAME + " WHERE user_id = ? AND status = 'SUCCESSFUL'";

        try (PreparedStatement pstmt = getConnection().prepareStatement(sql)) {

            pstmt.setInt(1, userId);
            try (ResultSet rs = pstmt.executeQuery()) {
                if (rs.next()) {
                    return rs.getDouble(1);
                }
            }

        } catch (SQLException e) {
            System.err.println("Error calculating total spent: " + e.getMessage());
        }

        return 0.0;
    }

    /**
     * Map ResultSet to Transaction object
     */
    private Transaction mapResultSetToTransaction(ResultSet rs) throws SQLException {
        Transaction transaction = new Transaction();
        transaction.setId(rs.getInt("id"));
        transaction.setUserId(rs.getInt("user_id"));
        transaction.setTransactionId(rs.getString("transaction_id"));
        transaction.setCardholderName(rs.getString("cardholder_name"));
        transaction.setCardLastFour(rs.getString("card_last_four"));
        transaction.setTotalAmount(rs.getDouble("total_amount"));
        transaction.setItemCount(rs.getInt("item_count"));
        transaction.setStatus(rs.getString("status"));
        transaction.setCreatedAt(rs.getTimestamp("created_at"));
        transaction.setReceiptFileName(rs.getString("receipt_file_name"));
        transaction.setItems(rs.getString("items"));
        return transaction;
    }

    /**
     * Get database connection
     */
    private Connection getConnection() throws SQLException {
        Connection connection = MyDB.getInstance().getConnection();
        if (connection == null) {
            throw new SQLException("Database connection is unavailable");
        }
        return connection;
    }
}

