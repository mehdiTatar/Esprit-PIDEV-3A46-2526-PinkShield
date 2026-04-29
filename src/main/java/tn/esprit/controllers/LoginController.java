package tn.esprit.controllers;

import javafx.animation.Animation;
import javafx.animation.FadeTransition;
import javafx.concurrent.Task;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.animation.Interpolator;
import javafx.animation.ParallelTransition;
import javafx.animation.ScaleTransition;
import javafx.animation.Timeline;
import javafx.animation.TranslateTransition;
import javafx.animation.KeyFrame;
import javafx.animation.KeyValue;
import javafx.beans.property.DoubleProperty;
import javafx.beans.property.SimpleDoubleProperty;
import javafx.concurrent.Task;
import javafx.scene.Node;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.Control;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.scene.layout.Pane;
import javafx.scene.layout.VBox;
import javafx.scene.shape.Circle;
import javafx.scene.shape.Polyline;
import javafx.scene.shape.SVGPath;
import javafx.stage.Stage;
import javafx.util.Duration;
import tn.esprit.entities.User;
import tn.esprit.services.AuthService;
import tn.esprit.utils.AppNavigator;
import tn.esprit.utils.FormValidator;
import tn.esprit.utils.WebcamCaptureDialog;

import java.io.IOException;
import java.nio.file.Path;
import java.util.Random;

public class LoginController {
    @FXML private TextField emailField;
    @FXML private PasswordField passwordField;
    @FXML private TextField visiblePasswordField;
    @FXML private Button togglePasswordButton;
    @FXML private Label feedbackLabel;
    @FXML private VBox loginContentPane;
    @FXML private VBox forgotPasswordContentPane;
    @FXML private VBox faceLoginContentPane;
    @FXML private Label forgotPasswordFeedbackLabel;
    @FXML private Label faceLoginFeedbackLabel;
    @FXML private TextField forgotPasswordEmailField;
    @FXML private TextField faceLoginEmailField;
    @FXML private TextField forgotPasswordCodeField;
    @FXML private PasswordField forgotPasswordField;
    @FXML private PasswordField forgotPasswordConfirmField;
    @FXML private Label faceLoginImageNameLabel;
    @FXML private Label faceLoginImageHelperLabel;
    @FXML private Button forgotPasswordSendCodeButton;
    @FXML private Button forgotPasswordSubmitButton;
    @FXML private Button faceLoginChooseImageButton;
    @FXML private Button faceLoginSubmitButton;
    @FXML private Pane loginBackgroundPane;
    @FXML private Pane loginHeroPane;
    @FXML private Circle orbitRingOuter;
    @FXML private Circle orbitRingDashed;
    @FXML private Circle orbitRingInner;
    @FXML private Circle orbitDotPrimaryTop;
    @FXML private Circle orbitDotSecondaryTop;
    @FXML private Circle orbitDotSecondaryBottom;
    @FXML private Circle orbitDotPrimaryBottom;
    @FXML private SVGPath loginHeartShape;
    @FXML private Polyline loginEkgLine;
    @FXML private Label pillTopLeft;
    @FXML private Label pillTopRight;
    @FXML private Label pillBottomLeft;
    @FXML private Label pillBottomRight;

    private final AuthService authService = new AuthService();
    private boolean passwordVisible;
    private Path selectedFaceLoginImagePath;

    private static final String ERROR_FEEDBACK_STYLE = """
            -fx-background-color: rgba(220,53,69,0.09);
            -fx-border-color: rgba(220,53,69,0.28);
            -fx-border-radius: 12;
            -fx-background-radius: 12;
            -fx-padding: 12 14;
            -fx-text-fill: #ff8d8d;
            -fx-font-size: 12;
            -fx-font-weight: 700;
            """;

    private static final String SUCCESS_FEEDBACK_STYLE = """
            -fx-background-color: rgba(16,185,129,0.10);
            -fx-border-color: rgba(16,185,129,0.24);
            -fx-border-radius: 12;
            -fx-background-radius: 12;
            -fx-padding: 12 14;
            -fx-text-fill: #7ee5be;
            -fx-font-size: 12;
            -fx-font-weight: 700;
            """;

    @FXML
    public void initialize() {
        visiblePasswordField.textProperty().bindBidirectional(passwordField.textProperty());
        FormValidator.attachClearOnInput(feedbackLabel, emailField, passwordField, visiblePasswordField);
        FormValidator.attachClearOnInput(
                forgotPasswordFeedbackLabel,
                forgotPasswordEmailField,
                forgotPasswordCodeField,
                forgotPasswordField,
                forgotPasswordConfirmField
        );
        FormValidator.attachClearOnInput(faceLoginFeedbackLabel, faceLoginEmailField);
        playHeroAnimations();
        showLoginContent();
    }

    public void handleLogin() {
        clearFeedback();

        String email = emailField.getText().trim();
        String password = passwordField.getText();

        if (email.isEmpty() || password.isEmpty()) {
            showInlineError("Email and password are required.");
            return;
        }

        if (!FormValidator.isValidEmail(email)) {
            showInlineError("Enter a valid email address.");
            return;
        }

        User user = authService.authenticate(email, password);
        if (user == null) {
            showInlineError("Invalid email or password.");
            return;
        }

        openDashboard(user);
    }

    public void handleRegister() {
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("/fxml/register.fxml"));
            var scene = AppNavigator.createScene(loader.load(), getClass());

            Stage stage = (Stage) emailField.getScene().getWindow();
            AppNavigator.applyStage(stage, scene, "PinkShield Register");
        } catch (IOException e) {
            showAlert("Error", "Failed to load register page.", Alert.AlertType.ERROR);
            e.printStackTrace();
        }
    }

    public void handleShowForgotPassword() {
        clearFeedback();
        clearForgotPasswordFeedback();
        clearFaceLoginFeedback();

        forgotPasswordEmailField.setText(emailField.getText().trim());
        forgotPasswordCodeField.clear();
        forgotPasswordField.clear();
        forgotPasswordConfirmField.clear();
        forgotPasswordSendCodeButton.setDisable(false);
        forgotPasswordSendCodeButton.setText("Send Verification Code");
        forgotPasswordSubmitButton.setDisable(true);
        resetFaceLoginSelection();

        loginContentPane.setManaged(false);
        loginContentPane.setVisible(false);
        forgotPasswordContentPane.setManaged(true);
        forgotPasswordContentPane.setVisible(true);
        faceLoginContentPane.setManaged(false);
        faceLoginContentPane.setVisible(false);
    }

    public void handleShowFaceLogin() {
        clearFeedback();
        clearForgotPasswordFeedback();
        clearFaceLoginFeedback();

        faceLoginEmailField.setText(emailField.getText().trim());
        resetFaceLoginSelection();

        loginContentPane.setManaged(false);
        loginContentPane.setVisible(false);
        forgotPasswordContentPane.setManaged(false);
        forgotPasswordContentPane.setVisible(false);
        faceLoginContentPane.setManaged(true);
        faceLoginContentPane.setVisible(true);
    }

    public void handleBackToLogin() {
        showLoginContent();
    }

    public void handleCaptureFaceLoginImage() {
        Stage stage = (Stage) faceLoginChooseImageButton.getScene().getWindow();
        Path capturedImagePath = WebcamCaptureDialog.captureFaceImage(
                stage,
                getClass(),
                "Face Sign-In",
                "Open the front camera, center your face, and capture a fresh sign-in image."
        );
        if (capturedImagePath == null) {
            return;
        }

        selectedFaceLoginImagePath = capturedImagePath;
        faceLoginImageNameLabel.setText(capturedImagePath.getFileName().toString());
        faceLoginImageHelperLabel.setText("Front-camera image captured. Face++ will compare it with the enrolled face.");
    }

    public void handleFaceLogin() {
        clearFaceLoginFeedback();
        FormValidator.clearStates(faceLoginEmailField);

        String email = faceLoginEmailField.getText().trim();
        if (email.isEmpty()) {
            showFaceLoginError("Email is required.");
            FormValidator.markInvalid(faceLoginEmailField);
            return;
        }
        if (!FormValidator.isValidEmail(email)) {
            showFaceLoginError("Enter a valid email address.");
            FormValidator.markInvalid(faceLoginEmailField);
            return;
        }
        if (selectedFaceLoginImagePath == null) {
            showFaceLoginError("Capture a face image before continuing.");
            return;
        }

        faceLoginChooseImageButton.setDisable(true);
        faceLoginSubmitButton.setDisable(true);
        faceLoginSubmitButton.setText("Verifying...");

        Path livePhotoPath = selectedFaceLoginImagePath;
        Task<AuthService.FaceAuthenticationResult> faceLoginTask = new Task<>() {
            @Override
            protected AuthService.FaceAuthenticationResult call() {
                return authService.authenticateWithFace(email, livePhotoPath);
            }
        };

        faceLoginTask.setOnSucceeded(event -> {
            faceLoginChooseImageButton.setDisable(false);
            faceLoginSubmitButton.setDisable(false);
            faceLoginSubmitButton.setText("Verify Face and Enter");

            AuthService.FaceAuthenticationResult result = faceLoginTask.getValue();
            if (!result.success()) {
                showFaceLoginError(result.message());
                FormValidator.markInvalid(faceLoginEmailField);
                return;
            }

            showFaceLoginFeedback(result.message(), false);
            openDashboard(result.user());
        });

        faceLoginTask.setOnFailed(event -> {
            faceLoginChooseImageButton.setDisable(false);
            faceLoginSubmitButton.setDisable(false);
            faceLoginSubmitButton.setText("Verify Face and Enter");
            Throwable error = faceLoginTask.getException();
            showFaceLoginError(error == null ? "Face login failed." : error.getMessage());
        });

        Thread backgroundThread = new Thread(faceLoginTask, "face-login-verify");
        backgroundThread.setDaemon(true);
        backgroundThread.start();
    }

    public void handleSendResetCode() {
        clearForgotPasswordFeedback();
        FormValidator.clearStates(forgotPasswordEmailField, forgotPasswordCodeField, forgotPasswordField, forgotPasswordConfirmField);

        String email = forgotPasswordEmailField.getText().trim();
        if (email.isEmpty()) {
            showForgotPasswordError("Email is required.", forgotPasswordEmailField);
            return;
        }

        if (!FormValidator.isValidEmail(email)) {
            showForgotPasswordError("Enter a valid email address.", forgotPasswordEmailField);
            return;
        }

        forgotPasswordSendCodeButton.setDisable(true);
        forgotPasswordSubmitButton.setDisable(true);
        forgotPasswordSendCodeButton.setText("Sending...");

        Task<String> sendCodeTask = new Task<>() {
            @Override
            protected String call() {
                return authService.sendPasswordResetCode(email);
            }
        };

        sendCodeTask.setOnSucceeded(event -> {
            forgotPasswordSendCodeButton.setDisable(false);

            String error = sendCodeTask.getValue();
            if (error != null) {
                forgotPasswordSendCodeButton.setText("Send Verification Code");
                showForgotPasswordError(error, forgotPasswordEmailField);
                return;
            }

            forgotPasswordSendCodeButton.setText("Resend Verification Code");
            forgotPasswordSubmitButton.setDisable(false);
            showForgotPasswordFeedback(
                    "Verification code sent to " + email + ". It expires in 10 minutes.",
                    false
            );
            forgotPasswordCodeField.requestFocus();
        });

        sendCodeTask.setOnFailed(event -> {
            forgotPasswordSendCodeButton.setDisable(false);
            forgotPasswordSendCodeButton.setText("Send Verification Code");
            Throwable error = sendCodeTask.getException();
            showForgotPasswordError(
                    error == null ? "Failed to send the verification code." : error.getMessage(),
                    forgotPasswordEmailField
            );
        });

        Thread backgroundThread = new Thread(sendCodeTask, "password-reset-email");
        backgroundThread.setDaemon(true);
        backgroundThread.start();
    }

    public void handleResetPassword() {
        clearForgotPasswordFeedback();
        FormValidator.clearStates(forgotPasswordEmailField, forgotPasswordCodeField, forgotPasswordField, forgotPasswordConfirmField);

        String email = forgotPasswordEmailField.getText().trim();
        String verificationCode = forgotPasswordCodeField.getText().trim();
        String newPassword = forgotPasswordField.getText();
        String confirmPassword = forgotPasswordConfirmField.getText();

        if (email.isEmpty() || verificationCode.isEmpty() || newPassword.isEmpty() || confirmPassword.isEmpty()) {
            showForgotPasswordError(
                    "Email, verification code, new password, and confirmation are required.",
                    forgotPasswordEmailField,
                    forgotPasswordCodeField,
                    forgotPasswordField,
                    forgotPasswordConfirmField
            );
            return;
        }

        if (!FormValidator.isValidEmail(email)) {
            showForgotPasswordError("Enter a valid email address.", forgotPasswordEmailField);
            return;
        }

        if (verificationCode.length() != 6 || !verificationCode.chars().allMatch(Character::isDigit)) {
            showForgotPasswordError("Verification code must contain exactly 6 digits.", forgotPasswordCodeField);
            return;
        }

        if (newPassword.length() < 8) {
            showForgotPasswordError("Password must contain at least 8 characters.", forgotPasswordField);
            return;
        }

        if (!newPassword.equals(confirmPassword)) {
            showForgotPasswordError(
                    "Password confirmation does not match.",
                    forgotPasswordField,
                    forgotPasswordConfirmField
            );
            return;
        }

        String resetError = authService.resetPasswordWithCode(email, verificationCode, newPassword);
        if (resetError != null) {
            showForgotPasswordError(resetError, forgotPasswordCodeField);
            return;
        }

        emailField.setText(email);
        passwordField.clear();
        visiblePasswordField.clear();
        forgotPasswordCodeField.clear();
        forgotPasswordField.clear();
        forgotPasswordConfirmField.clear();
        forgotPasswordSendCodeButton.setText("Send Verification Code");
        forgotPasswordSubmitButton.setDisable(true);

        showLoginContent();
        showLoginFeedback("Password updated. Sign in with your new password.", false);
        passwordField.requestFocus();
    }

    public void handleTogglePassword() {
        passwordVisible = !passwordVisible;
        visiblePasswordField.setManaged(passwordVisible);
        visiblePasswordField.setVisible(passwordVisible);
        passwordField.setManaged(!passwordVisible);
        passwordField.setVisible(!passwordVisible);
        togglePasswordButton.setText(passwordVisible ? "Hide" : "Show");
    }

    private void showInlineError(String message) {
        FormValidator.markInvalid(emailField);
        FormValidator.markInvalid(passwordVisible ? visiblePasswordField : passwordField);
        showLoginFeedback(message, true);
    }

    private void clearFeedback() {
        FormValidator.clearStates(emailField, passwordField, visiblePasswordField);
        hideFeedback(feedbackLabel);
    }

    private void showForgotPasswordError(String message, Control... fields) {
        for (Control field : fields) {
            FormValidator.markInvalid(field);
        }
        showForgotPasswordFeedback(message, true);
    }

    private void clearForgotPasswordFeedback() {
        FormValidator.clearStates(forgotPasswordEmailField, forgotPasswordCodeField, forgotPasswordField, forgotPasswordConfirmField);
        hideFeedback(forgotPasswordFeedbackLabel);
    }

    private void showFaceLoginError(String message) {
        showFaceLoginFeedback(message, true);
    }

    private void clearFaceLoginFeedback() {
        FormValidator.clearStates(faceLoginEmailField);
        hideFeedback(faceLoginFeedbackLabel);
    }

    private void showLoginFeedback(String message, boolean isError) {
        showFeedback(feedbackLabel, message, isError);
    }

    private void showForgotPasswordFeedback(String message, boolean isError) {
        showFeedback(forgotPasswordFeedbackLabel, message, isError);
    }

    private void showFaceLoginFeedback(String message, boolean isError) {
        showFeedback(faceLoginFeedbackLabel, message, isError);
    }

    private void showFeedback(Label label, String message, boolean isError) {
        if (label == null) {
            return;
        }

        boolean hasMessage = message != null && !message.isBlank();
        label.setText(message);
        label.setManaged(hasMessage);
        label.setVisible(hasMessage);
        label.setStyle(isError ? ERROR_FEEDBACK_STYLE : SUCCESS_FEEDBACK_STYLE);
    }

    private void hideFeedback(Label label) {
        if (label == null) {
            return;
        }

        label.setText("");
        label.setManaged(false);
        label.setVisible(false);
        label.setStyle("");
    }

    private void showLoginContent() {
        if (loginContentPane == null || forgotPasswordContentPane == null || faceLoginContentPane == null) {
            return;
        }

        passwordVisible = false;
        visiblePasswordField.setManaged(false);
        visiblePasswordField.setVisible(false);
        passwordField.setManaged(true);
        passwordField.setVisible(true);
        togglePasswordButton.setText("Show");
        forgotPasswordSendCodeButton.setDisable(false);
        forgotPasswordSendCodeButton.setText("Send Verification Code");
        forgotPasswordSubmitButton.setDisable(true);
        faceLoginChooseImageButton.setDisable(false);
        faceLoginSubmitButton.setDisable(false);
        faceLoginSubmitButton.setText("Verify Face and Enter");

        clearForgotPasswordFeedback();
        clearFaceLoginFeedback();
        resetFaceLoginSelection();

        loginContentPane.setManaged(true);
        loginContentPane.setVisible(true);
        forgotPasswordContentPane.setManaged(false);
        forgotPasswordContentPane.setVisible(false);
        faceLoginContentPane.setManaged(false);
        faceLoginContentPane.setVisible(false);
    }

    private void resetFaceLoginSelection() {
        selectedFaceLoginImagePath = null;
        if (faceLoginImageNameLabel != null) {
            faceLoginImageNameLabel.setText("No live front-camera image captured");
        }
        if (faceLoginImageHelperLabel != null) {
            faceLoginImageHelperLabel.setText("Open the front camera to capture a live image for comparison.");
        }
    }

    private void openDashboard(User user) {
        if (user == null) {
            showLoginFeedback("Unable to open the dashboard for this account.", true);
            return;
        }

        String fxmlFile = switch (user.getRole()) {
            case "admin" -> "/fxml/admin_dashboard.fxml";
            case "doctor" -> "/fxml/doctor_dashboard.fxml";
            case "user" -> "/fxml/user_dashboard.fxml";
            default -> "";
        };

        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxmlFile));
            var scene = AppNavigator.createScene(loader.load(), getClass());

            if ("admin".equals(user.getRole())) {
                AdminDashboardController controller = loader.getController();
                controller.setLoggedInUser(user);
            } else if ("doctor".equals(user.getRole())) {
                DoctorDashboardController controller = loader.getController();
                controller.setLoggedInUser(user);
            } else if ("user".equals(user.getRole())) {
                UserDashboardController controller = loader.getController();
                controller.setLoggedInUser(user);
            }

            Stage stage = (Stage) emailField.getScene().getWindow();
            AppNavigator.applyStage(stage, scene, "PinkShield Dashboard");
        } catch (IOException e) {
            showAlert("Error", "Failed to load dashboard.", Alert.AlertType.ERROR);
            e.printStackTrace();
        }
    }

    private void playHeroAnimations() {
        if (loginHeroPane == null) {
            return;
        }

        TranslateTransition heroFloat = new TranslateTransition(Duration.seconds(5.8), loginHeroPane);
        heroFloat.setFromY(0);
        heroFloat.setToY(-10);
        heroFloat.setAutoReverse(true);
        heroFloat.setCycleCount(Animation.INDEFINITE);
        heroFloat.setInterpolator(Interpolator.EASE_BOTH);
        heroFloat.play();

        animateOrbitalNode(orbitDotPrimaryTop, 256, 186, 178, 208, 8.8);
        animateOrbitalNode(orbitDotSecondaryTop, 256, 186, 218, 342, 12.5);
        animateOrbitalNode(orbitDotSecondaryBottom, 256, 186, 218, 148, 11.2);
        animateOrbitalNode(orbitDotPrimaryBottom, 256, 186, 178, 28, 9.6);

        Timeline dashedRingMotion = new Timeline(
                new KeyFrame(Duration.ZERO, new KeyValue(orbitRingDashed.strokeDashOffsetProperty(), 0)),
                new KeyFrame(Duration.seconds(14), new KeyValue(orbitRingDashed.strokeDashOffsetProperty(), 140, Interpolator.LINEAR))
        );
        dashedRingMotion.setCycleCount(Animation.INDEFINITE);
        dashedRingMotion.play();

        animateRingPulse(orbitRingOuter, 4.8, 0.985, 1.025);
        animateRingPulse(orbitRingInner, 3.6, 0.99, 1.03);
        animateHeartPulse();
        animateEkgPulse();

        animateFloatingPill(pillTopLeft, -12, -4, 4.6);
        animateFloatingPill(pillTopRight, 10, 6, 5.4);
        animateFloatingPill(pillBottomLeft, -8, 8, 5.0);
        animateFloatingPill(pillBottomRight, 12, -6, 6.0);
        animateStarDots();
    }

    private void animateOrbitalNode(Node node, double centerX, double centerY, double radius, double startAngle, double durationSeconds) {
        if (node == null) {
            return;
        }

        DoubleProperty angle = new SimpleDoubleProperty(startAngle);
        angle.addListener((obs, oldValue, newValue) -> {
            double radians = Math.toRadians(newValue.doubleValue());
            node.setLayoutX(centerX + Math.cos(radians) * radius);
            node.setLayoutY(centerY + Math.sin(radians) * radius);
        });

        Timeline orbitTimeline = new Timeline(
                new KeyFrame(Duration.ZERO, new KeyValue(angle, startAngle)),
                new KeyFrame(Duration.seconds(durationSeconds), new KeyValue(angle, startAngle + 360, Interpolator.LINEAR))
        );
        orbitTimeline.setCycleCount(Animation.INDEFINITE);
        orbitTimeline.play();
    }

    private void animateRingPulse(Node ring, double durationSeconds, double fromScale, double toScale) {
        if (ring == null) {
            return;
        }

        ScaleTransition scale = new ScaleTransition(Duration.seconds(durationSeconds), ring);
        scale.setFromX(fromScale);
        scale.setFromY(fromScale);
        scale.setToX(toScale);
        scale.setToY(toScale);
        scale.setAutoReverse(true);
        scale.setCycleCount(Animation.INDEFINITE);
        scale.setInterpolator(Interpolator.EASE_BOTH);

        FadeTransition fade = new FadeTransition(Duration.seconds(durationSeconds), ring);
        fade.setFromValue(0.36);
        fade.setToValue(0.68);
        fade.setAutoReverse(true);
        fade.setCycleCount(Animation.INDEFINITE);
        fade.setInterpolator(Interpolator.EASE_BOTH);

        new ParallelTransition(scale, fade).play();
    }

    private void animateHeartPulse() {
        if (loginHeartShape == null) {
            return;
        }

        ScaleTransition pulse = new ScaleTransition(Duration.seconds(1.25), loginHeartShape);
        pulse.setFromX(1.0);
        pulse.setFromY(1.0);
        pulse.setToX(1.08);
        pulse.setToY(1.08);
        pulse.setAutoReverse(true);
        pulse.setCycleCount(Animation.INDEFINITE);
        pulse.setInterpolator(Interpolator.EASE_BOTH);
        pulse.play();
    }

    private void animateEkgPulse() {
        if (loginEkgLine == null) {
            return;
        }

        loginEkgLine.getStrokeDashArray().setAll(420.0, 60.0);

        Timeline dashMotion = new Timeline(
                new KeyFrame(Duration.ZERO, new KeyValue(loginEkgLine.strokeDashOffsetProperty(), 480)),
                new KeyFrame(Duration.seconds(2.2), new KeyValue(loginEkgLine.strokeDashOffsetProperty(), 0, Interpolator.LINEAR))
        );
        dashMotion.setCycleCount(Animation.INDEFINITE);

        FadeTransition fade = new FadeTransition(Duration.seconds(1.1), loginEkgLine);
        fade.setFromValue(0.45);
        fade.setToValue(1.0);
        fade.setAutoReverse(true);
        fade.setCycleCount(Animation.INDEFINITE);
        fade.setInterpolator(Interpolator.EASE_BOTH);

        ScaleTransition scale = new ScaleTransition(Duration.seconds(1.1), loginEkgLine);
        scale.setFromY(0.96);
        scale.setToY(1.04);
        scale.setAutoReverse(true);
        scale.setCycleCount(Animation.INDEFINITE);
        scale.setInterpolator(Interpolator.EASE_BOTH);

        dashMotion.play();
        fade.play();
        scale.play();
    }

    private void animateFloatingPill(Node node, double toX, double toY, double durationSeconds) {
        if (node == null) {
            return;
        }

        TranslateTransition drift = new TranslateTransition(Duration.seconds(durationSeconds), node);
        drift.setFromX(0);
        drift.setFromY(0);
        drift.setToX(toX);
        drift.setToY(toY);
        drift.setAutoReverse(true);
        drift.setCycleCount(Animation.INDEFINITE);
        drift.setInterpolator(Interpolator.EASE_BOTH);

        FadeTransition glow = new FadeTransition(Duration.seconds(durationSeconds), node);
        glow.setFromValue(0.64);
        glow.setToValue(1.0);
        glow.setAutoReverse(true);
        glow.setCycleCount(Animation.INDEFINITE);
        glow.setInterpolator(Interpolator.EASE_BOTH);

        new ParallelTransition(drift, glow).play();
    }

    private void animateStarDots() {
        if (loginBackgroundPane == null) {
            return;
        }

        Random random = new Random(7);
        for (Node node : loginBackgroundPane.getChildren()) {
            if (!node.getStyleClass().contains("star-dot")) {
                continue;
            }

            FadeTransition twinkle = new FadeTransition(Duration.seconds(1.8 + random.nextDouble() * 2.2), node);
            twinkle.setFromValue(0.18 + random.nextDouble() * 0.22);
            twinkle.setToValue(0.9);
            twinkle.setAutoReverse(true);
            twinkle.setCycleCount(Animation.INDEFINITE);
            twinkle.setDelay(Duration.seconds(random.nextDouble() * 2.6));

            ScaleTransition scale = new ScaleTransition(Duration.seconds(1.8 + random.nextDouble() * 2.4), node);
            scale.setFromX(0.72);
            scale.setFromY(0.72);
            scale.setToX(1.25);
            scale.setToY(1.25);
            scale.setAutoReverse(true);
            scale.setCycleCount(Animation.INDEFINITE);
            scale.setDelay(Duration.seconds(random.nextDouble() * 2.0));

            new ParallelTransition(twinkle, scale).play();
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
