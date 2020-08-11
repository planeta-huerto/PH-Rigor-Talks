<?php

namespace PH\Infrastructure;

use PH\Domain\ThresholdSourceInterface;

final class SQLThreshold implements ThresholdSourceInterface
{
    // Este metodo tiene la insfraestructura
    public function getThreshold($thresholdType) { ServiceContainer::instance()[$thresholdType]; }
}