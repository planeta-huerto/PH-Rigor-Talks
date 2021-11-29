<?php

namespace PH\Domain;

interface ThresholdInterface
{
    public function setThreshold(int $measure): int;
    public function getThreshold(): int;
}
