<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name_place',
        'address_place',
        'schedule_place',
        'user_id',
        'category_id',
        'latitud',
        'longitud',
        'phone_number',
        'website'
    ];
    protected $primaryKey = 'place_id';
    public function owner ()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function foods (){
        return $this->hasMany(Food::class, 'place_id', 'place_id');
    }
    public function placeCategory (){
        return $this->belongsTo(PlaceCategory::class, 'category_id', 'id');
    }
    public function opinions(){
        return $this->hasMany(Opinion::class, 'place_id', 'place_id');
    }
    public function images(){
        return $this->hasMany(Image::class, 'place_id', 'place_id');
    }
    public function activeImage(){
        return $this->belongsTo(Image::class, 'image_place', 'id');
    }
}
