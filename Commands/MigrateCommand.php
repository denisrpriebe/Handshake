<?php

namespace IrishTitan\Handshake\Commands;

use Illuminate\Database\QueryException;
use IrishTitan\Handshake\Core\Command;
use IrishTitan\Handshake\Setup\Migrations\CreateAnimalsTable;

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
        $this->output->writeln('Running migrations...');

        $migrations = include __DIR__ . '/../config/migrations.php';

        foreach ($migrations as $migration) {

            try {

                $migration::migrate();
                $this->output->writeln('<info>Migrating ' . $migration::name() . '...</info>');

            } catch (QueryException $exception) {

                $this->output->writeln('<question>' . $migration::name() . 'Migration already exists.</question>');

            }

        }

        $this->output->writeln('Done.');
    }

}
