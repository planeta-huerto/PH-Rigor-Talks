<?php


namespace PH\Infrastructure;

use PH\Domain\Temperature;

use SQLite3;

class TemperatureTestClass extends  Temperature
{

    /**
     * @return mixed
     */
    protected function getThreshold()
    {
        return 50;
    }


}