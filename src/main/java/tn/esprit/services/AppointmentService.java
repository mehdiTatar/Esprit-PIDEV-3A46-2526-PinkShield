package tn.esprit.services;

import tn.esprit.entities.Appointment;
import tn.esprit.utils.MyDB;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class AppointmentService {
    private final Connection conn;

    public AppointmentService() {
        conn = MyDB.getInstance().getConnection();
    }

    public boolean addAppointment(Appointment appt) {
        if (conn == null) {
            return false;
        }
        String query = "INSERT INTO appointment (patient_id, doctor_id, patient_name, doctor_name, appointment_date, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?)";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setInt(1, appt.getPatientId());
            ps.setInt(2, appt.getDoctorId());
            ps.setString(3, appt.getPatientName());
            ps.setString(4, appt.getDoctorName());
            ps.setTimestamp(5, appt.getAppointmentDate());
            ps.setString(6, appt.getStatus());
            ps.setString(7, appt.getNotes());
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public List<Appointment> getAllAppointments() {
        List<Appointment> list = new ArrayList<>();
        if (conn == null) {
            return list;
        }
        String query = "SELECT * FROM appointment ORDER BY appointment_date ASC";
        try (Statement st = conn.createStatement(); ResultSet rs = st.executeQuery(query)) {
            while (rs.next()) {
                list.add(new Appointment(
                        rs.getInt("id"),
                        rs.getInt("patient_id"),
                        rs.getInt("doctor_id"),
                        rs.getString("patient_name"),
                        rs.getString("doctor_name"),
                        rs.getTimestamp("appointment_date"),
                        rs.getString("status"),
                        rs.getString("notes")
                ));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return list;
    }

    public List<Appointment> getAppointmentsByPatient(int patientId) {
        List<Appointment> list = new ArrayList<>();
        if (conn == null) {
            return list;
        }
        String query = "SELECT * FROM appointment WHERE patient_id = ? ORDER BY appointment_date ASC";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setInt(1, patientId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    list.add(new Appointment(
                            rs.getInt("id"),
                            rs.getInt("patient_id"),
                            rs.getInt("doctor_id"),
                            rs.getString("patient_name"),
                            rs.getString("doctor_name"),
                            rs.getTimestamp("appointment_date"),
                            rs.getString("status"),
                            rs.getString("notes")
                    ));
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return list;
    }

    public List<Appointment> getAppointmentsByDoctor(int doctorId) {
        List<Appointment> list = new ArrayList<>();
        if (conn == null) {
            return list;
        }
        String query = "SELECT * FROM appointment WHERE doctor_id = ? ORDER BY appointment_date ASC";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setInt(1, doctorId);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    list.add(new Appointment(
                            rs.getInt("id"),
                            rs.getInt("patient_id"),
                            rs.getInt("doctor_id"),
                            rs.getString("patient_name"),
                            rs.getString("doctor_name"),
                            rs.getTimestamp("appointment_date"),
                            rs.getString("status"),
                            rs.getString("notes")
                    ));
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return list;
    }

    public boolean updateStatus(int id, String status) {
        if (conn == null) {
            return false;
        }
        String query = "UPDATE appointment SET status = ? WHERE id = ?";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, status);
            ps.setInt(2, id);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public boolean deleteAppointment(int id) {
        if (conn == null) {
            return false;
        }
        String query = "DELETE FROM appointment WHERE id = ?";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setInt(1, id);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }

    public int countAppointmentsByDoctor(int doctorId) {
        if (conn == null) {
            return 0;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE doctor_id = ?";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setInt(1, doctorId);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt("count");
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return 0;
    }

    public int countUpcomingAppointmentsByDoctor(int doctorId) {
        if (conn == null) {
            return 0;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE doctor_id = ? AND appointment_date > NOW()";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setInt(1, doctorId);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt("count");
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return 0;
    }

    public int countAppointmentsByPatient(int patientId) {
        if (conn == null) {
            return 0;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE patient_id = ?";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setInt(1, patientId);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt("count");
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return 0;
    }

    public int countUpcomingAppointmentsByPatient(int patientId) {
        if (conn == null) {
            return 0;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE patient_id = ? AND appointment_date > NOW()";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setInt(1, patientId);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt("count");
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return 0;
    }

    public boolean hasAppointmentConflict(int doctorId, Timestamp appointmentDateTime, Integer excludeAppointmentId) {
        if (conn == null) {
            return false;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE doctor_id = ? AND appointment_date = ? AND status != 'cancelled'";
        if (excludeAppointmentId != null) {
            query += " AND id != ?";
        }

        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setInt(1, doctorId);
            ps.setTimestamp(2, appointmentDateTime);
            if (excludeAppointmentId != null) {
                ps.setInt(3, excludeAppointmentId);
            }
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt("count") > 0;
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    public boolean hasPatientDuplicate(int patientId, int doctorId, Timestamp appointmentDateTime, Integer excludeAppointmentId) {
        if (conn == null) {
            return false;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE patient_id = ? AND doctor_id = ? AND appointment_date = ? AND status != 'cancelled'";
        if (excludeAppointmentId != null) {
            query += " AND id != ?";
        }

        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setInt(1, patientId);
            ps.setInt(2, doctorId);
            ps.setTimestamp(3, appointmentDateTime);
            if (excludeAppointmentId != null) {
                ps.setInt(4, excludeAppointmentId);
            }
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return rs.getInt("count") > 0;
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    public boolean rescheduleAppointment(int appointmentId, Timestamp appointmentDateTime, String status) {
        if (conn == null) {
            return false;
        }

        String query = "UPDATE appointment SET appointment_date = ?, status = ? WHERE id = ?";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setTimestamp(1, appointmentDateTime);
            ps.setString(2, status);
            ps.setInt(3, appointmentId);
            return ps.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        }
    }
}
