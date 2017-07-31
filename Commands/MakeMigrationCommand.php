<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;
use SebastiaanLuca\StubGenerator\StubGenerator;

class MakeMigrationCommand extends Command
{
    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:make:migration';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Make a new Handshake migration.';

    /**
     * The arguments the command accepts.
     *
     * @var array
     */
    protected $arguments = [

        'namespace' => [
            'mode' => 'required',
            'description' => 'The namespace of the module.'
        ],

        'module' => [
            'mode' => 'required',
            'description' => 'The name of the module.'
        ],

        'migration' => [
            'mode' => 'required',
            'description' => 'The migration name.'
        ]

    ];

    /**
     * Perform the command.
     *
     * @return void
     */
    public function handle()
    {
        $namespace = $this->input->getArgument('namespace');
        $module = $this->input->getArgument('module');
        $migration = $this->input->getArgument('migration');

        $stub = new StubGenerator(
            __DIR__ . '/../Stubs/Migration.stub',
            'app/code/' . $namespace . '/' . $module . '/Setup/Migrations/' . $migration . '.php'
        );

        $stub->render([
            ':NAMESPACE:' => $namespace,
            ':MODULE:' => $module,
            ':MIGRATION:' => $migration
        ]);

        $this->info($migration . ' migration created successfully.');
    }

}
