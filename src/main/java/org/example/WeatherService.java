package org.example;

import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import com.google.gson.JsonArray;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.time.Duration;
import java.util.concurrent.CompletableFuture;

/**
 * WeatherService: Fetches real-time weather data from OpenWeatherMap API
 * 
 * Location: Grand Tunis, Tunisia (36.8065°N, 10.1815°E)
 * 
 * API: https://api.openweathermap.org/data/2.5/weather
 * 
 * Returns formatted string: "Grand Tunis: 24°C - clear sky"
 */
public class WeatherService {

    // Grand Tunis coordinates
    private static final double TUNIS_LATITUDE = 36.8065;
    private static final double TUNIS_LONGITUDE = 10.1815;
    
    // OpenWeatherMap API endpoint and key
    private static final String OPENWEATHERMAP_API_URL = "https://api.openweathermap.org/data/2.5/weather";
    private static final String API_KEY = "aa2588a4f992f0f1d1e54575660ab3e1";
    
    private final HttpClient httpClient;

    public WeatherService() {
        this.httpClient = HttpClient.newBuilder()
                .connectTimeout(Duration.ofSeconds(10))
                .build();
        System.out.println("✅ Weather Service Initialized for Grand Tunis, Tunisia");
    }

    /**
     * Fetch weather asynchronously (non-blocking)
     * 
     * @return CompletableFuture with formatted weather string
     */
    public CompletableFuture<String> fetchWeatherAsync() {
        return CompletableFuture.supplyAsync(() -> {
            try {
                return fetchWeatherCondition();
            } catch (Exception e) {
                System.err.println("❌ Error fetching weather: " + e.getMessage());
                e.printStackTrace();
                return "🌍 Weather unavailable";
            }
        });
    }

    /**
     * Fetch weather condition from OpenWeatherMap API
     * This method is synchronous - use fetchWeatherAsync() for non-blocking calls
     * 
     * @return Formatted weather string (e.g., "Grand Tunis: 24°C - clear sky")
     */
    public String fetchWeatherCondition() {
        try {
            String url = buildApiUrl();
            System.out.println("🌍 Fetching weather for Grand Tunis...");

            HttpRequest request = HttpRequest.newBuilder()
                    .uri(URI.create(url))
                    .header("Content-Type", "application/json")
                    .timeout(Duration.ofSeconds(10))
                    .GET()
                    .build();

            HttpResponse<String> response = httpClient.send(request, HttpResponse.BodyHandlers.ofString());

            if (response.statusCode() != 200) {
                System.err.println("❌ OpenWeatherMap API error (" + response.statusCode() + "): " + response.body());
                return "🌍 Weather unavailable";
            }

            return parseWeatherResponse(response.body());
        } catch (java.net.ConnectException e) {
            System.err.println("❌ Network connection error: " + e.getMessage());
            return "🌍 No internet connection";
        } catch (java.net.SocketTimeoutException e) {
            System.err.println("❌ Request timeout: " + e.getMessage());
            return "🌍 Request timeout";
        } catch (InterruptedException e) {
            System.err.println("❌ Request interrupted: " + e.getMessage());
            Thread.currentThread().interrupt();
            return "🌍 Weather unavailable";
        } catch (Exception e) {
            System.err.println("❌ Unexpected error fetching weather: " + e.getMessage());
            e.printStackTrace();
            return "🌍 Weather unavailable";
        }
    }

    /**
     * Parse JSON response from OpenWeatherMap API
     * 
     * Response structure:
     * {
     *   "main": {
     *     "temp": 24.5
     *   },
     *   "weather": [
     *     {
     *       "description": "clear sky"
     *     }
     *   ]
     * }
     */
    private String parseWeatherResponse(String jsonResponse) {
        try {
            JsonObject rootObject = JsonParser.parseString(jsonResponse).getAsJsonObject();

            // Extract temperature
            double temperature = rootObject.getAsJsonObject("main").get("temp").getAsDouble();

            // Extract weather description
            JsonArray weatherArray = rootObject.getAsJsonArray("weather");
            if (weatherArray == null || weatherArray.isEmpty()) {
                System.out.println("⚠️ No weather data available");
                return "🌍 Weather data not found";
            }

            String description = weatherArray.get(0).getAsJsonObject().get("description").getAsString();

            // Capitalize first letter of description
            description = description.substring(0, 1).toUpperCase() + description.substring(1);

            // Format and return the result
            String result = String.format("🌡️ Grand Tunis: %.0f°C - %s", temperature, description);
            System.out.println("✅ Weather data retrieved: " + result);
            return result;

        } catch (Exception e) {
            System.err.println("❌ Error parsing weather response: " + e.getMessage());
            e.printStackTrace();
            return "🌍 Failed to parse weather data";
        }
    }

    /**
     * Build the OpenWeatherMap API URL
     */
    private String buildApiUrl() {
        return String.format("%s?lat=%.4f&lon=%.4f&appid=%s&units=metric",
                OPENWEATHERMAP_API_URL,
                TUNIS_LATITUDE,
                TUNIS_LONGITUDE,
                API_KEY);
    }

    /**
     * Test method to verify weather service
     */
    public void testConnection() {
        System.out.println("\n🧪 Weather Service Connection Test");
        System.out.println("========================================");
        System.out.println("Endpoint: " + buildApiUrl());
        System.out.println("Testing fetch...");
        
        try {
            String result = fetchWeatherCondition();
            System.out.println("Result: " + result);
            System.out.println("========================================\n");
        } catch (Exception e) {
            System.err.println("❌ Test failed: " + e.getMessage());
            System.out.println("========================================\n");
        }
    }
}

