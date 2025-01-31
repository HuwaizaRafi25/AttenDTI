<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getPlacements(){
        $locations = Location::all();
        return response()->json($locations);
    }
}
