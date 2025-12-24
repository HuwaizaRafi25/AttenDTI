<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kompetensi</title>
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
                margin: 0 auto; /* Center the certificate */
            }

            /* Certificate content positioning */
            .certificate-content {
                position: absolute;
                top: 200px;
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

            /* Logo ITB positioning */
            .logo-container {
                position: absolute;
                top: 45mm;
                left: 50%;
                transform: translateX(-50%);
                width: 100px;
                height: 100px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .logo-container img {
                width: 100%;
                height: 100%;
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
                margin-bottom: 2px;
            }

            .dti-text {
                font-size: 20px;
                line-height: 1.2;
            }

            /* Title */
            .certificate-title {
                font-size: 50px;
                font-weight: 700;
                color: #1f2937;
                font-family: 'Times New Roman', serif;
                text-decoration: underline;
                text-align: center;
                margin-bottom: 10px;
            }

            /* Subtitle */
            .certificate-subtitle {
                font-size: 45px;
                color: #374151;
                font-family: 'Times New Roman', serif;
                text-align: center;
                margin-bottom: 30px;
            }

            /* Certificate info */
            .certificate-info {
                width: 80%;
                max-width: 500px;
                margin: 0 auto;
                text-align: center;
                margin-bottom: 20px;
            }

            /* Student info */
            .student-info {
                width: 80%;
                max-width: 500px;
                margin: 0 auto;
                text-align: left;
                margin-bottom: 30px;
            }

            .student-info-row {
                display: flex;
                margin-bottom: 5px;
            }

            .student-info-label {
                width: 150px;
                font-weight: normal;
                text-align: left;
            }

            .student-info-value {
                flex: 1;
                text-align: left;
            }

            /* Project info */
            .project-info {
                width: 80%;
                max-width: 500px;
                margin: 0 auto;
                text-align: center;
                margin-bottom: 30px;
            }

            /* Institution info */
            .institution-info {
                width: 80%;
                max-width: 500px;
                margin: 0 auto;
                text-align: left;
                margin-bottom: 40px;
            }

            .institution-info-row {
                display: flex;
                margin-bottom: 5px;
            }

            .institution-info-label {
                width: 150px;
                font-weight: normal;
                text-align: left;
            }

            .institution-info-value {
                flex: 1;
                text-align: left;
            }

            /* Signature */
            .certificate-signature {
                font-size: 16px;
                color: #1f2937;
                font-weight: 600;
                font-family: 'Times New Roman', serif;
                text-align: center;
                margin-top: 20px;
            }

            .signature-title {
                font-size: 14px;
                color: #6b7280;
                margin-top: 5px;
                font-weight: 400;
            }

            /* Table styles for back page */
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
                        <label class="block mb-2 text-sm font-medium text-gray-700">NIS</label>
                        <input type="text" id="studentNIS" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ Auth::user()->identity_number }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Nama Sekolah</label>
                        <input type="text" id="schoolName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ Auth::user()->institution }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Alamat Sekolah</label>
                        <input type="text" id="schoolAddress" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Alamat Sekolah" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Kompetensi Keahlian</label>
                        <input type="text" id="competency" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ Auth::user()->major }}" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Judul Uji Kompetensi</label>
                        <input type="text" id="projectTitle" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Judul Uji Kompetensi" required>
                    </div>
                </div>

                <!-- Data Institusi -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Nama Institusi</label>
                        <input type="text" id="institutionName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="DTI ITB" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Alamat Institusi</label>
                        <input type="text" id="institutionAddress" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="Jl. Ganesha No.10, Lb. Siliwangi, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Bagian/Divisi</label>
                        <input type="text" id="division" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Bagian/Divisi" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Uji Kompetensi</label>
                        <input type="date" id="testDate" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <!-- Penilaian -->
                <div class="p-6 rounded-lg bg-blue-50">
                    <h3 class="mb-4 text-lg font-semibold text-gray-800">Penilaian</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">1. Unjuk/Cara Kerja/Praktik</label>
                            <input type="number" id="unjuk_kerja" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">2. Penguasaan Materi/Knowledge</label>
                            <input type="number" id="penguasaan_materi" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">3. Sikap/Attitude</label>
                            <input type="number" id="sikap" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">4. Laporan Praktik</label>
                            <input type="number" id="laporan" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">5. Nilai Uji Kompetensi</label>
                            <input type="number" id="uji_kompetensi" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>
                </div>

                <!-- Data Penandatangan -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Nama Direktur</label>
                        <input type="text" id="directorName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nama Direktur" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Nama Kepala Seksi</label>
                        <input type="text" id="headName" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nama Kepala Seksi" required>
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
                    <div class="dti-icon"><img src="{{ asset('svg/dti.svg') }}" alt="DTI Logo"></div>
                    <div class="dti-text">
                        <div>Direktorat</div>
                        <div>Teknologi Informasi</div>
                    </div>
                </div>
            </div>

            <div class="logo-container">
                <img src="{{ asset('assets/images/logo_itb_512.png') }}" alt="Logo ITB">
            </div>

            <div class="certificate-content">
                <div class="certificate-title">SERTIFIKAT KOMPETENSI</div>
                <div class="certificate-subtitle">Certificate of Competency</div>
                
                <div class="certificate-info">
                    <div>Nomor 081.a/PK.03.03/SMKN13BDG</div>
                    <div style="margin-top: 10px;">Dengan Ini Menerangkan Bahwa:</div>
                </div>
                
                <div class="student-info">
                    <div class="student-info-row">
                        <div class="student-info-label">Nama</div>
                        <div class="student-info-value">: <span id="printStudentName"></span></div>
                    </div>
                    <div class="student-info-row">
                        <div class="student-info-label">NIS</div>
                        <div class="student-info-value">: <span id="printStudentNIS"></span></div>
                    </div>
                    <div class="student-info-row">
                        <div class="student-info-label">Nama Sekolah</div>
                        <div class="student-info-value">: <span id="printSchoolName"></span></div>
                    </div>
                    <div class="student-info-row">
                        <div class="student-info-label">Alamat Sekolah</div>
                        <div class="student-info-value">: <span id="printSchoolAddress"></span></div>
                    </div>
                    <div class="student-info-row">
                        <div class="student-info-label">Kompetensi Keahlian</div>
                        <div class="student-info-value">: <span id="printCompetency"></span></div>
                    </div>
                </div>
                
                <div class="project-info">
                    <div>Telah Mengikuti Uji Kompetensi</div>
                    <div>Dengan Judul</div>
                    <div style="font-weight: bold; margin-top: 5px;"><span id="printProjectTitle"></span></div>
                </div>
                
                <div class="institution-info">
                    <div class="institution-info-row">
                        <div class="institution-info-label">Nama Institusi</div>
                        <div class="institution-info-value">: <span id="printInstitutionName"></span></div>
                    </div>
                    <div class="institution-info-row">
                        <div class="institution-info-label">Alamat</div>
                        <div class="institution-info-value">: <span id="printInstitutionAddress"></span></div>
                    </div>
                    <div class="institution-info-row">
                        <div class="institution-info-label">Bagian/Divisi</div>
                        <div class="institution-info-value">: <span id="printDivision"></span></div>
                    </div>
                    <div class="institution-info-row">
                        <div class="institution-info-label">Waktu Uji Kompetensi</div>
                        <div class="institution-info-value">: <span id="printTestDate"></span></div>
                    </div>
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
            <img src="{{ asset('assets/images/bg-sertifikat.jpg') }}" alt="">
            <div class="dti-logo">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div class="dti-icon"><img src="{{ asset('svg/dti.svg') }}" alt="DTI Logo"></div>
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
                                <th class="component-col">Aspek yang Dinilai</th>
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
            // Validate number inputs
            $("input[type='number']").on("input", function() {
                if (this.value < 0) this.value = 0;
                if (this.value > 100) this.value = 100;
            });

            // Set default date
            document.getElementById('certificateDate').value = new Date().toISOString().split('T')[0];
            document.getElementById('testDate').value = new Date().toISOString().split('T')[0];
            document.getElementById('location').value = 'Bandung';
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
            const studentNIS = document.getElementById('studentNIS').value;
            const schoolName = document.getElementById('schoolName').value;
            const schoolAddress = document.getElementById('schoolAddress').value;
            const competency = document.getElementById('competency').value;
            const projectTitle = document.getElementById('projectTitle').value;
            const institutionName = document.getElementById('institutionName').value;
            const institutionAddress = document.getElementById('institutionAddress').value;
            const division = document.getElementById('division').value;
            const testDate = document.getElementById('testDate').value;
            const directorName = document.getElementById('directorName').value;
            const headName = document.getElementById('headName').value;
            const certificateDate = document.getElementById('certificateDate').value;
            const location = document.getElementById('location').value;
            const unjukKerja = parseInt(document.getElementById('unjuk_kerja').value) || 0;
            const penguasaanMateri = parseInt(document.getElementById('penguasaan_materi').value) || 0;
            const sikap = parseInt(document.getElementById('sikap').value) || 0;
            const laporan = parseInt(document.getElementById('laporan').value) || 0;
            const ujiKompetensi = parseInt(document.getElementById('uji_kompetensi').value) || 0;

            // Validate required fields
            if (!studentName || !studentNIS || !schoolName || !schoolAddress || !competency || !projectTitle ||
                !institutionName || !institutionAddress || !division || !testDate || !directorName || !headName || 
                !certificateDate || !location || !document.getElementById('unjuk_kerja').value || 
                !document.getElementById('penguasaan_materi').value || !document.getElementById('sikap').value || 
                !document.getElementById('laporan').value || !document.getElementById('uji_kompetensi').value) {
                alert('Mohon lengkapi semua field yang diperlukan!');
                return;
            }

            // Update front page
            document.getElementById('printStudentName').textContent = studentName;
            document.getElementById('printStudentNIS').textContent = studentNIS;
            document.getElementById('printSchoolName').textContent = schoolName;
            document.getElementById('printSchoolAddress').textContent = schoolAddress;
            document.getElementById('printCompetency').textContent = competency;
            document.getElementById('printProjectTitle').textContent = projectTitle;
            document.getElementById('printInstitutionName').textContent = institutionName;
            document.getElementById('printInstitutionAddress').textContent = institutionAddress;
            document.getElementById('printDivision').textContent = division;
            document.getElementById('printTestDate').textContent = formatDate(testDate);
            document.getElementById('printDirectorName').textContent = directorName;

            // Update back page
            document.getElementById('printCertificateDate').textContent = `${location}, ${formatDate(certificateDate)}`;
            document.getElementById('printHeadName').textContent = headName;

            // Generate assessment table
            const assessments = [
                { no: '1.', label: 'Unjuk/Cara Kerja/Praktik', score: unjukKerja },
                { no: '2.', label: 'Penguasaan Materi/Knowledge', score: penguasaanMateri },
                { no: '3.', label: 'Sikap/Attitude', score: sikap },
                { no: '4.', label: 'Laporan Praktik', score: laporan },
                { no: '5.', label: 'Nilai Uji Kompetensi', score: ujiKompetensi }
            ];

            let tableHTML = '';
            let totalScore = 0;
            let totalItems = assessments.length;

            assessments.forEach(item => {
                const grade = getGrade(item.score);
                totalScore += item.score;

                tableHTML += `<tr>
                    <td class="number-col">${item.no}</td>
                    <td class="component-col">${item.label}</td>
                    <td class="score-col">${item.score}</td>
                    <td class="grade-col">${grade}</td>
                </tr>`;
            });

            const finalScore = Math.round(totalScore / totalItems);
            tableHTML += `<tr class="final-row">
                <td class="number-col" colspan="2">Nilai Akhir</td>
                <td class="score-col">${finalScore}</td>
                <td class="grade-col">${getGrade(finalScore)}</td>
            </tr>`;

            document.getElementById('assessmentTableBody').innerHTML = tableHTML;

            alert('Sertifikat berhasil di-generate! Klik "Print Sertifikat" untuk melihat preview.');
        }
    </script>
</body>

</html>
