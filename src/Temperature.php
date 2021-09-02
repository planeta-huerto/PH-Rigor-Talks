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
     * @param int $measure
     * @throws TemperatureNegativeException
     */
    public function checkMeasureIsPositive(int $measure)
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

    public function isSuperCold(ColdThresholdSource $coldThresholdSource)
    {
        $theshhold = $coldThresholdSource->getThreshold();

        return $this->measure() < $theshhold;
    }

    protected function getThreshold()
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('SELECT hot_threshold FROM configure');
    }

    public static function fromStation($station)
    {
        //CUIDADO LEY DE DEMETER
        return new static(
            $station->sensor()->temperature()->measure()
        );
    }

    public function add(self $temperatureForAdd): self
    {
        return new self(
            $this->measure() + $temperatureForAdd->measure()
        );
    }
}