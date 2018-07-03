help:
	@echo "help     - napoveda"
	@echo "download - stazeni zdrojovych dat"
	@echo "apk      - vytvori apk soubor"
	@echo "clean    - smaze stazene a generovane soubory"

download:
	php stahni.php

apk:
	TERM=xterm-color gradle assembleRelease

clean:
	TERM=xterm-color gradle clean
