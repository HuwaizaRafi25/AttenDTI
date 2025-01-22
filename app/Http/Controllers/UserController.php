<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $query = User::with('placement');

        if ($request->has('role')) {
            $role = $request->role;
            if ($role !== 'all' && !empty($role)) {
                $query->where('role', $role);
            }
        }

        if ($request->has('status')) {
            $status = $request->status;
            $query->where('status', $status == 1);
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

        return view('menus.user', compact('users'));
    }

    public function export()
    {
        $users = User::with('outlet')->get();
        // Logika untuk mengekspor data ke CSV atau Excel
        // Gunakan package seperti maatwebsite/excel untuk implementasi
    }

    public function print()
    {
        $users = User::with('outlet')->get();
        return view('menus.user_print', compact('users'));
    }

    public function search(Request $request)
    {
        $rafi_search = $request->get('q');

        $users = User::with('outlet')
            ->where(function ($query) use ($rafi_search) {
                $query->where('nama', 'like', "%{$rafi_search}%")
                    ->orWhere('email', 'like', "%{$rafi_search}%");
            })
            ->paginate(5);


        return view('menus.tables.user_table', compact('users'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => ['required', 'string', 'max:100'],
                'username' => ['required', 'string', 'max:30', 'unique:tb_user,username'],
                'email' => ['required', 'string', 'email', 'max:100', 'unique:tb_user,email'],
                'telepon' => ['required', 'numeric', 'unique:tb_user,tlp'],
                'placement_id' => ['nullable'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => ['required', Rule::in(['super_admin', 'manajer', 'admin', 'owner', 'kasir'])],
                'userProfilePic' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
            ]);

            $rafi_outlet = $request->placement_id;

            if ($request->role == 'super_admin' || $request->role == 'owner') {
                $rafi_outlet = NULL;
            }

            $profilePicPath = null;

            if ($request->hasFile('userProfilePic')) {
                $image = $request->file('userProfilePic');
                $path = $image->store('profilePics', 'public');
                $profilePicPath = 'storage/' . $path;
            }

            $rafi_currentOwner = User::where('role', 'owner')->get();
            $rafi_currentManajer = User::where('role', 'manajer')->where('placement_id', $request->placement_id)->get();

            if (count($rafi_currentOwner) == 1 && $request->role == 'owner') {
                notify()->error('Owner sudah ada!', 'Gagal!');
                return redirect()->back();
            } elseif (count($rafi_currentManajer) == 1 && $request->role == 'manajer') {
                notify()->error('Manajer sudah ada!', 'Gagal!');
                return redirect()->back();
            } else {
                $rafi_user = User::create([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'email' => $request->email,
                    'tlp' => $request->telepon,
                    'placement_id' => $rafi_outlet,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'profile_pic' => $profilePicPath,
                ]);

                activity()
                    ->performedOn($rafi_user)
                    ->causedBy(auth()->user())
                    ->event('tambah')
                    ->log('Pengguna bernama ' . $rafi_user->nama . ' dibuat oleh: ' . Auth::user()->nama);

                notify()->success('Pengguna berhasil ditambahkan! ✍️', 'Berhasil!');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Gagal menambahkan pengguna: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            notify()->error('Gagal menambahkan pengguna!', 'Gagal!');
            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {
        try {

            $rafi_user = User::findOrFail($id);
            $request->validate([
                'userProfilePic' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
                'username' => ['required', 'string', 'max:255'],
                'namaPengguna' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:tb_user,email,' . $id],
                'telepon' => ['required', 'numeric', 'unique:tb_user,tlp,' . $id],
                'roleUpdate' => ['required', Rule::in(['super_admin', 'manajer', 'admin', 'owner', 'kasir'])],
                'placement_id_update' => ['nullable'],
                'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            ]);


            $rafi_outlet = $request->placement_id_update;

            if ($request->roleUpdate == 'super_admin' || $request->roleUpdate == 'owner') {
                $rafi_outlet = NULL;
            }

            $profilePicPath = $rafi_user->profile_pic;

            if ($request->hasFile('userProfilePic')) {
                if ($profilePicPath && file_exists(public_path($profilePicPath))) {
                    unlink(public_path($profilePicPath));
                }
                $image = $request->file('userProfilePic');
                $path = $image->store('profilePics', 'public');
                $profilePicPath = 'storage/' . $path;
            }

            $rafi_user->update([
                'nama' => $request->namaPengguna,
                'username' => $request->username,
                'email' => $request->email,
                'tlp' => $request->telepon,
                'placement_id' => $rafi_outlet,
                'password' => Hash::make($request->password),
                'role' => $request->roleUpdate,
                'profile_pic' => $profilePicPath,
            ]);
            activity()
                ->performedOn($rafi_user)
                ->causedBy(auth()->user())
                ->event('edit')
                ->log('Pengguna bernama ' . $rafi_user->nama . ' dirubah oleh: ' . Auth::user()->nama);

            notify()->success('Pengguna berhasil diedit! 👌', 'Berhasil!');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Gagal mengedit pengguna: ' . $e->getMessage(), [
            ]);

            notify()->error('Gagal mengedit pengguna!', 'Gagal!');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $rafi_user = user::findOrFail($id);
            $rafi_user->delete();
            activity()
                ->performedOn($rafi_user)
                ->causedBy(auth()->user())
                ->event('tambah')
                ->log('Pengguna bernama ' . $rafi_user->nama . ' dihapus oleh: ' . Auth::user()->nama);

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
}
