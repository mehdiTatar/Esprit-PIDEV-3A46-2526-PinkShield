package org.example;

import com.google.gson.JsonObject;
import com.google.gson.JsonParser;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.util.concurrent.CompletableFuture;

/**
 * ZenAdviceService: Fetches random wellness advice from AdviceSlip API
 * 
 * Features:
 * - Non-blocking async HTTP requests using CompletableFuture
 * - JSON parsing using GSON
 * - Fallback message for connection errors
 * 
 * API: https://api.adviceslip.com/advice (Free, no key required)
 * Response: {"slip": {"id": 11, "advice": "Always trust your instincts."}}
 */
public class ZenAdviceService {

    private static final String API_URL = "https://api.adviceslip.com/advice";
    private static final String FALLBACK_MESSAGE = "Prenez un moment pour respirer profondément aujourd'hui.";
    
    private static final HttpClient httpClient = HttpClient.newBuilder()
            .version(HttpClient.Version.HTTP_2)
            .build();

    /**
     * Fetch a random zen advice asynchronously (non-blocking)
     * 
     * @return CompletableFuture<String> containing the advice or fallback message
     */
    public static CompletableFuture<String> fetchZenAdviceAsync() {
        return CompletableFuture.supplyAsync(() -> {
            try {
                return fetchZenAdvice();
            } catch (Exception e) {
                System.err.println("❌ Error fetching zen advice: " + e.getMessage());
                e.printStackTrace();
                // Return fallback message on any error (network, parsing, etc.)
                return FALLBACK_MESSAGE;
            }
        });
    }

    /**
     * Fetch a random zen advice synchronously (blocking)
     * 
     * @return String containing the advice
     * @throws Exception on network or parsing errors
     */
    private static String fetchZenAdvice() throws Exception {
        System.out.println("🧘 Fetching zen advice from AdviceSlip API...");

        HttpRequest request = HttpRequest.newBuilder()
                .uri(new URI(API_URL))
                .GET()
                .header("User-Agent", "PinkShield-HealthApp/1.0")
                .timeout(java.time.Duration.ofSeconds(10))
                .build();

        HttpResponse<String> response = httpClient.send(request, HttpResponse.BodyHandlers.ofString());

        if (response.statusCode() != 200) {
            throw new Exception("API returned status code: " + response.statusCode());
        }

        // Parse JSON response
        String advice = parseAdviceFromJson(response.body());
        System.out.println("✅ Zen advice fetched successfully");
        
        return advice;
    }

    /**
     * Parse advice text from JSON response
     * 
     * Expected JSON format: {"slip": {"id": 11, "advice": "Always trust your instincts."}}
     * 
     * @param jsonResponse JSON string from API
     * @return Extracted advice string
     */
    private static String parseAdviceFromJson(String jsonResponse) throws Exception {
        try {
            // Parse JSON using GSON
            JsonObject jsonObject = JsonParser.parseString(jsonResponse).getAsJsonObject();
            
            // Navigate to slip.advice
            JsonObject slip = jsonObject.getAsJsonObject("slip");
            String advice = slip.get("advice").getAsString();
            
            return "💡 " + advice; // Add emoji for visual appeal
        } catch (Exception e) {
            System.err.println("❌ Error parsing JSON response: " + e.getMessage());
            throw new Exception("Failed to parse advice from JSON", e);
        }
    }
}

