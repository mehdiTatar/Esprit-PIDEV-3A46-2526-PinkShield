package org.example;

import java.sql.*;
import java.util.ArrayList;

public class ServiceParapharmacie {

    private Connection cnx;

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
        ArrayList<Parapharmacie> list = new ArrayList<>();
        String req = "SELECT * FROM parapharmacie";
        Statement st = cnx.createStatement();
        ResultSet rs = st.executeQuery(req);

        while (rs.next()) {
            Parapharmacie p = new Parapharmacie();
            p.setId(rs.getInt("id"));
            p.setNom(rs.getString("name"));
            p.setDescription(rs.getString("description"));
            p.setPrix(rs.getDouble("price"));
            p.setStock(rs.getInt("stock"));
            list.add(p);
        }
        return list;
    }

    public void ajouter(Parapharmacie p) throws SQLException {
        String req = "INSERT INTO parapharmacie (name, description, price, stock) VALUES (?, ?, ?, ?)";
        PreparedStatement ps = cnx.prepareStatement(req);
        ps.setString(1, p.getNom());
        ps.setString(2, p.getDescription());
        ps.setDouble(3, p.getPrix());
        ps.setInt(4, p.getStock());
        ps.executeUpdate();
    }

    public void modifier(Parapharmacie p) throws SQLException {
        String req = "UPDATE parapharmacie SET name = ?, description = ?, price = ?, stock = ? WHERE id = ?";
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
        String req = "SELECT COUNT(*) FROM parapharmacie WHERE name = ?";
        PreparedStatement ps = cnx.prepareStatement(req);
        ps.setString(1, nomProduit);

        ResultSet rs = ps.executeQuery();

        if (rs.next()) {
            int count = rs.getInt(1);
            return count > 0;
        }
        return false;
    }
}