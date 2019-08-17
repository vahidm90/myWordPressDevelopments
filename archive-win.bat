echo Creating the archive on %date% at %time% > %userprofile%\Desktop\list.txt
echo Archive contents: >> %userprofile%\Desktop\list.txt
for /F "delims=" %%A in ('dir /s /b ^| findstr "^.*\\bin\\.*$ ^.*\\uploads\\.* ^.*\.vmcompiled\..* ^.*\.jpg$ ^.*\.JPG$ ^.*\.png$ ^.*\.PNG$ ^.*\.ttf$ ^.*\.eot$ ^.*\.woff$ ^.*\.woff2$ ^.*\.otf$ ^.*\.svg$ ^.*\.gif$"') do 7za u -tzip %userprofile%\Desktop\bin.zip -spf2 %%~fA && echo %%~fA >> %userprofile%\Desktop\list.txt
for %%A in (%userprofile%\Desktop\bin.zip.tmp*) do del %%~fA