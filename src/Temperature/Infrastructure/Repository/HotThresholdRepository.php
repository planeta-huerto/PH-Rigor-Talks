<?php

namespace PH\Temperature\Infrastructure\Repository;

use PH\Temperature\Domain\HotThresholdRepositoryInterface;
use PH\Temperature\Domain\Temperature;
use SQLite3;

class HotThresholdRepository implements HotThresholdRepositoryInterface
{
    private $db;

    public function __construct()
    {
        $this->db = new SQLite3('tests/db/temperature.db');
    }

    public function getThreshold()
    {
        return $this->db->querySingle('SELECT hot_threshold FROM configure');
    }

    public function isSuperHot(Temperature $temperature)
    {
        return $temperature->measure() > $this->getThreshold();
    }
}