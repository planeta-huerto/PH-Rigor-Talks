<?php

namespace PH\Domain;

use Exception;

class TemperatureNegativeException extends Exception
{
    public static function fromMeasure($measure): TemperatureNegativeException
    {
        return new self(
            sprintf("Measure %d should be positive", $measure)
        );
    }
}