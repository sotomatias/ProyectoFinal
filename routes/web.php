<?php
             ////////// Rutas del modelo "Place" ////////// 

Route::get('/admin/places','PlaceController@index')->name('places.index')->middleware('auth','Owner');
Route::post('/admin/places','PlaceController@store')->name('places.store')->middleware('auth','Admin');
Route::get('/admin/places/create','PlaceController@create')->name('places.create')->middleware('auth','Admin');
Route::get('/admin/places/{place_id}','PlaceController@show')->name('places.show')->middleware('auth','Owner');
Route::get('/admin/places/{place_id}/edit','PlaceController@edit')->name('places.edit')->middleware('auth','Owner');
Route::patch('/admin/places/{place_id}','PlaceController@update')->name('places.update')->middleware('auth','Owner');
Route::delete('/admin/places/{place_id}','PlaceController@destroy')->name('places.destroy')->middleware('auth','Admin');
Route::post('/admin/{place_id}/addimages','PlaceController@addImage')->name('places.addimage')->middleware('auth','Owner');
Route::delete('/admin/deleteimage/{id}','PlaceController@deleteImage')->name('places.deleteimage')->middleware('auth','Owner');
Route::patch('/admin/activeimage/{id}','PlaceController@activeImage')->name('places.activeimage')->middleware('auth','Owner');
            ////////// Rutas del modelo "Food" //////////

Route::get('/admin/foods','FoodController@index')->name('foodcrud')->middleware('auth','Owner');
Route::post('/admin/places/{place_id}','FoodController@store')->name('foods.store')->middleware('auth','Owner');
Route::get('/admin/{place_id}/foods/create','FoodController@create')->name('foods.create')->middleware('auth','Owner');
Route::get('/admin/foods/{food_id}','FoodController@show')->name('foods.show')->middleware('auth','Owner');
Route::get('/admin/foods/{food_id}/edit','FoodController@edit')->name('foods.edit')->middleware('auth','Owner');
Route::patch('/admin/foods/{food_id}','FoodController@update')->name('foods.update')->middleware('auth','Owner');
Route::delete('/admin/foods/{food_id}','FoodController@destroy')->name('foods.destroy')->middleware('auth','Owner');

            ////////// Rutas del modelo "Categorías" //////////

Route::middleware(['auth','Admin'])->group(function(){
    Route::resource('/admin/categories','CategoryController');
});

        ////////// Rutas del modelo "Categorías de lugares" //////////

Route::middleware(['auth','Admin'])->group(function(){
    Route::resource('/admin/placecategories','PlaceCategoryController');
});

            ////////// Rutas del modelo "Usuarios" //////////
                //////// Para el administrador ////////

Route::middleware(['auth', 'Admin'])->group(function(){
    Route::resource('/admin/users','UserController');
});

                //////// Para los usuarios ////////

Route::patch('/profile/{id}/{name}','UserController@updateProfile')->name('userProfile.edit')->middleware('auth','Profile');
Route::get('/profile/{id}/{name}','BariFoodIndexController@BariFoodProfile')->name('userProfile.index')->middleware('auth','Profile');

                ////////// Rutas del modelo "Opiniones" //////////

Route::get('/admin/opinions','OpinionController@index')->name('opinions.index')->middleware('auth','Admin');
Route::post('/admin/{place_id}/opinions/','OpinionController@store')->name('opinions.store')->middleware('auth');
Route::get('/admin/opinions/{id}','OpinionController@show')->name('opinions.show')->middleware('auth','Admin');
Route::delete('/admin/opinions/{id}','OpinionController@destroy')->name('opinions.destroy')->middleware('auth','Admin');

                ////////// Rutas del index: /home y /places //////////
Route::get('/places', 'BariFoodIndexController@BariFoodPlaces')->name('indexPlaces');
Route::get('/home', 'BariFoodIndexController@BariFoodIndex')->name('home');
Route::get('/', 'BariFoodIndexController@BariFoodIndex')->name('home');

                ////////// Ruta del panel de administrador //////////

Route::middleware(['auth','Owner'])->group(function(){
    Route::resource('/admin','AdminController', [
        'names' => [
            'index' => 'admin',
        ]
    ]);
});


                    ////////// rutas del Auth //////////

Auth::routes();
                ////////// Ruta del live search - Lugares //////////
Route::get('/customsearch/action','CustomSearchController@action')->name('customsearch.action');
