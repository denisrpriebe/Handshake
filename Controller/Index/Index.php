<?php

namespace IrishTitan\Handshake\Controller\Index;

use IrishTitan\Handshake\Facades\Auth;
use Magento\Framework\App\Action\Action;

class Index extends Action
{

    public function execute()
    {

        if (Auth::check()) {
            echo 'Logged In';
        } else {
            echo 'Logged Out';
        }

    }

}