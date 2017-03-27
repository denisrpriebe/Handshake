<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;
use IrishTitan\Handshake\Utilities\Directory;
use SebastiaanLuca\StubGenerator\StubGenerator;

class MakeModuleCommand extends Command
{

    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:make:module';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Scaffold a new Magento 2 module.';

    /**
     * The command arguments.
     *
     * @var array
     */
    protected $arguments = [

        'namespace' => [
            'mode' => 'required',
            'description' => 'The namespace of the module.'
        ],

        'name' => [
            'mode' => 'required',
            'description' => 'The name of the module.'
        ]

    ];

    /**
     * Perform the command.
     *
     */
    public function handle()
    {
        $namespace = $this->input->getArgument('namespace');
        $name = $this->input->getArgument('name');

        $this->createDirectories($namespace, $name);
        $this->createFiles($namespace, $name);

        $this->output->writeln('Module scaffolding created successfully.');
    }

    /**
     * Create the module directory structure.
     *
     * @param $namespace
     * @param $name
     */
    private function createDirectories($namespace, $name)
    {
        Directory::make('app/code/' . $namespace);
        Directory::make('app/code/' . $namespace . '/' . $name);
        Directory::make('app/code/' . $namespace . '/' . $name . '/Commands');
        Directory::make('app/code/' . $namespace . '/' . $name . '/etc');
        Directory::make('app/code/' . $namespace . '/' . $name . '/Models');
        Directory::make('app/code/' . $namespace . '/' . $name . '/Setup');
        Directory::make('app/code/' . $namespace . '/' . $name . '/Setup/Migrations');
        Directory::make('app/code/' . $namespace . '/' . $name . '/Setup/Seeds');
    }

    /**
     * Create the module starter files.
     *
     * @param $namespace
     * @param $name
     */
    private function createFiles($namespace, $name)
    {
        $stub = new StubGenerator(
            __DIR__ . '/../Stubs/module.stub',
            'app/code/' . $namespace . '/' . $name . '/etc/module.xml'
        );

        $stub->render([
            ':MODULE:' => $name,
            ':NAMESPACE:' => $namespace,
        ]);


        $stub = new StubGenerator(
            __DIR__ . '/../Stubs/registration.stub',
            'app/code/' . $namespace . '/' . $name . '/registration.php'
        );

        $stub->render([
            ':MODULE:' => $name,
            ':NAMESPACE:' => $namespace,
        ]);

    }

}
