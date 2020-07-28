<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function display_map() {
        $data['google_maps_api_key'] = env('GOOGLE_MAPS_API_KEY', '');

        return View('maps.display_map', $data);
    }
}
