#!/usr/bin/env php
<?php

use PH\Bin\Commands\SuperHotCommand;

require_once __DIR__ . '/../../vendor/autoload.php';

// Create the Application
$application = new Symfony\Component\Console\Application;


// Register all Commands
$application->add(new SuperHotCommand());

// Run it
$application->run();