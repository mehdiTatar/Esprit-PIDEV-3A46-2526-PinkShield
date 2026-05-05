package org.example;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

public final class ProductCatalog {

    private static final List<Product> INVENTORY = Collections.unmodifiableList(buildInventory());

    private ProductCatalog() {
    }

    public static List<Product> getInventory() {
        return new ArrayList<>(INVENTORY);
    }

    private static List<Product> buildInventory() {
        List<Product> products = new ArrayList<>();

        // Pain relief / fever
        products.add(p("Doliprane 500mg", 7.900, "Pain Relief"));
        products.add(p("Doliprane 1000mg", 11.500, "Pain Relief"));
        products.add(p("Panado 500mg", 7.500, "Pain Relief"));
        products.add(p("Panado Forte", 10.900, "Pain Relief"));
        products.add(p("Efferalgan 500mg", 8.200, "Pain Relief"));
        products.add(p("Efferalgan 1g", 12.300, "Pain Relief"));
        products.add(p("Nurofen 200mg", 9.800, "Pain Relief"));
        products.add(p("Nurofen 400mg", 13.400, "Pain Relief"));
        products.add(p("Advil 200mg", 8.700, "Pain Relief"));
        products.add(p("Aspirin Protect", 9.100, "Pain Relief"));

        // Vitamins / supplements
        products.add(p("Vitamin C 1000mg", 13.200, "Vitamins"));
        products.add(p("Zinc + Vitamin C", 18.500, "Vitamins"));
        products.add(p("Magnesium B6", 19.900, "Vitamins"));
        products.add(p("Omega 3 Capsules", 24.800, "Supplements"));
        products.add(p("Multivitamin Adult", 22.400, "Vitamins"));
        products.add(p("Berocca Boost", 28.900, "Vitamins"));
        products.add(p("Supradyn Energy", 29.500, "Vitamins"));
        products.add(p("Iron + Folic Acid", 16.900, "Supplements"));
        products.add(p("Calcium D3", 21.300, "Supplements"));
        products.add(p("Vitamin D3 2000 IU", 15.700, "Vitamins"));

        // Dermatology / skincare
        products.add(p("Vichy Mineral 89 Serum", 79.000, "Skincare"));
        products.add(p("Vichy Liftactiv Supreme", 145.000, "Skincare"));
        products.add(p("Vichy Normaderm Gel", 62.000, "Skincare"));
        products.add(p("La Roche-Posay Cicaplast Baume B5", 58.000, "Dermatology"));
        products.add(p("La Roche-Posay Effaclar Gel", 66.500, "Dermatology"));
        products.add(p("Avène Cleanance Gel", 54.800, "Dermatology"));
        products.add(p("Avène Thermal Water Spray", 31.500, "Dermatology"));
        products.add(p("Bioderma Sébium H2O", 47.900, "Dermatology"));
        products.add(p("Bioderma Atoderm Cream", 53.200, "Dermatology"));
        products.add(p("Bioderma Photoderm SPF50", 72.000, "Sun Care"));
        products.add(p("Uriage Xémose Balm", 61.400, "Dermatology"));
        products.add(p("CeraVe Moisturizing Cream", 49.900, "Dermatology"));
        products.add(p("Eucerin UreaRepair Lotion", 57.800, "Dermatology"));
        products.add(p("Mustela Hydra Bébé", 44.500, "Baby Care"));
        products.add(p("Mustela Stelatopia Cream", 59.900, "Baby Care"));
        products.add(p("Nuxe Huile Prodigieuse", 89.000, "Skincare"));
        products.add(p("Nuxe Rêve de Miel Lip Balm", 32.500, "Skincare"));
        products.add(p("SVR Sebiaclear Hydra", 61.200, "Dermatology"));
        products.add(p("Nivea Soft Cream", 18.900, "Skincare"));
        products.add(p("Cetaphil Gentle Skin Cleanser", 45.300, "Dermatology"));

        // Respiratory / cold / throat
        products.add(p("Toplexil Syrup", 18.700, "Respiratory"));
        products.add(p("Actifed Syrup", 16.900, "Respiratory"));
        products.add(p("Strepsils Lozenges", 9.800, "Respiratory"));
        products.add(p("Hexaspray", 15.500, "Respiratory"));
        products.add(p("Vicks VapoRub", 20.400, "Respiratory"));
        products.add(p("Sinutab", 17.300, "Respiratory"));
        products.add(p("Humer Nasal Spray", 14.200, "Respiratory"));
        products.add(p("Physiomer Nasal Spray", 19.100, "Respiratory"));
        products.add(p("Bronchostop Syrup", 21.700, "Respiratory"));
        products.add(p("Humex Cold", 18.200, "Respiratory"));

        // Digestive / stomach
        products.add(p("Smecta", 11.700, "Digestive"));
        products.add(p("Gaviscon", 14.900, "Digestive"));
        products.add(p("Maalox", 13.600, "Digestive"));
        products.add(p("Motilium", 15.800, "Digestive"));
        products.add(p("Spasfon Lyoc", 10.900, "Digestive"));
        products.add(p("Enterogermina", 22.300, "Digestive"));
        products.add(p("Probiotical", 25.400, "Digestive"));
        products.add(p("Buscopan", 16.200, "Digestive"));
        products.add(p("Lacteol", 23.100, "Digestive"));
        products.add(p("Normacol", 12.800, "Digestive"));

        // Baby care / hygiene
        products.add(p("Mustela Gentle Cleansing Gel", 39.800, "Baby Care"));
        products.add(p("Mustela Diaper Cream", 35.500, "Baby Care"));
        products.add(p("Chicco Baby Lotion", 29.900, "Baby Care"));
        products.add(p("Bebisol Formula", 68.000, "Baby Care"));
        products.add(p("Bepanthen Ointment", 24.600, "First Aid"));
        products.add(p("Sudocrem", 28.300, "Baby Care"));
        products.add(p("Pampers New Baby", 42.900, "Baby Care"));
        products.add(p("Johnson's Baby Oil", 19.500, "Baby Care"));
        products.add(p("Nivea Baby Cream", 17.900, "Baby Care"));
        products.add(p("Cetaphil Baby Wash", 31.900, "Baby Care"));

        // Eye care / oral / ear
        products.add(p("Optive Eye Drops", 26.400, "Eye Care"));
        products.add(p("Hylo-Comod Eye Drops", 49.200, "Eye Care"));
        products.add(p("Artelac Splash", 45.700, "Eye Care"));
        products.add(p("Sensodyne Repair & Protect", 21.100, "Oral Care"));
        products.add(p("Elmex Toothpaste", 16.300, "Oral Care"));
        products.add(p("Parodontax Toothpaste", 17.800, "Oral Care"));
        products.add(p("Listerine Mouthwash", 13.900, "Oral Care"));
        products.add(p("Oral-B Toothbrush", 11.500, "Oral Care"));
        products.add(p("Otrivin Baby Aspirator", 22.900, "Baby Care"));
        products.add(p("Ear Clean Spray", 14.700, "Ear Care"));

        // First aid / protective / skin-specific
        products.add(p("Betadine Antiseptic", 12.200, "First Aid"));
        products.add(p("Mercurochrome Spray", 10.500, "First Aid"));
        products.add(p("Steri-Strip Wound Closures", 18.800, "First Aid"));
        products.add(p("Compeed Blister Patches", 21.900, "First Aid"));
        products.add(p("Elastic Bandage", 8.300, "First Aid"));
        products.add(p("Salicylic Acid Acne Gel", 24.400, "Dermatology"));
        products.add(p("Hand Sanitizer Gel", 7.900, "Hygiene"));
        products.add(p("Antibacterial Soap", 6.500, "Hygiene"));
        products.add(p("Sunscreen SPF50 Vichy", 75.000, "Sun Care"));
        products.add(p("Sunscreen SPF50 Avène", 73.500, "Sun Care"));

        // Hair / beauty / supplements / extras
        products.add(p("Collagen Beauty Capsules", 55.600, "Supplements"));
        products.add(p("Propolis Spray", 20.900, "Respiratory"));
        products.add(p("Magnesium Glycinate", 26.800, "Supplements"));
        products.add(p("Probiotic Complex", 28.700, "Digestive"));
        products.add(p("Throat Lozenges Honey", 8.900, "Respiratory"));
        products.add(p("Nasal Decongestant Spray", 14.400, "Respiratory"));
        products.add(p("Arnica Gel", 19.600, "Pain Relief"));
        products.add(p("Anti-itch Cream", 23.900, "Dermatology"));
        products.add(p("Foot Cream Urea", 21.200, "Skincare"));
        products.add(p("Night Repair Cream", 69.500, "Skincare"));

        return products;
    }

    private static Product p(String name, double price, String category) {
        return new Product(name, price, category);
    }
}

