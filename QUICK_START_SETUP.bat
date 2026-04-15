@echo off
REM Quick Start Guide for PinkShield Healthcare System

echo.
echo =========================================
echo    PinkShield - Quick Start Guide
echo =========================================
echo.
echo This script will help you get started.
echo.
echo Step 1: Setup Database
echo =====================
echo.
echo IMPORTANT: Before running the app, you need to:
echo 1. Make sure MySQL is RUNNING
echo    - Open Services (services.msc)
echo    - Start "MySQL80" (or your MySQL version)
echo.
echo 2. Setup the database:
echo    - Open MySQL command line or MySQL Workbench
echo    - Run the SQL from: setup_database.sql
echo    - Or paste it into MySQL manually
echo.
echo 3. Verify the database:
echo    - Run: mysql -u root
echo    - Then: USE pinkshield_db;
echo    - Then: SELECT * FROM parapharmacie;
echo    - Should see 3 sample products
echo.
pause
echo.
echo Step 2: Run the Application
echo ===========================
echo.
echo Press ENTER to start the application...
pause
echo.

C:\Users\driss\IdeaProjects\Projet_java\WORKING_RUN.bat

endlocal

