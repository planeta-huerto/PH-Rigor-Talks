<?php


namespace PH;

use phpDocumentor\Reflection\Types\Boolean;
use SQLite3;

class Temperature
{
    private $measure;

    /**
     * Private constructor
     */
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
     * Guard clause
     *
     * @param int $measure
     * @throws TemperatureNegativeException
     */
    private function checkMeasureIsPositive($measure)
    {
        if ($measure < 0) {
            throw TemperatureNegativeException::fromMeasure($measure);
        }
    }

    /**
     * Named constructor
     * @param $measure
     * @return static
     */
    public static function take($measure): self
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

    protected function getThreshold(): int
    {
        $bd = new SQLite3('tests/db/temperature.db');
        return $bd->querySingle('SELECT hot_threshold FROM configure');
    }

    public function isSuperCold(ColdThresholdSource $coldThresholdSource): bool
    {
        $threshold = $coldThresholdSource->getThreshold();

        return $this->measure() < $threshold;

    }

    public static function fromStation($station): self
    {
        ##CUIDADO LEY DE DEMETER
        return new static(
            $station->sensor()->temperature()->measure()
        );
    }

    public function add(self $anotherTemperature): self
    {
        return new self($this->measure() + $anotherTemperature->measure);
    }
}
