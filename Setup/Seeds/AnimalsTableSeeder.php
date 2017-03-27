<?php

namespace IrishTitan\Handshake\Setup\Seeds;

use IrishTitan\Handshake\Contracts\SeederContract;
use IrishTitan\Handshake\Core\Seeder;
use IrishTitan\Handshake\Models\Animal;

class AnimalsTableSeeder extends Seeder implements SeederContract
{

    /**
     * Run the seeder.
     *
     */
    public function run()
    {
        Animal::create([
            'name' => 'Cheetah'
        ]);
    }

}