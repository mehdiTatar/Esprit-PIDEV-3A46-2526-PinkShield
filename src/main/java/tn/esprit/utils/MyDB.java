package tn.esprit.utils;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class MyDB {
    private static MyDB instance;
    private Connection connection;

    // Defaults to "pinkshield" — the shared database for both blog and user management
    private static final String HOST     = readSetting("DB_HOST",     "localhost");
    private static final String PORT     = readSetting("DB_PORT",     "3306");
    private static final String DATABASE = readSetting("DB_NAME",     "pinkshield");
    private static final String URL      = "jdbc:mysql://" + HOST + ":" + PORT + "/" + DATABASE
            + "?useSSL=false&allowPublicKeyRetrieval=true&serverTimezone=UTC";
    private static final String USER     = readSetting("DB_USER",     "root");
    private static final String PASSWORD = readSetting("DB_PASSWORD", "");

    private MyDB() {
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            this.connection = DriverManager.getConnection(URL, USER, PASSWORD);
            System.out.println("MyDB connected to " + DATABASE);
        } catch (ClassNotFoundException | SQLException e) {
            System.err.println("MyDB connection failed: " + e.getMessage());
        }
    }

    public static synchronized MyDB getInstance() {
        if (instance == null) instance = new MyDB();
        return instance;
    }

    public Connection getConnection() {
        try {
            if (connection == null || connection.isClosed()) {
                Class.forName("com.mysql.cj.jdbc.Driver");
                connection = DriverManager.getConnection(URL, USER, PASSWORD);
            }
        } catch (ClassNotFoundException | SQLException e) {
            System.err.println("MyDB reconnect failed: " + e.getMessage());
        }
        return connection;
    }

    private static String readSetting(String key, String defaultValue) {
        String v = System.getProperty(key);
        if (v != null && !v.isBlank()) return v.trim();
        v = System.getenv(key);
        if (v != null && !v.isBlank()) return v.trim();
        return defaultValue;
    }
}
