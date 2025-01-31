<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'AttenDTI') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/clock.css') }}">
    @notifyCss
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <style>
        .radio-group .radio:first-child {
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }

        .radio-group .radio:last-child {
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }

        .radio-group .radio {
            position: relative;
        }

        .radio input {
            visibility: hidden;
            position: absolute;

        }

        .radio label:hover {
            cursor: pointer;
        }

        .radio input:checked+label {
            border-color: #38C172;
            background-color: #E3FCEC;
        }
    </style>
</head>

<body class="antialiased overflow-y-scroll bg-gray-50">
    <div class="min-w-screen space-y-4 pb-12">
        <!-- Back Button -->
        <div class="flex items-center justify-start w-full px-6 py-4">
            <a href="{{ Auth::user()->hasRole('admin') ? url('/users/list') : url('/' . Auth::user()->username) }}"
                class="flex w-min items-center text-gray-600 hover:text-gray-800">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back
            </a>
        </div>

        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-2 text-gray-800">User Biodata Update</h2>

            <p class="text-red-500 text-sm mb-2">* Indicates required input</p>
            <form method="POST" action="{{ route('users.updateAct', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col md:flex-row gap-8">
                    <div class="flex items-center text-gray-600 justify-center w-full gap-4">
                        <h2 class="text-lg font-medium whitespace-nowrap">Account</h2>
                        <hr class="w-full h-0.5">
                        </hr>
                    </div>
                    <div class="md:flex items-center justify-center w-full gap-4">
                        <!-- Profile Image Input -->
                        <div class="flex justify-center md:w-2/6">
                            <input type="file" name="userProfilePic" id="profileImageInput" accept="image/*"
                                class="hidden" onchange="previewImageProfilePic(event, 'profileImage')">
                            <label for="profileImageInput" class="relative cursor-pointer inline-block">
                                <img id="profileImage"
                                    src="{{ $user->profile_pic ? asset('storage/profilePics/' . $user->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                                    alt="User Profile"
                                    class="w-40 h-40 rounded-full border-[2px] bg-gray-50 p-2 shadow-md object-cover">
                                <div
                                    class="absolute w-8 h-8 flex justify-center items-center bottom-6 right-6 bg-white p-1 rounded-full shadow-md transform translate-x-1/2 translate-y-1/2">
                                    <span class="icon text-gray-600 scale-150">
                                        {!! file_get_contents(public_path('assets/images/icons/pencil.svg')) !!}
                                    </span>
                                </div>
                            </label>
                        </div>
                        <!-- User Info Input Fields -->
                        <div class="flex flex-col gap-y-2 md:w-4/6">
                            <div class="space-y-1">
                                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username
                                    <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="username" id="username" value="{{ $user->username }}"
                                    placeholder="Input Username"
                                    class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                    oninput="
                                    checkUsername(this.value, {{ $user->id }});"
                                    onchange="checkUsername(this.value, {{ $user->id }})" required>
                                <div id="username-feedback" class="text-sm mt-1 hidden"></div>
                            </div>

                            <div class="space-y-1">
                                <label for="itb_account" class="block text-sm font-medium text-gray-700 mb-1">
                                    ITB Account
                                    <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="itb_account" id="itb_account"
                                    value="{{ $user->itb_account }}" placeholder="Email ITB (contoh: user@itb.ac.id)"
                                    class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                    oninput="
                                        validateITBAccount(this.value, {{ $user->id }})"
                                    onchange="validateITBAccount(this.value,
                                    {{ $user->id }}); "
                                    required>
                                <div id="itb-account-feedback" class="text-sm mt-1 hidden"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="flex-1 space-y-4">
                        <div class="container mx-auto flex flex-col justify-center">
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role
                                @if (Auth::id() == $user->id)
                                    <span class="text-sm text-gray-500 italic">(*Note: You can't change your own
                                        role)</span>
                                @else
                                    <span class="text-red-600">*</span>
                                @endif
                            </label>
                            <div>
                                <div class="radio-group flex w-full flex-row justify-center rounded-lg shadow-md">
                                    <!-- Admin -->
                                    <div
                                        class="radio w-1/3 {{ Auth::id() == $user->id ? 'bg-gray-200' : 'bg-white' }} border border-gray-300">
                                        <input type="radio" id="admin" name="role" value="admin"
                                            {{ $user->hasRole('admin') ? 'checked' : '' }}
                                            {{ Auth::id() == $user->id ? 'disabled' : '' }}>
                                        <label for="admin"
                                            class="block w-full text-center px-4 py-3 rounded-l-lg {{ Auth::user()->getRoleNames()->first() == 'admin' && Auth::id() == $user->id ? 'bg-gray-300' : 'bg-white' }} border-gray-300 h-full cursor-not-allowed">
                                            <div
                                                class="font-semibold opacity-65 flex md:flex-row flex-col items-center gap-y-3 uppercase tracking-wide">
                                                <img src="{{ asset('assets/images/icons/support.svg') }}"
                                                    class="w-16" alt="">
                                                <strong>Admin</strong>
                                            </div>
                                        </label>
                                    </div>
                                    <!-- User -->
                                    <div
                                        class="radio w-1/3 {{ Auth::id() == $user->id ? 'bg-gray-200' : 'bg-white' }} border border-gray-300">
                                        <input type="radio" id="user" name="role" value="user"
                                            {{ $user->hasRole('user') ? 'checked' : '' }}
                                            {{ Auth::id() == $user->id ? 'disabled' : '' }}>
                                        <label for="user"
                                            class="block w-full text-center px-4 py-3 {{ Auth::user()->getRoleNames()->first() == 'user' && Auth::id() == $user->id ? 'bg-gray-300' : 'bg-white' }} border-gray-300 h-full cursor-not-allowed">
                                            <div
                                                class="font-semibold opacity-65 flex flex-col items-center gap-y-3 uppercase tracking-wide">
                                                <img src="{{ asset('assets/images/icons/user.svg') }}" class="w-14"
                                                    alt="">
                                                <strong>User</strong>
                                            </div>
                                        </label>
                                    </div>
                                    <!-- Alumni -->
                                    <div
                                        class="radio w-1/3 {{ Auth::id() == $user->id ? 'bg-gray-200' : 'bg-white' }} border border-gray-300">
                                        <input type="radio" id="alumni" name="role" value="alumni"
                                            {{ $user->hasRole('alumni') ? 'checked' : '' }}
                                            {{ Auth::id() == $user->id ? 'disabled' : '' }}>
                                        <label for="alumni"
                                            class="block w-full text-center px-4 py-3 rounded-r-lg {{ Auth::user()->getRoleNames()->first() == 'alumni' && Auth::id() == $user->id ? 'bg-gray-300' : 'bg-white' }} border-gray-300 h-full cursor-not-allowed">
                                            <div
                                                class="font-semibold opacity-65 flex flex-col items-center gap-y-2 uppercase tracking-wide">
                                                <img src="{{ asset('assets/images/icons/toga.svg') }}"
                                                    class="w-[85px]" alt="">
                                                <strong>Alumni</strong>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New
                                    Password</label>
                                <div class="relative"> <!-- Tambahkan wrapper div ini -->
                                    <input type="password" id="password" name="password"
                                        placeholder="Enter your new password"
                                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500 pr-10 @error('password') border-red-500 @enderror">
                                    <button type="button" id="togglePassword"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700 mb-1">Confirm New
                                    Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="Konfirmasi Password"
                                    class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                    oninput="checkPasswordMatch(this.value)">
                                <div id="password-feedback" class="text-sm mt-1"></div>
                            </div>
                        </div>

                        <div class="flex items-center text-gray-600 justify-center w-full pt-4 gap-4">
                            <h2 class="text-lg font-medium whitespace-nowrap">Biodata</h2>
                            <hr class="w-full h-0.5">
                            </hr>
                        </div>

                        <!-- Additional Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Full Name -->
                            <div class="space-y-1">
                                <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Full
                                    Name
                                    @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin'))
                                        <span class="text-red-600">*</span>
                                    @endif
                                </label>
                                <input type="text" name="fullname" id="fullname" value="{{ $user->full_name }}"
                                    placeholder="Input Fullname"
                                    class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                    @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin')) required @endif>
                                <div id="fullname-feedback" class="text-sm mt-1 hidden"></div>
                            </div>

                            <!-- Gender -->
                            <div class="space-y-1">
                                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender
                                    <span class="text-red-600">*</span>
                                </label>
                                <select name="gender" id="gender" required
                                    class="w-full border rounded p-2 focus:outline-none focus:border-blue-500">
                                    @if ($user->gender == 1)
                                        <option value="1" selected>
                                            Male
                                        </option>
                                    @elseif($user->gender == 0)
                                        <option value="0" selected>
                                            Female
                                        </option>
                                    @else
                                        <option selected hidden>
                                            Choose gender
                                        </option>
                                    @endif
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                            </div>

                            <!-- Email -->
                            <div class="space-y-1">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                    @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin'))
                                        <span class="text-red-600">*</span>
                                    @endif
                                </label>
                                <input type="text" name="email" id="email" value="{{ $user->email }}"
                                    placeholder="Input email"
                                    class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                    oninput="
                                    checkEmail(this.value, {{ $user->id }});"
                                    onchange="checkEmail(this.value, {{ $user->id }})"
                                    @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin')) required @endif>
                                <div id="email-feedback" class="text-sm mt-1 hidden"></div>
                            </div>

                            <!-- Phone -->
                            <div class="space-y-1">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone
                                    Number
                                    @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin'))
                                        <span class="text-red-600">*</span>
                                    @endif
                                </label>
                                <input type="text" name="phone" id="phone" value="{{ $user->phone }}"
                                    placeholder="Input phone"
                                    class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                    oninput="checkphone(this.value, {{ $user->id }});"
                                    onchange="checkphone(this.value, {{ $user->id }})"
                                    @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin')) required @endif>
                                <div id="phone-feedback" class="text-sm mt-1 hidden"></div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">Alamat
                                @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin'))
                                    <span class="text-red-600">*</span>
                                @endif
                            </label>
                            <textarea name="address" rows="3" class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin')) required @endif>{{ $user->address }}</textarea>
                        </div>

                        <div class="flex items-center text-gray-600 justify-center w-full pt-4 gap-4">
                            <h2 class="text-lg font-medium whitespace-nowrap">Academic</h2>
                            <hr class="w-full h-0.5">
                            </hr>
                        </div>

                        <!-- Academic Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- NISN -->
                            <div class="space-y-1">
                                <label for="identity_number" class="block text-sm font-medium text-gray-700 mb-1">Identity
                                    Number
                                    @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin'))
                                        <span class="text-red-600">*</span>
                                    @endif
                                </label>
                                <input type="text" name="identity_number" id="identity_number" value="{{ $user->identity_number }}"
                                    placeholder="Input identity_number"
                                    class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                    oninput="checkNISN(this.value, {{ $user->id }});"
                                    onchange="checkNISN(this.value, {{ $user->id }})"
                                    @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin')) required @endif>
                                <div id="identity_number-feedback" class="text-sm mt-1 hidden"></div>
                            </div>

                            <!-- Major -->
                            @if (Auth::user()->hasRole('admin') && Auth::id() == $user->id)
                            @else
                                <div class="space-y-1">
                                    <label for="major" class="block text-sm font-medium text-gray-700 mb-1">Major
                                        @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin'))
                                            <span class="text-red-600">*</span>
                                        @endif
                                    </label>
                                    <input type="text" name="major" id="major" value="{{ $user->major }}"
                                        placeholder="Input major"
                                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                        @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin')) required @endif>
                                    <div id="major-feedback" class="text-sm mt-1 hidden"></div>
                                </div>
                            @endif

                            <!-- NISN -->
                            <div class="space-y-1">
                                <label for="institution"
                                    class="block text-sm font-medium text-gray-700 mb-1">Institution
                                    @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin'))
                                        <span class="text-red-600">*</span>
                                    @endif
                                </label>
                                <input type="text" name="institution" id="institution"
                                    value="{{ $user->institution }}" placeholder="Input institution"
                                    class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                    @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin')) required @endif>
                                <div id="institution-feedback" class="text-sm mt-1 hidden"></div>
                            </div>

                            <!-- NISN -->
                            @if (Auth::user()->hasRole('admin') && Auth::id() == $user->id)
                            @else
                                <div class="space-y-1">
                                    <label for="identity_number"
                                        class="block text-sm font-medium text-gray-700 mb-1">Placement</label>
                                    @if (Auth::user()->hasRole('admin'))

                                        <select name="placement" id="placement"
                                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500">
                                            <option hidden selected>
                                                {{ $user->placement ? $user->placement->name : 'Choose placement' }}
                                            </option>
                                            @foreach ($placements as $placement)
                                                <option value="{{ $placement->id }}">{{ $placement->name }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="text" name="placement" id="placement"
                                            class="w-full border bg-gray-100 rounded p-2 focus:outline-none focus:border-blue-500"
                                            value="{{ $user->placement->name ??' N/A'}}" readonly>
                                    @endif
                                </div>
                            @endif

                            @if (Auth::user()->hasRole('admin') && Auth::id() == $user->id)
                            @else
                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Masa Aktif
                                        Mulai
                                        @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin'))
                                            <span class="text-red-600">*</span>
                                        @endif
                                    </label>
                                    <input type="date" name="period_start_date"
                                        value="{{ old('period_start_date', $user->period_start_date ? \Carbon\Carbon::parse($user->period_start_date)->format('Y-m-d') : '') }}"
                                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                        @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin')) required @endif>
                                </div>

                                <div class="space-y-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Masa Aktif
                                        Berakhir
                                        @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin'))
                                            <span class="text-red-600">*</span>
                                        @endif
                                    </label>
                                    <input type="date" name="period_end_date"
                                        value="{{ old('period_end_date', $user->period_end_date ? \Carbon\Carbon::parse($user->period_end_date)->format('Y-m-d') : '') }}"
                                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                                        @if (Auth::id() === $user->id && !Auth::user()->hasRole('admin')) required @endif>
                                </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- <script src="{{ asset('assets/js/user.js') }}"></script> --}}
    <script>
        let emailTimeoutId;
        let timeoutId;

        function validateITBAccount(email, id) {
            const feedback2 = document.getElementById("itb-account-feedback");
            feedback2.classList.add("hidden");
            feedback2.textContent = "";

            function checkDomain() {
                if (!email.endsWith("@itb.ac.id")) {
                    feedback2.textContent = "Email harus menggunakan domain @itb.ac.id";
                    feedback2.classList.remove("hidden");
                    feedback2.classList.add("text-red-500");
                }
            }
            checkDomain();

            clearTimeout(emailTimeoutId);
            emailTimeoutId = setTimeout(async () => {
                try {
                    const response = await fetch(
                        `../check-itb-account?itb_account=${email}&id=${id}`
                    );
                    const data = await response.json();

                    if (data.availableEmail) {
                        feedback2.textContent = "✅ Email tersedia!";
                        feedback2.classList.remove("text-red-500");
                        feedback2.classList.remove("text-yellow-500");
                        feedback2.classList.add("text-green-500");
                        checkDomain();
                    } else {
                        feedback2.textContent = "❌ Email sudah digunakan";
                        feedback2.classList.remove("text-green-500");
                        feedback2.classList.remove("text-yellow-500");
                        feedback2.classList.add("text-red-500");
                    }

                    feedback2.classList.remove("hidden");
                } catch (error) {
                    console.log(error);
                    feedback2.textContent = "⚠️ Gagal memeriksa email";
                    feedback2.classList.add("text-yellow-600");
                    feedback2.classList.remove("hidden");
                }
            }, 500);
        }

        function checkPasswordMatch(confirmPassword) {
            const password = document.querySelector('input[name="password"]').value;
            const feedback = document.getElementById("password-feedback");

            feedback.classList.add("hidden");

            if (password !== confirmPassword) {
                feedback.textContent = "Password tidak cocok!";
                feedback.classList.remove("hidden");
                feedback.classList.add("text-red-500");
            }
        }

        async function checkUsername(username, id) {
            const feedback = document.getElementById("username-feedback");

            feedback.classList.add("hidden");
            feedback.textContent = "";

            function textMin() {
                if (username.length < 3) {
                    feedback.textContent = "Username minimal 3 karakter";
                    feedback.classList.remove("hidden");
                    feedback.classList.remove("text-green-500");
                    feedback.classList.remove("text-red-500");
                    feedback.classList.add("text-yellow-500");
                    return;
                }
            }
            textMin();
            if (!/^[a-z0-9_]+$/.test(username)) {
                feedback.textContent =
                    "Hanya boleh huruf kecil, angka, dan underscore (_)";
                feedback.classList.remove("text-green-500");
                feedback.classList.remove("text-yellow-500");
                feedback.classList.remove("hidden");
                feedback.classList.add("text-red-500");
                return;
            }

            clearTimeout(timeoutId);
            timeoutId = setTimeout(async () => {
                try {
                    const response = await fetch(
                        `../check-username?username=${username}&id=${id}`
                    );
                    const data = await response.json();

                    if (data.available) {
                        feedback.textContent = "✅ Username tersedia!";
                        feedback.classList.remove("text-red-500");
                        feedback.classList.remove("text-yellow-500");
                        feedback.classList.add("text-green-500");
                        textMin();
                    } else {
                        feedback.textContent = "❌ Username sudah digunakan";
                        feedback.classList.remove("text-green-500");
                        feedback.classList.remove("text-yellow-500");
                        feedback.classList.add("text-red-500");
                    }

                    feedback.classList.remove("hidden");
                } catch (error) {
                    feedback.textContent = "⚠️ Gagal memeriksa username";
                    feedback.classList.add("text-yellow-600");
                    feedback.classList.remove("hidden");
                }
            }, 500);
        }
    </script>
    <script src="{{ asset('assets/js/togglePassword.js') }}"></script>
    <script src="{{ asset('assets/js/previewImageInput.js') }}"></script>
</body>

</html>
