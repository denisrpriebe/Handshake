<?php

namespace IrishTitan\Handshake\Facades;

use IrishTitan\Handshake\Core\Authentication\Auth as AuthCore;
use IrishTitan\Handshake\Core\Facade;

class Auth extends Facade
{
    /**
     * The class this facade represents.
     *
     * @var string
     */
    protected $class = AuthCore::class;
}