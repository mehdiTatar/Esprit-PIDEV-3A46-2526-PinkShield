-- CHECK PARAPHARMACIE DATA AND FIX FOREIGN KEY ISSUES
USE pinkshield_db;

-- Check what's in parapharmacie table
SELECT 'PARAPHARMACIE TABLE DATA:' as info;
SELECT * FROM parapharmacie;

-- Check what's in wishlist table
SELECT 'WISHLIST TABLE DATA:' as info;
SELECT * FROM wishlist;

-- Check if there are any orphaned wishlist entries
SELECT 'ORPHANED WISHLIST ENTRIES:' as info;
SELECT w.* FROM wishlist w 
LEFT JOIN parapharmacie p ON w.parapharmacie_id = p.id 
WHERE p.id IS NULL;

-- Fix orphaned entries by removing them
DELETE w FROM wishlist w 
LEFT JOIN parapharmacie p ON w.parapharmacie_id = p.id 
WHERE p.id IS NULL;

-- Add some sample parapharmacie data if table is empty
INSERT IGNORE INTO parapharmacie (nom, prix, stock, description) VALUES
('Paracetamol 500mg', 5.50, 100, 'Pain reliever medication'),
('Ibuprofen 400mg', 8.75, 50, 'Anti-inflammatory medication'),
('Vitamin C 1000mg', 12.99, 75, 'Immune system support'),
('Aspirin 100mg', 4.25, 120, 'Blood thinner and pain reliever'),
('Antiseptic Solution', 15.99, 30, 'Wound cleaning solution');

-- Verify the data
SELECT 'FINAL PARAPHARMACIE DATA:' as info;
SELECT * FROM parapharmacie ORDER BY id;

SELECT 'FINAL WISHLIST DATA:' as info;
SELECT * FROM wishlist ORDER BY id;
