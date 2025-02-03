<!-- resources/views/contact/index.blade.php -->
@extends('layouts.app')
@section('content')
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Hubungi Kami</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div
                class="flex justify-between bg-white overflow-hidden shadow-xl p-24 font-bold text-lg text-gray-700 sm:rounded-lg gap-2">
                <div class="flex flex-col">
                    <h1 class="text-4xl">
                        Hubungi Kami
                    </h1>
                    <p class="text-gray-500 font-light max-w-96 text-wrap flex-wrap">
                        Kalau kamu punya pertanyaan atau butuh bantuan soal layanan laundry kami,
                        langsung aja hubungi tim *Wasuhin*. Kami siap bantu, kok!
                    </p>
                    <!-- Contact Information Section -->
                    <div class="flex flex-col gap-4 mt-6">
                        <!-- Email -->
                        <div class="flex items-center space-x-2">
                            <i class='bx bxs-envelope text-2xl text-indigo-600'></i>
                            <p class="text-gray-700">Email:
                                <a href="mailto:wasuhin@example.com"
                                    class="text-indigo-600 hover:underline">support@wasuhin.com</a>
                            </p>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-center space-x-2">
                            <i class='bx bxs-phone-call text-2xl text-indigo-600'></i>
                            <p class="text-gray-700">Telepon:
                                <a href="tel:+628123456789" class="text-indigo-600 hover:underline">+62 812 3456 789</a>
                            </p>
                        </div>

                        <!-- Location -->
                        <div class="flex items-center space-x-2">
                            <i class='bx bxs-map text-2xl text-indigo-600'></i>
                            <p class="text-gray-700">Lokasi:
                                <a href="https://maps.app.goo.gl/WasuhinLocation" target="_blank"
                                    class="text-indigo-600 hover:underline">Jalan Cuci Bersih No. 10, Bandung</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <img src="{{ asset('assets/images/laundry4.png') }}" class="w-80"
                        alt="Hubungi Wasuhin">
                </div>
            </div>
        </div>
    </div>
@endsection
