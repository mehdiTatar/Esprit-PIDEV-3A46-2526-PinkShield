package org.example;

import javafx.fxml.FXML;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.layout.VBox;

import java.util.List;

/**
 * RiskAnalyserUserController - User-specific implementation of the Risk Analyzer
 * Extends HealthAnalysisController to provide risk assessment functionality for patients
 */
public class RiskAnalyserUserController extends HealthAnalysisController {

    @FXML
    private TextArea notesArea;

    @FXML
    private VBox resultBox;

    @FXML
    private Label statusLabel;

    @FXML
    private Button analyzeButton;

    private final RiskAnalysisService riskAnalysisService = new RiskAnalysisService();

    /**
     * Initialize the Risk Analyzer user interface
     */
    @FXML
    @Override
    public void initialize() {
        super.initialize();
        showEmptyState();
    }

    /**
     * Handle the analyze button click - analyze patient symptoms
     */
    @FXML
    @Override
    public void handleAnalyze() {
        String notes = notesArea == null ? "" : notesArea.getText().trim();
        if (notes.isEmpty()) {
            showEmptyState();
            return;
        }

        updateStatus("Analysis complete.");

        if (analyzeButton != null) {
            analyzeButton.setDisable(true);
        }

        try {
            RiskAnalysisService.RiskAssessment analysis = riskAnalysisService.analyze(notes);
            renderReport(analysis);
        } catch (Exception e) {
            showError("Analysis failed: " + e.getMessage());
        } finally {
            if (analyzeButton != null) {
                analyzeButton.setDisable(false);
            }
        }
    }

    /**
     * Clear the notes area
     */
    @FXML
    public void clearNotes() {
        if (notesArea != null) {
            notesArea.clear();
        }
        showEmptyState();
    }

    /**
     * Render the risk assessment report in the UI
     */
    private void renderReport(RiskAnalysisService.RiskAssessment analysis) {
        if (resultBox == null) {
            return;
        }

        resultBox.getChildren().clear();
        resultBox.getStyleClass().setAll("risk-analysis-card");
        resultBox.getStyleClass().add(reportClassFor(analysis.riskLevel()));

        resultBox.getChildren().add(sectionTitle("Medical Risk Assessment Report"));
        resultBox.getChildren().add(keyValue("Risk Level", analysis.riskLevel(), riskLevelClassFor(analysis.riskLevel())));
        resultBox.getChildren().add(keyValue("Severity Score", String.valueOf(analysis.severityScore()) + "/100", "risk-analysis-summary"));
        resultBox.getChildren().add(keyValue("Recommended Specialist", analysis.suggestedSpecialty() + " - " + analysis.suggestedDoctor(), "risk-analysis-summary"));
        resultBox.getChildren().add(keyValue("Assessment", analysis.summary(), "risk-analysis-summary"));

        List<String> products = analysis.suggestedProducts();
        if (products != null && !products.isEmpty()) {
            resultBox.getChildren().add(sectionTitle("Suggested Medicines & Products"));
            for (String product : products) {
                resultBox.getChildren().add(keyValue("💊", product, "risk-analysis-signals"));
            }
        }

        List<String> keywords = analysis.matchedKeywords();
        if (keywords != null && !keywords.isEmpty()) {
            resultBox.getChildren().add(keyValue("Identified Symptoms", String.join(", ", keywords), "risk-analysis-signals"));
        }
    }

    /**
     * Show empty state message
     */
    private void showEmptyState() {
        if (resultBox == null) {
            return;
        }
        resultBox.getChildren().clear();
        resultBox.getStyleClass().setAll("risk-analysis-card");
        resultBox.getChildren().add(sectionTitle("Medical Risk Assessment"));
        resultBox.getChildren().add(keyValue("Status", "Enter patient symptoms or medical notes, then click 'Analyse' to evaluate risk level.", "label-subtitle"));
        if (statusLabel != null) {
            statusLabel.setText("Ready to scan.");
            statusLabel.getStyleClass().setAll("label-subtitle");
        }
    }

    private void updateStatus(String message) {
        if (statusLabel != null) {
            statusLabel.setText(message);
            statusLabel.getStyleClass().setAll("label-subtitle");
        }
    }

    private void showError(String errorMessage) {
        if (statusLabel != null) {
            statusLabel.setText("Error: " + errorMessage);
            statusLabel.getStyleClass().setAll("label-error");
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
