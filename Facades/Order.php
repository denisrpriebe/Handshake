<?php

namespace IrishTitan\Handshake\Facades;

use IrishTitan\Handshake\Core\Entities\Order as OrderCore;
use IrishTitan\Handshake\Core\Facade;

class Order extends Facade
{

    /**
     * The class this facade represents.
     *
     * @var string
     */
    protected $class = OrderCore::class;

}