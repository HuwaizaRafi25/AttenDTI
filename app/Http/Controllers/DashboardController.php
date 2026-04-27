<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Attendance;
use App\Models\Cash;
use App\Models\Jobs;
use App\Models\Location;
use App\Models\User;
use App\Services\HolidayService;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{

    public function index()
    {
        $currentDate = Carbon::now()->translatedFormat('l, j F Y');

        // Pastikan pakai timezone lokal agar isWeekend() akurat dengan jam server/Indonesia
        $today = Carbon::today('Asia/Jakarta');

        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Data dummy presensi & keuangan
        $present = Attendance::whereDate('created_at', $today)->where('attendance', 'present')->count();
        $absent = Attendance::whereDate('created_at', $today)->where('attendance', 'absent')->count();
        $totalStudents = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->count();
        $activeStudents = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->where('period_end_date', '>=', $today)->count();
        $inactiveStudents = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->where('period_end_date', '<', $today)->count();
        $totalDuesThisMonth = Cash::whereMonth('created_at', $today->month)->whereYear('created_at', $today->year)->count() * 5000; // Asumsi setiap pembayaran 100k
        $todayDues = now()->startOfMonth();
        $unpaidMonths = 0;

        $students = User::whereHas('roles', function ($q) {
            $q->where('name', 'student');
        })
            ->where('period_start_date', '<=', $todayDues) // pastikan sudah mulai
            ->get();

        foreach ($students as $student) {
            $start = Carbon::parse($student->period_start_date)->startOfMonth();

            // kalau sudah tidak aktif, stop di period_end_date
            $end = $student->period_end_date && $student->period_end_date < $todayDues
                ? Carbon::parse($student->period_end_date)->startOfMonth()
                : $todayDues;

            // ambil semua bulan yang sudah dibayar
            $paidMonths = Cash::where('user_id', $student->id)
                ->pluck('month_paid')
                ->unique()
                ->toArray();

            $period = CarbonPeriod::create($start, '1 month', $end);

            foreach ($period as $date) {
                $monthKey = $date->format('Y-m');

                if (!in_array($monthKey, $paidMonths)) {
                    $unpaidMonths++;
                }
            }
        }
        $jobVacancies = Jobs::where('is_active', true)->count();
        // $latestJobs = [
        //     (object) ['title' => 'Frontend Developer Internship', 'created_at' => now(), 'company' => 'Tech Company'],
        //     (object) ['title' => 'Backend Developer Internship', 'created_at' => now()->subDay(), 'company' => 'Tech Company'],
        //     (object) ['title' => 'UI/UX Designer Internship', 'created_at' => now()->subDays(2), 'company' => 'Tech Company'],
        // ];
        $latestJobs = Jobs::where('is_active', true)->latest()->take(3)->get();

        // Mengambil data libur dengan aman (menggunakan Cache dan Http timeout)
        $selectedMonth = $today->month;
        $selectedYear = $today->year;
        $cacheKey = "holidays_{$selectedMonth}_{$selectedYear}";

        $holidayData = Cache::remember($cacheKey, now()->addDays(7), function () use ($selectedMonth, $selectedYear) {
            try {
                $apiUrl = "https://dayoff-api-xi.vercel.app/api?month={$selectedMonth}&year={$selectedYear}";
                $response = Http::timeout(5)->get($apiUrl);

                return $response->successful() ? $response->json() : [];
            } catch (\Exception $e) {
                Log::error('API Libur Gagal: ' . $e->getMessage());
                return []; // Kembalikan array kosong jika error/timeout
            }
        });

        $holidays = [];
        if (is_array($holidayData)) {
            foreach ($holidayData as $holiday) {
                if (isset($holiday['tanggal'])) {
                    $holidays[] = Carbon::parse($holiday['tanggal'])->format('Y-m-d');
                }
            }
        }

        // --- LOGIKA PENENTU LIBUR UNTUK BLADE ---
        $tanggalSekarang = today()->timezone('Asia/Jakarta')->format('Y-m-d');

        $isHoliday = is_array($holidays) && in_array($tanggalSekarang, $holidays);
        $isWeekend = today()->timezone('Asia/Jakarta')->isWeekend();

        return view('menus.overview', compact(
            'currentDate',
            'recentActivities',
            'present',
            'absent',
            'totalStudents',
            'activeStudents',
            'inactiveStudents',
            'totalDuesThisMonth',
            'unpaidMonths',
            'jobVacancies',
            'latestJobs',
            'isWeekend', // Kirim langsung sebagai boolean
            'isHoliday'  // Kirim langsung sebagai boolean
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
