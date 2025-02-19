@extends('layouts.app')
@section('content')
    @if (Auth::user()->hasRole('admin') || Auth::user()->can('manage_attendance'))
        <style>
            #optionsMenu.show {
                display: block;
                position: absolute !important;
                left: 44px;
                margin-top: 24px;
                z-index: 50;
                width: 128px;
            }

            #moreButton.open+#optionsMenu {
                display: block;
            }

            [x-cloak] {
                display: none;
            }
        </style>
        <div class="">
            {{-- <nav class="flex pb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ url('/') }}"
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
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">User Managemet</span>
                    </div>
                </li>
            </ol>
        </nav> --}}
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between w-full items-center mb-2">
                        <div class="flex flex-col sm:flex-row justify-between gap-y-2 items-start mb-4">
                            <img src="{{ asset('assets/images/icons/more.svg') }}"
                                class="w-4 opacity-75 block ml-4 md:hidden cursor-pointer" alt="moreButton" id="moreButton">
                            <h3 class="text-xl font-semibold mb-2 ml-4 hidden lg:block">Attendance Management</h3>
                            <div id="optionsMenu"
                                class="hidden md:relative md:flex md:flex-row md:space-y-0 md:space-x-4 bg-white md:bg-transparent p-3 md:p-0 rounded-md md:rounded-none shadow-xl md:border-none border-t-2 md:shadow-none items-center space-y-2 mt-3 md:mt-0 ml-4 !relative"
                                style="">
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open"
                                        class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200">
                                        <span class="icon mr-1">{!! file_get_contents(public_path('assets/images/icons/export.svg')) !!}</span>
                                        <span>Export</span>
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false"
                                        class="fixed -mt-6 md:mt-2 md:ml-0 ml-[116px] w-48 bg-white border-t rounded-md shadow-lg z-10">
                                        <div class="py-1">
                                            <a href="{{ route('attendances.export', ['type' => 'pdf']) . '?' . http_build_query(request()->query()) }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor
                                                sebagai
                                                <b>PDF</b></a>
                                            <a href="{{ route('attendances.export', ['type' => 'xlsx']) . '?' . http_build_query(request()->query()) }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor
                                                sebagai
                                                <b>Excel</b></a>
                                            <a href="{{ route('attendances.export', ['type' => 'xlsx']) . '?' . http_build_query(request()->query()) }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor
                                                sebagai
                                                <b>CSV</b></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Print Button -->
                                {{-- onclick="printData('userTable', 'Daftar Pengguna')" --}}
                                <button id="printUserButton"
                                    class="flex items-center text-gray-700 hover:text-green-600 transition duration-200">
                                    <span class="icon mr-1">{!! file_get_contents(public_path('assets/images/icons/printer.svg')) !!}</span>
                                    <span>Print</span>
                                </button>

                                <hr class="h-6 border-gray-800 md:block">


                            </div>
                        </div>
                        <div class="flex">
                            <button
                                class="add-button -mt-1 h-10 flex items-center bg-[#187bcd] text-white font-semibold px-4 text-sm rounded hover:bg-[#4f57a5] transition duration-200">
                                <span class="icon mr-2 scale-150">
                                    {!! file_get_contents(public_path('assets/images/icons/plus.svg')) !!}
                                </span>
                                Attend
                            </button>
                        </div>
                    </div>
                    <div id="attendance-table" class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="attendanceTable">
                            <thead class="bg-gray-100 sticky top-0 z-10">
                                <tr class="text-gray-600 uppercase text-xs font-medium">
                                    <th class="px-4 py-3 text-center">No</th>
                                    <th class="px-4 py-3 text-center">NISN</th>
                                    <th class="px-4 py-3 text-center">Name</th>
                                    <th class="px-4 py-3 text-center">Institution</th>
                                    {{-- Kolom tanggal berdasarkan jumlah hari dalam bulan terpilih --}}
                                    @foreach ($dates as $date)
                                        <th class="px-4 py-3 text-center">
                                            {{ \Carbon\Carbon::parse($date)->translatedFormat('d') }} </th>
                                    @endforeach
                                    <th class="px-4 py-3 text-center">Present</th>
                                    <th class="px-4 py-3 text-center">Total Days</th>
                                    <th class="px-4 py-3 text-center">Attendance</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-600">
                                @include('menus.tables.attendance_table', ['users' => $users])
                            </tbody>
                        </table>
                    </div>
                    <div class="hidden" id="userReportTable">
                        <div class="mb-6">
                            <p>
                                <strong>Waktu Laporan:</strong>
                                {{-- @if ($start_date && $end_date)
                                {{ \Carbon\Carbon::parse($start_date)->translatedFormat('d M Y') }} -
                                {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d M Y') }}
                            @else --}}
                                Semua waktu
                                {{-- @endif --}}
                            </p>
                            <p><strong>Disusun Oleh:</strong> Admin Wasuhin</p>
                        </div>

                        {{-- <table class="w-full table-fixed border-collapse border border-gray-300 text-sm">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 w-12 p-2">No</th>
                                <th class="border border-gray-300 p-2">Nomor Identitas</th>
                                <th class="border border-gray-300 p-2">Nama</th>
                                <th class="border border-gray-300 p-2">Akun ITB</th>
                                <th class="border border-gray-300 p-2">Institusi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) <= 0)
                                <tr>
                                    <td class="border border-gray-300 p-2 text-center" colspan="5">Data transaksi
                                        kosong
                                    </td>
                                </tr>
                            @else
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="border border-gray-300 whitespace-nowrap w-min p-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="border border-gray-300 text-wrap flex-wrap p-2">{{ $user->identity_number ? $user->identity_number : '-' }}
                                        </td>
                                        <td class="border border-gray-300 text-wrap p-2">{{ $user->full_name }}
                                        </td>
                                        <td class="border border-gray-300 text-wrap flex-wrap p-2">{{ $user->itb_account }}
                                        </td>
                                        <td class="border border-gray-300 text-wrap p-2">{{ $user->institution ? $user->institution : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table> --}}
                        <div class="mt-10 flex flex-col items-end w-full h-min justify-end">
                            <div class="text-right flex gap-x-1">
                                <p class="text-base text-gray-800">Admin</p>
                                <p class="text-base text-gray-800">DTI ITB,</p>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="mt-10 text-right">
                                <p class="text-md font-medium text-gray-700">{{ Auth::user()->full_name }}</p>
                                <div class="border-b border-gray-400 w-32 mt-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script>
            const printCssPath = "{{ asset('assets/css/app.css') }}";
        </script>
        <script>
            document.getElementById("moreButton").addEventListener("click", function() {
                var optionsMenu = document.getElementById("optionsMenu");
                optionsMenu.classList.toggle("show");
            });

            window.addEventListener("resize", function() {
                var optionsMenu = document.getElementById("optionsMenu");
                if (optionsMenu.classList.contains("show")) {
                    optionsMenu.classList.remove("show");
                }
            });
        </script>
        <script src="{{ asset('assets/js/user.js') }}"></script>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-8">
                <div class="flex flex-col gap-4 md:flex-row items-center justify-between mb-8">
                    <div class="text-center md:text-left mb-6 md:mb-0">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Hello! Ready to start your day?</h2>
                        <p class="text-lg text-gray-600">Let's mark your presence and make today count!</p>
                    </div>
                    <div class="flex gap-x-4">
                        <button onclick="window.location.href='{{ route('attendance.request', Auth::id()) }}'"
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
                        <circle cx="50" cy="50" r="48" fill="none" stroke="#E5E7EB"
                            stroke-width="2" />
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#CBD5E0"
                            stroke-width="2" />
                        <!-- Clock numbers -->
                        <text x="50" y="18" text-anchor="middle" font-size="8" class="font-bold"
                            fill="#4B5563">12</text>
                        <text x="88" y="53" text-anchor="middle" font-size="8" class="font-bold"
                            fill="#4B5563">3</text>
                        <text x="50" y="88" text-anchor="middle" font-size="8" class="font-bold"
                            fill="#4B5563">6</text>
                        <text x="14" y="53" text-anchor="middle" font-size="8" class="font-bold"
                            fill="#4B5563">9</text>
                        <!-- Clock hands -->
                        <circle cx="50" cy="50" r="3" fill="#1F2937" />
                        <line id="hourHand" class="clock-hand" x1="50" y1="50" x2="50"
                            y2="30" stroke-linecap="round" />
                        <line id="minuteHand" class="clock-hand" x1="50" y1="50" x2="50"
                            y2="25" stroke-linecap="round" />
                        <line id="secondHand" class="clock-hand" x1="50" y1="50" x2="50"
                            y2="20" stroke-linecap="round" />
                    </svg>
                    <p class="text-4xl font-bold text-blue-600 mb-2" id="currentTime"></p>
                    <p class="text-lg text-gray-600" id="currentDate"></p>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/clock.js') }}"></script>
    @endif
@endsection
