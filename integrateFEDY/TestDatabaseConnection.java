package org.example;

import java.sql.*;
import java.util.ArrayList;

public class TestDatabaseConnection {
    public static void main(String[] args) {
        System.out.println("=== Testing Database Connection ===");
        
        // Test ServiceParapharmacie
        try {
            System.out.println("\n1. Creating ServiceParapharmacie...");
            ServiceParapharmacie service = new ServiceParapharmacie();
            
            System.out.println("2. Loading all products...");
            ArrayList<Parapharmacie> products = service.afficherAll();
            
            System.out.println("3. Found " + products.size() + " products:");
            for (Parapharmacie p : products) {
                System.out.println("   - " + p.getNom() + " | $" + p.getPrix() + " | Stock: " + p.getStock());
            }
            
            if (products.isEmpty()) {
                System.out.println("\n⚠️  WARNING: Database is connected but NO PRODUCTS found!");
                System.out.println("   Please run setup_database.sql to populate the parapharmacie table.");
            } else {
                System.out.println("\n✓ Database is working correctly!");
            }
            
        } catch (Exception e) {
            System.out.println("\n❌ ERROR: " + e.getMessage());
            e.printStackTrace();
            System.out.println("\nPossible issues:");
            System.out.println("- MySQL server is not running");
            System.out.println("- Database 'pinkshield_db' doesn't exist");
            System.out.println("- Connection credentials are wrong (root, empty password)");
        }
        
        System.out.println("\n=== Test Complete ===");
    }
}

