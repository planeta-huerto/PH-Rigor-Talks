<?php

namespace PH\Infrastructure\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use PH\Infrastructure\Repository\ColdThresholdRepository;
use PH\Infrastructure\Repository\HotThresholdRepository;

final class ThresholdServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['cold.repository']              = function () {
            return new ColdThresholdRepository();
        };

        $pimple['hot.repository']               = function () {
            return new HotThresholdRepository();
        };
    }
}
