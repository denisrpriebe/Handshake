<?php

namespace IrishTitan\Handshake\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Handshake
{

    /**
     * The database configuration.
     *
     * @var array
     */
    protected $config = [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'testapp_magento',
        'username' => 'root',
        'password' => 'mysql',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        'engine' => null,
    ];

    /**
     * Start handshake and its services.
     *
     */
    public static function start()
    {
        $handshake = new static;
        $handshake->bootEloquent();
    }

    /**
     * Boot up Laravel's Eloquent.
     *
     */
    private function bootEloquent()
    {
        $capsule = new Capsule();

        $capsule->addConnection($this->config);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}