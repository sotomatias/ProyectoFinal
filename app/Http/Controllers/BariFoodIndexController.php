<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
Use App\Food;
Use App\Category;
Use App\PlaceCategory;
class BariFoodIndexController extends Controller
{
    public function BariFoodIndex(){
        $places = Place::all();
        $foods = Food::all();
        $categories = Category::all();
        return view('barifoodindex')->withPlaces($places)->withFoods($foods)->withCategories($categories);
    }
    public function BariFoodPlaces(){
        $places = Place::all();
        $foods = Food::all();
        $categories = Category::all();
        $placecategories = PlaceCategory::all();
        return view('user/places')->withPlaces($places)->withFoods($foods)->withCategories($categories)->withPlacecategories($placecategories);
    }
    public function BariFoodProfile(){
        return view('user/editprofile');
    }
}
