<?php


namespace PH\Tests;

use PH\Temperature\Application\IsSuperCold;
use PH\Temperature\Application\IsSuperHot;
use PH\Temperature\Domain\Temperature;
use PH\Temperature\Domain\TemperatureNegativeException;
use PH\Temperature\Domain\ThresholdSource;
use PHPUnit\Framework\TestCase;


class TemperatureTest extends TestCase implements ThresholdSource
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
    public function tryToCreateAValidTemperatureNamedWithConstructor()
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
    public function tryToGetTemperature()
    {
        $temperature = Temperature::take(105);
        $definedTemperature = $temperature;
        $this->assertEquals(
            $temperature, $definedTemperature
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperHot()
    {
        $temperature = Temperature::take(10);
        $threshold = ThresholdTestClass::take(50);
        $isSuperHot = new IsSuperHot($temperature, $threshold);

        $this->assertFalse(
            $isSuperHot()
        );

    }

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
    public function tryToCheckIfAColdTemperatureNotIsSuperHot()
    {
        $temperature = Temperature::take(10);
        $threshold = ThresholdTestClass::take(50);
        $isSuperHot = new IsSuperHot($temperature, $threshold);

        $this->assertFalse(
            $isSuperHot()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperCold()
    {
        $temperature = Temperature::take(10);
        $threshold = ThresholdTestClass::take(50);
        $isSuperHot = new IsSuperHot($temperature, $threshold);

        $this->assertFalse(
            $isSuperHot()
        );
    }


    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureNotIsSuperCold()
    {
        $temperature = Temperature::take(100);
        $threshold = ThresholdTestClass::take(50);
        $isSuperCold = new IsSuperCold($temperature, $threshold);

        $this->assertFalse(
            $isSuperCold()
        );
    }


    /**
     * @test
     */
    public function tryToCreateATemperatureFromStation()
    {
        $this->markTestSkipped();

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
        $this->assertNotSame($c, $b);
        $this->assertNotSame($c, $a);

    }

    public function getThreshold(): int
    {
        return 50;
    }


}