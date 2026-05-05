-- CHECK ALL TABLES IN DATABASE
USE pinkshield_db;

-- Show all tables
SELECT 'ALL TABLES IN DATABASE:' as info;
SHOW TABLES;

-- Check if there are any user-related tables
SELECT 'USER-RELATED TABLES:' as info;
SHOW TABLES LIKE '%user%';

-- Check if there are any authentication tables
SELECT 'AUTHENTICATION TABLES:' as info;
SHOW TABLES LIKE '%auth%';
SHOW TABLES LIKE '%login%';
SHOW TABLES LIKE '%admin%';

-- Check what's in the admin table
SELECT 'ADMIN TABLE CONTENT:' as info;
SELECT * FROM admin LIMIT 5;

-- Check what's in the app_users table (if it exists)
SELECT 'APP_USERS TABLE CONTENT:' as info;
SELECT * FROM app_users LIMIT 5;
