<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getPlacements(){
        $locations = User::all();
        // dd($locations);
        return response()->json($locations);
    }
}
