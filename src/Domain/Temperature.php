<?php

namespace PH\Domain;

class Temperature
{
    private float $measure;

    private function __construct($measure)
    {
        $this->setMeasure($measure);
    }

    private function setMeasure($measure)
    {
        $this->checkMeasureIsPositive($measure);
        $this->measure = $measure;
    }

    public static function take(float $measure): Temperature
    {
        return new static($measure);
    }

    public function measure(): float
    {
        return $this->measure;
    }

    public function add(self $temperatureForAdd): self
    {
        return new self(
            $this->measure() + $temperatureForAdd->measure()
        );
    }

    /**
     * @param float $measure
     * @throws TemperatureNegativeException
     */
    public function checkMeasureIsPositive(float $measure)
    {
        if ($measure < 0) {
            throw TemperatureNegativeException::fromMeasure($measure);
        }
    }

    public static function fromStation($station)
    {
        //CUIDADO LEY DE DEMETER
        return new static(
            $station->sensor()->temperature()->measure()
        );
    }
}