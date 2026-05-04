@echo off
echo Checking and fixing parapharmacie database data...
"C:\xampp\mysql\bin\mysql.exe" -u root pinkshield_db < check_parapharmacie_data.sql
echo Database check completed!
pause
