<?php

namespace IrishTitan\Handshake\Listeners;

use IrishTitan\Handshake\Core\Event\Listener;

class SendEmail extends Listener
{
    /**
     * Handle the event.
     *
     * @return void
     */
    protected function handle()
    {
        $email = $this->data['email'];

        echo $email;
    }

}