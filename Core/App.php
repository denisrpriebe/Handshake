<?php

namespace IrishTitan\Handshake\Core;

use Magento\Framework\App\ObjectManager;

class App
{

    /**
     * Return an instance of the given class.
     *
     * @param $class
     * @return mixed
     */
    public static function make($class)
    {
        $objectManager = ObjectManager::getInstance();

        return $objectManager->get($class);
    }

}