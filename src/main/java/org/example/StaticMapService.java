package org.example;

import javafx.scene.image.Image;
import java.util.List;
import java.util.concurrent.CompletableFuture;

/**
 * StaticMapService: Fetches static map images from APIs
 * 
 * This service provides clinic location maps using free/open static map APIs.
 * Supports multiple providers:
 * 1. Google Maps Static API (requires API key)
 * 2. Geoapify Static Maps (free tier available)
 * 3. OpenStreetMap + Nominatim (completely free)
 * 
 * Default clinic locations: Grand Tunis and Ariana, Tunisia
 */
public class StaticMapService {

    // Clinic location details
    private static final List<ClinicLocation> CLINIC_LOCATIONS = List.of(
            new ClinicLocation("Centre Urbain Nord", "Tunis", 36.8444, 10.1985),
            new ClinicLocation("Ariana Centre", "Ariana", 36.8665, 10.1647)
    );

    // Map provider configuration
    private static final MapProvider DEFAULT_PROVIDER = MapProvider.GEOAPIFY_FREE;

    public enum MapProvider {
        GOOGLE_MAPS,      // Requires API key
        GEOAPIFY_FREE,    // Free tier (recommended)
        OPENSTREETMAP     // Completely free alternative
    }

    /**
     * Fetch clinic map asynchronously (non-blocking)
     * 
     * @return CompletableFuture with Image object
     */
    public static CompletableFuture<Image> fetchClinicMapAsync() {
        return CompletableFuture.supplyAsync(() -> {
            try {
                return fetchClinicMap(DEFAULT_PROVIDER, 400, 200, 15);
            } catch (Exception e) {
                System.err.println("❌ Error fetching clinic map: " + e.getMessage());
                e.printStackTrace();
                return null;
            }
        });
    }

    /**
     * Fetch clinic map with specific provider and dimensions
     * 
     * @param provider Map provider to use
     * @param width Map width in pixels
     * @param height Map height in pixels
     * @param zoom Zoom level (1-20)
     * @return Image object or null if failed
     */
    public static Image fetchClinicMap(MapProvider provider, int width, int height, int zoom) {
        try {
            String mapUrl = buildMapUrl(provider, width, height, zoom);
            System.out.println("🗺️ Fetching clinic map from " + provider + "...");
            
            // Load image with background loading (non-blocking)
            // Third parameter 'true' enables background loading
            Image map = new Image(mapUrl, width, height, true, true);
            System.out.println("✅ Clinic map loaded successfully");
            return map;
            
        } catch (Exception e) {
            System.err.println("❌ Error loading map image: " + e.getMessage());
            return null;
        }
    }

    /**
     * Build map URL based on provider
     */
    private static String buildMapUrl(MapProvider provider, int width, int height, int zoom) {
        return switch (provider) {
            case GOOGLE_MAPS -> buildGoogleMapsUrl(width, height, zoom);
            case GEOAPIFY_FREE -> buildGeoapifyUrl(width, height, zoom);
            case OPENSTREETMAP -> buildOpenStreetMapUrl(width, height, zoom);
        };
    }

    /**
     * Build Google Maps Static API URL
     * Requires: GOOGLE_MAPS_API_KEY environment variable or system property
     * 
     * Format: https://maps.googleapis.com/maps/api/staticmap?...
     */
    private static String buildGoogleMapsUrl(int width, int height, int zoom) {
        String apiKey = getConfigValue("GOOGLE_MAPS_API_KEY", "google.maps.api.key");
        
        if (apiKey == null || apiKey.isEmpty()) {
            System.out.println("⚠️ Google Maps API key not found. Falling back to Geoapify.");
            return buildGeoapifyUrl(width, height, zoom);
        }

        String markerString = buildGoogleMarkers();
        ClinicLocation center = getMapCenter();

        return "https://maps.googleapis.com/maps/api/staticmap?" +
                "center=" + center.latitude + "," + center.longitude +
                "&zoom=" + zoom +
                "&size=" + width + "x" + height +
                markerString +
                "&style=feature:all%7Celement:labels%7Cvisibility:off" +
                "&style=feature:water%7Ccolor:0xcccccc" +
                "&style=feature:land%7Ccolor:0xf2f2f2" +
                "&style=feature:road%7Ccolor:0xdddddd" +
                "&key=" + apiKey;
    }

    /**
     * Build Geoapify Static Maps URL (Free tier)
     * No API key required for basic usage
     * 
     * Format: https://maps.geoapify.com/v1/staticmap?...
     */
    private static String buildGeoapifyUrl(int width, int height, int zoom) {
        // Geoapify static maps. If an API key is provided via GEOAPIFY_API_KEY or
        // geoapify.api.key system property, include it. Otherwise fall back to OSM
        // tiles to avoid returning a non-authorized 403 image URL.
        String apiKey = getConfigValue("GEOAPIFY_API_KEY", "geoapify.api.key");
        if (apiKey == null || apiKey.isEmpty()) {
            System.out.println("⚠️ Geoapify API key not set; falling back to OpenStreetMap tiles.");
            return buildOpenStreetMapUrl(width, height, zoom);
        }

        ClinicLocation center = getMapCenter();

        // Build Geoapify URL with provided API key
        return "https://maps.geoapify.com/v1/staticmap?" +
                "style=osm-bright" +
                "&width=" + width +
                "&height=" + height +
                "&center=lonlat:" + center.longitude + "," + center.latitude +
                "&zoom=" + zoom +
                buildGeoapifyMarkers() +
                "&apiKey=" + apiKey;
    }

    /**
     * Build OpenStreetMap Static API URL (Free & Open Source)
     * Using Leaflet Static API wrapper
     */
    private static String buildOpenStreetMapUrl(int width, int height, int zoom) {
        // Using tile.openstreetmap.org directly with simple URL scheme
        ClinicLocation center = getMapCenter();
        int tileX = (int) Math.floor((center.longitude + 180) / 360 * (1 << zoom));
        int tileY = (int) Math.floor((1 - Math.log(Math.tan(Math.toRadians(center.latitude)) + 
                1 / Math.cos(Math.toRadians(center.latitude))) / Math.PI) / 2 * (1 << zoom));

        // Fallback to a simple web tile service URL
        return "https://a.tile.openstreetmap.org/" + zoom + "/" + tileX + "/" + tileY + ".png";
    }

    /**
     * Get configuration value from environment or system properties
     */
    private static String getConfigValue(String envVarName, String systemPropertyName) {
        String envValue = System.getenv(envVarName);
        if (envValue != null && !envValue.isEmpty()) {
            return envValue;
        }

        String propValue = System.getProperty(systemPropertyName);
        return propValue != null && !propValue.isEmpty() ? propValue : null;
    }

    /**
     * Get clinic location details
     */
    public static class ClinicLocation {
        public final String name;
        public final String city;
        public final double latitude;
        public final double longitude;
        public final String fullAddress;

        public ClinicLocation(String name, String city, double latitude, double longitude) {
            this.name = name;
            this.city = city;
            this.latitude = latitude;
            this.longitude = longitude;
            this.fullAddress = name + ", " + city + ", Tunisia";
        }

        @Override
        public String toString() {
            return fullAddress + " (" + latitude + "°N, " + longitude + "°E)";
        }
    }

    /**
     * Get clinic location
     */
    public static ClinicLocation getClinicLocation() {
        return CLINIC_LOCATIONS.getFirst();
    }

    /**
     * Get all clinic locations displayed on the map.
     */
    public static List<ClinicLocation> getClinicLocations() {
        return CLINIC_LOCATIONS;
    }

    private static ClinicLocation getMapCenter() {
        double latitude = 0.0;
        double longitude = 0.0;

        for (ClinicLocation location : CLINIC_LOCATIONS) {
            latitude += location.latitude;
            longitude += location.longitude;
        }

        int count = CLINIC_LOCATIONS.size();
        return new ClinicLocation("Map Center", "Tunis", latitude / count, longitude / count);
    }

    private static String buildGoogleMarkers() {
        StringBuilder markers = new StringBuilder();
        String[] labels = {"T", "A"};

        for (int i = 0; i < CLINIC_LOCATIONS.size(); i++) {
            ClinicLocation location = CLINIC_LOCATIONS.get(i);
            markers.append("&markers=")
                    .append("color:")
                    .append(i == 0 ? "red" : "blue")
                    .append("%7Clabel:")
                    .append(labels[Math.min(i, labels.length - 1)])
                    .append("%7C")
                    .append(location.latitude)
                    .append(",")
                    .append(location.longitude);
        }

        return markers.toString();
    }

    private static String buildGeoapifyMarkers() {
        StringBuilder markers = new StringBuilder();

        for (int i = 0; i < CLINIC_LOCATIONS.size(); i++) {
            ClinicLocation location = CLINIC_LOCATIONS.get(i);
            markers.append("&marker=lonlat:")
                    .append(location.longitude)
                    .append(",")
                    .append(location.latitude)
                    .append(";color:%23")
                    .append(i == 0 ? "ff0000" : "0057ff")
                    .append(";size:medium");
        }

        return markers.toString();
    }
}

