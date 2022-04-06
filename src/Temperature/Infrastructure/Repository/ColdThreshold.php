<?php


namespace PH\Temperature\Infrastructure\Repository;

use PH\Temperature\Domain\ThresholdSource;
use SQLite3;

class ColdThreshold implements ThresholdSource
{

    public function getThreshold()
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('SELECT cold_threshold FROM configure');
    }
    
}