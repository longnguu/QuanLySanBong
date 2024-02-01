@echo off
:loop
php artisan schedule:run
timeout /nobreak /t 16 > nul
goto loop