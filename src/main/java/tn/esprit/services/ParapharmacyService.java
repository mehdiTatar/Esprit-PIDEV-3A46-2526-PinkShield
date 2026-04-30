package tn.esprit.services;

import tn.esprit.entities.Parapharmacy;
import tn.esprit.utils.MyDB;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.LinkedHashSet;
import java.util.List;
import java.util.Locale;
import java.util.Set;

public class ParapharmacyService {
    private static final String DEFAULT_CATEGORY = "General";
    private static final int DEFAULT_STOCK = 10;

    private final Connection conn;
    private boolean schemaResolved;
    private boolean catalogSeeded;
    private String tableName = "parapharmacy";
    private String nameColumn = "name";
    private String descriptionColumn = "description";
    private String priceColumn = "price";
    private String categoryColumn = "category";
    private String stockColumn = "stock";
    private String imagePathColumn = "image_path";
    private boolean hasCategoryColumn;
    private boolean hasStockColumn;
    private boolean hasImagePathColumn;

    public ParapharmacyService() {
        conn = MyDB.getInstance().getConnection();
    }

    public boolean addProduct(Parapharmacy product) {
        if (conn == null || !resolveSchema()) {
            return false;
        }

        List<String> columns = new ArrayList<>(List.of(nameColumn, descriptionColumn, priceColumn));
        List<Object> values = new ArrayList<>(List.of(
                product.getName(),
                product.getDescription(),
                product.getPrice()
        ));

        if (hasStockColumn) {
            columns.add(stockColumn);
            values.add(product.getStock());
        }
        if (hasCategoryColumn) {
            columns.add(categoryColumn);
            values.add(normalizeCategory(product.getCategory()));
        }
        if (hasImagePathColumn) {
            columns.add(imagePathColumn);
            values.add(product.getImagePath());
        }

        String placeholders = String.join(", ", columns.stream().map(ignored -> "?").toList());
        String query = "INSERT INTO " + tableName + " (" + String.join(", ", columns) + ") VALUES (" + placeholders + ")";

        try (PreparedStatement ps = conn.prepareStatement(query)) {
            bindValues(ps, values);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public List<Parapharmacy> getAllProducts() {
        List<Parapharmacy> list = new ArrayList<>();
        if (conn == null || !resolveSchema()) {
            return list;
        }

        ensureCatalogInventorySeeded();
        String query = "SELECT * FROM " + tableName + " ORDER BY " + nameColumn + " ASC";
        try (Statement st = conn.createStatement(); ResultSet rs = st.executeQuery(query)) {
            while (rs.next()) {
                list.add(mapProduct(rs));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return list;
    }

    public boolean updateProduct(Parapharmacy product) {
        if (conn == null || !resolveSchema()) {
            return false;
        }

        List<String> assignments = new ArrayList<>(List.of(
                nameColumn + " = ?",
                descriptionColumn + " = ?",
                priceColumn + " = ?"
        ));
        List<Object> values = new ArrayList<>(List.of(
                product.getName(),
                product.getDescription(),
                product.getPrice()
        ));

        if (hasStockColumn) {
            assignments.add(stockColumn + " = ?");
            values.add(product.getStock());
        }
        if (hasCategoryColumn) {
            assignments.add(categoryColumn + " = ?");
            values.add(normalizeCategory(product.getCategory()));
        }
        if (hasImagePathColumn) {
            assignments.add(imagePathColumn + " = ?");
            values.add(product.getImagePath());
        }

        values.add(product.getId());
        String query = "UPDATE " + tableName + " SET " + String.join(", ", assignments) + " WHERE id = ?";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            bindValues(ps, values);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public boolean deleteProduct(int id) {
        if (conn == null || !resolveSchema()) {
            return false;
        }

        String query = "DELETE FROM " + tableName + " WHERE id = ?";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setInt(1, id);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public List<Parapharmacy> searchProducts(String name) {
        List<Parapharmacy> list = new ArrayList<>();
        if (conn == null || !resolveSchema()) {
            return list;
        }

        ensureCatalogInventorySeeded();
        String query = hasCategoryColumn
                ? "SELECT * FROM " + tableName + " WHERE " + nameColumn + " LIKE ? OR " + categoryColumn + " LIKE ? ORDER BY " + nameColumn + " ASC"
                : "SELECT * FROM " + tableName + " WHERE " + nameColumn + " LIKE ? ORDER BY " + nameColumn + " ASC";

        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, "%" + name + "%");
            if (hasCategoryColumn) {
                ps.setString(2, "%" + name + "%");
            }
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    list.add(mapProduct(rs));
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return list;
    }

    public boolean productExists(Parapharmacy product, Integer excludedId) {
        if (conn == null || !resolveSchema()) {
            return false;
        }

        String query = "SELECT COUNT(*) as count FROM " + tableName + " WHERE " + nameColumn + " = ?";
        if (hasCategoryColumn) {
            query += " AND " + categoryColumn + " = ?";
        }
        if (excludedId != null) {
            query += " AND id != ?";
        }

        try (PreparedStatement ps = conn.prepareStatement(query)) {
            int index = 1;
            ps.setString(index++, product.getName());
            if (hasCategoryColumn) {
                ps.setString(index++, normalizeCategory(product.getCategory()));
            }
            if (excludedId != null) {
                ps.setInt(index, excludedId);
            }
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next() && rs.getInt("count") > 0;
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    public List<String> getAvailableCategories() {
        List<String> categories = new ArrayList<>();
        if (conn == null || !resolveSchema()) {
            return categories;
        }

        ensureCatalogInventorySeeded();
        if (!hasCategoryColumn) {
            categories.add(DEFAULT_CATEGORY);
            return categories;
        }

        String query = "SELECT DISTINCT " + categoryColumn + " FROM " + tableName
                + " WHERE " + categoryColumn + " IS NOT NULL AND TRIM(" + categoryColumn + ") <> '' ORDER BY " + categoryColumn + " ASC";
        try (PreparedStatement ps = conn.prepareStatement(query);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) {
                categories.add(rs.getString(1));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return categories;
    }

    private Parapharmacy mapProduct(ResultSet rs) throws SQLException {
        return new Parapharmacy(
                rs.getInt("id"),
                rs.getString(nameColumn),
                rs.getString(descriptionColumn),
                rs.getDouble(priceColumn),
                hasStockColumn ? rs.getInt(stockColumn) : DEFAULT_STOCK,
                hasCategoryColumn ? normalizeCategory(rs.getString(categoryColumn)) : DEFAULT_CATEGORY,
                hasImagePathColumn ? safeString(rs.getString(imagePathColumn)) : ""
        );
    }

    private boolean resolveSchema() {
        if (schemaResolved || conn == null) {
            return schemaResolved;
        }

        try {
            boolean hasFrenchTable = tableExists("parapharmacie");
            boolean hasEnglishTable = tableExists("parapharmacy");

            if (hasFrenchTable && getRowCount("parapharmacie") > 0) {
                tableName = "parapharmacie";
            } else if (hasEnglishTable && getRowCount("parapharmacy") > 0) {
                tableName = "parapharmacy";
            } else if (hasFrenchTable) {
                tableName = "parapharmacie";
            } else if (hasEnglishTable) {
                tableName = "parapharmacy";
            } else {
                return false;
            }

            nameColumn = firstExistingColumn("name", "nom");
            descriptionColumn = firstExistingColumn("description");
            priceColumn = firstExistingColumn("price", "prix");

            hasCategoryColumn = hasColumn(tableName, "category");
            hasStockColumn = hasColumn(tableName, "stock");
            hasImagePathColumn = hasColumn(tableName, "image_path");

            if (hasCategoryColumn) {
                categoryColumn = "category";
            }
            if (hasStockColumn) {
                stockColumn = "stock";
            }
            if (hasImagePathColumn) {
                imagePathColumn = "image_path";
            }

            schemaResolved = nameColumn != null && descriptionColumn != null && priceColumn != null;
            return schemaResolved;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    private String firstExistingColumn(String... candidates) throws SQLException {
        for (String candidate : candidates) {
            if (hasColumn(tableName, candidate)) {
                return candidate;
            }
        }
        return null;
    }

    private boolean tableExists(String candidateTable) throws SQLException {
        String query = "SELECT 1 FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = ? LIMIT 1";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, candidateTable);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next();
            }
        }
    }

    private boolean hasColumn(String candidateTable, String candidateColumn) throws SQLException {
        String query = "SELECT 1 FROM information_schema.columns WHERE table_schema = DATABASE() AND table_name = ? AND column_name = ? LIMIT 1";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, candidateTable);
            ps.setString(2, candidateColumn);
            try (ResultSet rs = ps.executeQuery()) {
                return rs.next();
            }
        }
    }

    private int getRowCount(String candidateTable) throws SQLException {
        String query = "SELECT COUNT(*) FROM " + candidateTable;
        try (PreparedStatement ps = conn.prepareStatement(query);
             ResultSet rs = ps.executeQuery()) {
            return rs.next() ? rs.getInt(1) : 0;
        }
    }

    private void ensureCatalogInventorySeeded() {
        if (catalogSeeded || conn == null || !resolveSchema()) {
            return;
        }

        try {
            if ("parapharmacie".equalsIgnoreCase(tableName) && getRowCount(tableName) > 0) {
                catalogSeeded = true;
                return;
            }
        } catch (SQLException e) {
            e.printStackTrace();
            return;
        }

        Set<String> existingKeys = new LinkedHashSet<>();
        String existingQuery = "SELECT " + nameColumn + (hasCategoryColumn ? ", " + categoryColumn : "") + " FROM " + tableName;
        try (PreparedStatement ps = conn.prepareStatement(existingQuery);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) {
                String category = hasCategoryColumn ? rs.getString(hasCategoryColumn ? 2 : 1) : DEFAULT_CATEGORY;
                existingKeys.add(buildCatalogKey(rs.getString(1), category));
            }
        } catch (SQLException e) {
            e.printStackTrace();
            return;
        }

        for (Parapharmacy seedProduct : ParapharmacyCatalog.getSeedProducts()) {
            String seedKey = buildCatalogKey(seedProduct.getName(), seedProduct.getCategory());
            if (existingKeys.contains(seedKey)) {
                continue;
            }
            addProduct(seedProduct);
            existingKeys.add(seedKey);
        }

        catalogSeeded = true;
    }

    private void bindValues(PreparedStatement ps, List<Object> values) throws SQLException {
        for (int i = 0; i < values.size(); i++) {
            Object value = values.get(i);
            if (value instanceof String stringValue) {
                ps.setString(i + 1, stringValue);
            } else if (value instanceof Integer integerValue) {
                ps.setInt(i + 1, integerValue);
            } else if (value instanceof Double doubleValue) {
                ps.setDouble(i + 1, doubleValue);
            } else {
                ps.setObject(i + 1, value);
            }
        }
    }

    private String buildCatalogKey(String name, String category) {
        return normalize(name) + "|" + normalize(category);
    }

    private String normalizeCategory(String value) {
        String normalized = safeString(value).trim();
        return normalized.isEmpty() ? DEFAULT_CATEGORY : normalized;
    }

    private String safeString(String value) {
        return value == null ? "" : value;
    }

    private String normalize(String value) {
        return safeString(value).trim().toLowerCase(Locale.ROOT);
    }
}
