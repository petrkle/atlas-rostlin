NTAG := $(shell git describe --abbrev=0 | awk '{print $$1"+0.1"}' | bc)

help:
	@echo "help          - napoveda"
	@echo "apk           - vytvori apk soubor"
	@echo "bundle        - vytvoří bundle"
	@echo "tag           - vytvori novy tag"
	@echo "fastlane      - nainstaluje fastlane"
	@echo "release       - release do google play"
	@echo "clean         - smaze generovane a stažene soubory"

apk:
	gradle assembleRelease

bundle:
	gradle bundle

tag:
	git tag -a -s -m "Verze $(NTAG)" $(NTAG)

clean:
	gradle clean
	rm -rf build .gradle
	rm -rf tmp

fastlane:
	bundle update

release:
	bundle exec fastlane deploy
