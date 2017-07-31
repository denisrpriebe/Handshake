<?php

namespace IrishTitan\Handshake\Core\Database;

use Illuminate\Database\Eloquent\Model as Eloquent;
use IrishTitan\Handshake\Core\Handshake;

class Model extends Eloquent
{

    /**
     * Model constructor.
     *
     */
    public function __construct()
    {
        Handshake::start();
    }

}