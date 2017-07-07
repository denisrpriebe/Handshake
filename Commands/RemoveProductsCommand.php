<?php

namespace IrishTitan\Handshake\Commands;

use Exception;
use IrishTitan\Handshake\Core\Command;
use IrishTitan\Handshake\Facades\Product;

class RemoveProductsCommand extends Command
{

    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:remove:products';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Remove all products from the Magento 2 catalog.';

    /**
     * The arguments the command accepts.
     *
     * @var array
     */
    protected $arguments = [

    ];

    /**
     * Perform the command.
     *
     * @return void
     */
    public function handle()
    {
        $this->line('Removing all products...');

        $this->removeProducts();

        $this->line('Done.');

    }

    /**
     * Remove all products from the Magento 2 catalog.
     *
     * @return void
     */
    protected function removeProducts()
    {
        Product::all()->each(function ($product) {

            try {

                $product->delete();
                $this->info('Removed ' . $product->name);

            } catch (Exception $exception) {

                $this->error('Unable to remove ' . $product->name);

            }

        });
    }

}