<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class FormController extends Controller
{
    public function combo() 
    {
        $data['countries'] = Country::orderBy('name')->get();

        return View('forms.combo', $data);
    }

    public function combo_action(Request $request) 
    {
        $country_id = $request->get('country');
        $data['country'] = Country::find($country_id);

        return View('forms.combo_action', $data);
    }
}
