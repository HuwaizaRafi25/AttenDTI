<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
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

        $recentActivities = ActivityLog
            ::with('user')
            ->latest()
            ->take(5)
            ->get();

        $today = Carbon::today();
        $present = 75;
        $absent = 25;
        $totalStudents = 100;
        $activeStudents = 90;
        $inactiveStudents = 10;
        $totalDuesThisMonth = 7500000;
        $unpaidStudents = 15;
        $jobVacancies = 5;
        $latestJobs = [
            (object) ['title' => 'Frontend Developer Internship', 'created_at' => now()],
            (object) ['title' => 'Backend Developer Internship', 'created_at' => now()->subDay()],
            (object) ['title' => 'UI/UX Designer Internship', 'created_at' => now()->subDays(2)],
        ];
        return view('menus.overview', compact(
            'currentDate',
            'recentActivities',
            'present',
            'absent',
            'totalStudents',
            'activeStudents',
            'inactiveStudents',
            'totalDuesThisMonth',
            'unpaidStudents',
            'jobVacancies',
            'latestJobs'
        ));
    }

    public function getTodayAttendance()
    {
        $present = 75;
        $absent = 25;

        return response()->json([
            'present' => $present,
            'absent' => $absent,
        ]);
    }
}
