<?php


namespace PH\Tests;

use PH\ColdThreshold;
use PH\ColdThresholdSource;
use PH\Temperature;
use PH\TemperatureNegativeException;
use PH\TemperatureTestClass;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_TestCase;

class TemperatureTest extends TestCase implements ColdThresholdSource
{
    /**
     * @test
     */
    public function testFirst()
    {
        $this->assertTrue(true);
    }

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
    public function tryToCreateAValidTemperature()
    {
        $measure = 18;
        $this->assertSame(
            $measure,
            (Temperature::take($measure))->measure()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperHot()
    {
        $temperature = TemperatureTestClass::take(105);
        $this->assertTrue(
            $temperature->isSuperHot()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureNotIsSuperHot()
    {
        $temperature = TemperatureTestClass::take(50);
        $this->assertFalse(
            $temperature->isSuperHot()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureNotIsSuperCold()
    {
        $temperature = Temperature::take(10);

        $this->assertFalse(
            $temperature->isSuperCold(
                $this
            )
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperCold()
    {
        $temperature = Temperature::take(2);

        $this->assertTrue(
            $temperature->isSuperCold(
                $this
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

    public function getThreshold()
    {
        return 5;
    }
}