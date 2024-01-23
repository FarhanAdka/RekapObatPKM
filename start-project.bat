@echo off
rem Start XAMPP Control Panel
start "XAMPP Control Panel" "C:\xampp\xampp-control.exe" 

rem Wait for XAMPP Control Panel to open
timeout /t 5

:WAIT_FOR_SERVICES
sc query Apache2.4 | find "STATE" | find "RUNNING" >nul
if errorlevel 1 (
    timeout /t 5
    goto :WAIT_FOR_SERVICES
)

sc query mysql | find "STATE" | find "RUNNING" >nul
if errorlevel 1 (
    timeout /t 5
    goto :WAIT_FOR_SERVICES
)
rem Start Apache and MySQL Services
"C:\xampp\apache\bin\httpd.exe" --console
"C:\xampp\mysql\bin\mysqld.exe" --console

rem Wait for Apache and MySQL to start (adjust the timeout as needed)
timeout /t 5

rem Change to your Laravel project directory
cd "C:\Users\Farhan Adka Reynaldi\Desktop\RekapObatPKM"

rem Start Laravel Server in the background
start /b php artisan serve

rem Pause the batch script (optional)
pause
