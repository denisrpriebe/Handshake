<?php

namespace IrishTitan\Handshake\Core;

use Magento\Framework\App\ObjectManager;

class App
{
    /**
     * Return a new instance of the given class.
     *
     * @param $class
     * @return mixed
     */
    public static function make($class)
    {
        $objectManager = ObjectManager::getInstance();

        return $objectManager->create($class);
    }

    /**
     * Return an existing instance of the given class
     * if it exists.
     *
     * @param $class
     * @return mixed
     */
    public static function get($class)
    {
        $objectManager = ObjectManager::getInstance();

        return $objectManager->get($class);
    }

}