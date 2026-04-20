<?php
namespace App\Config;

class Web {
    protected static $container;

    public static function setContainer($container)
    {
        static::$container = $container;
    } 

    public static function Container()
    {
        return static::$container;
    } 
}