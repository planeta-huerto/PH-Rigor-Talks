#!/usr/bin/env php
<?php
// PARA VER LA LISTA DE COMANDOS REGISTRADOS USAMOS: php bin/application.php
// PARA LANZAR EL COMANDO HAY QUE HACER: php bin/application.php app:temperature

require dirname(__DIR__).'/vendor/autoload.php';

use PH\Infrastructure\Command\TemperatureCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new TemperatureCommand());
$application->run();
