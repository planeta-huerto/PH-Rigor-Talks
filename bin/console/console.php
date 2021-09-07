#!/usr/bin/env php
<?php

use PH\Bin\Commands\SuperHotCommand;
use PH\Bin\Commands\TemperatureAEMETCommand;
use PH\Infrastructure\TemperatureServiceProvider;
use Pimple\Container;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/../../vendor/autoload.php';

$container = new Container();
$container->register(new TemperatureServiceProvider());

// Create the Application
$application = new Application();

// Register all Commands
$application->add(new SuperHotCommand());
$application->add(new TemperatureAEMETCommand($container['tempQueryService']));

// Run it
$application->run();