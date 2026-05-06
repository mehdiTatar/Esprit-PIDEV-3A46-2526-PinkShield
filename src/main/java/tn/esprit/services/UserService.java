package tn.esprit.services;

import tn.esprit.entities.User;
import tn.esprit.entities.UserDashboardStats;
import tn.esprit.utils.MyDB;

import java.sql.*;
import java.util.*;
import java.util.regex.Pattern;

public class UserService {
    public static final String ROLE_ADMIN  = "admin";
    public static final String ROLE_DOCTOR = "doctor";
    public static final String ROLE_USER   = "user";
    public static final String ROLE_ALL    = "all";

    private static final Pattern EMAIL_PATTERN = Pattern.compile("^[A-Za-z0-9+_.-]+@[A-Za-z0-9.-]+$");
    private static final Pattern PHONE_PATTERN = Pattern.compile("^[+]?[0-9 ]{8,20}$");
    private static final Pattern NAME_PATTERN  = Pattern.compile("^[A-Za-z][A-Za-z\\s'.-]{1,49}$");

    // ── Create ────────────────────────────────────────────────

    public boolean createUser(User user) {
        String role = normalizeRole(user.getRole());
        Connection conn = MyDB.getInstance().getConnection();
        if (conn == null || role == null) return false;
        try {
            if (ROLE_ADMIN.equals(role)) {
                try (PreparedStatement ps = conn.prepareStatement(
                        "INSERT INTO admin (first_name,last_name,email,password) VALUES (?,?,?,?)",
                        Statement.RETURN_GENERATED_KEYS)) {
                    ps.setString(1, user.getFirstName());
                    ps.setString(2, user.getLastName());
                    ps.setString(3, user.getEmail());
                    ps.setString(4, user.getPassword());
                    return exec(user, ps);
                }
            }
            if (ROLE_DOCTOR.equals(role)) {
                try (PreparedStatement ps = conn.prepareStatement(
                        "INSERT INTO doctor (first_name,last_name,email,password,speciality) VALUES (?,?,?,?,?)",
                        Statement.RETURN_GENERATED_KEYS)) {
                    ps.setString(1, user.getFirstName());
                    ps.setString(2, user.getLastName());
                    ps.setString(3, user.getEmail());
                    ps.setString(4, user.getPassword());
                    ps.setString(5, def(user.getSpeciality()));
                    return exec(user, ps);
                }
            }
            try (PreparedStatement ps = conn.prepareStatement(
                    "INSERT INTO `user` (full_name,email,password,phone,address,face_image_path,face_token) VALUES (?,?,?,?,?,?,?)",
                    Statement.RETURN_GENERATED_KEYS)) {
                ps.setString(1, user.getFullName());
                ps.setString(2, user.getEmail());
                ps.setString(3, user.getPassword());
                ps.setString(4, def(user.getPhone()));
                ps.setString(5, def(user.getAddress()));
                ps.setString(6, blank2null(user.getFaceImagePath()));
                ps.setString(7, blank2null(user.getFaceToken()));
                return exec(user, ps);
            }
        } catch (SQLException e) {
            System.err.println("createUser: " + e.getMessage()); return false;
        }
    }

    // ── Update ────────────────────────────────────────────────

    public boolean updateUser(User user) {
        String role = normalizeRole(user.getRole());
        Connection conn = MyDB.getInstance().getConnection();
        if (conn == null || role == null) return false;
        try {
            if (ROLE_ADMIN.equals(role)) {
                try (PreparedStatement ps = conn.prepareStatement(
                        "UPDATE admin SET first_name=?,last_name=?,email=?,password=? WHERE id=?")) {
                    ps.setString(1, user.getFirstName()); ps.setString(2, user.getLastName());
                    ps.setString(3, user.getEmail());     ps.setString(4, user.getPassword());
                    ps.setInt(5, user.getId());
                    return ps.executeUpdate() > 0;
                }
            }
            if (ROLE_DOCTOR.equals(role)) {
                try (PreparedStatement ps = conn.prepareStatement(
                        "UPDATE doctor SET first_name=?,last_name=?,email=?,password=?,speciality=? WHERE id=?")) {
                    ps.setString(1, user.getFirstName()); ps.setString(2, user.getLastName());
                    ps.setString(3, user.getEmail());     ps.setString(4, user.getPassword());
                    ps.setString(5, def(user.getSpeciality())); ps.setInt(6, user.getId());
                    return ps.executeUpdate() > 0;
                }
            }
            preserveFace(user);
            try (PreparedStatement ps = conn.prepareStatement(
                    "UPDATE `user` SET full_name=?,email=?,password=?,phone=?,address=?,face_image_path=?,face_token=? WHERE id=?")) {
                ps.setString(1, user.getFullName()); ps.setString(2, user.getEmail());
                ps.setString(3, user.getPassword()); ps.setString(4, def(user.getPhone()));
                ps.setString(5, def(user.getAddress())); ps.setString(6, blank2null(user.getFaceImagePath()));
                ps.setString(7, blank2null(user.getFaceToken())); ps.setInt(8, user.getId());
                return ps.executeUpdate() > 0;
            }
        } catch (SQLException e) {
            System.err.println("updateUser: " + e.getMessage()); return false;
        }
    }

    public boolean updateUser(User user, String role) { user.setRole(role); return updateUser(user); }

    // ── Delete ────────────────────────────────────────────────

    public boolean deleteUser(int userId, String role) {
        String table = tableFor(role);
        Connection conn = MyDB.getInstance().getConnection();
        if (table == null || conn == null) return false;
        try (PreparedStatement ps = conn.prepareStatement("DELETE FROM " + table + " WHERE id=?")) {
            ps.setInt(1, userId); return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            System.err.println("deleteUser: " + e.getMessage()); return false;
        }
    }

    // ── Read ──────────────────────────────────────────────────

    public List<User> getUsers(String search, String roleFilter, String sort) {
        List<User> list = new ArrayList<>();
        Connection conn = MyDB.getInstance().getConnection();
        if (conn == null) return list;
        String r = normalizeRoleFilter(roleFilter);
        if (ROLE_ALL.equals(r) || ROLE_ADMIN.equals(r))  list.addAll(fromTable(conn, "admin",  ROLE_ADMIN));
        if (ROLE_ALL.equals(r) || ROLE_DOCTOR.equals(r)) list.addAll(fromTable(conn, "doctor", ROLE_DOCTOR));
        if (ROLE_ALL.equals(r) || ROLE_USER.equals(r))   list.addAll(fromTable(conn, "`user`", ROLE_USER));
        String s = norm(search);
        if (!s.isEmpty()) list.removeIf(u -> !matches(u, s));
        list.sort(comparatorFor(sort));
        return list;
    }

    public List<User> getAllUsers() { return getUsers("", ROLE_ALL, "name-asc"); }

    public User getUserById(int id, String role) {
        String table = tableFor(role);
        Connection conn = MyDB.getInstance().getConnection();
        if (table == null || conn == null) return null;
        try (PreparedStatement ps = conn.prepareStatement("SELECT * FROM " + table + " WHERE id=?")) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) { if (rs.next()) return mapUser(rs, normalizeRole(role)); }
        } catch (SQLException e) { System.err.println("getUserById: " + e.getMessage()); }
        return null;
    }

    public User getUserByEmail(String email, String role) {
        String table = tableFor(role);
        Connection conn = MyDB.getInstance().getConnection();
        if (table == null || conn == null) return null;
        try (PreparedStatement ps = conn.prepareStatement("SELECT * FROM " + table + " WHERE LOWER(email)=?")) {
            ps.setString(1, norm(email));
            try (ResultSet rs = ps.executeQuery()) { if (rs.next()) return mapUser(rs, normalizeRole(role)); }
        } catch (SQLException e) { System.err.println("getUserByEmail: " + e.getMessage()); }
        return null;
    }

    public boolean emailExists(String email) { return emailExistsExcluding(email, null, -1); }
    public boolean emailExistsExcludingId(String email, int excludeId) { return emailExistsExcluding(email, null, excludeId); }

    public boolean emailExistsExcluding(String email, String excludedRole, int excludedId) {
        String ne = norm(email);
        if (ne.isEmpty()) return false;
        for (User u : getAllUsers()) {
            if (!ne.equals(norm(u.getEmail()))) continue;
            boolean same = u.getId() == excludedId && Objects.equals(normalizeRole(u.getRole()), normalizeRole(excludedRole));
            if (!same) return true;
        }
        return false;
    }

    // ── Validate ──────────────────────────────────────────────

    public String validateUser(User user, String confirmPassword, boolean updateMode) {
        if (user == null) return "User data is missing.";
        String role = normalizeRole(user.getRole());
        if (role == null) return "Please choose a valid role.";
        String email = norm(user.getEmail());
        if (email.isEmpty()) return "Email is required.";
        if (!EMAIL_PATTERN.matcher(email).matches()) return "Enter a valid email address.";
        String password = def(user.getPassword()).trim();
        if (password.isEmpty()) return "Password is required.";
        if (password.length() < 8) return "Password must contain at least 8 characters.";
        if (confirmPassword != null && !password.equals(confirmPassword)) return "Password confirmation does not match.";
        if (ROLE_ADMIN.equals(role) || ROLE_DOCTOR.equals(role)) {
            if (!isValidName(user.getFirstName())) return "First name is required and must contain only letters.";
            if (!isValidName(user.getLastName()))  return "Last name is required and must contain only letters.";
            user.setFullName((user.getFirstName().trim() + " " + user.getLastName().trim()).trim());
        } else {
            String full = def(user.getFullName()).trim();
            if (full.isEmpty())    return "Full name is required.";
            if (full.length() < 3) return "Full name must contain at least 3 characters.";
        }
        if (ROLE_DOCTOR.equals(role) && def(user.getSpeciality()).trim().isEmpty()) return "Doctor speciality is required.";
        if (ROLE_USER.equals(role)) {
            String phone = def(user.getPhone()).trim(), address = def(user.getAddress()).trim();
            if (phone.isEmpty()) return "Phone number is required.";
            if (!PHONE_PATTERN.matcher(phone).matches()) return "Phone number must contain 8 to 20 digits.";
            if (address.isEmpty()) return "Address is required.";
        }
        if (emailExistsExcluding(email, role, updateMode ? user.getId() : -1)) return "This email address already exists.";
        user.setEmail(email); user.setRole(role);
        return null;
    }

    // ── Stats ─────────────────────────────────────────────────

    public UserDashboardStats getDashboardStats() {
        Connection conn = MyDB.getInstance().getConnection();
        if (conn == null) return new UserDashboardStats();
        return new UserDashboardStats(count(conn, "admin"), count(conn, "doctor"), count(conn, "`user`"));
    }

    public boolean updateUserFaceData(int userId, String faceImagePath, String faceToken) {
        Connection conn = MyDB.getInstance().getConnection();
        if (conn == null || userId <= 0) return false;
        try (PreparedStatement ps = conn.prepareStatement(
                "UPDATE `user` SET face_image_path=?,face_token=? WHERE id=?")) {
            ps.setString(1, blank2null(faceImagePath));
            ps.setString(2, blank2null(faceToken));
            ps.setInt(3, userId);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) { System.err.println("updateFace: " + e.getMessage()); return false; }
    }

    // ── Internals ─────────────────────────────────────────────

    private List<User> fromTable(Connection conn, String table, String role) {
        List<User> list = new ArrayList<>();
        try (PreparedStatement ps = conn.prepareStatement("SELECT * FROM " + table);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) list.add(mapUser(rs, role));
        } catch (SQLException e) { System.err.println("fromTable " + table + ": " + e.getMessage()); }
        return list;
    }

    private User mapUser(ResultSet rs, String role) throws SQLException {
        User u = new User();
        u.setId(rs.getInt("id"));
        u.setEmail(rs.getString("email"));
        u.setPassword(rs.getString("password"));
        u.setRole(role);
        try { u.setCreatedAt(rs.getTimestamp("created_at")); } catch (SQLException ignored) {}
        if (ROLE_ADMIN.equals(role)) {
            u.setFirstName(rs.getString("first_name")); u.setLastName(rs.getString("last_name"));
            u.setFullName((def(u.getFirstName()) + " " + def(u.getLastName())).trim());
        } else if (ROLE_DOCTOR.equals(role)) {
            u.setFirstName(rs.getString("first_name")); u.setLastName(rs.getString("last_name"));
            u.setFullName((def(u.getFirstName()) + " " + def(u.getLastName())).trim());
            u.setSpeciality(rs.getString("speciality"));
        } else {
            u.setFullName(rs.getString("full_name")); u.setPhone(rs.getString("phone"));
            u.setAddress(rs.getString("address"));
            try { u.setFaceImagePath(rs.getString("face_image_path")); } catch (SQLException ignored) {}
            try { u.setFaceToken(rs.getString("face_token")); } catch (SQLException ignored) {}
        }
        return u;
    }

    private boolean exec(User user, PreparedStatement ps) throws SQLException {
        if (ps.executeUpdate() <= 0) return false;
        try (ResultSet keys = ps.getGeneratedKeys()) { if (keys.next()) user.setId(keys.getInt(1)); }
        return true;
    }

    private void preserveFace(User user) {
        if (user == null || user.getId() <= 0 || !ROLE_USER.equals(normalizeRole(user.getRole()))) return;
        if (!blank(user.getFaceImagePath()) && !blank(user.getFaceToken())) return;
        User p = getUserById(user.getId(), ROLE_USER);
        if (p == null) return;
        if (blank(user.getFaceImagePath())) user.setFaceImagePath(p.getFaceImagePath());
        if (blank(user.getFaceToken()))     user.setFaceToken(p.getFaceToken());
    }

    private int count(Connection conn, String table) {
        try (PreparedStatement ps = conn.prepareStatement("SELECT COUNT(*) FROM " + table);
             ResultSet rs = ps.executeQuery()) { return rs.next() ? rs.getInt(1) : 0; }
        catch (SQLException e) { return 0; }
    }

    private boolean matches(User u, String s) {
        return norm(u.getFullName()).contains(s) || norm(u.getEmail()).contains(s)
                || norm(u.getRole()).contains(s) || norm(u.getSpeciality()).contains(s)
                || norm(u.getPhone()).contains(s);
    }

    private Comparator<User> comparatorFor(String opt) {
        String o = norm(opt);
        Comparator<User> byName  = Comparator.comparing((User u) -> norm(u.getFullName()),  String.CASE_INSENSITIVE_ORDER);
        Comparator<User> byEmail = Comparator.comparing((User u) -> norm(u.getEmail()),     String.CASE_INSENSITIVE_ORDER);
        Comparator<User> byRole  = Comparator.comparing((User u) -> norm(u.getRole()),      String.CASE_INSENSITIVE_ORDER);
        if ("name-desc".equals(o))  return byName.reversed();
        if ("email-asc".equals(o))  return byEmail;
        if ("role-asc".equals(o))   return byRole;
        return byName;
    }

    private String tableFor(String role) {
        String r = normalizeRole(role);
        if (ROLE_ADMIN.equals(r))  return "admin";
        if (ROLE_DOCTOR.equals(r)) return "doctor";
        if (ROLE_USER.equals(r))   return "`user`";
        return null;
    }

    private String normalizeRoleFilter(String r) {
        String n = norm(r); return n.isEmpty() || ROLE_ALL.equals(n) ? ROLE_ALL : normalizeRole(n) != null ? normalizeRole(n) : ROLE_ALL;
    }

    public String normalizeRole(String role) {
        String n = norm(role);
        if (ROLE_ADMIN.equals(n) || ROLE_DOCTOR.equals(n) || ROLE_USER.equals(n)) return n;
        return null;
    }

    private String norm(String v) { return v == null ? "" : v.trim().toLowerCase(Locale.ROOT); }
    private String def(String v)  { return v == null ? "" : v; }
    private String blank2null(String v) { String t = def(v).trim(); return t.isEmpty() ? null : t; }
    private boolean blank(String v)     { return def(v).trim().isEmpty(); }
    private boolean isValidName(String v) { return NAME_PATTERN.matcher(def(v).trim()).matches(); }
}
