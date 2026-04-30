package org.example;

import java.sql.Timestamp;

public class WishlistDisplayItem {
    private final int id;
    private final int userId;
    private final int parapharmacieId;
    private final String productName;
    private final double price;
    private final Timestamp addedAt;

    public WishlistDisplayItem(int id, int userId, int parapharmacieId, String productName, double price, Timestamp addedAt) {
        this.id = id;
        this.userId = userId;
        this.parapharmacieId = parapharmacieId;
        this.productName = productName;
        this.price = price;
        this.addedAt = addedAt;
    }

    public int getId() {
        return id;
    }

    public int getUserId() {
        return userId;
    }

    public int getParapharmacieId() {
        return parapharmacieId;
    }

    public String getProductName() {
        return productName;
    }

    public double getPrice() {
        return price;
    }

    public Timestamp getAddedAt() {
        return addedAt;
    }
}
