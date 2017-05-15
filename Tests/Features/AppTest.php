<?php

namespace IrishTitan\Handshake\Tests\Features;

use IrishTitan\Handshake\Core\App;
use IrishTitan\Handshake\Core\Entities\Product;
use IrishTitan\Handshake\Tests\TestCase;

class AppTest extends TestCase
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
    public function it_resolves_classes_into_objects()
    {
        $product = App::make(Product::class);

        $this->assertSame('IrishTitan\Handshake\Core\Entities\Product', get_class($product));
    }


}