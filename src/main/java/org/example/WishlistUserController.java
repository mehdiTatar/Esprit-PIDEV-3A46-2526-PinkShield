package org.example;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.collections.transformation.FilteredList;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;

import java.sql.SQLException;
import java.util.ArrayList;

public class WishlistUserController {

    @FXML
    private TextField searchBar;
    @FXML
    private TableView<Wishlist> table;
    @FXML
    private TableColumn<Wishlist, Integer> colId;
    @FXML
    private TableColumn<Wishlist, String> colParapharmacieId;
    @FXML
    private TableColumn<Wishlist, String> colAddedAt;
    @FXML
    private TableColumn<Wishlist, String> colAction;

    private ServiceWishlist serviceWishlist;
    private ServiceParapharmacie serviceParapharmacie;
    private ObservableList<Wishlist> wishlistList;
    private FilteredList<Wishlist> filteredList;

    @FXML
    public void initialize() {
        serviceWishlist = new ServiceWishlist();
        serviceParapharmacie = new ServiceParapharmacie();

        initializeTableColumns();
        loadWishlist();
        setupRealTimeSearch();
    }

    private void initializeTableColumns() {
        colId.setCellValueFactory(new PropertyValueFactory<>("id"));

        // Show product name instead of ID
        colParapharmacieId.setCellValueFactory(cellData -> {
            int productId = cellData.getValue().getParapharmacie_id();
            String productName = getProductName(productId);
            return new javafx.beans.property.SimpleStringProperty(productName);
        });

        colAddedAt.setCellValueFactory(cellData -> {
            java.sql.Timestamp timestamp = cellData.getValue().getAdded_at();
            String formatted = timestamp != null ?
                timestamp.toLocalDateTime().toLocalDate().toString() : "N/A";
            return new javafx.beans.property.SimpleStringProperty(formatted);
        });

        // Action column with delete button
        colAction.setCellFactory(column -> new TableCell<Wishlist, String>() {
            private final Button deleteButton = new Button("🗑️");

            {
                deleteButton.setStyle("-fx-background-color: #ff6b6b; -fx-text-fill: white; -fx-font-size: 12; -fx-padding: 5 10;");
                deleteButton.setOnAction(event -> {
                    Wishlist item = getTableView().getItems().get(getIndex());
                    handleDelete(item);
                });
            }

            @Override
            protected void updateItem(String item, boolean empty) {
                super.updateItem(item, empty);
                if (empty) {
                    setGraphic(null);
                } else {
                    setGraphic(deleteButton);
                }
            }
        });
    }

    private String getProductName(int productId) {
        try {
            // This is a simplified approach - in a real app you'd have a product cache
            // For now, return the ID as string since we don't have product lookup
            return "Product #" + productId;
        } catch (Exception e) {
            return "Product #" + productId;
        }
    }

    private void loadWishlist() {
        try {
            // For demo purposes, load wishlist for user_id = 1
            ArrayList<Wishlist> wishlists = serviceWishlist.afficherAll();
            // Filter for user_id = 1 (demo user)
            wishlists.removeIf(w -> w.getUser_id() != 1);

            wishlistList = FXCollections.observableArrayList(wishlists);
            table.setItems(wishlistList);
        } catch (SQLException e) {
            System.out.println("Database connection error - showing empty wishlist: " + e.getMessage());
            wishlistList = FXCollections.observableArrayList();
            table.setItems(wishlistList);
        } catch (NullPointerException e) {
            System.out.println("Database not ready - showing empty wishlist: " + e.getMessage());
            wishlistList = FXCollections.observableArrayList();
            table.setItems(wishlistList);
        }
    }

    private void setupRealTimeSearch() {
        filteredList = new FilteredList<>(wishlistList, p -> true);

        searchBar.textProperty().addListener((observable, oldValue, newValue) -> {
            filteredList.setPredicate(wishlist -> {
                if (newValue == null || newValue.isEmpty()) {
                    return true;
                }

                String lowerCaseFilter = newValue.toLowerCase();
                String productName = getProductName(wishlist.getParapharmacie_id());
                String id = String.valueOf(wishlist.getId());

                return productName.toLowerCase().contains(lowerCaseFilter) ||
                       id.contains(lowerCaseFilter);
            });
        });

        table.setItems(filteredList);
    }

    @FXML
    public void handleSupprimer() {
        Wishlist selected = table.getSelectionModel().getSelectedItem();
        if (selected == null) {
            showWarningAlert("No Selection", "Please select a wishlist item to remove.");
            return;
        }

        handleDelete(selected);
    }

    private void handleDelete(Wishlist item) {
        Alert confirmation = new Alert(Alert.AlertType.CONFIRMATION);
        confirmation.setTitle("Remove Item");
        confirmation.setHeaderText("Remove from Wishlist");
        confirmation.setContentText("Are you sure you want to remove this item from your wishlist?");

        confirmation.showAndWait().ifPresent(response -> {
            if (response == ButtonType.OK) {
                try {
                    serviceWishlist.supprimer(item.getId());
                    showInfoAlert("Success", "Item removed from wishlist!");
                    loadWishlist();
                } catch (SQLException e) {
                    showErrorAlert("Database Error", "Could not remove item: " + e.getMessage());
                } catch (Exception e) {
                    showErrorAlert("Error", "Could not remove item: " + e.getMessage());
                }
            }
        });
    }

    @FXML
    public void handleRefresh() {
        loadWishlist();
        showInfoAlert("Refreshed", "Wishlist reloaded!");
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
