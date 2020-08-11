<?php

namespace PH\Infrastructure;

use Pimple\Container;
use SQLite3;

final class TemperatureServiceProvider implements \Pimple\ServiceProviderInterface
{

    /**
     * @inheritDoc
     */
    public function register(Container $pimple)
    {

        $pimple['in_memory_threshold'] = function (){
            return new InMemoryThreshold();
        };

        // AQUI PUEDO DEFINIR LOS DOS DE LAS BASE DE DATOS
        $pimple['hot'] = function (){
            $bd        = new SQLite3('tests/db/temperature.db');
            return $bd->querySingle('SELECT hot_threshold FROM configure');

        };

        $pimple['cold'] = function ($bd){
            $bd        = new SQLite3('tests/db/temperature.db');
            return $bd->querySingle('SELECT cold_threshold FROM configure');
        };
    }
}