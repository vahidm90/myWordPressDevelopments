del %userprofile%\Desktop\bin-list.txt
del %userprofile%\Desktop\bin.zip
for /F "delims=" %%A in ('dir /s /b ^| findstr ".*\\bin\\.* .*\\uploads\\.* .*\.jpg$ .*\.JPG$ .*\.png$ .*\.PNG$ .*\.ttf$ .*\.eot$ .*\.woff$ .*\.woff2$ .*\.otf$ .*\.svg$ .*\.gif$"') do echo %%~fA >> %userprofile%\Desktop\bin-list.txt
7za a -uz0 -tzip -spf2 %userprofile%\Desktop\bin.zip @%userprofile%\Desktop\bin-list.txt