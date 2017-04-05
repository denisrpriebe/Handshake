<?php

namespace IrishTitan\Handshake\Controller\Test;

use IrishTitan\Handshake\Core\Controller;

class NewController extends Controller
{

    public function handle()
    {
        return $this->pageFactory->create();
    }

}