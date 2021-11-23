<?php


namespace PH\Tests;

use PH\ColdThreshold;
use PH\ColdThresholdSource;
use PH\Temperature;
use PH\TemperatureNegativeException;
use PH\TemperatureTestClass;
use PHPUnit_Framework_TestCase;

class TemperatureTest extends PHPUnit_Framework_TestCase implements ColdThresholdSource
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
    public function tryToCreateAValidTemperatureWithNamedConstructor()
    {
        $measure = 18;
        $this->assertSame(
            $measure,
            Temperature::take($measure)->measure()
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
            Temperature::take($measure)->measure()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperHot()
    {
        $this->assertFalse(
            TemperatureTestClass::take(4)->isSuperHot()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperHotTemperatureIsSuperHot()
    {
        $this->assertTrue(
            TemperatureTestClass::take(105)->isSuperHot()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperCold()
    {
        $this->assertTrue(
            Temperature::take(4)->isSuperCold(
                $this
            )
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperHotTemperatureIsSuperCold()
    {
        $this->assertFalse(
            Temperature::take(105)->isSuperCold(
                $this
            )
        );
    }

    public function getThreshold(): int
    {
        return 10;
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperColdWithAnomClass()
    {
        $temperature =
        $coldThreshold = new ColdThreshold();

        $this->assertTrue(
            Temperature::take(4)->isSuperCold(
                new class implements ColdThresholdSource {
                    public function getThreshold(): int
                    {
                        return 10;
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
