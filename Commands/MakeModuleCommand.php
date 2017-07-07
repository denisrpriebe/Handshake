<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;
use IrishTitan\Handshake\Facades\Directory;
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

        $this->output->writeln('<info>Module scaffolding created successfully.</info>');
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
        Directory::make('app/code/' . $namespace . '/' . $name . '/Listeners');
        Directory::make('app/code/' . $namespace . '/' . $name . '/Setup');
        Directory::make('app/code/' . $namespace . '/' . $name . '/Setup/Migrations');
        Directory::make('app/code/' . $namespace . '/' . $name . '/Setup/Seeds');
        Directory::make('app/code/' . $namespace . '/' . $name . '/view');
        Directory::make('app/code/' . $namespace . '/' . $name . '/view/adminhtml');
        Directory::make('app/code/' . $namespace . '/' . $name . '/view/frontend');
        Directory::make('app/code/' . $namespace . '/' . $name . '/Controller');
        Directory::make('app/code/' . $namespace . '/' . $name . '/Controller/Adminhtml');
        Directory::make('app/code/' . $namespace . '/' . $name . '/Block');
        Directory::make('app/code/' . $namespace . '/' . $name . '/Block/Adminhtml');
    }

    /**
     * Create the module starter files.
     *
     * @param $namespace
     * @param $name
     */
    private function createFiles($namespace, $name)
    {

        // Create module.xml
        (new StubGenerator(
            __DIR__ . '/../Stubs/module.stub',
            'app/code/' . $namespace . '/' . $name . '/etc/module.xml'
        ))->render([
            ':MODULE:' => $name,
            ':NAMESPACE:' => $namespace,
        ]);

        // Create di.xml
        (new StubGenerator(
            __DIR__ . '/../Stubs/di.stub',
            'app/code/' . $namespace . '/' . $name . '/etc/di.xml'
        ))->render([]);

        // Create events.xml
        (new StubGenerator(
            __DIR__ . '/../Stubs/events.stub',
            'app/code/' . $namespace . '/' . $name . '/etc/events.xml'
        ))->render([]);

        // Create registration.php
        (new StubGenerator(
            __DIR__ . '/../Stubs/registration.stub',
            'app/code/' . $namespace . '/' . $name . '/registration.php'
        ))->render([
            ':MODULE:' => $name,
            ':NAMESPACE:' => $namespace,
        ]);

        // Create InstallSchema.php
        (new StubGenerator(
            __DIR__ . '/../Stubs/InstallSchema.stub',
            'app/code/' . $namespace . '/' . $name . '/Setup/InstallSchema.php'
        ))->render([
            ':MODULE:' => $name,
            ':NAMESPACE:' => $namespace,
        ]);

    }

}
