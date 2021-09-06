<?php
declare(strict_types=1);

namespace PH\Application;

use PH\Domain\Temperature;
use PH\Domain\ThresholdSource;

final class IsSuperHot
{
    private Temperature $temperature;
    private ThresholdSource $threshold;

    public function __construct(Temperature $temperature, ThresholdSource $threshold)
    {
        $this->temperature = $temperature;
        $this->threshold = $threshold;
    }

    public function __invoke(): bool
    {
        return $this->temperature->measure() > $this->threshold->getThreshold();
    }
}