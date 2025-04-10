<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use App\Models\Cash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Cashcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));
        $sort = $request->input('sort', 'full_name');
        $direction = $request->input('direction', 'asc');

        $minYear = User::min(DB::raw('YEAR(period_start_date)'));
        $maxYear = User::max(DB::raw('YEAR(period_end_date)'));

        $minYear = $minYear ?: date('Y');
        $maxYear = $maxYear ?: date('Y');

        $years = range($minYear, $maxYear);

        // Ambil data user dengan seluruh relasi cash (tanpa filter tahun)
        $users = User::with('cash')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })
            ->orderBy($sort, $direction)
            ->get();

        // Persiapkan properti payment_statuses untuk masing-masing user (seluruh periode aktif)
        foreach ($users as $user) {
            $statuses = [];
            // Buat DatePeriod agar mencakup seluruh bulan mulai dari period_start_date sampai period_end_date
            $startDate = new DateTime($user->period_start_date);
            // Tambahkan 1 bulan untuk menyertakan bulan terakhir
            $endDate = (new DateTime($user->period_end_date))->modify('+1 month');
            $interval = new DateInterval('P1M');
            $period = new DatePeriod($startDate, $interval, $endDate);

            foreach ($period as $date) {
                $month = $date->format('Y-m');
                // Cari data pembayaran untuk bulan tersebut
                $cashEntry = $user->cash->firstWhere('month_paid', $month);
                // Jika ada data dan status true, maka true; jika tidak ada atau false/null, maka false
                $statuses[$month] = $cashEntry ? $cashEntry->status : false;
            }
            // Simpan array lengkap ke properti payment_statuses untuk digunakan di modal
            $user->payment_statuses = $statuses;
        }

        return view('menus.cash', compact('users', 'selectedYear', 'years'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $userId = $request->input('user_id');
        $statuses = $request->input('statuses', []);

        // Ambil semua data Cash yang sudah ada untuk user terkait
        $existingCash = Cash::where('user_id', $userId)->get()->keyBy('month_paid');

        foreach ($statuses as $month => $status) {
            // Pastikan status diinterpretasikan sebagai boolean
            $status = ($status === 'true' || $status === true) ? true : false;
            $cash = $existingCash->get($month);

            if ($cash) {
                // Update data yang sudah ada
                $cash->status = $status;
                $cash->updated_at = now();
                $cash->save();
            } else {
                // Jika data belum ada dan status bernilai true, buat data baru
                if ($status) {
                    Cash::create([
                        'user_id'    => $userId,
                        'status'     => true,
                        'month_paid' => $month,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return response()->json(['success' => true]);
    }

    // Method create, store, show, edit, destroy dapat diisi sesuai kebutuhan
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
