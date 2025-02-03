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
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Dukungan</span>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Pusat Bantuan</span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div
                class="flex flex-col bg-white overflow-hidden shadow-xl p-6 font-bold text-lg text-gray-700 sm:rounded-lg">
                <h1>
                    Bagaimana Kami Bisa Membantu Anda?
                </h1>
                <div class="relative w-full py-2" style="z-index: 2">

                        <span class="icon scale-125 z-10 absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">
                            {!! file_get_contents(public_path('assets/images/icons/search.svg')) !!}
                        </span>
                    <input type="text"
                        class="w-full font-light text-base py-3 rounded-lg border border-gray-300 bg-gray-100 text-gray-700 focus:outline-none focus:border-blue-500 focus:bg-white"
                        style="padding-left: 40px; z-index: 1" placeholder="Cari artikel bantuan...">
                </div>
            </div>
            <div
                class="flex flex-col bg-white overflow-hidden shadow-xl p-6 mt-4 font-bold text-base text-gray-700 sm:rounded-lg">
                <h2>
                    Topik Populer
                </h2>

                <!-- Grid untuk card-card -->
                <div class="grid grid-cols-3 gap-6 mt-6">
                    <!-- Card 1 -->
                    <div
                        class="bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
                        <img src="{{ asset('assets/images/logoti.png') }}" alt="Cara Mulai Image" class="w-full my-4 h-24 object-contain rounded-md opacity-80">
                        <h3 class="text-lg font-semibold mt-9">Cara Mulai</h3>
                        <p class="text-gray-600 mt-2 text-sm font-light">Temukan cara mudah untuk mendaftar, login, dan mulai menggunakan layanan laundry Wasuhinku.</p>
                    </div>
                    <!-- Card 2 -->
                    <div
                        class="bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
                        <img src="{{ asset('assets/images/laundry3.png') }}"
                            alt="Pengelolaan Desain Image" class="w-full h-36 object-contain rounded-md opacity-90">
                        <h3 class="text-lg font-semibold mt-1">Pengelolaan Laundry</h3>
                        <p class="text-gray-600 mt-2 text-sm font-light">Pelajari cara mengelola pakaian dan pesanan laundry dengan lebih efisien di Wasuhinku.</p>
                    </div>
                    <!-- Card 3 -->
                    <div
                        class="bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
                        <img src="{{ asset('assets/images/laundry2.png') }}"
                            alt="Proses Pesanan Image" class="w-full h-32 object-contain rounded-md">
                        <h3 class="text-lg font-semibold mt-4">Proses Pesanan</h3>
                        <p class="text-gray-600 mt-2 text-sm font-light">Panduan langkah demi langkah dalam memproses dan mengelola pesanan laundry pelanggan.</p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-6 mt-6">
                    <!-- Card 4 -->
                    <div
                        class="bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
                        <img src="{{ asset('assets/images/accset.png') }}"
                            alt="Pengaturan Akun Image" class="w-full h-32 object-contain rounded-md">
                        <h3 class="text-lg font-semibold mt-4">Pengaturan Akun</h3>
                        <p class="text-gray-600 mt-2 text-sm font-light">Petunjuk untuk memperbarui profil pengguna dan mengatur preferensi akun Anda.</p>
                    </div>
                    <!-- Card 5 -->
                    <div
                        class="bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
                        <img src="{{ asset('assets/images/purchase.png') }}"
                            alt="Harga & Faktur Image" class="w-full h-32 object-contain rounded-md">
                        <h3 class="text-lg font-semibold mt-4">Harga & Faktur</h3>
                        <p class="text-gray-600 mt-2 text-sm font-light">Informasi mengenai struktur harga dan cara mengelola faktur serta pembayaran laundry Anda.</p>
                    </div>
                    <!-- Card 6 -->
                    <div
                        class="bg-gray-100 p-4 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
                        <img src="{{ asset('assets/images/support.png') }}"
                            alt="Dukungan Pelanggan Image" class="w-full h-32 object-contain rounded-md">
                        <h3 class="text-lg font-semibold mt-4">Dukungan Pelanggan</h3>
                        <p class="text-gray-600 mt-2 text-sm font-light">Hubungi tim dukungan kami atau temukan solusi cepat untuk masalah umum yang sering dihadapi pelanggan.</p>
                    </div>
                </div>
            </div>
        </div>
@endsection
