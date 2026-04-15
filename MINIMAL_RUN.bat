@echo off
REM Final minimal - classpath only, no modules, Java 8 compatible
title PinkShield Dashboard

set TARGET_DIR=target\classes
set M2=%USERPROFILE%\.m2\repository

mkdir "%TARGET_DIR%" 2>nul
xcopy src\main\resources\* "%TARGET_DIR%\" /Y /Q /E /I >nul

REM Full classpath
set CP=%TARGET_DIR%
set CP=%CP%;%M2%\mysql\mysql-connector-java\8.0.33\mysql-connector-java-8.0.33.jar
set CP=%CP%;%M2%\org\openjfx\javafx-base\21.0.2\javafx-base-21.set CP=%CP%;%M2%\org\openjfx\javafx-graphics\21.0.2\javafx-graphics-21.0.2-win.jar
set CP=%CP%;set CP=%CP%;%M2%\org\openjfx\javafx-base\21.0.2\javafx-base-21.0.2-win.jar
set CP=%CP%;%M2%\org\openjfx\javafx-graphics\21.0.2\javafx-graphics-21.0.2-win.jar
set CP=%CP%;
