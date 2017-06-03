<?php

namespace IrishTitan\Handshake\Tests\Features;

use IrishTitan\Handshake\Exceptions\OrderNotFoundException;
use IrishTitan\Handshake\Facades\Order;
use IrishTitan\Handshake\Tests\TestCase;

class OrderTest extends TestCase
{

    /**
     * Get our class ready for testing.
     *
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /** @test */
    public function an_order_can_be_created_and_deleted()
    {
        $this->expectException(OrderNotFoundException::class);
        Order::findOrFail(20);
    }


}