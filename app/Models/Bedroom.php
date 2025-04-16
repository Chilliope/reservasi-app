<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bedroom extends Model
{
    protected $table = 'bedrooms';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    function type() {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
