package tn.esprit.controllers;

import javafx.collections.FXCollections;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import tn.esprit.entities.User;
import tn.esprit.services.UserService;
import tn.esprit.utils.FormValidator;

public class UserFormController {
    @FXML private Label          formTitleLabel;
    @FXML private Label          feedbackLabel;
    @FXML private ComboBox<String> roleCombo;
    @FXML private VBox           staffFieldsBox;
    @FXML private VBox           patientFieldsBox;
    @FXML private VBox           specialityBox;
    @FXML private TextField      firstNameField;
    @FXML private TextField      lastNameField;
    @FXML private TextField      fullNameField;
    @FXML private TextField      emailField;
    @FXML private PasswordField  passwordField;
    @FXML private PasswordField  confirmPasswordField;
    @FXML private TextField      specialityField;
    @FXML private TextField      phoneField;
    @FXML private TextField      addressField;
    @FXML private Button         saveButton;

    private final UserService userService = new UserService();
    private boolean editMode;
    private boolean saved;
    private User    currentUser;

    @FXML
    public void initialize() {
        roleCombo.setItems(FXCollections.observableArrayList(UserService.ROLE_ADMIN, UserService.ROLE_DOCTOR, UserService.ROLE_USER));
        roleCombo.valueProperty().addListener((obs, o, n) -> updateRoleFields());
        FormValidator.attachClearOnInput(feedbackLabel, firstNameField, lastNameField, fullNameField,
                emailField, passwordField, confirmPasswordField, specialityField, phoneField, addressField);
    }

    public void configureForCreate() {
        editMode = false; currentUser = null; saved = false;
        if (formTitleLabel != null) formTitleLabel.setText("Create a new account");
        if (saveButton != null) saveButton.setText("Create account");
        clearFields(); roleCombo.setDisable(false); roleCombo.setValue(UserService.ROLE_USER); updateRoleFields();
    }

    public void configureForEdit(User user) {
        editMode = true; currentUser = user; saved = false;
        if (formTitleLabel != null) formTitleLabel.setText("Edit account");
        if (saveButton != null) saveButton.setText("Save changes");
        roleCombo.setValue(user.getRole()); roleCombo.setDisable(true);
        firstNameField.setText(v(user.getFirstName()));    lastNameField.setText(v(user.getLastName()));
        fullNameField.setText(v(user.getFullName()));      emailField.setText(v(user.getEmail()));
        passwordField.setText(v(user.getPassword()));      confirmPasswordField.setText(v(user.getPassword()));
        specialityField.setText(v(user.getSpeciality()));  phoneField.setText(v(user.getPhone()));
        addressField.setText(v(user.getAddress()));        updateRoleFields();
    }

    @FXML
    public void handleSave() {
        FormValidator.clearStates(roleCombo, firstNameField, lastNameField, fullNameField, emailField,
                passwordField, confirmPasswordField, specialityField, phoneField, addressField);
        String role = roleCombo.getValue();
        if (role == null || role.isBlank()) { FormValidator.markInvalid(roleCombo); FormValidator.setMessage(feedbackLabel, "Please select a role.", true); return; }
        String email = emailField.getText().trim(), pwd = passwordField.getText(), confirm = confirmPasswordField.getText();
        if (!FormValidator.isValidEmail(email)) { FormValidator.markInvalid(emailField); FormValidator.setMessage(feedbackLabel, "Enter a valid email address.", true); return; }
        if (pwd.length() < 8) { FormValidator.markInvalid(passwordField); FormValidator.setMessage(feedbackLabel, "Password must be at least 8 characters.", true); return; }
        if (!pwd.equals(confirm)) { FormValidator.markInvalid(confirmPasswordField); FormValidator.setMessage(feedbackLabel, "Password confirmation does not match.", true); return; }

        User u = editMode ? copy(currentUser) : new User();
        u.setRole(role); u.setEmail(email); u.setPassword(pwd);

        if (UserService.ROLE_USER.equals(role)) {
            String full = fullNameField.getText().trim(), phone = phoneField.getText().trim(), addr = addressField.getText().trim();
            if (full.length() < 3) { FormValidator.markInvalid(fullNameField); FormValidator.setMessage(feedbackLabel, "Full name must be at least 3 characters.", true); return; }
            if (!FormValidator.isValidPhone(phone)) { FormValidator.markInvalid(phoneField); FormValidator.setMessage(feedbackLabel, "Phone must contain 8–20 digits.", true); return; }
            if (addr.isEmpty()) { FormValidator.markInvalid(addressField); FormValidator.setMessage(feedbackLabel, "Address is required.", true); return; }
            u.setFullName(full); u.setPhone(phone); u.setAddress(addr); u.setFirstName(null); u.setLastName(null); u.setSpeciality(null);
        } else {
            String fn = firstNameField.getText().trim(), ln = lastNameField.getText().trim();
            if (fn.isEmpty()) { FormValidator.markInvalid(firstNameField); FormValidator.setMessage(feedbackLabel, "First name is required.", true); return; }
            if (ln.isEmpty()) { FormValidator.markInvalid(lastNameField);  FormValidator.setMessage(feedbackLabel, "Last name is required.", true); return; }
            u.setFirstName(fn); u.setLastName(ln); u.setFullName((fn+" "+ln).trim());
            u.setPhone(phoneField.getText().trim()); u.setAddress(addressField.getText().trim());
            if (UserService.ROLE_DOCTOR.equals(role)) {
                String spec = specialityField.getText().trim();
                if (spec.isEmpty()) { FormValidator.markInvalid(specialityField); FormValidator.setMessage(feedbackLabel, "Doctor speciality is required.", true); return; }
                u.setSpeciality(spec);
            } else u.setSpeciality(null);
        }
        String err = userService.validateUser(u, confirm, editMode);
        if (err != null) { FormValidator.setMessage(feedbackLabel, err, true); return; }
        boolean ok = editMode ? userService.updateUser(u) : userService.createUser(u);
        if (!ok) { FormValidator.setMessage(feedbackLabel, "The operation failed. Verify the data.", true); return; }
        saved = true; closeWindow();
    }

    @FXML public void handleCancel() { closeWindow(); }
    public boolean isSaved() { return saved; }

    private void updateRoleFields() {
        String role = roleCombo.getValue();
        boolean patient = UserService.ROLE_USER.equals(role), doctor = UserService.ROLE_DOCTOR.equals(role);
        staffFieldsBox.setManaged(!patient); staffFieldsBox.setVisible(!patient);
        patientFieldsBox.setManaged(patient); patientFieldsBox.setVisible(patient);
        specialityBox.setManaged(doctor); specialityBox.setVisible(doctor);
    }
    private void clearFields() { firstNameField.clear(); lastNameField.clear(); fullNameField.clear(); emailField.clear(); passwordField.clear(); confirmPasswordField.clear(); specialityField.clear(); phoneField.clear(); addressField.clear(); FormValidator.setMessage(feedbackLabel, "", true); }
    private User copy(User s) { User c = new User(); c.setId(s.getId()); c.setRole(s.getRole()); c.setFirstName(s.getFirstName()); c.setLastName(s.getLastName()); c.setFullName(s.getFullName()); c.setEmail(s.getEmail()); c.setPassword(s.getPassword()); c.setPhone(s.getPhone()); c.setAddress(s.getAddress()); c.setSpeciality(s.getSpeciality()); c.setFaceImagePath(s.getFaceImagePath()); c.setFaceToken(s.getFaceToken()); return c; }
    private void closeWindow() { ((Stage) saveButton.getScene().getWindow()).close(); }
    private String v(String s) { return s == null ? "" : s; }
}
