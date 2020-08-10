<?php

namespace PH\Infrastructure;

use Pimple\Container;

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

    }
}