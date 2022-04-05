<?php

namespace PH\Temperature\Domain;

final class Temperature
{
    private int $measure;

    /**
     * @throws TemperatureNegativeException
     */
    public function __construct(int $measure)
    {
        if ($measure < 0) {
            throw TemperatureNegativeException::fromMeasure($measure);
        }

        $this->measure = $measure;
    }

    /**
     * @throws TemperatureNegativeException
     */
    public static function take($measure): self
    {
        return new self($measure);
    }

    public function measure(): int
    {
        return $this->measure;
    }

    public static function fromStation($station)
    {
        ##CUIDADO LEY DE DEMETER
        return new static(
            $station->sensor()->temperature()->measure()
        );
    }

    public function add(self $temperature): self
    {
        return new self($this->measure() + $temperature->measure);
    }
}