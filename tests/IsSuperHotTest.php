<?php

namespace PH\Tests;

use PH\Application\IsSuperHot;
use PH\Domain\Temperature;
use PHPUnit_Framework_TestCase;

class IsSuperHotTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function tryToCheckIfASuperHotTemperatureIsSuperHot()
    {
        $temperature = Temperature::take(100);
        $threshold = ThresholdTestClass::take(50);
        $isSuperHot = new IsSuperHot($temperature, $threshold);

        $this->assertTrue(
            $isSuperHot()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfOtherTemperatureNotIsSuperHot()
    {
        $temperature = Temperature::take(10);
        $threshold = ThresholdTestClass::take(50);
        $isSuperHot = new IsSuperHot($temperature, $threshold);

        $this->assertFalse(
            $isSuperHot()
        );
    }
}