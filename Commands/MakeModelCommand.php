<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;
use SebastiaanLuca\StubGenerator\StubGenerator;

class MakeModelCommand extends Command
{

    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:make:model';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Make a new Handshake model.';

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

        'model' => [
            'mode' => 'required',
            'description' => 'The model to generate.'
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
        $model = $this->input->getArgument('model');

        $stub = new StubGenerator(
            __DIR__ . '/../Stubs/Model.stub',
            'app/code/' . $namespace . '/' . $module . '/Models/' . $model . '.php'
        );

        $stub->render([
            ':MODULE:' => $module,
            ':NAMESPACE:' => $namespace,
            ':MODEL:' => $model
        ]);

        $this->output->writeln($model . ' model generated successfully.');
    }

}
