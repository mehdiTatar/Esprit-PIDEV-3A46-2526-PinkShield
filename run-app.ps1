# Run Application Script (PowerShell)
# Compiles and runs PinkShield from the current workspace directory.

$projectDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$srcDir = Join-Path $projectDir "src\main\java"
$resourceDir = Join-Path $projectDir "src\main\resources"
$targetDir = Join-Path $projectDir "target\classes"
$mainClass = "tn.esprit.main.MainFX"
$m2Repo = Join-Path $env:USERPROFILE ".m2\repository"

Write-Host "================================" -ForegroundColor Green
Write-Host "PinkShield - Application Launcher" -ForegroundColor Green
Write-Host "================================" -ForegroundColor Green

if (Get-Command mvn -ErrorAction SilentlyContinue) {
    Write-Host "Maven found - using javafx:run for the cleanest startup path." -ForegroundColor Yellow
    $mvnExitCode = 0
    Push-Location $projectDir
    try {
        & mvn -q clean javafx:run
        $mvnExitCode = $LASTEXITCODE
    } finally {
        Pop-Location
    }
    exit $mvnExitCode
}

Write-Host "Maven not found - falling back to direct javac/java launch using the local Maven cache." -ForegroundColor Yellow

if (!(Test-Path $targetDir)) {
    New-Item -ItemType Directory -Path $targetDir -Force | Out-Null
}

$javaFiles = Get-ChildItem -Path $srcDir -Filter "*.java" -Recurse | ForEach-Object { $_.FullName }
if ($javaFiles.Count -eq 0) {
    Write-Host "No Java source files found in $srcDir" -ForegroundColor Red
    exit 1
}

$javafxJars = @(
    "$m2Repo\org\openjfx\javafx-base\21.0.2\javafx-base-21.0.2-win.jar",
    "$m2Repo\org\openjfx\javafx-graphics\21.0.2\javafx-graphics-21.0.2-win.jar",
    "$m2Repo\org\openjfx\javafx-controls\21.0.2\javafx-controls-21.0.2-win.jar",
    "$m2Repo\org\openjfx\javafx-fxml\21.0.2\javafx-fxml-21.0.2-win.jar",
    "$m2Repo\org\openjfx\javafx-media\21.0.2\javafx-media-21.0.2-win.jar",
    "$m2Repo\org\openjfx\javafx-web\21.0.2\javafx-web-21.0.2-win.jar"
) | Where-Object { Test-Path $_ }

if ($javafxJars.Count -lt 6) {
    Write-Host "Missing JavaFX jars in local Maven cache." -ForegroundColor Red
    exit 1
}

$mysqlJar = @(
    "$m2Repo\mysql\mysql-connector-java\8.0.33\mysql-connector-java-8.0.33.jar",
    "$m2Repo\com\mysql\mysql-connector-j\8.0.33\mysql-connector-j-8.0.33.jar"
) | Where-Object { Test-Path $_ } | Select-Object -First 1

$otherJars = @(
    "$m2Repo\com\google\code\gson\gson\2.10.1\gson-2.10.1.jar",
    "$m2Repo\com\twilio\sdk\twilio\9.2.0\twilio-9.2.0.jar",
    "$m2Repo\org\kordamp\ikonli\ikonli-javafx\12.4.0\ikonli-javafx-12.4.0.jar",
    "$m2Repo\org\kordamp\ikonli\ikonli-fontawesome5-pack\12.4.0\ikonli-fontawesome5-pack-12.4.0.jar",
    "$m2Repo\org\mindrot\jbcrypt\0.4\jbcrypt-0.4.jar",
    "$m2Repo\com\sun\mail\jakarta.mail\2.0.1\jakarta.mail-2.0.1.jar",
    "$m2Repo\com\github\sarxos\webcam-capture\0.3.12\webcam-capture-0.3.12.jar"
) | Where-Object { Test-Path $_ }

$classpathParts = @($targetDir)
if ($mysqlJar) {
    $classpathParts += $mysqlJar
}
$classpathParts += $otherJars

$modulePath = ($javafxJars -join ';')
$classpath = (($classpathParts + $javafxJars) -join ';')

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
java --module-path $modulePath --add-modules javafx.controls,javafx.fxml,javafx.media,javafx.web -cp $classpath $mainClass

