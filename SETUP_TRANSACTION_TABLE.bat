@echo off
REM ============================================================================
REM Create Transaction History Table in MySQL
REM This script will add the transaction_history table to your database
REM ============================================================================

echo.
echo 📬 Creating Transaction History Table...
echo.

REM Run the SQL file
mysql -u root -p pinkshield_db < CREATE_TRANSACTION_TABLE.sql

if %errorlevel% equ 0 (
    echo.
    echo ✅ SUCCESS! Transaction history table created!
    echo.
    echo You can now:
    echo 1. Close the app completely
    echo 2. Restart the app
    echo 3. Make a payment - it will be saved in transaction history
    echo.
    pause
) else (
    echo.
    echo ❌ ERROR! Could not create table
    echo Make sure MySQL is running and you have the correct password
    echo.
    pause
)

