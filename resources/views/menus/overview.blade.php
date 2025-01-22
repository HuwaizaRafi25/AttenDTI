@extends('layouts.app')
@section('content')
    <div class="lg:flex lg:flex-row gap-6">
        <div class="bg-white lg:w-3/4 md:w-full rounded-lg shadow-lg p-6">
            <p class="text-lg text-gray-600">Good Morning,</p>
            <p class="text-3xl font-semibold text-gray-800 mb-6">{{ Auth::user()->username }}!</p>
            <div class="flex items-center mb-6">
                <i class="far fa-calendar-alt text-blue-500 mr-2"></i>
                <div class="text-sm text-gray-600">Selasa, 14 Januari 2025</div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:shadow-md">
                    <p class="text-sm text-gray-500 mb-1">Masuk</p>
                    <p class="text-xl font-semibold text-gray-800">07:30</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:shadow-md">
                    <p class="text-sm text-gray-500 mb-1">Keluar</p>
                    <p class="text-xl font-semibold text-gray-800">17:00</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:shadow-md">
                    <p class="text-sm text-gray-500 mb-1">Total Hadir</p>
                    <p class="text-xl font-semibold text-gray-800">15 Hari</p>
                </div>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">History</h3>
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-2 md:mb-0">
                            <p class="text-sm font-semibold text-blue-600">2 Jan</p>
                        </div>
                        <div class="flex flex-col items-center mb-2 md:mb-0">
                            <p class="text-sm text-gray-500">Masuk</p>
                            <p class="font-semibold">07:30</p>
                        </div>
                        <div class="flex flex-col items-center mb-2 md:mb-0">
                            <p class="text-sm text-gray-500">Keluar</p>
                            <p class="font-semibold">17:00</p>
                        </div>
                        <div class="flex flex-col items-center mb-2 md:mb-0">
                            <p class="text-sm text-gray-500">Jam Total</p>
                            <p class="font-semibold">8:30</p>
                        </div>
                        <div class="flex flex-col items-center mb-2 md:mb-0">
                            <p class="text-sm text-gray-500"></p>
                            <p class="font-semibold"></p>
                        </div>
                    </div>
                    <div class="flex justify-center mt-2">
                        <div class="text-sm ml-12 text-gray-600">ITB Jatinangor</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 sticky top-20 md:w-full lg:w-1/4 mt-4 lg:mt-0">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Calendar</h3>
            <div class="h-[calc(100vh-4rem)] overflow-y-auto">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-center text-gray-600">Calendar placeholder</p>
                    <p class="text-center text-gray-400 text-sm mt-2">Implement your preferred calendar component
                        here</p>
                </div>
            </div>
        </div>
    </div>
@endsection
