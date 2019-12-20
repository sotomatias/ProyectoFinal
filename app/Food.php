<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'price',
        'cat_id',
        'place_id'
    ];
    protected $primaryKey = 'food_id';
    public function place(){
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }
}
