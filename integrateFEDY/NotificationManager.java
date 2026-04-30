package org.example;

import javafx.beans.property.IntegerProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

/**
 * NotificationManager: Singleton pattern for managing global notifications
 * 
 * Stores notifications and tracks unread count
 * Can be accessed from any controller using NotificationManager.getInstance()
 */
public class NotificationManager {
    private static NotificationManager instance;

    private final ObservableList<String> notifications = FXCollections.observableArrayList();
    private final IntegerProperty unreadCount = new SimpleIntegerProperty(0);
    private static final DateTimeFormatter formatter = DateTimeFormatter.ofPattern("HH:mm");

    /**
     * Private constructor for Singleton pattern
     */
    private NotificationManager() {
        System.out.println("✅ NotificationManager Initialized");
    }

    /**
     * Get the singleton instance
     */
    public static synchronized NotificationManager getInstance() {
        if (instance == null) {
            instance = new NotificationManager();
        }
        return instance;
    }

    /**
     * Add a notification to the top of the list and increment unread count
     * 
     * @param message The notification message
     */
    public void addNotification(String message) {
        // Add timestamp to the notification
        String timestamp = LocalDateTime.now().format(formatter);
        String fullMessage = "[" + timestamp + "] " + message;

        // Add to the top of the list (index 0)
        notifications.add(0, fullMessage);

        // Increment unread count
        unreadCount.set(unreadCount.get() + 1);

        System.out.println("📬 Notification added: " + fullMessage);
    }

    /**
     * Clear all notifications
     */
    public void clearAll() {
        notifications.clear();
        System.out.println("🗑️ All notifications cleared");
    }

    /**
     * Reset unread count to 0 (called when user opens the notification center)
     */
    public void markAsRead() {
        unreadCount.set(0);
        System.out.println("✅ Notifications marked as read");
    }

    /**
     * Get the observable list of notifications
     */
    public ObservableList<String> getNotifications() {
        return notifications;
    }

    /**
     * Get the unread count property (useful for binding to UI)
     */
    public IntegerProperty getUnreadCountProperty() {
        return unreadCount;
    }

    /**
     * Get the current unread count
     */
    public int getUnreadCount() {
        return unreadCount.get();
    }

    /**
     * Check if there are unread notifications
     */
    public boolean hasUnread() {
        return unreadCount.get() > 0;
    }

    /**
     * Get the most recent notification (or empty string if none)
     */
    public String getLatestNotification() {
        if (notifications.isEmpty()) {
            return "";
        }
        return notifications.get(0);
    }
}

