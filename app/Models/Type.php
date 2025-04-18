<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';
    protected $guarded = [ 
        'id',
        'created_at',
        'updated_at'
    ];
}
