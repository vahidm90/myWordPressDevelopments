del %userprofile%\Desktop\list.txt
del %userprofile%\Desktop\bin.zip
echo Creating the archive %userprofile%\Desktop\bin.zip on %date% at %time%
echo Archive contents:
for /F "delims=" %%A in ('dir /s /b ^| findstr ".*\\bin\\.* .*\\uploads\\.* .*\.jpg$ .*\.JPG$ .*\.png$ .*\.PNG$ .*\.ttf$ .*\.eot$ .*\.woff$ .*\.woff2$ .*\.otf$ .*\.svg$ .*\.gif$"') do echo %%~fA >> %userprofile%\Desktop\list.txt
7za a -uz0 -tzip -spf2 %userprofile%\Desktop\bin.zip @%userprofile%\Desktop\list.txt