package tn.esprit.controllers;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ButtonType;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.TableCell;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.layout.FlowPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Priority;
import javafx.scene.layout.Region;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import tn.esprit.entities.Parapharmacy;
import tn.esprit.entities.User;
import tn.esprit.services.ParapharmacyService;
import tn.esprit.services.UserService;
import tn.esprit.services.WishlistService;
import tn.esprit.utils.FormValidator;

import java.io.IOException;
import java.util.Comparator;
import java.util.HashSet;
import java.util.List;
import java.util.Locale;
import java.util.Set;
import java.util.stream.Collectors;

public class ProductListController {
    @FXML private TextField searchField;
    @FXML private ComboBox<String> categoryFilter;
    @FXML private ComboBox<String> sortCombo;
    @FXML private FlowPane productsContainer;
    @FXML private Button manageProductsBtn;
    @FXML private Button wishlistBucketBtn;

    @FXML private Label adminTitle;
    @FXML private Label feedbackLabel;
    @FXML private TextField nameField;
    @FXML private TextArea descArea;
    @FXML private TextField priceField;
    @FXML private TextField stockField;
    @FXML private ComboBox<String> formCategoryCombo;
    @FXML private TableView<Parapharmacy> productTable;
    @FXML private TableColumn<Parapharmacy, Integer> idCol;
    @FXML private TableColumn<Parapharmacy, String> nameCol;
    @FXML private TableColumn<Parapharmacy, Double> priceCol;
    @FXML private TableColumn<Parapharmacy, Integer> stockCol;
    @FXML private TableColumn<Parapharmacy, String> categoryCol;
    @FXML private TableColumn<Parapharmacy, Void> actionsCol;

    private final ParapharmacyService productService = new ParapharmacyService();
    private final WishlistService wishlistService = new WishlistService();
    private final ObservableList<Parapharmacy> allProducts = FXCollections.observableArrayList();
    private final Set<Integer> wishlistedProductIds = new HashSet<>();
    private User currentUser;
    private Parapharmacy selectedProduct;

    @FXML
    public void initialize() {
        if (productsContainer != null) {
            setupShopFilters();
            loadShopData();
        }

        if (productTable != null) {
            setupAdminTable();
            setupAdminForm();
            loadAdminData();
            FormValidator.attachClearOnInput(feedbackLabel, nameField, priceField, stockField, formCategoryCombo);
            if (descArea != null) {
                descArea.textProperty().addListener((obs, oldValue, newValue) -> FormValidator.setMessage(feedbackLabel, "", true));
            }
        }
    }

    public void setCurrentUser(User user) {
        currentUser = user;
        if (manageProductsBtn != null) {
            boolean canManage = canManageProducts();
            manageProductsBtn.setVisible(canManage);
            manageProductsBtn.setManaged(canManage);
        }
        if (wishlistBucketBtn != null) {
            boolean isPatient = isWishlistEnabledForCurrentUser();
            wishlistBucketBtn.setVisible(isPatient);
            wishlistBucketBtn.setManaged(isPatient);
        }
        refreshWishlistState();
        if (productsContainer != null) {
            filterShop();
        }
    }

    @FXML
    public void handleManageProducts() {
        if (!canManageProducts()) {
            showAlert("Access denied", "Only doctors and administrators can manage products.", Alert.AlertType.WARNING);
            return;
        }
        loadSubView("/fxml/product_admin.fxml");
    }

    @FXML
    public void handleBackToShop() {
        loadSubView("/fxml/product_list.fxml");
    }

    @FXML
    public void handleOpenWishlist() {
        if (!isWishlistEnabledForCurrentUser()) {
            showAlert("Access denied", "Wishlist is available only for patient accounts.", Alert.AlertType.WARNING);
            return;
        }
        loadSubView("/fxml/wishlist.fxml");
    }

    @FXML
    public void handleClearForm() {
        selectedProduct = null;
        if (nameField != null) {
            nameField.clear();
        }
        if (descArea != null) {
            descArea.clear();
        }
        if (priceField != null) {
            priceField.clear();
        }
        if (stockField != null) {
            stockField.clear();
        }
        if (formCategoryCombo != null) {
            formCategoryCombo.setValue(null);
            if (formCategoryCombo.isEditable()) {
                formCategoryCombo.getEditor().clear();
            }
        }
        if (adminTitle != null) {
            adminTitle.setText("Product management");
        }
        FormValidator.setMessage(feedbackLabel, "", true);
        FormValidator.clearStates(nameField, priceField, stockField, formCategoryCombo);
    }

    @FXML
    public void handleSaveProduct() {
        if (!canManageProducts()) {
            showAlert("Access denied", "Only doctors and administrators can save products.", Alert.AlertType.WARNING);
            return;
        }

        FormValidator.clearStates(nameField, priceField, stockField, formCategoryCombo);

        String name = safeText(nameField);
        String description = safeText(descArea);
        String category = readCategoryInput();

        if (name.length() < 2) {
            FormValidator.markInvalid(nameField);
            FormValidator.setMessage(feedbackLabel, "Product name is required.", true);
            return;
        }
        if (description.isEmpty()) {
            FormValidator.setMessage(feedbackLabel, "Description is required.", true);
            return;
        }
        if (category.isEmpty()) {
            FormValidator.markInvalid(formCategoryCombo);
            FormValidator.setMessage(feedbackLabel, "Category is required.", true);
            return;
        }

        double price;
        int stock;
        try {
            price = Double.parseDouble(safeText(priceField));
        } catch (NumberFormatException e) {
            FormValidator.markInvalid(priceField);
            FormValidator.setMessage(feedbackLabel, "Price must be a valid number.", true);
            return;
        }

        try {
            stock = Integer.parseInt(safeText(stockField));
        } catch (NumberFormatException e) {
            FormValidator.markInvalid(stockField);
            FormValidator.setMessage(feedbackLabel, "Stock must be a whole number.", true);
            return;
        }

        if (price <= 0) {
            FormValidator.markInvalid(priceField);
            FormValidator.setMessage(feedbackLabel, "Price must be greater than 0.", true);
            return;
        }
        if (stock < 0) {
            FormValidator.markInvalid(stockField);
            FormValidator.setMessage(feedbackLabel, "Stock cannot be negative.", true);
            return;
        }

        Parapharmacy product = selectedProduct == null
                ? new Parapharmacy(name, description, price, stock, category, "")
                : selectedProduct;

        product.setName(name);
        product.setDescription(description);
        product.setPrice(price);
        product.setStock(stock);
        product.setCategory(category);

        Integer excludedId = selectedProduct == null ? null : selectedProduct.getId();
        if (productService.productExists(product, excludedId)) {
            FormValidator.markInvalid(nameField);
            FormValidator.markInvalid(formCategoryCombo);
            FormValidator.setMessage(feedbackLabel, "A product with the same name and category already exists.", true);
            return;
        }

        boolean success = selectedProduct == null
                ? productService.addProduct(product)
                : productService.updateProduct(product);

        if (success) {
            boolean creating = selectedProduct == null;
            loadAdminData();
            handleClearForm();
            FormValidator.setMessage(feedbackLabel, creating ? "Product added successfully." : "Product updated successfully.", false);
        } else {
            FormValidator.setMessage(feedbackLabel, "The product could not be saved.", true);
        }
    }

    private void setupShopFilters() {
        if (sortCombo != null) {
            sortCombo.setItems(FXCollections.observableArrayList("Name A-Z", "Name Z-A", "Price Low-High", "Price High-Low", "Stock High-Low"));
            sortCombo.setValue("Name A-Z");
        }

        if (searchField != null) {
            searchField.textProperty().addListener((obs, oldValue, newValue) -> filterShop());
        }
        if (categoryFilter != null) {
            categoryFilter.valueProperty().addListener((obs, oldValue, newValue) -> filterShop());
        }
        if (sortCombo != null) {
            sortCombo.valueProperty().addListener((obs, oldValue, newValue) -> filterShop());
        }
    }

    private void loadShopData() {
        allProducts.setAll(productService.getAllProducts());
        refreshWishlistState();
        refreshShopCategories();
        filterShop();
    }

    private void refreshShopCategories() {
        if (categoryFilter == null) {
            return;
        }

        List<String> categories = allProducts.stream()
                .map(Parapharmacy::getCategory)
                .filter(value -> value != null && !value.isBlank())
                .distinct()
                .sorted(String.CASE_INSENSITIVE_ORDER)
                .collect(Collectors.toList());

        ObservableList<String> items = FXCollections.observableArrayList();
        items.add("All");
        items.addAll(categories);
        categoryFilter.setItems(items);
        if (categoryFilter.getValue() == null || !items.contains(categoryFilter.getValue())) {
            categoryFilter.setValue("All");
        }
    }

    private void filterShop() {
        if (productsContainer == null) {
            return;
        }

        String query = safeText(searchField).toLowerCase(Locale.ROOT);
        String category = categoryFilter == null ? "All" : categoryFilter.getValue();
        String sortOption = sortCombo == null ? "Name A-Z" : sortCombo.getValue();

        List<Parapharmacy> filtered = allProducts.stream()
                .filter(product -> matchesSearch(product, query))
                .filter(product -> category == null || "All".equalsIgnoreCase(category)
                        || category.equalsIgnoreCase(product.getCategory()))
                .sorted(resolveShopComparator(sortOption))
                .collect(Collectors.toList());

        renderProductCards(filtered);
    }

    private boolean matchesSearch(Parapharmacy product, String query) {
        if (query.isEmpty()) {
            return true;
        }

        return safeValue(product.getName()).toLowerCase(Locale.ROOT).contains(query)
                || safeValue(product.getDescription()).toLowerCase(Locale.ROOT).contains(query)
                || safeValue(product.getCategory()).toLowerCase(Locale.ROOT).contains(query);
    }

    private Comparator<Parapharmacy> resolveShopComparator(String option) {
        if ("Name Z-A".equalsIgnoreCase(option)) {
            return Comparator.comparing((Parapharmacy product) -> safeValue(product.getName()), String.CASE_INSENSITIVE_ORDER).reversed();
        }
        if ("Price Low-High".equalsIgnoreCase(option)) {
            return Comparator.comparingDouble(Parapharmacy::getPrice);
        }
        if ("Price High-Low".equalsIgnoreCase(option)) {
            return Comparator.comparingDouble(Parapharmacy::getPrice).reversed();
        }
        if ("Stock High-Low".equalsIgnoreCase(option)) {
            return Comparator.comparingInt(Parapharmacy::getStock).reversed()
                    .thenComparing(product -> safeValue(product.getName()), String.CASE_INSENSITIVE_ORDER);
        }
        return Comparator.comparing(product -> safeValue(product.getName()), String.CASE_INSENSITIVE_ORDER);
    }

    private void renderProductCards(List<Parapharmacy> products) {
        productsContainer.getChildren().clear();
        for (Parapharmacy product : products) {
            productsContainer.getChildren().add(createProductCard(product));
        }
    }

    private VBox createProductCard(Parapharmacy product) {
        VBox card = new VBox(12);
        card.getStyleClass().add("post-card");
        card.setPrefWidth(250);
        card.setPadding(new javafx.geometry.Insets(18));

        HBox header = new HBox(8);
        Label category = new Label(safeValue(product.getCategory()).toUpperCase(Locale.ROOT));
        category.getStyleClass().add("auth-status-pill");

        Region spacer = new Region();
        HBox.setHgrow(spacer, Priority.ALWAYS);

        Label stockBadge = new Label(product.getStock() <= 0 ? "OUT" : product.getStock() < 5 ? "LOW" : "STOCK");
        stockBadge.getStyleClass().addAll(
                "stock-pill",
                product.getStock() <= 0 ? "stock-pill-out" : product.getStock() < 5 ? "stock-pill-low" : "stock-pill-available"
        );
        header.getChildren().addAll(category, spacer, stockBadge);

        Label name = new Label(safeValue(product.getName()));
        name.getStyleClass().add("card-title");
        name.setWrapText(true);

        Label description = new Label(safeValue(product.getDescription()));
        description.getStyleClass().add("dashboard-copy");
        description.setWrapText(true);
        description.setMaxHeight(84);

        Label price = new Label(String.format(Locale.ENGLISH, "%.2f TND", product.getPrice()));
        price.getStyleClass().add("metric-value");
        price.setStyle("-fx-font-size: 20;");

        Label stock = new Label(product.getStock() <= 0
                ? "Currently unavailable"
                : product.getStock() < 5 ? "Low stock: " + product.getStock() + " left" : "In stock: " + product.getStock());
        stock.getStyleClass().add("table-meta");

        Button detailsButton = new Button("View details");
        detailsButton.getStyleClass().addAll("button", "secondary");
        detailsButton.setMaxWidth(Double.MAX_VALUE);
        detailsButton.setOnAction(event -> showProductDetails(product));

        VBox actionsBox = new VBox(8);
        if (isWishlistEnabledForCurrentUser()) {
            Button wishlistButton = new Button(wishlistedProductIds.contains(product.getId()) ? "Saved to Wishlist" : "Add to Wishlist");
            wishlistButton.getStyleClass().addAll("button", "secondary");
            wishlistButton.setMaxWidth(Double.MAX_VALUE);
            wishlistButton.setDisable(wishlistedProductIds.contains(product.getId()));
            wishlistButton.setOnAction(event -> handleAddToWishlist(product));
            actionsBox.getChildren().add(wishlistButton);
        }
        actionsBox.getChildren().add(detailsButton);

        card.getChildren().addAll(header, name, description, price, stock, actionsBox);
        return card;
    }

    private void showProductDetails(Parapharmacy product) {
        Alert alert = new Alert(Alert.AlertType.INFORMATION);
        alert.setTitle(product.getName());
        alert.setHeaderText(product.getCategory());
        alert.setContentText(
                "Price: " + String.format(Locale.ENGLISH, "%.2f TND", product.getPrice()) + "\n"
                        + "Stock: " + product.getStock() + "\n\n"
                        + safeValue(product.getDescription())
        );
        alert.showAndWait();
    }

    private void setupAdminTable() {
        idCol.setCellValueFactory(cellData -> new javafx.beans.property.SimpleObjectProperty<>(cellData.getValue().getId()));
        nameCol.setCellValueFactory(cellData -> new javafx.beans.property.SimpleStringProperty(cellData.getValue().getName()));
        priceCol.setCellValueFactory(cellData -> new javafx.beans.property.SimpleObjectProperty<>(cellData.getValue().getPrice()));
        stockCol.setCellValueFactory(cellData -> new javafx.beans.property.SimpleObjectProperty<>(cellData.getValue().getStock()));
        categoryCol.setCellValueFactory(cellData -> new javafx.beans.property.SimpleStringProperty(cellData.getValue().getCategory()));

        priceCol.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(Double item, boolean empty) {
                super.updateItem(item, empty);
                setText(empty || item == null ? null : String.format(Locale.ENGLISH, "%.2f TND", item));
            }
        });

        actionsCol.setCellFactory(column -> new TableCell<>() {
            @Override
            protected void updateItem(Void item, boolean empty) {
                super.updateItem(item, empty);
                if (empty || getIndex() < 0 || getIndex() >= getTableView().getItems().size()) {
                    setGraphic(null);
                    return;
                }

                Parapharmacy product = getTableView().getItems().get(getIndex());

                Button editBtn = new Button("Edit");
                editBtn.getStyleClass().add("button");
                editBtn.setStyle("-fx-font-size: 10; -fx-padding: 6 10;");
                editBtn.setOnAction(e -> {
                    selectedProduct = product;
                    fillForm(product);
                });

                Button deleteBtn = new Button("Delete");
                deleteBtn.getStyleClass().addAll("button", "danger-button");
                deleteBtn.setStyle("-fx-font-size: 10; -fx-padding: 6 10;");
                deleteBtn.setOnAction(e -> handleDeleteProduct(product));

                setGraphic(new HBox(8, editBtn, deleteBtn));
            }
        });
    }

    private void loadAdminData() {
        allProducts.setAll(productService.getAllProducts());
        productTable.setItems(allProducts.sorted(Comparator.comparing(Parapharmacy::getName, String.CASE_INSENSITIVE_ORDER)));
        refreshAdminCategories();
    }

    private void setupAdminForm() {
        if (formCategoryCombo == null) {
            return;
        }
        formCategoryCombo.setEditable(true);
        refreshAdminCategories();
    }

    private void refreshAdminCategories() {
        if (formCategoryCombo == null) {
            return;
        }
        formCategoryCombo.setItems(FXCollections.observableArrayList(productService.getAvailableCategories()));
    }

    private void fillForm(Parapharmacy product) {
        nameField.setText(product.getName());
        descArea.setText(product.getDescription());
        priceField.setText(String.valueOf(product.getPrice()));
        stockField.setText(String.valueOf(product.getStock()));
        formCategoryCombo.setValue(product.getCategory());
        if (formCategoryCombo.isEditable()) {
            formCategoryCombo.getEditor().setText(product.getCategory());
        }
        adminTitle.setText("Edit product");
        FormValidator.setMessage(feedbackLabel, "Editing " + product.getName(), false);
    }

    private void handleDeleteProduct(Parapharmacy product) {
        if (!canManageProducts()) {
            showAlert("Access denied", "Only doctors and administrators can delete products.", Alert.AlertType.WARNING);
            return;
        }

        Alert alert = new Alert(Alert.AlertType.CONFIRMATION, "Delete " + product.getName() + "?", ButtonType.YES, ButtonType.NO);
        alert.showAndWait().ifPresent(type -> {
            if (type == ButtonType.YES && productService.deleteProduct(product.getId())) {
                loadAdminData();
                if (selectedProduct != null && selectedProduct.getId() == product.getId()) {
                    handleClearForm();
                }
            }
        });
    }

    private String readCategoryInput() {
        if (formCategoryCombo == null) {
            return "";
        }
        String editorText = formCategoryCombo.isEditable() ? safeText(formCategoryCombo.getEditor()) : "";
        if (!editorText.isBlank()) {
            return editorText;
        }
        return formCategoryCombo.getValue() == null ? "" : formCategoryCombo.getValue().trim();
    }

    private String safeText(TextField field) {
        return field == null || field.getText() == null ? "" : field.getText().trim();
    }

    private String safeText(TextArea area) {
        return area == null || area.getText() == null ? "" : area.getText().trim();
    }

    private String safeValue(String value) {
        return value == null ? "" : value;
    }

    private void handleAddToWishlist(Parapharmacy product) {
        if (!isWishlistEnabledForCurrentUser()) {
            showAlert("Access denied", "Wishlist is available only for patient accounts.", Alert.AlertType.WARNING);
            return;
        }
        if (!wishlistService.isAvailable()) {
            showAlert("Database error", "Wishlist storage is unavailable.", Alert.AlertType.ERROR);
            return;
        }
        if (!wishlistService.addItem(currentUser.getId(), product.getId())) {
            showAlert("Error", "The product could not be added to the wishlist.", Alert.AlertType.ERROR);
            return;
        }

        wishlistedProductIds.add(product.getId());
        updateWishlistBucketLabel();
        filterShop();
    }

    private void refreshWishlistState() {
        wishlistedProductIds.clear();
        if (isWishlistEnabledForCurrentUser() && wishlistService.isAvailable()) {
            wishlistedProductIds.addAll(wishlistService.getWishlistedProductIds(currentUser.getId()));
        }
        updateWishlistBucketLabel();
    }

    private void updateWishlistBucketLabel() {
        if (wishlistBucketBtn == null) {
            return;
        }
        wishlistBucketBtn.setText(isWishlistEnabledForCurrentUser()
                ? "Wishlist Bucket (" + wishlistedProductIds.size() + ")"
                : "Wishlist Bucket");
    }

    private boolean isWishlistEnabledForCurrentUser() {
        return currentUser != null && UserService.ROLE_USER.equals(currentUser.getRole());
    }

    private boolean canManageProducts() {
        return currentUser != null
                && (UserService.ROLE_ADMIN.equals(currentUser.getRole())
                || UserService.ROLE_DOCTOR.equals(currentUser.getRole()));
    }

    private void loadSubView(String fxmlPath) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlPath));
            Parent view = loader.load();

            Object controller = loader.getController();
            if (controller instanceof ProductListController productListController) {
                productListController.setCurrentUser(currentUser);
            } else if (controller instanceof WishlistController wishlistController) {
                wishlistController.setCurrentUser(currentUser);
            }

            StackPane mainContent = null;
            if (searchField != null && searchField.getScene() != null) {
                mainContent = (StackPane) searchField.getScene().lookup("#mainContent");
            } else if (adminTitle != null && adminTitle.getScene() != null) {
                mainContent = (StackPane) adminTitle.getScene().lookup("#mainContent");
            }

            if (mainContent != null) {
                mainContent.getChildren().setAll(view);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void showAlert(String title, String message, Alert.AlertType type) {
        Alert alert = new Alert(type);
        alert.setTitle(title);
        alert.setHeaderText(null);
        alert.setContentText(message);
        alert.showAndWait();
    }
}
