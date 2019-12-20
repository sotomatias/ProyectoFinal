<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\PlaceCategory;
use App\Place;
class CustomSearchController extends Controller
{
  function index(){
    $placecategories = PlaceCategory::all();
    $places = Place::all();
    return view('custom_search')->withPlacecategories($placecategories)->withPlaces($places);
  }
  function action(Request $request){
    if($request->ajax())
    {
     $output = '';
     $query = $request->get('query');
     $category = $request->get('category');
     if($query != '' && $category != '0')
     {
      $data = DB::table('places')
        ->where('category_id', $category)
        ->where('name_place', 'like', '%'.$query.'%')
        ->orWhere('address_place', 'like', '%'.$query.'%')
        ->orderBy('place_id', 'desc')
        ->get();
     }
     elseif($query == '' && $category != '0')
     {
      $data = DB::table('places')
      ->join('images','images.place_id','=','places.place_id')
      ->select('places.*','images.filename')
      ->where('active_place', '=', '1')
        ->where('category_id', $category)
        ->orderBy('place_id', 'desc')
        ->get();
     }
     elseif($query != '' && $category == '0'){
      $data = DB::table('places')
      ->join('images','images.place_id','=','places.place_id')
      ->select('places.*','images.filename')
      ->where('active_place', '=', '1')
      ->where('name_place', 'like', '%'.$query.'%')
      ->orWhere('address_place', 'like', '%'.$query.'%')
      ->orderBy('place_id', 'desc')
      ->get();
    }
     elseif($query == '' && $category == '0')
     {
      $data = DB::table('places')
      ->join('images','images.place_id','=','places.place_id')
      ->select('places.*','images.filename')
      ->where('active_place', '=', '1')
      ->orderBy('place_id', 'desc')
      ->get();
     }
     $total_row = $data->count();
     if($total_row > 0)
     {
      foreach($data as $row)
      {
       $output .= '
       <div class="col-md-4 col-sm-6 portfolio-item">
          <a class="portfolio-link" data-toggle="modal" href="#'.$row->name_place.'" data-target="#'.$row->name_place.'">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="storage/uploads/'.$row->filename.'" style="width:400px; height:262.5px;">
          </a>
          <div class="portfolio-caption">
            <h4 class="text-uppercase">'.$row->name_place.'</h4>
            <p class="text-muted">'.$row->address_place.'</p>
          </div>
        </div>
       ';
      }
     }
     else
     {
      $output = '
      <h3>No se encontraron lugares.</h3>
      ';
     }
     $data = array(
      'table_data'  => $output,
      'total_data'  => $total_row
     );

     echo json_encode($data);
    }
   }
}

?>
