<?php


namespace PH;


use Exception;

class TemperatureNegativeException extends Exception
{
    public static function fromMeasure($measure): self
    {
        return new self("Measure should be positive");
    }
}