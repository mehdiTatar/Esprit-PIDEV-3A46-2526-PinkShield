package org.example;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.fxml.FXML;
import javafx.geometry.Insets;
import javafx.scene.control.*;
import javafx.scene.layout.FlowPane;
import javafx.scene.layout.VBox;

import java.sql.SQLException;
import java.util.ArrayList;

public class ParapharmacieController {

    @FXML
    private TextField txtNom;
    @FXML
    private TextField txtPrix;
    @FXML
    private TextField txtStock;
    @FXML
    private TextField searchBar;
    @FXML
    private FlowPane productFlowPane;

    private ServiceParapharmacie service;
    private ServiceWishlist wishlistService;
    private ObservableList<Parapharmacie> productList;
    private FilteredList<Parapharmacie> filteredList;

    @FXML
    public void initialize() {
        service = new ServiceParapharmacie();
        wishlistService = new ServiceWishlist();

        loadProducts();
        setupRealTimeSearch();
    }

    private void loadProducts() {
        try {
            ArrayList<Parapharmacie> products = service.afficherAll();
            productList = FXCollections.observableArrayList(products);
            System.out.println("Successfully loaded " + products.size() + " products from database");
            displayProducts(productList);
        } catch (SQLException e) {
            System.out.println("Database connection error - this is OK for testing: " + e.getMessage());
            e.printStackTrace();
            productList = FXCollections.observableArrayList();
            displayProducts(productList);
        } catch (NullPointerException e) {
            System.out.println("Database not ready - this is OK: " + e.getMessage());
            e.printStackTrace();
            productList = FXCollections.observableArrayList();
            displayProducts(productList);
        } catch (Exception e) {
            System.out.println("Unexpected error loading products: " + e.getMessage());
            e.printStackTrace();
            productList = FXCollections.observableArrayList();
            displayProducts(productList);
        }
    }

    private void displayProducts(ObservableList<Parapharmacie> products) {
        productFlowPane.getChildren().clear();
        System.out.println("Displaying " + products.size() + " products");
        if (products.isEmpty()) {
            System.out.println("WARNING: No products to display!");
        }
        for (Parapharmacie product : products) {
            VBox card = createProductCard(product);
            productFlowPane.getChildren().add(card);
            System.out.println("Added product: " + product.getNom());
        }
    }

    private VBox createProductCard(Parapharmacie product) {
        VBox card = new VBox(10);
        card.setStyle("-fx-background-color: #ffffff; -fx-border-color: #e0e0e0; -fx-border-width: 1; -fx-border-radius: 10; -fx-background-radius: 10; -fx-padding: 15; -fx-effect: dropshadow(three-pass-box, rgba(0,0,0,0.1), 5, 0, 0, 2);");
        card.setPrefWidth(280);
        card.setPrefHeight(220);
        card.getStyleClass().add("product-card");

        Label nameLabel = new Label("📦 " + product.getNom());
        nameLabel.setStyle("-fx-font-size: 16; -fx-font-weight: bold; -fx-text-fill: #333;");
        nameLabel.setWrapText(true);
        nameLabel.getStyleClass().add("product-name");

        Label priceLabel = new Label("💰 Price: $" + String.format("%.2f", product.getPrix()));
        priceLabel.setStyle("-fx-font-size: 14; -fx-text-fill: #666;");
        priceLabel.getStyleClass().add("product-price");

        Label stockLabel = new Label("📊 Stock: " + product.getStock());
        stockLabel.setStyle("-fx-font-size: 14; -fx-text-fill: #666;");
        stockLabel.getStyleClass().add("product-stock");

        Button wishlistButton = new Button("❤️ Add to Wishlist");
        wishlistButton.setStyle("-fx-background-color: #ff6b6b; -fx-text-fill: white; -fx-font-size: 12; -fx-background-radius: 5; -fx-padding: 8 15;");
        wishlistButton.getStyleClass().add("wishlist-btn");
        wishlistButton.setOnAction(e -> addToWishlist(product));
        wishlistButton.setMaxWidth(Double.MAX_VALUE);

        card.getChildren().addAll(nameLabel, priceLabel, stockLabel, wishlistButton);
        VBox.setMargin(wishlistButton, new Insets(10, 0, 0, 0));
        VBox.setVgrow(nameLabel, javafx.scene.layout.Priority.ALWAYS);

        return card;
    }

    private void addToWishlist(Parapharmacie product) {
        try {
            if (wishlistService.wishlistItemExists(1, product.getId())) {
                showWarningAlert("Already in Wishlist", "This product is already in your wishlist.");
                return;
            }
            Wishlist wishlist = new Wishlist(1, product.getId());
            wishlistService.ajouter(wishlist);
            showInfoAlert("Success", "Product added to wishlist!");
        } catch (SQLException e) {
            showErrorAlert("Database Error", "Could not add to wishlist: " + e.getMessage());
        }
    }

    private void setupRealTimeSearch() {
        filteredList = new FilteredList<>(productList, p -> true);

        searchBar.textProperty().addListener((observable, oldValue, newValue) -> {
            filteredList.setPredicate(product -> {
                if (newValue == null || newValue.isEmpty()) {
                    return true;
                }

                String lowerCaseFilter = newValue.toLowerCase();
                return product.getNom().toLowerCase().contains(lowerCaseFilter);
            });
            displayProducts(filteredList);
        });
    }

    @FXML
    public void handleAjouter() {
        if (!validateInput()) {
            return;
        }

        try {
            String nom = txtNom.getText();
            double prix = Double.parseDouble(txtPrix.getText());
            int stock = Integer.parseInt(txtStock.getText());
            String description = "";

            if (service.productExists(nom)) {
                showErrorAlert("Duplicate Product", "A product with the name '" + nom + "' already exists in the database.");
                return;
            }

            Parapharmacie parapharmacie = new Parapharmacie(nom, prix, stock, description);
            service.ajouter(parapharmacie);
            showInfoAlert("Success", "Product added successfully!");

            clearFields();
            loadProducts();

        } catch (NumberFormatException e) {
            showErrorAlert("Input Error", "Prix must be a decimal number and Stock must be an integer.");
        } catch (SQLException e) {
            showErrorAlert("Database Error", "Could not add product: " + e.getMessage());
        }
    }

    @FXML
    public void handleSupprimer() {
        // Since no table, perhaps remove this or implement differently
        showWarningAlert("Not Implemented", "Delete functionality is not available in card view. Use database directly.");
    }

    @FXML
    public void handleRefresh() {
        System.out.println("Refresh button clicked!");
        loadProducts();
        showInfoAlert("Refreshed", "Products reloaded from database!");
    }

    private boolean validateInput() {
        String nom = txtNom.getText();
        String prix = txtPrix.getText();
        String stock = txtStock.getText();

        if (nom.isEmpty() || prix.isEmpty() || stock.isEmpty()) {
            showWarningAlert("Validation Error", "All fields are required. Please fill in all fields.");
            return false;
        }

        try {
            Double.parseDouble(prix);
        } catch (NumberFormatException e) {
            showWarningAlert("Validation Error", "Prix must be a valid decimal number.");
            return false;
        }

        try {
            Integer.parseInt(stock);
        } catch (NumberFormatException e) {
            showWarningAlert("Validation Error", "Stock must be a valid integer.");
            return false;
        }

        return true;
    }

    private void clearFields() {
        txtNom.clear();
        txtPrix.clear();
        txtStock.clear();
    }

    private void showWarningAlert(String title, String content) {
        Alert alert = new Alert(Alert.AlertType.WARNING);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    private void showErrorAlert(String title, String content) {
        Alert alert = new Alert(Alert.AlertType.ERROR);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }

    private void showInfoAlert(String title, String content) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(content);
        alert.showAndWait();
    }
}
