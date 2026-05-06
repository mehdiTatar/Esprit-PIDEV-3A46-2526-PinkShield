package tn.esprit.services;

import java.net.URI;
import java.net.URLEncoder;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.nio.charset.StandardCharsets;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class GiphyService {
    private static final String API_KEY_ENV = "GIPHY_API_KEY";
    private static final String RANDOM_GIF_ENDPOINT = "https://api.giphy.com/v1/gifs/random";
    private static final Pattern ORIGINAL_URL_PATTERN = Pattern.compile(
            "\"original\"\\s*:\\s*\\{.*?\"url\"\\s*:\\s*\"(.*?)\"",
            Pattern.DOTALL
    );

    private final HttpClient httpClient = HttpClient.newHttpClient();

    public String getRandomCelebrationGifUrl() throws Exception {
        String apiKey = System.getenv(API_KEY_ENV);
        if (apiKey == null || apiKey.isBlank()) {
            throw new IllegalStateException("GIPHY_API_KEY environment variable is not set.");
        }

        String endpoint = RANDOM_GIF_ENDPOINT
                + "?api_key=" + URLEncoder.encode(apiKey.trim(), StandardCharsets.UTF_8)
                + "&tag=" + URLEncoder.encode("celebration,success", StandardCharsets.UTF_8)
                + "&rating=g";

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(endpoint))
                .GET()
                .build();

        HttpResponse<String> response = httpClient.send(request, HttpResponse.BodyHandlers.ofString());
        if (response.statusCode() < 200 || response.statusCode() >= 300) {
            throw new RuntimeException("Giphy API request failed with status " + response.statusCode() + ": " + response.body());
        }

        Matcher matcher = ORIGINAL_URL_PATTERN.matcher(response.body());
        if (!matcher.find()) {
            throw new RuntimeException("Could not extract data.images.original.url from Giphy response.");
        }

        return unescapeJson(matcher.group(1));
    }

    private String unescapeJson(String value) {
        return value
                .replace("\\/", "/")
                .replace("\\\"", "\"")
                .replace("\\\\", "\\");
    }
}
