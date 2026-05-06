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
        String query = "INSERT INTO appointment (patient_email, doctor_email, patient_name, doctor_name, appointment_date, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?)";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, appt.getPatientEmail());
            ps.setString(2, appt.getDoctorEmail());
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
                        rs.getString("patient_email"),
                        rs.getString("doctor_email"),
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

    public List<Appointment> getAppointmentsByPatient(String patientEmail) {
        List<Appointment> list = new ArrayList<>();
        if (conn == null) {
            return list;
        }
        String query = "SELECT * FROM appointment WHERE patient_email = ? ORDER BY appointment_date ASC";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, patientEmail);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    list.add(new Appointment(
                            rs.getInt("id"),
                            rs.getString("patient_email"),
                            rs.getString("doctor_email"),
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

    public List<Appointment> getAppointmentsByDoctor(String doctorEmail) {
        List<Appointment> list = new ArrayList<>();
        if (conn == null) {
            return list;
        }
        String query = "SELECT * FROM appointment WHERE doctor_email = ? ORDER BY appointment_date ASC";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, doctorEmail);
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {
                    list.add(new Appointment(
                            rs.getInt("id"),
                            rs.getString("patient_email"),
                            rs.getString("doctor_email"),
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

    public int countAppointmentsByDoctor(String doctorEmail) {
        if (conn == null) {
            return 0;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE doctor_email = ?";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, doctorEmail);
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

    public int countAllAppointments() {
        if (conn == null) {
            return 0;
        }
        String query = "SELECT COUNT(*) as count FROM appointment";
        try (PreparedStatement ps = conn.prepareStatement(query);
             ResultSet rs = ps.executeQuery()) {
            if (rs.next()) {
                return rs.getInt("count");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return 0;
    }

    public int countUpcomingAppointmentsByDoctor(String doctorEmail) {
        if (conn == null) {
            return 0;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE doctor_email = ? AND appointment_date > NOW()";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, doctorEmail);
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

    public int countAllUpcomingAppointments() {
        if (conn == null) {
            return 0;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE appointment_date > NOW()";
        try (PreparedStatement ps = conn.prepareStatement(query);
             ResultSet rs = ps.executeQuery()) {
            if (rs.next()) {
                return rs.getInt("count");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return 0;
    }

    public int countAppointmentsByPatient(String patientEmail) {
        if (conn == null) {
            return 0;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE patient_email = ?";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, patientEmail);
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

    public int countUpcomingAppointmentsByPatient(String patientEmail) {
        if (conn == null) {
            return 0;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE patient_email = ? AND appointment_date > NOW()";
        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, patientEmail);
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

    public boolean hasAppointmentConflict(String doctorEmail, Timestamp appointmentDateTime, Integer excludeAppointmentId) {
        if (conn == null) {
            return false;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE doctor_email = ? AND appointment_date = ? AND status != 'cancelled'";
        if (excludeAppointmentId != null) {
            query += " AND id != ?";
        }

        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, doctorEmail);
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

    public boolean hasPatientDuplicate(String patientEmail, String doctorEmail, Timestamp appointmentDateTime, Integer excludeAppointmentId) {
        if (conn == null) {
            return false;
        }
        String query = "SELECT COUNT(*) as count FROM appointment WHERE patient_email = ? AND doctor_email = ? AND appointment_date = ? AND status != 'cancelled'";
        if (excludeAppointmentId != null) {
            query += " AND id != ?";
        }

        try (PreparedStatement ps = conn.prepareStatement(query)) {
            ps.setString(1, patientEmail);
            ps.setString(2, doctorEmail);
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
