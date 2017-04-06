<?php

namespace IrishTitan\Handshake\Core;

abstract class Facade
{

    /**
     * The class for the facade to represent.
     *
     * @var
     */
    protected $class;

    /**
     * Call the core methods statically.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return static::core()->$name(...$arguments);
    }

    /**
     * Get the core class.
     *
     * @return ProductCore
     */
    protected static function core()
    {
        return App::make((new static())->class);
    }

}