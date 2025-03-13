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
                                <div class="relative" x-data="{
                                    open: false,
                                    filters: { role: getURLParam('role'), status: getURLParam('status') },
                                    toggleFilter(type, value) {
                                        let currentUrl = new URL(window.location.href);
                                        let currentValue = currentUrl.searchParams.get(type);
                                        if (currentValue === value) {
                                            currentUrl.searchParams.delete(type);
                                        } else {
                                            currentUrl.searchParams.set(type, value);
                                        }
                                        window.location.href = currentUrl.toString();
                                    }
                                }">
                                    <button @click="open = !open"
                                        class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200">
                                        <span class="icon mr-1">{!! file_get_contents(public_path('assets/images/icons/filter.svg')) !!}</span>
                                        <span>Filter</span>
                                    </button>

                                    <div x-show="open" x-cloak @click.away="open = false"
                                        class="fixed -mt-6 md:mt-2 w-48 md:ml-0 ml-[116px] bg-white border-t rounded-md shadow-lg z-50">
                                        <div class="py-1">
                                            <a href="#" :class="{ 'bg-blue-100': filters.role === 'all' }"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="toggleFilter('role', 'all')">All</a>
                                            <a href="#" :class="{ 'bg-blue-100': filters.role === 'admin' }"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="toggleFilter('role', 'admin')">Admin</a>
                                            <a href="#" :class="{ 'bg-blue-100': filters.role === 'alumni' }"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="toggleFilter('role', 'alumni')">Alumni</a>
                                            <a href="#" :class="{ 'bg-blue-100': filters.role === 'user' }"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="toggleFilter('role', 'user')">User</a>
                                            <div class="border-t mx-2"></div>
                                            <a href="#" :class="{ 'bg-blue-100': filters.status === '1' }"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="toggleFilter('status', '1')">Online</a>
                                            <a href="#" :class="{ 'bg-blue-100': filters.status === '0' }"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="toggleFilter('status', '0')">Offline</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative" x-data="{
                                    open: false,
                                    activeSort: getURLParam('sort'),
                                    activeDirection: getURLParam('direction'),
                                    applySort(column, direction) {
                                        let currentUrl = new URL(window.location.href);
                                        currentUrl.searchParams.set('sort', column);
                                        currentUrl.searchParams.set('direction', direction);
                                        window.location.href = currentUrl.toString();
                                    }
                                }">
                                    <button @click="open = !open"
                                        class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200">
                                        <span class="icon mr-1">{!! file_get_contents(public_path('assets/images/icons/sort.svg')) !!}</span>
                                        <span>Sort</span>
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false"
                                        class="fixed md:ml-0 ml-[116px] md:mt-2 -mt-6 w-48 bg-white border-t rounded-md shadow-lg z-10">
                                        <div class="py-1">
                                            <a href="#"
                                                :class="activeSort === 'full_name' && activeDirection === 'asc' ?
                                                    'bg-blue-100' : ''"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="applySort('full_name', 'asc')">Full Name (A-Z)</a>
                                            <a href="#"
                                                :class="activeSort === 'full_name' && activeDirection === 'desc' ?
                                                    'bg-blue-100' : ''"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="applySort('full_name', 'desc')">Full Name (Z-A)</a>
                                            <a href="#"
                                                :class="activeSort === 'username' && activeDirection === 'asc' ?
                                                    'bg-blue-100' : ''"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="applySort('username', 'asc')">Username (A-Z)</a>
                                            <a href="#"
                                                :class="activeSort === 'username' && activeDirection === 'desc' ?
                                                    'bg-blue-100' : ''"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="applySort('username', 'desc')">Username (Z-A)</a>
                                            <a href="#"
                                                :class="activeSort === 'institution' && activeDirection === 'asc' ?
                                                    'bg-blue-100' : ''"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="applySort('institution', 'asc')">Institution (A-Z)</a>
                                            <a href="#"
                                                :class="activeSort === 'institution' && activeDirection === 'desc' ?
                                                    'bg-blue-100' : ''"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                @click.prevent="applySort('institution', 'desc')">Institution (Z-A)</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-px h-6 bg-gray-300 hidden"></div>


                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open"
                                        class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200">
                                        <span class="icon mr-1">{!! file_get_contents(public_path('assets/images/icons/export.svg')) !!}</span>
                                        <span>Export</span>
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false"
                                        class="fixed -mt-6 md:mt-2 md:ml-0 ml-[116px] w-48 bg-white border-t rounded-md shadow-lg z-10">
                                        <div class="py-1">
                                            <a href="{{ route('users.export', ['type' => 'pdf']) . '?' . http_build_query(request()->query()) }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor
                                                sebagai
                                                <b>PDF</b></a>
                                            <a href="{{ route('users.export', ['type' => 'xlsx']) . '?' . http_build_query(request()->query()) }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor
                                                sebagai
                                                <b>Excel</b></a>
                                            <a href="{{ route('users.export', ['type' => 'xlsx']) . '?' . http_build_query(request()->query()) }}"
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

                                <div class="h-5 w-0.5 border border-gray-700"></div>

                                {{-- Select Option bulan dan tahun --}}
                                <!-- Month and Year Selectors -->
                                <div class="flex items-center gap-2">
                                    <!-- Month Selector -->
                                    <div class="relative" id="monthSelector">
                                        <button id="monthButton"
                                            class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200 bg-white border border-gray-200 rounded-md px-3 py-1.5">
                                            <span class="icon mr-1">{!! file_get_contents(public_path('assets/images/icons/calendar.svg')) !!}</span>
                                            <span id="selectedMonth">January</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <div id="monthDropdown"
                                            class="absolute mt-1 w-40 bg-white border rounded-md shadow-lg z-10 hidden">
                                            <div class="py-1 max-h-60 overflow-y-auto">
                                                @php
                                                    $months = [
                                                        'January',
                                                        'February',
                                                        'March',
                                                        'April',
                                                        'May',
                                                        'June',
                                                        'July',
                                                        'August',
                                                        'September',
                                                        'October',
                                                        'November',
                                                        'December',
                                                    ];
                                                @endphp

                                                @foreach ($months as $month)
                                                    <button data-month="{{ $month }}"
                                                        class="month-option block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $month === 'January' ? 'bg-blue-50 text-blue-600 font-medium' : '' }}">
                                                        {{ $month }}
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                        <input type="hidden" name="month" id="monthInput" value="January">
                                    </div>

                                    <!-- Year Selector -->
                                    <div class="relative" id="yearSelector">
                                        <button id="yearButton"
                                            class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200 bg-white border border-gray-200 rounded-md px-3 py-1.5">
                                            <span id="selectedYear">{{ date('Y') }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <div id="yearDropdown"
                                            class="absolute mt-1 w-32 bg-white border rounded-md shadow-lg z-10 hidden">
                                            <div class="py-1 max-h-60 overflow-y-auto">
                                                @php
                                                    $currentYear = date('Y');
                                                    $years = range($currentYear, $currentYear - 9);
                                                @endphp

                                                @foreach ($years as $year)
                                                    <button data-year="{{ $year }}"
                                                        class="year-option block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $year == $currentYear ? 'bg-blue-50 text-blue-600 font-medium' : '' }}">
                                                        {{ $year }}
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                        <input type="hidden" name="year" id="yearInput"
                                            value="{{ date('Y') }}">
                                    </div>
                                </div>

                                <script>
                                    // Month Selector
                                    const monthButton = document.getElementById('monthButton');
                                    const monthDropdown = document.getElementById('monthDropdown');
                                    const selectedMonth = document.getElementById('selectedMonth');
                                    const monthOptions = document.querySelectorAll('.month-option');
                                    const monthInput = document.getElementById('monthInput');

                                    // Year Selector
                                    const yearButton = document.getElementById('yearButton');
                                    const yearDropdown = document.getElementById('yearDropdown');
                                    const selectedYear = document.getElementById('selectedYear');
                                    const yearOptions = document.querySelectorAll('.year-option');
                                    const yearInput = document.getElementById('yearInput');

                                    // Toggle month dropdown
                                    monthButton.addEventListener('click', function() {
                                        monthDropdown.classList.toggle('hidden');
                                        // Close year dropdown if open
                                        yearDropdown.classList.add('hidden');
                                    });

                                    // Toggle year dropdown
                                    yearButton.addEventListener('click', function() {
                                        yearDropdown.classList.toggle('hidden');
                                        // Close month dropdown if open
                                        monthDropdown.classList.add('hidden');
                                    });

                                    // Handle month selection
                                    monthOptions.forEach(option => {
                                        option.addEventListener('click', function() {
                                            const month = this.getAttribute('data-month');
                                            selectedMonth.textContent = month;
                                            monthInput.value = month;

                                            // Update active class
                                            monthOptions.forEach(opt => {
                                                opt.classList.remove('bg-blue-50', 'text-blue-600', 'font-medium');
                                            });
                                            this.classList.add('bg-blue-50', 'text-blue-600', 'font-medium');

                                            // Close dropdown
                                            monthDropdown.classList.add('hidden');
                                        });
                                    });

                                    // Handle year selection
                                    yearOptions.forEach(option => {
                                        option.addEventListener('click', function() {
                                            const year = this.getAttribute('data-year');
                                            selectedYear.textContent = year;
                                            yearInput.value = year;

                                            // Update active class
                                            yearOptions.forEach(opt => {
                                                opt.classList.remove('bg-blue-50', 'text-blue-600', 'font-medium');
                                            });
                                            this.classList.add('bg-blue-50', 'text-blue-600', 'font-medium');

                                            // Close dropdown
                                            yearDropdown.classList.add('hidden');
                                        });
                                    });

                                    // Close dropdowns when clicking outside
                                    document.addEventListener('click', function(event) {
                                        if (!monthButton.contains(event.target) && !monthDropdown.contains(event.target)) {
                                            monthDropdown.classList.add('hidden');
                                        }

                                        if (!yearButton.contains(event.target) && !yearDropdown.contains(event.target)) {
                                            yearDropdown.classList.add('hidden');
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="flex">
                            <!-- Search Bar -->
                            <div class="relative inline-block h-12 w-12 -mr-6">
                                <input {{-- lg:w-64 md:w-[196px] w-[164px] transition-all transform duration-300 --}}
                                    class="-mr-3 search expandright absolute right-[49px] rounded bg-white border border-white h-8 w-0 lg:focus:w-[190px] md:focus:w-[164px] focus:w-[148px]  transition-all duration-400 outline-none z-10 focus:px-4 focus:border-blue-500"
                                    id="searchright" type="text" name="q" placeholder="Cari">
                                <label class="z-20 button searchbutton absolute text-[22px] w-full cursor-pointer"
                                    for="searchright">
                                    <span class="-ml-3 mt-1 inline-block">
                                        <span class="icon ">
                                            {!! file_get_contents(public_path('assets/images/icons/search.svg')) !!}
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <button
                                class="add-button -mt-1 max-h-10 flex items-center bg-[#187bcd] text-white font-semibold px-4 text-sm rounded hover:bg-[#4f57a5] transition duration-200">
                                <span class="icon mr-2 scale-150">
                                    {!! file_get_contents(public_path('assets/images/icons/plus.svg')) !!}
                                </span>
                                Attend User
                            </button>
                        </div>
                    </div>
                    <div id="attendance-table" class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="attendanceTable">
                            <thead class="bg-gray-100 sticky top-0">
                                <tr class="text-gray-600 uppercase text-xs font-medium">
                                    <th class="px-4 py-3 text-center">No</th>
                                    <th class="px-4 py-3 text-center">NISN</th>
                                    <th class="px-4 py-3 text-center">Name</th>
                                    <th class="px-4 py-3 text-center">Institution</th>

                                    @foreach ($dates as $date)
                                        <th
                                            class="px-4 py-3 text-center
                                            {{ \Carbon\Carbon::parse($date)->isToday() ? 'text-blue-800 text-lg' : '' }}
                                            {{ \Carbon\Carbon::parse($date)->isWeekend() ? 'text-gray-600' : '' }}
                                            {{ in_array(\Carbon\Carbon::parse($date)->format('Y-m-d'), $holidays) ? 'text-red-600' : '' }}
                                            {{ !\Carbon\Carbon::parse($date)->isToday() && !\Carbon\Carbon::parse($date)->isWeekend() ? 'text-gray-800' : '' }}">
                                            {{ \Carbon\Carbon::parse($date)->translatedFormat('d') }}
                                        </th>
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
        <script src="{{ asset('assets/js/attendance.js') }}"></script>
    @else
        <style>
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeIn 0.2s ease-out forwards;
                opacity: 0;
            }

            /* Ensure the modal has a nice transition */
            #absentModal {
                transition: opacity 0.2s ease-out;
            }

            /* Smooth transitions for the placement container */
            #placementContainer {
                transition: opacity 0.3s ease-out;
            }
        </style>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-8">
                <div class="flex flex-col gap-4 md:flex-row items-center justify-between mb-8">
                    @if (Auth::user()->attendances->where('created_at', '>=', today()->startOfDay())->where('created_at', '<=', today()->endOfDay())->count() > 0)
                        <div class="text-center md:text-left mb-6 md:mb-0">
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Good Morning, {{ Auth::user()->full_name }}!
                            </h2>
                            <p class="text-lg text-gray-600">You've marked your presence today. Keep up the good work!</p>
                        </div>
                    @else
                        <div class="text-center md:text-left mb-6 md:mb-0">
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Hello! Ready to start your day?</h2>
                            <p class="text-lg text-gray-600">Let's mark your presence and make today count!</p>
                        </div>
                        <div class="flex gap-x-4">
                            <button onclick="window.location.href='{{ route('attendance.request', Auth::id()) }}'"
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                <i class="fas fa-check-circle mr-2"></i> I'm Here!
                            </button>
                            <button onclick="showAbsentModal()"
                                class="absentButton bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-6 rounded-full transition-all duration-300 flex items-center shadow-md hover:shadow-lg transform hover:-translate-y-1">
                                <i class="fas fa-times-circle mr-2"></i> Not Today
                            </button>
                        </div>
                    @endif
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
        @include('menus.modals.attendance.absent_attendance_modal')
        <script src="{{ asset('assets/js/clock.js') }}"></script>
        <script src="{{ asset('assets/js/userAttendance.js') }}"></script>
    @endif
@endsection
