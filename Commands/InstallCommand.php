<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;
use IrishTitan\Handshake\Facades\Directory;
use SebastiaanLuca\StubGenerator\StubGenerator;

class InstallCommand extends Command
{

    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:install';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Install the Handshake module.';

    /**
     * Perform the command.
     *
     */
    public function handle()
    {
        Directory::make('app/handshake');

        $stub = new StubGenerator(
            __DIR__ . '/../Stubs/migrations.stub',
            'app/handshake/migrations.php'
        );

        $stub->render([]);

        $stub = new StubGenerator(
            __DIR__ . '/../Stubs/seeds.stub',
            'app/handshake/seeds.php'
        );

        $stub->render([]);

        $this->output->writeln('<info>Handshake installed successfully. Enjoy your development.</info>');
    }

}
