<?php


namespace PH\Temperature\Domain;

interface ThresholdSource
{
    public function getThreshold();
}