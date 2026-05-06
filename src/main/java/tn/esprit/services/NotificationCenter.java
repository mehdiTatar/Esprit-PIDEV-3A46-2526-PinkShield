package tn.esprit.services;

import javafx.application.Platform;

import java.awt.Toolkit;
import java.util.ArrayList;
import java.util.List;

public final class NotificationCenter {
    private static final List<Runnable> LISTENERS = new ArrayList<>();

    private NotificationCenter() {
    }

    public static void subscribe(Runnable listener) {
        if (listener != null && !LISTENERS.contains(listener)) {
            LISTENERS.add(listener);
        }
    }

    public static void publish() {
        publish(false);
    }

    public static void publish(boolean playSound) {
        if (playSound) {
            playNotificationSound();
        }
        for (Runnable listener : List.copyOf(LISTENERS)) {
            if (Platform.isFxApplicationThread()) {
                listener.run();
            } else {
                Platform.runLater(listener);
            }
        }
    }

    private static void playNotificationSound() {
        try {
            Toolkit.getDefaultToolkit().beep();
        } catch (RuntimeException ignored) {
            // Some environments do not expose a desktop beep device.
        }
    }
}
