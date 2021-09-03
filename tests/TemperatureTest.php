<?php

namespace PH\Tests;

use PH\Domain\Temperature;
use PH\Domain\TemperatureNegativeException;
use PH\Domain\ThresholdSource;
use PHPUnit_Framework_TestCase;

class TemperatureTest extends PHPUnit_Framework_TestCase implements ThresholdSource
{
    /**
     * @test
     */
    public function tryToCreateANonValidTemperature()
    {
        $this->expectException(TemperatureNegativeException::class);
        Temperature::take(-1);
    }

    /**
     * @test
     */
    public function tryToCreateAValidTemperatureWithNamedConstructor()
    {
        $measure = 18;
        $this->assertSame(
            $measure,
            (Temperature::take($measure)->measure())
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperHot()
    {
        $this->assertFalse(
            TemperatureTestClass::take(10)->isSuperHot()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperHotTemperatureIsSuperHot()
    {
        $this->assertTrue(
            TemperatureTestClass::take(100)->isSuperHot()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperCold()
    {
        $this->assertTrue(
            Temperature::take(10)->isSuperCold(
                $this
            )
        );
    }

    public function getThreshold(): int
    {
        return 50;
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperColdWithAnonClass()
    {
        $this->assertTrue(
            Temperature::take(10)->isSuperCold(
                new class implements ThresholdSource
                {
                    public function getThreshold(): int
                    {
                        return 50;
                    }
                }
            )
        );
    }

    /**
     * @test
     */
    public function tryToCreateATemperatureFromStation()
    {
        $this->assertSame(
            50,
            Temperature::fromStation(
                $this
            )->measure()
        );
    }

    public function sensor()
    {
        return $this;
    }

    public function temperature()
    {
        return $this;
    }

    public function measure()
    {
        return 50;
    }

    /**
     * @test
     */
    public function tryToSumTwoMeasures()
    {
        $a = Temperature::take(50);
        $b = Temperature::take(50);

        $c = $a->add($b);

        $this->assertSame(100, $c->measure());
        $this->assertNotSame($c, $a);
        $this->assertNotSame($c, $b);
    }
}