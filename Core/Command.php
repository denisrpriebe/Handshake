<?php

namespace IrishTitan\Handshake\Core;

use IrishTitan\Handshake\Contracts\CommandContract;
use IrishTitan\Handshake\Exceptions\InvalidModeException;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface as Input;
use Symfony\Component\Console\Output\OutputInterface as Output;

class Command extends SymfonyCommand implements CommandContract
{

    /**
     * The name and signature of the command.
     *
     * @var
     */
    protected $signature;

    /**
     * The console command description.
     *
     * @var
     */
    protected $description;

    /**
     * The console input instance.
     *
     * @var
     */
    protected $input;

    /**
     * The console output instance.
     *
     * @var
     */
    protected $output;

    /**
     * The arguments the command accepts.
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * Set the command details.
     *
     * @return void
     */
    protected function configure()
    {

        foreach ($this->arguments as $name => $argument) {
            $this->addArgument($name, $this->mode($argument), $argument['description']);
        }

        $this->setName($this->signature)
            ->setDescription($this->description);
    }

    /**
     * Execute the command.
     *
     * @param Input $input
     * @param Output $output
     * @return void
     */
    protected function execute(Input $input, Output $output)
    {
        $this->input = $input;
        $this->output = $output;

        $this->handle();
    }

    /**
     * Get the command argument mode.
     *
     * @param $argument
     * @return int
     * @throws InvalidModeException
     */
    private function mode($argument)
    {

        if ($argument['mode'] === 'required') {
            return InputArgument::REQUIRED;
        }

        if ($argument['mode'] === 'optional') {
            return InputArgument::OPTIONAL;
        }

        throw new InvalidModeException;
    }

    /**
     * Perform the command.
     *
     */
    public function handle()
    {

    }

}