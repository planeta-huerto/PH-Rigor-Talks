<?php

namespace PH\Tests;

use PH\Domain\ThresholdSource;

class ThresholdTestClass implements ThresholdSource
{
    private int $threshold;

    private function __construct($threshold)
    {
        $this->threshold = $threshold;
    }

    public static function take(int $threshold): ThresholdTestClass
    {
        return new static($threshold);
    }

    public function getThreshold(): int
    {
        return $this->threshold;
    }
}