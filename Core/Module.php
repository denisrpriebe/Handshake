<?php

namespace IrishTitan\Handshake\Core;

use Magento\Framework\Component\ComponentRegistrar;

class Module
{

    /**
     * Register a new Magento 2 module.
     *
     * @param $name
     * @param $dir
     */
    public static function register($name, $dir)
    {
        ComponentRegistrar::register(ComponentRegistrar::MODULE, $name, $dir);
    }

}