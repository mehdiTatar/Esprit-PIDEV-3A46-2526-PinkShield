package org.example;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Pos;
import javafx.scene.control.*;
import javafx.scene.layout.*;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;

import java.net.URL;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.ResourceBundle;

public class ParapharmacieUserController implements Initializable {

    @FXML private TextField searchBar;
    @FXML private FlowPane productFlowPane;

    private ServiceParapharmacie serviceParapharmacie;
    private ServiceWishlist serviceWishlist;
    private ArrayList<Parapharmacie> allProducts;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        serviceParapharmacie = new ServiceParapharmacie();
        serviceWishlist = new ServiceWishlist();
        allProducts = new ArrayList<>();

        searchBar.textProperty().addListener((observable, oldValue, newValue) -> {
            filterProducts(newValue);
        });

        loadProducts();
    }

    @FXML
    public void handleRefresh() {
        loadProducts();
    }

    private void loadProducts() {
        try {
            allProducts = serviceParapharmacie.afficherAll();
            displayProducts(allProducts);
        } catch (SQLException e) {
            System.err.println("Erreur Base : " + e.getMessage());
            showAlert("Erreur", "Impossible de charger les produits.");
        }
    }

    private void displayProducts(ArrayList<Parapharmacie> products) {
        productFlowPane.getChildren().clear();

        if (products == null || products.isEmpty()) {
            Label noProductsLabel = new Label("Aucun produit trouvé.");
            productFlowPane.getChildren().add(noProductsLabel);
            return;
        }

        for (Parapharmacie product : products) {
            productFlowPane.getChildren().add(createProductCard(product));
        }
    }

    private VBox createProductCard(Parapharmacie product) {
        VBox card = new VBox(10);
        card.setStyle("-fx-background-color: white; -fx-border-color: #e8e9f3; -fx-border-width: 1; -fx-border-radius: 12; -fx-background-radius: 12; -fx-padding: 20; -fx-effect: dropshadow(gaussian, rgba(232, 67, 147, 0.15), 10, 0, 0, 4);");
        card.setPrefWidth(280);
        card.setMinHeight(220);
        card.setAlignment(Pos.TOP_LEFT);

        Label nameLabel = new Label(product.getNom());
        nameLabel.setFont(Font.font("Segoe UI", FontWeight.BOLD, 18));
        nameLabel.setWrapText(true);

        Label priceLabel = new Label(String.format("%.2f DT", product.getPrix()));
        priceLabel.setFont(Font.font("Segoe UI", FontWeight.BOLD, 20));
        priceLabel.setTextFill(Color.web("#e84393"));

        Label stockLabel = new Label("Stock: " + product.getStock());
        stockLabel.setTextFill(product.getStock() > 0 ? Color.web("#27ae60") : Color.web("#e74c3c"));

        Label descLabel = new Label(product.getDescription());
        descLabel.setWrapText(true);
        descLabel.setMaxHeight(50);

        Region spacer = new Region();
        VBox.setVgrow(spacer, Priority.ALWAYS);

        Button wishlistBtn = new Button("Ajouter à la Wishlist");
        wishlistBtn.setStyle("-fx-background-color: #e84393; -fx-text-fill: white; -fx-font-weight: bold; -fx-padding: 10 20; -fx-background-radius: 25; -fx-cursor: hand;");
        wishlistBtn.setMaxWidth(Double.MAX_VALUE);
        wishlistBtn.setOnAction(e -> addToWishlist(product));

        card.getChildren().addAll(nameLabel, priceLabel, stockLabel, descLabel, spacer, wishlistBtn);
        return card;
    }

    private void addToWishlist(Parapharmacie product) {
        try {
            serviceWishlist.ajouter(new Wishlist(1, product.getId()));
            showAlert("Succès", "Ajouté à la wishlist !");
        } catch (SQLException e) {
            showAlert("Info", "Déjà dans la wishlist ou erreur.");
        }
    }

    private void filterProducts(String searchText) {
        if (searchText == null || searchText.isEmpty()) {
            displayProducts(allProducts);
            return;
        }
        ArrayList<Parapharmacie> filtered = new ArrayList<>();
        for (Parapharmacie p : allProducts) {
            if (p.getNom().toLowerCase().contains(searchText.toLowerCase())) filtered.add(p);
        }
        displayProducts(filtered);
    }

    private void showAlert(String title, String message) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}