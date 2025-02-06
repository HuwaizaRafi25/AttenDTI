@extends('layouts.app')
@section('content')
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
                        <h3 class="text-xl font-semibold mb-2 ml-4 hidden lg:block">User Management</h3>
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
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor sebagai
                                            <b>PDF</b></a>
                                        <a href="{{ route('users.export', ['type' => 'xlsx']) . '?' . http_build_query(request()->query()) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor sebagai
                                            <b>Excel</b></a>
                                        <a href="{{ route('users.export', ['type' => 'xlsx']) . '?' . http_build_query(request()->query()) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor sebagai
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
                            class="add-button -mt-1 max-h-10 flex items-center bg-[#545DB0ff] text-white font-semibold px-4 text-sm rounded hover:bg-[#4f57a5] transition duration-200">
                            <span class="icon mr-2 scale-150">
                                {!! file_get_contents(public_path('assets/images/icons/plus.svg')) !!}
                            </span>
                            User
                        </button>
                    </div>
                </div>
                <div id="user-table" class="w-full overflow-x-scroll">
                        <table class="min-w-full w-full table-auto" id="userTable">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 pl-3 text-center">NO</th>
                                    <th class="py-3 pl-6 text-left">User</th>
                                    <th class="py-3 pl-6 text-left hidden printable">Email</th>
                                    <th class="py-3 pl-6 text-left">Institution</th>
                                    {{-- <th class="py-3 px-6 text-center no-print">Status</th> --}}
                                    <th class="py-3 px-6 text-center">Role</th>
                                    <th class="py-3 px-6 text-center no-print">Action</th>
                                </tr>
                            </thead>
                            <tbody id="content" class="text-gray-600 text-sm font-light">
                                @include('menus.tables.user_table', ['users' => $users])
                            </tbody>
                        </table>
                </div>
                <div id="pagination-container" class="mt-4">
                    {{ $users->links() }}
                </div>

                <div class="hidden" id="userReportTable">
                    <div class="mb-6">
                        <p>
                            <strong>Waktu Laporan:</strong>
                            {{-- @if($start_date && $end_date)
                                {{ \Carbon\Carbon::parse($start_date)->translatedFormat('d M Y') }} -
                                {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d M Y') }}
                            @else --}}
                                Semua waktu
                            {{-- @endif --}}
                        </p>
                        <p><strong>Disusun Oleh:</strong> Admin Wasuhin</p>
                    </div>

                    <table class="w-full table-fixed border-collapse border border-gray-300 text-sm">
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
                    </table>
                    <div class="mt-10 flex flex-col items-end">
                        <div class="text-right flex gap-x-1">
                                <p class="text-base text-gray-800">Admin</p>
                                <p class="text-base text-gray-800">DTI ITB,</p>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="mt-10 text-right">
                            <p class="text-md font-medium text-gray-700">{{ Auth::user()->nama }}</p>
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
@endsection
