<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceCategory extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
    public function placesWithCategory (){
        return $this->hasMany(Place::class);
    }
}
