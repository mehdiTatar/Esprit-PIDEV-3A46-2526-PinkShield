package org.example;

import java.util.ArrayList;
import java.util.Collections;
import java.util.LinkedHashMap;
import java.util.LinkedHashSet;
import java.util.List;
import java.util.Locale;
import java.util.Map;
import java.util.concurrent.ThreadLocalRandom;

public class RiskAnalysisService {

    private static final Map<String, Integer> KEYWORD_WEIGHTS = buildKeywordWeights();
    private static final Map<String, String> SYMPTOM_TO_SPECIALTY = buildSymptomToSpecialty();
    private static final Map<String, List<String>> SPECIALTY_DOCTORS = buildSpecialtyDoctors();
    private static final Map<String, String[]> SYMPTOM_PRODUCT_HINTS = buildSymptomProductHints();

    public RiskAssessment analyze(String patientNotes) {
        String notes = patientNotes == null ? "" : patientNotes.trim().toLowerCase(Locale.ROOT);
        int severityScore = 0;
        List<String> matchedKeywords = new ArrayList<>();

        for (Map.Entry<String, Integer> entry : KEYWORD_WEIGHTS.entrySet()) {
            if (notes.contains(entry.getKey())) {
                severityScore += entry.getValue();
                matchedKeywords.add(entry.getKey());
            }
        }

        String riskLevel;
        String suggestedSpecialty;
        String summary;

        if (severityScore >= 100) {
            riskLevel = "EXTREME";
            suggestedSpecialty = "Emergency Specialist";
            summary = "Immediate emergency care is recommended.";
        } else if (severityScore >= 50) {
            riskLevel = "MODERATE";
            suggestedSpecialty = detectSpecialty(notes);
            summary = "Prompt specialist consultation is recommended.";
        } else {
            riskLevel = "LOW";
            suggestedSpecialty = "General Care";
            summary = "General care and monitoring are recommended.";
        }

        String doctor = pickRandomDoctor(suggestedSpecialty);
        List<String> suggestedProducts = recommendProducts(notes, suggestedSpecialty, 2);
        if (suggestedProducts.isEmpty()) {
            suggestedProducts = List.of("Paracetamol", "Vitamin C 1000mg");
        }

        return new RiskAssessment(
                riskLevel,
                severityScore,
                suggestedSpecialty,
                doctor,
                suggestedProducts,
                uniqueKeywords(matchedKeywords),
                summary
        );
    }

    private String detectSpecialty(String notes) {
        for (Map.Entry<String, String> entry : SYMPTOM_TO_SPECIALTY.entrySet()) {
            if (notes.contains(entry.getKey())) {
                return entry.getValue();
            }
        }
        return "General Care";
    }

    private String pickRandomDoctor(String specialty) {
        List<String> doctors = loadDoctorsFromDatabase(specialty);
        if (doctors.isEmpty()) {
            doctors = SPECIALTY_DOCTORS.getOrDefault(specialty, SPECIALTY_DOCTORS.get("General Care"));
        }
        if (doctors == null || doctors.isEmpty()) {
            return "Dr. Firas Ben Hmida";
        }
        return doctors.get(ThreadLocalRandom.current().nextInt(doctors.size()));
    }

    private List<String> loadDoctorsFromDatabase(String specialty) {
        try {
            ServiceAppointment serviceAppointment = new ServiceAppointment();
            List<String> doctors = new ArrayList<>();
            for (Appointment appointment : serviceAppointment.afficherAll()) {
                String doctorName = appointment.getDoctor_name();
                if (doctorName != null && !doctorName.isBlank() && !doctors.contains(doctorName)) {
                    doctors.add(doctorName);
                }
            }

            List<String> fallbackPool = SPECIALTY_DOCTORS.getOrDefault(specialty, SPECIALTY_DOCTORS.get("General Care"));
            List<String> intersection = new ArrayList<>();
            for (String doctor : doctors) {
                if (fallbackPool.contains(doctor)) {
                    intersection.add(doctor);
                }
            }
            return intersection.isEmpty() ? doctors : intersection;
        } catch (Exception e) {
            return List.of();
        }
    }

    private List<String> recommendProducts(String notes, String specialty, int limit) {
        LinkedHashSet<String> matches = new LinkedHashSet<>();

        try {
            ServiceParapharmacie serviceParapharmacie = new ServiceParapharmacie();
            for (Parapharmacie product : serviceParapharmacie.afficherAll()) {
                String searchable = ((product.getNom() == null ? "" : product.getNom()) + " "
                        + (product.getDescription() == null ? "" : product.getDescription())).toLowerCase(Locale.ROOT);
                if (matchesAnyHints(notes, specialty, searchable)) {
                    matches.add(product.getNom());
                    if (matches.size() >= limit) {
                        return new ArrayList<>(matches).subList(0, limit);
                    }
                }
            }
        } catch (Exception ignored) {
            // fallback below
        }

        for (Product product : ProductCatalog.getInventory()) {
            String searchable = (product.getName() + " " + product.getCategory()).toLowerCase(Locale.ROOT);
            if (matchesAnyHints(notes, specialty, searchable)) {
                matches.add(product.getName());
                if (matches.size() >= limit) {
                    return new ArrayList<>(matches).subList(0, limit);
                }
            }
        }

        return new ArrayList<>(matches).size() > limit ? new ArrayList<>(matches).subList(0, limit) : new ArrayList<>(matches);
    }

    private boolean matchesAnyHints(String notes, String specialty, String searchableProductText) {
        for (Map.Entry<String, String[]> entry : SYMPTOM_PRODUCT_HINTS.entrySet()) {
            if (!notes.contains(entry.getKey())) {
                continue;
            }
            for (String hint : entry.getValue()) {
                if (searchableProductText.contains(hint)) {
                    return true;
                }
            }
        }

        String[] specialtyHints = switch (specialty.toLowerCase(Locale.ROOT)) {
            case "emergency specialist" -> new String[]{"betadine", "bandage", "paracetamol"};
            case "cardiology" -> new String[]{"aspirin", "omega", "magnesium"};
            case "neurology" -> new String[]{"paracetamol", "doliprane", "panado", "nurofen"};
            case "orthopedics" -> new String[]{"arnica", "bandage", "compeed"};
            case "pulmonology" -> new String[]{"syrup", "strepsils", "vicks", "humer"};
            case "ophthalmology" -> new String[]{"eye drops", "optive", "artelac"};
            default -> new String[]{"paracetamol", "vitamin", "cream"};
        };

        for (String hint : specialtyHints) {
            if (searchableProductText.contains(hint)) {
                return true;
            }
        }
        return false;
    }

    private List<String> uniqueKeywords(List<String> keywords) {
        List<String> unique = new ArrayList<>();
        for (String keyword : keywords) {
            if (!unique.contains(keyword)) {
                unique.add(keyword);
            }
        }
        return unique;
    }

    private static Map<String, Integer> buildKeywordWeights() {
        Map<String, Integer> weights = new LinkedHashMap<>();
        weights.put("heart attack", 100);
        weights.put("train", 100);
        weights.put("car crash", 100);
        weights.put("unconscious", 100);
        weights.put("stroke", 100);
        weights.put("heavy bleeding", 100);
        weights.put("fever", 50);
        weights.put("fracture", 50);
        weights.put("chest pain", 50);
        weights.put("difficulty breathing", 50);
        weights.put("blurred vision", 50);
        weights.put("headache", 10);
        weights.put("cough", 10);
        weights.put("sore throat", 10);
        weights.put("bruise", 10);
        return Collections.unmodifiableMap(weights);
    }

    private static Map<String, String> buildSymptomToSpecialty() {
        Map<String, String> mapping = new LinkedHashMap<>();
        mapping.put("heart attack", "Emergency Specialist");
        mapping.put("stroke", "Emergency Specialist");
        mapping.put("heavy bleeding", "Emergency Specialist");
        mapping.put("train", "Emergency Specialist");
        mapping.put("car crash", "Emergency Specialist");
        mapping.put("unconscious", "Emergency Specialist");
        mapping.put("fever", "General Care");
        mapping.put("fracture", "Orthopedics");
        mapping.put("chest pain", "Cardiology");
        mapping.put("difficulty breathing", "Pulmonology");
        mapping.put("blurred vision", "Ophthalmology");
        mapping.put("headache", "Neurology");
        mapping.put("cough", "Pulmonology");
        mapping.put("sore throat", "General Care");
        mapping.put("bruise", "Orthopedics");
        return Collections.unmodifiableMap(mapping);
    }

    private static Map<String, List<String>> buildSpecialtyDoctors() {
        Map<String, List<String>> doctors = new LinkedHashMap<>();
        doctors.put("Emergency Specialist", List.of("Dr. Firas Ben Hmida", "Dr. Amal Saidi", "Dr. Karim Chatti"));
        doctors.put("General Care", List.of("Dr. Nesrine Ayari", "Dr. Firas Ben Hmida", "Dr. Amal Saidi"));
        doctors.put("Orthopedics", List.of("Dr. Anis Bouaziz", "Dr. Seif Eddine Karray", "Dr. Wafa Cherif"));
        doctors.put("Cardiology", List.of("Dr. Walid Trabelsi", "Dr. Mouna Khelifi", "Dr. Hichem Ben Ammar"));
        doctors.put("Pulmonology", List.of("Dr. Firas Ben Hmida", "Dr. Karim Chatti", "Dr. Amal Saidi"));
        doctors.put("Ophthalmology", List.of("Dr. Ines Ghannouchi", "Dr. Nizar Toumi", "Dr. Marwa Ben Naceur"));
        doctors.put("Neurology", List.of("Dr. Olfa Ben Othman", "Dr. Kais Hamza", "Dr. Souhir Belhaj"));
        return Collections.unmodifiableMap(doctors);
    }

    private static Map<String, String[]> buildSymptomProductHints() {
        Map<String, String[]> hints = new LinkedHashMap<>();
        hints.put("heart attack", new String[]{"aspirin", "omega", "magnesium"});
        hints.put("stroke", new String[]{"aspirin", "omega", "magnesium"});
        hints.put("heavy bleeding", new String[]{"betadine", "bandage", "steri-strip"});
        hints.put("fever", new String[]{"paracetamol", "doliprane", "panado"});
        hints.put("fracture", new String[]{"bandage", "arnica", "compeed"});
        hints.put("chest pain", new String[]{"aspirin", "paracetamol", "nurofen"});
        hints.put("difficulty breathing", new String[]{"vicks", "sinutab", "humer", "physiomer"});
        hints.put("blurred vision", new String[]{"eye drops", "optive", "artelac"});
        hints.put("headache", new String[]{"paracetamol", "doliprane", "panado", "nurofen"});
        hints.put("cough", new String[]{"syrup", "strepsils", "vicks", "bronchostop"});
        hints.put("sore throat", new String[]{"strepsils", "hexaspray", "lozenges"});
        hints.put("bruise", new String[]{"arnica", "betadine", "bandage"});
        return Collections.unmodifiableMap(hints);
    }

    public record RiskAssessment(
            String riskLevel,
            int severityScore,
            String suggestedSpecialty,
            String suggestedDoctor,
            List<String> suggestedProducts,
            List<String> matchedKeywords,
            String summary
    ) {
    }
}
