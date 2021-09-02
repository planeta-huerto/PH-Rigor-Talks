<?php

namespace PH;

class TemperatureTestClass extends Temperature
{
    protected function getThreshold(): int
    {
        return 50;
    }
}