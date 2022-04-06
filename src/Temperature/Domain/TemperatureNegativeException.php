<?php


namespace PH\Temperature\Domain;


use Exception;

class TemperatureNegativeException extends Exception
{
    public static function fromMeasure(int $measure){

        return new static(
            sprintf("Measure should be positive", $measure)
        );

    }
}