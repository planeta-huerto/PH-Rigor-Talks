<?php

namespace PH\Temperature\Infrastructure\Repository;

use PH\Temperature\Domain\ColdThresholdRepositoryInterface;
use PH\Temperature\Domain\Temperature;
use SQLite3;

class ColdThresholdRepository implements ColdThresholdRepositoryInterface
{
    private $db;

    public function __construct()
    {
        $this->db = new SQLite3('tests/db/temperature.db');
    }

    public function getThreshold()
    {
        return $this->db->querySingle('SELECT cold_threshold FROM configure');
    }

    public function isSuperCold(Temperature $temperature): bool
    {
        return $temperature->measure() < $this->getThreshold();
    }
}