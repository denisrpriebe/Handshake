<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;
use IrishTitan\Handshake\Facades\Directory;

class MigrateCommand extends Command
{
    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:migrate';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Run the handshake migrations.';

    /**
     * Perform the command.
     *
     */
    public function handle()
    {
        $this->info('Running migrations...');

        $codeDirectory = Directory::app() . '/code';
        $modules = Directory::directories($codeDirectory);

        var_dump($modules);

        $this->info('Done.');
    }

}
