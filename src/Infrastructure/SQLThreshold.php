<?php

namespace PH\Infrastructure;

use PH\Domain\ThresholdSourceInterface;
use SQLite3;
use Pimple\Container;
final class SQLThreshold implements ThresholdSourceInterface
{
    /*
     * $consulta puede ser:
     *      'SELECT hot_threshold FROM configure'
     *      'SELECT cold_threshold FROM configure'
     */

    public function getThreshold($thresholdType) // Este metodo tiene la insfraestructura
    {
        ServiceContainer::instance()[$thresholdType];
    }
}