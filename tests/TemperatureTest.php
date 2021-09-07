<?php

namespace PH\Tests;

use PH\Domain\Temperature;
use PH\Domain\TemperatureNegativeException;
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
            FloatVal($measure),
            (Temperature::take($measure)->measure())
        );
    }

    /**
     * @test
     */
    public function tryToSumTwoMeasures()
    {
        $a = Temperature::take(50);
        $b = Temperature::take(50);

        $c = $a->add($b);

        $this->assertSame(FloatVal(100), $c->measure());
        $this->assertNotSame($c, $a);
        $this->assertNotSame($c, $b);
    }
}