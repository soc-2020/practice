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
Route::get('map/display/location/markers', 'MapController@display_location_markers');
Route::post('map/add/point', 'MapController@add_point');

Route::get('map/api/points/all', 'MapController@get_all_points');
Route::get('map/api/points/{ne_lat}/{ne_lng}/{sw_lat}/{sw_lng}', 'MapController@get_points');

// Form related experiments
Route::get('form/combo', 'FormController@combo');
Route::post('form/combo/action', 'FormController@combo_action');
