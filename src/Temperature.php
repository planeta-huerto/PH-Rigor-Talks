<?php


namespace PH;


use SQLite3;

class Temperature
{
    private $measure;

    public function __construct($measure)
    {
        $this->checkMeasureIsPositive($measure); // Guard Clauses: metodos que comprueban las excepciones antes de hacer
                                                    // algun tipo de asignacion
        $this->measure = $measure;
    }

    /**
     * @param $measure
     * @throws TemperatureNegativeException
     */
    private function checkMeasureIsPositive($measure)
    {
        if ($measure < 0) {
            throw new TemperatureNegativeException("Measure should be positive");
        }
    }

    public function setMeasure($measure)
    {

        $this->measure = $measure;
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