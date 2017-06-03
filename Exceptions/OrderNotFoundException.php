<?php

namespace IrishTitan\Handshake\Exceptions;

use \Exception;

class OrderNotFoundException extends Exception
{

    /**
     * The exception message.
     *
     * @var string
     */
    protected $message = 'Could not find the order.';

}