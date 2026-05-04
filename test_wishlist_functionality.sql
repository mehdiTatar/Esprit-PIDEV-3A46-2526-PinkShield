-- TEST WISHLIST FUNCTIONALITY
-- This script tests if the wishlist functionality works correctly

USE pinkshield_db;

-- Test 1: Check if user exists
SELECT 'TEST 1: Checking user table...' as test_info;
SELECT * FROM user LIMIT 5;

-- Test 2: Check if parapharmacie products exist
SELECT 'TEST 2: Checking parapharmacie table...' as test_info;
SELECT * FROM parapharmacie LIMIT 5;

-- Test 3: Test adding a wishlist item manually
SELECT 'TEST 3: Adding test wishlist item...' as test_info;
INSERT INTO wishlist (user_id, parapharmacie_id, added_at) 
VALUES (1, 1, NOW()) 
ON DUPLICATE KEY UPDATE added_at = NOW();

-- Test 4: Check if the item was added
SELECT 'TEST 4: Checking if wishlist item was added...' as test_info;
SELECT * FROM wishlist WHERE user_id = 1 AND parapharmacie_id = 1;

-- Test 5: Test foreign key constraint
SELECT 'TEST 5: Testing foreign key constraint with invalid ID...' as test_info;
INSERT INTO wishlist (user_id, parapharmacie_id, added_at) 
VALUES (1, 999, NOW());

-- Test 6: Check final wishlist state
SELECT 'TEST 6: Final wishlist state...' as test_info;
SELECT w.*, p.nom as product_name 
FROM wishlist w 
JOIN parapharmacie p ON w.parapharmacie_id = p.id 
WHERE w.user_id = 1;

SELECT 'Wishlist functionality test completed!' as status;
