<?php

namespace PH\Infrastructure\Repository;

use SQLite3;
use PH\Domain\Temperature\Temperature;
use PH\Domain\HotThreshold\HotThresholdInterface;

final class HotThresholdRepository implements HotThresholdInterface
{
    public function setThreshold(int $measure): int
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('ALTER TABLE configure SET hot_threshold ='.$measure);
    }

    public function getThreshold(): int
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('SELECT hot_threshold FROM configure');
    }

    public function isSuperHot(Temperature $temperature): bool
    {
        return $temperature->getMeasure() > $this->getThreshold();
    }
}
