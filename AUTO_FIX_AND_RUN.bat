@echo off
REM AUTO-FIX: Setup Database and Run App

echo.
echo ═══════════════════════════════════════════════════════════════
echo          🎀 PINKSHIELD - AUTO SETUP & RUN 🎀
echo ═══════════════════════════════════════════════════════════════
echo.

REM Step 1: Create database
echo Step 1: Setting up database...
mysql -u root < INSTANT_FIX.sql

if %errorlevel% neq 0 (
    echo.
    echo ERROR: MySQL command failed
    echo Make sure MySQL is running and in your PATH
    echo See RUN_THIS_NOW.txt for manual instructions
    pause
    exit /b 1
)

echo.
echo ✓ Database setup complete!
echo.
echo Step 2: Starting application...
echo.

REM Step 2: Run app
WORKING_RUN.bat

endlocal

