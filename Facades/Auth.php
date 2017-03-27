<?php

namespace IrishTitan\Handshake\Facades;

use IrishTitan\Handshake\Contracts\FacadeContract;
use IrishTitan\Handshake\Core\App;
use IrishTitan\Handshake\Core\Auth as AuthCore;

class Auth implements FacadeContract
{

    /**
     * Check if we have an authenticated user.
     *
     * @return bool
     */
    public static function check()
    {
        return static::core()->check();
    }

    /**
     * Get the authenticated user.
     *
     * @return bool|\Magento\Customer\Model\Customer
     */
    public static function user()
    {
        return static::core()->user();
    }

    /**
     * Get the auth class instance.
     *
     * @return AuthCore
     */
    public static function core(): AuthCore
    {
        return App::make(AuthCore::class);
    }

}