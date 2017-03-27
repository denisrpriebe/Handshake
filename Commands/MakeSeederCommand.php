<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;
use SebastiaanLuca\StubGenerator\StubGenerator;

class MakeSeederCommand extends Command
{

    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:make:seeder';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Make a new Handshake seeder.';

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

        'seeder' => [
            'mode' => 'required',
            'description' => 'The seeder name.'
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
        $seeder = $this->input->getArgument('seeder');

        $stub = new StubGenerator(
            __DIR__ . '/../Stubs/Seeder.stub',
            'app/code/' . $namespace . '/' . $module . '/Setup/Seeds/' . $seeder . '.php'
        );

        $stub->render([
            ':NAMESPACE:' => $namespace,
            ':MODULE:' => $module,
            ':SEEDER:' => $seeder
        ]);

        $this->output->writeln('<info>' . $seeder . ' seeder created successfully.</info>');
    }

}
