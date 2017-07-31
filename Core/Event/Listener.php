<?php

namespace IrishTitan\Handshake\Core\Event;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

abstract class Listener implements ObserverInterface
{
    /**
     * The data provided by the event.
     *
     * @var mixed
     */
    protected $data;

    /**
     * The Observer instance.
     *
     * @var
     */
    protected $observer;

    /**
     * Execute the listener.
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $this->observer = $observer;
        $this->data = $observer->getData('data');

        $this->handle();
    }

    /**
     * Handle the event.
     *
     * @return mixed
     */
    abstract protected function handle();

}