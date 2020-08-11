<?php


namespace PH\Domain;


use Pimple\Container;
use SQLite3;

class Temperature
{
    private $measure;

    /**
     * Named Constructor, permite codigo mucho mas alineado  con nuestro lenguaje de negocio
     */
    public static function take($measure){
        return new self($measure);
        // return new static($measure);
    }

    private function __construct($measure)
    {
        $this->setMeasure($measure);
    }

    private function setMeasure($measure)
    {
        /**
         * Self-Encapsulation permite coger nuestros setters (asignaciones de variables internas)
         * y moverlos a setters internos privados de forma que podamos centralizar todo lo que
         * tenga que ver con esos campos.
         */
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
            throw TemperatureNegativeException::fromMeasure($measure);
        }
    }

    public function measure()
    {
        return $this->measure;
    }

    public function isSuperHot(ThresholdSourceInterface $hotThresholdSource)
    {
        $threshold = $hotThresholdSource->getThreshold('hot');
        return $this->measure() > $threshold;
        //return false;
    }

    public function isSuperCold(ThresholdSourceInterface $coldThresholdSource)
    {
        $threshold = $coldThresholdSource->getThreshold('cold');
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
        return new self(
            $this->measure() + $temperatureForAdd->measure()
        );
    }



}