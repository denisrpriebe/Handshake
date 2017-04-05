<?php

namespace IrishTitan\Handshake\Setup\Migrations;

use Illuminate\Database\Schema\Blueprint;
use IrishTitan\Handshake\Contracts\MigrationContract;
use IrishTitan\Handshake\Core\Migration;
use IrishTitan\Handshake\Core\Schema;

class CreateAnimalsTable extends Migration implements MigrationContract
{

    /**
     * Run the migration.
     *
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     *
     */
    public function down()
    {
        Schema::drop('animals');
    }

}