<?php

namespace PH\Temperature\Domain;

use Exception;

class TemperatureNegativeException extends Exception
{
    public static function fromMeasure($measure): self
    {
        return new self(sprintf(
            'Measure %s must be positive', $measure
        ));
    }
}