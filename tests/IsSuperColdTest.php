<?php

namespace PH\Tests;

use PH\Application\IsSuperCold;
use PH\Domain\Temperature;
use PHPUnit_Framework_TestCase;

class IsSuperColdTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperCold()
    {
        $temperature = Temperature::take(10);
        $threshold = ThresholdTestClass::take(50);
        $isSuperCold = new IsSuperCold($temperature, $threshold);

        $this->assertTrue(
            $isSuperCold()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfOtherTemperatureNotIsSuperCold()
    {
        $temperature = Temperature::take(100);
        $threshold = ThresholdTestClass::take(50);
        $isSuperCold = new IsSuperCold($temperature, $threshold);

        $this->assertFalse(
            $isSuperCold()
        );
    }
}