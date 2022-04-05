<?php


namespace PH\Tests;

use PH\Temperature\Domain\Temperature;
use PH\Temperature\Domain\TemperatureNegativeException;
use PH\Temperature\Infrastructure\Repository\ColdThresholdRepository;
use PH\Temperature\Infrastructure\Repository\HotThresholdRepository;
use PHPUnit\Framework\TestCase;

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
    public function tryToCheckIfASuperHotTemperatureIsSuperHot()
    {
        $this->assertTrue(
            (new HotThresholdRepository())->isSuperHot(Temperature::take(105))
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfATemperatureNotIsSuperHot()
    {
        $this->assertFalse(
            (new HotThresholdRepository())->isSuperHot(Temperature::take(50))
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfATemperatureNotIsSuperCold()
    {
        $this->assertFalse(
            (new ColdThresholdRepository())->isSuperCold(Temperature::take(10))
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperCold()
    {
        $this->assertTrue(
            (new ColdThresholdRepository())->isSuperCold(Temperature::take(2))
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