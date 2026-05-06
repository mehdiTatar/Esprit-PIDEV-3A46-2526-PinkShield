package tn.esprit.services;

import tn.esprit.entities.Appointment;
import tn.esprit.utils.MyDB;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class AppointmentService {
    private final Connection conn = MyDB.getInstance().getConnection();

    public int countAppointmentsByPatient(int patientId) {
        return count("SELECT COUNT(*) FROM appointment WHERE patient_id=?", patientId);
    }

    public int countUpcomingAppointmentsByPatient(int patientId) {
        return count("SELECT COUNT(*) FROM appointment WHERE patient_id=? AND appointment_date>NOW()", patientId);
    }

    public int countAppointmentsByDoctor(int doctorId) {
        return count("SELECT COUNT(*) FROM appointment WHERE doctor_id=?", doctorId);
    }

    public int countUpcomingAppointmentsByDoctor(int doctorId) {
        return count("SELECT COUNT(*) FROM appointment WHERE doctor_id=? AND appointment_date>NOW()", doctorId);
    }

    public List<Appointment> getAppointmentsByPatient(int patientId) {
        return query("SELECT * FROM appointment WHERE patient_id=? ORDER BY appointment_date ASC", patientId);
    }

    public List<Appointment> getAppointmentsByDoctor(int doctorId) {
        return query("SELECT * FROM appointment WHERE doctor_id=? ORDER BY appointment_date ASC", doctorId);
    }

    public List<Appointment> getAllAppointments() {
        List<Appointment> list = new ArrayList<>();
        if (conn == null) return list;
        try (PreparedStatement ps = conn.prepareStatement("SELECT * FROM appointment ORDER BY appointment_date ASC");
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) list.add(map(rs));
        } catch (SQLException e) { e.printStackTrace(); }
        return list;
    }

    public boolean addAppointment(Appointment a) {
        if (conn == null) return false;
        String sql = "INSERT INTO appointment (patient_id,doctor_id,patient_name,doctor_name,appointment_date,status,notes) VALUES(?,?,?,?,?,?,?)";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, a.getPatientId()); ps.setInt(2, a.getDoctorId());
            ps.setString(3, a.getPatientName()); ps.setString(4, a.getDoctorName());
            ps.setTimestamp(5, a.getAppointmentDate()); ps.setString(6, a.getStatus()); ps.setString(7, a.getNotes());
            return ps.executeUpdate() > 0;
        } catch (SQLException e) { e.printStackTrace(); return false; }
    }

    public boolean updateStatus(int id, String status) {
        if (conn == null) return false;
        try (PreparedStatement ps = conn.prepareStatement("UPDATE appointment SET status=? WHERE id=?")) {
            ps.setString(1, status); ps.setInt(2, id); return ps.executeUpdate() > 0;
        } catch (SQLException e) { e.printStackTrace(); return false; }
    }

    public boolean rescheduleAppointment(int id, Timestamp newDate, String status) {
        if (conn == null) return false;
        try (PreparedStatement ps = conn.prepareStatement("UPDATE appointment SET appointment_date=?,status=? WHERE id=?")) {
            ps.setTimestamp(1, newDate); ps.setString(2, status); ps.setInt(3, id); return ps.executeUpdate() > 0;
        } catch (SQLException e) { e.printStackTrace(); return false; }
    }

    public boolean hasAppointmentConflict(int doctorId, Timestamp date, Integer excludeId) {
        if (conn == null) return false;
        String sql = excludeId == null
                ? "SELECT COUNT(*) FROM appointment WHERE doctor_id=? AND appointment_date=? AND status!='cancelled'"
                : "SELECT COUNT(*) FROM appointment WHERE doctor_id=? AND appointment_date=? AND status!='cancelled' AND id!=?";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, doctorId); ps.setTimestamp(2, date);
            if (excludeId != null) ps.setInt(3, excludeId);
            try (ResultSet rs = ps.executeQuery()) { return rs.next() && rs.getInt(1) > 0; }
        } catch (SQLException e) { e.printStackTrace(); return false; }
    }

    public boolean hasPatientDuplicate(int patientId, int doctorId, Timestamp date, Integer excludeId) {
        if (conn == null) return false;
        String sql = excludeId == null
                ? "SELECT COUNT(*) FROM appointment WHERE patient_id=? AND doctor_id=? AND appointment_date=? AND status!='cancelled'"
                : "SELECT COUNT(*) FROM appointment WHERE patient_id=? AND doctor_id=? AND appointment_date=? AND status!='cancelled' AND id!=?";
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, patientId); ps.setInt(2, doctorId); ps.setTimestamp(3, date);
            if (excludeId != null) ps.setInt(4, excludeId);
            try (ResultSet rs = ps.executeQuery()) { return rs.next() && rs.getInt(1) > 0; }
        } catch (SQLException e) { e.printStackTrace(); return false; }
    }

    public boolean deleteAppointment(int id) {
        if (conn == null) return false;
        try (PreparedStatement ps = conn.prepareStatement("DELETE FROM appointment WHERE id=?")) {
            ps.setInt(1, id); return ps.executeUpdate() > 0;
        } catch (SQLException e) { e.printStackTrace(); return false; }
    }

    private int count(String sql, int param) {
        if (conn == null) return 0;
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, param);
            try (ResultSet rs = ps.executeQuery()) { return rs.next() ? rs.getInt(1) : 0; }
        } catch (SQLException e) { return 0; }
    }

    private List<Appointment> query(String sql, int param) {
        List<Appointment> list = new ArrayList<>();
        if (conn == null) return list;
        try (PreparedStatement ps = conn.prepareStatement(sql)) {
            ps.setInt(1, param);
            try (ResultSet rs = ps.executeQuery()) { while (rs.next()) list.add(map(rs)); }
        } catch (SQLException e) { e.printStackTrace(); }
        return list;
    }

    private Appointment map(ResultSet rs) throws SQLException {
        return new Appointment(
                rs.getInt("id"), rs.getInt("patient_id"), rs.getInt("doctor_id"),
                rs.getString("patient_name"), rs.getString("doctor_name"),
                rs.getTimestamp("appointment_date"), rs.getString("status"), rs.getString("notes"));
    }
}
