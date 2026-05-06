package tn.esprit.controllers;

import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.layout.VBox;
import tn.esprit.entities.User;
import tn.esprit.services.RiskAnalysisService;

import java.util.List;

public class RiskAnalyserController {
    @FXML private TextArea notesArea;
    @FXML private VBox resultBox;
    @FXML private Label statusLabel;
    @FXML private Button analyzeButton;

    private final RiskAnalysisService riskAnalysisService = new RiskAnalysisService();
    private User currentUser;

    @FXML
    public void initialize() {
        showEmptyState();
    }

    public void setCurrentUser(User user) {
        currentUser = user;
    }

    @FXML
    public void handleAnalyze() {
        String notes = notesArea == null ? "" : notesArea.getText().trim();
        if (notes.isEmpty()) {
            setStatus("Write the symptoms first, then run the analysis.", true);
            showEmptyState();
            return;
        }

        if (analyzeButton != null) {
            analyzeButton.setDisable(true);
        }

        RiskAnalysisService.RiskAssessment analysis = riskAnalysisService.analyze(notes);
        renderReport(analysis);
        setStatus("Analysis complete for " + patientName() + ".", false);

        if (analyzeButton != null) {
            analyzeButton.setDisable(false);
        }
    }

    private void renderReport(RiskAnalysisService.RiskAssessment analysis) {
        if (resultBox == null) {
            return;
        }

        resultBox.getChildren().clear();
        resultBox.getStyleClass().setAll("risk-analysis-card", reportClassFor(analysis.riskLevel()));

        resultBox.getChildren().add(sectionTitle("Medical Report"));
        resultBox.getChildren().add(keyValue("Risk Level", analysis.riskLevel(), riskLevelClassFor(analysis.riskLevel())));
        resultBox.getChildren().add(keyValue("Severity Score", String.valueOf(analysis.severityScore()), "risk-analysis-summary"));
        resultBox.getChildren().add(keyValue("Recommended Specialist", analysis.suggestedSpecialty(), "risk-analysis-summary"));
        resultBox.getChildren().add(keyValue("Suggested Doctor", analysis.suggestedDoctor(), "risk-analysis-summary"));
        resultBox.getChildren().add(keyValue("Orientation", analysis.summary(), "risk-analysis-summary"));

        List<String> products = analysis.suggestedProducts();
        if (products != null && !products.isEmpty()) {
            resultBox.getChildren().add(sectionTitle("Parapharmacy Suggestions"));
            for (String product : products) {
                resultBox.getChildren().add(keyValue("-", product, "risk-analysis-signals"));
            }
        }

        List<String> keywords = analysis.matchedKeywords();
        if (keywords != null && !keywords.isEmpty()) {
            resultBox.getChildren().add(keyValue("Matched Symptoms", String.join(", ", keywords), "risk-analysis-signals"));
        }
    }

    private void showEmptyState() {
        if (resultBox == null) {
            return;
        }
        resultBox.getChildren().clear();
        resultBox.getStyleClass().setAll("risk-analysis-card");
        resultBox.getChildren().add(sectionTitle("Medical Report"));
        resultBox.getChildren().add(keyValue("Status", "Enter symptoms, then click Analyse Risk.", "risk-analysis-summary"));
        setStatus("Ready to scan symptoms.", false);
    }

    private String patientName() {
        if (currentUser == null || currentUser.getFullName() == null || currentUser.getFullName().isBlank()) {
            return "patient";
        }
        return currentUser.getFullName().trim();
    }

    private void setStatus(String message, boolean error) {
        if (statusLabel == null) {
            return;
        }
        statusLabel.setText(message);
        statusLabel.getStyleClass().setAll(error ? "feedback-label" : "dashboard-copy");
    }

    private Label sectionTitle(String text) {
        Label label = new Label(text);
        label.setWrapText(true);
        label.getStyleClass().add("risk-report-title");
        return label;
    }

    private Label keyValue(String labelText, String value, String styleClass) {
        Label label = new Label(labelText + ": " + value);
        label.setWrapText(true);
        label.getStyleClass().add(styleClass);
        return label;
    }

    private String reportClassFor(String riskLevel) {
        return switch (riskLevel == null ? "LOW" : riskLevel.toUpperCase()) {
            case "EXTREME" -> "risk-extreme";
            case "MODERATE" -> "risk-moderate";
            default -> "risk-low";
        };
    }

    private String riskLevelClassFor(String riskLevel) {
        return switch (riskLevel == null ? "LOW" : riskLevel.toUpperCase()) {
            case "EXTREME" -> "risk-level-extreme";
            case "MODERATE" -> "risk-level-moderate";
            default -> "risk-level-low";
        };
    }
}
