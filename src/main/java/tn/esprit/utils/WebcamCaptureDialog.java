package tn.esprit.utils;

import com.github.sarxos.webcam.Webcam;
import com.github.sarxos.webcam.WebcamResolution;
import javafx.application.Platform;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.image.ImageView;
import javafx.scene.image.PixelFormat;
import javafx.scene.image.WritableImage;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Region;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.stage.Modality;
import javafx.stage.Stage;
import javafx.stage.Window;

import javax.imageio.ImageIO;
import java.awt.Dimension;
import java.awt.image.BufferedImage;
import java.io.IOException;
import java.nio.IntBuffer;
import java.nio.file.Files;
import java.nio.file.Path;
import java.util.Comparator;
import java.util.List;
import java.util.concurrent.Executors;
import java.util.concurrent.ScheduledExecutorService;
import java.util.concurrent.TimeUnit;
import java.util.concurrent.atomic.AtomicBoolean;
import java.util.concurrent.atomic.AtomicReference;

public final class WebcamCaptureDialog {
    private WebcamCaptureDialog() {
    }

    public static Path captureFaceImage(Window owner, Class<?> resourceBase, String title, String instructions) {
        Webcam webcam = selectPreferredWebcam();
        if (webcam == null) {
            showErrorDialog(owner, resourceBase, title, "No camera was detected on this device.");
            return null;
        }

        Dimension resolution = webcam.getViewSizes().length == 0
                ? WebcamResolution.VGA.getSize()
                : List.of(webcam.getViewSizes()).stream()
                .max(Comparator.comparingInt(size -> size.width * size.height))
                .orElse(WebcamResolution.VGA.getSize());
        webcam.setViewSize(resolution);

        Stage stage = new Stage();
        stage.initModality(Modality.WINDOW_MODAL);
        if (owner != null) {
            stage.initOwner(owner);
        }
        stage.setTitle(title);

        Label titleLabel = new Label(title);
        titleLabel.getStyleClass().add("section-title");

        Label instructionsLabel = new Label(instructions);
        instructionsLabel.getStyleClass().add("dashboard-copy");
        instructionsLabel.setWrapText(true);

        ImageView preview = new ImageView();
        preview.setPreserveRatio(true);
        preview.setFitWidth(560);
        preview.setFitHeight(360);

        StackPane previewContainer = new StackPane(preview);
        previewContainer.getStyleClass().add("camera-preview-card");
        previewContainer.setPrefSize(560, 360);
        previewContainer.setMinSize(Region.USE_PREF_SIZE, Region.USE_PREF_SIZE);

        Label statusLabel = new Label("Starting front camera...");
        statusLabel.getStyleClass().add("camera-status-label");
        statusLabel.setWrapText(true);

        Button captureButton = new Button("Capture");
        captureButton.getStyleClass().add("button");
        captureButton.setDisable(true);

        Button retakeButton = new Button("Retake");
        retakeButton.getStyleClass().addAll("button", "secondary");
        retakeButton.setDisable(true);

        Button usePhotoButton = new Button("Use Photo");
        usePhotoButton.getStyleClass().add("button");
        usePhotoButton.setDisable(true);

        Button cancelButton = new Button("Cancel");
        cancelButton.getStyleClass().addAll("button", "secondary");

        HBox buttonRow = new HBox(12, captureButton, retakeButton, usePhotoButton, cancelButton);
        buttonRow.setAlignment(Pos.CENTER_RIGHT);

        VBox content = new VBox(16, titleLabel, instructionsLabel, previewContainer, statusLabel, buttonRow);
        content.setPadding(new Insets(24));
        content.getStyleClass().add("dialog-card");

        StackPane root = new StackPane(content);
        root.getStyleClass().add("dialog-root");

        Scene scene = new Scene(root, 680, 560);
        scene.getStylesheets().add(resourceBase.getResource("/css/style.css").toExternalForm());
        stage.setScene(scene);

        ScheduledExecutorService executor = Executors.newSingleThreadScheduledExecutor(runnable -> {
            Thread thread = new Thread(runnable, "webcam-preview");
            thread.setDaemon(true);
            return thread;
        });
        AtomicReference<BufferedImage> latestFrame = new AtomicReference<>();
        AtomicReference<BufferedImage> capturedFrame = new AtomicReference<>();
        AtomicReference<Path> capturedPath = new AtomicReference<>();
        AtomicBoolean previewRunning = new AtomicBoolean(false);

        Runnable closeResources = () -> {
            previewRunning.set(false);
            executor.shutdownNow();
            if (webcam.isOpen()) {
                webcam.close();
            }
        };

        stage.setOnCloseRequest(event -> closeResources.run());

        executor.execute(() -> {
            try {
                webcam.open(true);
                previewRunning.set(true);
                Platform.runLater(() -> {
                    statusLabel.setText("Front camera is live. Center your face and capture.");
                    captureButton.setDisable(false);
                });
            } catch (Exception e) {
                Platform.runLater(() -> {
                    statusLabel.setText("Failed to open the camera: " + e.getMessage());
                    cancelButton.setText("Close");
                });
            }
        });

        executor.scheduleAtFixedRate(() -> {
            if (!previewRunning.get() || !webcam.isOpen()) {
                return;
            }

            BufferedImage frame = webcam.getImage();
            if (frame == null) {
                return;
            }

            latestFrame.set(frame);
            WritableImage fxImage = toFxImage(frame);
            Platform.runLater(() -> preview.setImage(fxImage));
        }, 0, 100, TimeUnit.MILLISECONDS);

        captureButton.setOnAction(event -> {
            BufferedImage frame = latestFrame.get();
            if (frame == null) {
                statusLabel.setText("No camera frame is available yet.");
                return;
            }

            capturedFrame.set(deepCopy(frame));
            previewRunning.set(false);
            captureButton.setDisable(true);
            retakeButton.setDisable(false);
            usePhotoButton.setDisable(false);
            statusLabel.setText("Photo captured. Retake if needed, or continue.");
        });

        retakeButton.setOnAction(event -> {
            capturedFrame.set(null);
            previewRunning.set(webcam.isOpen());
            captureButton.setDisable(!webcam.isOpen());
            retakeButton.setDisable(true);
            usePhotoButton.setDisable(true);
            statusLabel.setText(webcam.isOpen()
                    ? "Front camera is live again. Capture another image."
                    : "Camera is not available.");
        });

        usePhotoButton.setOnAction(event -> {
            BufferedImage frame = capturedFrame.get();
            if (frame == null) {
                statusLabel.setText("Capture an image before continuing.");
                return;
            }

            try {
                Path tempImage = Files.createTempFile("pinkshield-face-capture-", ".jpg");
                ImageIO.write(frame, "jpg", tempImage.toFile());
                capturedPath.set(tempImage);
                stage.close();
            } catch (IOException e) {
                statusLabel.setText("Failed to save the captured image: " + e.getMessage());
            }
        });

        cancelButton.setOnAction(event -> stage.close());

        stage.showAndWait();
        closeResources.run();
        return capturedPath.get();
    }

    private static Webcam selectPreferredWebcam() {
        List<Webcam> webcams = Webcam.getWebcams();
        if (webcams == null || webcams.isEmpty()) {
            return null;
        }

        return webcams.stream()
                .sorted((left, right) -> Integer.compare(scoreCamera(right.getName()), scoreCamera(left.getName())))
                .findFirst()
                .orElse(webcams.get(0));
    }

    private static int scoreCamera(String name) {
        if (name == null) {
            return 0;
        }

        String normalized = name.toLowerCase();
        int score = 0;
        if (normalized.contains("front")) {
            score += 100;
        }
        if (normalized.contains("integrated")) {
            score += 60;
        }
        if (normalized.contains("hd")) {
            score += 20;
        }
        if (normalized.contains("virtual")) {
            score -= 40;
        }
        return score;
    }

    private static WritableImage toFxImage(BufferedImage image) {
        int width = image.getWidth();
        int height = image.getHeight();
        int[] rgb = new int[width * height];
        image.getRGB(0, 0, width, height, rgb, 0, width);

        WritableImage writableImage = new WritableImage(width, height);
        writableImage.getPixelWriter().setPixels(
                0,
                0,
                width,
                height,
                PixelFormat.getIntArgbInstance(),
                IntBuffer.wrap(rgb),
                width
        );
        return writableImage;
    }

    private static BufferedImage deepCopy(BufferedImage source) {
        BufferedImage copy = new BufferedImage(source.getWidth(), source.getHeight(), BufferedImage.TYPE_INT_RGB);
        copy.getGraphics().drawImage(source, 0, 0, null);
        return copy;
    }

    private static void showErrorDialog(Window owner, Class<?> resourceBase, String title, String message) {
        Stage stage = new Stage();
        stage.initModality(Modality.WINDOW_MODAL);
        if (owner != null) {
            stage.initOwner(owner);
        }
        stage.setTitle(title);

        Label titleLabel = new Label(title);
        titleLabel.getStyleClass().add("section-title");

        Label messageLabel = new Label(message);
        messageLabel.getStyleClass().add("dashboard-copy");
        messageLabel.setWrapText(true);

        Button closeButton = new Button("Close");
        closeButton.getStyleClass().add("button");
        closeButton.setOnAction(event -> stage.close());

        VBox content = new VBox(16, titleLabel, messageLabel, closeButton);
        content.setPadding(new Insets(24));
        content.setAlignment(Pos.CENTER_LEFT);
        content.getStyleClass().add("dialog-card");

        StackPane root = new StackPane(content);
        root.getStyleClass().add("dialog-root");

        Scene scene = new Scene(root, 420, 220);
        scene.getStylesheets().add(resourceBase.getResource("/css/style.css").toExternalForm());
        stage.setScene(scene);
        stage.showAndWait();
    }
}
