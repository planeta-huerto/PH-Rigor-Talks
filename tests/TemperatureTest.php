<?php


namespace PH\Tests;

use PH\ColdThreshold;
use PH\ColdThresholdSource;
use PH\Temperature;
use PH\TemperatureNegativeException;
use PH\TemperatureTestClass;
use PHPUnit_Framework_TestCase;

class ColdThresholdSourceTest implements ColdThresholdSource{
    public function getThreshold()
    {
        return 50;
    }
}

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
    public function tryToCreateAValidTemperatureWithNameConstructor()
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
        $coldThreshold = new ColdThreshold();

        $this->assertFalse(
            $temperature->isSuperCold(
                $coldThreshold
            )
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperCold()
    {
        $temperature = Temperature::take(2);
        $coldThreshold = new ColdThreshold();

        $this->assertTrue(
            $temperature->isSuperCold(
                $this
            )
        );
    }
    /*
     * Patron Self Shunt, usamos la propia clase test como test double
     * */
    public function getThreshold()
    {
        return 50;
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperColdWithAnomClass()
    {
        $temperature = Temperature::take(2);
        //$coldThreshold = new ColdThreshold();

        $this->assertTrue(
            $temperature->isSuperCold(
                new ColdThresholdSourceTest()
            )
        );
    }

    /**
     * @test
     */
    public function tryToCreateATemperatureFromStation()
    {
        $this->markTestSkipped();

    }

    /**
     * @test
     */
    public function tryToSumTwoMeasures()
    {
        $a = Temperature::take(50);
        $b = Temperature::take(50);

        $a->add($b);

        echo "ESto" . $a->measure();
        $this->assertSame(100, $a->measure());

    }

}