# PROYECTO DE TEMPERATURA
Bienvenido al gestionador de temperatura de Planeto Huerto. 
Para poder controlar correctamente el crecimiento de nuestros de los Bonsais, hemos creado una aplicación que nos ayude reconocer que temperaturas son  muy calientes o muy frías para nuestros bonsais. Por esta razón tenemos que controlar el parámetro de temperatura. 


## PUESTA EN MARCHA
A lo largo de esta documentación hay puntos que tienes que realizar

Cuando lo tengas realizado, puedes marcar los en el README de este modo.
[x] Visto


### DESCARGA EL REPOSITORIO

Tareas:
- [x] Clona el repositorio [Repositorio en GitHub](https://github.com/planetahuerto/rigortalks)
- [x] Crea una rama con tu nombre. (Ejemplo “marcos-ph”)

### ORGANIZACIÓN DEL CÓDIGO
Ahora que ya tienes el proyecto en tu mano, dentro de “src” está la lógica del desarrollar y 
en la carpeta “test” estás los asserts para testear el código existente.

El proyecto está preparado para utilizarse gracias a un contenedor docker con todo lo necesario.

Ficheros de configuración del proyecto
- composer-json
    - Tienes las librerías necesarias y también ya instala el phpunit para poder ejecutar los test
- phpunit-xml
    - Configuración básica de los directorios de test y desarrollo
- docker-compose
    - En este fichero se utiliza la configuración por defecto del Dockerfile.
    - Se redirige los puertos del apache
    - Se comparte la carpeta del proyecto con la del contenedor
- Dockerfile
    - FROM descarga el contenedor de php con apache instalado
    - Instala el composer
    - Instala el Xdebug
- Makefile
    - En este fichero están comprendidos todos los comandos docker-compose que necesitas.

## COMANDOS DOCKER EN EL FICHERO “Makefile”

Para crear y arrancar el contenedor con la información que se refleja en los ficheros de configuración “docker-compose.yml” y “Dockerfile”. Este comando solo es necesario la utilizarlo para crear el contenedor. Utiliza el comando:

    $ make build

Es conveniente que después de crear el contenedor ejecutes el comando para instalar las librerías necesarias:

	$ make install-composer

Si ya tiene el contenedor creado para arrancar y parar

    $ make start
    $ make stop

Para ejecutar los test:

    $ make test

Para conocer la covertura de los test:

	$ make coverage

Si necesitas acceder al contenedor, lo puedes realizar por ssh con:
	
	$ make ssh

Si algo no funciona correctamente en el contenedor, puedes eliminar solo el contenedor:

	$ make remove

Si todavía hay problemas, puedes eliminar contenedor e imagen:

	$ make remove-all

Tareas:

- [x] Poner en marcha el contenedor
- [x] Probar los test
- [x] Probar la covertura 

### BASE DE DATOS
Existe una base de datos SQLite llamada “configure” con dos tablas. 
- hot_threshold
- cold_threshold

## MANOS A LA OBRA

En este apartado se describe el trabajo que se tiene que realizar.


### REFACTORING INICIAL
Una primera parte consiste en Refactorizar el código existente, de esta forma luego podremos implementar mejoras. 
Como somos benevolentes hemos contratado un formador online especialmente para que te ayude en estos primeros pasos.

Sigue los vídeos de Carlos Buenosvinos:

- [x] [#1 - Guard Clauses](https://youtu.be/Ttk9fDGwjrY)
- [x] [#2 - Self-Encapsulation (Spanish)](https://youtu.be/4PVUiMOVl5w)
- [x] [#3 - Named Constructors I](https://youtu.be/LjEG7AR-MOg)
- [x] [#4 - Named Constructors II](https://youtu.be/RE3cAEFSsDc)
- [x] [#5 - Named Constructors III](https://youtu.be/w2CfVDtQGc0)
- [x] [#6 - Named Constructors IV ](https://youtu.be/210Ed5PeK4g)
- [x] [#7 - Test Class](https://youtu.be/8UFAyC173JU)
- [x] [#8 - Self-Shunt ](https://youtu.be/Ds-Iop1zB24)
- [x] [#9 - Self-Shunt II (PHP7)](https://youtu.be/gpUDgEVw9tM)
- [x] [#10 - Self-Shunt III](https://youtu.be/e35igS90MkI)
- [x] [#11 - Immutability ](https://youtu.be/577bfQMI5GY)


### IMPLEMENTACIÓN DE MEJORAS
Tareas:
- [x] Intentar separar los conceptos de Dominio, Aplicación e Infraestructura. Según la arquitectura hexagonal.
- [x] Aplica Clean Code
- [x] Aplica principios SOLID
- [ ] Utiliza servicios con Pimple.
- [ ] Utiliza el Api de Aemet para obtener la temperatura del día actual. 
    - [API Aemet ](https://opendata.aemet.es/centrodedescargas/inicio)
- [ ] Crea comandos de Symfony para saber si dada una temperatura es muy caliente o muy helada.


Se pueden utilizar las librerías que se consideren en la rama de desarrollo.
El proyecto debe quedar totalmente funcional, cualquier persona del equipo que se descargue el proyecto e instale las dependencias debe hacerlo funcionar y pasar los tests sin problemas.

## RECOMENDACIONES PARA EL CÓDIGO
Aplica la imaginación: como mejorar lo que ya hay, aplicar patrones de diseño y de testing, añadir funcionalidad extra, posibilidad de ejecutar por línea de comandos, refactorizar, etc.
	




