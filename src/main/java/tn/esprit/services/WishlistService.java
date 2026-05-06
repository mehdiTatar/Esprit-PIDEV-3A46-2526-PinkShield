package tn.esprit.services;

import tn.esprit.entities.Parapharmacy;
import tn.esprit.entities.Wishlist;
import tn.esprit.entities.WishlistDisplayItem;
import tn.esprit.utils.MyDB;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Map;
import java.util.Set;

public class WishlistService {
    private static final String TABLE_NAME = "wishlist";

    private final Connection connection;
    private final ParapharmacyService parapharmacyService = new ParapharmacyService();
    private boolean schemaResolved;
    private boolean wishlistAvailable;
    private String productIdColumn = "parapharmacie_id";

    public WishlistService() {
        connection = MyDB.getInstance().getConnection();
    }

    public boolean isAvailable() {
        return resolveSchema();
    }

    public Set<Integer> getWishlistedProductIds(int userId) {
        Set<Integer> ids = new HashSet<>();
        if (userId <= 0 || !resolveSchema()) {
            return ids;
        }

        String query = "SELECT " + productIdColumn + " FROM " + TABLE_NAME + " WHERE user_id = ?";
        try (PreparedStatement statement = connection.prepareStatement(query)) {
            statement.setInt(1, userId);
            try (ResultSet resultSet = statement.executeQuery()) {
                while (resultSet.next()) {
                    ids.add(resultSet.getInt(1));
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return ids;
    }

    public boolean isInWishlist(int userId, int productId) {
        if (userId <= 0 || productId <= 0 || !resolveSchema()) {
            return false;
        }

        String query = "SELECT COUNT(*) FROM " + TABLE_NAME + " WHERE user_id = ? AND " + productIdColumn + " = ?";
        try (PreparedStatement statement = connection.prepareStatement(query)) {
            statement.setInt(1, userId);
            statement.setInt(2, productId);
            try (ResultSet resultSet = statement.executeQuery()) {
                return resultSet.next() && resultSet.getInt(1) > 0;
            }
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public boolean addItem(int userId, int productId) {
        if (userId <= 0 || productId <= 0 || !resolveSchema()) {
            return false;
        }

        if (isInWishlist(userId, productId)) {
            return true;
        }

        String query = "INSERT INTO " + TABLE_NAME + " (user_id, " + productIdColumn + ", added_at) VALUES (?, ?, NOW())";
        try (PreparedStatement statement = connection.prepareStatement(query)) {
            statement.setInt(1, userId);
            statement.setInt(2, productId);
            return statement.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public boolean removeItem(int wishlistId, int userId) {
        if (wishlistId <= 0 || userId <= 0 || !resolveSchema()) {
            return false;
        }

        String query = "DELETE FROM " + TABLE_NAME + " WHERE id = ? AND user_id = ?";
        try (PreparedStatement statement = connection.prepareStatement(query)) {
            statement.setInt(1, wishlistId);
            statement.setInt(2, userId);
            return statement.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public List<Wishlist> getItemsByUser(int userId) {
        List<Wishlist> items = new ArrayList<>();
        if (userId <= 0 || !resolveSchema()) {
            return items;
        }

        String query = "SELECT id, user_id, " + productIdColumn + ", added_at FROM " + TABLE_NAME
                + " WHERE user_id = ? ORDER BY added_at DESC, id DESC";
        try (PreparedStatement statement = connection.prepareStatement(query)) {
            statement.setInt(1, userId);
            try (ResultSet resultSet = statement.executeQuery()) {
                while (resultSet.next()) {
                    items.add(new Wishlist(
                            resultSet.getInt("id"),
                            resultSet.getInt("user_id"),
                            resultSet.getInt(productIdColumn),
                            resultSet.getTimestamp("added_at")
                    ));
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return items;
    }

    public List<WishlistDisplayItem> getDisplayItemsByUser(int userId) {
        List<WishlistDisplayItem> displayItems = new ArrayList<>();
        if (userId <= 0 || !resolveSchema()) {
            return displayItems;
        }

        Map<Integer, Parapharmacy> productsById = loadProductsById();
        for (Wishlist wishlist : getItemsByUser(userId)) {
            Parapharmacy product = productsById.get(wishlist.getParapharmacyId());
            String productName = product == null || isBlank(product.getName())
                    ? "Product #" + wishlist.getParapharmacyId()
                    : product.getName();
            String category = product == null || isBlank(product.getCategory()) ? "General" : product.getCategory();
            double price = product == null ? 0.0 : product.getPrice();

            displayItems.add(new WishlistDisplayItem(
                    wishlist.getId(),
                    wishlist.getUserId(),
                    wishlist.getParapharmacyId(),
                    productName,
                    category,
                    price,
                    wishlist.getAddedAt()
            ));
        }

        return displayItems;
    }

    private Map<Integer, Parapharmacy> loadProductsById() {
        Map<Integer, Parapharmacy> productsById = new HashMap<>();
        for (Parapharmacy product : parapharmacyService.getAllProducts()) {
            productsById.put(product.getId(), product);
        }
        return productsById;
    }

    private boolean resolveSchema() {
        if (schemaResolved || connection == null) {
            return wishlistAvailable;
        }

        try {
            ensureWishlistTableExists();
            if (!tableExists(TABLE_NAME)) {
                schemaResolved = true;
                wishlistAvailable = false;
                return false;
            }

            productIdColumn = firstExistingColumn("parapharmacie_id", "parapharmacy_id", "product_id");
            wishlistAvailable = productIdColumn != null
                    && hasColumn(TABLE_NAME, "user_id")
                    && hasColumn(TABLE_NAME, "added_at");
        } catch (SQLException e) {
            e.printStackTrace();
            wishlistAvailable = false;
        }

        schemaResolved = true;
        return wishlistAvailable;
    }

    private void ensureWishlistTableExists() throws SQLException {
        String query = """
                CREATE TABLE IF NOT EXISTS wishlist (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT NOT NULL,
                    parapharmacie_id INT NOT NULL,
                    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    UNIQUE KEY unique_user_product (user_id, parapharmacie_id)
                )
                """;
        try (Statement statement = connection.createStatement()) {
            statement.executeUpdate(query);
        }
    }

    private boolean tableExists(String tableName) throws SQLException {
        String query = "SELECT 1 FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = ? LIMIT 1";
        try (PreparedStatement statement = connection.prepareStatement(query)) {
            statement.setString(1, tableName);
            try (ResultSet resultSet = statement.executeQuery()) {
                return resultSet.next();
            }
        }
    }

    private boolean hasColumn(String tableName, String columnName) throws SQLException {
        String query = "SELECT 1 FROM information_schema.columns WHERE table_schema = DATABASE() AND table_name = ? AND column_name = ? LIMIT 1";
        try (PreparedStatement statement = connection.prepareStatement(query)) {
            statement.setString(1, tableName);
            statement.setString(2, columnName);
            try (ResultSet resultSet = statement.executeQuery()) {
                return resultSet.next();
            }
        }
    }

    private String firstExistingColumn(String... candidates) throws SQLException {
        for (String candidate : candidates) {
            if (hasColumn(TABLE_NAME, candidate)) {
                return candidate;
            }
        }
        return null;
    }

    private boolean isBlank(String value) {
        return value == null || value.trim().isEmpty();
    }
}
