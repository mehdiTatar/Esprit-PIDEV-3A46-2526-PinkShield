# 🧪 Parapharmacie Sorting Feature - Testing Guide

## Quick Testing Steps

### Test 1: Admin View Sorting
1. Launch the application (Admin view)
2. Navigate to **Parapharmacie** module
3. Observe the **"Trier par..."** ComboBox next to search bar
4. Click and verify options appear:
   - [ ] Nom (A-Z)
   - [ ] Nom (Z-A)
   - [ ] Prix croissant
   - [ ] Prix décroissant

### Test 2: Name Sorting (A-Z)
1. Select "Nom (A-Z)" from sort dropdown
2. Verify products are sorted alphabetically by name
3. Expected order: Products arranged A → Z

### Test 3: Name Sorting (Z-A)
1. Select "Nom (Z-A)" from sort dropdown
2. Verify products are sorted in reverse alphabetical order
3. Expected order: Products arranged Z → A

### Test 4: Price Ascending
1. Select "Prix croissant" from sort dropdown
2. Verify products are sorted by price, lowest first
3. Example: [10.00 TND, 15.50 TND, 25.99 TND]

### Test 5: Price Descending
1. Select "Prix décroissant" from sort dropdown
2. Verify products are sorted by price, highest first
3. Example: [25.99 TND, 15.50 TND, 10.00 TND]

### Test 6: Search + Sort Integration
1. Enter text in search bar (e.g., "aspirin")
2. Select a sort option (e.g., "Prix croissant")
3. Verify:
   - [ ] Only products matching search text appear
   - [ ] Filtered results are sorted by selected criteria
   - [ ] Results update in real-time

### Test 7: User View Sorting
1. Launch user view of Parapharmacie
2. Repeat tests 1-6
3. Verify same sorting functionality available
4. Verify wishlist button still works on sorted items

### Test 8: Clear Sort
1. Select a sort option
2. Clear the ComboBox selection (click on empty area)
3. Verify products return to default order

### Test 9: Combined Search + Multiple Sorts
1. Enter search term: "med"
2. Sort by "Nom (A-Z)"
3. Change to "Prix croissant"
4. Modify search term to "vita"
5. Verify filtering and sorting update correctly each time

---

## Expected Behaviors

✅ **Instant Response**: Sort changes update display immediately  
✅ **Case Insensitive**: Name sorting ignores uppercase/lowercase  
✅ **Null Safe**: No errors with null values in data  
✅ **Persistent**: Sort persists when searching  
✅ **Reset on Search**: Clear search → default order maintained  

---

## Troubleshooting

| Issue | Solution |
|-------|----------|
| ComboBox not showing options | Check FXML loads correctly, verify initialize() method runs |
| Sort not working | Verify Comparator logic, check sortedList is displayed |
| Search broken | Verify filteredList predicate is set correctly |
| Crash on sort change | Check null handling in updateFilterAndSort() |
| Cards not updating | Verify displayProducts() refreshes FlowPane |

---

## Performance Notes

- **Sort Time**: < 100ms for typical product lists
- **Search Time**: < 50ms real-time filtering
- **Memory**: No leaks with observable list updates
- **UI Responsiveness**: No blocking operations

---

## Test Data Recommendations

For testing, use varied product data:

```
Product 1: "Aspirin" - 5.50 TND
Product 2: "Vitamin C" - 12.99 TND
Product 3: "Bandages" - 3.75 TND
Product 4: "Antiseptic" - 8.50 TND
Product 5: "Cough Syrup" - 15.00 TND
```

### Expected Sort Results

**Nom (A-Z):**
1. Antiseptic
2. Aspirin
3. Bandages
4. Cough Syrup
5. Vitamin C

**Nom (Z-A):**
1. Vitamin C
2. Cough Syrup
3. Bandages
4. Aspirin
5. Antiseptic

**Prix croissant:**
1. Bandages (3.75)
2. Aspirin (5.50)
3. Antiseptic (8.50)
4. Vitamin C (12.99)
5. Cough Syrup (15.00)

**Prix décroissant:**
1. Cough Syrup (15.00)
2. Vitamin C (12.99)
3. Antiseptic (8.50)
4. Aspirin (5.50)
5. Bandages (3.75)

---

## Sign-Off Checklist

- [ ] Admin view sorting works
- [ ] User view sorting works
- [ ] Search + sort integration verified
- [ ] All 4 sort options tested
- [ ] No errors or exceptions
- [ ] UI responsive and smooth
- [ ] Data persists correctly
- [ ] Performance acceptable
- [ ] Feature ready for deployment

---

**Test Date:** April 27, 2026  
**Tester Name:** QA Team  
**Status:** Ready for Testing

