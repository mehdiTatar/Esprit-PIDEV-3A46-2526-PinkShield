@echo off
echo Testing wishlist functionality...
"C:\xampp\mysql\bin\mysql.exe" -u root pinkshield_db < test_wishlist_functionality_fixed.sql
echo Wishlist test completed!
pause
