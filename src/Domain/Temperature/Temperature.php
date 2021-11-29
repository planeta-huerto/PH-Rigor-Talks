<?php


namespace PH\Domain\Temperature;

use PH\Domain\Temperature\TemperatureInterface;
use PH\Domain\Temperature\TemperatureNegativeException;

final class Temperature implements TemperatureInterface
{
    private $measure;

    /**
     * Private constructor
     */
    private function __construct($measure)
    {
        $this->setMeasure($measure);
    }

    /**
     * Named constructor
     * @param $measure
     * @return static
     */
    public static function take($measure): self
    {
        return new self($measure);
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
    private function checkMeasureIsPositive(int $measure)
    {
        if ($measure < 0) {
            throw new TemperatureNegativeException(
                sprintf('Measure %s must be positive', $measure)
            );
        }
    }

    public function getMeasure(): int
    {
        return $this->measure;
    }

    public function add(self $temperature): self
    {
        return new self($this->getMeasure() + $temperature->measure);
    }
}
