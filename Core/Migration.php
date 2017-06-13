<?php

namespace IrishTitan\Handshake\Core;

use ReflectionClass;

class Migration
{

    /**
     * Migration constructor.
     */
    public function __construct()
    {
        Handshake::start();
    }

    /**
     * Get the class name of the migration.
     *
     * @return string
     */
    public static function name()
    {
        return (new ReflectionClass(static::class))->getShortName();
    }



    /**
     * Run the migration.
     *
     * @return void
     */
    public static function migrate()
    {
        $migration = new static;
        $migration->up();
    }

    /**
     * Run the inverse of the migration.
     *
     * @return void
     */
    public static function reverse()
    {
        $migration = new static;
        $migration->down();
    }

}