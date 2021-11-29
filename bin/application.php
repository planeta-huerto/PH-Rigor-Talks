#!/usr/bin/env php
<?php
// application.php

require dirname(__DIR__).'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new \PH\Application\Command\CheckTemperatureCommand());
$application->add(new \PH\Application\Command\ClimatologicalValuesCommand());

$application->run();
