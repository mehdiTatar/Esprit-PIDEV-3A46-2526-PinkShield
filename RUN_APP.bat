@echo off
REM PinkShield launcher for the current workspace
setlocal

set "SCRIPT_DIR=%~dp0"
set "PS1=%SCRIPT_DIR%run-app.ps1"

if not exist "%PS1%" (
  echo run-app.ps1 not found at %PS1%
  exit /b 1
)

powershell.exe -ExecutionPolicy Bypass -File "%PS1%"
exit /b %ERRORLEVEL%

