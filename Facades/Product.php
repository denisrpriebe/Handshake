<?php

namespace IrishTitan\Handshake\Facades;

use IrishTitan\Handshake\Core\Catalog\Product as ProductCore;
use IrishTitan\Handshake\Core\Facade;

class Product extends Facade
{
    /**
     * The class this facade represents.
     *
     * @var ProductCore
     */
    protected $class = ProductCore::class;
}