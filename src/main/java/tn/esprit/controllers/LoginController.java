package tn.esprit.controllers;

import javafx.animation.*;
import javafx.beans.property.*;
import javafx.concurrent.Task;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.control.*;
import javafx.scene.layout.Pane;
import javafx.scene.layout.VBox;
import javafx.scene.shape.*;
import javafx.scene.web.WebView;
import javafx.stage.Stage;
import javafx.util.Duration;
import tn.esprit.entities.User;
import tn.esprit.services.AuthService;
import tn.esprit.tools.SessionManager;
import tn.esprit.utils.AppNavigator;
import tn.esprit.utils.FormValidator;
import tn.esprit.utils.RecaptchaWidget;
import tn.esprit.utils.WebcamCaptureDialog;

import java.io.IOException;
import java.nio.file.Path;
import java.util.Random;

public class LoginController {
    @FXML private TextField      emailField;
    @FXML private PasswordField  passwordField;
    @FXML private TextField      visiblePasswordField;
    @FXML private Button         togglePasswordButton;
    @FXML private Button         loginButton;
    @FXML private Label          feedbackLabel;
    @FXML private Label          recaptchaStatusLabel;
    @FXML private VBox           loginContentPane;
    @FXML private VBox           forgotPasswordContentPane;
    @FXML private VBox           faceLoginContentPane;
    @FXML private Label          forgotPasswordFeedbackLabel;
    @FXML private Label          faceLoginFeedbackLabel;
    @FXML private TextField      forgotPasswordEmailField;
    @FXML private TextField      faceLoginEmailField;
    @FXML private TextField      forgotPasswordCodeField;
    @FXML private PasswordField  forgotPasswordField;
    @FXML private PasswordField  forgotPasswordConfirmField;
    @FXML private Label          faceLoginImageNameLabel;
    @FXML private Label          faceLoginImageHelperLabel;
    @FXML private Button         forgotPasswordSendCodeButton;
    @FXML private Button         forgotPasswordSubmitButton;
    @FXML private Button         faceLoginChooseImageButton;
    @FXML private Button         faceLoginSubmitButton;
    @FXML private Pane           loginBackgroundPane;
    @FXML private Pane           loginHeroPane;
    @FXML private Circle         orbitRingOuter;
    @FXML private Circle         orbitRingDashed;
    @FXML private Circle         orbitRingInner;
    @FXML private Circle         orbitDotPrimaryTop;
    @FXML private Circle         orbitDotSecondaryTop;
    @FXML private Circle         orbitDotSecondaryBottom;
    @FXML private Circle         orbitDotPrimaryBottom;
    @FXML private SVGPath        loginHeartShape;
    @FXML private Polyline       loginEkgLine;
    @FXML private Label          pillTopLeft;
    @FXML private Label          pillTopRight;
    @FXML private Label          pillBottomLeft;
    @FXML private Label          pillBottomRight;
    @FXML private WebView        recaptchaWebView;

    private final AuthService      authService      = new AuthService();
    private final RecaptchaWidget  recaptchaWidget  = new RecaptchaWidget();
    private boolean passwordVisible;
    private Path    selectedFaceImagePath;

    private static final String ERR_STYLE = """
            -fx-background-color: rgba(220,53,69,0.09); -fx-border-color: rgba(220,53,69,0.28);
            -fx-border-radius: 12; -fx-background-radius: 12; -fx-padding: 12 14;
            -fx-text-fill: #ff8d8d; -fx-font-size: 12; -fx-font-weight: 700;""";
    private static final String OK_STYLE = """
            -fx-background-color: rgba(16,185,129,0.10); -fx-border-color: rgba(16,185,129,0.24);
            -fx-border-radius: 12; -fx-background-radius: 12; -fx-padding: 12 14;
            -fx-text-fill: #7ee5be; -fx-font-size: 12; -fx-font-weight: 700;""";

    @FXML
    public void initialize() {
        visiblePasswordField.textProperty().bindBidirectional(passwordField.textProperty());
        FormValidator.attachClearOnInput(feedbackLabel, emailField, passwordField, visiblePasswordField);
        FormValidator.attachClearOnInput(forgotPasswordFeedbackLabel,
                forgotPasswordEmailField, forgotPasswordCodeField, forgotPasswordField, forgotPasswordConfirmField);
        FormValidator.attachClearOnInput(faceLoginFeedbackLabel, faceLoginEmailField);
        recaptchaWidget.attach(recaptchaWebView, recaptchaStatusLabel);
        playHeroAnimations();
        showLoginContent();
    }

    @FXML
    public void handleLogin() {
        clearFeedback();
        String email = emailField.getText().trim(), password = passwordField.getText();
        if (email.isEmpty() || password.isEmpty()) { showErr("Email and password are required."); return; }
        if (!FormValidator.isValidEmail(email))    { showErr("Enter a valid email address."); return; }
        if (!recaptchaWidget.isConfigured()) { showLoginFeedback(recaptchaWidget.getConfigurationMessage(), true); return; }
        if (!recaptchaWidget.hasToken())     { showLoginFeedback("Complete the reCAPTCHA security check first.", true); return; }

        loginButton.setDisable(true); loginButton.setText("Checking...");
        Task<LoginResult> task = new Task<>() {
            @Override protected LoginResult call() {
                var v = recaptchaWidget.verifyCurrentToken();
                if (!v.success()) return LoginResult.fail(v.message(), v.resetRequired(), false);
                User u = authService.authenticate(email, password);
                return u == null ? LoginResult.fail("Invalid email or password.", true, true) : LoginResult.ok(u);
            }
        };
        task.setOnSucceeded(e -> {
            restoreLoginButton();
            LoginResult r = task.getValue();
            if (r.resetCaptcha()) recaptchaWidget.reset();
            if (!r.success()) { if (r.markInvalid()) showErr(r.message()); else showLoginFeedback(r.message(), true); return; }
            openDashboard(r.user());
        });
        task.setOnFailed(e -> { restoreLoginButton(); recaptchaWidget.reset(); showLoginFeedback("Login failed.", true); });
        new Thread(task, "login-thread").start();
    }

    @FXML public void handleRegister() {
        try {
            var scene = AppNavigator.createScene(new FXMLLoader(getClass().getResource("/fxml/register.fxml")).load(), getClass());
            AppNavigator.applyStage((Stage) emailField.getScene().getWindow(), scene, "PinkShield Register");
        } catch (IOException e) { e.printStackTrace(); }
    }

    @FXML public void handleShowForgotPassword() {
        clearFeedback(); clearForgotFeedback(); clearFaceFeedback();
        forgotPasswordEmailField.setText(emailField.getText().trim());
        forgotPasswordCodeField.clear(); forgotPasswordField.clear(); forgotPasswordConfirmField.clear();
        forgotPasswordSendCodeButton.setDisable(false); forgotPasswordSendCodeButton.setText("Send Verification Code");
        forgotPasswordSubmitButton.setDisable(true); resetFaceSelection();
        loginContentPane.setManaged(false); loginContentPane.setVisible(false);
        forgotPasswordContentPane.setManaged(true); forgotPasswordContentPane.setVisible(true);
        faceLoginContentPane.setManaged(false); faceLoginContentPane.setVisible(false);
    }

    @FXML public void handleShowFaceLogin() {
        clearFeedback(); clearForgotFeedback(); clearFaceFeedback();
        faceLoginEmailField.setText(emailField.getText().trim()); resetFaceSelection();
        loginContentPane.setManaged(false); loginContentPane.setVisible(false);
        forgotPasswordContentPane.setManaged(false); forgotPasswordContentPane.setVisible(false);
        faceLoginContentPane.setManaged(true); faceLoginContentPane.setVisible(true);
    }

    @FXML public void handleBackToLogin() { showLoginContent(); }

    @FXML public void handleSendResetCode() {
        clearForgotFeedback();
        String email = forgotPasswordEmailField.getText().trim();
        if (email.isEmpty()) { showForgotErr("Email is required.", forgotPasswordEmailField); return; }
        if (!FormValidator.isValidEmail(email)) { showForgotErr("Enter a valid email.", forgotPasswordEmailField); return; }
        forgotPasswordSendCodeButton.setDisable(true); forgotPasswordSubmitButton.setDisable(true);
        forgotPasswordSendCodeButton.setText("Sending...");
        Task<String> task = new Task<>() { @Override protected String call() { return authService.sendPasswordResetCode(email); } };
        task.setOnSucceeded(e -> {
            forgotPasswordSendCodeButton.setDisable(false);
            String err = task.getValue();
            if (err != null) { forgotPasswordSendCodeButton.setText("Send Verification Code"); showForgotErr(err, forgotPasswordEmailField); return; }
            forgotPasswordSendCodeButton.setText("Resend Verification Code");
            forgotPasswordSubmitButton.setDisable(false);
            showForgotFeedback("Code sent to " + email + ". Expires in 10 minutes.", false);
        });
        task.setOnFailed(e -> { forgotPasswordSendCodeButton.setDisable(false); forgotPasswordSendCodeButton.setText("Send Verification Code"); showForgotErr("Failed to send code.", forgotPasswordEmailField); });
        new Thread(task, "reset-email").start();
    }

    @FXML public void handleResetPassword() {
        clearForgotFeedback();
        String email = forgotPasswordEmailField.getText().trim(), code = forgotPasswordCodeField.getText().trim();
        String pwd = forgotPasswordField.getText(), confirm = forgotPasswordConfirmField.getText();
        if (email.isEmpty() || code.isEmpty() || pwd.isEmpty() || confirm.isEmpty()) { showForgotErr("All fields are required.", forgotPasswordEmailField, forgotPasswordCodeField, forgotPasswordField, forgotPasswordConfirmField); return; }
        if (!FormValidator.isValidEmail(email)) { showForgotErr("Enter a valid email.", forgotPasswordEmailField); return; }
        if (code.length() != 6 || !code.chars().allMatch(Character::isDigit)) { showForgotErr("Code must be exactly 6 digits.", forgotPasswordCodeField); return; }
        if (pwd.length() < 8) { showForgotErr("Password must be at least 8 characters.", forgotPasswordField); return; }
        if (!pwd.equals(confirm)) { showForgotErr("Passwords do not match.", forgotPasswordField, forgotPasswordConfirmField); return; }
        String err = authService.resetPasswordWithCode(email, code, pwd);
        if (err != null) { showForgotErr(err, forgotPasswordCodeField); return; }
        emailField.setText(email); passwordField.clear(); visiblePasswordField.clear();
        showLoginContent(); showLoginFeedback("Password updated. Sign in with your new password.", false);
    }

    @FXML public void handleTogglePassword() {
        passwordVisible = !passwordVisible;
        visiblePasswordField.setManaged(passwordVisible); visiblePasswordField.setVisible(passwordVisible);
        passwordField.setManaged(!passwordVisible); passwordField.setVisible(!passwordVisible);
        togglePasswordButton.setText(passwordVisible ? "Hide" : "Show");
    }

    @FXML public void handleCaptureFaceLoginImage() {
        Path p = WebcamCaptureDialog.captureFaceImage((Stage) faceLoginChooseImageButton.getScene().getWindow(),
                getClass(), "Face Sign-In", "Center your face and capture a live image.");
        if (p == null) return;
        selectedFaceImagePath = p;
        faceLoginImageNameLabel.setText(p.getFileName().toString());
        faceLoginImageHelperLabel.setText("Image captured. Face++ will compare it with the enrolled face.");
    }

    @FXML public void handleFaceLogin() {
        clearFaceFeedback(); FormValidator.clearStates(faceLoginEmailField);
        String email = faceLoginEmailField.getText().trim();
        if (email.isEmpty()) { showFaceErr("Email is required."); FormValidator.markInvalid(faceLoginEmailField); return; }
        if (!FormValidator.isValidEmail(email)) { showFaceErr("Enter a valid email."); FormValidator.markInvalid(faceLoginEmailField); return; }
        if (selectedFaceImagePath == null) { showFaceErr("Capture a face image first."); return; }
        faceLoginChooseImageButton.setDisable(true); faceLoginSubmitButton.setDisable(true); faceLoginSubmitButton.setText("Verifying...");
        Path photo = selectedFaceImagePath;
        Task<AuthService.FaceAuthenticationResult> task = new Task<>() {
            @Override protected AuthService.FaceAuthenticationResult call() { return authService.authenticateWithFace(email, photo); }
        };
        task.setOnSucceeded(e -> {
            faceLoginChooseImageButton.setDisable(false); faceLoginSubmitButton.setDisable(false); faceLoginSubmitButton.setText("Verify Face and Enter");
            AuthService.FaceAuthenticationResult r = task.getValue();
            if (!r.success()) { showFaceErr(r.message()); FormValidator.markInvalid(faceLoginEmailField); return; }
            showFaceFeedback(r.message(), false); openDashboard(r.user());
        });
        task.setOnFailed(e -> { faceLoginChooseImageButton.setDisable(false); faceLoginSubmitButton.setDisable(false); faceLoginSubmitButton.setText("Verify Face and Enter"); showFaceErr("Face login failed."); });
        new Thread(task, "face-login").start();
    }

    // ── Dashboard routing ─────────────────────────────────────

    private void openDashboard(User user) {
        if (user == null) return;
        SessionManager.setCurrentUser(user);
        String fxml = switch (user.getRole()) {
            case "admin"  -> "/fxml/admin_dashboard.fxml";
            case "doctor" -> "/fxml/doctor_dashboard.fxml";
            default       -> "/fxml/user_dashboard.fxml";
        };
        try {
            FXMLLoader loader = new FXMLLoader(getClass().getResource(fxml));
            var scene = AppNavigator.createScene(loader.load(), getClass());
            switch (user.getRole()) {
                case "admin"  -> ((AdminDashboardController) loader.getController()).setLoggedInUser(user);
                case "doctor" -> ((DoctorDashboardController) loader.getController()).setLoggedInUser(user);
                default       -> ((UserDashboardController) loader.getController()).setLoggedInUser(user);
            }
            AppNavigator.applyStage((Stage) emailField.getScene().getWindow(), scene, "PinkShield Dashboard");
        } catch (IOException e) { e.printStackTrace(); showLoginFeedback("Failed to load dashboard.", true); }
    }

    // ── Animations ────────────────────────────────────────────

    private void playHeroAnimations() {
        if (loginHeroPane == null) return;
        drift(loginHeroPane, 0, -10, 5.8);
        orbit(orbitDotPrimaryTop,    256, 186, 178, 208, 8.8);
        orbit(orbitDotSecondaryTop,  256, 186, 218, 342, 12.5);
        orbit(orbitDotSecondaryBottom, 256, 186, 218, 148, 11.2);
        orbit(orbitDotPrimaryBottom, 256, 186, 178, 28, 9.6);
        if (orbitRingDashed != null) {
            Timeline t = new Timeline(
                    new KeyFrame(Duration.ZERO, new KeyValue(orbitRingDashed.strokeDashOffsetProperty(), 0)),
                    new KeyFrame(Duration.seconds(14), new KeyValue(orbitRingDashed.strokeDashOffsetProperty(), 140, Interpolator.LINEAR)));
            t.setCycleCount(Animation.INDEFINITE); t.play();
        }
        ringPulse(orbitRingOuter, 4.8, 0.985, 1.025);
        ringPulse(orbitRingInner, 3.6, 0.99,  1.03);
        heartPulse();
        ekgPulse();
        pill(pillTopLeft, -12, -4, 4.6); pill(pillTopRight, 10, 6, 5.4);
        pill(pillBottomLeft, -8, 8, 5.0); pill(pillBottomRight, 12, -6, 6.0);
        starDots();
    }

    private void drift(Node n, double toX, double toY, double secs) {
        if (n == null) return;
        TranslateTransition t = new TranslateTransition(Duration.seconds(secs), n);
        t.setFromY(0); t.setToY(toY); t.setAutoReverse(true); t.setCycleCount(Animation.INDEFINITE); t.setInterpolator(Interpolator.EASE_BOTH); t.play();
    }
    private void orbit(Node n, double cx, double cy, double r, double start, double secs) {
        if (n == null) return;
        DoubleProperty angle = new SimpleDoubleProperty(start);
        angle.addListener((o, ov, nv) -> { double rad = Math.toRadians(nv.doubleValue()); n.setLayoutX(cx + Math.cos(rad)*r); n.setLayoutY(cy + Math.sin(rad)*r); });
        Timeline t = new Timeline(new KeyFrame(Duration.ZERO, new KeyValue(angle, start)), new KeyFrame(Duration.seconds(secs), new KeyValue(angle, start+360, Interpolator.LINEAR)));
        t.setCycleCount(Animation.INDEFINITE); t.play();
    }
    private void ringPulse(Node n, double secs, double from, double to) {
        if (n == null) return;
        ScaleTransition s = new ScaleTransition(Duration.seconds(secs), n); s.setFromX(from); s.setFromY(from); s.setToX(to); s.setToY(to); s.setAutoReverse(true); s.setCycleCount(Animation.INDEFINITE); s.setInterpolator(Interpolator.EASE_BOTH);
        FadeTransition f = new FadeTransition(Duration.seconds(secs), n); f.setFromValue(0.36); f.setToValue(0.68); f.setAutoReverse(true); f.setCycleCount(Animation.INDEFINITE);
        new ParallelTransition(s, f).play();
    }
    private void heartPulse() {
        if (loginHeartShape == null) return;
        ScaleTransition p = new ScaleTransition(Duration.seconds(1.25), loginHeartShape);
        p.setFromX(1.0); p.setFromY(1.0); p.setToX(1.08); p.setToY(1.08); p.setAutoReverse(true); p.setCycleCount(Animation.INDEFINITE); p.setInterpolator(Interpolator.EASE_BOTH); p.play();
    }
    private void ekgPulse() {
        if (loginEkgLine == null) return;
        loginEkgLine.getStrokeDashArray().setAll(420.0, 60.0);
        Timeline d = new Timeline(new KeyFrame(Duration.ZERO, new KeyValue(loginEkgLine.strokeDashOffsetProperty(), 480)), new KeyFrame(Duration.seconds(2.2), new KeyValue(loginEkgLine.strokeDashOffsetProperty(), 0, Interpolator.LINEAR)));
        d.setCycleCount(Animation.INDEFINITE);
        FadeTransition f = new FadeTransition(Duration.seconds(1.1), loginEkgLine); f.setFromValue(0.45); f.setToValue(1.0); f.setAutoReverse(true); f.setCycleCount(Animation.INDEFINITE);
        d.play(); f.play();
    }
    private void pill(Node n, double tx, double ty, double secs) {
        if (n == null) return;
        TranslateTransition t = new TranslateTransition(Duration.seconds(secs), n);
        t.setToX(tx); t.setToY(ty); t.setAutoReverse(true); t.setCycleCount(Animation.INDEFINITE); t.setInterpolator(Interpolator.EASE_BOTH);
        FadeTransition f = new FadeTransition(Duration.seconds(secs), n); f.setFromValue(0.64); f.setToValue(1.0); f.setAutoReverse(true); f.setCycleCount(Animation.INDEFINITE);
        new ParallelTransition(t, f).play();
    }
    private void starDots() {
        if (loginBackgroundPane == null) return;
        Random rng = new Random(7);
        for (Node n : loginBackgroundPane.getChildren()) {
            if (!n.getStyleClass().contains("star-dot")) continue;
            FadeTransition f = new FadeTransition(Duration.seconds(1.8 + rng.nextDouble()*2.2), n);
            f.setFromValue(0.18 + rng.nextDouble()*0.22); f.setToValue(0.9); f.setAutoReverse(true); f.setCycleCount(Animation.INDEFINITE); f.setDelay(Duration.seconds(rng.nextDouble()*2.6));
            ScaleTransition s = new ScaleTransition(Duration.seconds(1.8 + rng.nextDouble()*2.4), n);
            s.setFromX(0.72); s.setFromY(0.72); s.setToX(1.25); s.setToY(1.25); s.setAutoReverse(true); s.setCycleCount(Animation.INDEFINITE);
            new ParallelTransition(f, s).play();
        }
    }

    // ── Helpers ───────────────────────────────────────────────

    private void showLoginContent() {
        if (loginContentPane == null) return;
        passwordVisible = false;
        visiblePasswordField.setManaged(false); visiblePasswordField.setVisible(false);
        passwordField.setManaged(true); passwordField.setVisible(true);
        togglePasswordButton.setText("Show");
        forgotPasswordSendCodeButton.setDisable(false); forgotPasswordSendCodeButton.setText("Send Verification Code");
        forgotPasswordSubmitButton.setDisable(true);
        faceLoginChooseImageButton.setDisable(false); faceLoginSubmitButton.setDisable(false); faceLoginSubmitButton.setText("Verify Face and Enter");
        clearForgotFeedback(); clearFaceFeedback(); resetFaceSelection();
        loginContentPane.setManaged(true); loginContentPane.setVisible(true);
        forgotPasswordContentPane.setManaged(false); forgotPasswordContentPane.setVisible(false);
        faceLoginContentPane.setManaged(false); faceLoginContentPane.setVisible(false);
    }

    private void resetFaceSelection() {
        selectedFaceImagePath = null;
        if (faceLoginImageNameLabel != null) faceLoginImageNameLabel.setText("No live front-camera image captured");
        if (faceLoginImageHelperLabel != null) faceLoginImageHelperLabel.setText("Open the front camera to capture a live image.");
    }
    private void restoreLoginButton() { if (loginButton != null) { loginButton.setDisable(false); loginButton.setText("Authenticate and Enter"); } }
    private void clearFeedback()       { FormValidator.clearStates(emailField, passwordField, visiblePasswordField); hide(feedbackLabel); }
    private void clearForgotFeedback() { FormValidator.clearStates(forgotPasswordEmailField, forgotPasswordCodeField, forgotPasswordField, forgotPasswordConfirmField); hide(forgotPasswordFeedbackLabel); }
    private void clearFaceFeedback()   { FormValidator.clearStates(faceLoginEmailField); hide(faceLoginFeedbackLabel); }
    private void showErr(String m)              { FormValidator.markInvalid(emailField); FormValidator.markInvalid(passwordVisible ? visiblePasswordField : passwordField); showLoginFeedback(m, true); }
    private void showForgotErr(String m, Control... fs) { for (Control f : fs) FormValidator.markInvalid(f); showForgotFeedback(m, true); }
    private void showFaceErr(String m)          { showFaceFeedback(m, true); }
    private void showLoginFeedback(String m, boolean err)  { show(feedbackLabel, m, err); }
    private void showForgotFeedback(String m, boolean err) { show(forgotPasswordFeedbackLabel, m, err); }
    private void showFaceFeedback(String m, boolean err)   { show(faceLoginFeedbackLabel, m, err); }
    private void show(Label l, String m, boolean err) {
        if (l == null) return; boolean has = m != null && !m.isBlank();
        l.setText(m); l.setManaged(has); l.setVisible(has);
        l.setStyle(err ? ERR_STYLE : OK_STYLE);
    }
    private void hide(Label l) { if (l == null) return; l.setText(""); l.setManaged(false); l.setVisible(false); l.setStyle(""); }

    private record LoginResult(boolean success, User user, String message, boolean resetCaptcha, boolean markInvalid) {
        static LoginResult ok(User u)                          { return new LoginResult(true, u, "", true, false); }
        static LoginResult fail(String m, boolean rc, boolean mi) { return new LoginResult(false, null, m, rc, mi); }
    }
}
