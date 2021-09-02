#COMANDOS DOCKER

##CREAR CONTENEDOR E INSTALAR LIBRERÍAS
build:
	docker-compose up -d

install-composer:
	docker-compose exec webserver composer install

##ARRANCAR Y PARA CONTENEDOR CREADO
start:
	docker-compose start

stop:
	docker-compose stop

##TEST
test:
	docker-compose exec webserver ./vendor/bin/phpunit tests

coverage:
	docker-compose exec webserver ./vendor/bin/phpunit tests --coverage-text

##CONECTAR
ssh:
	docker-compose exec webserver bash

##BORRAR
remove:
	docker rm ph-temperature

remove-all:
	docker rm  ph-temperature
	docker rmi rigortalks_webserver

