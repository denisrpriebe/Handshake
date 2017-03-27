<?php

namespace IrishTitan\Handshake\Contracts;

interface CommandContract
{

    /**
     * Perform the command.
     *
     * @return void
     */
    public function handle();

}