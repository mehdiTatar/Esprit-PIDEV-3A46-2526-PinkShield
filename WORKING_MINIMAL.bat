@echo off
REM Pure classpath - works with Java 8
echo Building PinkShield Dashboard...

set TARGET_DIR=target\classes
set M2=%USERPROFILE%\.m2\repository

if not exist "%TARGET_DIR%" mkdir "%TARGET_DIR%"

xcopy src\main\resources\* "%TARGET_DIR%\" /Y /Q /E /I >nul

REM Compile MainApp + controller
javac -cp "%TARGET_DIR%;%M2%\mysql\mysql-connector-java\8.0.33\mysql-connector-java-8.0.33.jar;%M2%\org\openjfx\*21.0.2*.jar" ^
 -d "%TARGET_DIR%" ^
 src\main\java\org\example\DashboardController.java src\main\java\org\example\MainApp.java 2>error.log

if %errorlevel% neq 0 type error.log & pause & exit /b 1

echo Compiled!

REM Run pure classpath (no modules)
java -cp "%TARGET_DIR%;%M2%\mysql\mysql-connector-java\8.0.33\mysql-connector-java-8.0.33.jar;%M2%\org\openjfx\*21.0.2*.jar" org.example.MainApp

pause