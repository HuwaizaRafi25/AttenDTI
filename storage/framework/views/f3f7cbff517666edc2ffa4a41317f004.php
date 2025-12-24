<!-- Modal Import Attendance -->
<div id="importAttendanceModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-[800px] max-h-[95vh] flex flex-row justify-between relative">
        <!-- Panel Pertama: How to Import -->
        <div class="w-1/2 p-6 overflow-auto bg-gray-50 rounded-lg">
            <h2 class="text-xl font-bold mb-4">How to Import Attendance Data</h2>
            <p>Ikuti langkah-langkah berikut untuk mengimpor data kehadiran:</p>
            <ul class="list-disc pl-5 my-2">
                <li>Pastikan semua <code>itb_account</code> terdaftar sebagai pengguna dengan peran 'user'.</li>
                <li><strong>Peringatan:</strong> Mengimpor data dengan <code>date</code> dan <code>itb_account</code>
                    yang sudah ada akan menimpa catatan kehadiran sebelumnya.</li>
                <li>Gunakan format yang benar: <code>date</code>, <code>check_in</code>, <code>itb_account</code>,
                    <code>location</code>, <code>attendance</code>.
                </li>
            </ul>
            <a href="<?php echo e(asset('templates/import_attendance_template.xlsx')); ?>" download
                class="text-blue-500 underline">Unduh Template</a>
        </div>

        <!-- Panel Kedua: Import -->
        <div class="w-1/2 p-6 overflow-auto">
            <div class="tabs mb-4">
                <button class="tab active rounded-lg" onclick="showTab('rules')">Rules</button>
                <button class="tab rounded-lg" onclick="showTab('import')">Import</button>
            </div>
            <div id="rules" class="tab-content active">
                <p>Ringkasan peraturan untuk mengimpor data kehadiran:</p>
                <ul class="list-disc pl-5 my-2">
                    <li>Pastikan file Excel mengikuti format template.</li>
                    <li>Semua kolom wajib diisi.</li>
                    <li>Data yang diimpor akan menimpa data yang ada jika ada konflik.</li>
                </ul>
            </div>
            <form action="<?php echo e(route('attendance.import')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div id="import" class="tab-content w-full justify-between hidden">
                    <div class="dropzone border-2 border-dashed border-gray-300 p-4 text-center w-full">
                        <p>Seret dan lepaskan file Anda di sini atau <span
                                class="text-blue-500 underline cursor-pointer"
                                onclick="document.getElementById('attendanceFile').click()">klik untuk memilih</span>
                        </p>
                        <input type="file" id="attendanceFile" class="hidden" name="attendance_file"
                            accept=".xlsx, .xls">
                        <p id="fileName" class="mt-2 text-gray-600"></p>
                        <div id="errorNotification" class="mt-2 text-red-500"></div> <!-- Notifikasi kesalahan -->
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button id="importButton" type="submit"
                            class="bg-gray-300 text-white px-4 py-2 rounded-lg cursor-not-allowed" disabled>
                            Import
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tombol Tutup -->
        <div class="rounded-t-lg p-3 flex items-center justify-end absolute top-0 right-0">
            <button id="closeImportAttendanceModal" type="button"
                class="w-6 h-6 flex items-center justify-center text-gray-500 hover:text-gray-700 transition-colors">
                <img src="<?php echo e(asset('assets/images/icons/xmark.svg')); ?>" alt="Close"
                    class="w-4 h-4 opacity-75 hover:opacity-100">
            </button>
        </div>
    </div>
</div>

<!-- CSS Tambahan -->
<style>
    .tabs button {
        padding: 8px 16px;
        margin-right: 8px;
        background-color: #f0f0f0;
        border: none;
        cursor: pointer;
    }

    .tabs button.active {
        background-color: #007bff;
        color: white;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .dropzone:hover {
        border-color: #007bff;
    }

    #errorNotification div {
        margin: 4px 0;
        padding: 4px;
        border-radius: 4px;
        background-color: #fee2e2;
    }
</style>

<!-- JavaScript untuk Fungsi Drag-and-Drop dan Tab -->
<script>
    const fileInput = document.getElementById('attendanceFile');
    const fileNameDisplay = document.getElementById('fileName');
    const dropzone = document.querySelector('.dropzone');

    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-blue-500');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('border-blue-500');
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-blue-500');
        const file = e.dataTransfer.files[0];
        if (file) {
            fileInput.files = e.dataTransfer.files;
            fileNameDisplay.textContent = `File terpilih: ${file.name}`;
            analyzeData(file);
        }
    });

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            fileNameDisplay.textContent = `File terpilih: ${fileInput.files[0].name}`;
            analyzeData(fileInput.files[0]);
        }
    });

    function showTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
            tab.classList.add('hidden');
        });
        document.getElementById(tabName).classList.add('active');
        document.getElementById(tabName).classList.remove('hidden');
        document.querySelectorAll('.tab').forEach(button => {
            button.classList.remove('active');
        });
        document.querySelector(`.tab[onclick="showTab('${tabName}')"]`).classList.add('active');
    }

    showTab('rules');

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log(csrfToken);

    function analyzeData(file) {
        const formData = new FormData();
        formData.append('attendance_file', file);

        fetch('/analyze-attendance', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log(response.status, response.statusText);
                return response.text(); // Lihat raw response
            })
            .then(text => {
                console.log(text);
                return JSON.parse(text);
            })
            .then(data => {
                const errorNotification = document.getElementById('errorNotification');
                const importButton = document.getElementById('importButton');

                errorNotification.innerHTML = '';

                if (data.success) {
                    importButton.classList.remove('bg-gray-300', 'cursor-not-allowed');
                    importButton.classList.add('bg-blue-500', 'hover:bg-blue-600', 'cursor-pointer');
                    importButton.disabled = false;
                } else {
                    importButton.disabled = true;
                    importButton.classList.add('bg-gray-300', 'cursor-not-allowed');
                    importButton.classList.remove('bg-blue-500', 'hover:bg-blue-600');

                    // Tampilkan semua error
                    if (data.errors && data.errors.length > 0) {
                        errorNotification.innerHTML = data.errors
                            .map(error => `<div class="text-red-500 text-sm">${error}</div>`)
                            .join('');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('errorNotification').innerHTML = `
            <div class="text-red-500">Gagal menganalisis file. Silakan coba lagi.</div>
        `;
            });
    }
</script>
<?php /**PATH C:\dev\attenDTI_FIX\AttenDTI\AttenDTI\resources\views/menus/modals/attendance/import_attendance_modal.blade.php ENDPATH**/ ?>