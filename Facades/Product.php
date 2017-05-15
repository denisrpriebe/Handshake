<?php

namespace IrishTitan\Handshake\Facades;

use IrishTitan\Handshake\Core\Entities\Product as ProductCore;
use IrishTitan\Handshake\Core\Facade;

/**
 * Class Product
 *
 * @method boolean find($id, $store = null)
 *
 * @package IrishTitan\Handshake\Facades
 */
class Product extends Facade
{

    /**
     * The class this facade represents.
     *
     * @var string
     */
    protected $class = ProductCore::class;

}