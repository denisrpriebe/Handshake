<?php

namespace IrishTitan\Handshake\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Schema
{

    public static function create($table, $callback)
    {
        return static::get()->create($table, $callback);
    }

    public static function drop($table)
    {
        return static::get()->dropIfExists($table);
    }

    public static function get()
    {
        return Capsule::schema();
    }

}