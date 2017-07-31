<?php

namespace IrishTitan\Handshake\Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use IrishTitan\Handshake\Core\Security\Registry;
use IrishTitan\Handshake\Facades\Directory;

class Handshake
{
    /**
     * Handshake constructor.
     *
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $registry->secure();
    }

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
     * @return void
     */
    public static function start()
    {
        $handshake = App::make(static::class);

        $handshake->setConfig();
        $handshake->bootEloquent();
    }

    /**
     * Get Magento's configuration.
     *
     * @return mixed
     */
    protected function config()
    {
        return include Directory::app() . '/etc/env.php';
    }

    /**
     * Load Magento's configuration into Handshake.
     *
     * @return void
     */
    protected function setConfig()
    {
        $config = $this->config();

        $this->config['database'] = $config['db']['connection']['default']['dbname'];
        $this->config['username'] = $config['db']['connection']['default']['username'];
        $this->config['password'] = $config['db']['connection']['default']['password'];
    }

    /**
     * Boot up Laravel's Eloquent.
     *
     * @return void
     */
    protected function bootEloquent()
    {
        $capsule = new Capsule();

        $capsule->addConnection($this->config);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}