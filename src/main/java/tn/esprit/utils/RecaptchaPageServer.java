package tn.esprit.utils;

import com.sun.net.httpserver.HttpServer;
import tn.esprit.services.RecaptchaService;

import java.io.IOException;
import java.net.InetSocketAddress;
import java.net.ServerSocket;
import java.nio.charset.StandardCharsets;

/** Minimal embedded HTTP server that serves the reCAPTCHA widget page. */
public final class RecaptchaPageServer {

    private static RecaptchaPageServer instance;

    private final int port;

    private RecaptchaPageServer(RecaptchaService recaptchaService) throws IOException {
        try (ServerSocket s = new ServerSocket(0)) {
            port = s.getLocalPort();
        }

        HttpServer server = HttpServer.create(new InetSocketAddress("localhost", port), 0);
        String siteKey = recaptchaService.getSiteKey();
        server.createContext("/captcha", exchange -> {
            byte[] body = buildHtml(siteKey).getBytes(StandardCharsets.UTF_8);
            exchange.getResponseHeaders().add("Content-Type", "text/html; charset=UTF-8");
            exchange.sendResponseHeaders(200, body.length);
            exchange.getResponseBody().write(body);
            exchange.getResponseBody().close();
        });
        server.setExecutor(null);
        server.start();
    }

    public static synchronized RecaptchaPageServer getInstance(RecaptchaService svc) throws IOException {
        if (instance == null) instance = new RecaptchaPageServer(svc);
        return instance;
    }

    public String getWidgetUrl() {
        return "http://localhost:" + port + "/captcha";
    }

    private static String buildHtml(String siteKey) {
        return """
                <!DOCTYPE html>
                <html><head><meta charset="UTF-8">
                <script src="https://www.google.com/recaptcha/api.js?onload=onCaptchaLoad&render=explicit" async defer></script>
                <script>
                  function onCaptchaLoad() {
                    grecaptcha.render('widget', {
                      sitekey: '%s',
                      callback: function(token) { if(window.javaRecaptcha) window.javaRecaptcha.onToken(token); },
                      'expired-callback': function() { if(window.javaRecaptcha) window.javaRecaptcha.onExpired(''); },
                      'error-callback': function() { if(window.javaRecaptcha) window.javaRecaptcha.onError(''); }
                    });
                  }
                  function getCaptchaResponse() { return grecaptcha ? grecaptcha.getResponse() : ''; }
                  function resetCaptcha() { if(grecaptcha) grecaptcha.reset(); }
                </script>
                <style>body{margin:0;background:transparent;}</style>
                </head><body><div id="widget"></div></body></html>
                """.formatted(siteKey);
    }
}
