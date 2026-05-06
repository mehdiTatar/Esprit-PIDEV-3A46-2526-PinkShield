package tn.esprit.services;

/** Simple keyword-based fallback when OpenAI is not configured. */
public class LocalChatbotService {

    public String getResponse(String message) {
        if (message == null || message.isBlank()) return "How can I help you?";
        String m = message.toLowerCase();
        if (m.contains("appointment")) return "You can manage your appointments from the Appointment section in the sidebar.";
        if (m.contains("profile"))     return "Go to Profile Edit in the sidebar to update your personal information.";
        if (m.contains("blog"))        return "Head to the Blog section to read and comment on health articles.";
        if (m.contains("password"))    return "Update your password from the Profile Edit section.";
        if (m.contains("pharmacy") || m.contains("pharma") || m.contains("product"))
            return "Browse health products in the Parapharmacy section.";
        if (m.contains("track") || m.contains("check-in") || m.contains("daily"))
            return "Record your daily health metrics in the Daily Check In section.";
        if (m.contains("logout") || m.contains("sign out"))
            return "Use the Logout button at the bottom of the sidebar to sign out.";
        return "I'm the PinkShield built-in assistant. For AI-powered responses, configure your OpenAI API key in openai.properties.";
    }
}
