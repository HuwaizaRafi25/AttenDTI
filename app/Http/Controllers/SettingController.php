<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppSetting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function applicationSetting()
    {
        $setting = AppSetting::first();

        return view('menus.settings', [
            'app_name' => $setting->app_name ?? null,
            'appLogo' => $setting->logo ?? null,
            'late_time' => $setting->late_time ?? null,
        ]);
    }

    public function updateApplicationSetting(Request $request)
    {
        // 1. VALIDASI
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'late_time_hour' => 'required|integer|min:0|max:23',
            'late_time_minute' => 'required|integer|min:0|max:59',
            'company_address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'work_days' => 'nullable|array',
        ]);

        // 2. AMBIL / BUAT DATA (ANTI DUPLIKAT)
        $setting = AppSetting::first();

        if (!$setting) {
            $setting = new AppSetting();
        }

        // 3. HANDLE LOGO
        if ($request->hasFile('company_logo')) {

            // hapus lama (kalau ada)
            if ($setting->logo && Storage::disk('public')->exists('appLogo/' . $setting->logo)) {
                Storage::disk('public')->delete('appLogo/' . $setting->logo);
            }

            $file = $request->file('company_logo');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('appLogo', $filename, 'public');

            $setting->logo = $filename;
        }

        // 4. SIMPAN DATA
        $setting->name = $validated['company_name'];
        $setting->late_time_hour = $validated['late_time_hour'];
        $setting->late_time_minute = $validated['late_time_minute'];
        $setting->address = $validated['company_address'] ?? null;
        $setting->phone = $validated['phone_number'] ?? null;
        $setting->email = $validated['email'] ?? null;

        // work_days jadi string (karena blade lu expect string/array)
        $setting->work_days = isset($validated['work_days'])
            ? implode(',', $validated['work_days'])
            : null;

        $setting->save();

        return redirect()
            ->back()
            ->with('success', 'Pengaturan berhasil diperbarui');
    }
}
