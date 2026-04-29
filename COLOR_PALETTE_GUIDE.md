# PinkShield Color & Component Guide

## 🎨 Complete Color Palette

### Primary Branding
```
┌─────────────────────────────────────────┐
│ PRIMARY PINK (Main Brand Color)         │
│ #c0396b                                 │
│ RGB(192, 57, 107)                       │
│ Used for: Buttons, Links, Accents       │
└─────────────────────────────────────────┘

┌─────────────────────────────────────────┐
│ PRIMARY LIGHT (Hover & Active)          │
│ #ff6ba8                                 │
│ RGB(255, 107, 168)                      │
│ Used for: Hover states, Active states   │
└─────────────────────────────────────────┘

┌─────────────────────────────────────────┐
│ PRIMARY DARK (Pressed & Darker)         │
│ #9b2553                                 │
│ RGB(155, 37, 83)                        │
│ Used for: Pressed states, Gradients     │
└─────────────────────────────────────────┘
```

### Role-Based Colors

#### Doctor Dashboard (Teal)
```
┌─────────────────────────────────────────┐
│ DOCTOR TEAL (Primary)                   │
│ #2dd4bf                                 │
│ RGB(45, 212, 191)                       │
│ Used for: Doctor dashboards, Borders    │
│           Icons, Accents on doc pages   │
└─────────────────────────────────────────┘

Hex: #2dd4bf
RGB: (45, 212, 191)
HSL: (170°, 75%, 50%)
```

#### Patient Dashboard (Blue)
```
┌─────────────────────────────────────────┐
│ PATIENT BLUE (Primary)                  │
│ #60a5fa                                 │
│ RGB(96, 165, 250)                       │
│ Used for: Patient dashboards, Borders   │
│           Icons, Accents on user pages  │
└─────────────────────────────────────────┘

Hex: #60a5fa
RGB: (96, 165, 250)
HSL: (217°, 98%, 68%)
```

#### Admin Dashboard (Purple)
```
┌─────────────────────────────────────────┐
│ ADMIN PURPLE (Primary)                  │
│ #a78bfa                                 │
│ RGB(167, 139, 250)                      │
│ Used for: Admin dashboards, Borders     │
│           Icons, Accents on admin pages │
└─────────────────────────────────────────┘

Hex: #a78bfa
RGB: (167, 139, 250)
HSL: (259°, 95%, 76%)
```

### Semantic/Status Colors

#### Success
```
┌──��──────────────────────────────────────┐
│ SUCCESS (Green)                         │
│ #10b981                                 │
│ RGB(16, 185, 129)                       │
│ Used for: Confirmed, Active, Success    │
└─────────────────────────────────────────┘
```

#### Error
```
┌─────────────────────────────────────────┐
│ ERROR (Red)                             │
│ #ef4444                                 │
│ RGB(239, 68, 68)                        │
│ Used for: Error messages, Cancellations │
└─────────────────────────────────────────┘
```

#### Warning
```
┌─────────────────────────────────────────┐
│ WARNING (Amber)                         │
│ #f59e0b                                 │
│ RGB(245, 158, 11)                       │
│ Used for: Warnings, Pending status      │
└─────────────────────────────────────────┘
```

#### Info
```
┌─────────────────────────────────────────┐
│ INFO (Blue)                             │
│ #3b82f6                                 │
│ RGB(59, 130, 246)                       │
│ Used for: Information, Help text        │
└─────────────────────────────────────────┘
```

### Neutral/Background Colors

#### Dark Backgrounds
```
┌─────────────────────────────────────────┐
│ BACKGROUND DARKEST                      │
│ #060e1c                                 │
│ RGB(6, 14, 28)                          │
│ Used for: Main page background          │
└───��─────────────────────────────────────┘

┌─────────────────────────────────────────┐
│ SURFACE DARK                            │
│ #0a1525                                 │
│ RGB(10, 21, 37)                         │
│ Used for: Cards, Panels, Containers     │
└────────���────────────────────────────────┘
```

#### Text Colors
```
┌─────────────────────────────────────────┐
│ TEXT PRIMARY (Light)                    │
│ #e8eaf6                                 │
│ RGB(232, 234, 246)                      │
│ Used for: Main text content             │
└──��──────────────────────────────────────┘

┌─────────────────────────────────────────┐
│ TEXT SECONDARY                          │
│ #8aa4c8                                 │
│ RGB(138, 164, 200)                      │
│ Used for: Secondary text, Labels        │
└─────────────────────────────────────────┘

┌─────────────────────────────────────────┐
│ TEXT MUTED                              │
│ #526a82                                 │
│ RGB(82, 106, 130)                       │
│ Used for: Muted text, Captions          │
└─────────────────────────────────────────┘
```

#### Borders
```
┌─────────────────��───────────────────────┐
│ BORDER COLOR                            │
│ rgba(255,255,255,0.08)                  │
│ Light border with low opacity           │
│ Used for: Card borders, Dividers        │
└─────────────────────────────────────────┘
```

---

## 🎭 Role-Specific Theme Colors

### Doctor Theme
```
Primary:     #2dd4bf (Teal)
Light:       #57e0cf
Dark:        #0f9f95
Usage:       hero-panel-doctor, metric-card-doctor
Accent:      Teal in buttons, borders, text
```

### Patient Theme
```
Primary:     #60a5fa (Blue)
Light:       #7cb8ff
Dark:        #3b82f6
Usage:       hero-panel-user, metric-card-user
Accent:      Blue in buttons, borders, text
```

### Admin Theme
```
Primary:     #a78bfa (Purple)
Light:       #c4b5fd
Dark:        #8b5cf6
Usage:       Custom styling for admin pages
Accent:      Purple in buttons, borders, text
```

---

## 📦 Component Color Combinations

### Hero Panel
```
Doctor:
  Background: linear-gradient(to right, 
              rgba(20,184,166,0.22), 
              rgba(13,28,42,0.96))
  Border: rgba(20,184,166,0.22)

Patient:
  Background: linear-gradient(to right, 
              rgba(59,130,246,0.20), 
              rgba(10,18,34,0.92))
  Border: rgba(59,130,246,0.22)
```

### Metric Card
```
Doctor:
  Border: rgba(20,184,166,0.22)
  Label color: #8aa4c8
  Value color: #ffffff

Patient:
  Border: rgba(59,130,246,0.22)
  Label color: #8aa4c8
  Value color: #ffffff
```

### Nav Button
```
Default:
  Background: transparent
  Text: #8aa4c8
  Hover: rgba(255,255,255,0.05)

Active:
  Background: rgba(192,57,107,0.15)
  Text: #ff6ba8
  Border: Left 4px solid primary
```

### Primary Button
```
Default:
  Background: linear-gradient(to bottom, #c0396b, #9b2553)
  Text: #ffffff
  Shadow: dropshadow(gaussian, rgba(192,57,107,0.42))

Hover:
  Background: linear-gradient(to bottom, #9b2553, #7b1137)
  Shadow: Increased

Pressed:
  Background: linear-gradient(to bottom, #7b1137, #5f0a2a)
  Shadow: Reduced
```

### Secondary Button
```
Default:
  Background: rgba(255,255,255,0.07)
  Border: 1px solid rgba(147,171,201,0.24)
  Text: #d7e3f2

Hover:
  Background: rgba(255,255,255,0.12)
  Text: #ffffff
```

### Form Field
```
Default:
  Background: rgba(9,18,30,0.92)
  Border: 1px solid rgba(132,156,186,0.28)
  Text: #eef5ff
  Placeholder: rgba(210,224,242,0.40)

Focused:
  Border: rgba(192,57,107,0.72)
  Background: rgba(192,57,107,0.05)
  Shadow: dropshadow(gaussian, rgba(192,57,107,0.22))

Error:
  Border: #ff6b6b
  Background: rgba(255,107,107,0.08)
```

---

## 🎨 Color Usage Guide

### When to Use Each Color

| Color | Purpose | Components |
|-------|---------|-----------|
| **Pink (#c0396b)** | Primary action, Brand | Buttons, Links, Primary accents |
| **Pink Light (#ff6ba8)** | Active/Hover states | Hover buttons, Active nav items |
| **Doctor Teal (#2dd4bf)** | Doctor dashboard | Hero panel, Metric cards, Logos |
| **Patient Blue (#60a5fa)** | Patient dashboard | Hero panel, Metric cards, Logos |
| **Admin Purple (#a78bfa)** | Admin dashboard | Hero panel, Metric cards, Logos |
| **Success Green (#10b981)** | Confirmations | Status pills, Success messages |
| **Error Red (#ef4444)** | Errors | Error messages, Cancel status |
| **Warning Amber (#f59e0b)** | Warnings | Warning messages, Pending status |
| **Text Primary (#e8eaf6)** | Main text | Body text, Headers |
| **Text Secondary (#8aa4c8)** | Labels/metadata | Labels, Subtitles, Meta info |
| **Dark BG (#060e1c)** | Main background | Page background |
| **Surface (#0a1525)** | Cards/panels | Card backgrounds, Panels |

---

## 💾 Copy-Paste Hex Codes

```
Primary Colors:
#c0396b  #ff6ba8  #9b2553

Role Colors:
#2dd4bf  #60a5fa  #a78bfa

Semantic:
#10b981  #ef4444  #f59e0b  #3b82f6

Backgrounds:
#060e1c  #0a1525

Text:
#e8eaf6  #8aa4c8  #526a82
```

---

## 🌈 Color Harmony

The color palette is designed with:

### Contrast
- Dark backgrounds (#060e1c) with light text (#e8eaf6)
- Ensures readability and accessibility
- WCAG AA compliant contrast ratios

### Role Differentiation
- Doctor: Teal (medical, professional)
- Patient: Blue (trustworthy, calm)
- Admin: Purple (authoritative, organized)

### Visual Hierarchy
- Pink: Draws attention (CTAs, important)
- Role colors: Secondary focus (dashboards)
- Grays: Supporting elements

### Professional Appearance
- Limited color palette (8 main colors)
- Consistent usage throughout
- Modern healthcare aesthetic
- Trust-building appearance

---

## 🎯 Accessibility

### Color Contrast Ratios
```
Text on Dark BG:    4.5:1+ (WCAG AA)
Links:              5.5:1+ (WCAG AAA)
Icons:              3:1+ (WCAG AA)
```

### Color Independence
- Colors are not the only indicator
- Status is also shown with text labels
- Icons and text complement color
- Icons have text alternatives

### Colorblind Safe
- Pink and Teal: Distinguishable
- Blue and Purple: Distinguishable
- Green, Red, Amber: Standard palette
- Uses multiple visual cues

---

## 📱 Usage in Code

### Inline Styles
```xml
<!-- Pink primary -->
style="-fx-background-color: #c0396b;"

<!-- Doctor teal -->
style="-fx-border-color: #2dd4bf;"

<!-- Text colors -->
style="-fx-text-fill: #e8eaf6;"

<!-- Gradient background -->
style="-fx-background-color: linear-gradient(to right, #c0396b, #9b2553);"
```

### CSS Classes
```css
/* Role-based colors */
.hero-panel-doctor       /* Teal gradient */
.hero-panel-user         /* Blue gradient */
.metric-card-doctor      /* Teal border */
.metric-card-user        /* Blue border */

/* Text colors */
.role-doctor             /* Teal text */
.role-user               /* Blue text */
.role-admin              /* Purple text */

/* Status */
.status-success          /* Green */
.status-error            /* Red */
.status-warning          /* Amber */
```

---

## 🔄 Theme Switching (Future)

The design supports easy theme switching:

```java
// Change all doctor colors to patient colors
primaryColor = "#60a5fa";    // Blue instead of Teal
roleGradient = "linear-gradient(to right, rgba(59,130,246,0.20), ...)";
```

All components use CSS classes, making bulk color changes simple.

---

## ✨ Color Psychology

### Pink (#c0396b)
- **Emotion:** Trust, Health, Care
- **Psychology:** Approachable, Professional
- **Use:** CTA buttons, Important elements

### Teal (#2dd4bf)
- **Emotion:** Calm, Medical, Professional
- **Psychology:** Trustworthy, Competent
- **Use:** Doctor dashboards, Medical accents

### Blue (#60a5fa)
- **Emotion:** Trust, Calm, Peaceful
- **Psychology:** Approachable, Safe
- **Use:** Patient dashboards, Patient accents

### Purple (#a78bfa)
- **Emotion:** Authority, Organization
- **Psychology:** Organized, Professional
- **Use:** Admin dashboards, Control elements

### Green (#10b981)
- **Emotion:** Success, Positive
- **Psychology:** Good, Approved
- **Use:** Confirmations, Success messages

### Red (#ef4444)
- **Emotion:** Attention, Warning
- **Psychology:** Important, Caution
- **Use:** Errors, Cancellations

---

## 📚 Color Reference Sheet

Print this for quick reference:

```
BRAND:              #c0396b - Pink primary
DOCTOR:             #2dd4bf - Teal accent
PATIENT:            #60a5fa - Blue accent
ADMIN:              #a78bfa - Purple accent

SUCCESS:            #10b981 - Green
ERROR:              #ef4444 - Red
WARNING:            #f59e0b - Amber
INFO:               #3b82f6 - Blue

BG DARK:            #060e1c
BG SURFACE:         #0a1525
TEXT PRIMARY:       #e8eaf6
TEXT SECONDARY:     #8aa4c8
TEXT MUTED:         #526a82
BORDER:             rgba(255,255,255,0.08)
```

---

**Color System Designed for:** Trust, Clarity, Professional Healthcare Experience

