import java.sql.*;

public class DbSchemaCheck {
    public static void main(String[] args) throws Exception {
        String url = "jdbc:mysql://localhost:3306/pinkshield_db?useSSL=false&allowPublicKeyRetrieval=true&serverTimezone=UTC";
        try (Connection conn = DriverManager.getConnection(url, "root", "");
             PreparedStatement ps = conn.prepareStatement("SHOW COLUMNS FROM parapharmacy");
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) {
                System.out.println(rs.getString("Field") + "|" + rs.getString("Type"));
            }
        }
    }
}