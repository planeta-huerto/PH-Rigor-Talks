<?php


namespace PH\Tests;

use PH\ColdThreshold;
use PH\Temperature;
use PH\TemperatureNegativeException;
use PHPUnit_Framework_TestCase;

class TemperatureTest extends PHPUnit_Framework_TestCase
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
}