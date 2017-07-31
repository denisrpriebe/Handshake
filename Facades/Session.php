<?php

namespace IrishTitan\Handshake\Facades;

use IrishTitan\Handshake\Core\Facade;
use IrishTitan\Handshake\Core\Session\Session as SessionCore;

class Session extends Facade
{
    /**
     * The class this facade represents.
     *
     * @var SessionCore
     */
    protected $class = SessionCore::class;
}