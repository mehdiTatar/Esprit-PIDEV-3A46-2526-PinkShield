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
        if (webView == null) return;

        webView.setContextMenuEnabled(false);
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
                    showStatus("Unable to connect the reCAPTCHA widget.", true);
                }
            } else if (newState == Worker.State.FAILED) {
                showStatus("Unable to load reCAPTCHA. Check internet access.", true);
            }
        });

        try {
            RecaptchaPageServer server = RecaptchaPageServer.getInstance(recaptchaService);
            webEngine.load(server.getWidgetUrl());
        } catch (IOException e) {
            webView.setDisable(true);
            showStatus("Unable to start the local reCAPTCHA page.", true);
        }
    }

    public boolean isConfigured()               { return recaptchaService.isConfigured(); }
    public String  getConfigurationMessage()    { return recaptchaService.getConfigurationMessage(); }

    public boolean hasToken() {
        refreshToken();
        return token != null && !token.isBlank();
    }

    public RecaptchaService.VerificationResult verifyCurrentToken() {
        return recaptchaService.verifyToken(token);
    }

    public void reset() {
        token = null;
        if (webEngine != null) {
            Platform.runLater(() -> {
                try { webEngine.executeScript("if(typeof resetCaptcha==='function') resetCaptcha();"); }
                catch (Exception ignored) {}
            });
        }
        showStatus("Complete the security challenge to continue.", false);
    }

    private void refreshToken() {
        if (webEngine == null || !Platform.isFxApplicationThread()) return;
        try {
            Object r = webEngine.executeScript("typeof getCaptchaResponse==='function'?getCaptchaResponse():''");
            if (r instanceof String s && !s.isBlank()) {
                token = s;
                showStatus("Security challenge completed.", false);
            }
        } catch (Exception ignored) {}
    }

    private void showStatus(String msg, boolean error) {
        if (statusLabel == null) return;
        statusLabel.setText(msg);
        boolean has = msg != null && !msg.isBlank();
        statusLabel.setVisible(has);
        statusLabel.setManaged(has);
        statusLabel.setStyle(error
                ? "-fx-text-fill: #ff8d8d; -fx-font-size: 11; -fx-font-weight: 700;"
                : "-fx-text-fill: #9eb6d3; -fx-font-size: 11; -fx-font-weight: 600;");
    }

    public final class Bridge {
        public void onToken(String t)   { token = t; Platform.runLater(() -> showStatus("Security challenge completed.", false)); }
        public void onExpired(String i) { token = null; Platform.runLater(() -> showStatus("reCAPTCHA expired. Complete again.", true)); }
        public void onError(String i)   { token = null; Platform.runLater(() -> showStatus("reCAPTCHA error.", true)); }
    }
}
