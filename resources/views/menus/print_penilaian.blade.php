<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Times+New+Roman:wght@400;500;600;700&family=Crimson+Text:wght@400;600;700&display=swap');

        body {
            font-family: 'Times New Roman', 'Crimson Text', serif;
        }

        /* Hide print content on screen */
        .print-only {
            display: none;
        }

        /* Print styles */
        @media print {
            /* Hide screen content */
            .screen-only {
                display: none !important;
            }

            /* Show print content */
            .print-only {
                display: block !important;
            }

            /* Page setup */
            @page {
                size: A4;
                margin: 0;
            }

            body {
                margin: 0;
                padding: 0;
                background: white;
                font-family: 'Times New Roman', serif;
            }

            /* Page break */
            .page-break {
                page-break-after: always;
            }

            /* Certificate background */
            .certificate-bg {
                background-image: url('{{ asset('assets/images/bg-sertifikat.jpg') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                width: 210mm;
                height: 297mm;
                position: relative;
                overflow: hidden;
            }

            /* Certificate content positioning */
            .certificate-content {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            .certificate-back-content {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: center;
            }

            /* Logo ITB positioning - more detailed */
            .logo-container {
                position: absolute;
                top: 45mm;
                left: 50%;
                transform: translateX(-50%);
                width: 100px;
                height: 100px;
                background: #1e40af;
                border: 3px solid white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: bold;
                font-size: 10px;
                box-shadow: 0 0 0 2px #1e40af;
            }

            .logo-inner {
                text-align: center;
                line-height: 1.1;
            }

            .logo-text-main {
                font-size: 8px;
                font-weight: 700;
                letter-spacing: 0.5px;
            }

            .logo-text-year {
                font-size: 12px;
                font-weight: 700;
                margin-top: 2px;
            }

            /* DTI logo positioning */
            .dti-logo {
                position: absolute;
                top: 25mm;
                right: 25mm;
                font-size: 15px;
                color: #64748b;
                text-align: left;
                font-family: 'Times New Roman', serif;
            }

            .dti-icon {
                width: 40px;
                height: 40px;
                background: linear-gradient(45deg, #06b6d4, #3b82f6);
                border-radius: 3px;
                margin-bottom: 2px;
            }

            .dti-text {
                font-size: 20px;
                line-height: 1.2;
            }

            /* Title */
            .certificate-title {
                font-size: 56px;
                font-weight: 700;
                color: #1f2937;
                margin-top: 85mm;
                margin-bottom: 15mm;
                letter-spacing: 4px;
                font-family: 'Times New Roman', serif;
            }

            /* Subtitle */
            .certificate-subtitle {
                font-size: 18px;
                color: #374151;
                margin-bottom: 18mm;
                font-family: 'Times New Roman', serif;
            }

            /* Name */
            .certificate-name {
                font-size: 42px;
                font-weight: 400;
                color: #1f2937;
                margin-bottom: 25mm;
                font-style: italic;
                font-family: 'Crimson Text', serif;
                letter-spacing: 1px;
            }

            /* Description */
            .certificate-description {
                font-size: 16px;
                color: #374151;
                line-height: 1.8;
                margin-bottom: 30mm;
                max-width: 500px;
                font-family: 'Times New Roman', serif;
            }

            /* Signature */
            .certificate-signature {
                font-size: 16px;
                color: #1f2937;
                font-weight: 600;
                font-family: 'Times New Roman', serif;
            }

            .signature-title {
                font-size: 14px;
                color: #6b7280;
                margin-top: 5px;
                font-weight: 400;
            }

            /* Table styles for back page - CENTERED & SMALLER */
            .table-container {
                position: absolute;
                top: 42%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 75%;
                max-width: 550px;
            }

            .assessment-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 10px;
                font-family: 'Times New Roman', serif;
                margin: 0 auto;
            }

            .assessment-table th,
            .assessment-table td {
                border: 1.5px solid #1f2937;
                padding: 4px 6px;
                text-align: left;
                vertical-align: middle;
            }

            .assessment-table th {
                background-color: #bfdbfe;
                font-weight: 700;
                text-align: center;
                font-size: 11px;
                color: #1f2937;
            }

            .assessment-table .number-col {
                width: 30px;
                text-align: center;
                font-weight: 600;
            }

            .assessment-table .component-col {
                width: auto;
                padding-left: 10px;
            }

            .assessment-table .score-col {
                width: 60px;
                text-align: center;
                font-weight: 600;
            }

            .assessment-table .grade-col {
                width: 100px;
                text-align: center;
                font-weight: 600;
            }

            .assessment-table .section-header {
                font-weight: 700;
                background-color: #f8fafc;
            }

            .assessment-table .section-item {
                padding-left: 16px;
            }

            .assessment-table .total-row {
                font-weight: 700;
                background-color: #f1f5f9;
            }

            .assessment-table .final-row {
                font-weight: 700;
                background-color: #e2e8f0;
                font-size: 11px;
            }

            .back-signature {
                position: absolute;
                bottom: 30mm;
                left: 25mm;
                font-size: 13px;
                color: #1f2937;
                font-family: 'Times New Roman', serif;
                line-height: 1.4;
            }

            .back-signature-name {
                font-weight: 600;
                margin-bottom: 3px;
            }

            .back-signature-title {
                font-size: 11px;
                color: #6b7280;
                font-weight: 400;
            }

            .back-date {
                position: absolute;
                bottom: 50mm;
                left: 25mm;
                font-size: 13px;
                color: #1f2937;
                font-family: 'Times New Roman', serif;
                font-weight: 500;
            }
        }
    </style>
</head>

<body class="min-h-screen">
    <!-- Screen Form -->
    <div class="container max-w-4xl px-4 py-8 mx-auto screen-only">
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <h1 class="mb-8 text-3xl font-bold text-center text-gray-800">Sertifikat Penilaian</h1>

            <!-- Form Input -->
            <form id="certificateForm" class="space-y-6">
                <!-- Data Peserta -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="studentName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ Auth::user()->full_name }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Durasi PKL</label>
                        <input type="text" id="duration" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="6 bulan" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" id="startDate" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ Auth::user()->period_start_date ? \Carbon\Carbon::parse(Auth::user()->period_start_date)->format('Y-m-d') : '' }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input type="date" id="endDate" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ Auth::user()->period_end_date ? \Carbon\Carbon::parse(Auth::user()->period_end_date)->format('Y-m-d') : '' }}" required>
                    </div>
                </div>

                <!-- Penilaian Aspek Sikap -->
                <div class="p-6 rounded-lg bg-blue-50">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800">1. Aspek Sikap</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">a. Penampilan dan Kerapihan Pakaian</label>
                            <input type="number" id="sikap_a" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">b. Komitmen dan Integritas</label>
                            <input type="number" id="sikap_b" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">c. Menghargai dan menghormati (kesopanan)</label>
                            <input type="number" id="sikap_c" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">d. Kreativitas</label>
                            <input type="number" id="sikap_d" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">e. Kerja sama tim</label>
                            <input type="number" id="sikap_e" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">f. Disiplin dan tanggung jawab</label>
                            <input type="number" id="sikap_f" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                </div>

                <!-- Penilaian Aspek Pengetahuan -->
                <div class="p-6 rounded-lg bg-green-50">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800">2. Aspek Pengetahuan</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">a. Penguasaan keilmuan</label>
                            <input type="number" id="pengetahuan_a" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">b. Kemampuan mengidentifikasi masalah</label>
                            <input type="number" id="pengetahuan_b" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">c. Kemampuan menemukan alternatif solusi secara kreatif</label>
                            <input type="number" id="pengetahuan_c" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                </div>

                <!-- Penilaian Aspek Keterampilan -->
                <div class="p-6 rounded-lg bg-yellow-50">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800">3. Aspek Keterampilan</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">a. Keahlian dan Keterampilan</label>
                            <input type="number" id="keterampilan_a" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">b. Inovasi dan kreativitas</label>
                            <input type="number" id="keterampilan_b" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">c. Produktivitas dan penyelesaian tugas</label>
                            <input type="number" id="keterampilan_c" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">d. Penguasaan alat kerja</label>
                            <input type="number" id="keterampilan_d" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                </div>

                <!-- Nilai Laporan -->
                <div class="p-6 rounded-lg bg-purple-50">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800">4. Nilai Laporan PKL (20%)</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Nilai Laporan PKL</label>
                            <input type="number" id="laporan" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                </div>

                <!-- Data Penandatangan -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Nama Direktur</label>
                        <input type="text" id="directorName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Directure Name" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Nama Kepala Seksi</label>
                        <input type="text" id="headName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Head Name" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Sertifikat</label>
                        <input type="date" id="certificateDate" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" id="location" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Bandung" required>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-4 pt-6">
                    <button type="button" onclick="generateCertificate()" class="px-8 py-3 font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                        Generate Sertifikat
                    </button>
                    <button type="button" onclick="window.print()" class="px-8 py-3 font-medium text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700">
                        Print Sertifikat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Print Content - Certificate Front -->
    <div class="print-only">
        <div class="certificate-bg">
            <img src="{{ asset('assets/images/bg-sertifikat.jpg') }}">
            <div class="dti-logo">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div class="dti-icon"><img src="{{ asset('svg/dti.svg') }}" alt=""></div>
                    <div class="dti-text">
                        <div>Direktorat</div>
                        <div>Teknologi Informasi</div>
                    </div>
                </div>
            </div>

            <div class="logo-container">
                <img src="{{ asset('assets/images/logo_itb_512.png') }}" alt="">
            </div>

            <div class="certificate-content">
                <div class="certificate-title">SERTIFIKAT</div>
                <div class="certificate-subtitle">Diberikan kepada:</div>
                <div class="certificate-name" id="printStudentName"></div>
                <div class="certificate-description">
                    <div>Telah melaksanakan Praktik Kerja Lapangan di</div>
                    <div>Direktorat Teknologi Informasi ITB</div>
                    <div id="printDuration"></div>
                </div>
                <div class="certificate-signature">
                    <div id="printDirectorName"></div>
                    <div class="signature-title">Direktur Teknologi Informasi</div>
                </div>
            </div>
        </div>

        <!-- Page Break -->
        <div class="page-break"></div>

        <!-- Certificate Back -->
        <div class="certificate-bg">
            <img src="{{ asset('assets/images/bg-sertifikat.jpg') }}">
            <div class="dti-logo">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div class="dti-icon"><img src="{{ asset('svg/dti.svg') }}" alt=""></div>
                    <div class="dti-text">
                        <div>Direktorat</div>
                        <div>Teknologi Informasi</div>
                    </div>
                </div>
            </div>
            <div class="certificate-back-content">
                <div class="table-container">
                    <table class="assessment-table">
                        <thead>
                            <tr>
                                <th class="number-col">NO</th>
                                <th class="component-col">KOMPONEN PENILAIAN</th>
                                <th class="score-col">SKOR</th>
                                <th class="grade-col">KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody id="assessmentTableBody">
                            <!-- Table content will be generated by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <div class="back-date" id="printCertificateDate">Bandung, </div>

                <div class="back-signature">
                    <div class="back-signature-name" id="printHeadName"></div>
                    <div class="back-signature-title">Kepala Seksi Layanan DTI ITB</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("input[type='number']").on("input", function() {
                if (this.value < 0) this.value = 0;
                if (this.value > 100) this.value = 100;
            });
        });

        function getGrade(score) {
            if (score >= 95) return 'Sangat Baik';
            if (score >= 85) return 'Baik';
            if (score >= 75) return 'Cukup';
            if (score >= 65) return 'Kurang';
            return 'Sangat Kurang';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const months = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            return `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
        }

        function generateCertificate() {
            // Get form values
            const studentName = document.getElementById('studentName').value;
            const duration = document.getElementById('duration').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const directorName = document.getElementById('directorName').value;
            const headName = document.getElementById('headName').value;
            const certificateDate = document.getElementById('certificateDate').value;
            const location = document.getElementById('location').value;

            // Validate required fields
            if (!studentName || !duration || !startDate || !endDate || !directorName || !headName || !certificateDate || !location) {
                alert('Mohon lengkapi semua field yang diperlukan!');
                return;
            }

            // Update front page
            document.getElementById('printStudentName').textContent = studentName;
            document.getElementById('printDuration').textContent = `selama ${duration} dari tanggal ${formatDate(startDate)} – ${formatDate(endDate)}`;
            document.getElementById('printDirectorName').textContent = directorName;

            // Update back page
            document.getElementById('printCertificateDate').textContent = `${location}, ${formatDate(certificateDate)}`;
            document.getElementById('printHeadName').textContent = headName;

            // Generate assessment table
            const assessments = [
                {
                    no: '1.',
                    title: 'Aspek Sikap',
                    items: [
                        { label: 'a. Penampilan dan Kerapihan Pakaian', id: 'sikap_a' },
                        { label: 'b. Komitmen dan Integritas', id: 'sikap_b' },
                        { label: 'c. Menghargai dan menghormati (kesopanan)', id: 'sikap_c' },
                        { label: 'd. Kreativitas', id: 'sikap_d' },
                        { label: 'e. Kerja sama tim', id: 'sikap_e' },
                        { label: 'f. Disiplin dan tanggung jawab', id: 'sikap_f' }
                    ]
                },
                {
                    no: '2.',
                    title: 'Aspek Pengetahuan',
                    items: [
                        { label: 'a. Penguasaan keilmuan', id: 'pengetahuan_a' },
                        { label: 'b. Kemampuan mengidentifikasi masalah', id: 'pengetahuan_b' },
                        { label: 'c. Kemampuan menemukan alternatif solusi secara kreatif', id: 'pengetahuan_c' }
                    ]
                },
                {
                    no: '3.',
                    title: 'Aspek Keterampilan',
                    items: [
                        { label: 'a. Keahlian dan Keterampilan', id: 'keterampilan_a' },
                        { label: 'b. Inovasi dan kreativitas', id: 'keterampilan_b' },
                        { label: 'c. Produktivitas dan penyelesaian tugas', id: 'keterampilan_c' },
                        { label: 'd. Penguasaan alat kerja', id: 'keterampilan_d' }
                    ]
                }
            ];

            let tableHTML = '';
            let totalScore = 0;
            let totalItems = 0;

            assessments.forEach(section => {
                tableHTML += `<tr class="section-header">
                    <td class="number-col">${section.no}</td>
                    <td class="component-col" style="font-weight: 700;">${section.title}</td>
                    <td class="score-col"></td>
                    <td class="grade-col"></td>
                </tr>`;

                section.items.forEach(item => {
                    const score = parseInt(document.getElementById(item.id).value) || 0;
                    const grade = getGrade(score);
                    totalScore += score;
                    totalItems++;

                    tableHTML += `<tr>
                        <td class="number-col"></td>
                        <td class="component-col section-item">${item.label}</td>
                        <td class="score-col">${score}</td>
                        <td class="grade-col">${grade}</td>
                    </tr>`;
                });
            });

            tableHTML += `<tr class="total-row">
                <td class="number-col" colspan="2">Nilai Rata-rata (80%)</td>
                <td class="score-col">${Math.round(totalScore / totalItems)}</td>
                <td class="grade-col">${getGrade(Math.round(totalScore / totalItems))}</td>
            </tr>`;

            const reportScore = parseInt(document.getElementById('laporan').value) || 0;
            tableHTML += `<tr class="total-row">
                <td class="number-col">4.</td>
                <td class="component-col">Nilai Laporan PKL (20%)</td>
                <td class="score-col">${reportScore}</td>
                <td class="grade-col">${getGrade(reportScore)}</td>
            </tr>`;

            const finalScore = Math.round((totalScore / totalItems) * 0.8 + reportScore * 0.2);
            tableHTML += `<tr class="final-row">
                <td class="number-col" colspan="2">Nilai Akhir PKL</td>
                <td class="score-col">${finalScore}</td>
                <td class="grade-col">${getGrade(finalScore)}</td>
            </tr>`;

            document.getElementById('assessmentTableBody').innerHTML = tableHTML;

            alert('Sertifikat berhasil di-generate! Klik "Print Sertifikat" untuk melihat preview.');
        }

        document.addEventListener('input', function(e) {
            if (e.target.type === 'number') {
                const score = parseInt(e.target.value);
                if (score >= 0 && score <= 100) {
                    // You can add real-time grade display here if needed
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('certificateDate').value = new Date().toISOString().split('T')[0];
            document.getElementById('directorName').value = '';
            document.getElementById('headName').value = '';
            document.getElementById('location').value = 'Bandung';
        });

        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
        const durationInput = document.getElementById('duration');

        function calculateDuration() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (!isNaN(startDate) && !isNaN(endDate)) {
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                const months = Math.floor(diffDays / 30);
                const days = diffDays % 30;

                let durationText = '';
                if (months > 0) durationText += `${months} bulan `;
                if (days > 0) durationText += `${days} hari`;

                durationInput.value = durationText.trim();
            } else {
                durationInput.value = '';
            }
        }

        startDateInput.addEventListener('change', calculateDuration);
        endDateInput.addEventListener('change', calculateDuration);

        window.addEventListener('DOMContentLoaded', calculateDuration);
    </script>
</body>

</html>