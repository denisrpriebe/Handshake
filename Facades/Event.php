<?php

namespace IrishTitan\Handshake\Facades;

use IrishTitan\Handshake\Core\Event\Event as EventCore;
use IrishTitan\Handshake\Core\Facade;

class Event extends Facade
{
    /**
     * The class this facade represents.
     *
     * @var string
     */
    protected $class = EventCore::class;
}