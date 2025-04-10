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
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-xl sm:rounded-lg">
                <div class="flex items-center justify-between w-full mb-2">
                    <div class="flex flex-col items-start justify-between mb-4 sm:flex-row gap-y-2">
                        <img src="{{ asset('assets/images/icons/more.svg') }}"
                            class="block w-4 ml-4 opacity-75 cursor-pointer md:hidden" alt="moreButton" id="moreButton">
                        <h3 class="hidden mb-2 ml-4 text-xl font-semibold lg:block">Dues Management</h3>
                        <div id="optionsMenu" class="items-center hidden ml-4 md:flex md:flex-row md:space-x-4">
                            <!-- Dropdown Sort -->
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
                                    class="flex items-center text-gray-700 transition duration-200 hover:text-blue-600">
                                    <span class="mr-1 icon">{!! file_get_contents(public_path('assets/images/icons/sort.svg')) !!}</span>
                                    <span>Sort</span>
                                </button>
                                <div x-show="open" x-cloak @click.away="open = false"
                                    class="fixed md:ml-0 ml-[116px] md:mt-2 -mt-6 w-48 bg-white border-t rounded-md shadow-lg z-10">
                                    <div class="py-1">
                                        <a href="#"
                                            :class="activeSort === 'full_name' && activeDirection === 'asc' ? 'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('full_name', 'asc')">Full Name (A-Z)</a>
                                        <a href="#"
                                            :class="activeSort === 'full_name' && activeDirection === 'desc' ? 'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('full_name', 'desc')">Full Name (Z-A)</a>
                                        <a href="#"
                                            :class="activeSort === 'username' && activeDirection === 'asc' ? 'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('username', 'asc')">Username (A-Z)</a>
                                        <a href="#"
                                            :class="activeSort === 'username' && activeDirection === 'desc' ? 'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('username', 'desc')">Username (Z-A)</a>
                                        <a href="#"
                                            :class="activeSort === 'institution' && activeDirection === 'asc' ? 'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('institution', 'asc')">Institution (A-Z)</a>
                                        <a href="#"
                                            :class="activeSort === 'institution' && activeDirection === 'desc' ? 'bg-blue-100' : ''"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                            @click.prevent="applySort('institution', 'desc')">Institution (Z-A)</a>
                                    </div>
                                </div>
                            </div>

                            <div class="hidden w-px h-6 bg-gray-300"></div>

                            <!-- Dropdown Export -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="flex items-center text-gray-700 transition duration-200 hover:text-blue-600">
                                    <span class="mr-1 icon">{!! file_get_contents(public_path('assets/images/icons/export.svg')) !!}</span>
                                    <span>Export</span>
                                </button>
                                <div x-show="open" x-cloak @click.away="open = false"
                                    class="fixed -mt-6 md:mt-2 md:ml-0 ml-[116px] w-48 bg-white border-t rounded-md shadow-lg z-10">
                                    <div class="py-1">
                                        <a href="{{ route('users.export', ['type' => 'pdf']) . '?' . http_build_query(request()->query()) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor sebagai <b>PDF</b></a>
                                        <a href="{{ route('users.export', ['type' => 'xlsx']) . '?' . http_build_query(request()->query()) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor sebagai <b>Excel</b></a>
                                        <a href="{{ route('users.export', ['type' => 'csv']) . '?' . http_build_query(request()->query()) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ekspor sebagai <b>CSV</b></a>
                                    </div>
                                </div>
                            </div>

                            <button id="printUserButton"
                                class="flex items-center text-gray-700 transition duration-200 hover:text-green-600">
                                <span class="mr-1 icon">{!! file_get_contents(public_path('assets/images/icons/printer.svg')) !!}</span>
                                <span>Print</span>
                            </button>

                            <div class="h-5 w-0.5 border border-gray-700"></div>

                            <!-- Dropdown Tahun -->
                            <div class="flex items-center gap-2">
                                <div class="relative" id="yearSelector">
                                    <button id="yearButton"
                                        class="flex items-center text-gray-700 hover:text-blue-600 transition duration-200 bg-white border border-gray-200 rounded-md px-3 py-1.5">
                                        <span id="selectedYear">{{ $selectedYear }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                    <div id="yearDropdown"
                                        class="absolute z-10 hidden w-32 mt-1 bg-white border rounded-md shadow-lg">
                                        <div class="py-1 overflow-y-auto max-h-60">
                                            @foreach ($years as $year)
                                                <button data-year="{{ $year }}"
                                                    class="year-option block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $year == $selectedYear ? 'bg-blue-50 text-blue-600 font-medium' : '' }}">
                                                    {{ $year }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="hidden" name="year" id="yearInput" value="{{ $selectedYear }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="relative inline-block w-12 h-12 -mr-6">
                            <input
                                class="-mr-3 search expandright absolute right-[49px] rounded bg-white border border-white h-8 w-0 lg:focus:w-[190px] md:focus:w-[164px] focus:w-[148px] transition-all duration-400 outline-none z-10 focus:px-4 focus:border-blue-500"
                                id="searchright" type="text" name="q" placeholder="Cari">
                            <label class="z-20 button searchbutton absolute text-[22px] w-full cursor-pointer"
                                for="searchright">
                                <span class="inline-block mt-1 -ml-3">
                                    <span class="icon ">
                                        {!! file_get_contents(public_path('assets/images/icons/search.svg')) !!}
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="cash-table" class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="cashTable">
                        <thead class="sticky top-0 bg-gray-100">
                            <tr class="text-xs font-medium text-gray-600 uppercase">
                                <th class="px-4 py-3 text-center">No</th>
                                <th class="px-4 py-3 text-center">NISN</th>
                                <th class="px-4 py-3 text-center">Name</th>
                                <th class="px-4 py-3 text-center">Institution</th>
                                @php
                                    $monthNames = [
                                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
                                    ];
                                @endphp
                                @foreach ($monthNames as $monthName)
                                    <th class="px-4 py-3 text-center">{{ $monthName }}</th>
                                @endforeach
                                <th class="px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600 bg-white divide-y divide-gray-200">
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td class="px-4 py-3 text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 text-center">{{ $user->identity_number ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">{{ $user->full_name }}</td>
                                    <td class="px-4 py-3 text-center">{{ $user->institution ?? '-' }}</td>

                                    @for ($month = 1; $month <= 12; $month++)
                                        @php
                                            $monthKey = \Carbon\Carbon::create($selectedYear, $month, 1)->format('Y-m');
                                            $isWithinPeriod =
                                                \Carbon\Carbon::create($selectedYear, $month, 1)
                                                    ->startOfMonth()
                                                    ->lessThanOrEqualTo($user->period_end_date) &&
                                                \Carbon\Carbon::create($selectedYear, $month, 1)
                                                    ->endOfMonth()
                                                    ->greaterThanOrEqualTo($user->period_start_date);
                                        @endphp
                                        <td class="px-4 py-3 text-center">
                                            @if ($isWithinPeriod)
                                                @if (isset($user->payment_statuses[$monthKey]) && $user->payment_statuses[$monthKey])
                                                    <span class="text-green-600"><i class="fa-solid fa-check"></i></span>
                                                @else
                                                    <span class="text-red-600"><i class="fa-solid fa-xmark"></i></span>
                                                @endif
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                    @endfor

                                    <td class="px-4 py-3 text-center">
                                        <div class="flex flex-col items-center w-full">
                                            <button class="open-modal" data-user='@json($user)'>
                                                <i class="transition-all duration-300 transform hover:scale-125 fa-solid fa-money-bill hover:text-emerald-500"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="hidden" id="userReportTable">
            <div class="mb-6">
                <p><strong>Waktu Laporan:</strong> Semua waktu</p>
                <p><strong>Disusun Oleh:</strong> Admin Wasuhin</p>
            </div>
            <div class="flex flex-col items-end justify-end w-full mt-10 h-min">
                <div class="flex text-right gap-x-1">
                    <p class="text-base text-gray-800">Admin</p>
                    <p class="text-base text-gray-800">DTI ITB,</p>
                </div>
                <div class="mt-10 text-right">
                    <p class="font-medium text-gray-700 text-md">{{ Auth::user()->full_name }}</p>
                    <div class="w-32 mt-2 border-b border-gray-400"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
        const printCssPath = "{{ asset('assets/css/app.css') }}";
    </script>
    <script>
        // Fungsi Utilitas
        function getURLParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        function updateURLParam(param, value) {
            let currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set(param, value);
            window.location.href = currentUrl.toString();
        }

        // Inisialisasi State
        let user = null;
        let statuses = {};

        // Dropdown Tahun
        function initYearDropdown() {
            const yearButton = document.getElementById('yearButton');
            const yearDropdown = document.getElementById('yearDropdown');
            const selectedYear = document.getElementById('selectedYear');
            const yearOptions = document.querySelectorAll('.year-option');
            const yearInput = document.getElementById('yearInput');

            yearButton.addEventListener('click', () => {
                yearDropdown.classList.toggle('hidden');
            });

            yearOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const year = this.getAttribute('data-year');
                    selectedYear.textContent = year;
                    yearInput.value = year;

                    yearOptions.forEach(opt => opt.classList.remove('bg-blue-50', 'text-blue-600', 'font-medium'));
                    this.classList.add('bg-blue-50', 'text-blue-600', 'font-medium');
                    yearDropdown.classList.add('hidden');

                    updateURLParam('year', year);
                });
            });

            document.addEventListener('click', (event) => {
                if (!yearButton.contains(event.target) && !yearDropdown.contains(event.target)) {
                    yearDropdown.classList.add('hidden');
                }
            });
        }

        // More Button (Mobile Menu)
        function initMoreButton() {
            const moreButton = document.getElementById('moreButton');
            const optionsMenu = document.getElementById('optionsMenu');

            moreButton.addEventListener('click', () => {
                optionsMenu.classList.toggle('show');
            });

            window.addEventListener('resize', () => {
                if (optionsMenu.classList.contains('show')) {
                    optionsMenu.classList.remove('show');
                }
            });
        }

        // Modal dan Toggle Status
        function initCashModal() {
            const openModalButtons = document.querySelectorAll('.open-modal');

            openModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const userData = JSON.parse(button.getAttribute('data-user'));
                    createDynamicModal(userData);
                });
            });
        }

        function createDynamicModal(userData) {
            // Hapus modal yang sudah ada jika ada
            const existingModal = document.getElementById('cashModal');
            if (existingModal) {
                existingModal.remove();
            }

            // Set user dan statuses
            user = userData;
            statuses = { ...userData.payment_statuses };

            // Buat struktur modal baru
            const modal = document.createElement('div');
            modal.id = 'cashModal';
            modal.className = 'fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50';

            modal.innerHTML = `
                <div class="max-w-md bg-white shadow-xl rounded-xl min-w-80 max-h-[80vh] overflow-y-auto">
                    <div id="gradientGenderColor" class="w-full rounded-t-lg bg-gradient-to-tr from-blue-600 to-blue-300 h-28">
                        <div class="flex items-center justify-end p-4">
                            <img id="closeViewcashModal" src="{{ asset('assets/images/icons/xmark.svg') }}" class="w-4 h-4 font-extrabold transition-all duration-150 cursor-pointer opacity-65 hover:opacity-85" alt="closeIcon">
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col items-left mb-6 -mt-[73px]">
                            <div class="relative flex items-center p-2 mb-1 bg-white rounded-full w-28 h-28">
                                <img id="userProfileImage" src="${ userData.profile_pic ? userData.profile_pic : '{{ asset("assets/images/default.png") }}' }" alt="User Profile" class="object-cover w-24 h-24 rounded-full shadow-md cursor-pointer">
                                <div class="absolute flex items-center justify-center w-8 h-8 p-1 bg-white rounded-full bottom-1 right-1">
                                    <div class="flex items-center justify-center w-6 h-6 bg-green-600 rounded-full">
                                        <div class="rounded-full bg-white w-[12px] h-[12px]"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <h3 id="userFullname" class="overflow-hidden text-xl font-semibold text-gray-800 max-w-80 whitespace-nowrap text-ellipsis">
                                    ${userData.full_name || 'Nama Siswa'}
                                </h3>
                                <a href="{{ route('dashboard') }}" id="userPlacement" class="flex items-center ml-2 text-sm font-medium text-gray-600">
                                    <span class="h-6 bg-gray-600 w-[2px] rounded-lg"></span>
                                    <img src="{{ asset('assets/images/icons/building.svg') }}" alt="placementIcon" class="w-3 ml-2 mr-1 opacity-70">
                                    <span>CRCS</span>
                                </a>
                            </div>
                        </div>
                        <div id="imageOverlay" class="fixed inset-0 bg-black bg-opacity-75 items-center justify-center hidden z-[60]">
                            <img id="fullScreenImage" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg" src="" alt="Full Screen User Profile">
                        </div>
                        <div class="space-y-4">
                            <div id="majorContainer" class="flex items-center ml-1 gap-x-1">
                                <span class="mr-3 text-blue-400 scale-110 bx bx-menu">
                                    <img src="{{ asset('assets/images/icons/major.svg') }}" class="w-6 opacity-75" alt="">
                                </span>
                                <div>
                                    <p class="text-sm text-gray-500">Major:</p>
                                    <a id="waLink" href="" class="flex items-center">
                                        <span id="userMajor">${userData.major || 'Rekayasa Perangkat Lunak'}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-center ml-1 gap-x-1">
                                <span class="mr-3 text-blue-400 scale-110 bx bx-menu">
                                    <img src="{{ asset('assets/images/icons/institution.svg') }}" class="w-6 opacity-75" alt="">
                                </span>
                                <div>
                                    <p class="text-sm text-gray-500">Institution:</p>
                                    <a id="waLink" href="" class="flex items-center">
                                        <span id="userInstitution">${userData.institution || 'SMK TI Pembangunan Cimahi'}</span>
                                    </a>
                                </div>
                            </div>
                            <hr class="my-4 border-gray-300">
                            <div id="monthInputs" class="space-y-2">
                                <!-- Input bulan akan ditambahkan via JavaScript -->
                            </div>
                            <div class="flex justify-end mt-6">
                                <button class="px-4 py-2 font-semibold text-white transition-all bg-blue-600 shadow-md save-button hover:bg-blue-700 rounded-xl">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Tambahkan modal ke dalam document
            document.body.appendChild(modal);

            // Pasang event listener untuk tombol close
            const closeModalButton = modal.querySelector('#closeViewcashModal');
            closeModalButton.addEventListener('click', () => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            });

            // Pasang event listener untuk tombol simpan
            const saveButton = modal.querySelector('.save-button');
            saveButton.addEventListener('click', () => {
                fetch('{{ route('update.payment.status') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        user_id: user.id,
                        statuses: statuses
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data berhasil disimpan');
                        modal.classList.remove('flex');
                        modal.classList.add('hidden');
                        location.reload();
                    } else {
                        alert('Gagal menyimpan data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan');
                });
            });

            // Panggil fungsi untuk mengisi input bulan
            populateMonthInputs(userData, modal);

            // Tampilkan modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function populateMonthInputs(userData, modal) {
            const monthInputs = modal.querySelector('#monthInputs');
            const startDate = new Date(userData.period_start_date);
            const endDate = new Date(userData.period_end_date);
            const currentDate = new Date(startDate);

            while (currentDate <= endDate) {
                const month = currentDate.toLocaleString('default', { month: 'long' });
                const year = currentDate.getFullYear();
                const monthYear = `${month} ${year}`;
                const monthKey = `${year}-${String(currentDate.getMonth() + 1).padStart(2, '0')}`;
                const status = statuses[monthKey] === true;
                const statusColor = status ? 'text-green-600' : 'text-black';
                const iconColor = status ? 'text-green-600' : 'text-black';

                const inputDiv = document.createElement('div');
                inputDiv.classList.add('flex', 'items-center', 'justify-between', 'gap-x-2', 'mb-2');
                inputDiv.innerHTML = `
                    <label class="text-sm text-gray-700">${monthYear}</label>
                    <span class="${statusColor}">${status ? '' : ''}</span>
                    <button data-month="${monthKey}" class="toggle-status">
                        <i class="fa-solid fa-money-bill ${iconColor} transition-all duration-300 transform hover:scale-125 hover:text-emerald-500"></i>
                    </button>
                `;
                monthInputs.appendChild(inputDiv);
                currentDate.setMonth(currentDate.getMonth() + 1);
            }

            // Pasang event listener untuk tombol toggle status
            modal.querySelectorAll('.toggle-status').forEach(btn => {
                btn.addEventListener('click', function() {
                    const month = this.getAttribute('data-month');
                    statuses[month] = !statuses[month];
                    const statusSpan = this.previousElementSibling;
                    const icon = this.querySelector('i');
                    statusSpan.textContent = statuses[month] ? '' : '';
                    statusSpan.className = statuses[month] ? 'text-green-600' : 'text-black';
                    icon.className = statuses[month]
                        ? 'fa-solid fa-money-bill text-green-600 transition-all duration-300 transform hover:scale-125 hover:text-emerald-500'
                        : 'fa-solid fa-money-bill text-black transition-all duration-300 transform hover:scale-125 hover:text-emerald-500';
                });
            });
        }

        // Overlay Gambar
        function initImageOverlay() {
            document.addEventListener('click', (event) => {
                if (event.target.id === 'userProfileImage') {
                    const imageOverlay = document.getElementById('imageOverlay');
                    const fullScreenImage = document.getElementById('fullScreenImage');
                    fullScreenImage.src = event.target.src;
                    imageOverlay.classList.remove('hidden');
                    imageOverlay.classList.add('flex');
                }

                if (event.target.id === 'imageOverlay') {
                    event.target.classList.add('hidden');
                    event.target.classList.remove('flex');
                }
            });
        }

        // Inisialisasi Semua Fungsi
        document.addEventListener('DOMContentLoaded', () => {
            initYearDropdown();
            initMoreButton();
            initCashModal();
            initImageOverlay();
        });
    </script>
@endsection
