package tn.esprit.entities;

import java.sql.Timestamp;

public class WishlistDisplayItem {
    private final int id;
    private final int userId;
    private final int parapharmacyId;
    private final String productName;
    private final String category;
    private final double price;
    private final Timestamp addedAt;

    public WishlistDisplayItem(
            int id,
            int userId,
            int parapharmacyId,
            String productName,
            String category,
            double price,
            Timestamp addedAt
    ) {
        this.id = id;
        this.userId = userId;
        this.parapharmacyId = parapharmacyId;
        this.productName = productName;
        this.category = category;
        this.price = price;
        this.addedAt = addedAt;
    }

    public int getId() {
        return id;
    }

    public int getUserId() {
        return userId;
    }

    public int getParapharmacyId() {
        return parapharmacyId;
    }

    public String getProductName() {
        return productName;
    }

    public String getCategory() {
        return category;
    }

    public double getPrice() {
        return price;
    }

    public Timestamp getAddedAt() {
        return addedAt;
    }
}
