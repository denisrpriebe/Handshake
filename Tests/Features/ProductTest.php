<?php

namespace IrishTitan\Handshake\Tests\Features;

use IrishTitan\Handshake\Core\App;
use IrishTitan\Handshake\Core\Product;
use IrishTitan\Handshake\Exceptions\ProductNotFoundException;
use IrishTitan\Handshake\Tests\TestCase;

class ProductTest extends TestCase
{

    /**
     * The product instance.
     *
     * @var
     */
    protected $product;

    /**
     * Get our class ready for testing.
     *
     */
    protected function setUp()
    {
        parent::setUp();

        $this->product = App::make(Product::class);
    }

    /** @test */
    public function it_can_be_created_and_deleted()
    {
        $product = $this->product->create([
            'sku' => 'SKU0001',
            'name' => 'Example Product',
            'weight' => 25,
            'price' => 100,
            'qty' => 5
        ]);

        $this->product->findOrFail($product->id);

        $product->delete();

        $this->expectException(ProductNotFoundException::class);
        $this->product->findOrFail($product->id);
    }

    /** @test */
    public function it_can_add_an_image()
    {
        $product = $this->product->create([
            'sku' => 'SKU0001',
            'name' => 'Example Product',
            'weight' => 25,
            'price' => 100,
            'qty' => 5
        ]);

        $product->addImage('../../pub/media/landscape.jpg');
    }


}