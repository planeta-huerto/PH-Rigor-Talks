<?php

namespace PH\Temperature\Domain;

interface ColdThresholdRepositoryInterface
{
    public function getThreshold();

    public function isSuperCold(Temperature $temperature);
}