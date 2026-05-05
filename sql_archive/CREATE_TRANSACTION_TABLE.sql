-- ============================================================================
-- Create Transaction History Table in Existing Database
-- Run this in MySQL to add transaction tracking to PinkShield
-- ============================================================================

USE pinkshield_db;

-- Create transaction_history table if it doesn't exist
CREATE TABLE IF NOT EXISTS transaction_history (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  amount DOUBLE NOT NULL,
  status VARCHAR(50) NOT NULL DEFAULT 'Completed',
  transaction_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_user_id (user_id),
  KEY idx_date (transaction_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Verify table was created
SHOW TABLES LIKE 'transaction_history';
SELECT 'Transaction history table ready!' as status;

