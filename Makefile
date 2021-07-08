clean:
	rm -rf build

update:
	ppm --generate-package="src/OpenBlu"

build:
	mkdir build
	ppm --no-intro --compile="src/OpenBlu" --directory="build"

install:
	ppm --no-prompt --fix-conflict --install="build/net.intellivoid.openblu.ppm"

install_fast:
	ppm --no-prompt --fix-conflict --branch="production" --skip-dependencies --install="build/net.intellivoid.openblu.ppm"