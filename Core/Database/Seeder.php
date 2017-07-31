<?php

namespace IrishTitan\Handshake\Core\Database;

use IrishTitan\Handshake\Core\Handshake;
use ReflectionClass;

class Seeder
{

    /**
     * Seeder constructor.
     *
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
     * Run the database seed.
     *
     */
    public static function seed()
    {
        $seeder = new static;
        $seeder->run();
    }
}