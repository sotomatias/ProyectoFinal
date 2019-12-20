<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\Food;
use Auth;
use App\Category;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all();
        return view('foods.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($place_id)
    {
        $categories = Category::all();
        if(auth()->user()->typeofuser === 3){
        $places = Place::all();
        }
        if(auth()->user()->typeofuser === 2){
        $user = Auth::user()->id;
        $places = Place::all()->where('user_id','==',$user);
        }
        $place = Place::find($place_id);
        return view('foods.create')->withPlace($place)->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $place_id)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'cat_id' => 'required',
        ]);
        $food = new Food([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'cat_id' => $request->get('cat_id'),
            'place_id' => $place_id,
        ]);
        $food->save();
        return redirect()->route('places.edit',[$place_id])->with('success', 'Se guardó el plato.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($food_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($food_id)
    {
        $food = Food::find($food_id);
        $places = Place::all();
        $categories = Category::all();
        return view('foods.edit', compact('food'))->withFood($food)->withPlaces($places)->withCategories($categories);     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $food_id)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'cat_id' => 'required',
        ]);

        $food = Food::find($food_id);
        $food->name =  $request->get('name');
        $food->description = $request->get('description');
        $food->price = $request->get('price');
        $food->cat_id = $request->get('cat_id');
        $food->save();
        $placeid = $food->place_id;
        return redirect()->route('places.edit',[$placeid])->with('success', 'Se actualizó el plato');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($food_id)
    {
        $food = Food::find($food_id);
        $food->delete();
        $placeid = $food->place_id;
        return redirect()->route('places.edit',[$placeid])->with('success', 'Plato eliminado');
    }
}
