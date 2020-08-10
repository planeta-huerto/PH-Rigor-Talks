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
        $bd        = new SQLite3('tests/db/temperature.db');
        if($thresholdType === 'hot'){
            $threshold = $bd->querySingle('SELECT hot_threshold FROM configure');
        }
        else{
            $threshold = $bd->querySingle('SELECT cold_threshold FROM configure');
        }
        return $threshold;

    }
}