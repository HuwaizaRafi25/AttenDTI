<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Services\HolidayService;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        // $placements = Location::all();
        $currentDate = Carbon::now()->translatedFormat('l, j F Y');
        $year = now()->year;
        $holidays = HolidayService::getHolidays($year);
        // dd($holidays);

        return view('menus.overview', compact('currentDate', 'holidays'));
    }
}
