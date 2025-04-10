<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>AttenDti</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
                margin: 0;
            }

            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>

<body class="min-h-screen p-4 bg-gray-50 md:p-8">
    <div id="form-container" class="max-w-4xl p-6 mx-auto bg-white shadow-lg rounded-xl md:p-8">
        <h1 class="mb-8 text-3xl font-bold text-center text-gray-800">Formulir Exit Clearance</h1>

        <form class="space-y-12" id="clearanceForm">
            <section>
                <h2 class="pb-2 mb-4 text-xl font-semibold text-gray-700 border-b">Pengalaman Program</h2>
                <div class="mt-4 space-y-4">
                    <div class="grid items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">
                            1. Bagaimana Anda menilai pengalaman Anda secara keseluruhan selama magang/praktik kerja di
                            DTI?
                        </label>
                        <input type="text" name="question1" placeholder="Keterangan"
                            class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input1">
                    </div>
                </div>
                <div class="mt-4 space-y-4">
                    <div class="grid items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">
                            2. Apakah tugas yang diberikan sesuai dengan harapan dan bidang studi Anda?
                        </label>
                        <input type="text" name="question2" placeholder="Keterangan"
                            class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input2">
                    </div>
                </div>
                <div class="mt-4 space-y-4">
                    <div class="grid items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">
                            3. Bagaimana Anda menilai dukungan yang Anda terima dari PIC dan tim kerja?
                        </label>
                        <input type="text" name="question3" placeholder="Keterangan"
                            class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input3">
                    </div>
                </div>
                <div class="mt-4 space-y-4">
                    <div class="grid items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">
                            4. Bagaimana Anda menilai fasilitas dan sumber daya yang tersedia untuk mendukung kerja
                            Anda?
                        </label>
                        <input type="text" name="question4" placeholder="Keterangan"
                            class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input4">
                    </div>
                </div>
                <div class="mt-4 space-y-4">
                    <div class="grid items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">
                            5. Bagaimana Anda merasa keterampilan Anda berkembang selama program ini?
                        </label>
                        <input type="text" name="question5" placeholder="Keterangan"
                            class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input5">
                    </div>
                </div>
            </section>

            <section>
                <h2 class="pb-2 mb-4 text-xl font-semibold text-gray-700 border-b">Saran dan Umpan Balik</h2>
                <div class="mt-4 space-y-4">
                    <div class="grid items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">
                            6. Apa aspek terbaik dari program magang/praktik kerja di DTI yang paling Anda sukai?
                        </label>
                        <input type="text" name="question6" placeholder="Keterangan"
                            class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input6">
                    </div>
                </div>
                <div class="mt-4 space-y-4">
                    <div class="grid items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">
                            7. Apa yang menurut Anda perlu ditingkatkan dalam program ini di DTI?
                        </label>
                        <input type="text" name="question7" placeholder="Keterangan"
                            class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input7">
                    </div>
                </div>
                <div class="mt-4 space-y-4">
                    <div class="grid items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">
                            8. Apakah pengalaman ini membantu Anda dalam merencanakan karir di masa depan?
                        </label>
                        <input type="text" name="question8" placeholder="Keterangan"
                            class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input8">
                    </div>
                </div>
                <div class="mt-4 space-y-4">
                    <div class="grid items-center gap-4">
                        <label class="text-sm font-medium text-gray-700">
                            9. Apakah ada saran atau umpan balik lain yang ingin Anda berikan untuk peningkatan program
                            ini di DTI?
                        </label>
                        <input type="text" name="question9" placeholder="Keterangan"
                            class="w-full p-2 border border-gray-300 rounded-md sync-input" data-target="modal-input9">
                    </div>
                </div>
            </section>

            <div class="flex justify-end pt-6 space-x-4 no-print">
                <div onclick="openModal()"
                    class="px-6 py-2 text-white bg-blue-600 rounded-md cursor-pointer hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Print
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div id="userReportModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-70">
        <div class="bg-gray-50 text-white rounded-lg shadow-lg m-6 p-6 h-[95vh] max-w-xl md:max-w-4xl w-full">
            <div class="overflow-y-auto h-[80vh] space-y-4">
                <!-- Container yang akan dicetak -->
                <div id="laporanTransaksi"
                    class="h-auto p-8 text-black bg-white border-2 rounded-md laporanTransaksi max-width-full"
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
                                            <div class="text-base font-bold">DIREKTORAT TEKNOLOGI INFORMASI ITB</div>
                                            <div class="text-sm text-gray-600">Gedung CRCS Lantai 4, Jalan Ganesha
                                                Nomor 10 Bandung 40132 Telp: +6222 86010037</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 text-center text-white bg-blue-600 print-bg">
                                            FORMULIR EXIT CLEARANCE
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-0">
                                            <table class="w-full text-sm border-t border-gray-800">
                                                <tr>
                                                    <td class="p-1 border-r border-gray-800">Nomor : FRM.07-OPL.01</td>
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
                        <div class="mt-4 space-y-4">
                            <div class="space-y-2 text-center">
                                <h1 class="text-2xl font-bold">Form Evaluasi Exit Interview</h1>
                                <h2 class="text-xl">Personel Magang/PKL</h2>
                            </div>
                            <div class="space-y-4">
                                <h3 class="text-xl font-bold">Informasi Umum</h3>
                                <div class="space-y-2">
                                    <table class="w-full mb-2">
                                        <tr>
                                            <td class="w-48">Nama Personel</td>
                                            <td>: {{ Auth::user()->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Institusi/Sekolah</td>
                                            <td>: {{ Auth::user()->institution }}</td>
                                        </tr>
                                        <tr>
                                            <td>Periode Magang/PKL</td>
                                            <td>: {{ Auth::user()->period_start_date }} s/d
                                                {{ Auth::user()->period_end_date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama PIC Offboarding</td>
                                            <td>: {{ Auth::user()->username }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Evaluasi</td>
                                            <td>: {{ date('d M Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <h3 class="text-xl font-bold">Pengalaman Program</h3>
                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <p class="font-medium">
                                            1. Bagaimana Anda menilai pengalaman Anda secara keseluruhan selama
                                            magang/praktik kerja di DTI?
                                        </p>
                                        <div id="modal-input1"
                                            class="w-full h-12 px-3 py-2 border border-gray-300 rounded">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="font-medium">
                                            2. Apakah tugas yang diberikan sesuai dengan harapan dan bidang studi Anda?
                                        </p>
                                        <div id="modal-input2"
                                            class="w-full h-12 px-3 py-2 border border-gray-300 rounded">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="font-medium">
                                            3. Bagaimana Anda menilai dukungan yang Anda terima dari PIC dan tim kerja?
                                        </p>
                                        <div id="modal-input3"
                                            class="w-full h-12 px-3 py-2 border border-gray-300 rounded">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="font-medium">
                                            4. Bagaimana Anda menilai fasilitas dan sumber daya yang tersedia untuk
                                            mendukung kerja Anda?
                                        </p>
                                        <div id="modal-input4"
                                            class="w-full h-12 px-3 py-2 border border-gray-300 rounded">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <p class="font-medium">
                                            5. Bagaimana Anda merasa keterampilan Anda berkembang selama program ini?
                                        </p>
                                        <div id="modal-input5"
                                            class="w-full h-12 px-3 py-2 border border-gray-300 rounded">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>

                                <h3 class="text-xl font-bold">Saran dan Umpan Balik</h3>
                                <div class="space-y-2">
                                    <p class="font-medium">
                                        6. Apa aspek terbaik dari program magang/praktik kerja di DTI yang paling Anda
                                        sukai?
                                    </p>
                                    <div id="modal-input6"
                                        class="w-full h-12 px-3 py-2 border border-gray-300 rounded">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <p class="font-medium">
                                        7. Apa yang menurut Anda perlu ditingkatkan dalam program ini di DTI?
                                    </p>
                                    <div id="modal-input7"
                                        class="w-full h-12 px-3 py-2 border border-gray-300 rounded">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <p class="font-medium">
                                        8. Apakah pengalaman ini membantu Anda dalam merencanakan karir di masa depan?
                                    </p>
                                    <div id="modal-input8"
                                        class="w-full h-12 px-3 py-2 border border-gray-300 rounded">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <p class="font-medium">
                                        9. Apakah ada saran atau umpan balik lain yang ingin Anda berikan untuk
                                        peningkatan program ini di DTI?
                                    </p>
                                    <div id="modal-input9"
                                        class="w-full h-12 px-3 py-2 border border-gray-300 rounded">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-12 mb-8">
                                <!-- Location and Date -->
                                <div class="mb-8 text-right">
                                    <p>Bandung, {{ date('d M Y') }}</p>
                                </div>

                                <!-- Signature Grid -->
                                <div class="grid grid-cols-3 gap-8 text-center">
                                    <!-- Personel Magang/PKL -->
                                    <div class="space-y-20">
                                        <p>Personel Magang/PKL,</p>
                                        <div class="flex items-end justify-center h-24">
                                            <p>( {{ Auth::user()->full_name }} )</p>
                                        </div>
                                        <div class="flex items-center justify-center gap-2">
                                            <span>NIP/Nopeg.</span>
                                            <div class="w-32 text-center border-b border-gray-400">
                                                <p>{{ Auth::user()->identity_number }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PIC Offboarding -->
                                    <div class="space-y-20">
                                        <p>PIC Offboarding,</p>
                                        <div class="flex items-end justify-center h-24">
                                            <p>( ................................. )</p>
                                        </div>
                                        <div class="flex items-center justify-center gap-2">
                                            <span>NIP/Nopeg.</span>
                                            <div class="w-32 text-center border-b border-gray-400">
                                                <p>.....................</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kasubdit -->
                                    <div class="space-y-20">
                                        <p>Kasubdit. Operasional & Layanan TI,</p>
                                        <div class="flex items-end justify-center h-[73px]">
                                            <p>( ................................. )</p>
                                        </div>
                                        <div class="flex items-center justify-center gap-2">
                                            <span>NIP/Nopeg.</span>
                                            <div class="w-32 text-center border-b border-gray-400">
                                                <p>.....................</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tombol Aksi di dalam modal -->
                    <div class="flex py-3 gap-x-2 no-print">
                        <button type="button"
                            class="w-full px-4 py-2 text-sm font-medium text-gray-800 border-2 rounded-md no-print hover:text-gray-900"
                            id="userReportClose" onclick="closeModal()">Kembali</button>
                        <button type="button"
                            class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md no-print hover:bg-green-700"
                            onclick="printDiv('laporanTransaksi')">Cetak Laporan</button>
                    </div>
                </div>
            </div>

            <script>
                // Fungsi untuk menyalin nilai dari form ke kontainer modal
                function syncFormToModal() {
                    // Untuk setiap input di form yang memiliki kelas .sync-input
                    document.querySelectorAll('.sync-input').forEach(input => {
                        // Ambil target modal dari atribut data-target
                        const targetId = input.getAttribute('data-target');
                        if (targetId) {
                            const modalContainer = document.getElementById(targetId);
                            if (modalContainer) {
                                // Jika terdapat elemen <p> di dalam kontainer, set textContent-nya
                                const pElement = modalContainer.querySelector('p');
                                if (pElement) {
                                    pElement.textContent = input.value;
                                } else {
                                    modalContainer.textContent = input.value;
                                }
                            }
                        }
                    });
                }

                // Fungsi untuk membuka modal dan menyinkronkan data
                function openModal() {
                    syncFormToModal();
                    document.getElementById('userReportModal').classList.remove('hidden');
                    document.getElementById('userReportModal').classList.add('flex');
                }

                function closeModal() {
                    document.getElementById('userReportModal').classList.add('hidden');
                    document.getElementById('userReportModal').classList.remove('flex');
                }

                // Fungsi cetak laporan
                function printDiv(divId) {
                    // Pastikan data terbaru disinkronkan
                    syncFormToModal();
                    var printContents = document.getElementById(divId).innerHTML;
                    var originalContents = document.body.innerHTML;

                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                    // Opsional: reload halaman untuk mengembalikan state semula
                    location.reload();
                }
            </script>
</body>

</html>
