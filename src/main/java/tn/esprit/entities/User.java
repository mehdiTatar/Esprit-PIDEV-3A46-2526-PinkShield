package tn.esprit.entities;

import java.sql.Timestamp;

public class User {
    private int       id;
    private String    firstName;
    private String    lastName;
    private String    fullName;
    private String    email;
    private String    password;
    private String    phone;
    private String    address;
    private String    role;          // "admin" | "doctor" | "user"
    private String    speciality;    // doctors only
    private String    faceImagePath;
    private String    faceToken;
    private Timestamp createdAt;

    public User() {}

    public User(String email, String password) {
        this.email    = email;
        this.password = password;
    }

    public int getId()                     { return id; }
    public void setId(int id)              { this.id = id; }

    public String getFirstName()           { return firstName; }
    public void setFirstName(String v)     { this.firstName = v; }

    public String getLastName()            { return lastName; }
    public void setLastName(String v)      { this.lastName = v; }

    public String getFullName()            { return fullName; }
    public void setFullName(String v)      { this.fullName = v; }

    public String getEmail()               { return email; }
    public void setEmail(String v)         { this.email = v; }

    public String getPassword()            { return password; }
    public void setPassword(String v)      { this.password = v; }

    public String getPhone()               { return phone; }
    public void setPhone(String v)         { this.phone = v; }

    public String getAddress()             { return address; }
    public void setAddress(String v)       { this.address = v; }

    public String getRole()                { return role; }
    public void setRole(String v)          { this.role = v; }

    public String getSpeciality()          { return speciality; }
    public void setSpeciality(String v)    { this.speciality = v; }

    public String getFaceImagePath()       { return faceImagePath; }
    public void setFaceImagePath(String v) { this.faceImagePath = v; }

    public String getFaceToken()           { return faceToken; }
    public void setFaceToken(String v)     { this.faceToken = v; }

    public Timestamp getCreatedAt()        { return createdAt; }
    public void setCreatedAt(Timestamp v)  { this.createdAt = v; }

    @Override
    public String toString() {
        return "User{id=" + id + ", fullName='" + fullName + "', role='" + role + "'}";
    }
}
