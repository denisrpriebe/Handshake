<?php

namespace IrishTitan\Handshake\Setup;

use IrishTitan\Handshake\Core\Database\MagentoSchemaInstaller;
use IrishTitan\Handshake\Setup\Migrations\CreateMigrationsTable;

class InstallSchema extends MagentoSchemaInstaller
{
    /**
     * The migrations to run.
     *
     * @var array
     */
    protected $migrations = [
        CreateMigrationsTable::class
    ];
}
