<?php

namespace PH\Domain\Temperature;

use PH\Domain\Temperature\Temperature;
use PH\Infrastructure\Repository\HotThresholdRepository;
use PH\Infrastructure\Repository\ColdThresholdRepository;

interface TemperatureInterface
{
    /**
     * Named constructor
     * @param $measure
     * @return Temperature
     */
    public static function take($measure): Temperature;

    public function getMeasure(): int;

    public function add(Temperature $temperature): Temperature;
}
