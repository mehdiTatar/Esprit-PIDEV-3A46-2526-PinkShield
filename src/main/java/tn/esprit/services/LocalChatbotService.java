package tn.esprit.services;

import java.util.List;
import java.util.Map;
import java.util.concurrent.ThreadLocalRandom;

public class LocalChatbotService {
    private final Map<String, KnowledgeCategory> knowledgeBase = Map.ofEntries(
            Map.entry("greetings", new KnowledgeCategory(
                    List.of("hello", "hi", "hey", "bonjour", "salut", "good morning", "good evening", "howdy", "yo", "greetings"),
                    List.of(
                            "Hello. I am PinkShield Assistant. I can help with appointments, profile updates, daily tracking, blog access, and parapharmacy.",
                            "Hi. Ask me about appointments, health tips, or how to use PinkShield.",
                            "Welcome to PinkShield. I can guide you through the app and answer general wellness questions."
                    )
            )),
            Map.entry("appointments", new KnowledgeCategory(
                    List.of("appointment", "book", "booking", "schedule", "rendez-vous", "reserve", "visit", "consultation", "meet doctor"),
                    List.of(
                            "To book an appointment, open the Appointments section from the left sidebar, choose a doctor and a time slot, then confirm.",
                            "Go to Appointments in the sidebar, select your specialist, choose an available slot, and submit the booking."
                    )
            )),
            Map.entry("doctors", new KnowledgeCategory(
                    List.of("doctor", "physician", "specialist", "medecin", "docteur", "cardiologist", "dermatologist", "find doctor", "who treats"),
                    List.of(
                            "You can browse available doctors from the Appointments section. Each booking flow shows the doctor's specialty and availability.",
                            "Open Appointments to view available specialists and choose the right doctor for your consultation."
                    )
            )),
            Map.entry("profile", new KnowledgeCategory(
                    List.of("profile", "account", "settings", "update info", "change email", "edit profile", "my info", "address", "phone"),
                    List.of(
                            "To update your account details, open Profile Edit in the left sidebar. You can change your full name, email, phone number, and address there.",
                            "Use the Profile Edit page from the sidebar to update your personal and contact information."
                    )
            )),
            Map.entry("blog", new KnowledgeCategory(
                    List.of("blog", "article", "news", "health tips", "read", "post", "health news"),
                    List.of(
                            "Use the Blog section in the sidebar to read health articles and wellness content.",
                            "The Blog page contains health resources and informative articles."
                    )
            )),
            Map.entry("products", new KnowledgeCategory(
                    List.of("product", "products", "parapharmacy", "parapharmacie", "pharmacy", "shop", "item"),
                    List.of(
                            "Open Parapharmacie in the sidebar to browse available wellness and care products.",
                            "The Parapharmacie page lets you explore products related to care and wellness."
                    )
            )),
            Map.entry("daily_tracking", new KnowledgeCategory(
                    List.of("daily check in", "check in", "daily tracking", "tracking", "mood", "sleep", "stress", "daily"),
                    List.of(
                            "Open Daily Check In from the sidebar to track mood, sleep, stress, and other daily health indicators.",
                            "The Daily Check In page helps you record daily wellness data and review your personal trends."
                    )
            )),
            Map.entry("auth", new KnowledgeCategory(
                    List.of("password", "forgot password", "login", "sign in", "log in", "reset password", "cant login", "access", "locked out"),
                    List.of(
                            "If you forgot your password, use the Forgot password flow on the login page. PinkShield sends a verification code by email before the password reset.",
                            "For password reset, go to the login page and use Forgot password to receive a verification code."
                    )
            )),
            Map.entry("register", new KnowledgeCategory(
                    List.of("register", "sign up", "create account", "new account", "inscription", "join"),
                    List.of(
                            "To create a patient account, use the Register option on the login page and fill in the required information.",
                            "Registration starts from the login page. Choose patient registration and complete the form."
                    )
            )),
            Map.entry("about", new KnowledgeCategory(
                    List.of("what is pinkshield", "about", "platform", "pinkshield", "who are you", "what can you do", "features", "services"),
                    List.of(
                            "PinkShield is a healthcare management platform for appointments, patient profiles, daily tracking, blog resources, parapharmacy access, email reset, and face-based login.",
                            "PinkShield connects patients with healthcare services through booking, daily wellness tracking, profile management, and information tools."
                    )
            )),
            Map.entry("nutrition", new KnowledgeCategory(
                    List.of("nutrition", "diet", "food", "eat", "eating", "meal", "calories", "weight", "vegetable", "fruit", "protein", "vitamin"),
                    List.of(
                            "Basic nutrition guidance: eat balanced meals, include vegetables and fruit, choose lean proteins, limit processed foods, and stay hydrated.",
                            "A balanced diet usually includes vegetables, fruits, whole grains, lean proteins, and enough water through the day."
                    )
            )),
            Map.entry("sleep", new KnowledgeCategory(
                    List.of("sleep", "insomnia", "tired", "fatigue", "rest", "nap", "bedtime", "wake up", "sleep quality"),
                    List.of(
                            "For better sleep, keep a consistent schedule, reduce late caffeine, avoid screens before bed, and maintain a calm bedroom environment.",
                            "Sleep quality improves with regular hours, less screen exposure before bed, and a quiet, comfortable room."
                    )
            )),
            Map.entry("stress", new KnowledgeCategory(
                    List.of("stress", "anxiety", "anxious", "worried", "overwhelmed", "burnout", "mental health", "panic", "nervous"),
                    List.of(
                            "For stress management, try breathing exercises, short walks, hydration, and regular sleep. For persistent symptoms, talk to a qualified healthcare professional.",
                            "Stress can be reduced with rest, movement, breathing exercises, and support from someone you trust. Persistent symptoms should be discussed with a healthcare professional."
                    )
            )),
            Map.entry("heart", new KnowledgeCategory(
                    List.of("heart", "cardiac", "cardiology", "blood pressure", "hypertension", "cholesterol", "chest pain", "palpitation", "cardiovascular"),
                    List.of(
                            "Heart health questions should be discussed with a professional. If there is chest pain, shortness of breath, or palpitations, seek medical care promptly.",
                            "Monitor blood pressure and general cardiovascular health regularly. Urgent symptoms like chest pain require direct medical attention."
                    )
            )),
            Map.entry("pain", new KnowledgeCategory(
                    List.of("headache", "migraine", "pain", "ache", "back pain", "joint pain", "fever", "temperature", "nausea", "vomiting", "dizzy", "dizziness"),
                    List.of(
                            "For persistent or severe pain, see a healthcare professional. For mild symptoms, rest, hydration, and basic self-care can help.",
                            "Pain can have many causes. If symptoms are severe, sudden, or persistent, book an appointment for proper evaluation."
                    )
            )),
            Map.entry("help", new KnowledgeCategory(
                    List.of("help", "what can you do", "commands", "topics", "questions", "assist", "support", "guide"),
                    List.of(
                            "I can help with appointments, doctors, profile editing, daily check-ins, parapharmacy, blog access, password reset, and general wellness topics.",
                            "Ask me about booking, profile changes, daily tracking, products, blog content, or general wellness guidance."
                    )
            )),
            Map.entry("thanks", new KnowledgeCategory(
                    List.of("thank", "thanks", "thank you", "merci", "thx", "ty", "appreciate", "great", "perfect", "awesome", "wonderful"),
                    List.of(
                            "You are welcome. Ask if you need anything else in PinkShield.",
                            "Glad to help. Send another question if you need more guidance."
                    )
            )),
            Map.entry("goodbye", new KnowledgeCategory(
                    List.of("bye", "goodbye", "see you", "later", "ciao", "au revoir", "take care", "exit"),
                    List.of(
                            "Goodbye. Take care.",
                            "See you later. You can reopen the assistant anytime."
                    )
            ))
    );

    private final List<String> fallbackResponses = List.of(
            "I did not fully understand that. Ask me about appointments, daily tracking, profile editing, blog access, parapharmacy, or general wellness.",
            "I can help best with PinkShield features and general health topics. Try asking about appointments, profile updates, or daily check-ins.",
            "Please rephrase your question. I am most useful for PinkShield navigation, account help, and broad wellness guidance."
    );

    public String getResponse(String userMessage) {
        String message = userMessage == null ? "" : userMessage.trim().toLowerCase();
        if (message.isBlank()) {
            return "Type a question first.";
        }

        String cleaned = message.replaceAll("[^\\p{L}\\p{Nd}\\s]", " ").replaceAll("\\s+", " ").trim();
        KnowledgeCategory bestMatch = null;
        int bestScore = 0;

        for (KnowledgeCategory category : knowledgeBase.values()) {
            int score = calculateScore(cleaned, category.keywords());
            if (score > bestScore) {
                bestScore = score;
                bestMatch = category;
            }
        }

        if (bestMatch != null && bestScore >= 1) {
            return pick(bestMatch.responses());
        }

        return pick(fallbackResponses);
    }

    private int calculateScore(String message, List<String> keywords) {
        int score = 0;
        for (String keyword : keywords) {
            if (message.contains(keyword)) {
                score += keyword.contains(" ") ? 3 : 1;
            }
        }
        return score;
    }

    private String pick(List<String> responses) {
        int index = ThreadLocalRandom.current().nextInt(responses.size());
        return responses.get(index);
    }

    private record KnowledgeCategory(List<String> keywords, List<String> responses) {
    }
}
