# Makefile
install:
	composer install
manual:
	./bin/manual -h
gendiff:
	./bin/gendiff
validate:
	composer validate
lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin
test:
	composer exec --verbose phpunit tests