<?php

namespace PH;

use SQLite3;

class Temperature
{
    /**
     * @var int
     */
    private int $measure;

    /**
     * @throws TemperatureNegativeException
     */
    private function __construct($measure)
    {
        $this->setMeasure($measure);
    }

    /**
     * @throws TemperatureNegativeException
     */
    public function setMeasure($measure)
    {
        $this->checkMeasureIsPositive($measure);

        $this->measure = $measure;
    }

    /**
     * @param $measure
     * @return void
     * @throws TemperatureNegativeException
     */
    public function checkMeasureIsPositive($measure): void
    {
        if ($measure < 0) {
            throw TemperatureNegativeException::fromMeasure($measure);
        }
    }

    public function measure()
    {
        return $this->measure;
    }

    public function isSuperHot()
    {
        $threshold = $this->getThreshold();

        return $this->measure() > $threshold;
    }

    public function isSuperCold(ColdThresholdSource $coldThresholdSource)
    {
        $threshold = $coldThresholdSource->getThreshold();

        return $this->measure() < $threshold;
    }

    private function getThreshold()
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('SELECT hot_threshold FROM configure');
    }

    public static function take($measure): self
    {
        return new self($measure);
    }

    public static function fromStation($station)
    {
        ##CUIDADO LEY DE DEMETER
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