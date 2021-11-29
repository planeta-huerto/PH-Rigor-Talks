<?php


namespace PH\Domain\ColdThreshold;

use PH\Domain\ThresholdInterface;
use PH\Domain\Temperature\Temperature;

interface ColdThresholdInterface extends ThresholdInterface
{
    public function isSuperCold(Temperature $temperature): bool;
}
