-- ============================================================================
-- PinkShield Healthcare & Commerce Management System
-- Complete Database Setup Script
-- ============================================================================

-- Create database
CREATE DATABASE IF NOT EXISTS pinkshield_db;
USE pinkshield_db;

-- Drop existing tables to start fresh
DROP TABLE IF EXISTS wishlist;
DROP TABLE IF EXISTS transaction_history;
DROP TABLE IF EXISTS parapharmacie;
DROP TABLE IF EXISTS appointment;

-- ============================================================================
-- Appointment Table
-- ============================================================================
CREATE TABLE appointment (
  id INT(11) NOT NULL AUTO_INCREMENT,
  patient_email VARCHAR(255) NOT NULL,
  patient_name VARCHAR(255) NOT NULL,
  doctor_email VARCHAR(255) NOT NULL,
  doctor_name VARCHAR(255) NOT NULL,
  appointment_date DATETIME NOT NULL,
  status VARCHAR(50) NOT NULL DEFAULT 'pending',
  notes TEXT DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY unique_appointment (patient_email, appointment_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- Parapharmacie Table
-- ============================================================================
CREATE TABLE parapharmacie (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL UNIQUE,
  prix DOUBLE NOT NULL,
  stock INT(11) NOT NULL DEFAULT 0,
  description TEXT DEFAULT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_nom (nom),
  KEY idx_prix (prix)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- Wishlist Table
-- ============================================================================
CREATE TABLE wishlist (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  parapharmacie_id INT(11) NOT NULL,
  added_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY unique_wishlist (user_id, parapharmacie_id),
  KEY idx_user (user_id),
  KEY idx_product (parapharmacie_id),
  FOREIGN KEY (parapharmacie_id) REFERENCES parapharmacie(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- Transaction History Table (stores user purchases)
-- ============================================================================
CREATE TABLE transaction_history (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  amount DOUBLE NOT NULL,
  status VARCHAR(50) NOT NULL DEFAULT 'Completed',
  transaction_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY user_id (user_id),
  KEY idx_date (transaction_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================================
-- Insert Sample Data
-- ============================================================================

-- Sample Products for Parapharmacie
INSERT INTO parapharmacie (nom, prix, stock, description) VALUES
('Aspirin 500mg', 5.99, 150, 'Effective pain relief and fever reducer'),
('Ibuprofen 200mg', 7.50, 120, 'Anti-inflammatory medication for pain management'),
('Paracetamol 500mg', 4.25, 200, 'Gentle fever and headache relief'),
('Vitamin C 1000mg', 8.99, 100, 'Immune system booster supplement'),
('Multivitamin Complex', 12.99, 80, 'Complete daily vitamin and mineral support'),
('Cough Syrup 200ml', 6.49, 60, 'Effective cough suppressant');

-- Sample Appointments
INSERT INTO appointment (patient_email, patient_name, doctor_email, doctor_name, appointment_date, status, notes) VALUES
('john@example.com', 'John Doe', 'dr.smith@clinic.com', 'Dr. Smith', '2026-04-20 10:00:00', 'pending', 'Annual checkup'),
('jane@example.com', 'Jane Smith', 'dr.brown@clinic.com', 'Dr. Brown', '2026-04-21 14:30:00', 'confirmed', 'Follow-up visit'),
('michael@example.com', 'Michael Johnson', 'dr.anderson@clinic.com', 'Dr. Anderson', '2026-04-22 09:00:00', 'pending', 'Consultation for new symptoms');

-- Sample Wishlist
INSERT INTO wishlist (user_id, parapharmacie_id) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 5);

-- ============================================================================
-- Verification Queries
-- ============================================================================
SELECT '✓ Database setup complete!' AS status;
SELECT 'Tables created:' AS info;
SELECT COUNT(*) as parapharmacie_count FROM parapharmacie;
SELECT COUNT(*) as appointment_count FROM appointment;
SELECT COUNT(*) as wishlist_count FROM wishlist;

SHOW TABLES;

