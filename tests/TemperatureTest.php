<?php

namespace PH\Tests;

use PHPUnit_Framework_TestCase;
use PH\Domain\Temperature\ApiAemet;
use PH\Domain\Temperature\Temperature;
use PH\Infrastructure\Services\ServicesContainer;
use PH\Domain\Temperature\TemperatureNegativeException;

class TemperatureTest extends PHPUnit_Framework_TestCase
{
    protected $servicesContainer;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->servicesContainer = ServicesContainer::getInstance();
    }

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
            Temperature::take($measure)->getMeasure()
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
        $measure = 15;
        $this->assertSame(
            $measure,
            Temperature::take($measure)->getMeasure()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperHot()
    {
        $hotThresholdRepository = $this->servicesContainer->get('hot.repository');

        $this->assertFalse(
            $hotThresholdRepository->isSuperHot(Temperature::take(4))
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperHotTemperatureIsSuperHot()
    {
        $hotThresholdRepository = $this->servicesContainer->get('hot.repository');

        $this->assertTrue(
            $hotThresholdRepository->isSuperHot(Temperature::take(105))
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperCold()
    {
        $coldThresholdRepository = $this->servicesContainer->get('cold.repository');

        $this->assertTrue(
            $coldThresholdRepository->isSuperCold(Temperature::take(4))
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperHotTemperatureIsSuperCold()
    {
        $coldThresholdRepository = $this->servicesContainer->get('cold.repository');

        $this->assertFalse(
            $coldThresholdRepository->isSuperCold(Temperature::take(105))
        );
    }

    /**
     * @test
     */
    public function tryToSumTwoMeasures()
    {
        $temperature1 = Temperature::take(50);
        $temperature2 = Temperature::take(50);

        $total = $temperature1->add($temperature2);

        $this->assertSame(100, $total->getMeasure());
        $this->assertNotSame($total, $temperature1);
        $this->assertNotSame($total, $temperature2);
    }

    /**
     * @test
     */
    public function tryToGetClimatologicalValuesByDatesAndProvince()
    {
        $apiAemet = new ApiAemet();

        $value = $apiAemet->getClimatologicalValueByDatesAndProvince('2020-11-10','2020-11-20', '5972X');

        $this->assertSame('https://opendata.aemet.es/opendata/sh/d697f3bd', $value);
    }

    /**
     * @test
     */
    public function tryToGetClimatologicalValuesByDatesAndProvinceWithNoDataResponse()
    {
        $apiAemet = new ApiAemet();

        $value = $apiAemet->getClimatologicalValueByDatesAndProvince('2020-11-10','2020-11-20', '5972');

        $this->assertSame('There is no data for given params', $value);
    }
}
