<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Google map related routes
Route::get('map/display', 'MapController@display_map');
Route::get('map/client/location', 'MapController@client_location');
Route::get('map/display/markers', 'MapController@display_markers');

Route::get('map/api/points/all', 'MapController@get_all_points');
