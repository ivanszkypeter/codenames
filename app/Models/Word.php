<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Word.
 *
 * @property int $id
 * @property string $word
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Word whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Word whereWord($value)
 * @mixin \Eloquent
 */
class Word extends Model
{
    protected $table = 'words';
    public $timestamps = false;
}
