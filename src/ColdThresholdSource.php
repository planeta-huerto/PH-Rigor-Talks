<?php


namespace PH;


use phpDocumentor\Reflection\Types\Boolean;

interface ColdThresholdSource
{
    public function getThreshold(): int;
}
