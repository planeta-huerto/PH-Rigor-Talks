<?php


namespace PH\Tests;

use PH\Date\Domain\Date;
use PH\Temperature\Domain\Temperature;
use PH\Temperature\Domain\TemperatureNegativeException;
use PH\Temperature\Infrastructure\Repository\ColdThresholdRepository;
use PH\Temperature\Infrastructure\Repository\HotThresholdRepository;
use PH\Temperature\Infrastructure\Service\ApiAemet;
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

    /**
     * @test
     */
    public function tryToGetClimatologicalValuesByDatesAndStation()
    {
        $apiAemet = new ApiAemet();

        $data = $apiAemet->getClimatologicalValuesByDatesAndStation(
            Date::createFromString('2022-03-01'),
            Date::createFromString('2022-03-02'),
            '7247X'
        );

        $this->assertSame('https://opendata.aemet.es/opendata/sh/2ddde596', $data);
    }

    /**
     * @test
     */
    public function tryToGetClimatologicalValuesByDatesAndStationWithNoValidDates()
    {
        $this->expectException(\Exception::class);

        $apiAemet = new ApiAemet();

        $apiAemet->getClimatologicalValuesByDatesAndStation(
            Date::createFromString('2022-03-03'),
            Date::createFromString('2022-03-02'),
            $apiAemet::ALICANTE_STATION
        );
    }

    /**
     * @test
     */
    public function tryToGetClimatologicalValuesByDatesAndStationWithWrongStation()
    {
        $this->expectException(\Exception::class);

        $apiAemet = new ApiAemet();

        $apiAemet->getClimatologicalValuesByDatesAndStation(
            Date::createFromString('2022-03-01'),
            Date::createFromString('2022-03-02'),
            $apiAemet::ALICANTE_STATION . 'X'
        );
    }
}