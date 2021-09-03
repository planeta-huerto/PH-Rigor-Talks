<?php
declare(strict_types=1);

namespace PH\Infrastructure;

use PH\Domain\ThresholdSource;
use SQLite3;

final class ColdThreshold implements ThresholdSource
{
    public function getThreshold()
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('SELECT cold_threshold FROM configure');
    }
}