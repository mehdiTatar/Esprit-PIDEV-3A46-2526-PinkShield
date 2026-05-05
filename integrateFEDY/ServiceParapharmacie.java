package org.example;

import java.sql.*;
import java.util.ArrayList;
import java.util.HashSet;
import java.util.List;
import java.util.Locale;
import java.util.Set;

public class ServiceParapharmacie {

    private Connection cnx;
    private boolean catalogSeeded;
    private boolean columnsResolved;
    private String nameColumn = "nom";
    private String priceColumn = "prix";

    public ServiceParapharmacie() {
        try {
            String url = "jdbc:mysql://127.0.0.1:3306/pinkshield_db?serverVersion=8.0&charset=utf8mb4";
            String user = "root";
            String password = "";

            cnx = DriverManager.getConnection(url, user, password);
            System.out.println("✅ Connexion Parapharmacie à la base réussie !");
        } catch (SQLException e) {
            System.out.println("❌ Erreur de connexion Parapharmacie : " + e.getMessage());
        }
    }

    public ArrayList<Parapharmacie> afficherAll() throws SQLException {
        resolveColumnNames();
        ensureCatalogInventorySeeded();

        ArrayList<Parapharmacie> list = new ArrayList<>();
        String req = "SELECT * FROM parapharmacie";
        Statement st = cnx.createStatement();
        ResultSet rs = st.executeQuery(req);

        while (rs.next()) {
            Parapharmacie p = new Parapharmacie();
            p.setId(rs.getInt("id"));
            p.setNom(rs.getString(nameColumn));
            p.setDescription(rs.getString("description"));
            p.setPrix(rs.getDouble(priceColumn));
            p.setStock(rs.getInt("stock"));
            list.add(p);
        }
        return list;
    }

    private void ensureCatalogInventorySeeded() throws SQLException {
        resolveColumnNames();
        if (cnx == null || catalogSeeded) {
            return;
        }

        Set<String> existingNames = new HashSet<>();
        String existingQuery = "SELECT " + nameColumn + " FROM parapharmacie";
        try (Statement statement = cnx.createStatement(); ResultSet rs = statement.executeQuery(existingQuery)) {
            while (rs.next()) {
                String name = rs.getString(nameColumn);
                if (name != null) {
                    existingNames.add(normalizeName(name));
                }
            }
        }

        List<Product> catalog = ProductCatalog.getInventory();
        if (catalog.isEmpty()) {
            catalogSeeded = true;
            return;
        }

        String insertSql = "INSERT INTO parapharmacie (" + nameColumn + ", description, " + priceColumn + ", stock) VALUES (?, ?, ?, ?)";
        try (PreparedStatement insert = cnx.prepareStatement(insertSql)) {
            int index = 0;
            for (Product product : catalog) {
                String normalizedName = normalizeName(product.getName());
                if (existingNames.contains(normalizedName)) {
                    continue;
                }

                insert.setString(1, product.getName());
                insert.setString(2, product.getCategory());
                insert.setDouble(3, product.getPrice());
                insert.setInt(4, defaultStockFor(index, product));
                insert.executeUpdate();
                existingNames.add(normalizedName);
                index++;
            }
        }

        catalogSeeded = true;
    }

    private int defaultStockFor(int index, Product product) {
        String category = product.getCategory() == null ? "" : product.getCategory().toLowerCase(Locale.ROOT);
        if (category.contains("baby")) {
            return 18 + (index % 9);
        }
        if (category.contains("derm") || category.contains("skin")) {
            return 12 + (index % 8);
        }
        if (category.contains("pain")) {
            return 20 + (index % 10);
        }
        if (category.contains("digest")) {
            return 16 + (index % 7);
        }
        return 10 + (index % 15);
    }

    private String normalizeName(String value) {
        return value == null ? "" : value.toLowerCase(Locale.ROOT).replaceAll("[^a-z0-9]+", "").trim();
    }

    public Parapharmacie findByName(String productName) throws SQLException {
        resolveColumnNames();
        String req = "SELECT * FROM parapharmacie WHERE " + nameColumn + " = ? LIMIT 1";
        PreparedStatement ps = cnx.prepareStatement(req);
        ps.setString(1, productName);

        ResultSet rs = ps.executeQuery();
        if (rs.next()) {
            Parapharmacie p = new Parapharmacie();
            p.setId(rs.getInt("id"));
            p.setNom(rs.getString(nameColumn));
            p.setDescription(rs.getString("description"));
            p.setPrix(rs.getDouble(priceColumn));
            p.setStock(rs.getInt("stock"));
            return p;
        }
        return null;
    }

    public void ajouter(Parapharmacie p) throws SQLException {
        resolveColumnNames();
        String req = "INSERT INTO parapharmacie (" + nameColumn + ", description, " + priceColumn + ", stock) VALUES (?, ?, ?, ?)";
        PreparedStatement ps = cnx.prepareStatement(req);
        ps.setString(1, p.getNom());
        ps.setString(2, p.getDescription());
        ps.setDouble(3, p.getPrix());
        ps.setInt(4, p.getStock());
        ps.executeUpdate();
    }

    public void modifier(Parapharmacie p) throws SQLException {
        resolveColumnNames();
        String req = "UPDATE parapharmacie SET " + nameColumn + " = ?, description = ?, " + priceColumn + " = ?, stock = ? WHERE id = ?";
        PreparedStatement ps = cnx.prepareStatement(req);
        ps.setString(1, p.getNom());
        ps.setString(2, p.getDescription());
        ps.setDouble(3, p.getPrix());
        ps.setInt(4, p.getStock());
        ps.setInt(5, p.getId());
        ps.executeUpdate();
    }

    public void supprimer(int id) throws SQLException {
        String req = "DELETE FROM parapharmacie WHERE id = ?";
        PreparedStatement ps = cnx.prepareStatement(req);
        ps.setInt(1, id);
        ps.executeUpdate();
    }

    // ==========================================================
    // MÉTHODE MANQUANTE AJOUTÉE ICI : productExists
    // ==========================================================
    public boolean productExists(String nomProduit) throws SQLException {
        resolveColumnNames();
        String req = "SELECT COUNT(*) FROM parapharmacie WHERE " + nameColumn + " = ?";
        PreparedStatement ps = cnx.prepareStatement(req);
        ps.setString(1, nomProduit);

        ResultSet rs = ps.executeQuery();

        if (rs.next()) {
            int count = rs.getInt(1);
            return count > 0;
        }
        return false;
    }

    private void resolveColumnNames() throws SQLException {
        if (columnsResolved || cnx == null) {
            return;
        }

        boolean hasNom = hasColumn("parapharmacie", "nom");
        boolean hasName = hasColumn("parapharmacie", "name");
        if (hasNom) {
            nameColumn = "nom";
            priceColumn = hasColumn("parapharmacie", "prix") ? "prix" : "price";
        } else if (hasName) {
            nameColumn = "name";
            priceColumn = hasColumn("parapharmacie", "price") ? "price" : "prix";
        } else {
            throw new SQLException("Parapharmacie table is missing a name column (expected nom or name).");
        }

        columnsResolved = true;
    }

    private boolean hasColumn(String tableName, String columnName) throws SQLException {
        DatabaseMetaData metaData = cnx.getMetaData();
        try (ResultSet rs = metaData.getColumns(null, null, tableName, null)) {
            while (rs.next()) {
                String existing = rs.getString("COLUMN_NAME");
                if (existing != null && existing.equalsIgnoreCase(columnName)) {
                    return true;
                }
            }
        }
        return false;
    }
}