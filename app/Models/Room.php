<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Room.
 *
 * @property int $id
 * @property array $state
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Room whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Room whereState($value)
 * @mixin \Eloquent
 */
class Room extends Model
{
    protected $table = 'rooms';
    public $timestamps = false;

    protected $casts = [
        'state' => 'array',
    ];
}
