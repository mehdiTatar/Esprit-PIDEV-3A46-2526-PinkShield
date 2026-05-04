@echo off
echo Running wishlist database fix...
"C:\xampp\mysql\bin\mysql.exe" -u root pinkshield_db < FIX_WISHLIST_DATABASE.sql
echo Wishlist fix completed!
pause
