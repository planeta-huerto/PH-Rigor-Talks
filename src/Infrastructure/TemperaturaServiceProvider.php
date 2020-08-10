<?php

namespace PH\Infrastructure;

use Pimple\Container;

final class TemperaturaServiceProvider implements \Pimple\ServiceProviderInterface
{

    /**
     * @inheritDoc
     */
    public function register(Container $pimple)
    {
        $pimple['in_memory_threshold'] = function (){
            return new InMemoryThreshold();
        };
    }
}