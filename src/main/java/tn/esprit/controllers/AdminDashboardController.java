package tn.esprit.controllers;

import javafx.beans.property.SimpleIntegerProperty;
import javafx.beans.property.SimpleStringProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Modality;
import javafx.stage.Stage;
import tn.esprit.entities.User;
import tn.esprit.entities.UserDashboardStats;
import tn.esprit.services.UserService;
import tn.esprit.tools.SessionManager;
import tn.esprit.utils.AppNavigator;
import tn.esprit.utils.FormValidator;

import java.io.IOException;
import java.time.format.DateTimeFormatter;
import java.util.Optional;

public class AdminDashboardController {
    private static final DateTimeFormatter TS_FMT = DateTimeFormatter.ofPattern("dd/MM/yyyy HH:mm");

    @FXML private TableView<User>           usersTable;
    @FXML private TableColumn<User,Integer> idColumn;
    @FXML private TableColumn<User,String>  nameColumn;
    @FXML private TableColumn<User,String>  emailColumn;
    @FXML private TableColumn<User,String>  roleColumn;
    @FXML private TableColumn<User,String>  detailsColumn;
    @FXML private TextField                 searchField;
    @FXML private ComboBox<String>          roleFilterCombo;
    @FXML private ComboBox<String>          sortCombo;
    @FXML private Label                     welcomeLabel;
    @FXML private Label                     totalUsersLabel;
    @FXML private Label                     adminsCountLabel;
    @FXML private Label                     doctorsCountLabel;
    @FXML private Label                     patientsCountLabel;
    @FXML private Label                     tableInfoLabel;
    @FXML private Label                     profileFeedbackLabel;
    @FXML private TextField                 adminFirstNameField;
    @FXML private TextField                 adminLastNameField;
    @FXML private TextField                 adminEmailField;
    @FXML private PasswordField             adminPasswordField;
    @FXML private TextField                 adminAccountIdField;
    @FXML private TextField                 adminCreatedAtField;
    @FXML private StackPane                 mainContent;
    @FXML private VBox                      dashboardView;
    @FXML private VBox                      profileEditView;
    @FXML private Button                    navDashboard;
    @FXML private Button                    navAppointments;
    @FXML private Button                    navProfileEdit;
    @FXML private Button                    navBlog;
    @FXML private Button                    navProducts;
    @FXML private Button                    navDailyCheckIn;

    private final UserService userService = new UserService();
    private final ObservableList<User> usersList = FXCollections.observableArrayList();
    private User loggedInUser;

    @FXML
    public void initialize() {
        setupColumns();
        setupFilters();
        usersTable.setRowFactory(tv -> {
            TableRow<User> row = new TableRow<>();
            row.setOnMouseClicked(e -> { if (e.getClickCount() == 2 && !row.isEmpty()) openUserForm(row.getItem()); });
            return row;
        });
        if (profileFeedbackLabel != null)
            FormValidator.attachClearOnInput(profileFeedbackLabel, adminFirstNameField, adminLastNameField, adminEmailField, adminPasswordField);
        refresh();
    }

    public void setLoggedInUser(User user) {
        loggedInUser = user;
        if (welcomeLabel != null && user != null) welcomeLabel.setText("Administrator " + user.getFullName());
        populateProfile();
        refresh();
    }

    @FXML public void showDashboard()    { updateNav(navDashboard);    mainContent.getChildren().setAll(dashboardView); refresh(); }
    @FXML public void showProfileEdit()  { updateNav(navProfileEdit);  populateProfile(); FormValidator.setMessage(profileFeedbackLabel, "", true); mainContent.getChildren().setAll(profileEditView); }
    @FXML public void showBlogManagement()       { updateNav(navBlog);         loadView("/fxml/admin_layout.fxml"); }
    @FXML public void showAppointmentManagement(){ updateNav(navAppointments); loadViewWithUser("/fxml/appointment_list.fxml"); }
    @FXML public void showProductManagement()    { updateNav(navProducts);     loadViewWithUser("/fxml/product_admin.fxml"); }
    @FXML public void showDailyCheckIn()         { updateNav(navDailyCheckIn); loadViewWithUser("/fxml/daily_tracking.fxml"); }

    @FXML
    public void handleSaveProfile() {
        if (loggedInUser == null) return;
        FormValidator.clearStates(adminFirstNameField, adminLastNameField, adminEmailField);
        String fn = adminFirstNameField.getText().trim(), ln = adminLastNameField.getText().trim();
        String email = adminEmailField.getText().trim(), pwd = adminPasswordField.getText();
        if (fn.isEmpty())  { FormValidator.markInvalid(adminFirstNameField); FormValidator.setMessage(profileFeedbackLabel, "First name is required.", true); return; }
        if (ln.isEmpty())  { FormValidator.markInvalid(adminLastNameField);  FormValidator.setMessage(profileFeedbackLabel, "Last name is required.", true); return; }
        if (!FormValidator.isValidEmail(email)) { FormValidator.markInvalid(adminEmailField); FormValidator.setMessage(profileFeedbackLabel, "Enter a valid email.", true); return; }
        if (!pwd.isBlank() && pwd.length() < 8) { FormValidator.markInvalid(adminPasswordField); FormValidator.setMessage(profileFeedbackLabel, "Password must be at least 8 characters.", true); return; }
        loggedInUser.setFirstName(fn); loggedInUser.setLastName(ln);
        loggedInUser.setFullName((fn + " " + ln).trim()); loggedInUser.setEmail(email);
        if (!pwd.isBlank()) loggedInUser.setPassword(pwd);
        String err = userService.validateUser(loggedInUser, loggedInUser.getPassword(), true);
        if (err != null) { if (err.toLowerCase().contains("email")) FormValidator.markInvalid(adminEmailField); FormValidator.setMessage(profileFeedbackLabel, err, true); return; }
        if (userService.updateUser(loggedInUser)) {
            welcomeLabel.setText("Administrator " + loggedInUser.getFullName());
            FormValidator.setMessage(profileFeedbackLabel, "Profile updated successfully.", false);
        } else { FormValidator.setMessage(profileFeedbackLabel, "Failed to update profile.", true); }
    }

    @FXML public void handleResetProfile()  { populateProfile(); FormValidator.setMessage(profileFeedbackLabel, "", true); }
    @FXML public void handleAddUser()        { openUserForm(null); }
    @FXML public void handleRefreshUsers()   { refresh(); }

    @FXML
    public void handleEditUser() {
        User sel = usersTable.getSelectionModel().getSelectedItem();
        if (sel == null) { alert("Warning", "Select a user to edit.", Alert.AlertType.WARNING); return; }
        openUserForm(sel);
    }

    @FXML
    public void handleDeleteUser() {
        User sel = usersTable.getSelectionModel().getSelectedItem();
        if (sel == null) { alert("Warning", "Select a user to delete.", Alert.AlertType.WARNING); return; }
        if (loggedInUser != null && sel.getId() == loggedInUser.getId() && sel.getRole().equals(loggedInUser.getRole())) {
            alert("Warning", "You cannot delete the connected account.", Alert.AlertType.WARNING); return;
        }
        Alert c = new Alert(Alert.AlertType.CONFIRMATION, "Delete " + sel.getFullName() + "? This is permanent.", ButtonType.OK, ButtonType.CANCEL);
        c.setHeaderText(null);
        Optional<ButtonType> r = c.showAndWait();
        if (r.isPresent() && r.get() == ButtonType.OK) {
            if (userService.deleteUser(sel.getId(), sel.getRole())) { alert("Success", "User deleted.", Alert.AlertType.INFORMATION); refresh(); }
            else alert("Error", "Failed to delete user.", Alert.AlertType.ERROR);
        }
    }

    @FXML
    public void handleLogout() {
        try {
            SessionManager.logout();
            Scene scene = AppNavigator.createScene(new FXMLLoader(getClass().getResource("/fxml/login.fxml")).load(), getClass());
            AppNavigator.applyStage((Stage) mainContent.getScene().getWindow(), scene, "PinkShield Login");
        } catch (IOException e) { e.printStackTrace(); }
    }

    // ── Internals ─────────────────────────────────────────────

    private void setupColumns() {
        idColumn.setCellValueFactory(d -> new SimpleIntegerProperty(d.getValue().getId()).asObject());
        nameColumn.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getFullName()));
        emailColumn.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getEmail()));
        roleColumn.setCellValueFactory(d -> new SimpleStringProperty(d.getValue().getRole()));
        detailsColumn.setCellValueFactory(d -> new SimpleStringProperty(details(d.getValue())));
        roleColumn.setCellFactory(col -> new TableCell<>() {
            @Override protected void updateItem(String item, boolean empty) {
                super.updateItem(item, empty);
                getStyleClass().removeAll("role-admin","role-doctor","role-user");
                if (empty || item == null) { setText(null); return; }
                setText(item.toUpperCase()); getStyleClass().add("role-" + item.toLowerCase());
            }
        });
    }

    private void setupFilters() {
        if (roleFilterCombo != null) { roleFilterCombo.setItems(FXCollections.observableArrayList("all","admin","doctor","user")); roleFilterCombo.setValue("all"); roleFilterCombo.valueProperty().addListener((o,p,n) -> applyFilters()); }
        if (sortCombo != null)       { sortCombo.setItems(FXCollections.observableArrayList("name-asc","name-desc","email-asc","role-asc")); sortCombo.setValue("name-asc"); sortCombo.valueProperty().addListener((o,p,n) -> applyFilters()); }
        if (searchField != null) searchField.textProperty().addListener((o,p,n) -> applyFilters());
    }

    private void applyFilters() {
        usersList.setAll(userService.getUsers(
                searchField != null ? searchField.getText() : "",
                roleFilterCombo != null ? roleFilterCombo.getValue() : "all",
                sortCombo != null ? sortCombo.getValue() : "name-asc"));
        usersTable.setItems(usersList);
        if (tableInfoLabel != null) tableInfoLabel.setText(usersList.size() + " account(s) displayed");
    }

    private void refresh() { applyFilters(); updateStats(); }

    private void updateStats() {
        UserDashboardStats stats = userService.getDashboardStats();
        if (totalUsersLabel    != null) totalUsersLabel.setText(String.valueOf(stats.getTotalCount()));
        if (adminsCountLabel   != null) adminsCountLabel.setText(String.valueOf(stats.getAdminCount()));
        if (doctorsCountLabel  != null) doctorsCountLabel.setText(String.valueOf(stats.getDoctorCount()));
        if (patientsCountLabel != null) patientsCountLabel.setText(String.valueOf(stats.getPatientCount()));
    }

    private void populateProfile() {
        if (loggedInUser == null || adminFirstNameField == null) return;
        adminFirstNameField.setText(def(loggedInUser.getFirstName()));
        adminLastNameField.setText(def(loggedInUser.getLastName()));
        adminEmailField.setText(def(loggedInUser.getEmail()));
        adminPasswordField.clear();
        adminAccountIdField.setText(String.valueOf(loggedInUser.getId()));
        adminCreatedAtField.setText(loggedInUser.getCreatedAt() == null ? "" : loggedInUser.getCreatedAt().toLocalDateTime().format(TS_FMT));
    }

    private void openUserForm(User selected) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/user_form.fxml"));
            Parent root = loader.load();
            UserFormController ctrl = loader.getController();
            if (selected == null) ctrl.configureForCreate(); else ctrl.configureForEdit(selected);
            Stage stage = new Stage();
            stage.initOwner(mainContent.getScene().getWindow()); stage.initModality(Modality.WINDOW_MODAL);
            stage.setTitle(selected == null ? "Add user" : "Edit user");
            Scene scene = new Scene(root);
            scene.getStylesheets().add(getClass().getResource("/css/style.css").toExternalForm());
            stage.setScene(scene); stage.showAndWait();
            if (ctrl.isSaved()) refresh();
        } catch (IOException e) { alert("Error", "Unable to open user form.", Alert.AlertType.ERROR); }
    }

    private void loadView(String fxml) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxml));
            Parent view = loader.load();
            mainContent.getChildren().setAll(view);
        } catch (IOException e) { alert("Error", "Could not load view.", Alert.AlertType.ERROR); e.printStackTrace(); }
    }

    private void loadViewWithUser(String fxml) {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxml));
            Parent view = loader.load();
            Object ctrl = loader.getController();
            if (ctrl instanceof AppointmentListController c)          c.setCurrentUser(loggedInUser);
            else if (ctrl instanceof AppointmentCalendarController c) c.setCurrentUser(loggedInUser);
            else if (ctrl instanceof ProductListController c)         c.setCurrentUser(loggedInUser);
            else if (ctrl instanceof DailyTrackingController c)       c.setCurrentUser(loggedInUser);
            mainContent.getChildren().setAll(view);
        } catch (IOException e) { alert("Error", "Could not load view.", Alert.AlertType.ERROR); e.printStackTrace(); }
    }

    private void updateNav(Button active) {
        for (Button b : new Button[]{navDashboard, navAppointments, navProfileEdit, navBlog, navProducts, navDailyCheckIn})
            if (b != null) b.getStyleClass().remove("active");
        if (active != null) active.getStyleClass().add("active");
    }

    private String details(User u) {
        if (UserService.ROLE_DOCTOR.equals(u.getRole())) return u.getSpeciality() == null || u.getSpeciality().isBlank() ? "No speciality" : u.getSpeciality();
        if (UserService.ROLE_USER.equals(u.getRole()))   return def(u.getPhone(), "No phone") + " | " + def(u.getAddress(), "No address");
        return "System administrator";
    }
    private void alert(String title, String msg, Alert.AlertType t) { Alert a = new Alert(t, msg, ButtonType.OK); a.setTitle(title); a.setHeaderText(null); a.showAndWait(); }
    private String def(String v) { return v == null ? "" : v; }
    private String def(String v, String fallback) { return (v == null || v.isBlank()) ? fallback : v; }
}
