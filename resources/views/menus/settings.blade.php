@extends('layouts.app')
@section('content')
    {{-- <nav class="flex pb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Dasbor
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Setelan Umum</span>
                </div>
            </li>
        </ol>
    </nav> --}}
    <div class="py-3 flex justify-center">
        <div class=" w-full bg-white shadow-lg rounded-lg p-8">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">

                    <!-- Logo Perusahaan -->
                    <div class="flex justify-center">
                        <label for="userProfileImageInput" class="cursor-pointer relative">
                            <img id="userProfileImage"
                                src="{{ asset('assets/images/logoti.png') }}"
                                alt="Logo Perusahaan"
                                class="w-32 h-32 object-cover">
                            <div
                                class="absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-md transform translate-x-1/2 translate-y-1/2">
                                <span class="text-gray-600">
                                    {!! file_get_contents(public_path('assets/images/icons/pencil.svg')) !!}
                                </span>
                            </div>
                        </label>
                        <input type="file" name="referenceImage" id="userProfileImageInput" accept="image/*"
                            class="hidden" onchange="previewImageProfilePic(event, 'userProfileImage')" required>
                    </div>

                    <!-- Nama Perusahaan -->
                    <div class="flex flex-col">
                        <label for="companyName" class="text-sm font-semibold text-gray-700">Nama Perusahaan</label>
                        <input type="text" id="companyName" name="companyName"
                            class="mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="Wasuhin">
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="flex flex-col">
                        <label for="phoneNumber" class="text-sm font-semibold text-gray-700">Nomor Telepon</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber"
                            class="mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('phoneNumber', '+62 812 3456 7890') }}">
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col">
                        <label for="email" class="text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" id="email" name="email"
                            class="mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('email', 'contact@wasuhin.com') }}">
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-center">
                        <button type="submit"
                            class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
                            Simpan
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
