<?php

namespace IrishTitan\Handshake\Setup\Migrations;

use Illuminate\Database\Schema\Blueprint;
use IrishTitan\Handshake\Core\Database\Migration;
use IrishTitan\Handshake\Core\Database\Schema;

class CreateMigrationsTable extends Migration
{
    /**
     * Run the migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handshake_migrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('migration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('handshake_migrations');
    }

}
