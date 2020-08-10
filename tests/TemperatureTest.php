<?php


namespace PH\Tests;

use PH\Domain\ThresholdSourceInterface;
use PH\Domain\Temperature;
use PH\Domain\TemperatureNegativeException;
use PH\Infrastructure\ServiceContainer;
use PH\Infrastructure\TemperatureTestClass;
use PH\Infrastructure\InMemoryThreshold;
use PHPUnit_Framework_TestCase;
use Pimple\Container;

// Implementacion de la clase anonima
final class ThresholdSourceInterfaceTest implements ThresholdSourceInterface
{

    public function getThreshold($string)
    {
        return 50;
    }
}

class TemperatureTest extends PHPUnit_Framework_TestCase implements ThresholdSourceInterface
{
    private $repository;
    protected function setUp()
    {
        $this->repository = ServiceContainer::instance()['in_memory_threshold'];
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
        $temperature = Temperature::take(105);
        $memoryThreshold = new InMemoryThreshold();
        //$hotThreshold = new HotThreshold();
        $this->assertTrue(
            $temperature->isSuperHot($memoryThreshold)
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureNotIsSuperHot()
    {
        $temperature = Temperature::take(9);
        $memoryThreshold = new InMemoryThreshold();
        $this->assertFalse(
            $temperature->isSuperHot($memoryThreshold)
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureNotIsSuperCold()
    {
        $temperature = Temperature::take(17);
        //$coldThreshold = new InMemoryThreshold();
        //$typethrehold = $container['in_memory_threshold'];

        $this->assertFalse(
            $temperature->isSuperCold(
                //$coldThreshold
                $this->repository
            )
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperCold()
    {
        $temperature = Temperature::take(2);
        $coldThreshold = new InMemoryThreshold();

        $this->assertTrue(
            $temperature->isSuperCold(
                $this
            )
        );
    }
    /*
     * Patron Self Shunt, usamos la propia clase test como test double
     * */
    public function getThreshold($string)
    {
        return 50;
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperColdWithAnomClass()
    {
        $temperature = Temperature::take(2);
        //$coldThreshold = new ColdOrHotThreshold();

        $this->assertTrue(
            $temperature->isSuperCold(
                new ThresholdSourceInterfaceTest()
            )
        );
    }

    /**
     * @test
     */
    public function tryToCreateATemperatureFromStation()
    {
        //$this->markTestSkipped();

        $this->assertSame(
            50,
            Temperature::fromStation(
                $this
            )->measure()
        );
    }

    public function sensor(){
        return $this;
    }

    public function temperature(){
        return $this;
    }

    public function measure(){
        return 50;
    }

    /**
     * @test
     */
    public function tryToSumTwoMeasures()
    {
        $a = Temperature::take(50);
        $b = Temperature::take(50);

        $c = $a->add($b); // Inmutabilidad: Asegurarnos de que nuestras operaciones devuelven
                        // una nueva instancia

        echo "ESto" . $a->measure();
        $this->assertSame(100, $c->measure());
        $this->assertNotSame($c, $a);
        $this->assertNotSame($c, $b);

    }

}