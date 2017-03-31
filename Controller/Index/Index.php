<?php

namespace IrishTitan\Handshake\Controller\Index;

use IrishTitan\Handshake\Core\App;
use IrishTitan\Handshake\Facades\Session;
use Magento\Framework\App\Action\Action;
use Magento\Sales\Api\Data\OrderInterface;

class Index extends Action
{

    public function execute()
    {

        Session::set('test', [1,2,3,4,5]);
        Session::forget('test');

        var_dump(Session::get('test'));
        die();

    }

}