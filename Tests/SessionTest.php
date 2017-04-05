<?php

namespace IrishTitan\Handshake\Tests;

use IrishTitan\Handshake\Facades\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{

    /** @test */
    public function it_stores_and_retrieves_values()
    {
        Session::set('my-value', 1234);

        $this->assertSame(1234, Session::get('my-value'));
    }

}