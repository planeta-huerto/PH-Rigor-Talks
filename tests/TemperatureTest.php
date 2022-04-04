<?php


namespace PH\Tests;

use PH\ColdThreshold;
use PH\Temperature;
use PH\TemperatureNegativeException;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_TestCase;

class TemperatureTest extends TestCase
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

        new Temperature(-1);
    }

    /**
     * @test
     */
    public function tryToCreateAValidTemperature()
    {
        $measure = 18;
        $this->assertSame(
            $measure,
            (new Temperature($measure))->measure()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperHot()
    {
        $temperature = new Temperature(105);
        $this->assertTrue(
            $temperature->isSuperHot()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureNotIsSuperHot()
    {
        $temperature = new Temperature(50);
        $this->assertFalse(
            $temperature->isSuperHot()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureNotIsSuperCold()
    {
        $temperature = new Temperature(10);
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
        $temperature = new Temperature(2);
        $coldThreshold = new ColdThreshold();

        $this->assertTrue(
            $temperature->isSuperCold(
                $coldThreshold
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
        $a = new Temperature(50);
        $b = new Temperature(50);

        $a->add($b);

        echo "ESto" . $a->measure();
        $this->assertSame(100, $a->measure());

    }

}