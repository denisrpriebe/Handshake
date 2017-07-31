<?php

namespace IrishTitan\Handshake\Core\Database;

use IrishTitan\Handshake\Core\Handshake;

class Migration
{
    /**
     * Migration constructor.
     *
     */
    public function __construct()
    {
        Handshake::start();
    }

    /**
     * Run the migration.
     *
     * @return void
     */
    public static function install()
    {
        (new static)->up();
    }

    /**
     * Run the inverse of the migration.
     *
     * @return void
     */
    public static function uninstall()
    {
        (new static)->down();
    }

}