<?php

namespace IrishTitan\Handshake\Facades;

use IrishTitan\Handshake\Contracts\FacadeContract;
use IrishTitan\Handshake\Core\App;
use IrishTitan\Handshake\Core\Session as SessionCore;
use Magento\Framework\Session\SessionManager;

class Session implements FacadeContract
{

    /**
     * Save a variable to the session.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function set($key, $value)
    {
        return static::core()->set($key, $value);
    }

    /**
     * Set the session instance.
     *
     * @param SessionManager $instance
     */
    public static function setInstance(SessionManager $instance)
    {
        return static::core()->setInstance($instance);
    }

    /**
     * Retrieve a value from the session.
     *
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        return static::core()->get($key);
    }

    /**
     * Check if the session has the given key.
     *
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return static::core()->has($key);
    }

    /**
     * Clear all session data.
     *
     * @return mixed
     */
    public static function flush()
    {
        return static::core()->flush();
    }

    /**
     * Unset a value from the session.
     *
     * @param $key
     * @return mixed
     */
    public static function forget($key)
    {
        return static::core()->forget($key);
    }

    /**
     * Get the session core.
     *
     * @return SessionCore
     */
    public static function core(): SessionCore
    {
        return App::make(SessionCore::class);
    }

}