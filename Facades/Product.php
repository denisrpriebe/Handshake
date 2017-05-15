<?php

namespace IrishTitan\Handshake\Facades;

use IrishTitan\Handshake\Core\Facade;
use IrishTitan\Handshake\Core\Entities\Product as ProductCore;

class Product extends Facade
{

    /**
     * The class this facade represents.
     *
     * @var string
     */
    protected $class = ProductCore::class;

}