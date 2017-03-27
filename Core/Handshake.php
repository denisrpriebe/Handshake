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
        'database' => 'databasename',
        'username' => 'root',
        'password' => 'password',
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
        $handshake->setConfig();
        $handshake->bootEloquent();
    }

    /**
     * Get Magento's configuration.
     *
     * @return mixed
     */
    private function config()
    {
        return include 'app/etc/env.php';
    }

    /**
     * Load Magento's configuration into Handshake.
     *
     */
    private function setConfig()
    {
        $config = $this->config();
        $this->config['database'] = $config['db']['connection']['default']['dbname'];
        $this->config['username'] = $config['db']['connection']['default']['username'];
        $this->config['password'] = $config['db']['connection']['default']['password'];
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