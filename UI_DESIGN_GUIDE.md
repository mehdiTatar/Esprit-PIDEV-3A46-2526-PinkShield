# 📱 Parapharmacie UI - Visual Layout

## Application Structure

```
┌─────────────────────────────────────────────────────────────┐
│  💊 PinkShield - Healthcare & Commerce Management System    │
├──────────────┬──────────────────────────────────────────────┤
│ [Appoint.]   │  💊 Parapharmacie Management                 │
│ [Pharma]     ├─────────────────────────────────────────────┤
│ [Wishlist]   │ 🔍 Search by product name...                │
│              ├─────────────────────────────────────────────┤
│              │ ┌─ Add New Product ────────────────────────┐ │
│              │ │ Product Name: [________]  Price: [____]  │ │
│              │ │ Stock: [____]                             │ │
│              │ │ ✅ Ajouter  🗑️ Supprimer  🔄 Refresh    │ │
│              │ └────────────────────────────────────────────┘ │
│              │                                                 │
│              │ Available Products                              │
│              │ ┌──────────────┐  ┌──────────────┐  ┌────────┐│
│              │ │ 📦 Aspirin   │  │ 📦 Ibuprofen │  │ 📦    ││
│              │ │ 500mg        │  │ 200mg        │  │Paracel││
│              │ │              │  │              │  │        ││
│              │ │ 💰 $5.99     │  │ 💰 $7.50     │  │ 💰    ││
│              │ │ 📊 100 stock │  │ 📊 75 stock  │  │📊 120 ││
│              │ │              │  │              │  │        ││
│              │ │ ❤️ Add to    │  │ ❤️ Add to    │  │❤️ Add ││
│              │ │ Wishlist     │  │ Wishlist     │  │        ││
│              │ └──────────────┘  └──────────────┘  └────────┘│
│              │ (Scrollable area with more cards below)        │
└──────────────┴──────────────────────────────────────────────┘
```

## User Journey

### 1️⃣ View Products
```
App Starts
    ↓
Connect to Database
    ↓
Load Products from parapharmacie table
    ↓
Render as Beautiful Cards in FlowPane
    ↓
User sees: 3 sample products displayed
```

### 2️⃣ Search Products
```
User Types: "aspirin"
    ↓
Real-time Filter
    ↓
Display Matching Cards
    ↓
Shows: 1 product (Aspirin 500mg)
```

### 3️⃣ Add to Wishlist
```
User Clicks: ❤️ Add to Wishlist
    ↓
Check if already in wishlist
    ↓
Insert into database (user_id=1, product_id=X)
    ↓
Show Success Alert
    ↓
Wishlist now contains product
```

### 4️⃣ Add New Product
```
User Fills: Name, Price, Stock
    ↓
Clicks: ✅ Ajouter
    ↓
Validate Input
    ↓
Check for Duplicates
    ↓
Insert into database
    ↓
Show Success Message
    ↓
Reload Products (New product appears)
```

## Card Component Details

```
┌─────────────────────────────┐
│ 📦 Aspirin 500mg            │ ← Product Name
│                             │
│ 💰 Price: $5.99            │ ← Price Info
│ 📊 Stock: 100               │ ← Stock Info
│                             │
│ [❤️ Add to Wishlist]        │ ← Action Button
└─────────────────────────────┘
↑                             ↑
280px                       220px
(white background)
(drop shadow)
(rounded corners)
(hover effect)
```

## Styling Details

### Card Styling
- Background: White (#ffffff)
- Border: Light gray (#e0e0e0), 1px
- Border Radius: 10px
- Padding: 15px
- Box Shadow: dropshadow(0,0,0,0.1)
- Hover Shadow: Enhanced dropshadow(0,0,0,0.15)
- Hover Border: Pink (#e84393)

### Text Styling
- Product Name: Bold, 16px, Dark Gray (#333)
- Price/Stock: 14px, Medium Gray (#666)
- Button: 12px, White text

### Button Styling
- Background: Red (#ff6b6b)
- Text: White
- Radius: 5px
- Padding: 8px 15px
- Hover: Darker Red (#ee5a52)
- Width: Full card width

## Data Flow

```
┌──────────────────┐
│   MySQL DB       │
│  pinkshield_db   │
│                  │
│ parapharmacie:   │
│ - Aspirin        │
│ - Ibuprofen      │
│ - Paracetamol    │
│                  │
│ wishlist:        │
│ - user_id=1,     │
│   paraph_id=1    │
└────────┬─────────┘
         │ JDBC
         │ SELECT *
         │
┌────────▼─────────┐
│  Service Layer   │
│ ServicePharmacy  │
│ ServiceWishlist  │
└────────┬─────────┘
         │ Java Objects
         │
┌────────▼──────────────┐
│   Controller          │
│ ParapharmacieCtrl    │
│ - loadProducts()     │
│ - displayProducts()  │
│ - addToWishlist()    │
└────────┬──────────────┘
         │ Update UI
         │
┌────────▼──────────────┐
│   JavaFX UI          │
│ - FlowPane           │
│ - Product Cards      │
│ - Search Bar         │
│ - Buttons            │
└──────────────────────┘
```

## Color Palette

| Element | Color | Hex |
|---------|-------|-----|
| Primary (Buttons) | Pink | #e84393 |
| Background | Light Blue-Gray | #f5f6fa |
| Card Background | White | #ffffff |
| Text | Dark Gray | #2d3436 |
| Borders | Light Gray | #e8e9f3 |
| Wishlist Button | Red | #ff6b6b |
| Wishlist Hover | Dark Red | #ee5a52 |

---

**Visual Design**: Modern Card-Based Interface  
**Color Scheme**: Professional Pink & White  
**User Experience**: Intuitive and Responsive  
**Accessibility**: Clear labels with emojis

