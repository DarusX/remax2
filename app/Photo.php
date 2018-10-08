<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'photo', 'property_id'
    ];

    public $timestamps = false;

    
}
