<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    protected $table = 'racks';
    protected $guarded = [ 
        'id',
        'created_at',
        'updated_at'
    ];
}
