@extends('layouts.app')
@section('content')
    <div class="py-3 flex justify-center">
        <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Company Settings</h2>

            <form method="POST" action="{{ route('setelanUmum.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">

                    <!-- Logo Perusahaan -->
                    <div class="flex justify-center">
                        <label for="userProfileImageInput" class="cursor-pointer relative">
                            <img id="userProfileImage"
                                src="{{ $appLogo ? asset('storage/appLogo/' . $appLogo) : asset('assets/images/icons/dti_icon.png') }}"
                                alt="Logo Perusahaan"
                                class="w-32 h-32 object-cover rounded-lg border-gray-200">
                            <div
                                class="absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-md transform translate-x-1/2 translate-y-1/2">
                                <span class="text-gray-600">
                                    {!! file_get_contents(public_path('assets/images/icons/pencil.svg')) !!}
                                </span>
                            </div>
                        </label>
                        <input type="file" name="company_logo" id="userProfileImageInput" accept="image/*"
                            class="hidden" onchange="previewImageProfilePic(event, 'userProfileImage')">
                    </div>
                    @error('company_logo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Nama Perusahaan -->
                    <div class="flex flex-col">
                        <label for="companyName" class="text-sm font-semibold text-gray-700">Nama Perusahaan</label>
                        <input type="text" id="companyName" name="company_name"
                            class="mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('company_name', $company->name ?? 'My Company') }}">
                        @error('company_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Batas Waktu Keterlambatan -->
                    <div class="flex flex-col">
                        <label for="lateTime" class="text-sm font-semibold text-gray-700">Batas Waktu Keterlambatan (Jam)</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="lateTimeHour" class="text-xs text-gray-500">Jam</label>
                                <select id="lateTimeHour" name="late_time_hour"
                                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @for ($i = 0; $i < 24; $i++)
                                        <option value="{{ $i }}" {{ (old('late_time_hour', $company->late_time_hour ?? 8) == $i) ? 'selected' : '' }}>
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label for="lateTimeMinute" class="text-xs text-gray-500">Menit</label>
                                <select id="lateTimeMinute" name="late_time_minute"
                                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @for ($i = 0; $i < 60; $i += 5)
                                        <option value="{{ $i }}" {{ (old('late_time_minute', $company->late_time_minute ?? 30) == $i) ? 'selected' : '' }}>
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Karyawan yang absen setelah waktu ini akan dianggap terlambat</p>
                        @error('late_time_hour')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        @error('late_time_minute')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Perusahaan -->
                    <div class="flex flex-col">
                        <label for="companyAddress" class="text-sm font-semibold text-gray-700">Alamat Perusahaan</label>
                        <textarea id="companyAddress" name="company_address" rows="3"
                            class="mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('company_address', $company->address ?? '') }}</textarea>
                        @error('company_address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="flex flex-col">
                        <label for="phoneNumber" class="text-sm font-semibold text-gray-700">Nomor Telepon</label>
                        <input type="tel" id="phoneNumber" name="phone_number"
                            class="mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('phone_number', $company->phone ?? '+62 812 3456 7890') }}">
                        @error('phone_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col">
                        <label for="email" class="text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" id="email" name="email"
                            class="mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('email', $company->email ?? 'contact@mycompany.com') }}">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Hari Kerja -->
                    <div class="flex flex-col">
                        <label class="text-sm font-semibold text-gray-700 mb-2">Hari Kerja</label>
                        <div class="grid grid-cols-4 gap-2">
                            @php
                                $workDays = old('work_days', $company->work_days ?? ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']);
                                if (!is_array($workDays)) {
                                    $workDays = explode(',', $workDays);
                                }
                            @endphp

                            @foreach(['Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu'] as $day => $dayName)
                                <div class="flex items-center">
                                    <input type="checkbox" id="day_{{ $day }}" name="work_days[]" value="{{ $day }}"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                        {{ in_array($day, $workDays) ? 'checked' : '' }}>
                                    <label for="day_{{ $day }}" class="ml-2 text-sm text-gray-700">{{ $dayName }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('work_days')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-center pt-4">
                        <button type="submit"
                            class="px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full font-medium transition duration-200">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImageProfilePic(event, imgId) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.getElementById(imgId);
                imgElement.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
