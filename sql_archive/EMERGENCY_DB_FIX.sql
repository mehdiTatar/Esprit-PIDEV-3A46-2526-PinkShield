-- EMERGENCY DATABASE FIX
-- This will completely reset the database

DROP DATABASE IF EXISTS pinkshield_db;

CREATE DATABASE pinkshield_db;
USE pinkshield_db;

-- ============================================================================
-- PARAPHARMACIE TABLE (FIXED SCHEMA)
-- ============================================================================
CREATE TABLE parapharmacie (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL UNIQUE,
  prix DOUBLE NOT NULL,
  stock INT(11) NOT NULL DEFAULT 0,
  description TEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================================
-- APPOINTMENT TABLE
-- ============================================================================
CREATE TABLE appointment (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  patient_email VARCHAR(255) NOT NULL,
  patient_name VARCHAR(255) NOT NULL,
  doctor_email VARCHAR(255) DEFAULT 'doctor@clinic.com',
  doctor_name VARCHAR(255) NOT NULL,
  appointment_date DATETIME NOT NULL,
  status VARCHAR(50) NOT NULL DEFAULT 'pending',
  notes TEXT DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================================
-- WISHLIST TABLE (FIXED - ensure correct column names)
-- ============================================================================
CREATE TABLE wishlist (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT(11) NOT NULL DEFAULT 1,
  parapharmacie_id INT(11) NOT NULL,
  added_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_wishlist (user_id, parapharmacie_id),
  FOREIGN KEY (parapharmacie_id) REFERENCES parapharmacie(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================================
-- INSERT SAMPLE DATA
-- ============================================================================
INSERT INTO parapharmacie (nom, prix, stock, description) VALUES
('Aspirin 500mg', 5.99, 150, 'Pain relief medication'),
('Ibuprofen 200mg', 7.50, 120, 'Anti-inflammatory medicine'),
('Paracetamol 500mg', 4.25, 200, 'Fever reducer'),
('Vitamin C 1000mg', 8.99, 100, 'Immune booster'),
('Multivitamin Complex', 12.99, 80, 'Daily supplement'),
('Cough Syrup 200ml', 6.49, 60, 'Cough suppressant');

INSERT INTO appointment (patient_email, patient_name, doctor_email, doctor_name, appointment_date, status, notes) VALUES
('john@example.com', 'John Doe', 'dr.smith@clinic.com', 'Dr. Smith', '2026-04-20 10:00:00', 'pending', 'Annual checkup'),
('jane@example.com', 'Jane Smith', 'dr.brown@clinic.com', 'Dr. Brown', '2026-04-21 14:30:00', 'confirmed', 'Follow-up visit');

INSERT INTO wishlist (user_id, parapharmacie_id) VALUES
(1, 1), (1, 2);

-- ============================================================================
-- VERIFICATION
-- ============================================================================
SELECT '✓ Database reset and fixed!' AS status;
SELECT COUNT(*) as products FROM parapharmacie;
SELECT COUNT(*) as appointments FROM appointment;
SELECT COUNT(*) as wishlist_items FROM wishlist;
