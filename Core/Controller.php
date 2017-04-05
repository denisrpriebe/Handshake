<?php

namespace IrishTitan\Handshake\Core;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

abstract class Controller extends Action
{

    /**
     * The context instance.
     *
     * @var Context
     */
    protected $context;

    /**
     * @var PageFactory
     */
    protected $pageFactory;


    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->context = $context;
        $this->pageFactory = $pageFactory;

        parent::__construct($context);
    }

    /**
     * Perform the controller action.
     *
     * @return mixed
     */
    public function execute()
    {
        return $this->handle();
    }

    /**
     * Handle the controller action.
     *
     * @return mixed
     */
    abstract function handle();

}