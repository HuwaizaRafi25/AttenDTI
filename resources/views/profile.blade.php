@foreach ($users as $user)
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon">
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Pacifico&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f5f5f5;
            }

            .profile-card {
                background: white;
                border-radius: 16px;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
            }

            /* CSS untuk modal Formulir Perjanjian Kerahasiaan */
            #userReportModal .bg-template {
                background-image: none;
            }

            /* CSS untuk modal Sertifikat Kelulusan */
            #certificateModal .bg-template {
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                color: #1E3A8A;
                font-family: 'Roboto', sans-serif;
                padding: 20px;
                box-sizing: border-box;
            }

            /* Print-specific styles */
            @media print {
                .no-print {
                    display: none;
                }

                .print-bg {
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }

                @page {
                    size: auto;
                    margin: 20px;
                }

                body {
                    margin: 0;
                    padding: 0;
                }

                /* Khusus untuk print sertifikat */
                @page: certificate {
                    size: landscape;
                    margin: 0;
                }

                #certificateContent {
                    width: 100vw;
                    height: 100vh;
                    page: certificate;
                }
            }
        </style>
    </head>

    <body
        class="min-h-screen gradient-bg flex items-center justify-center p-4 bg-gradient-to-r from-blue-200 to-blue-400">
        <a href="{{ route('overview') }}" class="fixed z-10 top-5 left-5 text-black ">
            <i class="text-lg fas fa-arrow-left"></i>
        </a>

        <div class="profile-card max-w-xl w-full text-black relative overflow-visible">
            <!-- Blue background header -->
            <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-40 rounded-xl m-3"></div>

            <!-- Content that overlaps the blue background -->
            <div class="px-6 pb-6 -mt-24">
                <!-- Profile header -->
                <div class="flex flex-col mb-6">
                    <!-- Profile image and icons in a row -->
                    <div class="flex w-full justify-between mb-4">
                        <div class="profile-image-bg p-1 w-36 h-36 rounded-full">
                            <div class="w-full h-full rounded-full overflow-hidden border-2 border-white">
                                <img src="{{ $user->profile_pic ? asset('storage/profilePics/' . $user->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                                    alt="Profile Photo" class="object-cover w-full h-full">
                            </div>
                        </div>

                        <!-- Action icons positioned to the right of the profile image -->
                        <div class="flex items-end gap-4 transition-all duration-500 transform">
                            @if (Auth::check() && Auth::user()->username === $user->username)
                                <a href="{{ url('addface') }}"
                                    class="text-gray-600 hover:text-gray-800 hover:scale-125 transition-all">
                                    <img src="{{ asset('assets/images/icons/face.svg') }}" class="w-6 h-6 opacity-85"
                                        alt="">
                                </a>
                                <a href="{{ route('users.updateView', ['id' => $user->id]) }}"
                                    class="text-gray-600 hover:text-gray-800 hover:scale-125 transition-all">
                                    <i class="text-lg fas fa-edit"></i>
                                </a>
                                <div class="relative" x-data="{ isOpen: false }">
                                    <button @click="isOpen = !isOpen" @click.away="isOpen = false"
                                        class="text-gray-600 hover:text-gray-800 hover:scale-125 transition-all">
                                        <i class="text-lg fas fa-print"></i>
                                    </button>

                                    <div x-show="isOpen"
                                        class="absolute right-0 z-50 w-64 mt-2 bg-white rounded-md shadow-lg"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="transform opacity-0 scale-95"
                                        x-transition:enter-end="transform opacity-100 scale-100">
                                        <div class="py-1">
                                            <div class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100"
                                                onclick="openModal()">
                                                Formulir Perjanjian Kerahasiaan
                                            </div>
                                            <a href="{{ route('print.interview_magang_pkl') }}"
                                                class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100">
                                                Interview Magang PKL
                                            </a>
                                            <a href="{{ route('print.exit_clearance') }}"
                                                class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100">
                                                Form Exit Clearance
                                            </a>
                                            <div class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100"
                                                onclick="openCertificateModal()">
                                                Sertifikat Kelulusan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- User name and placement -->
                    <h1 class="text-xl font-semibold">{{ $user->full_name }} |
                        {{ $user->placement ? $user->placement->name : 'N/A' }}</h1>
                    <p class="text-sm text-gray-600 mt-1">{{ $user->username }} •
                        @if ($user->roles->isNotEmpty())
                            {{ $user->roles->pluck('name')->join(', ') }}
                        @else
                            N/A
                        @endif
                    </p>
                </div>

                <!-- User details section -->
                <div class="">
                    <!-- Divider -->
                    <div class="h-px bg-gray-200 mb-4"></div>

                    <!-- User details in two columns -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">ITB Account</p>
                            <p class="text-sm font-medium">{{ $user->itb_account ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Email</p>
                            <p class="text-sm font-medium">{{ $user->email ? $user->email : 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Identity Number</p>
                            <p class="text-sm font-medium">
                                {{ $user->identity_number ? $user->identity_number : 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Phone</p>
                            <p class="text-sm font-medium">{{ $user->phone ?: 'N/A' }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-xs text-gray-500 mb-1">Address</p>
                            <p class="text-sm font-medium">{{ $user->address ?: 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-gray-200 my-4"></div>

                    <!-- Period and institution info -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Start Date</p>
                            <p class="text-sm font-medium">{{ $user->period_start_date ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">End Date</p>
                            <p class="text-sm font-medium">{{ $user->period_end_date ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Major</p>
                            <p class="text-sm font-medium">{{ $user->major ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Institution</p>
                            <p class="text-sm font-medium">{{ $user->institution ?: 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Formulir Perjanjian Kerahasiaan -->
        <div id="userReportModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-70">
            <div class="bg-gray-100 text-black rounded-lg shadow-lg m-6 p-6 h-[95vh] max-w-xl md:max-w-4xl w-full">
                <div class="overflow-y-auto h-[80vh] space-y-4">
                    <div id="laporanTransaksi"
                        class="h-auto p-8 overflow-auto text-black bg-white border-2 rounded-md laporanTransaksi max-width-full"
                        style="aspect-ratio: 2480 / 3508;">
                        <table class="w-full border border-gray-800 table-fixed opacity-70">
                            <tr>
                                <td class="w-1/6 p-2 text-center border-r border-gray-800">
                                    <img src="{{ asset('assets/images/logo_itb_512.png') }}" alt="Logo"
                                        class="w-20 mx-auto my-2">
                                </td>
                                <td class="w-5/6">
                                    <table class="w-full">
                                        <tr>
                                            <td class="p-2 text-center">
                                                <div class="text-base font-bold">DIREKTORAT TEKNOLOGI INFORMASI ITB
                                                </div>
                                                <div class="text-sm text-gray-600">Gedung CRCS Lantai 4, Jalan Ganesha
                                                    Nomor 10 Bandung 40132 Telp: +6222 86010037</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 text-center text-white bg-blue-600 print-bg">
                                                <div class="font-bold">SURAT PERNYATAAN MENJAGA KERAHASIAAN INFORMASI
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-0">
                                                <table class="w-full text-sm border-t border-gray-800">
                                                    <tr>
                                                        <td class="p-1 border-r border-gray-800">Nomor : FRM.07-OPL.01
                                                        </td>
                                                        <td class="p-1 border-r border-gray-800">Revisi : 0</td>
                                                        <td class="p-1 border-r border-gray-800">Tanggal:
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
                                <ul class="pl-6 mb-4 space-y-2 list-decimal">
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
                                        <p class="mb-4 text-sm italic text-gray-300">(materai Rp 10.000,-)</p>
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
                <div class="flex py-3 gap-x-2">
                    <button
                        class="w-full px-4 py-2 text-sm font-medium text-gray-800 border-2 rounded-md hover:text-gray-900"
                        onclick="closeModal()">Kembali</button>
                    <button
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700"
                        onclick="printDiv('laporanTransaksi')">Cetak Laporan</button>
                </div>
            </div>
        </div>

        <!-- Modal for Sertifikat Kelulusan -->
        <div id="certificateModal"
            class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-70">
            <div class="bg-gray-100 text-black rounded-lg shadow-lg m-6 p-6 h-[95vh] max-w-xl md:max-w-4xl w-full">
                <div class="overflow-y-auto h-[80vh] space-y-4">
                    <div id="certificateContent" class="relative overflow-auto text-black border-2 rounded-md">
                        {{-- set asset('assets/images/template-sertifikat.png sebagai bg dari certificate --}}
                        <img src="{{ asset('assets/images/template-sertifikat.png') }}"
                            class="absolute inset-0 w-full h-full object-cover" alt="">

                        <!-- Konten Sertifikat -->
                        <div class="relative z-10 font-roboto text-blue-900 min-h-screen flex flex-col justify-center">
                            <div class="content items-center">
                                <div class="header text-center">
                                    <h1 class="text-4xl font-bold">Sertifikat</h1>
                                    <p class="text-sm">101/ITI.B05.3/DL.09/2024</p>
                                </div>
                            </div>
                            <div class="content text-center mt-8">
                                <p class="text-lg">Sertifikat ini diberikan kepada:</p>
                                <h2 class="text-5xl my-4" style="font-family: 'Pacifico', cursive;">
                                    {{ $user->full_name }}</h2>
                                <p class="text-md">Telah melaksanakan Praktek Kerja Lapangan (PKL)</p>
                                <p class="text-md">di Direktorat Teknologi Informasi ITB</p>
                                <p class="text-md">dari tanggal
                                    {{ \Carbon\Carbon::parse($user->period_start_date)->format('d F Y') }} -
                                    {{ \Carbon\Carbon::parse($user->period_end_date)->format('d F Y') }}</p>
                            </div>
                            <div class="footer mt-8 flex flex-col items-center">
                                <img src="{{ asset('assets/images/ttd.png-removebg-preview.png') }}"
                                    alt="Tanda Tangan" class="w-32 h-32">
                                <div class="text-center">
                                    <p class="text-md font-bold">Yustinus Dwiharjanto, S.Kom.</p>
                                    <p class="text-sm">Kepala Seksi Layanan Teknologi Informasi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex py-3 gap-x-2">
                    <button
                        class="w-full px-4 py-2 text-sm font-medium text-gray-800 border-2 rounded-md hover:text-gray-900"
                        onclick="closeCertificateModal()">Kembali</button>
                    <button
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700"
                        onclick="printCertificate()">Cetak Sertifikat</button>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

        <script>
            // Fungsi untuk modal Formulir Perjanjian Kerahasiaan
            function openModal() {
                document.getElementById('userReportModal').classList.remove('hidden');
                document.getElementById('userReportModal').classList.add('flex');
            }

            function closeModal() {
                document.getElementById('userReportModal').classList.add('hidden');
                document.getElementById('userReportModal').classList.remove('flex');
            }

            // Fungsi untuk modal Sertifikat Kelulusan
            function openCertificateModal() {
                document.getElementById('certificateModal').classList.remove('hidden');
                document.getElementById('certificateModal').classList.add('flex');
            }

            function closeCertificateModal() {
                document.getElementById('certificateModal').classList.add('hidden');
                document.getElementById('certificateModal').classList.remove('flex');
            }

            // Fungsi print generik
            function printDiv(divId) {
                var printContents = document.getElementById(divId).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }

            // Fungsi print khusus untuk sertifikat
            function printCertificate() {
        const { jsPDF } = window.jspdf; // Akses jsPDF dari UMD module
        const doc = new jsPDF({
            orientation: 'landscape',
            unit: 'mm',
            format: 'a4'
        });

        const certificateContent = document.getElementById('certificateContent');
        const username = '{{ $user->full_name }}'.replace(/\s+/g, '_');

        doc.html(certificateContent, {
            callback: function (doc) {
                doc.save(`sertifikat_kelulusan_${username}.pdf`);
            },
            x: 10,
            y: 10,
            width: 237, // Lebar B5 landscape dalam mm
            windowWidth: 900 // Lebar viewport untuk rendering
        });
    }
        </script>
    </body>

    </html>
@endforeach
