<?php


namespace PH\Domain\HotThreshold;

use PH\Domain\ThresholdInterface;
use PH\Domain\Temperature\Temperature;

interface HotThresholdInterface extends ThresholdInterface
{
    public function isSuperHot(Temperature $temperature): bool;
}
