-- TEST WISHLIST FUNCTIONALITY
-- This script tests if the wishlist functionality works correctly

USE pinkshield_db;

-- Test 1: Check what user tables exist
SELECT 'TEST 1: Checking available tables...' as test_info;
SHOW TABLES LIKE '%user%';

-- Test 2: Check if app_users table exists and has data
SELECT 'TEST 2: Checking app_users table...' as test_info;
SELECT * FROM app_users LIMIT 5;

-- Test 3: Check if parapharmacie products exist
SELECT 'TEST 3: Checking parapharmacie table...' as test_info;
SELECT * FROM parapharmacie LIMIT 5;

-- Test 4: Test adding a wishlist item manually (using user_id 1 if it exists)
SELECT 'TEST 4: Adding test wishlist item...' as test_info;
INSERT INTO wishlist (user_id, parapharmacie_id, added_at) 
VALUES (1, 1, NOW()) 
ON DUPLICATE KEY UPDATE added_at = NOW();

-- Test 5: Check if the item was added
SELECT 'TEST 5: Checking if wishlist item was added...' as test_info;
SELECT * FROM wishlist WHERE user_id = 1 AND parapharmacie_id = 1;

-- Test 6: Test foreign key constraint (this should fail)
SELECT 'TEST 6: Testing foreign key constraint with invalid ID...' as test_info;
INSERT INTO wishlist (user_id, parapharmacie_id, added_at) 
VALUES (1, 999, NOW());

-- Test 7: Check final wishlist state
SELECT 'TEST 7: Final wishlist state...' as test_info;
SELECT w.*, p.nom as product_name 
FROM wishlist w 
JOIN parapharmacie p ON w.parapharmacie_id = p.id 
WHERE w.user_id = 1;

SELECT 'Wishlist functionality test completed!' as status;
