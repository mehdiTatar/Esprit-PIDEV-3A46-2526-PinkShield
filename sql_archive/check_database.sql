-- Check if parapharmacie table has data
SELECT 'Checking parapharmacie table...' AS status;
SELECT COUNT(*) as product_count FROM parapharmacie;
SELECT * FROM parapharmacie LIMIT 5;

-- Check wishlist
SELECT 'Checking wishlist table...' AS status;
SELECT COUNT(*) as wishlist_count FROM wishlist;
SELECT * FROM wishlist LIMIT 5;

