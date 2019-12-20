<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;
use App\User;
use Auth;
use App\Category;
use App\PlaceCategory;
use App\Food;
use App\Opinion;
use App\Image;
use DB;
use Storage;
class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->typeofuser === 3){
            $places = Place::all();
        }
        if(auth()->user()->typeofuser === 2){
            $user = Auth::user()->id;
            $places = Place::all()->where('user_id','==',$user);
        }
        return view('places.index')->withPlaces($places);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = PlaceCategory::all();
        $users = User::all()->where('typeofuser','>=','2');
        return view('places.create')->withUsers($users)->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $defaultImage = 'restaurante-jaizkibel-1.jpg';
        $request->validate([
            'name_place'=>'required',
            'address_place'=>'required',
            'schedule_place'=>'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'phone_number' => 'required',
            'website' => 'required'
				]);
        $place = new Place([
            'name_place' => $request->get('name_place'),
            'address_place' => $request->get('address_place'),
            'schedule_place' => $request->get('schedule_place'),
            'user_id' => $request->get('user_id'),
            'category_id' => $request->get('category_id'),
            'latitud' => $request->get('latitud'),
            'longitud' => $request->get('longitud'),
            'phone_number' => $request->get('phone_number'),
            'website' => $request->get('website')
        ]);
            $place->save();
        $last_placeid = DB::table('places')
        ->orderBy('place_id','desc')
        ->take(1)
        ->value('place_id');
        $data = json_encode($last_placeid);
        $image = new Image([
            'filename' => $defaultImage,
            'place_id' => $data,
            'active_place' => '1',
        ]);
        $image->save();
            // if($images = $request->file('image_place')){
            //     foreach($images as $file){
            //         $imagesName = $file->getClientOriginalName();
			// 			$imageName = time().$imagesName.'.'.$file->getClientOriginalExtension();  
			// 			$file->move(public_path('img'), $imageName);
			// 			$last_imageid = DB::table('images')
			// 			->where('place_id', $data)
			// 			->count();
			// 			if($last_imageid != 0){
            //             $active = '0';
			// 			$image = new Image([
            //                 'filename' => $imageName,
            //                 'place_id' => $data,
            //                 'active_place' => $active,
			// 			]);
			// 			}
			// 			else{
			// 				$active = '1';
			// 				$image = new Image([
			// 				'filename' => $imageName,
            //                 'place_id' => $data,
            //                 'active_place' => $active,
			// 			]);
			// 			}
			// 			$image->save();
			// 		}
			// 	}
		return redirect('admin/places')->with('success', 'Se guardó el lugar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($place_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($place_id)
    {
        $place = Place::find($place_id);
        if($place->user_id == Auth::user()->id || Auth::user()->typeofuser == 3){
        $users = User::all()->where('typeofuser','>=','2');
        $type = Auth::user()->typeofuser;
        $placeCategories = PlaceCategory::all();
        $category = Category::all();
        $foods = Food::all()->where('place_id','==',$place_id);
        $opinions = Opinion::all()->where('place_id', '==', $place_id);
        return view('places.edit', compact('place'))->withUsers($users)->withType($type)->withplaceCategories($placeCategories)->withCategory($category)->withFoods($foods)->withOpinions($opinions);
    }
    else{
        return redirect('admin');
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $place_id)
    {
        $request->validate([
            'name_place'=>'required',
            'address_place'=>'required',
            'schedule_place'=>'required'
        ]);
        if ($request->hasFile('file')) {
            $filename = $request->file;
            // $this->validate($request,[
            // 	'file' => 'required',
            // 	'file.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            // 	]);
            foreach ($filename as $n => $file) {
                $k= $n+1;
                $filenames = $filename[$n]->getClientOriginalName();
                 if($filenames == $request->activeImage){
                 $active_place = '1';
                 }
                 else {
                 $active_place = '0';
                 }
                $image = new Image([
                    'place_id' => $place_id,
                    'filename' => $filenames,
                    'active_place' => $active_place,
                ]);
                $file->storeAs('public/uploads',$filenames);
                $image->save();
            }
        }
        $place = Place::find($place_id);
        $place->name_place =  $request->get('name_place');
        $place->address_place = $request->get('address_place');
        $place->schedule_place = $request->get('schedule_place');
        if($request->has(['user_id', 'category_id'])){
        $place->user_id = $request->get('user_id');
        $place->category_id = $request->get('category_id');
        }
        $place->save();

        return redirect('admin/places')->with('success', 'Se actualizó el lugar');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($place_id)
    {
        $place = Place::find($place_id);
        $place->delete();

        return redirect('admin/places')->with('success', 'Lugar eliminado');
    }
    public function deleteImage($id)
    {
        $defaultImage = 'restaurante-jaizkibel-1.jpg';
        $image = Image::find($id);
        $filename = $image->filename;
        if($filename != $defaultImage){
        unlink(public_path('storage/uploads/'.$filename));
        }
        $image->delete();
    }
    public function activeImage($id)
    {
        $remove = '0';
        $add = '1';
        $image = Image::find($id);
        $placeid = $image->place_id;    
        $last_placeid = DB::table('images')
        ->where('place_id',$placeid)
        ->where('active_place', '1')
        ->take(1)
        ->value('id');
        $data = json_encode($last_placeid);
        $removeActive = Image::find($data);
        if(!empty($removeActive)){
            $removeActive->active_place = $remove;
            $removeActive->save();
            }
        $addActive = Image::find($id);
        $addActive->active_place = $add;
        $addActive->save();
    }
    public function addImage(Request $request, $place_id){
        if ($request->hasFile('file')) {
            $filename = $request->file;
            // $this->validate($request,[
            // 	'file' => 'required',
            // 	'file.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            // 	]);
            foreach ($filename as $n => $file) {
                $k= $n+1;
                $filenames = $filename[$n]->getClientOriginalName();
                $imageName = time().'.'.$filenames;
                 if($filenames == $request->activeImage){
                 $active_place = '1';
                 $remove = '0';
                    $last_placeid = DB::table('images')
                    ->where('place_id',$place_id)
                    ->where('active_place', '1')
                    ->take(1)
                    ->value('id');
                    $data = json_encode($last_placeid);
                    $removeActive = Image::find($data);
                    if(!empty($removeActive)){
                    $removeActive->active_place = $remove;
                    $removeActive->save();
                    }
                }
                 else {
                 $active_place = '0';
                 }
                $image = new Image([
                    'place_id' => $place_id,
                    'filename' => $imageName,
                    'active_place' => $active_place,
                ]);
                $file->storeAs('public/uploads',$imageName);
                $image->save();
            }
        }
    }
}
