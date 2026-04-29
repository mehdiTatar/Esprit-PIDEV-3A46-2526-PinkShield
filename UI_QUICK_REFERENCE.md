# PinkShield UI - Quick Reference Guide

## 🎨 Color Codes

### Copy-Paste Color Palette
```
Primary Pink:      #c0396b
Primary Light:     #ff6ba8
Primary Dark:      #9b2553

Doctor Teal:       #2dd4bf
Patient Blue:      #60a5fa
Admin Purple:      #a78bfa

Success:           #10b981
Error:             #ef4444
Warning:           #f59e0b
Info:              #3b82f6

Dark BG:           #060e1c
Surface:           #0a1525
Light Text:        #e8eaf6
Gray Text:         #8aa4c8
```

## 📐 Component Templates

### Form Field (Standard)
```xml
<VBox spacing="7">
    <Label text="FIELD NAME" styleClass="auth-field-label" />
    <TextField styleClass="text-field" />
</VBox>
```

### Metric Card
```xml
<VBox spacing="6" styleClass="metric-card metric-card-doctor">
    <Label text="LABEL" styleClass="metric-label" />
    <Label text="Value" styleClass="metric-value" />
    <Label text="Details" styleClass="table-meta" />
</VBox>
```

### Panel Card
```xml
<VBox spacing="16" styleClass="panel-card">
    <Label text="Title" styleClass="card-title" />
    <Separator style="-fx-opacity: 0.1;" />
    <!-- Content here -->
</VBox>
```

### Navigation Button
```xml
<Button text="📊 Dashboard" onAction="#handleAction"
       styleClass="nav-button active"
       style="-fx-min-width: 200;" />
```

### Primary Button
```xml
<Button text="Save" onAction="#handleSave"
       style="-fx-min-height: 44;"
       styleClass="button" />
```

### Secondary Button
```xml
<Button text="Cancel" onAction="#handleCancel"
       style="-fx-min-height: 44;"
       styleClass="button secondary" />
```

### Hero Panel
```xml
<HBox spacing="16" styleClass="hero-panel hero-panel-doctor">
    <VBox spacing="8">
        <Label text="Title" styleClass="dashboard-title" />
        <Label text="Subtitle" styleClass="dashboard-copy" />
    </VBox>
</HBox>
```

### Sidebar
```xml
<VBox styleClass="sidebar" prefWidth="240">
    <!-- Logo, Nav Buttons, Spacer, Logout -->
</VBox>
```

## 📏 Spacing Quick Ref

| Use Case | Value | CSS Class |
|----------|-------|-----------|
| No space | 0px | - |
| Tiny gaps | 4px | - |
| Small | 8px | - |
| Default | 12px | default |
| Medium-Large | 16px | - |
| Large | 20px | - |
| Section | 24px | - |
| Page padding | 28-32px | .content-area |

## 🎭 CSS Classes for Roles

### Doctor (Teal #2dd4bf)
- `.hero-panel-doctor`
- `.metric-card-doctor`
- `.role-doctor`

### Patient (Blue #60a5fa)
- `.hero-panel-user`
- `.metric-card-user`
- `.role-user`

### Admin (Purple #a78bfa)
- Use custom styling or create variants

## 🏗️ Common Layouts

### 3-Column Metric Row
```xml
<GridPane hgap="16">
    <columnConstraints>
        <ColumnConstraints hgrow="ALWAYS" />
        <ColumnConstraints hgrow="ALWAYS" />
        <ColumnConstraints hgrow="ALWAYS" />
    </columnConstraints>
    <VBox styleClass="metric-card" GridPane.columnIndex="0"/>
    <VBox styleClass="metric-card" GridPane.columnIndex="1"/>
    <VBox styleClass="metric-card" GridPane.columnIndex="2"/>
</GridPane>
```

### Two-Column Form
```xml
<HBox spacing="14">
    <VBox spacing="6" HBox.hgrow="ALWAYS">
        <Label text="FIELD 1" styleClass="field-label" />
        <TextField styleClass="text-field" />
    </VBox>
    <VBox spacing="6" HBox.hgrow="ALWAYS">
        <Label text="FIELD 2" styleClass="field-label" />
        <TextField styleClass="text-field" />
    </VBox>
</HBox>
```

### Full-Width Button Row
```xml
<HBox spacing="12">
    <Button text="Primary" HBox.hgrow="ALWAYS"
           styleClass="button"
           style="-fx-min-height: 44;" />
    <Button text="Secondary" HBox.hgrow="ALWAYS"
           styleClass="button secondary"
           style="-fx-min-height: 44;" />
</HBox>
```

## ✨ Icon Emoji Library

Use these emoji for consistency:

```
📊 Dashboard / Charts
📅 Appointments / Calendar
👤 Profile / User
📚 Articles / Resources / Blog
💊 Pharmacy / Medicine
📈 Health Tracking / Stats
🚪 Logout / Exit
🔒 Security / Lock
💾 Save
↻ Reset / Refresh
⚙️ Settings
🔔 Notifications
💬 Messages
🏥 Hospital / Medical
❤️ Heart / Health
⭐ Star / Rating
✓ Checkmark / Done
✗ Close / Cancel
⚠️ Warning
ℹ️ Info
```

## 🎯 State Classes

### Form Fields
```
.field-invalid      /* Error state */
.field-valid        /* Valid state */
```

### Status Pills
```
.status-pending     /* Pending */
.status-confirmed   /* Confirmed */
.status-completed   /* Completed */
.status-cancelled   /* Cancelled */
```

### Text Styling
```
.feedback-label     /* Form feedback */
.feedback-error     /* Error message */
.feedback-success   /* Success message */
.dashboard-copy     /* Body text */
.table-meta         /* Muted text */
.field-label        /* Form labels */
```

## 🔄 Common Patterns

### Authentication Screen
```
1. Split layout (brand side + form side)
2. Brand side: Logo, features list
3. Form side: Title, form fields, buttons
4. Use .auth-* classes for consistency
```

### Dashboard Screen
```
1. Left sidebar (navigation)
2. Top header bar (user info)
3. Main content area (scrollable)
4. Hero panel at top
5. Metrics row
6. Content sections with cards
```

### Form Dialog
```
1. Centered card
2. Title + subtitle
3. Form fields
4. Separator
5. Action buttons
```

## 🚀 Quick Start for New Page

1. **Copy the base template**
   ```
   Use: base_dashboard_template.fxml
   ```

2. **Update the sidebar**
   - Change navigation buttons
   - Update onclick handlers

3. **Create main content**
   - Add hero panel
   - Add metric cards
   - Add data cards

4. **Apply consistent styling**
   - Use standard spacing (12, 16, 20px)
   - Use predefined CSS classes
   - Follow color guidelines

5. **Test**
   - Check responsiveness
   - Verify all text is readable
   - Test navigation

## 🎨 Custom Styling (if needed)

### Inline Style Syntax
```xml
<!-- Set single property -->
style="-fx-text-fill: #ffffff;"

<!-- Multiple properties -->
style="-fx-text-fill: #ffffff; -fx-font-size: 14; -fx-font-weight: bold;"

<!-- Common properties -->
-fx-background-color: #color
-fx-text-fill: #color
-fx-border-color: #color
-fx-font-size: 14
-fx-font-weight: bold
-fx-padding: 12
-fx-spacing: 8
```

## 📋 Checklist for New Components

- [ ] Proper spacing (4px grid)
- [ ] Correct color scheme
- [ ] Readable text (contrast check)
- [ ] Icon usage (consistent)
- [ ] Button styling (standard)
- [ ] Form field styling (consistent)
- [ ] Card/panel styling (uniform)
- [ ] Mobile considerations
- [ ] Accessibility (labels, focus)
- [ ] Tested on target resolutions

## 💡 Pro Tips

1. **Use HBox.hgrow="ALWAYS"** to make elements expand
2. **Use VBox.vgrow="ALWAYS"** for vertical expansion
3. **Use Region with vgrow** to push items to bottom
4. **Use Separator with opacity 0.1** for subtle dividers
5. **Use GridPane for metric cards** instead of HBox
6. **Wrap long text** with wrapText="true"
7. **Use ScrollPane** around long VBoxes
8. **Set prefWidth/prefHeight** only when needed
9. **Use styleClass** over inline styles when possible
10. **Test with different text lengths**

## 🔗 File References

When loading pages in Java:
```java
// Login
"/fxml/login_redesigned.fxml"

// Register
"/fxml/register_redesigned.fxml"

// Dashboards
"/fxml/doctor_dashboard_redesigned.fxml"
"/fxml/user_dashboard_redesigned.fxml"

// Templates
"/fxml/base_dashboard_template.fxml"
```

## 📞 Quick Help

**Form not looking right?**
- Check .auth-field-block spacing
- Verify styleClass="text-field"
- Check parent padding

**Colors not matching?**
- Check role-specific class (doctor/user)
- Verify CSS is loaded
- Check for inline style overrides

**Layout looks off?**
- Check HBox/VBox spacing
- Verify hgrow/vgrow settings
- Check padding values
- Test at different widths

**Text not visible?**
- Check contrast ratio
- Verify styleClass applied
- Check font color
- Look for overlapping elements

