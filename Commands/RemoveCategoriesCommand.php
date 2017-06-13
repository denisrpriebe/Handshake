<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;
use IrishTitan\Handshake\Facades\Category;

class RemoveCategoriesCommand extends Command
{

    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:remove:categories';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Remove all categories from the Magento 2 system.';

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
        $this->line('Removing categories...');

        $this->removeCategories();

        $this->line('Done.');
    }

    /**
     * Remove all categories from the Magento 2 system.
     *
     * @return void
     */
    protected function removeCategories()
    {
        Category::all()->each(function ($category) {

            try {

                $category->delete();
                $this->info($category->name . ' category deleted.');

            } catch (\Exception $exception) {

                $this->error('Could not delete ' . $category->name . '.');

            }

        });
    }

}