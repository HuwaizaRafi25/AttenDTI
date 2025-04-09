<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CreateAttendance extends Command
{
    protected $signature = 'attendance:create';
    protected $description = 'Create attendance records for users who have not checked in yet';

    public function handle()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $allRelevantUsers = User::with('attendances', 'roles')
            ->whereNotNull('period_start_date')
            ->whereNotNull('period_end_date')
            ->whereNotNull('placement_id')
            ->whereHas('roles', fn($q) => $q->where('name', 'user'))
            ->get()
            ->filter(function ($user) use ($yesterday) {
                $start = Carbon::parse($user->period_start_date);
                $end = Carbon::parse($user->period_end_date);
                return $start->lte($yesterday) && $end->gte($start);
            });

        $activeTodayUsers = $allRelevantUsers->filter(function ($user) use ($today) {
            return $user->period_start_date <= $today && $user->period_end_date >= $today;
        });

        $minDate = $allRelevantUsers->min('period_start_date');
        $maxDate = $yesterday;
        $years = range(Carbon::parse($minDate)->year, $maxDate->year);

        $holidays = [];
        foreach ($years as $year) {
            $apiUrl = "https://dayoffapi.vercel.app/api?year={$year}";
            $response = Http::get($apiUrl);
            if ($response->successful()) {
                $holidayData = $response->json();
                foreach ($holidayData as $holiday) {
                    $holidayDate = Carbon::parse($holiday['tanggal'])->format('Y-m-d');
                    $holidays[] = $holidayDate;
                }
            }
        }

        foreach ($activeTodayUsers as $user) {
            $hasAttendedToday = Attendance::where('user_id', $user->id)
                ->whereDate('created_at', $today)
                ->exists();

            if (!$hasAttendedToday && !$today->isWeekend() && !in_array($today->toDateString(), $holidays)) {
                $attendance = new Attendance();
                $attendance->user_id = $user->id;
                $attendance->attendance = 'absent';
                $attendance->status = 'approved';
                $attendance->save();
            }
        }

        foreach ($allRelevantUsers as $user) {
            $startDate = Carbon::parse($user->period_start_date);
            $endDate = Carbon::parse($user->period_end_date)->lt($yesterday)
                ? Carbon::parse($user->period_end_date)
                : $yesterday;

            $currentDate = $startDate->copy();

            while ($currentDate->lte($endDate)) {
                $dateString = $currentDate->toDateString();

                if ($currentDate->isWeekend() || in_array($dateString, $holidays)) {
                    $currentDate->addDay();
                    continue;
                }

                $hasAttended = Attendance::where('user_id', $user->id)
                    ->whereDate('created_at', $dateString)
                    ->exists();

                if (!$hasAttended) {
                    $attendance = new Attendance();
                    $attendance->user_id = $user->id;
                    $attendance->attendance = 'present';
                    $attendance->status = 'approved';
                    $attendance->location_id = $user->placement_id;
                    $attendance->check_in = '07:00:00';
                    $attendance->created_at = $dateString;
                    $attendance->updated_at = $dateString;
                    $attendance->timestamps = false;
                    $attendance->save();
                }

                $currentDate->addDay();
            }
        }

        $this->info('Attendance records created successfully for all relevant users.');
    }
}
