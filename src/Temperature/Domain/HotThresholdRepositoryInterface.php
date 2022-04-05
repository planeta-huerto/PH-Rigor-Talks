<?php

namespace PH\Temperature\Domain;

interface HotThresholdRepositoryInterface
{
    public function getThreshold();

    public function isSuperHot(Temperature $temperature);
}