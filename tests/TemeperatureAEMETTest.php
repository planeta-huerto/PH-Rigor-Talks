<?php
declare(strict_types=1);

namespace PH\Tests;

use PH\Domain\Temperature;
use PH\Infrastructure\TemperatureAEMET;
use PHPUnit_Framework_TestCase;

class TemeperatureAEMETTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function tryToGetTemperatureFromAPI()
    {
        $aemet = new TemperatureAEMET();
        $aemetTemperature = $aemet->getTemperature();
        $this->assertNotEmpty($aemetTemperature);
    }

    /**
     * @test
     */
    public function tryToCreateAValidTemperatureFromAPI()
    {
        $aemet = new TemperatureAEMET();
        $aemetTemperature = $aemet->getTemperature();
        $temperature = Temperature::take($aemetTemperature);

        $this->assertSame($aemetTemperature, $temperature->measure());
    }
}