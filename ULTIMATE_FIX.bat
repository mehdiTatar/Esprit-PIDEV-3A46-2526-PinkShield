@echo off
REM ULTIMATE FIX - Everything in one click!

cd /d C:\Users\driss\IdeaProjects\Projet_java

echo.
echo 🚀 ULTIMATE FIX STARTING...
echo.

REM Fix 1: Setup Database
echo 1. Setting up database...
mysql -u root < INSTANT_FIX.sql >nul 2>&1

if %errorlevel% equ 0 (
    echo ✓ Database setup complete!
) else (
    echo ✗ Database setup skipped (MySQL might not be in PATH)
)

echo.
echo 2. Recompiling application...
echo.

REM Recompile
set PROJECT_DIR=C:\Users\driss\IdeaProjects\Projet_java
set SRC_DIR=%PROJECT_DIR%\src\main\java
set TARGET_DIR=%PROJECT_DIR%\target\classes
set RESOURCES_DIR=%PROJECT_DIR%\src\main\resources
set M2_REPO=%USERPROFILE%\.m2\repository
set JDK_HOME=C:\Users\driss\.jdks\openjdk-ea-25+36-3489

REM Copy resources
xcopy "%RESOURCES_DIR%\*.fxml" "%TARGET_DIR%\" /Y /Q >nul 2>&1
xcopy "%RESOURCES_DIR%\*.css" "%TARGET_DIR%\" /Y /Q >nul 2>&1

set COMPILE_CP=%TARGET_DIR%
set COMPILE_CP=!COMPILE_CP!;%M2_REPO%\mysql\mysql-connector-java\8.0.33\mysql-connector-java-8.0.33.jar
set COMPILE_CP=!COMPILE_CP!;%M2_REPO%\org\openjfx\javafx-controls\21.0.2\javafx-controls-21.0.2.jar
set COMPILE_CP=!COMPILE_CP!;%M2_REPO%\org\openjfx\javafx-controls\21.0.2\javafx-controls-21.0.2-win.jar
set COMPILE_CP=!COMPILE_CP!;%M2_REPO%\org\openjfx\javafx-graphics\21.0.2\javafx-graphics-21.0.2.jar
set COMPILE_CP=!COMPILE_CP!;%M2_REPO%\org\openjfx\javafx-graphics\21.0.2\javafx-graphics-21.0.2-win.jar
set COMPILE_CP=!COMPILE_CP!;%M2_REPO%\org\openjfx\javafx-base\21.0.2\javafx-base-21.0.2.jar
set COMPILE_CP=!COMPILE_CP!;%M2_REPO%\org\openjfx\javafx-base\21.0.2\javafx-base-21.0.2-win.jar
set COMPILE_CP=!COMPILE_CP!;%M2_REPO%\org\openjfx\javafx-fxml\21.0.2\javafx-fxml-21.0.2.jar
set COMPILE_CP=!COMPILE_CP!;%M2_REPO%\org\openjfx\javafx-fxml\21.0.2\javafx-fxml-21.0.2-win.jar

set JAVA_FILES=
for /r "%SRC_DIR%" %%f in (*.java) do (
    set JAVA_FILES=!JAVA_FILES! "%%f"
)

set JAVAFX_PATH=%M2_REPO%\org\openjfx\javafx-controls\21.0.2\javafx-controls-21.0.2-win.jar;%M2_REPO%\org\openjfx\javafx-graphics\21.0.2\javafx-graphics-21.0.2-win.jar;%M2_REPO%\org\openjfx\javafx-fxml\21.0.2\javafx-fxml-21.0.2-win.jar;%M2_REPO%\org\openjfx\javafx-base\21.0.2\javafx-base-21.0.2-win.jar

"%JDK_HOME%\bin\javac.exe" -cp "!COMPILE_CP!" --module-path "%JAVAFX_PATH%" --add-modules javafx.controls,javafx.fxml -d "%TARGET_DIR%" !JAVA_FILES! 2>compile_errors.log

if %errorlevel% neq 0 (
    echo ✗ Compilation failed!
    type compile_errors.log
    pause
    exit /b 1
)

echo ✓ Compilation complete!
echo.
echo 3. Starting PinkShield application...
echo.

set RUNTIME_CP=%TARGET_DIR%
set RUNTIME_CP=!RUNTIME_CP!;%M2_REPO%\mysql\mysql-connector-java\8.0.33\mysql-connector-java-8.0.33.jar
set RUNTIME_CP=!RUNTIME_CP!;%M2_REPO%\org\openjfx\javafx-controls\21.0.2\javafx-controls-21.0.2.jar
set RUNTIME_CP=!RUNTIME_CP!;%M2_REPO%\org\openjfx\javafx-controls\21.0.2\javafx-controls-21.0.2-win.jar
set RUNTIME_CP=!RUNTIME_CP!;%M2_REPO%\org\openjfx\javafx-graphics\21.0.2\javafx-graphics-21.0.2.jar
set RUNTIME_CP=!RUNTIME_CP!;%M2_REPO%\org\openjfx\javafx-graphics\21.0.2\javafx-graphics-21.0.2-win.jar
set RUNTIME_CP=!RUNTIME_CP!;%M2_REPO%\org\openjfx\javafx-base\21.0.2\javafx-base-21.0.2.jar
set RUNTIME_CP=!RUNTIME_CP!;%M2_REPO%\org\openjfx\javafx-base\21.0.2\javafx-base-21.0.2-win.jar
set RUNTIME_CP=!RUNTIME_CP!;%M2_REPO%\org\openjfx\javafx-fxml\21.0.2\javafx-fxml-21.0.2.jar
set RUNTIME_CP=!RUNTIME_CP!;%M2_REPO%\org\openjfx\javafx-fxml\21.0.2\javafx-fxml-21.0.2-win.jar

"%JDK_HOME%\bin\java.exe" --module-path "%JAVAFX_PATH%" --add-modules javafx.controls,javafx.fxml -cp "!RUNTIME_CP!" -Dfile.encoding=UTF-8 org.example.SimpleLauncher

endlocal

