@echo off
REM Classpath compile + modular run - works with any Java 11+
setlocal enabledelayedexpansion

echo ======================================
echo PinkShield Healthcare - CLASS PATH FIX
echo ======================================

set PROJECT_DIR=%~dp0
set SRC_DIR=%PROJECT_DIR%src\main\java
set TARGET_DIR=%PROJECT_DIR%target\classes
set RESOURCES_DIR=%PROJECT_DIR%src\main\