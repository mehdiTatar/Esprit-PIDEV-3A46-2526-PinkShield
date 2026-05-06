package tn.esprit.entities;

import java.sql.Timestamp;

public class Appointment {
    private int id;
    private int patientId;
    private int doctorId;
    private String patientName;
    private String doctorName;
    private Timestamp appointmentDate;
    private String status;
    private String notes;

    public Appointment() {}

    public Appointment(int id, int patientId, int doctorId, String patientName,
                       String doctorName, Timestamp appointmentDate, String status, String notes) {
        this.id              = id;
        this.patientId       = patientId;
        this.doctorId        = doctorId;
        this.patientName     = patientName;
        this.doctorName      = doctorName;
        this.appointmentDate = appointmentDate;
        this.status          = status;
        this.notes           = notes;
    }

    public int getId()                       { return id; }
    public void setId(int id)                { this.id = id; }
    public int getPatientId()                { return patientId; }
    public void setPatientId(int v)          { this.patientId = v; }
    public int getDoctorId()                 { return doctorId; }
    public void setDoctorId(int v)           { this.doctorId = v; }
    public String getPatientName()           { return patientName; }
    public void setPatientName(String v)     { this.patientName = v; }
    public String getDoctorName()            { return doctorName; }
    public void setDoctorName(String v)      { this.doctorName = v; }
    public Timestamp getAppointmentDate()    { return appointmentDate; }
    public void setAppointmentDate(Timestamp v) { this.appointmentDate = v; }
    public String getStatus()                { return status; }
    public void setStatus(String v)          { this.status = v; }
    public String getNotes()                 { return notes; }
    public void setNotes(String v)           { this.notes = v; }
}
