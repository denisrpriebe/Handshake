<?php

namespace IrishTitan\Handshake\Core;

use Magento\Framework\Event\ManagerInterface as EventManager;

class Event
{
    /**
     * The EventManager instance.
     *
     * @var EventManager
     */
    protected $event;

    /**
     * Event constructor.
     *
     * @param EventManager $event
     */
    public function __construct(EventManager $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the event.
     *
     * @param $name
     * @param $data
     */
    public function fire($name, $data)
    {
        $this->event->dispatch($name, ['data' => $data]);
    }

}