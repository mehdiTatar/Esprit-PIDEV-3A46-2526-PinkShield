package org.example;

import java.sql.*;
import java.util.ArrayList;
import java.util.Locale;

public class ServiceWishlist {

    private Connection cnx;

    public ServiceWishlist() {
        try {
            String url = "jdbc:mysql://localhost:3306/pinkshield_db";
            String user = "root";
            String password = "";

            cnx = DriverManager.getConnection(url, user, password);
            System.out.println("Connexion a la base 'pinkshield_db' reussie !");
        } catch (SQLException e) {
            System.out.println("Erreur de connexion : " + e.getMessage());
        }
    }

    public boolean wishlistItemExists(int user_id, int parapharmacie_id) throws SQLException {
        String req = "SELECT COUNT(*) as count FROM wishlist WHERE user_id = ? AND parapharmacie_id = ?";
        PreparedStatement pst = cnx.prepareStatement(req);
        pst.setInt(1, user_id);
        pst.setInt(2, parapharmacie_id);

        ResultSet rs = pst.executeQuery();
        if (rs.next()) {
            return rs.getInt("count") > 0;
        }
        return false;
    }

    public void ajouter(Wishlist wishlist) throws SQLException {
        String req = "INSERT INTO wishlist (user_id, parapharmacie_id, added_at) VALUES (?, ?, NOW())";
        PreparedStatement pst = cnx.prepareStatement(req);

        pst.setInt(1, wishlist.getUser_id());
        pst.setInt(2, wishlist.getParapharmacie_id());

        pst.executeUpdate();
        System.out.println("Wishlist item ajoute avec succes !");
    }

    public boolean add(Product product) throws SQLException {
        if (product == null || product.getName() == null || product.getName().isBlank()) {
            return false;
        }

        ServiceParapharmacie parapharmacieService = new ServiceParapharmacie();
        Parapharmacie dbProduct = findMatchingParapharmacie(parapharmacieService, product.getName());
        if (dbProduct == null) {
            dbProduct = createParapharmacieFromAiProduct(parapharmacieService, product);
        }
        if (dbProduct == null) {
            System.out.println("Product not found in Parapharmacie inventory: " + product.getName());
            return false;
        }

        int demoUserId = 1;
        if (!wishlistItemExists(demoUserId, dbProduct.getId())) {
            ajouter(new Wishlist(demoUserId, dbProduct.getId()));
        }

        return true;
    }

    private Parapharmacie findMatchingParapharmacie(ServiceParapharmacie parapharmacieService, String productName) throws SQLException {
        Parapharmacie exactMatch = parapharmacieService.findByName(productName);
        if (exactMatch != null) {
            return exactMatch;
        }

        String normalizedTarget = normalizeName(productName);
        for (Parapharmacie candidate : parapharmacieService.afficherAll()) {
            if (normalizeName(candidate.getNom()).equals(normalizedTarget)) {
                return candidate;
            }
        }
        return null;
    }

    private Parapharmacie createParapharmacieFromAiProduct(ServiceParapharmacie parapharmacieService, Product product) throws SQLException {
        Parapharmacie newProduct = new Parapharmacie();
        newProduct.setNom(product.getName().trim());
        newProduct.setDescription(product.getCategory() == null ? "AI recommended product" : product.getCategory());
        newProduct.setPrix(product.getPrice());
        newProduct.setStock(1);

        parapharmacieService.ajouter(newProduct);
        return findMatchingParapharmacie(parapharmacieService, product.getName());
    }

    private String normalizeName(String value) {
        if (value == null) {
            return "";
        }

        return value.toLowerCase(Locale.ROOT)
                .replaceAll("[^a-z0-9]+", "")
                .trim();
    }

    public void modifier(Wishlist wishlist) throws SQLException {
        String req = "UPDATE wishlist SET user_id = ?, parapharmacie_id = ? WHERE id = ?";
        PreparedStatement pst = cnx.prepareStatement(req);

        pst.setInt(1, wishlist.getUser_id());
        pst.setInt(2, wishlist.getParapharmacie_id());
        pst.setInt(3, wishlist.getId());

        pst.executeUpdate();
        System.out.println("Wishlist item modifie avec succes !");
    }

    public void supprimer(int id) throws SQLException {
        String req = "DELETE FROM wishlist WHERE id = ?";
        PreparedStatement pst = cnx.prepareStatement(req);

        pst.setInt(1, id);

        pst.executeUpdate();
        System.out.println("Wishlist item supprime avec succes !");
    }

    public ArrayList<Wishlist> afficherAll() throws SQLException {
        ArrayList<Wishlist> list = new ArrayList<>();
        String req = "SELECT * FROM wishlist";
        PreparedStatement pst = cnx.prepareStatement(req);

        ResultSet rs = pst.executeQuery();

        while (rs.next()) {
            Wishlist wishlist = new Wishlist(
                    rs.getInt("id"),
                    rs.getInt("user_id"),
                    rs.getInt("parapharmacie_id"),
                    rs.getTimestamp("added_at")
            );
            list.add(wishlist);
        }
        return list;
    }
}

