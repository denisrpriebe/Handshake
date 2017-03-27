<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;

class RollbackCommand extends Command
{

    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:migrate:rollback';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Reverse the handshake migrations.';

    /**
     * Perform the command.
     *
     */
    public function handle()
    {
        $this->output->writeln('Reversing migrations...');

        $migrations = include __DIR__ . '/../config/migrations.php';

        foreach ($migrations as $migration) {
            $migration::reverse();
            $this->output->writeln('<info>Reversing ' . $migration::name() . '.</info>');
        }

        $this->output->writeln('Done.');
    }

}
