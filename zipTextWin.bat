del %userprofile%\Desktop\text-list.txt
del %userprofile%\Desktop\text.zip
for /F "delims=" %%A in ('dir /s /b ^| findstr ".*\.php$ .*\.PHP$ .*\.js$ .*\.JS$ .*\.css$ .*\.CSS$ .*\.bat$ .*\.BAT$ .*\.list$ .*\.LIST$ .*\.sql$ .*\.SQL$"') do echo %%~fA >> %userprofile%\Desktop\text-list.txt
7za a -uz0 -tzip -spf2 %userprofile%\Desktop\text.zip @%userprofile%\Desktop\text-list.txt