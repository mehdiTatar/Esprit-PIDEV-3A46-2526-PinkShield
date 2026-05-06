package tn.esprit.services;

import tn.esprit.entities.Parapharmacy;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
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

    public String analyzeRisk(String patientInput) throws Exception {
        String apiKey = System.getenv("GEMINI_API_KEY");
        if (apiKey == null || apiKey.isBlank()) {
            throw new IllegalStateException("GEMINI_API_KEY environment variable is not set.");
        }

        String endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key="
                + apiKey.trim();
        String prompt = """
                You are a medical risk triage assistant for the PinkShield Java medical application.
                Analyze the patient's symptoms and return STRICTLY a JSON object with exactly these fields:
                urgency_level: one of URGENT, NORMAL, LOW
                recommended_doctor_specialty: the best medical specialty for the patient
                suggested_parapharmacy_items: an array of exactly 3 practical parapharmacy item names
                Do not include markdown, explanations, comments, or any text outside the JSON object.

                Patient input:
                %s
                """.formatted(patientInput == null ? "" : patientInput);

        String requestBody = """
                {
                  "contents": [
                    {
                      "parts": [
                        {
                          "text": "%s"
                        }
                      ]
                    }
                  ],
                  "generationConfig": {
                    "responseMimeType": "application/json"
                  }
                }
                """.formatted(escapeJson(prompt));

        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(endpoint))
                .header("Content-Type", "application/json")
                .POST(HttpRequest.BodyPublishers.ofString(requestBody))
                .build();

        HttpClient client = HttpClient.newHttpClient();
        HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());

        if (response.statusCode() < 200 || response.statusCode() >= 300) {
            throw new RuntimeException("Gemini API request failed with status " + response.statusCode() + ": " + response.body());
        }

        return response.body();
    }

    public RiskAssessment analyze(String patientNotes) {
        String notes = normalizeNotes(patientNotes);
        int severityScore = 0;
        List<String> matchedKeywords = new ArrayList<>();

        for (Map.Entry<String, Integer> entry : KEYWORD_WEIGHTS.entrySet()) {
            if (notes.contains(entry.getKey())) {
                severityScore += entry.getValue();
                matchedKeywords.add(entry.getKey());
            }
        }

        severityScore += applyContextRules(notes, matchedKeywords);

        String riskLevel;
        String suggestedSpecialty;
        String summary;

        if (severityScore >= 100) {
            riskLevel = "EXTREME";
            suggestedSpecialty = detectSpecialty(notes);
            if (!List.of("Cardiology", "Neurology", "Pulmonology", "Orthopedics", "Ophthalmology").contains(suggestedSpecialty)) {
                suggestedSpecialty = "Emergency Specialist";
            }
            summary = buildSummary(notes, "EXTREME");
        } else if (severityScore >= 50) {
            riskLevel = "MODERATE";
            suggestedSpecialty = detectSpecialty(notes);
            summary = buildSummary(notes, "MODERATE");
        } else {
            riskLevel = "LOW";
            suggestedSpecialty = detectSpecialty(notes);
            if ("Emergency Specialist".equals(suggestedSpecialty)) {
                suggestedSpecialty = "General Care";
            }
            summary = buildSummary(notes, "LOW");
        }

        List<String> suggestedProducts = recommendProducts(notes, suggestedSpecialty, 3);
        if (suggestedProducts.isEmpty()) {
            suggestedProducts = List.of("Doliprane 500mg", "Vitamin C 1000mg", "Hand Sanitizer Gel");
        }

        return new RiskAssessment(
                riskLevel,
                severityScore,
                suggestedSpecialty,
                pickRandomDoctor(suggestedSpecialty),
                suggestedProducts,
                uniqueKeywords(matchedKeywords),
                summary
        );
    }

    private String normalizeNotes(String patientNotes) {
        return (" " + safe(patientNotes).toLowerCase(Locale.ROOT) + " ")
                .replaceAll("[^a-z0-9+ ]", " ")
                .replaceAll("\\s+", " ");
    }

    private int applyContextRules(String notes, List<String> matchedKeywords) {
        int score = 0;

        if (containsAny(notes, "hit by a car", "car hit me", "hit by truck", "hit by bus", "hit by motorcycle", "car accident", "road accident", "traffic accident",
                "run over", "motorcycle accident", "bike accident", "fell from height", "violent fall")) {
            score += 120;
            matchedKeywords.add("major trauma mechanism");
        }
        if (containsAny(notes, "cant breathe", "can t breathe", "cannot breathe", "struggling to breathe", "blue lips",
                "severe shortness of breath", "wheezing badly")) {
            score += 110;
            matchedKeywords.add("breathing red flag");
        }
        if (containsAny(notes, "lost consciousness", "passed out", "fainted", "confused", "seizure",
                "cannot wake", "dizzy after head injury")) {
            score += 100;
            matchedKeywords.add("neurological red flag");
        }
        if (containsAny(notes, "head injury", "hit my head", "head trauma") && containsAny(notes, "vomiting", "confused", "dizzy", "sleepy", "bleeding")) {
            score += 100;
            matchedKeywords.add("head injury with red flags");
        }
        if (containsAny(notes, "deep cut", "open wound", "bleeding a lot", "wont stop bleeding", "blood everywhere")) {
            score += 95;
            matchedKeywords.add("serious bleeding");
        }
        if (containsAny(notes, "chest pain", "pressure in chest", "crushing chest", "pain left arm")
                && containsAny(notes, "sweating", "nausea", "shortness of breath", "dizzy")) {
            score += 100;
            matchedKeywords.add("cardiac red flag cluster");
        }
        if (containsAny(notes, "weakness one side", "face drooping", "slurred speech", "cannot speak", "sudden numbness")) {
            score += 120;
            matchedKeywords.add("stroke warning signs");
        }
        if (containsAny(notes, "fracture", "broken bone", "bone sticking", "cant move", "cannot move", "deformed")
                || containsAny(notes, "swollen ankle", "swollen wrist", "severe swelling")) {
            score += 60;
            matchedKeywords.add("possible fracture or severe sprain");
        }
        if (containsAny(notes, "high fever", "fever 40", "fever 39", "stiff neck", "purple rash")) {
            score += 75;
            matchedKeywords.add("infection red flag");
        }
        if (containsAny(notes, "eye injury", "chemical in eye", "loss of vision", "cant see", "cannot see")) {
            score += 85;
            matchedKeywords.add("eye red flag");
        }
        if (containsAny(notes, "pregnant") && containsAny(notes, "bleeding", "severe pain", "faint", "dizzy")) {
            score += 110;
            matchedKeywords.add("pregnancy red flag");
        }
        if (containsAny(notes, "child", "baby", "infant") && containsAny(notes, "not breathing", "blue", "very sleepy", "seizure", "high fever")) {
            score += 110;
            matchedKeywords.add("pediatric red flag");
        }

        return score;
    }

    private boolean containsAny(String notes, String... phrases) {
        for (String phrase : phrases) {
            if (notes.contains(" " + phrase + " ") || notes.contains(phrase)) {
                return true;
            }
        }
        return false;
    }

    private String buildSummary(String notes, String riskLevel) {
        if ("EXTREME".equals(riskLevel)) {
            if (containsAny(notes, "hit by a car", "car hit me", "hit by truck", "hit by bus", "car accident", "road accident", "run over", "traffic accident")) {
                return "Major accident trauma can hide internal bleeding, head injury, fracture, or shock. Emergency evaluation is recommended immediately.";
            }
            if (containsAny(notes, "cant breathe", "can t breathe", "cannot breathe", "chest pain", "stroke", "slurred speech", "weakness one side")) {
                return "These symptoms include serious red flags. Urgent medical assessment is recommended immediately.";
            }
            return "The symptoms include emergency warning signs. Immediate medical care is recommended.";
        }
        if ("MODERATE".equals(riskLevel)) {
            return "The symptoms need prompt medical review, especially if they worsen, persist, or include pain, fever, swelling, or breathing discomfort.";
        }
        return "The symptoms look lower risk right now. Monitor closely, rest, hydrate, and book general care if symptoms persist or worsen.";
    }

    private String detectSpecialty(String notes) {
        if (containsAny(notes, "hit by a car", "car hit me", "hit by truck", "hit by bus", "car accident", "road accident", "traffic accident",
                "run over", "fracture", "broken bone", "severe swelling", "deformed")) {
            return "Orthopedics";
        }
        if (containsAny(notes, "head injury", "hit my head", "stroke", "seizure", "slurred speech", "weakness one side",
                "sudden numbness", "passed out", "lost consciousness")) {
            return "Neurology";
        }
        if (containsAny(notes, "chest pain", "heart attack", "pressure in chest", "pain left arm", "palpitations")) {
            return "Cardiology";
        }
        if (containsAny(notes, "difficulty breathing", "shortness of breath", "cant breathe", "can t breathe", "cannot breathe", "wheezing")) {
            return "Pulmonology";
        }
        if (containsAny(notes, "eye injury", "chemical in eye", "blurred vision", "loss of vision", "cant see")) {
            return "Ophthalmology";
        }
        for (Map.Entry<String, String> entry : SYMPTOM_TO_SPECIALTY.entrySet()) {
            if (notes.contains(entry.getKey())) {
                return entry.getValue();
            }
        }
        return "General Care";
    }

    private String pickRandomDoctor(String specialty) {
        List<String> doctors = SPECIALTY_DOCTORS.getOrDefault(specialty, SPECIALTY_DOCTORS.get("General Care"));
        if (doctors == null || doctors.isEmpty()) {
            return "Dr. Firas Ben Hmida";
        }
        return doctors.get(ThreadLocalRandom.current().nextInt(doctors.size()));
    }

    private List<String> recommendProducts(String notes, String specialty, int limit) {
        LinkedHashSet<String> matches = new LinkedHashSet<>();

        addMatchingProducts(matches, ParapharmacyCatalog.getSeedProducts(), notes, specialty, limit);
        if (matches.size() < limit) {
            addMatchingProducts(matches, loadProductsFromDatabase(), notes, specialty, limit);
        }

        return new ArrayList<>(matches).subList(0, Math.min(limit, matches.size()));
    }

    private List<Parapharmacy> loadProductsFromDatabase() {
        try {
            return new ParapharmacyService().getAllProducts();
        } catch (Exception ignored) {
            return List.of();
        }
    }

    private void addMatchingProducts(LinkedHashSet<String> matches, List<Parapharmacy> products, String notes, String specialty, int limit) {
        for (Parapharmacy product : products) {
            if (product == null || product.getName() == null || product.getName().isBlank()) {
                continue;
            }
            String searchable = (product.getName() + " "
                    + safe(product.getDescription()) + " "
                    + safe(product.getCategory())).toLowerCase(Locale.ROOT);
            if (matchesAnyHints(notes, specialty, searchable)) {
                matches.add(product.getName());
            }
            if (matches.size() >= limit) {
                return;
            }
        }
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
            case "emergency specialist" -> new String[]{"betadine", "bandage", "steri-strip", "first aid"};
            case "cardiology" -> new String[]{"aspirin", "omega", "magnesium"};
            case "neurology" -> new String[]{"doliprane", "paracetamol", "nurofen", "pain relief"};
            case "orthopedics" -> new String[]{"arnica", "bandage", "first aid"};
            case "pulmonology" -> new String[]{"syrup", "strepsils", "vicks", "humer", "respiratory"};
            case "ophthalmology" -> new String[]{"eye drops", "optive", "eye care"};
            case "dermatology" -> new String[]{"cicaplast", "cream", "dermatology", "anti-itch"};
            case "pediatrics" -> new String[]{"baby", "mustela", "pampers"};
            default -> new String[]{"doliprane", "vitamin", "hygiene"};
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

    private String safe(String value) {
        return value == null ? "" : value;
    }

    private String escapeJson(String value) {
        if (value == null) {
            return "";
        }
        return value.replace("\\", "\\\\")
                .replace("\"", "\\\"")
                .replace("\n", "\\n")
                .replace("\r", "\\r")
                .replace("\t", "\\t");
    }

    private static Map<String, Integer> buildKeywordWeights() {
        Map<String, Integer> weights = new LinkedHashMap<>();
        weights.put("heart attack", 100);
        weights.put("car crash", 100);
        weights.put("hit by a car", 100);
        weights.put("car hit me", 100);
        weights.put("hit by truck", 100);
        weights.put("hit by bus", 100);
        weights.put("hit by motorcycle", 100);
        weights.put("car accident", 100);
        weights.put("road accident", 100);
        weights.put("run over", 100);
        weights.put("unconscious", 100);
        weights.put("lost consciousness", 100);
        weights.put("passed out", 100);
        weights.put("stroke", 100);
        weights.put("heavy bleeding", 100);
        weights.put("severe bleeding", 100);
        weights.put("fever", 50);
        weights.put("fracture", 50);
        weights.put("broken bone", 50);
        weights.put("head injury", 50);
        weights.put("chest pain", 50);
        weights.put("difficulty breathing", 50);
        weights.put("shortness of breath", 50);
        weights.put("cant breathe", 80);
        weights.put("can t breathe", 80);
        weights.put("cannot breathe", 80);
        weights.put("blurred vision", 50);
        weights.put("loss of vision", 80);
        weights.put("rash", 25);
        weights.put("vomiting", 25);
        weights.put("stomach pain", 25);
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
        mapping.put("severe bleeding", "Emergency Specialist");
        mapping.put("car crash", "Emergency Specialist");
        mapping.put("hit by a car", "Orthopedics");
        mapping.put("car hit me", "Orthopedics");
        mapping.put("hit by truck", "Orthopedics");
        mapping.put("hit by bus", "Orthopedics");
        mapping.put("hit by motorcycle", "Orthopedics");
        mapping.put("car accident", "Orthopedics");
        mapping.put("road accident", "Orthopedics");
        mapping.put("run over", "Orthopedics");
        mapping.put("unconscious", "Emergency Specialist");
        mapping.put("lost consciousness", "Neurology");
        mapping.put("passed out", "Neurology");
        mapping.put("head injury", "Neurology");
        mapping.put("fracture", "Orthopedics");
        mapping.put("broken bone", "Orthopedics");
        mapping.put("chest pain", "Cardiology");
        mapping.put("difficulty breathing", "Pulmonology");
        mapping.put("shortness of breath", "Pulmonology");
        mapping.put("cant breathe", "Pulmonology");
        mapping.put("can t breathe", "Pulmonology");
        mapping.put("cannot breathe", "Pulmonology");
        mapping.put("blurred vision", "Ophthalmology");
        mapping.put("loss of vision", "Ophthalmology");
        mapping.put("headache", "Neurology");
        mapping.put("cough", "Pulmonology");
        mapping.put("rash", "Dermatology");
        mapping.put("bruise", "Orthopedics");
        mapping.put("baby", "Pediatrics");
        mapping.put("child", "Pediatrics");
        return Collections.unmodifiableMap(mapping);
    }

    private static Map<String, List<String>> buildSpecialtyDoctors() {
        Map<String, List<String>> doctors = new LinkedHashMap<>();
        doctors.put("Emergency Specialist", List.of("Dr. Sami Trabelsi", "Dr. Hela Ben Ahmed", "Dr. Yassine Mejri", "Dr. Karim Chatti"));
        doctors.put("General Care", List.of("Dr. Nesrine Ayari", "Dr. Firas Ben Hmida", "Dr. Amal Saidi", "Dr. Marwen Gharbi"));
        doctors.put("Orthopedics", List.of("Dr. Anis Bouaziz", "Dr. Seif Eddine Karray", "Dr. Wafa Cherif", "Dr. Slim Ben Salah"));
        doctors.put("Cardiology", List.of("Dr. Walid Trabelsi", "Dr. Mouna Khelifi", "Dr. Hichem Ben Ammar", "Dr. Rym Haddad"));
        doctors.put("Pulmonology", List.of("Dr. Leila Jaziri", "Dr. Karim Chatti", "Dr. Salma Ben Romdhane", "Dr. Mourad Dhouib"));
        doctors.put("Ophthalmology", List.of("Dr. Ines Ghannouchi", "Dr. Nizar Toumi", "Dr. Marwa Ben Naceur", "Dr. Aymen Louati"));
        doctors.put("Neurology", List.of("Dr. Olfa Ben Othman", "Dr. Kais Hamza", "Dr. Souhir Belhaj", "Dr. Sami Kammoun"));
        doctors.put("Dermatology", List.of("Dr. Nour Baccouche", "Dr. Mehdi Jaziri", "Dr. Sarra Mzoughi", "Dr. Lina Ferchichi"));
        doctors.put("Pediatrics", List.of("Dr. Amel Masmoudi", "Dr. Tarek Bouslama", "Dr. Mariem Zribi", "Dr. Oussama Chaker"));
        return Collections.unmodifiableMap(doctors);
    }

    private static Map<String, String[]> buildSymptomProductHints() {
        Map<String, String[]> hints = new LinkedHashMap<>();
        hints.put("heart attack", new String[]{"aspirin", "omega", "magnesium"});
        hints.put("stroke", new String[]{"aspirin", "omega", "magnesium"});
        hints.put("hit by a car", new String[]{"betadine", "bandage", "steri-strip", "arnica"});
        hints.put("car hit me", new String[]{"betadine", "bandage", "steri-strip", "arnica"});
        hints.put("hit by truck", new String[]{"betadine", "bandage", "steri-strip", "arnica"});
        hints.put("hit by bus", new String[]{"betadine", "bandage", "steri-strip", "arnica"});
        hints.put("hit by motorcycle", new String[]{"betadine", "bandage", "steri-strip", "arnica"});
        hints.put("car accident", new String[]{"betadine", "bandage", "steri-strip", "arnica"});
        hints.put("road accident", new String[]{"betadine", "bandage", "steri-strip", "arnica"});
        hints.put("run over", new String[]{"betadine", "bandage", "steri-strip", "arnica"});
        hints.put("heavy bleeding", new String[]{"betadine", "bandage", "steri-strip"});
        hints.put("severe bleeding", new String[]{"betadine", "bandage", "steri-strip"});
        hints.put("fever", new String[]{"doliprane", "paracetamol", "efferalgan"});
        hints.put("fracture", new String[]{"bandage", "arnica", "first aid"});
        hints.put("broken bone", new String[]{"bandage", "arnica", "first aid"});
        hints.put("head injury", new String[]{"betadine", "bandage", "first aid"});
        hints.put("chest pain", new String[]{"aspirin", "omega", "magnesium"});
        hints.put("difficulty breathing", new String[]{"vicks", "humer", "respiratory", "syrup"});
        hints.put("shortness of breath", new String[]{"vicks", "humer", "respiratory", "syrup"});
        hints.put("cant breathe", new String[]{"vicks", "humer", "respiratory", "syrup"});
        hints.put("can t breathe", new String[]{"vicks", "humer", "respiratory", "syrup"});
        hints.put("cannot breathe", new String[]{"vicks", "humer", "respiratory", "syrup"});
        hints.put("blurred vision", new String[]{"eye drops", "optive", "eye care"});
        hints.put("headache", new String[]{"doliprane", "paracetamol", "nurofen"});
        hints.put("cough", new String[]{"syrup", "strepsils", "vicks", "respiratory"});
        hints.put("sore throat", new String[]{"strepsils", "lozenges", "propolis"});
        hints.put("bruise", new String[]{"arnica", "betadine", "bandage"});
        hints.put("rash", new String[]{"cream", "cicaplast", "anti-itch", "dermatology"});
        hints.put("baby", new String[]{"baby", "mustela", "pampers"});
        hints.put("child", new String[]{"baby", "mustela", "pampers"});
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
