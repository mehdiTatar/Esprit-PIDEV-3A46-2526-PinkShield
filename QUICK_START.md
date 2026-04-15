# 🚀 Quick Start - PinkShield Healthcare System

## ✅ SDK Issues Fixed
- pom.xml: Java 21
- IntelliJ config: JDK 21

## 📦 Install Dependencies (one-time)

### Option 1: Winget (if available)
```
winget install EclipseAdoptium.Temurin.21.JDK
winget install Apache.maven --accept-package-agreements --accept-source-agreements
```

### Option 2: Manual (recommended)
1. Java 21: https://adoptium.net/temurin/releases/?version=21 → Windows x64 ZIP → extract to `C:\Program Files\Java\jdk-21`
2. Add `C:\Program Files\Java\jdk-21\bin` to system PATH
3. Maven: https://dlcdn.apache.org/maven/maven-3/3.9.9/binaries/apache-maven-3.9.9-bin.zip → extract to `C:\Program Files\apache-maven-3.9.9` → add `bin` to PATH

## ▶️ Run App

**Easy way (no install needed):**
```
double-click FIXED_RUN.bat
```

**Maven way (after install):**
```
mvn clean javafx:run
```

**IntelliJ:**
- File → Reload Gradle Project
- Run → Edit Configurations → Use "21" or "jdk-21" SDK
- Or ignore, use bat

## 🗄️ Database
Run setup_database.sql in MySQL workbench (create pinkshield_db)

App ready!
