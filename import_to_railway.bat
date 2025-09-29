@echo off
echo Exporting local database...
C:\xampp\mysql\bin\mysqldump.exe -u root db_uks > db_uks_backup.sql

echo Database exported to db_uks_backup.sql
echo.
echo Next steps:
echo 1. Go to Railway dashboard (already open)
echo 2. Click MySQL service
echo 3. Get connection details
echo 4. Use MySQL Workbench or phpMyAdmin to import db_uks_backup.sql
echo.
pause
