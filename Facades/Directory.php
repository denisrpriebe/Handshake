<?php

namespace IrishTitan\Handshake\Facades;

use IrishTitan\Handshake\Core\Facade;
use IrishTitan\Handshake\Utilities\Directory as DirectoryUtil;

class Directory extends Facade
{

    /**
     * The class this facade represents.
     *
     * @var string
     */
    protected $class = DirectoryUtil::class;

}