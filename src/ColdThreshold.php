<?php


namespace PH;


use SQLite3;

class ColdThreshold implements ColdThresholdSource
{

    public function getThreshold()
    {
        $bd = new SQLite3('tests/db/temperature.db');
        $threshold = $bd->querySingle('SELECT cold_threshold FROM configure');

        return $threshold;
    }
}