# Makefile
install:
	composer install
gendiff:
	./bin/gendiff
validate:
	composer validate
lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin