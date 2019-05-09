# PH rigortalks


Consideraciones para el proyecto Rigor Talks en Github

##INICIALIZACIÓN DEL PROYECTO
- Repositorio planetahuerto/rigortalks con clases para el desarrollo de Temperature.
- Nomenclatura en inglés.
- Proyecto en un estado inicial en master. Será desarrollado por cualquier persona que comience el onbording. 
- Instalación de composer, PSR-4 para la carga de clases, funcional para PHP 5.6.
- Directorio src para los fuentes, directorio tests para los tests unitarios. Configuración inicial de phpunit.xml.dist.
- Estado inicial del código sin comentarios, sin interfaces ni clases abstractas, debe quedar como código a mejorar.
    
##DESARROLLAR DESDE MASTER
- [x] Crear una rama con tu nombre (pejm: sergio-ph).
- [ ] Mejora del desarrollo yendo un poco más allá, lo interesante será desarrollar aplicando:
    - [ ] Las reglas de estilo
    - [ ] Protocolos que tenemos definidas en Confluence 
    - [ ] Arquitectura hexagonal
    - [ ] Clean code
    - [ ] SOLID
    - [ ] PHP 7.3
    - [ ] Test unitarios
    - [ ] Contenedor de servicios con Pimple
- [ ] Se pueden utilizar las librerías que se consideren en la rama de desarrollo.
    - [ ] Guzzle
    - [ ] PH/Filter
    - [ ] PHDDD --> TacticianServiceProvider.php   
- [ ] El proyecto debe quedar totalmente funcional, cualquier persona del equipo que se descargue  el proyecto e instale las dependencias debe hacerlo funcionar y pasar los tests sin problemas.
- [ ] Aplica la imaginación: como mejorar lo que ya hay, aplicar patrones de diseño y de testing, añadir funcionalidad extra, posibilidad de ejecutar por línea de comandos, refactorizar, etc.


##REVISIÓN
- Eliminar die y poner exceptions
- Método boot añadir carga inicial
- php type hinting
- Realizar un ControlerServiceProvider
- Aplicación con REQUEST
    - run de la aplicación
- REQUEST
- Boostraping 
- Objetos de configuración 
       

##REALIZADO CON

###COMPOSER DE FORMA GLOBAL
Hay que copiar la clave privada (id_rsa) en el docker para poder acceder al bitbucket.
Dentro del composer.json del usuario docker

###PHP-CS-FIXER
Dentro del contenedor 
php vendor/friendsofphp/php-cs-fixer/php-cs-fixer --verbose fix <Dir/File.php>
php vendor/friendsofphp/php-cs-fixer/php-cs-fixer --verbose fix src/Temperature.php

####QUESTIONS 
- PHP-CS-FIXER

###SOLID
- https://medium.com/all-you-need-is-clean-code/inversi%C3%B3n-de-dependencias-dip-b8a07b42f99e

###HEXAGONAL

- https://medium.com/azimolabs/ports-and-adapters-implementation-in-php-with-a-little-symfony-help-6d4fdbe830ba
    - https://github.com/purplefan/song-vote-ppa

###PIMPLE
- https://jtreminio.com/blog/an-introduction-to-pimple-and-service-containers/
    - https://github.com/Maltronic/php-pimple-contacts-example/blob/master/index.php

###FALTA
- Instalar el composer globar
    - https://bitbucket.org/planetahuerto/filter/src/master/src/
-  Midleware
    https://bitbucket.org/planetahuerto/ddd/src/master/
-  Guzzle no curl
