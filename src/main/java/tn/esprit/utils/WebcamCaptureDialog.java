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
import javafx.scene.layout.*;
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
import java.util.concurrent.*;
import java.util.concurrent.atomic.*;

public final class WebcamCaptureDialog {
    private WebcamCaptureDialog() {}

    public static Path captureFaceImage(Window owner, Class<?> resourceBase, String title, String instructions) {
        Webcam webcam = selectWebcam();
        if (webcam == null) {
            showError(owner, resourceBase, title, "No camera detected.");
            return null;
        }

        Dimension res = webcam.getViewSizes().length == 0
                ? WebcamResolution.VGA.getSize()
                : List.of(webcam.getViewSizes()).stream()
                        .max(Comparator.comparingInt(d -> d.width * d.height))
                        .orElse(WebcamResolution.VGA.getSize());
        webcam.setViewSize(res);

        Stage stage = new Stage();
        stage.initModality(Modality.WINDOW_MODAL);
        if (owner != null) stage.initOwner(owner);
        stage.setTitle(title);

        Label titleLbl = new Label(title); titleLbl.getStyleClass().add("section-title");
        Label instrLbl = new Label(instructions); instrLbl.getStyleClass().add("dashboard-copy"); instrLbl.setWrapText(true);
        ImageView preview = new ImageView(); preview.setPreserveRatio(true); preview.setFitWidth(560); preview.setFitHeight(360);
        StackPane previewPane = new StackPane(preview); previewPane.setPrefSize(560, 360);
        Label status = new Label("Starting camera…"); status.getStyleClass().add("dashboard-copy"); status.setWrapText(true);

        Button captureBtn = new Button("Capture"); captureBtn.getStyleClass().add("button"); captureBtn.setDisable(true);
        Button retakeBtn  = new Button("Retake");  retakeBtn.getStyleClass().addAll("button", "secondary"); retakeBtn.setDisable(true);
        Button useBtn     = new Button("Use Photo"); useBtn.getStyleClass().add("button"); useBtn.setDisable(true);
        Button cancelBtn  = new Button("Cancel"); cancelBtn.getStyleClass().addAll("button", "secondary");

        HBox btns = new HBox(12, captureBtn, retakeBtn, useBtn, cancelBtn); btns.setAlignment(Pos.CENTER_RIGHT);
        VBox content = new VBox(16, titleLbl, instrLbl, previewPane, status, btns);
        content.setPadding(new Insets(24)); content.getStyleClass().add("dialog-card");

        Scene scene = new Scene(new StackPane(content), 680, 560);
        scene.getStylesheets().add(resourceBase.getResource("/css/style.css").toExternalForm());
        stage.setScene(scene);

        ScheduledExecutorService exec = Executors.newSingleThreadScheduledExecutor(r -> { Thread t = new Thread(r, "webcam"); t.setDaemon(true); return t; });
        AtomicReference<BufferedImage> latest   = new AtomicReference<>();
        AtomicReference<BufferedImage> captured = new AtomicReference<>();
        AtomicReference<Path>          result   = new AtomicReference<>();
        AtomicBoolean running = new AtomicBoolean(false);

        Runnable cleanup = () -> { running.set(false); exec.shutdownNow(); if (webcam.isOpen()) webcam.close(); };
        stage.setOnCloseRequest(e -> cleanup.run());

        exec.execute(() -> {
            try {
                webcam.open(true); running.set(true);
                Platform.runLater(() -> { status.setText("Camera live. Center your face and capture."); captureBtn.setDisable(false); });
            } catch (Exception e) {
                Platform.runLater(() -> { status.setText("Camera error: " + e.getMessage()); cancelBtn.setText("Close"); });
            }
        });

        exec.scheduleAtFixedRate(() -> {
            if (!running.get() || !webcam.isOpen()) return;
            BufferedImage f = webcam.getImage(); if (f == null) return;
            latest.set(f);
            WritableImage fx = toFx(f);
            Platform.runLater(() -> preview.setImage(fx));
        }, 0, 100, TimeUnit.MILLISECONDS);

        captureBtn.setOnAction(e -> {
            BufferedImage f = latest.get(); if (f == null) return;
            captured.set(copy(f)); running.set(false);
            captureBtn.setDisable(true); retakeBtn.setDisable(false); useBtn.setDisable(false);
            status.setText("Photo captured. Retake if needed.");
        });
        retakeBtn.setOnAction(e -> {
            captured.set(null); running.set(webcam.isOpen());
            captureBtn.setDisable(!webcam.isOpen()); retakeBtn.setDisable(true); useBtn.setDisable(true);
            status.setText(webcam.isOpen() ? "Camera live." : "Camera unavailable.");
        });
        useBtn.setOnAction(e -> {
            BufferedImage f = captured.get(); if (f == null) return;
            try {
                Path tmp = Files.createTempFile("pinkshield-face-", ".jpg");
                ImageIO.write(f, "jpg", tmp.toFile());
                result.set(tmp); stage.close();
            } catch (IOException ex) { status.setText("Failed to save: " + ex.getMessage()); }
        });
        cancelBtn.setOnAction(e -> stage.close());
        stage.showAndWait(); cleanup.run();
        return result.get();
    }

    private static Webcam selectWebcam() {
        List<Webcam> all = Webcam.getWebcams();
        if (all == null || all.isEmpty()) return null;
        return all.stream().sorted((a, b) -> score(b.getName()) - score(a.getName())).findFirst().orElse(all.get(0));
    }
    private static int score(String n) {
        if (n == null) return 0;
        String l = n.toLowerCase();
        return (l.contains("front") ? 100 : 0) + (l.contains("integrated") ? 60 : 0) + (l.contains("hd") ? 20 : 0) - (l.contains("virtual") ? 40 : 0);
    }
    private static WritableImage toFx(BufferedImage img) {
        int w = img.getWidth(), h = img.getHeight();
        int[] rgb = new int[w * h]; img.getRGB(0, 0, w, h, rgb, 0, w);
        WritableImage wi = new WritableImage(w, h);
        wi.getPixelWriter().setPixels(0, 0, w, h, PixelFormat.getIntArgbInstance(), IntBuffer.wrap(rgb), w);
        return wi;
    }
    private static BufferedImage copy(BufferedImage src) {
        BufferedImage c = new BufferedImage(src.getWidth(), src.getHeight(), BufferedImage.TYPE_INT_RGB);
        c.getGraphics().drawImage(src, 0, 0, null); return c;
    }
    private static void showError(Window owner, Class<?> res, String title, String msg) {
        Stage s = new Stage(); s.initModality(Modality.WINDOW_MODAL); if (owner != null) s.initOwner(owner); s.setTitle(title);
        Label m = new Label(msg); m.getStyleClass().add("dashboard-copy"); m.setWrapText(true);
        Button b = new Button("Close"); b.getStyleClass().add("button"); b.setOnAction(e -> s.close());
        VBox v = new VBox(16, new Label(title), m, b); v.setPadding(new Insets(24)); v.getStyleClass().add("dialog-card");
        Scene sc = new Scene(new StackPane(v), 420, 220);
        sc.getStylesheets().add(res.getResource("/css/style.css").toExternalForm());
        s.setScene(sc); s.showAndWait();
    }
}
