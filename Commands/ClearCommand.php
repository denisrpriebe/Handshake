<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;
use IrishTitan\Handshake\Utilities\Directory;

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
    protected $description = 'Clear the Magento 2 cache and generation directories.';

    /**
     * Perform the command.
     *
     */
    public function handle()
    {
        Directory::remove('var/cache');
        Directory::remove('var/generation');

        Directory::make('var/cache');
        Directory::make('var/generation');

        $this->output->writeln('Magento 2 cache and generation cleared.');
    }

}
