<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlaceCategory;

class PlaceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $placeCategories = PlaceCategory::all();
        return view('placecategories.index', compact('placeCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('placecategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $placeCategory = new PlaceCategory([
            'name' => $request->get('name'),
        ]);

        $placeCategory->save();

        return redirect('admin/placecategories')->with('success', 'Se guardó la categoría de lugar.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $placeCategory = PlaceCategory::find($id);
        return view('placecategories.edit', compact('placeCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
        ]);

        $placeCategory = PlaceCategory::find($id);
        $placeCategory->name =  $request->get('name');
        $placeCategory->save();

        return redirect('admin/placecategories')->with('success', 'Se actualizó la categoría.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $placeCategory = PlaceCategory::find($id);
        $placeCategory->delete();

        return redirect('admin/placecategories')->with('success', 'Categoría eliminada');
    }
}
