<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'id', 'name', 'description', 'neighborhood', 'lat', 'lng', 'availability', 'address', 'price', 'currency'
    ];

    public $timestamps = false;


    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }
    
    public function equipments()
    {
        return $this->belongsToMany(Equipment::class);
    }
    
    public function details()
    {
        return $this->belongsToMany(Detail::class)->withPivot('value');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
