<?php

namespace PH;

use SQLite3;

class Temperature
{
    private int $measure;

    private function __construct($measure)
    {
        $this->setMeasure($measure);
    }

    private function setMeasure($measure)
    {
        $this->checkMeasureIsPositive($measure);
        $this->measure = $measure;
    }

    /**
     * @param $measure
     * @throws TemperatureNegativeException
     */
    public function checkMeasureIsPositive($measure)
    {
        if ($measure < 0) {
            throw TemperatureNegativeException::fromMeasure($measure);
        }
    }

    public static function take(int $measure): Temperature
    {
        return new static($measure);
    }

    public function measure(): int
    {
        return $this->measure;
    }

    public function isSuperHot(): bool
    {
        $threshold = $this->getThreshold();
        return $this->measure() > $threshold;
    }

    protected function getThreshold()
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('SELECT hot_threshold FROM configure');
    }
}