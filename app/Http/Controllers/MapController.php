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

    public function get_all_points() {
        $points = Point::select('id', 'description', 'lon', 'lat')->get();

        return response()->json($points);
    }
}
