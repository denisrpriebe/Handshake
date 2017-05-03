<?php

namespace IrishTitan\Handshake\Controller\Adminhtml\Index;

use IrishTitan\Handshake\Core\AdminController;

class Index extends AdminController
{

    /**
     * The title of the page.
     *
     * @var string
     */
    protected $title = 'Handshake';

    /**
     * The active tab.
     *
     * @var string
     */
    protected $activeMenu = 'IrishTitan_Handshake::index';

    /**
     * Handle the controller action.
     *
     * @return mixed
     */
    public function handle()
    {
        return $this->page;
    }

}