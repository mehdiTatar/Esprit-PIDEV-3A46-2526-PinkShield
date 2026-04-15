@echo off
REM No module flags for javac - pure classpath compile
setlocal enabledelayedexpansion

echo ======================================
echo NO MODULE COMPILE - Pure Classpath
echo ======================================

set PROJECT_DIR=%~dp0
set SRC_DIR=%PROJECT_DIR%src\main\java
set TARGET_DIR=%PROJECT_DIR%target\classes
set M2_REPO=%USERPROFILE%\.m2\repository

set JDK_HOME=C:\Users\driss\.jdks\openjdk-ea-25+36-3489

if not exist "%JDK_HOME%" (
    echo JDK25 missing
    pause
    exit /b 1
)

"%JDK_HOME%\bin\javac.exe" ^
    -cp "%TARGET_DIR%;%M2_REPO%\mysql\mysql-connector-java\8.0.33\mysql-connector-java-8.0.33.jar;%M2_REPO%\org\openjfx\javafx-*21.0.2-win.jar" ^
    -d "%TARGET_DIR%" ^
    src\main\java\org\example\MainApp.java src\main\java\org\example\DashboardController.java ^
    2>error.log

if %errorlevel% neq 0 (
    type error.log
    pause
    exit /b 1
)

echo Compiled!

"%JDK_HOME%\bin\java.exe" ^
    -cp "%TARGET_DIR%;%M2_REPO%\mysql\mysql-connector-java\8.0.33\mysql-connector-java-8.0.33.jar;%M2_REPO%\org\openjfx\javafx-*21.0.2-win.jar" ^
    org.example.MainApp

pause