package org.example;

import java.util.ArrayList;
import java.util.Comparator;
import java.util.HashMap;
import java.util.LinkedHashSet;
import java.util.List;
import java.util.Locale;
import java.util.Map;
import java.util.Set;

public class AiRecommendationService {

    private static final Map<String, String[]> KEYWORD_BUCKETS = buildKeywordBuckets();

    public List<Product> getAiRecommendations(String patientNotes) {
        List<ProductScore> scored = new ArrayList<>();
        String notes = patientNotes == null ? "" : patientNotes.toLowerCase(Locale.ROOT);
        List<Product> inventory = ProductCatalog.getInventory();

        for (Product product : inventory) {
            int score = scoreProduct(notes, product);
            if (score > 0) {
                scored.add(new ProductScore(product, score));
            }
        }

        scored.sort(Comparator
                .comparingInt(ProductScore::score).reversed()
                .thenComparing(ps -> ps.product().getName()));

        List<Product> recommendations = new ArrayList<>();
        Set<String> seen = new LinkedHashSet<>();
        for (ProductScore score : scored) {
            if (seen.add(score.product().getName())) {
                recommendations.add(score.product());
            }
            if (recommendations.size() == 8) {
                break;
            }
        }

        if (recommendations.isEmpty()) {
            for (int i = 0; i < Math.min(8, inventory.size()); i++) {
                recommendations.add(inventory.get(i));
            }
        }

        return recommendations;
    }

    private int scoreProduct(String notes, Product product) {
        String haystack = (product.getName() + " " + product.getCategory()).toLowerCase(Locale.ROOT);
        int score = 0;

        for (Map.Entry<String, String[]> entry : KEYWORD_BUCKETS.entrySet()) {
            if (containsAny(notes, entry.getValue())) {
                score += countMatches(haystack, entry.getKey()) * 5;
                score += countMatches(haystack, entry.getKey().replace(" ", "")) * 2;
                score += containsAny(haystack, entry.getValue()) ? 3 : 0;
            }
        }

        if (notes.contains("headache") || notes.contains("fever") || notes.contains("pain")) {
            score += containsAny(haystack, new String[]{"doliprane", "panado", "efferalgan", "nurofen", "advil", "aspirin", "arnica"}) ? 10 : 0;
        }
        if (notes.contains("skin") || notes.contains("rash") || notes.contains("acne") || notes.contains("eczema")) {
            score += containsAny(haystack, new String[]{"vichy", "bioderma", "avène", "cerave", "uriage", "la roche", "cicaplast", "sebium", "cleanance", "anti-itch", "moisturizing"}) ? 10 : 0;
        }
        if (notes.contains("cough") || notes.contains("cold") || notes.contains("throat") || notes.contains("flu")) {
            score += containsAny(haystack, new String[]{"syrup", "strepsils", "hexaspray", "vicks", "sinutab", "humer", "physiomer", "bronchostop", "humex", "propolis", "lozenges"}) ? 10 : 0;
        }
        if (notes.contains("stomach") || notes.contains("nausea") || notes.contains("digestion") || notes.contains("diarrhea")) {
            score += containsAny(haystack, new String[]{"smecta", "gaviscon", "maalox", "motilium", "spasfon", "enterogermina", "probiotic", "lacteol", "normacol"}) ? 10 : 0;
        }

        return score;
    }

    private boolean containsAny(String text, String[] keywords) {
        for (String keyword : keywords) {
            if (text.contains(keyword.toLowerCase(Locale.ROOT))) {
                return true;
            }
        }
        return false;
    }

    private int countMatches(String text, String keyword) {
        int count = 0;
        int index = 0;
        while ((index = text.indexOf(keyword, index)) >= 0) {
            count++;
            index += keyword.length();
        }
        return count;
    }

    private static Map<String, String[]> buildKeywordBuckets() {
        Map<String, String[]> buckets = new HashMap<>();
        buckets.put("headache", new String[]{"headache", "migraine", "pain", "fever"});
        buckets.put("skin", new String[]{"skin", "rash", "acne", "eczema", "dry skin", "itch"});
        buckets.put("cough", new String[]{"cough", "cold", "throat", "flu", "sneeze"});
        buckets.put("stomach", new String[]{"stomach", "nausea", "digestion", "digestive", "diarrhea"});
        buckets.put("allergy", new String[]{"allergy", "allergic", "itch", "sneeze", "nasal"});
        buckets.put("vitamin", new String[]{"vitamin", "weakness", "fatigue", "energy", "supplement"});
        buckets.put("baby", new String[]{"baby", "infant", "diaper", "newborn"});
        buckets.put("eye", new String[]{"eye", "vision", "dry eyes", "drops"});
        buckets.put("oral", new String[]{"tooth", "mouth", "gum", "dental"});
        buckets.put("first aid", new String[]{"wound", "burn", "cut", "bandage", "first aid"});
        return buckets;
    }

    private record ProductScore(Product product, int score) {
    }
}

