<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Exports\UsersExcelExport;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Exceptions\UnauthorizedException;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('placement');

        if ($request->has('role')) {
            $role = $request->role;
            if ($role !== 'all' && !empty($role)) {
                $query->with('roles')
                    ->whereHas('roles', function ($query) use ($role) {
                        $query->where('name', $role);
                    });
            }
        }

        if ($request->has('status')) {
            $status = $request->status;
            $query->where('last_seen', '>=', Carbon::now()->subMinutes(1));
        }

        $sortColumn = $request->get('sort', 'full_name');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortColumn, $sortDirection);

        if ($sortColumn === 'placement_id') {
            $query->with('placement')
                ->orderBy('full_name', $sortDirection);
        } else {
            $query->orderBy($sortColumn, $sortDirection);
        }

        $users = $query->paginate(5);

        $placements = Location::all();

        return view('menus.user', compact('users', 'placements'));
    }

    public function view($username)
    {
        $users = User::where('username', $username)->get();
        return view('profile', compact('users'));
    }

    public function print()
    {
        $users = User::with('outlet')->get();
        return view('menus.components.user_table_print', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->get('q');

        $users = User::with('placement')
            ->where(function ($query) use ($search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('itb_account', 'like', "%{$search}%");
            })
            ->paginate(5);


        return view('menus.tables.user_table', compact('users'));
    }

    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $id = $request->input('id');
        if ($id) {
            $exists = User::where('username', $username)->where('id', '!=', $id)->exists();
        } else {
            $exists = User::where('username', $username)->exists();
        }
        return response()->json(['available' => !$exists]);
    }

    public function checkITBAccount(Request $request)
    {
        $email = $request->query('itb_account');
        $id = $request->query('id');
        if ($id) {
            $exists = User::where('itb_account', $email)->where('id', '!=', $id)->exists();
        } else {
            $exists = User::where('itb_account', $email)->exists();
        }
        return response()->json(['availableEmail' => !$exists]);
    }

    public function getPlacements()
    {
        $locations = Location::all();
        return response()->json($locations);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => ['required', 'string', 'max:30', 'unique:users,username'],
                'itb_account' => ['required', 'string', 'email', 'max:100', 'unique:users,itb_account'],
                'placement_id' => ['nullable', 'exists:locations,id'],
                'role' => ['required', Rule::in(['admin', 'alumni', 'user'])],
                'userProfilePic' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            if (!str_ends_with($request->itb_account, '@itb.ac.id')) {
                notify()->error('Email harus menggunakan domain @itb.ac.id.', 'Gagal!');
                return back();
            }

            $placement = $request->placement_id;

            if ($request->role == 'admin' || $request->role == 'alumni') {
                $placement = NULL;
            }

            $profilePicPath = null;

            if ($request->hasFile('userProfilePic')) {
                // $image = $request->file('userProfilePic');
                $newFileName = uniqid() . '.' . $request->file('userProfilePic')->getClientOriginalExtension();
                $request->file('userProfilePic')->storeAs('profilePics', $newFileName, 'public');
            }

            $user = User::create([
                'username' => $request->username,
                'itb_account' => $request->itb_account,
                'placement_id' => $placement,
                'profile_pic' => $newFileName,
                'password' => Hash::make($request->password),
            ]);

            if ($request->role !== null) {
                $user->assignRole($request->role);
            }

            activity()
                ->performedOn($user)
                ->causedBy(auth()->user())
                ->event('created')
                ->log("User {$user->username} was created by " . Auth::user()->username);

            notify()->success('User was created successfully! ✍️', 'Success!');
            return redirect()->back();

        } catch (\Exception $e) {
            Log::error('Failed to create user: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            notify()->error('Failed to create user. Please try again.', 'Failed!');
            return redirect()->back();
        }
    }
    public function updateView($id)
    {
        foreach (Auth::user()->roles as $role) {
            if ($role->name == 'admin' || Auth::id() == $id) {
                $user = User::findOrFail($id);
                $placements = Location::all();
                return view('menus.modals.user.update_user_view', compact('user', 'placements'));
            } else {
                throw new UnauthorizedException(403);
            }
        }
    }
    public function update(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);
            if ($user->roles->first() != null) {
                $role = $user->roles->first()->name;
            }else{
                $role = null;
            }
            $request->validate([
                'userProfilePic' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10000',
                'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
                'itb_account' => ['required', 'string', 'email', 'max:100', 'unique:users,itb_account,' . $id],
                'fullname' => ['nullable', 'string', 'max:255'],
                'gender' => ['required', Rule::in([1, 0])],
                'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
                'phone' => ['nullable', 'numeric', 'unique:users,phone,' . $id],
                'address' => ['nullable', 'string', 'max:255'],
                'identity_number' => ['nullable', 'string', 'max:55', 'unique:users,identity_number,' . $id],
                'major' => ['nullable', 'string', 'max:255'],
                'institution' => ['nullable', 'string', 'max:255'],
                'placement_id' => ['nullable', Rule::in(Location::all()->pluck('id')->toArray())],
                'period_start_date' => ['nullable', 'date'],
                'period_end_date' => ['nullable', 'date'],
                'role' => [Rule::in(['admin', 'user', 'alumni'])],
                'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            ]);

            $placement = $request->placement_id;

            if ($request->role == 'admin') {
                $placement = NULL;
            }

            if ($request->role !== $role && $request->role !== null) {
                $user->removeRole(role: $role);
                $user->assignRole($request->role);
            }

            if ($request->hasFile('userProfilePic')) {
                if ($user->profile_picture && Storage::disk('public')->exists('profilePics/' . $user->profile_picture)) {
                    Storage::disk('public')->delete('profilePics/' . $user->profile_picture);
                }
                $newFileName = uniqid() . '.' . $request->file('userProfilePic')->getClientOriginalExtension();
                $request->file('userProfilePic')->storeAs('profilePics', $newFileName, 'public');
                $user->update([
                    'profile_pic' => $newFileName,
                ]);
            }

            $user->update([
                'username' => $request->username,
                'itb_account' => $request->itb_account,
                'full_name' => $request->fullname,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'identity_number' => $request->identity_number,
                'major' => $request->major,
                'institution' => $request->institution,
                'placement_id' => $placement,
                'period_start_date' => $request->period_start_date,
                'period_end_date' => $request->period_end_date,
                'password' => Hash::make($request->password),
            ]);
            activity()
                ->performedOn($user)
                ->causedBy(auth()->user())
                ->event('updated')
                ->log("User {$user->username} was updated by " . Auth::user()->username);

            notify()->success('User was updated successfully! 👌', 'Success!');
            foreach (Auth::user()->roles as $role) {
                if ($role->name == 'admin') {
                    return redirect()->route('users.list');
                } else {
                    return redirect()->route('user.view');
                }
            }
        } catch (\Exception $e) {
            Log::error('Gagal mengedit pengguna: ' . $e->getMessage(), [
            ]);

            notify()->error('Failed to update user! Try again', 'Failed!');
            foreach (Auth::user()->roles as $role) {
                if ($role->name == 'admin') {
                    return redirect()->route('users.list');
                } else {
                    return redirect()->route('user.view');
                }
            }
        }
    }

    public function destroy($id)
    {
        try {
            $user = user::findOrFail($id);
            $user->delete();
            activity()
                ->performedOn($user)
                ->causedBy(auth()->user())
                ->event('tambah')
                ->log('Pengguna bernama ' . $user->username . ' dihapus oleh: ' . Auth::user()->username);

            notify()->success('Pengguna berhasil dihapus! 👍', 'Berhasil!');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Gagal menghapus pengguna: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            notify()->error('Gagal menghapus pengguna!', 'Gagal!');
            return redirect()->back();
        }
    }

    public function profile()
    {
        return view('menus.user_profile', [
            'user' => Auth::user(),
        ]);
    }
    /**
     * Display the user's profile form.
     */
    public function updateProfile(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // public function exportPDF($users)
    // {
    //     $users = User::with('placement')->get();
    // }

    public function exportExcel(Request $request)
    {
        // Ambil parameter filter dari query string
        $filters = [
            'role' => $request->query('role'),
            'sort' => $request->query('sort', 'id'), // Default sort by 'id'
            'direction' => $request->query('direction', 'asc'), // Default direction 'asc'
            'status' => $request->query('status'),
        ];

        // Ekspor data ke Excel
        return Excel::download(new UsersExcelExport($filters), 'users_filtered.xlsx');
    }
    public function export(Request $request, $type)
    {
        // Validasi format ekspor
        if (!in_array($type, ['pdf', 'xlsx', 'csv'])) {
            notify()->error('Invalid export format.', 'Error!');
            return redirect()->back();
        }

        // Mulai query dasar
        $query = User::with('placement');

        // Filter berdasarkan role
        if ($request->has('role')) {
            $role = $request->role;
            if ($role !== 'all' && !empty($role)) {
                $query->with('roles')
                    ->whereHas('roles', function ($query) use ($role) {
                        $query->where('name', $role);
                    });
            }
        }

        // Filter berdasarkan status
        if ($request->has('status')) {
            $status = $request->status;
            $query->where('last_seen', '>=', Carbon::now()->subMinutes(1));
        }

        // Sorting
        $sortColumn = $request->get('sort', 'full_name');
        $sortDirection = $request->get('direction', 'asc');
        if ($sortColumn === 'placement_id') {
            $query->with('placement')
                ->orderBy('full_name', $sortDirection);
        } else {
            $query->orderBy($sortColumn, $sortDirection);
        }

        // Ambil semua data yang difilter
        $users = $query->get();

        // Tentukan nama file berdasarkan format
        $fileName = 'users_filtered.' . $type;

        // Ekspor data sesuai format
        if ($type === 'pdf') {
            $pdf = PDF::loadView('menus.components.user_table_print', compact('users'));
            return $pdf->download('users.pdf');
        } elseif ($type === 'xlsx' || $type === 'csv') {
            return Excel::download(new UsersExcelExport($users), $fileName);
        }
    }
}
