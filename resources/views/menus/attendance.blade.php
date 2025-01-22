@extends('layouts.app')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-8">
            <div class="flex flex-col gap-4 md:flex-row items-center justify-between mb-8">
                <div class="text-center md:text-left mb-6 md:mb-0">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Hello! Ready to start your day?</h2>
                    <p class="text-lg text-gray-600">Let's mark your presence and make today count!</p>
                </div>
                <div class="flex gap-x-4">
                    <button
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-1">
                        <i class="fas fa-check-circle mr-2"></i> I'm Here!
                    </button>
                    <button
                        class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-1">
                        <i class="fas fa-times-circle mr-2"></i> Not Today
                    </button>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Attendance Summary</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-blue-100 p-6 rounded-xl hover-lift shadow-md">
                    <div class="flex items-start justify-between text-blue-500 gap-x-2 mb-2">
                        <i class="fas fa-user-check text-4xl mb-3"></i>
                        <i class="fas fa-circle-info text-lg opacity-60 hover:opacity-90 -mt-2 -mr-2"></i>
                    </div>
                    <p class="text-5xl font-bold text-blue-600 mb-1">18</p>
                    <p class="font-medium text-xl text-gray-600">Present</p>
                </div>
                <div class="bg-green-100 p-6 rounded-xl hover-lift shadow-md">
                    <div class="flex items-start justify-between text-green-500 gap-x-2 mb-2">
                        <i class="fas fa-clock text-4xl mb-3"></i>
                        <i class="fas fa-circle-info text-lg opacity-60 hover:opacity-90 -mt-2 -mr-2"></i>
                    </div>
                    <p class="text-5xl font-bold text-green-600 mb-1">16</p>
                    <p class="font-medium text-xl text-gray-600">On Time</p>
                </div>
                <div class="bg-yellow-100 p-6 rounded-xl hover-lift shadow-md">
                    <div class="flex items-start justify-between text-yellow-500 gap-x-2 mb-2">
                        <i class="fas fa-hourglass-half text-4xl mb-3"></i>
                        <i class="fas fa-circle-info text-lg opacity-60 hover:opacity-90 -mt-2 -mr-2"></i>
                    </div>
                    <p class="text-5xl font-bold text-yellow-600 mb-1">2</p>
                    <p class="font-medium text-xl text-gray-600">Late</p>
                </div>
                <div class="bg-red-100 p-6 rounded-xl hover-lift shadow-md">
                    <div class="flex items-start justify-between text-red-500 gap-x-2 mb-2">
                        <i class="fas fa-user-times text-4xl mb-3"></i>
                        <i class="fas fa-circle-info text-lg opacity-60 hover:opacity-90 -mt-2 -mr-2"></i>
                    </div>
                    <p class="text-5xl font-bold text-red-600 mb-1">10</p>
                    <p class="font-medium text-xl text-gray-600">Absent</p>
                </div>
            </div>
        </div>

        <div class="col-span-1 bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Current Time</h2>
            <div class="flex flex-col items-center">
                <svg class="w-64 h-64 mb-6" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="48" fill="none" stroke="#E5E7EB" stroke-width="2" />
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#CBD5E0" stroke-width="2" />
                    <!-- Clock numbers -->
                    <text x="50" y="18" text-anchor="middle" font-size="8" class="font-bold" fill="#4B5563">12</text>
                    <text x="88" y="53" text-anchor="middle" font-size="8" class="font-bold" fill="#4B5563">3</text>
                    <text x="50" y="88" text-anchor="middle" font-size="8" class="font-bold" fill="#4B5563">6</text>
                    <text x="14" y="53" text-anchor="middle" font-size="8" class="font-bold" fill="#4B5563">9</text>
                    <!-- Clock hands -->
                    <circle cx="50" cy="50" r="3" fill="#1F2937" />
                    <line id="hourHand" class="clock-hand" x1="50" y1="50" x2="50" y2="30"
                        stroke-linecap="round" />
                    <line id="minuteHand" class="clock-hand" x1="50" y1="50" x2="50" y2="25"
                        stroke-linecap="round" />
                    <line id="secondHand" class="clock-hand" x1="50" y1="50" x2="50" y2="20"
                        stroke-linecap="round" />
                </svg>
                <p class="text-4xl font-bold text-blue-600 mb-2" id="currentTime"></p>
                <p class="text-lg text-gray-600" id="currentDate"></p>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/clock.js') }}"></script>

@endsection
