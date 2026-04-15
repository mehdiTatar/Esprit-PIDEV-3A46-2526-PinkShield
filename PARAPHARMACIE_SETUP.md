# 🎉 Parapharmacie Cards UI - Setup Guide

## What Was Done
✅ Converted parapharmacie section from table view to **beautiful product cards**  
✅ Each card shows: Product name, Price, Stock quantity  
✅ Added **"❤️ Add to Wishlist"** button to each card  
✅ Integrated with wishlist database (hardcoded user_id=1)  
✅ Real-time search filter  
✅ Refresh button to reload products from database  
✅ Professional styling with shadows and hover effects  

## How to Run

### Option 1: Using Batch Script (Recommended)
```batch
C:\Users\driss\IdeaProjects\Projet_java\WORKING_RUN.bat
```

### Option 2: From IntelliJ IDEA
1. Open the project
2. Run the `SimpleLauncher` configuration
3. Click the "Parapharmacie" tab

## ⚠️ Important: Database Setup Required

**Before running the app, you MUST setup the database!**

### Step 1: Make sure MySQL is running
- Windows: Open Services (services.msc) and start "MySQL80" (or your MySQL version)

### Step 2: Create the database and tables
```bash
mysql -u root -p < setup_database.sql
```
When prompted for password, just press Enter (if you haven't set one)

Or manually:
```sql
-- Connect to MySQL and run the SQL in setup_database.sql
mysql -u root
USE pinkshield_db;
-- Then paste the contents of setup_database.sql
```

### Step 3: Verify data was inserted
```sql
SELECT * FROM parapharmacie;
-- Should show at least 3 sample products:
-- - Aspirin 500mg ($5.99, 100 stock)
-- - Ibuprofen 200mg ($7.50, 75 stock)  
-- - Paracetamol 500mg ($4.25, 120 stock)
```

## Features

### 1. **View Products**
- Products display as beautiful cards with shadows
- Each card shows: 📦 Name, 💰 Price, 📊 Stock

### 2. **Search Products**
- Type in the search bar to filter by product name
- Real-time filtering as you type

### 3. **Add to Wishlist**
- Click "❤️ Add to Wishlist" on any card
- Duplicate check prevents adding same item twice
- Product is saved to database with user_id=1

### 4. **Refresh Products**
- Click "🔄 Refresh Products" to reload from database
- Useful after adding new products

### 5. **Add New Products**
- Fill in Product Name, Price, Stock
- Click "✅ Ajouter" to add
- Product appears immediately in the card list

## Troubleshooting

### Products are empty?
1. Check if MySQL is running
2. Run `setup_database.sql` to create tables and insert sample data
3. Click "🔄 Refresh Products" button
4. Check console for error messages

### Database connection errors?
1. Verify MySQL is running
2. Check credentials in ServiceParapharmacie.java (default: root, no password)
3. Ensure database 'pinkshield_db' exists
4. Ensure tables exist: parapharmacie, wishlist

### Cards not showing even with data?
1. Click "🔄 Refresh Products" button
2. Check console for debug messages
3. The cards load automatically on app start

## File Locations
- **FXML**: `src/main/resources/parapharmacie.fxml`
- **Controller**: `src/main/java/org/example/ParapharmacieController.java`
- **Service**: `src/main/java/org/example/ServiceParapharmacie.java`
- **CSS**: `src/main/resources/style.css`
- **Database Setup**: `setup_database.sql`

## Next Steps
1. Setup database (see above)
2. Run the application
3. You should see 3 sample products as cards
4. Test "Add to Wishlist" functionality
5. Add your own products using the form

---
**Created**: April 15, 2026  
**Status**: ✅ Complete - Beautiful UI with working wishlist integration

