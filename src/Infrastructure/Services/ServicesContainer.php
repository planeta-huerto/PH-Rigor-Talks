<?php

namespace PH\Infrastructure\Services;

use Pimple\Container;
use Psr\Container\ContainerInterface;
use PH\Infrastructure\Providers\ThresholdServiceProvider;

final class ServicesContainer extends Container implements ContainerInterface
{
    private static $instance;

    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
            self::$instance->registerProviders();
        }

        return self::$instance;
    }

    public function registerProviders()
    {
        $this->register(new ThresholdServiceProvider());
    }

    public function get($id)
    {
        return $this[$id];
    }

    public function has($id): bool
    {
        return $this->offsetExists($id);
    }
}
