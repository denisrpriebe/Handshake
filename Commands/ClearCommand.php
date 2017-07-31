<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;
use IrishTitan\Handshake\Facades\Directory;

class ClearCommand extends Command
{
    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:clear';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Clear the Magento 2 cache, page cache, generation and di directories.';

    /**
     * Perform the command.
     *
     */
    public function handle()
    {
        Directory::remove('var/cache');
        Directory::remove('var/page_cache');
        Directory::remove('var/generation');
        Directory::remove('var/di');

        Directory::make('var/cache');
        Directory::make('var/page_cache');
        Directory::make('var/generation');
        Directory::make('var/di');

        $this->info('Magento 2 cache, page cache, generation and di cleared.');
    }

}
