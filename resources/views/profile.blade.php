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

            /* Certificate specific styles - DIPERBAIKI */
            .certificate-container {
                width: 297mm;
                height: 210mm;
                position: relative;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                font-family: 'Roboto', sans-serif;
                color: #1E3A8A;
                padding: 40px;
                box-sizing: border-box;
                margin: 0 auto;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .certificate-content {
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: center;
                text-align: center;
                position: relative;
                z-index: 10;
            }

            .certificate-header {
                margin-top: 60px;
            }

            .certificate-body {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 20px;
            }

            .certificate-footer {
                margin-bottom: 60px;
            }

            .certificate-name {
                font-family: 'Pacifico', cursive;
                font-size: 3.5rem;
                margin: 30px 0;
                color: #1E3A8A;
            }

            /* Print-specific styles - DIPERBAIKI */
            @media print {
                .no-print {
                    display: none !important;
                }

                .print-bg {
                    -webkit-print-color-adjust: exact !important;
                    print-color-adjust: exact !important;
                }

                @page {
                    size: A4 landscape;
                    margin: 0;
                }

                body {
                    margin: 0;
                    padding: 0;
                }

                .certificate-container {
                    width: 100vw;
                    height: 100vh;
                    margin: 0;
                    padding: 0;
                    page-break-inside: avoid;
                    break-inside: avoid;
                    -webkit-print-color-adjust: exact !important;
                    print-color-adjust: exact !important;
                }

                #certificateContent {
                    width: 100vw;
                    height: 100vh;
                    margin: 0;
                    padding: 0;
                    -webkit-print-color-adjust: exact !important;
                    print-color-adjust: exact !important;
                }
            }

            /* PDF Preview Modal */
            .pdf-preview-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                z-index: 9999;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .pdf-preview-container {
                background: white;
                border-radius: 8px;
                padding: 20px;
                max-width: 90vw;
                max-height: 90vh;
                overflow: auto;
            }

            .pdf-preview-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 1px solid #e5e5e5;
            }

            .pdf-preview-content {
                text-align: center;
            }

            .pdf-preview-buttons {
                display: flex;
                gap: 10px;
                margin-top: 20px;
                justify-content: center;
            }
        </style>
    </head>

    <body
        class="flex items-center justify-center min-h-screen p-4 gradient-bg bg-gradient-to-r from-blue-200 to-blue-400">
        <a href="{{ route('overview') }}" class="fixed z-10 text-black top-5 left-5 ">
            <i class="text-lg fas fa-arrow-left"></i>
        </a>

        <div class="relative w-full max-w-xl overflow-visible text-black profile-card">
            <!-- Blue background header -->
            <div class="h-40 m-3 bg-gradient-to-r from-blue-400 to-blue-600 rounded-xl"></div>

            <!-- Content that overlaps the blue background -->
            <div class="px-6 pb-6 -mt-24">
                <!-- Profile header -->
                <div class="flex flex-col mb-6">
                    <!-- Profile image and icons in a row -->
                    <div class="flex justify-between w-full mb-4">
                        <div class="p-1 rounded-full profile-image-bg w-36 h-36">
                            <div class="w-full h-full overflow-hidden border-2 border-white rounded-full">
                                <img src="{{ $user->profile_pic ? asset('storage/profilePics/' . $user->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                                    alt="Profile Photo" class="object-cover w-full h-full">
                            </div>
                        </div>

                        <!-- Action icons positioned to the right of the profile image -->
                        <div class="flex items-end gap-4 transition-all duration-500 transform">
                            @if (Auth::check() && Auth::user()->username === $user->username)
                                <a href="{{ url('addface') }}"
                                    class="text-gray-600 transition-all hover:text-gray-800 hover:scale-125">
                                    <img src="{{ asset('assets/images/icons/face.svg') }}" class="w-6 h-6 opacity-85"
                                        alt="">
                                </a>
                                <a href="{{ route('users.updateView', ['id' => $user->id]) }}"
                                    class="text-gray-600 transition-all hover:text-gray-800 hover:scale-125">
                                    <i class="text-lg fas fa-edit"></i>
                                </a>
                                <div class="relative" x-data="{ isOpen: false }">
                                    <button @click="isOpen = !isOpen" @click.away="isOpen = false"
                                        class="text-gray-600 transition-all hover:text-gray-800 hover:scale-125">
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
                                            <a href="{{ route('print.sertifikat_penilaian') }}"
                                                class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100">
                                                Sertifikat Penilaian
                                            </a>
                                            <a href="{{ route('print.sertifikat_kompetensi') }}"
                                                class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100">
                                                Sertifikat Kompetensi
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- User name and placement -->
                    <h1 class="text-xl font-semibold">{{ $user->full_name }} |
                        {{ $user->placement ? $user->placement->name : 'N/A' }}</h1>
                    <p class="mt-1 text-sm text-gray-600">{{ $user->username }} •
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
                    <div class="h-px mb-4 bg-gray-200"></div>

                    <!-- User details in two columns -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="mb-1 text-xs text-gray-500">ITB Account</p>
                            <p class="text-sm font-medium">{{ $user->itb_account ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="mb-1 text-xs text-gray-500">Email</p>
                            <p class="text-sm font-medium">{{ $user->email ? $user->email : 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="mb-1 text-xs text-gray-500">Identity Number</p>
                            <p class="text-sm font-medium">
                                {{ $user->identity_number ? $user->identity_number : 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="mb-1 text-xs text-gray-500">Phone</p>
                            <p class="text-sm font-medium">{{ $user->phone ?: 'N/A' }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="mb-1 text-xs text-gray-500">Address</p>
                            <p class="text-sm font-medium">{{ $user->address ?: 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-px my-4 bg-gray-200"></div>

                    <!-- Period and institution info -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="mb-1 text-xs text-gray-500">Start Date</p>
                            <p class="text-sm font-medium">{{ $user->period_start_date ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="mb-1 text-xs text-gray-500">End Date</p>
                            <p class="text-sm font-medium">{{ $user->period_end_date ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="mb-1 text-xs text-gray-500">Major</p>
                            <p class="text-sm font-medium">{{ $user->major ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="mb-1 text-xs text-gray-500">Institution</p>
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

        <!-- Modal for Sertifikat Kelulusan - DIPERBAIKI -->
        <div id="certificateModal"
            class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-70">
            <div class="bg-gray-100 text-black rounded-lg shadow-lg m-6 p-6 h-[95vh] max-w-6xl w-full">
                <div class="overflow-y-auto h-[80vh] space-y-4">
                    <div id="certificateContent" class="certificate-container print-bg"
                        style="background-image: url('{{ asset('assets/images/template-sertifikat.png') }}');">
                        
                        <!-- Konten Sertifikat - DIPERBAIKI -->
                        <div class="certificate-content">
                            <!-- Header -->
                            <div class="certificate-header">
                                <h1 class="text-5xl font-bold text-blue-900">Sertifikat</h1>
                                <p class="mt-2 text-lg text-blue-800">101/ITI.B05.3/DL.09/2024</p>
                            </div>

                            <!-- Body -->
                            <div class="certificate-body">
                                <p class="mb-4 text-2xl text-blue-800">Sertifikat ini diberikan kepada:</p>
                                <h2 class="certificate-name">{{ $user->full_name }}</h2>
                                <div class="space-y-2 text-xl text-blue-800">
                                    <p>Telah melaksanakan Praktek Kerja Lapangan (PKL)</p>
                                    <p>di Direktorat Teknologi Informasi ITB</p>
                                    <p>dari tanggal {{ \Carbon\Carbon::parse($user->period_start_date)->format('d F Y') }} - {{ \Carbon\Carbon::parse($user->period_end_date)->format('d F Y') }}</p>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="certificate-footer">
                                <div class="flex flex-col items-center">
                                    <img src="{{ asset('assets/images/ttd.png') }}"
                                        alt="Tanda Tangan" class="w-32 h-24 mb-4 print-bg">
                                    <div class="text-center text-blue-900">
                                        <p class="text-xl font-bold">Yustinus Dwiharjanto, S.Kom.</p>
                                        <p class="text-lg">Kepala Seksi Layanan Teknologi Informasi</p>
                                    </div>
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
                        onclick="generateCertificatePDF()">Cetak Sertifikat</button>
                </div>
            </div>
        </div>

        <!-- PDF Preview Modal - BARU -->
        <div id="pdfPreviewModal" class="pdf-preview-modal" style="display: none;">
            <div class="pdf-preview-container">
                <div class="pdf-preview-header">
                    <h3 class="text-lg font-bold">Preview Sertifikat PDF</h3>
                    <button onclick="closePDFPreview()" class="text-gray-500 hover:text-gray-700">
                        <i class="text-xl fas fa-times"></i>
                    </button>
                </div>
                <div class="pdf-preview-content">
                    <canvas id="pdfCanvas" style="max-width: 100%; border: 1px solid #ddd;"></canvas>
                </div>
                <div class="pdf-preview-buttons">
                    <button onclick="closePDFPreview()" 
                        class="px-4 py-2 text-gray-800 border-2 rounded-md hover:text-gray-900">
                        Tutup
                    </button>
                    <button onclick="downloadPDF()" 
                        class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        <i class="mr-2 fas fa-download"></i>Download PDF
                    </button>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

        <script>
            let generatedPDF = null;
            const username = '{{ $user->full_name }}'.replace(/\s+/g, '_');

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

            // Fungsi untuk generate PDF dengan preview - BARU
            async function generateCertificatePDF() {
                try {
                    // Show loading
                    const button = event.target;
                    const originalText = button.innerHTML;
                    button.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i>Generating PDF...';
                    button.disabled = true;

                    const certificateContent = document.getElementById('certificateContent');
                    
                    // Menggunakan html2canvas dengan konfigurasi untuk menangkap background dan gambar
                    const canvas = await html2canvas(certificateContent, {
                        scale: 2, // Meningkatkan kualitas
                        useCORS: true, // Untuk menangkap gambar dari domain lain
                        allowTaint: true, // Mengizinkan gambar yang mungkin "tainted"
                        backgroundColor: null, // Mempertahankan background transparan
                        logging: false,
                        width: certificateContent.offsetWidth,
                        height: certificateContent.offsetHeight,
                        onclone: function(clonedDoc) {
                            // Memastikan background image dan styling tetap ada di clone
                            const clonedElement = clonedDoc.getElementById('certificateContent');
                            if (clonedElement) {
                                clonedElement.style.backgroundImage = certificateContent.style.backgroundImage;
                                clonedElement.style.backgroundSize = 'cover';
                                clonedElement.style.backgroundPosition = 'center';
                                clonedElement.style.backgroundRepeat = 'no-repeat';
                            }
                        }
                    });

                    // Create PDF
                    const { jsPDF } = window.jspdf;
                    const pdf = new jsPDF({
                        orientation: 'landscape',
                        unit: 'mm',
                        format: 'a4'
                    });

                    // Calculate dimensions to fit A4 landscape
                    const imgWidth = 297; // A4 landscape width in mm
                    const imgHeight = (canvas.height * imgWidth) / canvas.width;

                    // Add image to PDF
                    const imgData = canvas.toDataURL('image/png', 1.0);
                    pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);

                    // Store PDF for download
                    generatedPDF = pdf;

                    // Show preview
                    showPDFPreview(canvas);

                    // Reset button
                    button.innerHTML = originalText;
                    button.disabled = false;

                } catch (error) {
                    console.error('Error generating PDF:', error);
                    alert('Terjadi kesalahan saat membuat PDF. Silakan coba lagi.');
                    
                    // Reset button
                    const button = event.target;
                    button.innerHTML = 'Cetak Sertifikat';
                    button.disabled = false;
                }
            }

            // Fungsi untuk menampilkan preview PDF - BARU
            function showPDFPreview(canvas) {
                const modal = document.getElementById('pdfPreviewModal');
                const previewCanvas = document.getElementById('pdfCanvas');
                const ctx = previewCanvas.getContext('2d');

                // Set canvas size for preview
                const maxWidth = 800;
                const scale = Math.min(maxWidth / canvas.width, 1);
                
                previewCanvas.width = canvas.width * scale;
                previewCanvas.height = canvas.height * scale;

                // Draw the certificate on preview canvas
                ctx.drawImage(canvas, 0, 0, previewCanvas.width, previewCanvas.height);

                // Show modal
                modal.style.display = 'flex';
            }

            // Fungsi untuk menutup preview PDF - BARU
            function closePDFPreview() {
                document.getElementById('pdfPreviewModal').style.display = 'none';
            }

            // Fungsi untuk download PDF - BARU
            function downloadPDF() {
                if (generatedPDF) {
                    generatedPDF.save(`sertifikat_kelulusan_${username}.pdf`);
                    closePDFPreview();
                } else {
                    alert('PDF belum siap. Silakan generate ulang.');
                }
            }

            // Preload images untuk memastikan gambar termuat saat generate PDF
            function preloadImages() {
                const images = [
                    '{{ asset('assets/images/template-sertifikat.png') }}',
                    '{{ asset('assets/images/ttd.png-removebg-preview.png') }}'
                ];

                images.forEach(src => {
                    const img = new Image();
                    img.crossOrigin = 'anonymous';
                    img.src = src;
                });
            }

            // Preload images saat halaman dimuat
            window.addEventListener('load', preloadImages);
        </script>
    </body>

    </html>
@endforeach