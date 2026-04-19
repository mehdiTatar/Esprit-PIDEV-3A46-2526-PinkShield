# Run Application Script (PowerShell)
# Compiles and runs PinkShield from the current workspace directory.

$projectDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$srcDir = Join-Path $projectDir "src\main\java"
$resourceDir = Join-Path $projectDir "src\main\resources"
$targetDir = Join-Path $projectDir "target\classes"
$mainClass = "org.example.MainApp"

Write-Host "================================" -ForegroundColor Green
Write-Host "PinkShield - Application Launcher" -ForegroundColor Green
Write-Host "================================" -ForegroundColor Green

if (!(Test-Path $targetDir)) {
    New-Item -ItemType Directory -Path $targetDir -Force | Out-Null
}

$javaFiles = Get-ChildItem -Path $srcDir -Filter "*.java" -Recurse | ForEach-Object { $_.FullName }
if ($javaFiles.Count -eq 0) {
    Write-Host "No Java source files found in $srcDir" -ForegroundColor Red
    exit 1
}

$javafxJars = @(
    "$env:USERPROFILE\.m2\repository\org\openjfx\javafx-base\21.0.2\javafx-base-21.0.2-win.jar",
    "$env:USERPROFILE\.m2\repository\org\openjfx\javafx-graphics\21.0.2\javafx-graphics-21.0.2-win.jar",
    "$env:USERPROFILE\.m2\repository\org\openjfx\javafx-controls\21.0.2\javafx-controls-21.0.2-win.jar",
    "$env:USERPROFILE\.m2\repository\org\openjfx\javafx-fxml\21.0.2\javafx-fxml-21.0.2-win.jar"
) | Where-Object { Test-Path $_ }

if ($javafxJars.Count -lt 4) {
    Write-Host "Missing JavaFX jars in local Maven cache." -ForegroundColor Red
    exit 1
}

$mysqlJar = @(
    "$env:USERPROFILE\.m2\repository\mysql\mysql-connector-java\8.0.33\mysql-connector-java-8.0.33.jar",
    "$env:USERPROFILE\.m2\repository\com\mysql\mysql-connector-j\8.0.33\mysql-connector-j-8.0.33.jar"
) | Where-Object { Test-Path $_ } | Select-Object -First 1

$classpathParts = @($targetDir)
if ($mysqlJar) {
    $classpathParts += $mysqlJar
}

$modulePath = ($javafxJars -join ';')
$classpath = ($classpathParts -join ';')

Write-Host "Compiling Java sources..." -ForegroundColor Yellow
javac --release 21 -cp $classpath -sourcepath $srcDir -d $targetDir $javaFiles
if ($LASTEXITCODE -ne 0) {
    Write-Host "Compilation failed." -ForegroundColor Red
    exit $LASTEXITCODE
}

if (Test-Path $resourceDir) {
    Copy-Item "$resourceDir\*" -Destination $targetDir -Recurse -Force
}

Write-Host "Starting application..." -ForegroundColor Yellow
java --module-path $modulePath --add-modules javafx.controls,javafx.fxml -cp $classpath $mainClass

