package tn.esprit.entities;

import java.sql.Timestamp;

public class Wishlist {
    private int id;
    private int userId;
    private int parapharmacyId;
    private Timestamp addedAt;

    public Wishlist() {
    }

    public Wishlist(int userId, int parapharmacyId) {
        this.userId = userId;
        this.parapharmacyId = parapharmacyId;
    }

    public Wishlist(int id, int userId, int parapharmacyId, Timestamp addedAt) {
        this.id = id;
        this.userId = userId;
        this.parapharmacyId = parapharmacyId;
        this.addedAt = addedAt;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public int getParapharmacyId() {
        return parapharmacyId;
    }

    public void setParapharmacyId(int parapharmacyId) {
        this.parapharmacyId = parapharmacyId;
    }

    public Timestamp getAddedAt() {
        return addedAt;
    }

    public void setAddedAt(Timestamp addedAt) {
        this.addedAt = addedAt;
    }
}
