<?php

namespace IrishTitan\Handshake\Tests\Features;

use IrishTitan\Handshake\Exceptions\ProductNotFoundException;
use IrishTitan\Handshake\Facades\Product;
use IrishTitan\Handshake\Tests\TestCase;

class ProductFacadeTest extends TestCase
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
    public function a_product_can_be_created_and_deleted()
    {
        $product = Product::create([
            'sku' => 'SKU0001',
            'name' => 'Example Product',
            'weight' => 25,
            'price' => 100,
            'qty' => 5
        ]);

        Product::findOrFail($product->id);

        $product->delete();

        $this->expectException(ProductNotFoundException::class);
        Product::findOrFail($product->id);
    }

    /** @test */
    public function images_can_be_added_to_a_product()
    {
        $product = Product::create([
            'sku' => 'SKU0001',
            'name' => 'Example Product',
            'weight' => 25,
            'price' => 100,
            'qty' => 5
        ]);

        $product->addImage('../../pub/media/phone.jpg');
        $product->addImage('../../pub/media/car.jpg');

        $this->assertTrue(true);
    }


}