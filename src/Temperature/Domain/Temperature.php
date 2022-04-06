<?php


namespace PH\Temperature\Domain;

class Temperature
{
    private $measure;

    public static function take($measure): self
    {
        return new static($measure);
    }

    private function __construct($measure)
    {
       $this->setMeasure($measure);

    }

    private function setMeasure($measure)
    {
        $this->checkMeasurePositive($measure);
        $this->measure = $measure;
    }

    private function checkMeasurePositive($measure)
    {
        if ($measure < 0) {
            throw  TemperatureNegativeException::fromMeasure($measure);
        }
    }

    public function measure()
    {
        return $this->measure;
    }


    public static function fromStation($station):self
    {
        ##CUIDADO LEY DE DEMETER
        return new static(
            $station->sensor()->temperature()->measure()
        );
    }


    public function add(self $temperatureForAdd):self
    {
        return new self(
            $this->measure() + $temperatureForAdd->measure()
        );

    }

}