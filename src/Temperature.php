<?php

namespace PH;

use SQLite3;

class Temperature
{
    private $measure;

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

    public static function take($measure)
    {
        return new self($measure);
    }

    public function measure()
    {
        return $this->measure;
    }

    public function isSuperHot()
    {
        $bd = new SQLite3('tests/db/temperature.db');
        $threshold = $bd->querySingle('SELECT hot_threshold FROM configure');

        return $this->measure() > $threshold;

    }

    public function isSuperCold(ColdThresholdSource $coldThresholdSource)
    {
        $threshold = $coldThresholdSource->getThreshold();
        return $this->measure() < $threshold;

    }


    public static function fromStation($station)
    {
        ##CUIDADO LEY DE DEMETER
        return new static(
            $station->sensor()->temperature()->measure()
        );
    }


    public function add($temperatureForAdd)
    {
        $sum = $this->measure + $temperatureForAdd->measure;
        $this->setMeasure($sum);
    }
}