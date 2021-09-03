<?php

namespace PH\Domain;

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

    public static function take(int $measure): Temperature
    {
        return new static($measure);
    }

    public function measure(): int
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
     * @param int $measure
     * @throws TemperatureNegativeException
     */
    public function checkMeasureIsPositive(int $measure)
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