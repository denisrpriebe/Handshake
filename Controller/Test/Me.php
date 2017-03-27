<?php

namespace IrishTitan\Handshake\Controller\Test;

use Magento\Framework\App\Action\Action;

class Me extends Action
{

    public function execute()
    {
        echo 'here';
        die();
    }

}