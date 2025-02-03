<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('menus.attendance');
    }

    public function requestAttendance($id)
    {
        return view('menus.attendance_act', compact('id'));
    }

    public function verifyLocation(Request $request){
        $userLat = $request->latitude;
        $userLng = $request->longitude;

        $location = Location::all();

        $matchedLocation = null;
        foreach ($location as $loc) {
            $distance = $this->haversineGreatCircleDistance($userLat, $userLng, $loc->latitude, $loc->longitude);
            if ($distance <= $loc->radius){
                $matchedLocation = $loc;
                break;
            }
        }

        if ($matchedLocation){
            return response()->json([
                'success' => true,
                'location' => $matchedLocation,
                'message' => 'Lokasi terverifikasi'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Lokasi tidak terverifikasi'
            ]);
        }
    }

    public function haversineGreatCircleDistance($lat1, $lng1, $lat2, $lng2, $earthRadius = 6371000)
    {
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lng1);
        $latTo   = deg2rad($lat2);
        $lonTo   = deg2rad($lng2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * $earthRadius;
    }

    public function attendanceReport()
    {
        return view('menus.attendance_report');
    }
}
