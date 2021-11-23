<?php


namespace PH;


use Exception;

class TemperatureNegativeException extends Exception
{
    public static function fromMeasure($measure)
    {
        return new static(
            sprintf('Measure %s must be positive', $measure)
        );
    }
}
