<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('menus.location', compact('locations'));
    }
    public function getPlacements(){
        $locations = User::all();
        // dd($locations);
        return response()->json($locations);
    }
    public function getLocations()
    {
        $locations = Location::all();
        return response()->json($locations);
    }
}
