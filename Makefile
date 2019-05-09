# Docker commands
build:
	docker-compose up

start:
	docker-compose start
	docker-compose exec webserver bash

stop:
	docker-compose stop

install-composer:
	docker-compose exec webserver composer install

test:
	docker-compose exec webserver ./vendor/bin/phpunit tests

coverage:
	docker-compose exec webserver ./vendor/bin/phpunit tests --coverage-text

ssh:
	docker-compose exec webserver bash

remove:
	docker rm ph-temperature

remove-all:
	docker rm  ph-temperature
	docker rmi rigortalks_webserver

