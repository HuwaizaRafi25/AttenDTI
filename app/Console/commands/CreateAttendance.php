<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class CreateAttendance extends Command
{
    protected $signature = 'attendance:create';
    protected $description = 'Create attendance records for users who have not checked in yet';

    public function handle()
    {
        // Ambil semua user dengan role 'user'
        $users = User::with('attendances', 'attendances.location', 'roles')->whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();

        foreach ($users as $user) {
            // Periksa apakah user sudah absen hari ini
            $hasAttended = Attendance::where('user_id', $user->id)
                ->whereDate('created_at', Carbon::today())
                ->exists();

            if (!$hasAttended) {
                // Jika belum absen, buat data absensi baru
                Attendance::create([
                    'user_id' => $user->id,
                    'attendance' => 'absent', // Atau sesuaikan dengan status default
                    'status' => 'rejected',
                ]);
            }
        }

        $this->info('Attendance records created successfully.');
    }
}
