<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;
use SebastiaanLuca\StubGenerator\StubGenerator;

class MakeCommand extends Command
{
    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:make:command';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Make a new Handshake command.';

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

        'command-name' => [
            'mode' => 'required',
            'description' => 'The command class name.'
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
        $command = $this->input->getArgument('command-name');

        (new StubGenerator(
            __DIR__ . '/../Stubs/Command.stub',
            'app/code/' . $namespace . '/' . $module . '/Commands/' . $command . '.php'
        ))->render([
            ':MODULE:' => $module,
            ':NAMESPACE:' => $namespace,
            ':COMMAND:' => $command
        ]);

        $this->addCommandToDi($namespace, $module, $command);

        $this->info($command . ' generated successfully.');
    }

    /**
     * Add the command to the module's di . xml file .
     *
     * @param $namespace
     * @param $module
     * @param $command
     */
    protected function addCommandToDi($namespace, $module, $command)
    {
        $xml = simplexml_load_file('app/code/' . $namespace . '/' . $module . '/etc/di.xml');

        $commandNode = $xml->type->arguments->argument
            ->addChild('item', $namespace . '\\' . $module . '\\Commands\\' . $command);

        $commandNode->addAttribute('name',
            str_replace('/', '_', strtolower($namespace . '/' . $module . '/Commands/' . $command)));
        
        $commandNode->addAttribute('prefix:xsi:type', 'object');

        $xml->asXML('app/code/' . $namespace . '/' . $module . '/etc/di.xml');
    }

}
