<?php

namespace PH\Infrastructure;

use PH\Domain\ThresholdSourceInterface;
use SQLite3;
final class SQLThreshold implements ThresholdSourceInterface
{
    /*
     * $consulta puede ser:
     *      'SELECT hot_threshold FROM configure'
     *      'SELECT cold_threshold FROM configure'
     */
    public function getThreshold($consult) // Este metodo tiene la insfraestructura
    {
        $bd        = new SQLite3('tests/db/temperature.db');
        $threshold = $bd->querySingle($consult);
        return $threshold;
    }
}