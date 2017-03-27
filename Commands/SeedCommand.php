<?php

namespace IrishTitan\Handshake\Commands;

use IrishTitan\Handshake\Core\Command;

class SeedCommand extends Command
{

    /**
     * The command syntax.
     *
     * @var string
     */
    protected $signature = 'handshake:db:seed';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with handshake.';

    /**
     * Perform the command.
     *
     */
    public function handle()
    {
        $this->output->writeln('Seeding the database...');

        $seeders = include 'app/handshake/seeds.php';

        foreach ($seeders as $seeder) {
            $seeder::seed();
            $this->output->writeln('<info>Running ' . $seeder::name() . '.</info>');
        }

        $this->output->writeln('Done.');
    }

}
