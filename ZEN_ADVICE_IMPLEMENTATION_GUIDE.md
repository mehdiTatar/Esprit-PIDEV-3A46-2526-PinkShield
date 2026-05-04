# 🧘 Zen & Wellness Advice Feature - Implementation Guide

## Overview
Your PinkShield application now includes a **"Zen & Health Tip"** feature that displays random wellness advice/quotes on the Dashboard to improve User Experience (UX).

---

## ✅ What Was Implemented

### 1. **ZenAdviceService.java** (NEW FILE)
**Location:** `src/main/java/org/example/ZenAdviceService.java`

**Features:**
- ✅ Uses **Java's native `HttpClient`** (HTTP/2 support)
- ✅ Makes GET requests to free API: `https://api.adviceslip.com/advice`
- ✅ **No API key required** - completely free!
- ✅ JSON parsing using **GSON** library
- ✅ **Non-blocking async** with `CompletableFuture.supplyAsync()`
- ✅ Fallback message for network errors: *"Prenez un moment pour respirer profondément aujourd'hui."*

**Key Code Snippets:**

```java
// Async fetch method (NON-BLOCKING)
public static CompletableFuture<String> fetchZenAdviceAsync() {
    return CompletableFuture.supplyAsync(() -> {
        try {
            return fetchZenAdvice();
        } catch (Exception e) {
            System.err.println("❌ Error fetching zen advice: " + e.getMessage());
            return FALLBACK_MESSAGE; // Fallback if network fails
        }
    });
}

// JSON Parsing with GSON
private static String parseAdviceFromJson(String jsonResponse) throws Exception {
    JsonObject jsonObject = JsonParser.parseString(jsonResponse).getAsJsonObject();
    JsonObject slip = jsonObject.getAsJsonObject("slip");
    String advice = slip.get("advice").getAsString();
    return "💡 " + advice;
}
```

---

### 2. **Dashboard.fxml** (UPDATED)
**Location:** `src/main/resources/Dashboard.fxml` (Lines 48-50)

Added a new **rounded purple banner** for wellness tips:

```xml
<HBox fx:id="zenAdviceBox" alignment="CENTER_LEFT" spacing="10" 
      style="-fx-padding: 15 18; -fx-background-radius: 12; -fx-border-radius: 12; 
              -fx-background-color: #f0f4ff; -fx-border-color: #7c3aed; -fx-border-width: 1.5;">
    <Label text="🧘 Loading wellness tip..." fx:id="zenQuoteLabel" 
           style="-fx-font-size: 13px; -fx-font-weight: 600; -fx-text-fill: #6d28d9;" 
           wrapText="true"/>
</HBox>
```

**Visual Result:**
- 🟣 Purple border with light blue background
- 🎨 Professional, modern appearance
- 📱 Responsive text wrapping
- 🧘 Zen/wellness emoji for visual appeal

---

### 3. **DashboardController.java** (UPDATED)
**Location:** `src/main/java/org/example/DashboardController.java`

**Changes Made:**

#### Added FXML Field Bindings (Lines 58-62):
```java
@FXML
private Label zenQuoteLabel;

@FXML
private HBox zenAdviceBox;
```

#### Updated initialize() Method (Lines 95-102):
```java
// Initialize zen advice widget with wellness tips
try {
    loadZenAdvice();
    System.out.println("✅ Zen advice widget loaded");
} catch (Exception e) {
    System.err.println("⚠️ Zen advice widget error: " + e.getMessage());
    // Don't crash app if zen advice fails
}
```

#### Added loadZenAdvice() Method (Lines 240-263):
- Calls `ZenAdviceService.fetchZenAdviceAsync()` 
- **Executes on background thread** (CompletableFuture)
- Uses `Platform.runLater()` to safely update UI thread
- Handles errors gracefully with fallback

```java
private void loadZenAdvice() {
    if (zenQuoteLabel == null || zenAdviceBox == null) {
        System.out.println("⚠️ Zen advice widget elements not found in FXML");
        return;
    }

    // Set default message while loading
    zenQuoteLabel.setText("🧘 Loading wellness tip...");

    // Fetch zen advice asynchronously (NON-BLOCKING)
    ZenAdviceService.fetchZenAdviceAsync()
            .thenAccept(advice -> {
                // Update UI on JavaFX thread using Platform.runLater()
                Platform.runLater(() -> {
                    updateZenAdvice(advice);
                });
            })
            .exceptionally(throwable -> {
                Platform.runLater(this::handleZenAdviceError);
                return null;
            });
}
```

#### Added updateZenAdvice() Method (Lines 268-279):
Updates the UI with fetched wellness advice

#### Added handleZenAdviceError() Method (Lines 284-292):
Displays fallback message with alternate styling if network fails

---

## 📋 How It Works (Flow Diagram)

```
1. Dashboard loads
   ↓
2. initialize() called in DashboardController
   ↓
3. loadZenAdvice() starts
   ↓
4. ZenAdviceService.fetchZenAdviceAsync() executes on BACKGROUND THREAD
   ↓
5. HTTP GET request to → https://api.adviceslip.com/advice
   ↓
6. Response: {"slip": {"id": 11, "advice": "Always trust your instincts."}}
   ↓
7. JSON parsed with GSON → Extract "advice" field
   ↓
8. Platform.runLater() → Updates UI on JAVAFX THREAD (thread-safe)
   ↓
9. zenQuoteLabel displays: "💡 Always trust your instincts."
   ↓
10. UI remains responsive (no freezing!)
```

---

## 🚀 Testing the Feature

### How to Test Locally:

1. **Open the Dashboard**
   - Launch your PinkShield app
   - Navigate to the Dashboard
   
2. **Look for the wellness banner**
   - Location: Below the weather widget (top section)
   - Initial text: "🧘 Loading wellness tip..."
   
3. **Wait for the advice to load**
   - API call is asynchronous (non-blocking)
   - UI remains responsive
   - After ~2-3 seconds, you should see random advice
   
4. **Example outputs you might see:**
   - "💡 Always trust your instincts."
   - "💡 Listen more than you talk."
   - "💡 Be grateful for what you have."

### To Test Multiple Times:
- **Restart the app** to fetch a new random piece of advice
- Each time the Dashboard initializes, a new advice is fetched

### To Test Error Handling:
- **Turn off WiFi/Internet**
- Launch the app
- You should see:
  - "💡 Prenez un moment pour respirer profondément aujourd'hui."
  - Banner turns yellow/amber to indicate fallback mode
  - No crashes! App remains stable

---

## 📡 API Details

### Endpoint Used:
```
https://api.adviceslip.com/advice
```

### Response Format:
```json
{
  "slip": {
    "id": 12345,
    "advice": "Your random advice here.",
    "permalink": "https://api.adviceslip.com/advice/12345"
  }
}
```

### Why This API?
✅ **Completely FREE** - no API key needed  
✅ **Reliable** - maintained service  
✅ **Simple JSON** - easy to parse  
✅ **Random advice** - different tip each time  

---

## 🎯 Key Implementation Details (CRITICAL FOR YOUR GRADE)

### ✅ Requirements Met:

1. **HTTP Client Logic** ✓
   - Uses Java 11+ native `java.net.http.HttpClient`
   - No external HTTP libraries needed
   - HTTP/2 support enabled

2. **JSON Parsing** ✓
   - Uses GSON library (already in your pom.xml)
   - Properly navigates nested JSON structure: `slip.advice`
   - Error handling for malformed JSON

3. **JavaFX UI Update** ✓
   - Label with fx:id="zenQuoteLabel"
   - Located in Dashboard.fxml inside rounded banner
   - Called in initialize() method of DashboardController

4. **CompletableFuture + Platform.runLater()** ✓
   - `ZenAdviceService.fetchZenAdviceAsync()` returns `CompletableFuture<String>`
   - HTTP request runs on **background thread**
   - UI update with `Platform.runLater()` on **JavaFX thread**
   - UI never freezes!

5. **Fallback Mechanism** ✓
   - Catches all exceptions silently
   - Displays French message: *"Prenez un moment pour respirer profondément aujourd'hui."*
   - Changes styling to yellow when fallback is used
   - App continues to work normally

---

## 📝 File Summary

| File | Status | Changes |
|------|--------|---------|
| `ZenAdviceService.java` | ✅ NEW | Complete HTTP + JSON implementation |
| `Dashboard.fxml` | ✅ UPDATED | Added zenAdviceBox (lines 48-50) |
| `DashboardController.java` | ✅ UPDATED | Added zones advice loading logic |
| `pom.xml` | ✅ NO CHANGE | GSON already included |

---

## 🐛 Troubleshooting

### Issue: "Loading wellness tip" never changes
**Solution:** Check your internet connection. The API call might be timing out.

### Issue: Yellow banner instead of purple
**Solution:** The fallback kicked in (no internet). Turn internet back on and restart the app.

### Issue: App crashes when opening Dashboard
**Solution:** This shouldn't happen! All exceptions are caught. Check console logs with:
```
System.out.println("✅ Zen advice widget loaded");
System.err.println("⚠️ Zen advice widget error:");
```

---

## 🎓 Learning Points

This implementation demonstrates:
1. **Async Programming** - `CompletableFuture` for non-blocking operations
2. **Thread Safety** - `Platform.runLater()` for JavaFX UI updates
3. **HTTP Networking** - Modern Java HTTP client (HTTP/2)
4. **JSON Parsing** - GSON library usage
5. **Error Handling** - Graceful fallbacks for network failures
6. **MVC Pattern** - Service layer separation (Service + Controller)
7. **Responsive UI** - No UI freezing during network calls

---

## ✨ What's Next?

You can extend this feature:
- 🎨 Add different quote categories (motivation, health, mindfulness)
- 📝 Cache quotes locally to work offline
- ❤️ Let users save favorite quotes
- 🔄 Auto-refresh at intervals (e.g., every 30 minutes)
- 🌐 Support multiple languages

---

**Happy coding! 🚀**

