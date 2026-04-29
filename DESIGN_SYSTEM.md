# PinkShield Design System

## Overview
A comprehensive design system for a modern hospital management system with consistent, professional, and clean UI/UX.

## Color Palette

### Primary Colors
- **Primary (Pink)**: `#c0396b` - Main brand color
- **Primary Light**: `#ff6ba8` - Accent & hover states
- **Primary Dark**: `#9b2553` - Darker interactions

### Secondary Colors
- **Doctor Teal**: `#2dd4bf` / `#20b9a5` - For doctor-related UI
- **Patient Blue**: `#60a5fa` / `#3b82f6` - For patient-related UI
- **Admin Purple**: `#a78bfa` / `#8b5cf6` - For admin-related UI

### Neutral Colors
- **Background Dark**: `#060e1c` - Main background
- **Surface Dark**: `#0a1525` - Card backgrounds
- **Border Color**: `rgba(255,255,255,0.08)` - Subtle borders
- **Text Primary**: `#e8eaf6` - Main text
- **Text Secondary**: `#8aa4c8` - Secondary text
- **Text Muted**: `#526a82` - Muted text

### Status Colors
- **Success**: `#10b981` - Confirmations
- **Error**: `#ef4444` - Errors
- **Warning**: `#f59e0b` - Warnings
- **Info**: `#3b82f6` - Information

## Typography

### Font Family
- Primary: `"Inter", "Segoe UI", sans-serif`
- Headings: `"Orbitron", "Arial Black", sans-serif`

### Sizes
- **Display**: 36px - Main brand titles
- **Heading 1**: 28px - Page titles
- **Heading 2**: 24px - Section titles
- **Heading 3**: 18px - Subsection titles
- **Body**: 13px - Default text
- **Small**: 11px - Labels, helper text
- **Tiny**: 10px - Captions

## Component Patterns

### Buttons
- **Primary**: Gradient background, white text, rounded corners (14px), shadow
- **Secondary**: Transparent background, border, hover state
- **Danger**: Red background with opacity, no gradient

### Forms
- **Input Fields**: 
  - Background: `rgba(255,255,255,0.03)`
  - Border: 1px solid `rgba(255,255,255,0.08)`
  - Padding: 14px 16px
  - Border Radius: 12px
  - Focused: Primary color border, enhanced shadow

### Cards
- **Panel Card**: 
  - Background: `rgba(255,255,255,0.03)`
  - Border: 1px solid `rgba(255,255,255,0.08)`
  - Border Radius: 18px
  - Padding: 18px
  - Shadow: Subtle drop shadow
  - Hover: Enhanced shadow, border color change

### Layout
- **Page Padding**: 28-32px
- **Section Spacing**: 20px
- **Component Spacing**: 12-14px
- **Sidebar Width**: 240px
- **Max Content Width**: 880px

## Spacing Scale
- **XS**: 4px
- **S**: 8px
- **M**: 12px
- **L**: 16px
- **XL**: 20px
- **2XL**: 24px
- **3XL**: 28px
- **4XL**: 32px

## Border Radius
- **SM**: 8px - Small elements
- **MD**: 12px - Form elements
- **LG**: 16px - Cards
- **XL**: 18-20px - Panel cards
- **XXL**: 24-28px - Large modals

## Shadow System
- **Small**: `dropshadow(gaussian, rgba(0,0,0,0.1), 8, 0.2, 0, 2)`
- **Medium**: `dropshadow(gaussian, rgba(0,0,0,0.2), 16, 0.3, 0, 4)`
- **Large**: `dropshadow(gaussian, rgba(0,0,0,0.3), 24, 0.4, 0, 8)`
- **Extra Large**: `dropshadow(gaussian, rgba(0,0,0,0.4), 32, 0.5, 0, 12)`

## Component Guidelines

### Sidebar Navigation
- Vertical stack of navigation buttons
- Active state: Left border + background color + text color
- Hover state: Background color change + text color change
- Spacing between items: 5px
- Width: 240px

### Header/Hero Panel
- Gradient background with role-specific colors
- Title + subtitle layout
- Padding: 22-24px
- Border radius: 20px

### Metric Cards
- Displays key statistics
- Large number (28px), small label
- Used in dashboard summaries
- Role-specific border colors

### Data Tables
- Alternating row colors
- Hover effect on rows
- Column headers: uppercase, bold, smaller text
- Status badges with color coding

### Modals/Dialogs
- Centered on screen
- Semi-transparent dark overlay
- Card background with rounded corners
- Padding: variable

## Responsive Considerations
- Min width: 1024px recommended
- Sidebar can collapse on smaller screens
- Forms stack vertically on mobile
- Tables scroll horizontally on small screens

## Naming Conventions
- Class names: kebab-case (e.g., `panel-card`, `hero-banner`)
- Role-specific: Include role name (e.g., `hero-panel-doctor`, `metric-card-user`)
- State-based: Include state (e.g., `button:hover`, `field-invalid`)
- Prefix with function: `auth-`, `dashboard-`, `tracking-`, `login-`

## Implementation Checklist
- [ ] Consistent spacing throughout
- [ ] All buttons follow standard styles
- [ ] Form fields have consistent styling
- [ ] Cards use the same pattern
- [ ] Tables are properly themed
- [ ] Sidebar is reusable
- [ ] Hero panels match across pages
- [ ] Text hierarchy is clear
- [ ] Color usage is consistent
- [ ] Hover/active states are defined
- [ ] Icons are consistent in style
- [ ] Loading states are handled
- [ ] Error states are clear
- [ ] Success messages are obvious

