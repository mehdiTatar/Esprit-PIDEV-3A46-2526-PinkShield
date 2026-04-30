package tn.esprit.services;

import tn.esprit.entities.Parapharmacy;

import java.util.List;

public final class ParapharmacyCatalog {
    private ParapharmacyCatalog() {
    }

    public static List<Parapharmacy> getSeedProducts() {
        return List.of(
                product("Doliprane 500mg", 7.90, "Pain Relief"),
                product("Doliprane 1000mg", 11.50, "Pain Relief"),
                product("Efferalgan 500mg", 8.20, "Pain Relief"),
                product("Nurofen 200mg", 9.80, "Pain Relief"),
                product("Advil 200mg", 8.70, "Pain Relief"),
                product("Arnica Gel", 19.60, "Pain Relief"),

                product("Vitamin C 1000mg", 13.20, "Vitamins"),
                product("Zinc + Vitamin C", 18.50, "Vitamins"),
                product("Magnesium B6", 19.90, "Vitamins"),
                product("Omega 3 Capsules", 24.80, "Supplements"),
                product("Multivitamin Adult", 22.40, "Vitamins"),
                product("Vitamin D3 2000 IU", 15.70, "Vitamins"),
                product("Collagen Beauty Capsules", 55.60, "Supplements"),

                product("Vichy Mineral 89 Serum", 79.00, "Skincare"),
                product("La Roche-Posay Cicaplast Baume B5", 58.00, "Dermatology"),
                product("Bioderma Sebium H2O", 47.90, "Dermatology"),
                product("CeraVe Moisturizing Cream", 49.90, "Dermatology"),
                product("Cetaphil Gentle Skin Cleanser", 45.30, "Dermatology"),
                product("Nuxe Reve de Miel Lip Balm", 32.50, "Skincare"),
                product("Sunscreen SPF50 Vichy", 75.00, "Sun Care"),
                product("Sunscreen SPF50 Avene", 73.50, "Sun Care"),
                product("Anti-itch Cream", 23.90, "Dermatology"),

                product("Toplexil Syrup", 18.70, "Respiratory"),
                product("Strepsils Lozenges", 9.80, "Respiratory"),
                product("Vicks VapoRub", 20.40, "Respiratory"),
                product("Humer Nasal Spray", 14.20, "Respiratory"),
                product("Propolis Spray", 20.90, "Respiratory"),

                product("Smecta", 11.70, "Digestive"),
                product("Gaviscon", 14.90, "Digestive"),
                product("Enterogermina", 22.30, "Digestive"),
                product("Buscopan", 16.20, "Digestive"),
                product("Probiotic Complex", 28.70, "Digestive"),

                product("Mustela Gentle Cleansing Gel", 39.80, "Baby"),
                product("Mustela Diaper Cream", 35.50, "Baby"),
                product("Pampers New Baby", 42.90, "Baby"),

                product("Sensodyne Repair & Protect", 21.10, "Oral Care"),
                product("Listerine Mouthwash", 13.90, "Oral Care"),

                product("Optive Eye Drops", 26.40, "Eye Care"),

                product("Hand Sanitizer Gel", 7.90, "Hygiene"),
                product("Antibacterial Soap", 6.50, "Hygiene"),

                product("Betadine Antiseptic", 12.20, "First Aid"),
                product("Steri-Strip Wound Closures", 18.80, "First Aid"),

                product("Foot Cream Urea", 21.20, "Wellness"),
                product("Night Repair Cream", 69.50, "Wellness")
        );
    }

    private static Parapharmacy product(String name, double price, String category) {
        return new Parapharmacy(
                name,
                buildDescription(name, category),
                price,
                defaultStock(category),
                category,
                ""
        );
    }

    private static String buildDescription(String name, String category) {
        return switch (category) {
            case "Pain Relief" -> name + " helps support everyday relief for headaches, fever, and muscle discomfort.";
            case "Vitamins" -> name + " is a daily vitamin supplement designed to support immunity and energy.";
            case "Supplements" -> name + " supports balanced nutrition and wellness with a convenient daily format.";
            case "Skincare" -> name + " offers gentle care for hydration, repair, and daily skin comfort.";
            case "Dermatology" -> name + " is suitable for sensitive skin and targeted barrier repair.";
            case "Sun Care" -> name + " provides high-protection daily sun care for exposed skin.";
            case "Respiratory" -> name + " is commonly used for throat comfort, cough support, and cold-season care.";
            case "Digestive" -> name + " supports digestion, stomach comfort, and digestive balance.";
            case "Baby" -> name + " is tailored for gentle baby care and daily family essentials.";
            case "Oral Care" -> name + " helps maintain daily oral hygiene and long-term comfort.";
            case "Eye Care" -> name + " offers convenient support for dry, tired, or irritated eyes.";
            case "Hygiene" -> name + " is a practical hygiene essential for everyday use.";
            case "First Aid" -> name + " is useful for household first-aid routines and minor care needs.";
            default -> name + " is a curated wellness product in the PinkShield parapharmacy catalog.";
        };
    }

    private static int defaultStock(String category) {
        return switch (category) {
            case "Pain Relief", "Respiratory", "Digestive", "Hygiene" -> 22;
            case "Vitamins", "Supplements", "Oral Care", "First Aid" -> 16;
            case "Skincare", "Dermatology", "Sun Care", "Eye Care", "Wellness" -> 12;
            case "Baby" -> 14;
            default -> 10;
        };
    }
}
