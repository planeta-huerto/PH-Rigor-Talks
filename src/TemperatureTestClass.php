<?php


namespace PH;


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