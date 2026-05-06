package tn.esprit.tools;

import tn.esprit.entities.User;

/**
 * Application-wide session holder.
 * Stores the currently logged-in user for the lifetime of the session.
 */
public final class SessionManager {

    private static User currentUser;

    private SessionManager() {}

    public static void setCurrentUser(User user) { currentUser = user; }

    public static User getCurrentUser() { return currentUser; }

    public static boolean isLoggedIn() { return currentUser != null; }

    public static void logout() { currentUser = null; }
}
