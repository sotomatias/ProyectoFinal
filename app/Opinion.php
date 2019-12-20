<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'place_id',
        'title',
        'opinion',
        'food',
        'service',
        'atmosphere',
        'prices'
    ];
    public function place(){
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
