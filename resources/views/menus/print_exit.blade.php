<! <DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AttenDti</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <style>
        .laporanTransaksi {
            counter-reset: page-counter;
        }

        @media print {
            .page-header {
                display: table;
                width: 100%;
                margin-bottom: 20px;
            }

            .page-content {
                position: relative;
            }

            .page-break {
                page-break-before: always;
            }

            #laporanContainer table:first-of-type {
                display: none;
            }

            .page-content {
                margin-top: 180px;
            }
        }
    </style>

    <body class="bg-gray-50 min-h-screen p-4 md:p-8">
        <div id="form-container" class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6 md:p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Formulir Exit Clearance</h1>

            <form class="space-y-12">
                <section>
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Peralatan Kerja</h2>
                    <div class="space-y-4">
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700" for="pc-input">Desktop PC / Laptop</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="pc" value="Y" class="form-radio text-blue-600"
                                        id="pc-y">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="pc" value="T" class="form-radio text-blue-600"
                                        id="pc-t">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md" id="pc-keterangan">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Penyimpanan Data Eksternal</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="storage" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="storage" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Kendaraan <span
                                    class="text-gray-300">(Mobil/Motor)</span></label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="vehicle" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="vehicle" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Handphone</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="handphone" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="handphone" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">ATK</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="atk" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="atk" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">ID Card</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="idcard" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="idcard" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Kartu Parkir</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="parkingcard" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="parkingcard" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Kartu Asuransi</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="insurancecard" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="insurancecard" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Access Door <span
                                    class="text-gray-300">(Card/Biometrik)</span></label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="accessdoor" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="accessdoor" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Tugas & Tanggung Jawab Kerja
                    </h2>
                    <div class="space-y-4">
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Serah terima pekerjaan <span
                                    class="text-gray-300">(pekerjaan dalam proses, tertunda, yang belum
                                    dilakukan)</span></label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="handover" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="handover" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Transfer Knowledge pekerjaan</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="knowledge_transfer" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="knowledge_transfer" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Serah terima File-file pekerjaan <span
                                    class="text-gray-300">(softcopy & hardcopy)</span></label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="file_handover" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="file_handover" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Serah terima SOP dan Instruksi
                                Kerja</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="sop_handover" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="sop_handover" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Penyelesaian masalah keuangan</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="financial_issues" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="financial_issues" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Aksesibilitas</h2>
                    <div class="space-y-4">
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">ITB Account</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="itb" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="itb" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Akun Email</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="email" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="email" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Akun Aplikasi</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="app_account" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="app_account" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Akun Sistem <span
                                    class="text-gray-300">(Infra)</span></label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="system_account" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="system_account" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                        <div class="grid gap-4 md:grid-cols-[1fr,auto,1fr] items-center">
                            <label class="text-sm font-medium text-gray-700">Whatsapp Group</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="whatsapp_group" value="Y"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="whatsapp_group" value="T"
                                        class="form-radio text-blue-600">
                                    <span class="ml-2">Tidak</span>
                                </label>
                            </div>
                            <input type="text" placeholder="Keterangan"
                                class="w-full p-2 border border-gray-300 rounded-md">
                        </div>
                    </div>
                </section>

                <div class="flex justify-end space-x-4 pt-6">
                    <div onclick="openModal()"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 cursor-pointer">
                        Print
                    </div>
                </div>
            </form>
        </div>

        <div id="userReportModal"
            class="fixed inset-0 items-center justify-center bg-black bg-opacity-70 z-50 hidden">
            <div class="bg-gray-50 text-white rounded-lg shadow-lg m-6 p-6 h-[95vh] max-w-xl md:max-w-4xl w-full">
                <div class="overflow-y-auto h-[80vh] space-y-4">
                    {{-- Printed Container --}}
                    <div id="laporanTransaksi"
                        class="laporanTransaksi h-auto p-8 rounded-md max-width-full border-2 bg-white text-black"
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
                                                <div class="font-bold">FORMULIR EXIT CLEARANCE
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
                                <table class="w-full mb-2">
                                    <tr>
                                        <td class="w-48">Nama</td>
                                        <td>: {{ Auth::user()->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIP/Nopeg</td>
                                        <td>: {{ Auth::user()->identity_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat (sesuai KTP)</td>
                                        <td>: {{ Auth::user()->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td>: {{ Auth::user()->position }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Exit Clearance</td>
                                        <td>: {{ date('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Hari/Tanggal Terakhir Bekerja</td>
                                        <td>: {{ Auth::user()->period_end_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alasan Exit Clearance</td>
                                        <td class="flex items-center">
                                            <div class="flex items-center flex-row">
                                                <span class="mr-1">: Mutasi Kerja</span>
                                                <input type="checkbox" name="mutasi_kerja" id="mutasi_kerja"
                                                    class="mr-3">
                                            </div>
                                            <div class="flex items-center flex-row">
                                                <span class="mr-1">Keluar Kerja</span>
                                                <input type="checkbox" name="keluar_kerja" id="keluar_kerja"
                                                    class="mr-3">
                                            </div>
                                            <div class="flex items-center flex-row">
                                                <span class="mr-1">Selesai masa Kerja/Magang</span>
                                                <input type="checkbox" checked name="selesai_masa_kerja"
                                                    id="selesai_masa_kerja">
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                <p class="mb-2">Saya yang bertandatangan dibawah ini, menyatakan penyelesaian
                                    kewajiban
                                    yang
                                    berhubungan
                                    dengan pekerjaan dan akan segera diselesaikan selambat-lambatnya 1 hari kerja
                                    sebelum
                                    hari terakhir
                                    bekerja.</p>

                                <table class="w-full border border-gray-800">
                                    <thead>
                                        <tr>
                                            <th class="border border-gray-800 p-1">PROSES</th>
                                            <th class="border border-gray-800 p-1">ITEM</th>
                                            <th class="border border-gray-800 p-1" colspan="2">STATUS</th>
                                            <th class="border border-gray-800 p-1">KETERANGAN</th>
                                            <th class="border border-gray-800 p-1">TTD PIC</th>
                                        </tr>
                                        <tr>
                                            <th class="border border-gray-800 p-1"></th>
                                            <th class="border border-gray-800 p-1"></th>
                                            <th class="border border-gray-800 p-1 w-12">Y</th>
                                            <th class="border border-gray-800 p-1 w-12">T</th>
                                            <th class="border border-gray-800 p-1"></th>
                                            <th class="border border-gray-800 p-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border border-gray-800 p-1" rowspan="10">Peralatan Kerja</td>
                                            <td class="border border-gray-800 p-1">Desktop PC / Laptop</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Penyimpanan Data Eksternal</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Kendaraan (mobil/motor)</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Handphone</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">ATK</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">ID Card</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Kartu Parkir</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Kartu Asuransi</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Access Door (Card/Biometrik)</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Lainnya :</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>

                                        <tr>
                                            <td class="border border-gray-800 p-1" rowspan="6">Tugas & Tanggung
                                                jawab
                                                Kerja</td>
                                            <td class="border border-gray-800 p-1">Serah terima pekerjaan (pekerjaan
                                                dalam
                                                proses,
                                                tertunda, yang belum dilakukan)</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Transfer Knowledge pekerjaan</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Serah terima File-file pekerjaan
                                                (softcopy &
                                                hardcopy)
                                            </td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Serah terima SOP dan Instruksi Kerja
                                            </td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Penyelesaian masalah keuangan</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">Lainnya:</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>

                                        <tr>
                                            <td class="border border-gray-800 p-1" rowspan="5">Aksesibilitas</td>
                                            <td class="border border-gray-800 p-1">
                                                Penonaktifan:
                                                <br>
                                                a. ITB Account:
                                            </td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">b. Akun Email:</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">c. Akun Aplikasi:</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">d. Akun Sistem (infra):</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                        <tr>
                                            <td class="border border-gray-800 p-1">e. Whatsapp Grup</td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1 text-center align-middle"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                            <td class="border border-gray-800 p-1"></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <p class="mt-6 mb-4">Dengan mengisi dan menandatangani formulir ini, saya menyatakan
                                    bahwa
                                    saya telah
                                    memahami
                                    dan menyetujui hal-hal berikut:</p>
                                <ul class="list-decimal pl-6 mb-4 space-y-2">
                                    <li>Saya akan mengembalikan semua properti DTI ITB dan ITB yang telah dipinjamkan
                                        kepada
                                        saya,
                                        maksimal
                                        dalam waktu 30 hari kerja setelah tanggal akhir masa kerja saya.</li>
                                    <li>Saya telah melakukan penghapusan semua data DTI yang bersifat rahasia, baik yang
                                        disimpan dalam
                                        perangkat pribadi atau pada akun pribadi saya.</li>
                                    <li>Saya akan menyelesaikan semua pekerjaan yang belum selesai saya kerjakan sebelum
                                        tanggal aktif
                                        masa
                                        kerja saya.</li>
                                    <li>Saya akan menyelesaikan semua kewajiban keuangan yang belum saya selesaikan
                                        sebelum
                                        tanggal
                                        akhir masa kerja saya.
                                    </li>
                                    <li>Saya akan mengikuti wawancara exit dengan atasan langsung atau penanggung jawab
                                        ditempat saya
                                        bekerja
                                    </li>
                                </ul>
                                <p class="mb-4">Saya juga menyatakan bahwa saya tidak akan membocorkan rahasia DTI
                                    ITB
                                    dan ITB. Saya
                                    memahami bahwa jika saya tidak memenuhi salah satu dari hal-hal di atas, maka DTI
                                    ITB
                                    maupun ITB
                                    dapat
                                    mengambil tindakan yang diperlukan, termasuk tindakan hukum sesuai dengan peraturan
                                    yang
                                    berlaku.
                                </p>

                                <div class="w-full max-w-4xl mx-auto">
                                    <div class="text-right mb-4">
                                        Bandung, _____________ 20__
                                    </div>

                                    <table class="w-full border border-gray-800">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="dark w-1/3 bg-[#1e3a8a] text-white p-2 border border-gray-800">
                                                    DIAJUKAN OLEH
                                                </th>
                                                <th
                                                    class="dark w-1/3 bg-[#1e3a8a] text-white p-2 border border-gray-800">
                                                    DIKETAHUI
                                                    OLEH
                                                </th>
                                                <th
                                                    class="dark w-1/3 bg-[#1e3a8a] text-white p-2 border border-gray-800">
                                                    <div>DISETUJUI OLEH</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border border-gray-800 h-40"></td>
                                                <td class="border border-gray-800 h-40"></td>
                                                <td class="border h-40 flex flex-col justify-start items-center">
                                                    <div class="font-normal text-sm text-center">
                                                        DIREKTUR TEKNOLOGI<br>INFORMASI
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-800 p-2 text-center"></td>
                                                <td class="border border-gray-800 p-2 text-center"></td>
                                                <td class="border border-gray-800 p-2 text-center">Mugi Sugiarto, S.Si,
                                                    M.A.B.</td>
                                            </tr>
                                            <tr>
                                                <td class="border border-gray-800 p-2 text-center">NIP/Nopeg.
                                                    _____________
                                                </td>
                                                <td class="border border-gray-800 p-2 text-center">NIP/Nopeg.
                                                    _____________
                                                </td>
                                                <td class="border border-gray-800 p-2 text-center">Nopeg. 106000608
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
            const FORM_TABLE_MAPPING = {
                'pc': {
                    rowIndex: 2,
                    section: 'Peralatan Kerja'
                },
                'storage': {
                    rowIndex: 3,
                    section: 'Peralatan Kerja'
                },
                'vehicle': {
                    rowIndex: 4,
                    section: 'Peralatan Kerja'
                },
                'handphone': {
                    rowIndex: 5,
                    section: 'Peralatan Kerja'
                },
                'atk': {
                    rowIndex: 6,
                    section: 'Peralatan Kerja'
                },
                'idcard': {
                    rowIndex: 7,
                    section: 'Peralatan Kerja'
                },
                'parkingcard': {
                    rowIndex: 8,
                    section: 'Peralatan Kerja'
                },
                'insurancecard': {
                    rowIndex: 9,
                    section: 'Peralatan Kerja'
                },
                'accessdoor': {
                    rowIndex: 10,
                    section: 'Peralatan Kerja'
                },

                'handover': {
                    rowIndex: 12,
                    section: 'Tugas & Tanggung Jawab'
                },
                'knowledge_transfer': {
                    rowIndex: 13,
                    section: 'Tugas & Tanggung Jawab'
                },
                'file_handover': {
                    rowIndex: 14,
                    section: 'Tugas & Tanggung Jawab'
                },
                'sop_handover': {
                    rowIndex: 15,
                    section: 'Tugas & Tanggung Jawab'
                },
                'financial_issues': {
                    rowIndex: 16,
                    section: 'Tugas & Tanggung Jawab'
                },

                'itb': {
                    rowIndex: 18,
                    section: 'Aksesibilitas'
                },
                'email': {
                    rowIndex: 19,
                    section: 'Aksesibilitas'
                },
                'app_account': {
                    rowIndex: 20,
                    section: 'Aksesibilitas'
                },
                'system_account': {
                    rowIndex: 21,
                    section: 'Aksesibilitas'
                },
                'whatsapp_group': {
                    rowIndex: 22,
                    section: 'Aksesibilitas'
                }
            };

            function getKeteranganInput(radioName) {
                const radioGroup = document.querySelector(`input[name="${radioName}"]`)?.closest('.grid');
                return radioGroup ? radioGroup.querySelector('input[type="text"]') : null;
            }

            function updateTable(name, value, keterangan) {
                const mapping = FORM_TABLE_MAPPING[name];
                console.log('Mapping untuk', name, ':', mapping);
                if (!mapping) return;

                const table = document.querySelector('#laporanContainer table:nth-of-type(2)') || document.querySelector(
                    '#laporanContainer table');
                if (!table) return;

                const tbody = table.querySelector('tbody');
                if (!tbody) return;

                const tbodyIndex = mapping.rowIndex - 2;
                const row = tbody.rows[tbodyIndex];
                console.log('Row ditemukan:', row);
                if (!row) return;

                let yColumn, tColumn, keteranganColumn;
                if (row.cells.length === 6) {
                    yColumn = row.cells[2];
                    tColumn = row.cells[3];
                    keteranganColumn = row.cells[4];
                } else if (row.cells.length === 5) {
                    yColumn = row.cells[1];
                    tColumn = row.cells[2];
                    keteranganColumn = row.cells[3];
                } else {
                    console.warn('Struktur sel tidak sesuai pada row:', row);
                    return;
                }

                yColumn.textContent = '';
                tColumn.textContent = '';

                if (value === 'Y') {
                    yColumn.textContent = '√';
                } else if (value === 'T') {
                    tColumn.textContent = '√';
                }

                if (typeof keterangan !== 'undefined') {
                    keteranganColumn.textContent = keterangan;
                }
            }

            function setupFormListeners() {
                document.querySelectorAll('input[type="radio"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        const keteranganInput = getKeteranganInput(this.name);
                        updateTable(this.name, this.value, keteranganInput ? keteranganInput.value : '');
                    });
                });

                document.querySelectorAll('.grid input[type="text"]').forEach(input => {
                    const gridContainer = input.closest('.grid');
                    const radioName = gridContainer.querySelector('input[type="radio"]')?.name;
                    if (radioName) {
                        input.addEventListener('input', function() {
                            const checkedRadio = document.querySelector(`input[name="${radioName}"]:checked`);
                            if (checkedRadio) {
                                updateTable(radioName, checkedRadio.value, this.value);
                            }
                        });
                    }
                });
            }

            function openModal() {
                const modal = document.getElementById('userReportModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');

                document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
                    const keteranganInput = getKeteranganInput(radio.name);
                    updateTable(radio.name, radio.value, keteranganInput ? keteranganInput.value : '');
                });
            }

            function closeModal() {
                const modal = document.getElementById('userReportModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            function printDiv(divId) {
                const printContents = document.getElementById(divId).innerHTML;
                const originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;

                setupFormListeners();
                setupModalListeners();
            }

            function setupModalListeners() {
                const printButton = document.querySelector('[onclick="openModal()"]');
                if (printButton) {
                    printButton.onclick = openModal;
                }

                const closeButton = document.getElementById('userReportClose');
                if (closeButton) {
                    closeButton.onclick = closeModal;
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                setupFormListeners();
                setupModalListeners();
            });

            function processText(text) {
                const chunkSize = 25;
                let result = '';
                for (let i = 0; i < text.length; i += chunkSize) {
                    result += text.substring(i, i + chunkSize) + '<br>';
                }
                return result;
            }

            function updateTable(name, value, keterangan) {
                const mapping = FORM_TABLE_MAPPING[name];
                if (!mapping) return;

                const table = document.querySelector('#laporanContainer table:nth-of-type(2)') || document.querySelector(
                    '#laporanContainer table');
                if (!table) return;

                const tbody = table.querySelector('tbody');
                if (!tbody) return;

                const tbodyIndex = mapping.rowIndex - 2;
                const row = tbody.rows[tbodyIndex];
                if (!row) return;

                let yColumn, tColumn, keteranganColumn;
                if (row.cells.length === 6) {
                    yColumn = row.cells[2];
                    tColumn = row.cells[3];
                    keteranganColumn = row.cells[4];
                } else if (row.cells.length === 5) {
                    yColumn = row.cells[1];
                    tColumn = row.cells[2];
                    keteranganColumn = row.cells[3];
                } else {
                    console.warn('Struktur sel tidak sesuai pada row:', row);
                    return;
                }

                yColumn.textContent = '';
                tColumn.textContent = '';

                if (value === 'Y') {
                    yColumn.textContent = '√';
                } else if (value === 'T') {
                    tColumn.textContent = '√';
                }

                if (typeof keterangan !== 'undefined') {
                    keteranganColumn.innerHTML = processText(keterangan);
                }
            }
        </script>

    </body>

    </html>
