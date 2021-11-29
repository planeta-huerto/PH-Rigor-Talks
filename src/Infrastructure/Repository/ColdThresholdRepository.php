<?php


namespace PH\Infrastructure\Repository;

use SQLite3;
use PH\Domain\Temperature\Temperature;
use PH\Domain\ColdThreshold\ColdThresholdInterface;

final class ColdThresholdRepository implements ColdThresholdInterface
{
    public function setThreshold(int $measure): int
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('ALTER TABLE configure SET cold_threshold ='.$measure);
    }

    public function getThreshold(): int
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('SELECT cold_threshold FROM configure');
    }

    public function isSuperCold(Temperature $temperature): bool
    {
        return $temperature->getMeasure() < $this->getThreshold();
    }
}
