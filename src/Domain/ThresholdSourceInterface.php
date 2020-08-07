<?php


namespace PH\Domain;


interface ThresholdSourceInterface
{
    public function getThreshold($thresholdType);
}