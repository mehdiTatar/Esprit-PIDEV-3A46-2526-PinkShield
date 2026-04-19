# Doctor Admin Dashboard - Appointments Module

## Overview
This module provides a professional Doctor Admin Dashboard for managing patient appointments in the PinkShield application. It features a clean, intuitive interface with two main views: Management List and Schedule Calendar.

## Features

### 1. **Management List Tab**
- **TableView Display**: Shows all patient appointments with the following columns:
  - **ID**: Unique appointment identifier
  - **Patient**: Patient name
  - **Date & Time**: Appointment date and time
  - **Status**: Current status (Pending, Confirmed, Postponed, Cancelled)
  - **Notes**: Additional appointment notes

- **Filtering & Search**:
  - Filter appointments by status using the ComboBox
  - Real-time search by patient name
  - Refresh button to reload data

- **Action Buttons** (for each appointment):
  - **Confirm** (Green): Updates appointment status to "Confirmed"
  - **Postpone** (Orange): Opens a dialog to select a new date/time
  - **Cancel** (Red): Updates appointment status to "Cancelled"

### 2. **Schedule Calendar Tab**
- **Monthly Calendar View**: Visual calendar showing scheduled appointments
- **Appointment Markers**: Patient names displayed in calendar cells when appointments are scheduled
- **Navigation**: Previous/Next month buttons for calendar browsing
- **Color Coding**:
  - Current month cells: White background
  - Previous/Next month cells: Gray background
  - Appointments displayed in blue (#0984e3)

## Technical Implementation

### Files Created

#### 1. **AdminAppointment.fxml**
Location: `src/main/resources/AdminAppointment.fxml`

Key Components:
- **ToolBar**: Professional header with blue theme (#0984e3)
- **ToggleButtons**: Tab-like navigation between Management List and Calendar
- **TableView**: Dynamic appointment display with status filtering
- **GridPane**: Calendar grid for monthly view

#### 2. **AdminAppointmentController.java**
Location: `src/main/java/org/example/AdminAppointmentController.java`

Core Methods:
- `initialize()`: Initializes UI components and loads initial data
- `loadAppointments()`: Fetches appointments from database with filtering
- `handleManagementTab()`: Switches to management list view
- `handleCalendarTab()`: Switches to calendar view
- `setupTableActions()`: Configures action buttons for each table row
- `updateStatus(int appointmentId, String newStatus)`: Updates appointment status in database
- `openPostponeDialog(Appointment appointment)`: Opens dialog for selecting new appointment date/time
- `buildCalendar()`: Generates monthly calendar with appointments
- `createDayCell(LocalDate date, List<String> appointments)`: Creates individual calendar day cells

#### 3. **Style Updates** (style.css)
Added comprehensive styling for admin appointment module:
- Professional blue theme (#0984e3)
- Table styling with hover effects
- Button styling (Confirm, Postpone, Cancel)
- Calendar grid styling
- Dark mode support for all components

## Database Integration

### Service Class
Uses `ServiceAppointment` class for database operations:
- `afficherAll()`: Retrieves all appointments
- `modifier(Appointment)`: Updates appointment in database

### Appointment Model
```java
public class Appointment {
    private int id;
    private String patient_email;
    private String patient_name;
    private String doctor_email;
    private String doctor_name;
    private Timestamp appointment_date;
    private String status;          // "Pending", "Confirmed", "Postponed", "Cancelled"
    private String notes;
    private Timestamp created_at;
}
```

## Status Types
- **Pending**: Initial appointment state
- **Confirmed**: Doctor confirmed the appointment
- **Postponed**: Appointment rescheduled
- **Cancelled**: Appointment cancelled

## User Interface Theme

### Color Scheme
- **Primary Blue**: #0984e3 (Deep Medical Blue - toolbar, headers)
- **Confirm Green**: #4caf50
- **Postpone Orange**: #ff9800
- **Cancel Red**: #f44336
- **Background**: #f8f9fb
- **Text**: #2d3436 (dark gray)

### Layout
- **Professional**: Clean, organized layout with clear separation of concerns
- **Responsive**: Adapts to window resizing
- **Accessible**: Clear labels and logical flow

## How to Use

### 1. Confirming Appointments
1. Click the **Confirm** button in the Management List
2. Appointment status updates to "Confirmed" in real-time
3. Changes persist in the database

### 2. Postponing Appointments
1. Click the **Postpone** button
2. Select new date and time from the dialog
3. Click OK to save changes
4. Status automatically updates to "Postponed"

### 3. Cancelling Appointments
1. Click the **Cancel** button
2. Appointment status updates to "Cancelled" immediately
3. Changes persist in the database

### 4. Filtering Appointments
1. Use the **Status Filter** dropdown to show specific appointment statuses
2. Use the **Search Field** to find appointments by patient name
3. Click **Refresh** to reload data from database

### 5. Viewing Calendar
1. Click the **Schedule Calendar** tab
2. Navigate months using Previous/Next buttons
3. Patient names appear in cells with scheduled appointments

## Integration with AdminDashboard

The module is integrated into the AdminDashboard through:
- **Navigation Menu**: "Appointments" button in sidebar
- **Layout**: Loads within the admin dashboard content area
- **Theme**: Inherits dark mode settings from main dashboard

## Error Handling

The module includes error handling for:
- Database connection failures
- Invalid date/time selections
- Missing appointment data
- UI initialization errors

## Performance Considerations

- **Efficient Data Loading**: Appointments loaded once and filtered in memory
- **Responsive UI**: Non-blocking database operations
- **Optimized Calendar**: Only calculates current month cells

## Future Enhancements

Potential improvements:
- Appointment conflict detection
- Email notifications for status changes
- Bulk operations (confirm multiple appointments)
- Appointment reminders
- Doctor availability scheduling
- Patient notes editing

## Troubleshooting

### No appointments displaying
- Check database connection
- Verify appointments exist in the database
- Check status filter is set to "All Statuses"

### Calendar not showing
- Ensure month navigation works
- Verify appointment_date format in database

### Action buttons not working
- Check database connection
- Verify appointment ID validity
- Check ServiceAppointment class for errors

## Dark Mode Support

All components automatically support dark mode:
- Toggle "Night Mode" in header
- Calendar, tables, and buttons adapt color scheme
- Text contrast maintained for readability

