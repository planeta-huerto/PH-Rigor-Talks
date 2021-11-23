<?php


namespace PH;


use SQLite3;

class ColdThreshold implements ColdThresholdSource
{

    public function getThreshold(): int
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('SELECT cold_threshold FROM configure');
    }
}
