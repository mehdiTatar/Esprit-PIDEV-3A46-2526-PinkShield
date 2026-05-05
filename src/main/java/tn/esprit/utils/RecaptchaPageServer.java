package tn.esprit.utils;

import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpServer;
import tn.esprit.services.RecaptchaService;

import java.io.IOException;
import java.io.OutputStream;
import java.net.InetSocketAddress;
import java.nio.charset.StandardCharsets;

public final class RecaptchaPageServer {
    private static volatile RecaptchaPageServer instance;

    private final HttpServer server;
    private final String widgetUrl;

    private RecaptchaPageServer(String siteKey) throws IOException {
        server = HttpServer.create(new InetSocketAddress("localhost", 0), 0);
        server.createContext("/recaptcha", exchange -> serveRecaptchaPage(exchange, siteKey));
        server.setExecutor(null);
        server.start();
        widgetUrl = "http://localhost:" + server.getAddress().getPort() + "/recaptcha";
    }

    public static RecaptchaPageServer getInstance(RecaptchaService recaptchaService) throws IOException {
        RecaptchaPageServer current = instance;
        if (current != null) {
            return current;
        }

        synchronized (RecaptchaPageServer.class) {
            if (instance == null) {
                instance = new RecaptchaPageServer(recaptchaService.getSiteKey());
            }
            return instance;
        }
    }

    public String getWidgetUrl() {
        return widgetUrl;
    }

    private void serveRecaptchaPage(HttpExchange exchange, String siteKey) throws IOException {
        try {
            byte[] bytes = buildRecaptchaHtml(siteKey).getBytes(StandardCharsets.UTF_8);
            exchange.getResponseHeaders().set("Content-Type", "text/html; charset=UTF-8");
            exchange.getResponseHeaders().set("Cache-Control", "no-store, no-cache, must-revalidate");
            exchange.sendResponseHeaders(200, bytes.length);
            try (OutputStream outputStream = exchange.getResponseBody()) {
                outputStream.write(bytes);
            }
        } catch (RuntimeException e) {
            byte[] bytes = "Internal reCAPTCHA page error.".getBytes(StandardCharsets.UTF_8);
            exchange.getResponseHeaders().set("Content-Type", "text/plain; charset=UTF-8");
            exchange.sendResponseHeaders(500, bytes.length);
            try (OutputStream outputStream = exchange.getResponseBody()) {
                outputStream.write(bytes);
            }
            e.printStackTrace();
        }
    }

    private String buildRecaptchaHtml(String siteKey) {
        return """
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>PinkShield reCAPTCHA</title>
                    <script>
                        let widgetId = null;

                        function notifyJava(methodName, value) {
                            if (!window.javaRecaptcha) {
                                return;
                            }

                            try {
                                switch (methodName) {
                                    case 'onToken':
                                        window.javaRecaptcha.onToken(value || '');
                                        break;
                                    case 'onExpired':
                                        window.javaRecaptcha.onExpired(value || '');
                                        break;
                                    case 'onError':
                                        window.javaRecaptcha.onError(value || '');
                                        break;
                                    default:
                                        break;
                                }
                            } catch (error) {
                                console.error('Java bridge call failed', error);
                            }
                        }

                        function onToken(token) {
                            notifyJava('onToken', token);
                        }

                        function onExpired() {
                            notifyJava('onExpired', '');
                        }

                        function onError() {
                            notifyJava('onError', '');
                        }

                        function onloadCallback() {
                            widgetId = grecaptcha.render('recaptcha-container', {
                                sitekey: '__SITE_KEY__',
                                theme: 'dark',
                                size: 'compact',
                                callback: onToken,
                                'expired-callback': onExpired,
                                'error-callback': onError
                            });
                        }

                        function resetCaptcha() {
                            if (window.grecaptcha && widgetId !== null) {
                                grecaptcha.reset(widgetId);
                            }
                        }

                        function getCaptchaResponse() {
                            if (window.grecaptcha && widgetId !== null) {
                                return grecaptcha.getResponse(widgetId) || '';
                            }
                            return '';
                        }
                    </script>
                    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
                    <style>
                        html, body {
                            margin: 0;
                            width: 100%;
                            height: 100%;
                            overflow: hidden;
                            background: #0f1726;
                            font-family: Arial, sans-serif;
                        }

                        body {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }

                        #recaptcha-shell {
                            padding: 10px 12px 8px 12px;
                            border-radius: 14px;
                            background: rgba(255,255,255,0.04);
                            border: 1px solid rgba(255,255,255,0.08);
                        }
                    </style>
                </head>
                <body>
                    <div id="recaptcha-shell">
                        <div id="recaptcha-container"></div>
                    </div>
                </body>
                </html>
                """.replace("__SITE_KEY__", escapeForJavaScript(siteKey));
    }

    private String escapeForJavaScript(String value) {
        return value
                .replace("\\", "\\\\")
                .replace("'", "\\'");
    }
}
