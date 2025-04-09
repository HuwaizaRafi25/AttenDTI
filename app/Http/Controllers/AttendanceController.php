<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\FaceUser;
use App\Models\Location;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\FacadesLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', date('m'));
        $selectedYear = $request->input('year', date('Y'));

        $startDate = Carbon::create($selectedYear, $selectedMonth)->startOfMonth();
        $endDate = Carbon::create($selectedYear, $selectedMonth)->endOfMonth();

        $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear);

        $dates = [];
        for ($day = 1; $day <= $numberOfDays; $day++) {
            $dates[] = $selectedYear . '-' . $selectedMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        }

        $firstDate = $dates[0];
        $lastDate = end($dates);

        $apiUrl = "https://dayoffapi.vercel.app/api?month={$selectedMonth}&year={$selectedYear}";
        // $response = file_get_contents($apiUrl);
        // $holidayData = json_decode($response, true);

        $holidays = [];
        $holidaysNames = [];
        // if ($holidayData) {
        //     foreach ($holidayData as $holiday) {
        //         $holidayDate = Carbon::parse($holiday['tanggal'])->format('Y-m-d');
        //         $holidays[] = $holidayDate;
        //         $holidaysNames[$holidayDate] = $holiday['keterangan'];
        //     }
        // }

        $search = $request['search'];

        $users = User::with([
            'attendances' => function ($query) use ($startDate, $endDate, $holidays) {
                $query->whereDate('created_at', '>=', $startDate->toDateString())
                    ->whereDate('created_at', '<=', $endDate->toDateString())
                    // dimana created at nya bukan hari libur weekend atau cuti
                    ->whereNotIn(DB::raw('DATE(created_at)'), $holidays)
                    // Exclude weekend: 6 = Saturday, 0 = Sunday
                    ->whereRaw('WEEKDAY(created_at) NOT IN (5, 6)')
                    ->with('location');
            },
            'roles',
            'approver'
        ])
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })
            ->whereNotNull('period_start_date')->whereNotNull('period_end_date')->whereNotNull('placement_id')->whereNotNull('institution')
            ->whereDate('period_end_date', '>=', $firstDate)
            ->whereDate('period_start_date', '<=', $lastDate)
            ->where(function ($query) use ($search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('institution', 'like', "%{$search}%");
            });

        $sortColumn = $request->input('sort', 'full_name');
        $sortDirection = $request->input('direction', 'desc');
        $users->orderBy($sortColumn, $sortDirection);

        $users = $users->get();

        $locations = Location::all();

        $dateData = DB::table('attendances')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month')
            ->distinct()
            ->get()
            ->toArray();


        $months = collect($dateData)
            ->map(function ($item) {
                return [
                    'name' => Carbon::create()->month($item->month)->format('F'),
                    'number' => $item->month,
                ];
            })
            ->unique('number')
            ->sortBy('number')
            ->pluck('name')
            ->values()
            ->all();

        $years = collect($dateData)
            ->pluck('year')
            ->unique()
            ->sortDesc()
            ->values()
            ->all();

        return view('menus.attendance', compact('users', 'dates', 'months', 'years', 'selectedMonth', 'selectedYear', 'holidays', 'holidaysNames', 'locations', 'search'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = User::where('itb_account', 'like', '%' . $searchTerm . '%')
            ->orWhere('name', 'like', '%' . $searchTerm . '%')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })
            ->get();

        return response()->json($users);
    }

    public function form()
    {
        $locations = Location::all();
        return view('menus.modals.attendance.view_attendance_form', compact('locations'));
    }

    public function store(Request $request)
    {
        try {
            $locationId = $request->location_id;
            $userId = Auth::user()->id;

            $attendance = Attendance::create([
                'user_id' => $userId,
                'location_id' => $locationId,
                'status' => 'approved',
                'attendance' => 'present',
                'check_in' => now(),
            ]);

            return response()->json([
                'success' => true,
                'attendance' => $attendance
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to store attendance: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function attendUser(Request $request)
    {
        try {
            $request->validate([
                'attendanceType' => ['required', 'in:present,absent,sick,permit,late'],
                'time' => ['required', 'date_format:H:i'],
                'userId' => ['required', 'exists:users,id'],
                'locationId' => ['required', 'exists:locations,id'],
                'note' => ['max:255'],
            ]);

            $attendance = Attendance::where('user_id', $request->userId)
                ->whereDate('created_at', Carbon::today())
                ->first();
            if (!$attendance) {
                $attendance = new Attendance();
            }
            $attendance->user_id = $request->userId;
            $attendance->attendance = $request->attendanceType;
            $attendance->status = 'approved';
            $attendance->approver_id = Auth::user()->id;
            if ($request->attendanceType == 'present' || $request->attendanceType == 'late') {
                $attendance->check_in = $request->time;
                $attendance->location_id = $request->location_id;
            } else if ($request->attendanceType == 'sick' || $request->attendanceType == 'permit') {
                $attendance->note = $request->note;
            }
            if ($attendance){
                $attendance->save();
            }

            notify()->success('Attendance was successfully stored!', 'Success!');
            return redirect()->back();

        } catch (\exception $e) {
            Log::error('Failed to store attendance: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            notify()->error('Failed to store attendance', 'Failed!');
            return redirect()->back();
        }
    }

    public function absent(Request $request)
    {
        try {
            $userId = Auth::id();
            $request->validate([
                'absenceType' => ['required', 'in:sick,permit'],
                'note' => ['required', 'string', 'max:255'],
            ]);

            $attendance = Attendance::create([
                'user_id' => $userId,
                'status' => 'pending',
                'attendance' => $request->absenceType,
                'note' => $request->note,
            ]);

            notify()->success('Attendance was successfully stored!', 'Success!');
            return redirect()->back();

        } catch (\exception $e) {
            Log::error('Failed to store attendance: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            notify()->error('Failed to store attendance', 'Failed!');
            return redirect()->back();
        }
    }

    public function approval($approval, $id)
    {
        try {
            $attendance = Attendance::find($id);

            if ($approval == 1) {
                $attendance->update([
                    'status' => 'approved',
                    'approver_id' => Auth::user()->id,
                ]);
            } else {
                $attendance->update([
                    'status' => 'rejected',
                    'attendance' => 'absent',
                    'approver_id' => Auth::user()->id,
                ]);
            }
            return redirect()->route('attendances.index');
        } catch (\Exception $e) {
            Log::error("Error: " . $e->getMessage());
            return redirect()->route('attendances.index')->with(['error' => 'Gagal melakukan persetujuan']);
        }
    }

    public function requestAttendance($id)
    {
        return view('menus.attendance_act', compact('id'));
    }

    public function verifyLocation(Request $request)
    {
        $userLat = $request->latitude;
        $userLng = $request->longitude;

        $location = Location::all();

        $matchedLocation = null;
        foreach ($location as $loc) {
            $distance = $this->haversineGreatCircleDistance($userLat, $userLng, $loc->latitude, $loc->longitude);
            if ($distance <= $loc->radius) {
                $matchedLocation = $loc->name;
                $matchedLocationId = $loc->id;
                break;
            }
        }

        if ($matchedLocation) {
            return response()->json([
                'success' => true,
                'location' => $matchedLocation,
                'locationId' => $matchedLocationId,
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
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lng2);

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

    public function registerFace(Request $request)
    {
        try {
            $request->validate([
                'face_code' => 'required',
            ]);

            $faceCode = $request->face_code;

            $userId = Auth::id();
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $faceUser = FaceUser::where('user_id', $userId)->first();
            if ($faceUser) {
                $faceUser->update(['face_code' => $faceCode]);
            } else {
                FaceUser::create([
                    'user_id' => $userId,
                    'face_code' => $faceCode
                ]);
            }

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to register face: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function verifyFace(Request $request)
    {
        try {
            $request->validate([
                'face_code' => 'required',
            ]);

            $liveBase64 = $request->face_code;
            $liveBinary = base64_decode($liveBase64);
            if ($liveBinary === false) {
                return response()->json(['error' => 'Encoding live face descriptor tidak valid'], 400);
            }
            $liveDescriptor = array_values(unpack("f*", $liveBinary));

            Log::info('Live Descriptor:', $liveDescriptor);

            $faceUser = auth()->user()->faceUser;
            if (!$faceUser || !$faceUser->face_code) {
                return response()->json(['error' => 'Tidak ada wajah yang terdaftar'], 404);
            }

            $storedBase64 = $faceUser->face_code;
            $storedBinary = base64_decode($storedBase64);
            if ($storedBinary === false) {
                return response()->json(['error' => 'Encoding stored face descriptor tidak valid'], 500);
            }
            $storedDescriptor = array_values(unpack("f*", $storedBinary));

            Log::info('Stored Descriptor:', $storedDescriptor);

            $distance = $this->compareFace($liveDescriptor, $storedDescriptor);
            $threshold = 0.3;

            return response()->json([
                'match' => $distance < $threshold,
                'distance' => $distance,
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal verifikasi wajah: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    private function compareFace($liveFaceCode, $storedFaceCode)
    {
        if (count($liveFaceCode) != count($storedFaceCode)) {
            throw new \InvalidArgumentException('Face code length mismatch');
        }
        $sum = 0;
        for ($i = 0; $i < count($liveFaceCode); $i++) {
            $difference = $liveFaceCode[$i] - $storedFaceCode[$i];
            $sum += pow($difference, 2);
        }

        return sqrt($sum);
    }

    public function update(Request $request, $id)
    {
        try {
            $attendance = Attendance::findOrFail($id);
            $attendance->update([
                'attendance' => $request->attendance,
                'check_in' => $request->time,
                'location_id' => $request->location,
                'note' => $request->note,
            ]);
            notify()->success('Attendance was successfully updated!', 'Success!');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Failed to update attendance: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            notify()->error('Failed to update attendance', 'Failed!');
            return redirect()->back();
        }
    }

    public function analyzeAttendance(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'attendance_file' => 'required|mimes:xlsx,xls|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->all()
                ]);
            }

            $file = $request->file('attendance_file');
            $errors = [];

            $data = Excel::toArray([], $file)[0];

            $expectedHeaders = ['date', 'check_in', 'itb_account', 'location', 'attendance', 'note'];
            $headers = array_map('strtolower', $data[0] ?? []);

            if ($headers !== $expectedHeaders) {
                return response()->json([
                    'success' => false,
                    'errors' => ['Header file tidak sesuai. Urutan harus: ' . implode(', ', $expectedHeaders)]
                ]);
            }

            foreach (array_slice($data, 1) as $i => $row) {
                $rowNumber = $i + 2;

                if (isset($row[0])) {
                    if (is_numeric($row[0]) && $row[0] > 0) {
                        try {
                            $row[0] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0])->format('Y-m-d');
                        } catch (\Exception $e) {
                            $errors[] = "Baris $rowNumber: Tidak dapat mengonversi tanggal '{$row[0]}'";
                        }
                    } elseif (is_string($row[0]) && !empty($row[0])) {
                        try {
                            $date = \DateTime::createFromFormat('Y-m-d', $row[0]);
                            if (!$date) {
                                $date = \DateTime::createFromFormat('d/m/Y', $row[0]);
                                if ($date) {
                                    $row[0] = $date->format('Y-m-d');
                                }
                            }
                        } catch (\Exception $e) {
                            $errors[] = "Baris $rowNumber: Format tanggal '{$row[0]}' tidak valid (Harus YYYY-MM-DD)";
                        }
                    }
                }

                if (isset($row[1])) {
                    if (is_numeric($row[1]) && $row[1] >= 0 && $row[1] < 1) {
                        try {
                            $hours = floor($row[1] * 24);
                            $minutes = floor(($row[1] * 24 * 60) % 60);
                            $seconds = floor(($row[1] * 24 * 60 * 60) % 60);
                            $row[1] = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
                        } catch (\Exception $e) {
                            $errors[] = "Baris $rowNumber: Tidak dapat mengonversi waktu '{$row[1]}'";
                        }
                    } elseif (is_string($row[1]) && !empty($row[1])) {
                        try {
                            $time = \DateTime::createFromFormat('H:i:s', $row[1]);
                            if (!$time) {
                                $time = \DateTime::createFromFormat('H:i', $row[1]);
                                if ($time) {
                                    $row[1] = $time->format('H:i:s');
                                }
                            }
                        } catch (\Exception $e) {
                            $errors[] = "Baris $rowNumber: Format waktu '{$row[1]}' tidak valid (Harus HH:MM:SS)";
                        }
                    }
                }

                $attendance = strtolower($row[4] ?? '');
                if ($attendance === 'present' || $attendance === 'late') {
                    $requiredColumns = ['date', 'check_in', 'itb_account', 'location', 'attendance'];
                } elseif ($attendance === 'sick' || $attendance === 'permit' || $attendance === 'absent') {
                    $requiredColumns = ['date', 'itb_account', 'attendance'];
                } else {
                    $errors[] = "Baris $rowNumber: Nilai attendance '{$attendance}' tidak valid";
                    continue;
                }

                foreach ($requiredColumns as $colName) {
                    $index = array_search($colName, $expectedHeaders);
                    if (!isset($row[$index]) || $row[$index] === '' || $row[$index] === null) {
                        $errors[] = "Baris $rowNumber: Kolom '$colName' wajib diisi untuk attendance '$attendance'";
                    }
                }

                if (isset($row[2]) && $row[2] !== '' && $row[2] !== null) {
                    $user = User::where('itb_account', strtolower($row[2]))
                        ->whereHas('roles', function ($query) {
                            $query->where('name', 'user');
                        })
                        ->first();
                    if (!$user) {
                        $errors[] = "Baris $rowNumber: Akun '{$row[2]}' tidak ditemukan atau bukan peran 'user'";
                    } else {
                        $row[2] = $user->id;
                        $minDate = $user->min('period_start_date');
                        $maxDate = Carbon::today();
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

                        if (in_array($row[0], $holidays) || Carbon::parse($row[0])->isWeekend()) {
                            $errors[] = "Baris $rowNumber: Tanggal '" . Carbon::parse($row[0])->format('d M, Y') . "' adalah hari libur";
                        }
                    }
                }

                if (isset($row[3]) && $row[3] !== '' && $row[3] !== null) {
                    $location = Location::where('name', $row[3])->first();
                    if (!$location) {
                        $errors[] = "Baris $rowNumber: Lokasi '{$row[3]}' tidak ditemukan";
                    } else {
                        $row[3] = $location->id;
                    }
                }

                if (isset($row[0]) && $row[0] !== '' && $row[0] !== null) {
                    try {
                        Carbon::createFromFormat('Y-m-d', $row[0]);
                    } catch (\Exception $e) {
                        $errors[] = "Baris $rowNumber: Format tanggal '{$row[0]}' tidak valid (Harus YYYY-MM-DD)";
                    }
                }

                // Validasi format waktu jika diisi
                if (isset($row[1]) && $row[1] !== '' && $row[1] !== null) {
                    try {
                        Carbon::createFromFormat('H:i:s', $row[1]);
                    } catch (\Exception $e) {
                        $errors[] = "Baris $rowNumber: Format waktu '{$row[1]}' tidak valid (Harus HH:MM:SS)";
                    }
                }
            }

            if (!empty($errors)) {
                return response()->json([
                    'success' => false,
                    'errors' => $errors
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => [$e->getMessage()]], 500);
        }
    }

    public function importAttendance(Request $request)
    {
        try {
            $file = $request->file('attendance_file');
            $data = Excel::toArray([], $file)[0];

            foreach (array_slice($data, 1) as $i => $row) {
                $rowNumber = $i + 2;
                $locationId = $row[3];
                $attendanceType = strtolower($row[4]);
                $note = $row[5];

                if (isset($row[0])) {
                    if (is_numeric($row[0]) && $row[0] > 0) {
                        try {
                            $row[0] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0])->format('Y-m-d');
                        } catch (\Exception $e) {
                            $errors[] = "Baris $rowNumber: Tidak dapat mengonversi tanggal '{$row[0]}'";
                        }
                    } elseif (is_string($row[0]) && !empty($row[0])) {
                        try {
                            $date = \DateTime::createFromFormat('Y-m-d', $row[0]);
                            if (!$date) {
                                $date = \DateTime::createFromFormat('d/m/Y', $row[0]);
                                if ($date) {
                                    $row[0] = $date->format('Y-m-d');
                                }
                            }
                        } catch (\Exception $e) {
                            $errors[] = "Baris $rowNumber: Format tanggal '{$row[0]}' tidak valid (Harus YYYY-MM-DD)";
                        }
                    }
                }

                if (isset($row[1])) {
                    if (is_numeric($row[1]) && $row[1] >= 0 && $row[1] < 1) {
                        try {
                            $hours = floor($row[1] * 24);
                            $minutes = floor(($row[1] * 24 * 60) % 60);
                            $seconds = floor(($row[1] * 24 * 60 * 60) % 60);
                            $row[1] = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
                        } catch (\Exception $e) {
                            $errors[] = "Baris $rowNumber: Tidak dapat mengonversi waktu '{$row[1]}'";
                        }
                    } elseif (is_string($row[1]) && !empty($row[1])) {
                        try {
                            $time = \DateTime::createFromFormat('H:i:s', $row[1]);
                            if (!$time) {
                                $time = \DateTime::createFromFormat('H:i', $row[1]);
                                if ($time) {
                                    $row[1] = $time->format('H:i:s');
                                }
                            }
                        } catch (\Exception $e) {
                            $errors[] = "Baris $rowNumber: Format waktu '{$row[1]}' tidak valid (Harus HH:MM:SS)";
                        }
                    }
                }

                if (isset($row[2]) && $row[2] !== '' && $row[2] !== null) {
                    $user = User::where('itb_account', strtolower($row[2]))
                        ->whereHas('roles', function ($query) {
                            $query->where('name', 'user');
                        })
                        ->first();
                    if (!$user) {
                        $errors[] = "Baris $rowNumber: Akun '{$row[2]}' tidak ditemukan atau bukan peran 'user'";
                    } else {
                        $row[2] = $user->id;
                    }
                }

                if (isset($row[3]) && $row[3] !== '' && $row[3] !== null) {
                    $location = Location::where('name', $row[3])->first();
                    if (!$location) {
                        $errors[] = "Baris $rowNumber: Lokasi '{$row[3]}' tidak ditemukan";
                    } else {
                        $row[3] = $location->id;
                    }
                }

                if ($attendanceType === 'present' || $attendanceType === 'late') {
                    $attendance = Attendance::where('user_id', $row[2])
                        ->whereDate('created_at', $row[0] . ' 00:00:00')
                        ->first();

                    // $data = [
                    //     'location_id' => $row[3],
                    //     'check_in' => $row[1],
                    //     'status' => 'approved',
                    //     'attendance' => $attendanceType,
                    //     'note' => $note,
                    //     'created_at' => $row[0].' 00:00:00',
                    //     'updated_at' => now(),
                    //     'timestamps' => false,
                    // ];

                    if ($attendance) {
                        // $attendance->update($data);
                        // Membuat eloquent model baru untuk mengupdate data
                        $attendance->location_id = $row[3];
                        $attendance->check_in = $row[1];
                        $attendance->status = 'approved';
                        $attendance->attendance = $attendanceType;
                        $attendance->note = $note;
                        $attendance->created_at = $row[0] . ' 00:00:00';
                        $attendance->updated_at = now();
                        $attendance->timestamps = false;
                        $attendance->save();
                    } else {
                        // Memakai eloquent lagi
                        $attendance = new Attendance();
                        $attendance->user_id = $row[2];
                        $attendance->location_id = $row[3];
                        $attendance->check_in = $row[1];
                        $attendance->status = 'approved';
                        $attendance->attendance = $attendanceType;
                        $attendance->note = $note;
                        $attendance->created_at = $row[0] . ' 00:00:00';
                        $attendance->updated_at = now();
                        $attendance->timestamps = false;
                        $attendance->save();
                    }
                } elseif ($attendanceType === 'sick' || $attendanceType === 'permit' || $attendanceType === 'absent') {
                    $attendance = Attendance::where('user_id', $row[2])
                        ->whereDate('created_at', $row[0] . ' 00:00:00')
                        ->first();

                    if ($attendance) {
                        $attendance->update([
                            'status' => 'pending',
                            'attendance' => $attendanceType,
                            'note' => $note,
                            'created_at' => $row[0] . ' 00:00:00',
                            'updated_at' => now(),
                            'timestamps' => false,
                        ]);
                    } else {
                        Attendance::create([
                            'user_id' => $row[2],
                            'status' => 'pending',
                            'attendance' => $attendanceType,
                            'note' => $note,
                            'created_at' => $row[0] . ' 00:00:00',
                            'updated_at' => now(),
                            'timestamps' => false,
                        ]);
                    }
                }
            }

            notify()->success('Attendance was successfully imported!', 'Success!');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Failed to import attendance: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            notify()->error('Failed to import attendance', 'Failed!');
            return redirect()->back();
        }
    }



}
