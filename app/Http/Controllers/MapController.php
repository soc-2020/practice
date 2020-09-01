<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;

class MapController extends Controller
{
    public function display_map() {
        $data['google_maps_api_key'] = env('GOOGLE_MAPS_API_KEY', '');

        return View('maps.display_map', $data);
    }

    public function client_location() {
        $data['google_maps_api_key'] = env('GOOGLE_MAPS_API_KEY', '');

        return View('maps.client_location', $data);
    }

    public function display_markers() {
        $data['google_maps_api_key'] = env('GOOGLE_MAPS_API_KEY', '');

        return View('maps.display_markers', $data);
    }

    public function display_location_markers() {
        $data['google_maps_api_key'] = env('GOOGLE_MAPS_API_KEY', '');

        return View('maps.display_location_markers', $data);
    }

    public function get_all_points() {
        $points = Point::select('id', 'description', 'lon', 'lat')->get();

        return response()->json($points);
    }

    public function get_points($ne_lat, $ne_lng, $sw_lat, $sw_lng)
    {
        $points = Point::select('id', 'description', 'lon', 'lat')->
        where('lon', '>', $sw_lng)->
        where('lon', '<', $ne_lng)->
        where('lat', '>', $sw_lat)->
        where('lat', '<', $ne_lat)->
        get();

        return response()->json($points);
    }

    public function add_point(Request $request) 
    {
        $point = new Point();
        $point->description = $request->get('description');
        $point->lon = $request->get('lon');
        $point->lat = $request->get('lat');
        $point->save();

        return redirect('map/display/location/markers');
    }
}
