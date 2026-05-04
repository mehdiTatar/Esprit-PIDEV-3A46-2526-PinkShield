@echo off
echo Checking all database tables...
"C:\xampp\mysql\bin\mysql.exe" -u root pinkshield_db < check_all_tables.sql
echo Database check completed!
pause
