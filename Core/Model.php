<?php

namespace IrishTitan\Handshake\Core;

use Illuminate\Database\Eloquent\Model as Eloquent;

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