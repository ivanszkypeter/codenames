<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    public $timestamps = false;

    protected $casts = [
        'state' => 'array',
    ];
}
