<?php

namespace PH;

class TemperatureTestClass extends Temperature
{
    protected function getThreshold()
    {
        return 100;
    }
}