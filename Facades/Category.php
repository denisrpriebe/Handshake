<?php

namespace IrishTitan\Handshake\Facades;

use IrishTitan\Handshake\Core\Entities\Category as CategoryCore;
use IrishTitan\Handshake\Core\Facade;

class Category extends Facade
{

    /**
     * The class this facade represents.
     *
     * @var string
     */
    protected $class = CategoryCore::class;

}