@foreach ($users as $user)
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AttenDTI</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon">
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            .gradient-background {
                background: linear-gradient(90deg, #89f7fe 0%, #66a6ff 100%);
            }
        </style>
    </head>

    <body class="min-h-screen bg-gray-50 ">
        <a href="{{ route('overview') }}" class="fixed top-5 left-5 z-10">
            <i class="fas fa-arrow-left text-2xl text-black"></i>
        </a>

        <div class="w-full">
            <div class="relative">
                <div class="gradient-background h-64 md:h-80"></div>

                <div class="relative px-4 md:px-6 max-w-6xl mx-auto">
                    <div class="flex flex-col md:flex-row gap-8 -mt-32">
                        <!-- Profile Card -->
                        <div class="md:w-1/3">
                            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                                <div class="p-6 text-center">
                                    <div
                                        class="w-32 h-32 mx-auto mb-4 rounded-full border-4 border-white shadow-lg overflow-hidden bg-white">
                                        <img id="profilePreview"
                                            src="{{ $user->profile_pic ? asset('storage/profilePics/' . $user->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                                            alt="Profile Photo" class="w-full h-full object-cover">
                                    </div>
                                    <h1 class="text-2xl font-bold text-gray-800">{{ $user->full_name }}</h1>
                                    <p class="text-sm mt-1">
                                        <i class="fas fa-id-card mr-2"></i><strong>Identity Number: </strong><span
                                            class="text-gray-500">{{ $user->identity_number }}</span>
                                    </p>
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800 mt-3">
                                        <i class="fas fa-user-tag mr-2"></i>{{ $user->getRoleNames()->first() }}
                                    </span>
                                </div>
                                <div class="border-t border-gray-200 px-6 py-4">
                                    <p class="text-sm text-gray-600">
                                        <i class="fas fa-user mr-2"></i><strong>Username:</strong> {{ $user->username }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        <i class="fas fa-envelope mr-2"></i><strong>Email:</strong> {{ $user->email }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        <i class="fas fa-phone mr-2"></i><strong>Phone:</strong> {{ $user->phone }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="md:w-2/3">
                            <div class="bg-white rounded-lg shadow-xl p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-semibold text-gray-800">
                                        <i class="fas fa-info-circle mr-2"></i>Detailed Information
                                    </h2>
                                    <div class="flex items-center gap-4">
                                        @if (Auth::check() && Auth::user()->username === $user->username)
                                            <a href="{{ route('users.updateView', ['id' => $user->id]) }}" class="text-gray-600 hover:text-blue-500">
                                                <i class="fas fa-edit text-xl"></i>
                                            </a>
                                            <div class="relative" x-data="{ isOpen: false }">
                                                <button @click="isOpen = !isOpen" @click.away="isOpen = false"
                                                    class="text-gray-600 hover:text-blue-500">
                                                    <i class="fas fa-print text-xl"></i>
                                                </button>

                                                <div x-show="isOpen"
                                                    class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg z-50"
                                                    x-transition:enter="transition ease-out duration-100"
                                                    x-transition:enter-start="transform opacity-0 scale-95"
                                                    x-transition:enter-end="transform opacity-100 scale-100">
                                                    <div class="py-1">
                                                        <a href=""
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            Form Exit Clearance
                                                        </a>
                                                        <a href=""
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            Formulir Perjanjian Kerahasiaan
                                                        </a>
                                                        <a href=""
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            Interview Magang PKL
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">
                                            <i class="fas fa-venus-mars mr-2"></i>Gender
                                        </p>
                                        <p class="mt-1 text-sm text-gray-800">
                                            {{ $user->gender == 1 ? 'Male' : 'Female' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">
                                            <i class="fas fa-map-marker-alt mr-2"></i>Address
                                        </p>
                                        <p class="mt-1 text-sm text-gray-800">{{ $user->address }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">
                                            <i class="fas fa-university mr-2"></i>Institution
                                        </p>
                                        <p class="mt-1 text-sm text-gray-800">{{ $user->institution }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">
                                            <i class="fas fa-building mr-2"></i>Placement
                                        </p>
                                        <p class="mt-1 text-sm text-gray-800">
                                            {{ $user->placement ? $user->placement->name : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-500">
                                    <p class="text-sm font-medium text-gray-500">
                                        <i class="fas fa-calendar-check mr-2"></i>Total Attendance
                                    </p>
                                    <p class="mt-1 text-2xl flex font-semibold text-gray-800">12</p>
                                </div>
                                <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
                                    <p class="text-sm font-medium text-gray-500">
                                        <i class="fas fa-tasks mr-2"></i>Completed Task
                                    </p>
                                    <p class="mt-1 text-2xl font-semibold text-gray-800">8</p>
                                </div>
                                <div class="bg-white rounded-lg shadow p-4 border-l-4 border-yellow-500">
                                    <p class="text-sm font-medium text-gray-500">
                                        <i class="fas fa-clock mr-2"></i>Ongoing Tasks
                                    </p>
                                    <p class="mt-1 text-2xl font-semibold text-gray-800">4</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endforeach
