<?php

namespace PH;

use Exception;

class TemperatureNegativeException extends Exception
{
    public static function fromMeasure($measure)
    {
        return new self(
            sprintf("Measure %d should be positive", $measure)
        );
    }
}