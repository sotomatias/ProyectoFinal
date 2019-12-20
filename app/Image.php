<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'place_id',
        'filename',
        'active_place',
    ];
    public function place(){
        return $this->belongsTo(Place::class, 'place_id', 'place_id');
    }
}
