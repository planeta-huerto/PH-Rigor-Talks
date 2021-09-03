<?php
declare(strict_types=1);

namespace PH\Application;

use PH\Domain\Temperature;

final class IsSuperHot
{
    private Temperature $temperature;
    private $threshold;

    public function __construct(Temperature $temperature, $threshold)
    {
        $this->temperature = $temperature;
        $this->threshold = $threshold;
    }

    public function __invoke(): bool
    {
        return $this->temperature->measure() > $this->threshold->getThreshold();
    }
}