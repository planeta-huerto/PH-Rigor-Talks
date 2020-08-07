<?php

namespace PH\Infrastructure;

use PH\Domain\ThresholdSourceInterface;

final class InMemoryThreshold implements ThresholdSourceInterface
{
    public function getThreshold($consult)
    {
        return 10;
    }
}