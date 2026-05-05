package tn.esprit.services;

import java.io.IOException;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.time.Duration;
import java.util.Locale;
import java.util.concurrent.CompletableFuture;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class AppointmentWeatherService {
    private static final Pattern TEMPERATURE_PATTERN = Pattern.compile("\"temperature_2m\"\\s*:\\s*(-?\\d+(?:\\.\\d+)?)");
    private static final Pattern WIND_PATTERN = Pattern.compile("\"wind_speed_10m\"\\s*:\\s*(-?\\d+(?:\\.\\d+)?)");
    private static final Pattern WEATHER_CODE_PATTERN = Pattern.compile("\"weather_code\"\\s*:\\s*(\\d+)");

    private final AppointmentLocationService locationService = new AppointmentLocationService();
    private final HttpClient httpClient = HttpClient.newBuilder()
            .connectTimeout(Duration.ofSeconds(8))
            .build();

    public CompletableFuture<WeatherSnapshot> fetchCurrentWeatherAsync() {
        return CompletableFuture.supplyAsync(this::fetchCurrentWeather);
    }

    public WeatherSnapshot fetchCurrentWeather() {
        String url = String.format(
                Locale.ENGLISH,
                "https://api.open-meteo.com/v1/forecast?latitude=%.4f&longitude=%.4f&current=temperature_2m,weather_code,wind_speed_10m&timezone=auto",
                locationService.getClinicLatitude(),
                locationService.getClinicLongitude()
        );

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(url))
                .timeout(Duration.ofSeconds(10))
                .GET()
                .build();

        try {
            HttpResponse<String> response = httpClient.send(request, HttpResponse.BodyHandlers.ofString());
            if (response.statusCode() != 200) {
                return new WeatherSnapshot(
                        "Weather unavailable",
                        "The weather service returned status " + response.statusCode() + ".",
                        false
                );
            }

            return parseWeatherResponse(response.body());
        } catch (InterruptedException e) {
            Thread.currentThread().interrupt();
            return new WeatherSnapshot("Weather unavailable", "The weather request was interrupted.", false);
        } catch (IOException e) {
            return new WeatherSnapshot("Weather unavailable", "Check your internet connection and try again.", false);
        }
    }

    private WeatherSnapshot parseWeatherResponse(String responseBody) {
        Double temperature = extractDouble(TEMPERATURE_PATTERN, responseBody);
        Double windSpeed = extractDouble(WIND_PATTERN, responseBody);
        Integer weatherCode = extractInteger(WEATHER_CODE_PATTERN, responseBody);

        if (temperature == null || weatherCode == null) {
            return new WeatherSnapshot("Weather unavailable", "The weather response could not be parsed.", false);
        }

        String summary = String.format(Locale.ENGLISH, "%.1f°C • %s", temperature, describeWeatherCode(weatherCode));
        String detail = windSpeed == null
                ? locationService.getClinicAddress()
                : String.format(Locale.ENGLISH, "%s • Wind %.0f km/h", locationService.getClinicAddress(), windSpeed);

        return new WeatherSnapshot(summary, detail, true);
    }

    private Double extractDouble(Pattern pattern, String source) {
        Matcher matcher = pattern.matcher(source);
        if (!matcher.find()) {
            return null;
        }

        return Double.parseDouble(matcher.group(1));
    }

    private Integer extractInteger(Pattern pattern, String source) {
        Matcher matcher = pattern.matcher(source);
        if (!matcher.find()) {
            return null;
        }

        return Integer.parseInt(matcher.group(1));
    }

    private String describeWeatherCode(int code) {
        return switch (code) {
            case 0 -> "Clear sky";
            case 1, 2 -> "Mostly clear";
            case 3 -> "Cloudy";
            case 45, 48 -> "Fog";
            case 51, 53, 55 -> "Light drizzle";
            case 56, 57 -> "Freezing drizzle";
            case 61, 63, 65 -> "Rain";
            case 66, 67 -> "Freezing rain";
            case 71, 73, 75, 77 -> "Snow";
            case 80, 81, 82 -> "Rain showers";
            case 85, 86 -> "Snow showers";
            case 95 -> "Thunderstorm";
            case 96, 99 -> "Thunderstorm with hail";
            default -> "Seasonal conditions";
        };
    }

    public record WeatherSnapshot(String summary, String detail, boolean available) {
    }
}
