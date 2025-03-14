<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FaceUser;
use App\Models\Location;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\FacadesLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', date('m'));
        $selectedYear = $request->input('year', date('Y'));

        $users = User::with('attendances', 'attendances.location', 'roles', 'approver')->whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();

        $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear);

        $dates = [];
        for ($day = 1; $day <= $numberOfDays; $day++) {
            $dates[] = $selectedYear . '-' . $selectedMonth . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
        }

        $apiUrl = "https://dayoffapi.vercel.app/api?month={$selectedMonth}&year={$selectedYear}";
        // $response = file_get_contents($apiUrl);
        // $holidayData = json_decode($response, true);
        $jsonFilePath = public_path('assets/json/dayoff.json');
        if (file_exists($jsonFilePath)) {
            $response = file_get_contents($jsonFilePath);
            $holidayData = json_decode($response, true);
        } else {
            // Handle the case where the file doesn't exist
            $holidayData = [];
        }

        $holidays = [];
        $holidaysNames = [];
        if ($holidayData) {
            foreach ($holidayData as $holiday) {
                // Menggunakan key "tanggal" dan "keterangan" sesuai output API
                $holidayDate = \Carbon\Carbon::parse($holiday['tanggal'])->format('Y-m-d');
                $holidays[] = $holidayDate;
                $holidaysNames[$holidayDate] = $holiday['keterangan'];
            }
        }

        //  List tanggal pada bulan terpilih
        return view('menus.attendance', compact('users', 'dates', 'holidays', 'holidaysNames'));
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

    public function absent(Request $request){
        try {
            $userId = Auth::id();
            $request->validate([
                'absenceType' => ['required', 'in:sick,permit'],
                'note' => ['required' , 'string', 'max:255'],
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

}
