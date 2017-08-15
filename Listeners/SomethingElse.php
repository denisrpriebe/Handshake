<?php

namespace IrishTitan\Handshake\Listeners;

use IrishTitan\Handshake\Core\Event\Listener;

class SomethingElse extends Listener
{

    protected function handle()
    {
        $category = $this->data['category'];

        var_dump($category->name);
    }

}