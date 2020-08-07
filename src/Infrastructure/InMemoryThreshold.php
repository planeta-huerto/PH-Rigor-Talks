<?php

namespace PH\Infrastructure;

use PH\Domain\ThresholdSourceInterface;

final class InMemoryThreshold implements ThresholdSourceInterface
{
    public function getThreshold($thresholdType)
    {
        return $thresholdType === 'hot' ? 50 : 5;
    }
}