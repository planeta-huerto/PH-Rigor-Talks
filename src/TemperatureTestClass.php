<?php
namespace PH;

use SQLite3;

class TemperatureTestClass extends Temperature
{
    protected function getThreshold(): int
    {
        return 50;
    }
}
