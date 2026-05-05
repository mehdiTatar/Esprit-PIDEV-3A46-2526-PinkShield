package tn.esprit.utils;

import javafx.application.Platform;
import javafx.concurrent.Worker;
import javafx.scene.control.Label;
import javafx.scene.web.WebEngine;
import javafx.scene.web.WebView;
import netscape.javascript.JSObject;
import tn.esprit.services.RecaptchaService;

import java.io.IOException;

public class RecaptchaWidget {
    private final RecaptchaService recaptchaService = new RecaptchaService();
    private String token;
    private WebEngine webEngine;
    private Label statusLabel;

    public void attach(WebView webView, Label statusLabel) {
        this.statusLabel = statusLabel;

        if (webView == null) {
            return;
        }

        webView.setContextMenuEnabled(false);
        webView.setDisable(false);
        webEngine = webView.getEngine();
        webEngine.setJavaScriptEnabled(true);

        if (!recaptchaService.isConfigured()) {
            webView.setDisable(true);
            showStatus(recaptchaService.getConfigurationMessage(), true);
            return;
        }

        webEngine.getLoadWorker().stateProperty().addListener((obs, oldState, newState) -> {
            if (newState == Worker.State.SUCCEEDED) {
                try {
                    JSObject window = (JSObject) webEngine.executeScript("window");
                    window.setMember("javaRecaptcha", new Bridge());
                    showStatus("Complete the security challenge to continue.", false);
                } catch (Exception e) {
                    showStatus("Unable to connect the reCAPTCHA widget to JavaFX.", true);
                }
            } else if (newState == Worker.State.FAILED) {
                showStatus("Unable to load the reCAPTCHA widget. Check internet access and localhost access.", true);
            }
        });

        try {
            RecaptchaPageServer pageServer = RecaptchaPageServer.getInstance(recaptchaService);
            webEngine.load(pageServer.getWidgetUrl());
        } catch (IOException e) {
            webView.setDisable(true);
            showStatus("Unable to start the local reCAPTCHA page.", true);
        }
    }

    public boolean isConfigured() {
        return recaptchaService.isConfigured();
    }

    public String getConfigurationMessage() {
        return recaptchaService.getConfigurationMessage();
    }

    public boolean hasToken() {
        refreshTokenFromPage();
        return token != null && !token.isBlank();
    }

    public String currentToken() {
        refreshTokenFromPage();
        return token;
    }

    public RecaptchaService.VerificationResult verifyCurrentToken() {
        return recaptchaService.verifyToken(token);
    }

    public void reset() {
        token = null;
        if (webEngine != null) {
            Platform.runLater(() -> {
                try {
                    webEngine.executeScript("if (typeof resetCaptcha === 'function') { resetCaptcha(); }");
                } catch (Exception ignored) {
                }
            });
        }
        showStatus("Complete the security challenge to continue.", false);
    }

    private void refreshTokenFromPage() {
        if (webEngine == null || !Platform.isFxApplicationThread()) {
            return;
        }

        try {
            Object response = webEngine.executeScript(
                    "typeof getCaptchaResponse === 'function' ? getCaptchaResponse() : ''"
            );
            if (response instanceof String responseText && !responseText.isBlank()) {
                token = responseText;
                showStatus("Security challenge completed.", false);
            }
        } catch (Exception ignored) {
        }
    }

    private void showStatus(String message, boolean error) {
        if (statusLabel == null) {
            return;
        }

        statusLabel.setText(message);
        statusLabel.setVisible(message != null && !message.isBlank());
        statusLabel.setManaged(message != null && !message.isBlank());
        statusLabel.setStyle(error
                ? "-fx-text-fill: #ff8d8d; -fx-font-size: 11; -fx-font-weight: 700;"
                : "-fx-text-fill: #9eb6d3; -fx-font-size: 11; -fx-font-weight: 600;");
    }

    public final class Bridge {
        public void onToken(String tokenValue) {
            token = tokenValue;
            Platform.runLater(() -> showStatus("Security challenge completed.", false));
        }

        public void onExpired(String ignored) {
            token = null;
            Platform.runLater(() -> showStatus("The reCAPTCHA challenge expired. Complete it again.", true));
        }

        public void onError(String ignored) {
            token = null;
            Platform.runLater(() -> showStatus("The reCAPTCHA widget encountered an error.", true));
        }
    }
}
