# Makefile
install:
	composer install
gendiff:
	./bin/gendiff file1.json file2.json
validate:
	composer validate
lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin tests
test:
	composer exec --verbose phpunit tests