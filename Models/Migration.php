<?php

namespace IrishTitan\Handshake\Models;

use IrishTitan\Handshake\Core\Database\Model;

class Migration extends Model
{
    /**
     * The table this model represents.
     *
     * @var string
     */
    protected $table = 'handshake_migrations';

    /**
     * The fillable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'migration'
    ];
}