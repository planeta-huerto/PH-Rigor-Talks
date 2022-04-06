<?php


namespace PH\Temperature\Infrastructure\Repository;


use PH\Temperature\Domain\ThresholdSource;
use SQLite3;

class HotThreshold implements ThresholdSource
{

    public function getThreshold()
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('SELECT hot_threshold FROM configure');

    }
    
}