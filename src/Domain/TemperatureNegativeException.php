<?php


namespace PH\Domain;


use Exception;

class TemperatureNegativeException extends Exception
{
    public static function fromMeasure($measure) {
        return new static(
            sprintf('Measure %d must be positive', $measure)
        );
    }
}