<?php


namespace PH\Infrastructure;

use phpDocumentor\Reflection\Type;
use Pimple\Container;

final class ServiceContainer
{
    /**
     * @var Container
     */
    private static $instance;

    public static function instance(){
        if(null === static::$instance){
            static::$instance = new Container();
            static::registerProviders();
        }
        return static::$instance;
    }

    public static function registerProviders(){
        static::instance()->register(new TemperaturaServiceProvider());
    }
}