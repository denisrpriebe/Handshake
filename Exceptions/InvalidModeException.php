<?php

namespace IrishTitan\Handshake\Exceptions;

use Exception;

class InvalidModeException extends Exception
{

    /**
     * The exception message.
     *
     * @var string
     */
    protected $message = 'Invalid mode given. Please use "required" or "optional".';

}