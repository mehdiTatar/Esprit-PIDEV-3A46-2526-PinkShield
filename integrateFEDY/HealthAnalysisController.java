package org.example;

import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.layout.VBox;

import java.util.List;

public class HealthAnalysisController {

    @FXML
    private TextArea notesArea;

    @FXML
    private VBox resultBox;

    @FXML
    private Label statusLabel;

    @FXML
    private Button analyzeButton;

    private final RiskAnalysisService riskAnalysisService = new RiskAnalysisService();

    @FXML
    public void initialize() {
        showEmptyState();
    }

    @FXML
    public void handleAnalyze() {
        String notes = notesArea == null ? "" : notesArea.getText().trim();
        if (notes.isEmpty()) {
            showEmptyState();
            return;
        }

        if (statusLabel != null) {
            statusLabel.setText("Analysis complete.");
            statusLabel.getStyleClass().setAll("label-subtitle");
        }

        if (analyzeButton != null) {
            analyzeButton.setDisable(true);
        }

        RiskAnalysisService.RiskAssessment analysis = riskAnalysisService.analyze(notes);
        renderReport(analysis);

        if (analyzeButton != null) {
            analyzeButton.setDisable(false);
        }
    }

    @FXML
    public void handleBackToWishlist() {
        NavigationManager.getInstance().showWishlist();
    }

    private void renderReport(RiskAnalysisService.RiskAssessment analysis) {
        if (resultBox == null) {
            return;
        }

        resultBox.getChildren().clear();
        resultBox.getStyleClass().setAll("risk-analysis-card");
        resultBox.getStyleClass().add(reportClassFor(analysis.riskLevel()));

        resultBox.getChildren().add(sectionTitle("Medical Report"));
        resultBox.getChildren().add(keyValue("Risk Level", analysis.riskLevel(), riskLevelClassFor(analysis.riskLevel())));
        resultBox.getChildren().add(keyValue("Severity Score", String.valueOf(analysis.severityScore()), "risk-analysis-summary"));
        resultBox.getChildren().add(keyValue("Recommended Specialist", analysis.suggestedSpecialty() + " - " + analysis.suggestedDoctor(), "risk-analysis-summary"));
        resultBox.getChildren().add(keyValue("Orientation", analysis.summary(), "risk-analysis-summary"));

        List<String> products = analysis.suggestedProducts();
        if (products != null && !products.isEmpty()) {
            resultBox.getChildren().add(sectionTitle("Suggested Products"));
            for (String product : products) {
                resultBox.getChildren().add(keyValue("•", product, "risk-analysis-signals"));
            }
        }

        List<String> keywords = analysis.matchedKeywords();
        if (keywords != null && !keywords.isEmpty()) {
            resultBox.getChildren().add(keyValue("Matched Keywords", String.join(", ", keywords), "risk-analysis-signals"));
        }
    }

    private void showEmptyState() {
        if (resultBox == null) {
            return;
        }
        resultBox.getChildren().clear();
        resultBox.getStyleClass().setAll("risk-analysis-card");
        resultBox.getChildren().add(sectionTitle("Medical Report"));
        resultBox.getChildren().add(keyValue("Status", "Enter patient symptoms or notes, then click Analyse.", "label-subtitle"));
        if (statusLabel != null) {
            statusLabel.setText("Ready to scan.");
            statusLabel.getStyleClass().setAll("label-subtitle");
        }
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

