<?php

namespace IrishTitan\Handshake\Core;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

abstract class AdminController extends Action
{

    /**
     * The context instance.
     *
     * @var Context
     */
    protected $context;

    /**
     * The page factory instance.
     *
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * The page instance.
     *
     * @var
     */
    protected $page;

    /**
     * The title of the page.
     *
     * @var string
     */
    protected $title = 'Page Title';

    /**
     * The active menu.
     *
     * @var string
     */
    protected $activeMenu = '';

    /**
     * AdminController constructor.
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     */
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
        $this->createPage();

        $this->setActiveMenu();

        $this->setPageTitle();

        return $this->handle();
    }

    /**
     * Create the page object.
     *
     * @return void
     */
    private function createPage()
    {
        $this->page = $this->pageFactory->create();
    }

    /**
     * Set the title of the page.
     *
     * @param null $title
     * @return void
     */
    protected function setPageTitle($title = null)
    {
        $this->page->getConfig()->getTitle()->prepend(__($title ? $title : $this->title));
    }

    /**
     * Set the active admin nav tab.
     *
     * @param null $menu
     * @return void
     */
    protected function setActiveMenu($menu = null)
    {
        $this->page->setActiveMenu($menu ? $menu : $this->activeMenu);
    }

    /**
     * Handle the controller action.
     *
     * @return mixed
     */
    abstract function handle();

}