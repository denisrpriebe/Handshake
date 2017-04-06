<?php

namespace IrishTitan\Handshake\Exceptions;

use \Exception;

class CategoryNotFoundException extends Exception
{

    /**
     * The exception message.
     *
     * @var string
     */
    protected $message = 'Could not find the category.';

}