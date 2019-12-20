<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Auth; 

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'email' => 'required',
            'password' => 'required|min:8',
            'typeofuser' => 'required',
        ]);
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'typeofuser' => $request->get('typeofuser'),
        ]);
        $user->save();
        return redirect('home');
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
        $user = User::find($id);
        return view('users.edit', compact('user'));
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
            'email'=>'required',
            'typeofuser'=>'required',
        ]);

        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->typeofuser = $request->get('typeofuser');
        $user->save();
        return redirect('admin/users')->with('success', 'Se actualizó el usuario.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('admin/users')->with('success', 'Usuario eliminado');
    }
    public function updateProfile(Request $request, $id, $name)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'img_profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        if($request->has('oldpassword')){
            if(Hash::check($request->get('oldpassword'), Auth::user()->password)){
                $user->password = Hash::make($request->get('newpassword'));;
            }
        }
        if($request->hasFile('img_profile')){
            $imageName = time().'.'.$request->img_profile->getClientOriginalExtension();  
            $request->img_profile->move(public_path('img'), $imageName);
            $user->img_profile = $imageName;    
        }
        $user->save();

        return redirect()->route('userProfile.index',['id' => $user->id, 'name' => $user->name])->with('success', 'Se guardaron los cambios.');
    }
}