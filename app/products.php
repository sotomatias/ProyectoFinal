<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class products extends Model
{
    protected $fillable = [
       'featuredImage15','featuredImage1','featuredImage2','featuredImage3','featuredImage4',
       'featuredImage5','featuredImage6','featuredImage7','featuredImage8','featuredImage9',
       'featuredImage10','featuredImage11','featuredImage12','featuredImage13','featuredImage14',
    ];protected $table = 'products'; //here you specifiy whatever  table you want
}