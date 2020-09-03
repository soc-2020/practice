<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;

class PointsController extends Controller
{
    public function points_list()
    {
        $data['points'] = Point::all();

        return View("maps.points_list", $data);
    }

    public function point_form($id) {
        $data['point'] = Point::find($id);

        return View("maps.point_form", $data);
    }

    public function point_update(Request $request)
    {
        $point = Point::find($request->get("id"));
        $point->description = $request->get("description");
        $point->lat = $request->get("lat");
        $point->lon = $request->get("lon");

        $point->save();

        return redirect('map/display/location/markers');
    }
}
