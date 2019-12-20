<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
    protected $primaryKey = 'category_id';
    
    public function foods (){
        return $this->hasMany(Food::class, 'cat_id', 'category_id');
    }
}