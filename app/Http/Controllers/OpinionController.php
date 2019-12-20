<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\User;
use App\Opinion;
use Auth;

class OpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opinions = Opinion::all();
        return view('opinions.index', compact('opinions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Place::all();
        $users = User::all();
        return view('opinions.create')->withUsers($users)->withPlaces($places);
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
            'title' => 'required',
            'opinion'=>'required',
            'food'=>'required',
            'service'=>'required',
            'atmosphere'=>'required',
            'prices'=>'required'
        ]);
        $opinion = new Opinion([
            'user_id' => Auth::user()->id,
            'place_id' => $place_id,
            'title' => $request->get('title'),
            'opinion' => $request->get('opinion'),
            'food' => $request->get('food'),
            'service' => $request->get('service'),
            'atmosphere' => $request->get('atmosphere'),
            'prices' => $request->get('prices'),
        ]);
        $opinion->save();
        return redirect('/')->with('success', 'Se guardó la opinión.');
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
        $opinion = Opinion::find($id);
        $places = Place::all();
        $users = User::all();
        return view('opinions.edit', compact('opinion'))->withPlaces($places)->withUsers($users);
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
            'user_id'=>'required',
            'place_id'=>'required',
            'opinion'=>'required',
        ]);

        $opinion = Opinion::find($id);
        $opinion->user_id =  $request->get('user_id');
        $opinion->place_id = $request->get('place_id');
        $opinion->opinion = $request->get('opinion');
        $opinion->save();

        return redirect('admin/opinions')->with('opinionsuccess', 'Se actualizó la opinión.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $opinion = Opinion::find($id);
        $opinion->delete();
        $placeid = $opinion->place_id;
        return redirect()->route('places.edit',[$placeid])->with('opinionsuccess', 'Opinión Eliminada');
    }
}
