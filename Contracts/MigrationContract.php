<?php

namespace IrishTitan\Handshake\Contracts;

interface MigrationContract
{

    /**
     * Run the database migration.
     *
     * @return mixed
     */
    public function up();

    /**
     * Reverse the database migration.
     *
     * @return mixed
     */
    public function down();

}