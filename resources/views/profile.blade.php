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
                                            <a href="{{ route('users.updateView', ['id' => $user->id]) }}"
                                                class="text-gray-600 hover:text-blue-500">
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
                                                        <div class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                                                            onclick="openModal()">
                                                            Formulir Perjanjian Kerahasiaan
                                                        </div>
                                                        <a href="{{ route('print.interview_magang_pkl') }}"
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
                                                            Interview Magang PKL
                                                        </a>
                                                        <a href="{{ route('print.exit_clearance') }}"
                                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">
                                                            Form Exit Clearance
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
                                        <p class="mt-1 text-sm text-gray-800">{{ $user->address ?: '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">
                                            <i class="fas fa-university mr-2"></i>Institution
                                        </p>
                                        <p class="mt-1 text-sm text-gray-800">{{ $user->institution ?: '-' }}</p>
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

        <div id="userReportModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-70 z-50 hidden">
            <div class="bg-gray-50 text-white rounded-lg shadow-lg m-6 p-6 h-[95vh] max-w-xl md:max-w-4xl w-full">
                <div class="overflow-y-auto h-[80vh] space-y-4">
                    {{-- Printed Container --}}
                    <div id="laporanTransaksi"
                        class="laporanTransaksi h-auto p-8 rounded-md max-width-full border-2 bg-white text-black overflow-auto"
                        style="aspect-ratio: 2480 / 3508;">
                        <table class="w-full border border-gray-800 table-fixed opacity-70">
                            <tr>
                                <td class="w-1/6 border-r border-gray-800 text-center p-2">
                                    <img src="{{ asset('assets/images/logo_itb_512.png') }}" alt="Logo"
                                        class="w-20 mx-auto my-2">
                                </td>
                                <td class="w-5/6">
                                    <table class="w-full">
                                        <tr>
                                            <td class="text-center p-2">
                                                <div class="text-base font-bold">DIREKTORAT TEKNOLOGI INFORMASI ITB
                                                </div>
                                                <div class="text-sm text-gray-600">Gedung CRCS Lantai 4, Jalan Ganesha
                                                    Nomor 10 Bandung 40132 Telp: +6222 86010037</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-blue-600 text-white text-center p-2">
                                                <div class="font-bold">SURAT PERNYATAAN MENJAGA KERAHASIAAN INFORMASI
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-0">
                                                <table class="w-full text-sm border-t border-gray-800">
                                                    <tr>
                                                        <td class="border-r border-gray-800 p-1">Nomor : FRM.07-OPL.01
                                                        </td>
                                                        <td class="border-r border-gray-800 p-1">Revisi : 0</td>
                                                        <td class="border-r border-gray-800 p-1">Tanggal:
                                                            {{ date('d M Y') }}</td>
                                                        <td class="p-1">Halaman : 1 dari 1</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- Body Laporan -->
                        <div class="p-8" id="laporanContainer">
                            <div class="mt-2 text-sm">
                                <p class="mb-4">Pada hari ini, Jumat, Tanggal 22, Bulan September, Tahun 2023; saya
                                    yang bertanda tangan dibawah ini :</p>
                                <table class="w-full mb-4">
                                    <tr>
                                        <td class="w-48">Nama</td>
                                        <td>: {{ Auth::user()->full_name ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Identitas</td>
                                        <td>: {{ Auth::user()->nisn ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: {{ Auth::user()->address ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Instansi/Perusahaan</td>
                                        <td>: {{ Auth::user()->institution ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keperluan</td>
                                        <td>: Praktik Kerja Lapangan (PKL)</td>
                                    </tr>
                                    <tr>
                                        <td>Periode Penugasan</td>
                                        <td>: {{ Auth::user()->period_start_date }} s.d.
                                            {{ Auth::user()->period_end_date }}</td>
                                    </tr>
                                </table>

                                <p class="mb-4">Dengan ini menyatakan hal-hal sebagai berikut:</p>
                                <ul class="list-decimal pl-6 mb-4 space-y-2">
                                    <li>Menjaga kerahasiaan semua atau setiap bagian dari informasi maupun data yang
                                        diperoleh berkaitan dengan DTI ITB maupun ITB secara langsung maupun tidak
                                        langsung.</li>
                                    <li>Tidak mengungkapkan Informasi rahasia kepada pihak lain atau memanfaatkan atau
                                        menggunakannya untuk maksud apapun terkait dengan segala sesuatu yang diketahui
                                        dan di kerjakan dalam melaksanakan tugas yang dapat berpotensi merugikan DTI ITB
                                        maupun ITB.</li>
                                    <li>Tidak menyalahgunakan wewenang atas akses ke Sistem Teknologi Informasi yang ada
                                        di DTI ITB maupun ITB.</li>
                                    <li>Tidak membagikan (share) User ID dan Password kepada pihak lain yang tidak
                                        berhak.</li>
                                </ul>
                                <p class="mb-4">Apabila terbukti melakukan pelanggaran atas butir di atas, maka saya
                                    bersedia dituntut dan dikenakan sanksi sesuai dengan peraturan perundang-undangan
                                    yang berlaku.</p>
                                <p class="mb-4">Pernyataan ini tetap berlaku walaupun penugasan saya sudah berakhir
                                    atau diakhiri.</p>
                                <p class="mb-16">Demikian, Surat Pernyataan ini saya buat dalam keadaan sadar dan
                                    tanpa paksaan dari pihak manapun.</p>

                                <div class="flex justify-between mt-8">
                                    <div class="w-64 text-center">
                                        <p class="mb-20">Pembuat pernyataan</p>
                                        <p class="text-sm italic mb-4 text-gray-300">(materai Rp 10.000,-)</p>
                                        <p>{{ Auth::user()->full_name }}</p>
                                        <p>(NIP.)</p>
                                    </div>
                                    <div class="w-64 text-center">
                                        <p class="mb-4">Mengetahui,</p>
                                        <p class="mb-16">Direktur Teknologi Informasi ITB</p>
                                        <p class="underline">Mugi Sugiarto, S.Si., M.A.B.</p>
                                        <p>(NIP. 106000608)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-x-2 py-3">
                    <button
                        class="w-full px-4 py-2 text-sm font-medium text-gray-800 rounded-md hover:text-gray-900 border-2"
                        id="userReportClose" onclick="closeModal()">Kembali</button>
                    <button
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700"
                        onclick="printDiv('laporanTransaksi')">Cetak Laporan</button>
                </div>
            </div>
        </div>

        <script>
            function openModal() {
                document.getElementById('userReportModal').classList.remove('hidden');
                document.getElementById('userReportModal').classList.add('flex');
            }

            function closeModal() {
                document.getElementById('userReportModal').classList.add('hidden');
                document.getElementById('userReportModal').classList.remove('flex');
            }

            function printDiv(divId) {
                var printContents = document.getElementById(divId).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>

    </body>

    </html>
@endforeach
