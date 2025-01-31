    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Surat Pernyataan Kerahasiaan</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            #formulir_perjanjian,
            #exit_clearance,
            #evaluasi_exit {
                display: none;
            }

            @media print {
                @page {
                    margin: 0;
                }

                .no-print {
                    display: none;
                }

                body {
                    padding: 0;
                    margin: 0;
                }

                .title-blue {
                    background-color: #B8CCE4 !important;
                    color: white !important;
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }

                .dark {
                    background-color: #1e3a8a !important;
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }

                #formulir_perjanjian.print-active,
                #exit_clearance.print-active,
                #evaluasi_exit.print-active {
                    display: block !important;
                }
            }
        </style>


        <script>
            function showformulir_perjanjian() {
                document.getElementById('formulir_perjanjian').classList.add('print-active');
                document.getElementById('exit_clearance').classList.remove('print-active');
                document.getElementById('evaluasi_exit').classList.remove('print-active');
                window.print();
                setTimeout(() => {
                    document.getElementById('formulir_perjanjian').classList.remove('print-active');
                }, 100);
            }

            function showexit_clearance() {
                document.getElementById('exit_clearance').classList.add('print-active');
                document.getElementById('formulir_perjanjian').classList.remove('print-active');
                document.getElementById('evaluasi_exit').classList.remove('print-active');
                window.print();
                setTimeout(() => {
                    document.getElementById('exit_clearance').classList.remove('print-active');
                }, 100);
            }

            function showevaluasi_exit() {
                document.getElementById('evaluasi_exit').classList.add('print-active');
                document.getElementById('formulir_perjanjian').classList.remove('print-active');
                document.getElementById('exit_clearance').classList.remove('print-active');
                window.print();
                setTimeout(() => {
                    document.getElementById('evaluasi_exit').classList.remove('print-active');
                }, 100);
            }
        </script>
    </head>

    <body class="bg-white">
        <div id="formulir_perjanjian" class="container mx-auto p-4 max-w-4xl">
            <table class="w-full border border-gray-800 table-fixed">
                <tr>
                    <td class="w-1/6 border-r border-gray-800 text-center p-2">
                        <img src="{{ asset('assets/images/logo_itb_512.png') }}" alt="Logo"
                            class="w-20 mx-auto my-2">
                    </td>
                    <td class="w-5/6">
                        <table class="w-full">
                            <tr>
                                <td class="text-center p-2">
                                    <div class="text-base font-bold">DIREKTORAT TEKNOLOGI INFORMASI ITB</div>
                                    <div class="text-sm text-gray-300">Gedung CRCS Lantai 4, Jalan Ganesha Nomor 10
                                        Bandung
                                        40132 Telp:
                                        +6222 86010037</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="title-blue text-center p-2">
                                    <div class="font-bold">SURAT PERNYATAAN MENJAGA KERAHASIAAN INFORMASI</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-0">
                                    <table class="w-full text-sm border-t-0 border-gray-800 text-gray-300">
                                        <tr>
                                            <td class="border-r border-gray-800 p-1">Nomor : FRM.01-OPL.08</td>
                                            <td class="border-r border-gray-800 p-1">Revisi : 0</td>
                                            <td class="border-r border-gray-800 p-1">Tanggal : 22 September 2023</td>
                                            <td class="p-1">Halaman : 1 dari 1</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <div class="mt-6 text-sm">
                <p class="mb-4">Pada hari ini, Jumat, Tanggal 22, Bulan September, Tahun 2023; saya yang bertanda
                    tangan
                    dibawah ini :</p>
                <table class="w-full mb-4">
                    <tr>
                        <td class="w-48">Nama</td>
                        <td>: {{ Auth::user()->full_name }}</td>
                    </tr>
                    <tr>
                        <td>No. Identitas</td>
                        <td>: {{ Auth::user()->nisn }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: {{ Auth::user()->address }}</td>
                    </tr>
                    <tr>
                        <td>Instansi/Perusahaan</td>
                        <td>: {{ Auth::user()->institution }}</td>
                    </tr>
                    <tr>
                        <td>Keperluan</td>
                        <td>: Praktik Kerja Lapangan (PKL)</td>
                    </tr>
                    <tr>
                        <td>Periode Penugasan</td>
                        <td>: {{ Auth::user()->period_start_date }} - {{ Auth::user()->period_end_date }}</td>
                    </tr>
                </table>

                <p class="mb-4">Dengan ini menyatakan hal-hal sebagai berikut:</p>
                <ul class="list-decimal pl-6 mb-4 space-y-2">
                    <li>Menjaga kerahasiaan semua atau setiap bagian dari informasi maupun data yang diperoleh berkaitan
                        dengan DTI ITB maupun ITB secara langsung maupun tidak langsung.</li>
                    <li>Tidak mengungkapkan Informasi rahasia kepada pihak lain atau memanfaatkan atau menggunakannya
                        untuk
                        maksud apapun terkait dengan segala sesuatu yang diketahui dan di kerjakan dalam melaksanakan
                        tugas
                        yang dapat berpotensi merugikan DTI ITB maupun ITB.</li>
                    <li>Tidak menyalahgunakan wewenang atas akses ke Sistem Teknologi Informasi yang ada di DTI ITB
                        maupun
                        ITB.</li>
                    <li>Tidak membagikan (share) User ID dan Password kepada pihak lain yang tidak berhak.</li>
                </ul>
                <p class="mb-4">Apabila terbukti melakukan pelanggaran atas butir di atas, maka saya bersedia dituntut
                    dan
                    dikenakan sanksi sesuai dengan peraturan perundang-undangan yang berlaku.</p>
                <p class="mb-4">Pernyataan ini tetap berlaku walaupun penugasan saya sudah berakhir atau diakhiri.</p>
                <p class="mb-16">Demikian, Surat Pernyataan ini saya buat dalam keadaan sadar dan tanpa paksaan dari
                    pihak
                    manapun.</p>

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

        <div id="exit_clearance" class="container mx-auto p-4 max-w-4xl">
            <table class="w-full border border-gray-800 table-fixed">
                <tr>
                    <td class="w-1/6 border-r border-gray-800 text-center p-2">
                        <img src="{{ asset('assets/images/logo_itb_512.png') }}" alt="Logo"
                            class="w-20 mx-auto my-2">
                    </td>
                    <td class="w-5/6">
                        <table class="w-full">
                            <tr>
                                <td class="text-center p-2">
                                    <div class="text-base font-bold">DIREKTORAT TEKNOLOGI INFORMASI ITB</div>
                                    <div class="text-sm text-gray-300">Gedung CRCS Lantai 4, Jalan Ganesha Nomor 10
                                        Bandung
                                        40132 Telp:
                                        +6222 86010037</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="title-blue text-center p-2">
                                    <div class="font-bold">FORMULIR EXIT CLEARANCE</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-0">
                                    <table class="w-full text-sm border-t-0 border-gray-800 text-gray-300">
                                        <tr>
                                            <td class="border-r border-gray-800 p-1">Nomor : SMKLO7-FRM.01</td>
                                            <td class="border-r border-gray-800 p-1">Revisi : 0</td>
                                            <td class="border-r border-gray-800 p-1">Tanggal : 21 November 2023</td>
                                            <td class="p-1">Halaman : 1 dari 2</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <div class="mt-6 text-sm">
                <table class="w-full mb-2">
                    <tr>
                        <td class="w-48">Nama</td>
                        <td>: {{ Auth::user()->full_name }}</td>
                    </tr>
                    <tr>
                        <td>NIP/Nopeg</td>
                        <td>: {{ Auth::user()->nip }}</td>
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
                        <td>: {{ Auth::user()->exit_date }}</td>
                    </tr>
                    <tr>
                        <td>Hari/Tanggal Terakhir Bekerja</td>
                        <td>: {{ Auth::user()->last_working_date }}</td>
                    </tr>
                    <tr>
                        <td>Alasan Exit Clearance</td>
                        <td class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <span class="mr-1">: Mutasi Kerja</span>
                                <input type="checkbox" name="mutasi_kerja" id="mutasi_kerja" class="mr-3">
                            </div>
                            <div class="flex items-center">
                                <span class="mr-1">Keluar Kerja</span>
                                <input type="checkbox" name="keluar_kerja" id="keluar_kerja" class="mr-3">
                            </div>
                            <div class="flex items-center">
                                <span class="mr-1">Selesai masa Kerja/Magang</span>
                                <input type="checkbox" name="selesai_masa_kerja" id="selesai_masa_kerja">
                            </div>
                        </td>
                    </tr>
                </table>

                <p class="mb-2">Saya yang bertandatangan dibawah ini, menyatakan penyelesaian kewajiban yang
                    berhubungan
                    dengan pekerjaan dan akan segera diselesaikan selambat-lambatnya 1 hari kerja sebelum hari terakhir
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
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Penyimpanan Data Eksternal</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Kendaraan (mobil/motor)</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Handphone</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">ATK</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">ID Card</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Kartu Parkir</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Kartu Asuransi</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Access Door (Card/Biometrik)</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Lainnya :</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>

                        <tr>
                            <td class="border border-gray-800 p-1" rowspan="6">Tugas & Tanggung jawab Kerja</td>
                            <td class="border border-gray-800 p-1">Serah terima pekerjaan (pekerjaan dalam proses,
                                tertunda, yang belum dilakukan)</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Transfer Knowledge pekerjaan</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Serah terima File-file pekerjaan (softcopy &
                                hardcopy)
                            </td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Serah terima SOP dan Instruksi Kerja</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Penyelesaian masalah keuangan</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">Lainnya:</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
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
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">b. Akun Email:</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">c. Akun Aplikasi:</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">d. Akun Sistem (infra):</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-800 p-1">e. Whatsapp Grup</td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                            <td class="border border-gray-800 p-1"></td>
                        </tr>
                    </tbody>
                </table>
                <div>ㅤ</div>
                <div>ㅤ</div>
                <table class="w-full border border-gray-800 table-fixed">
                    <tr>
                        <td class="w-1/6 border-r border-gray-800 text-center p-2">
                            <img src="{{ asset('assets/images/logo_itb_512.png') }}" alt="Logo"
                                class="w-20 mx-auto my-2">
                        </td>
                        <td class="w-5/6">
                            <table class="w-full">
                                <tr>
                                    <td class="text-center p-2">
                                        <div class="text-base font-bold">DIREKTORAT TEKNOLOGI INFORMASI ITB</div>
                                        <div class="text-sm text-gray-300">Gedung CRCS Lantai 4, Jalan Ganesha Nomor 10
                                            Bandung
                                            40132 Telp:
                                            +6222 86010037</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="title-blue text-center p-2">
                                        <div class="font-bold">FORMULIR EXIT CLEARANCE</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <table class="w-full text-sm border-t-0 border-gray-800 text-gray-300">
                                            <tr>
                                                <td class="border-r border-gray-800 p-1">Nomor : SMKLO7-FRM.01</td>
                                                <td class="border-r border-gray-800 p-1">Revisi : 0</td>
                                                <td class="border-r border-gray-800 p-1">Tanggal : 21 November 2023
                                                </td>
                                                <td class="p-1">Halaman : 2 dari 2</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <p class="mt-6 mb-4">Dengan mengisi dan menandatangani formulir ini, saya menyatakan bahwa saya telah
                    memahami
                    dan menyetujui hal-hal berikut:</p>
                <ul class="list-decimal pl-6 mb-4 space-y-2">
                    <li>Saya akan mengembalikan semua properti DTI ITB dan ITB yang telah dipinjamkan kepada saya,
                        maksimal
                        dalam waktu 30 hari kerja setelah tanggal akhir masa kerja saya.</li>
                    <li>Saya telah melakukan penghapusan semua data DTI yang bersifat rahasia, baik yang disimpan dalam
                        perangkat pribadi atau pada akun pribadi saya.</li>
                    <li>Saya akan menyelesaikan semua pekerjaan yang belum selesai saya kerjakan sebelum tanggal aktif
                        masa
                        kerja saya.</li>
                    <li>Saya akan menyelesaikan semua kewajiban keuangan yang belum saya selesaikan sebelum tanggal
                        akhir masa kerja saya.
                    </li>
                    <li>Saya akan mengikuti wawancara exit dengan atasan langsung atau penanggung jawab ditempat saya
                        bekerja
                    </li>
                </ul>
                <p class="mb-4">Saya juga menyatakan bahwa saya tidak akan membocorkan rahasia DTI ITB dan ITB. Saya
                    memahami bahwa jika saya tidak memenuhi salah satu dari hal-hal di atas, maka DTI ITB maupun ITB
                    dapat
                    mengambil tindakan yang diperlukan, termasuk tindakan hukum sesuai dengan peraturan yang berlaku.
                </p>

                <div class="w-full max-w-4xl mx-auto">
                    <div class="text-right mb-4">
                        Bandung, _____________ 20__
                    </div>

                    <table class="w-full border border-gray-800">
                        <thead>
                            <tr>
                                <th class="dark w-1/3 bg-[#1e3a8a] text-white p-2 border border-gray-800">DIAJUKAN OLEH
                                </th>
                                <th class="dark w-1/3 bg-[#1e3a8a] text-white p-2 border border-gray-800">DIKETAHUI
                                    OLEH
                                </th>
                                <th class="dark w-1/3 bg-[#1e3a8a] text-white p-2 border border-gray-800">
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
                                <td class="border border-gray-800 p-2 text-center">Mugi Sugiarto, S.Si, M.A.B.</td>
                            </tr>
                            <tr>
                                <td class="border border-gray-800 p-2 text-center">NIP/Nopeg. _____________</td>
                                <td class="border border-gray-800 p-2 text-center">NIP/Nopeg. _____________</td>
                                <td class="border border-gray-800 p-2 text-center">Nopeg. 106000608</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="evaluasi_exit" class="container mx-auto p-4 max-w-4xl">
            <table class="w-full border border-gray-800 table-fixed">
                <tr>
                    <td class="w-1/6 border-r border-gray-800 text-center p-2">
                        <img src="{{ asset('assets/images/logo_itb_512.png') }}" alt="Logo"
                            class="w-20 mx-auto my-2">
                    </td>
                    <td class="w-5/6">
                        <table class="w-full">
                            <tr>
                                <td class="text-center p-2">
                                    <div class="text-base font-bold">DIREKTORAT TEKNOLOGI INFORMASI ITB</div>
                                    <div class="text-sm text-gray-600">Gedung CRCS Lantai 4, Jalan Ganesha Nomor 10
                                        Bandung 40132 Telp: +6222 86010037</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-blue-600 text-white text-center p-2">
                                    <div class="font-bold">EVALUASI EXIT INTERVIEW</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-0">
                                    <table class="w-full text-sm border-t border-gray-800">
                                        <tr>
                                            <td class="border-r border-gray-800 p-1">Nomor : FRM.01-OPL.08</td>
                                            <td class="border-r border-gray-800 p-1">Revisi : 0</td>
                                            <td class="border-r border-gray-800 p-1">Tanggal : 22 September 2023</td>
                                            <td class="p-1">Halaman : 1 dari 2</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <div class="mt-6 space-y-6">
                <div class="text-center space-y-2">
                    <h1 class="text-2xl font-bold">Form Evaluasi Exit Interview</h1>
                    <h2 class="text-xl">Personel Magang/PKL</h2>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-bold">Informasi Umum</h3>
                    <div class="space-y-2">
                        <table class="w-full mb-2">
                            <tr>
                                <td class="w-48">Nama Personal</td>
                                <td>: {{ Auth::user()->full_name }}</td>
                            </tr>
                            <tr>
                                <td>Institusi/Sekolah</td>
                                <td>: {{ Auth::user()->institution }}</td>
                            </tr>
                            <tr>
                                <td>Periode Magang/PKL</td>
                                <td>: {{ Auth::user()->period_start_date }} s/d {{ Auth::user()->period_end_date }}
                                </td>
                            </tr>
                            <tr>
                                <td>Nama PIC Offboarding</td>
                                <td>: {{ Auth::user()->username }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Evaluasi</td>
                                <td>: </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-bold">Pengalaman Program</h3>
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <p class="font-medium">1. Bagaimana Anda menilai pengalaman Anda secara keseluruhan selama
                                magang/praktik kerja di DTI</p>
                            <textarea class="w-full border border-gray-300 rounded px-3 py-2 h-12" placeholder="Click or tap here to enter text."></textarea>
                        </div>
                        <div class="space-y-2">
                            <p class="font-medium">2. Apakah tugas yang diberikan sesuai dengan harapan dan bidang
                                studi Anda?</p>
                            <textarea class="w-full border border-gray-300 rounded px-3 py-2 h-12" placeholder="Click or tap here to enter text."></textarea>
                        </div>
                        <div class="space-y-2">
                            <p class="font-medium">3. Bagaimana Anda menilai dukungan yang Anda terima dari PIC dan tim
                                kerja?</p>
                            <textarea class="w-full border border-gray-300 rounded px-3 py-2 h-12" placeholder="Click or tap here to enter text."></textarea>
                        </div>
                        <div class="space-y-2">
                            <p class="font-medium">4. Bagaimana Anda menilai fasilitas dan sumber daya yang tersedia
                                untuk mendukung kerja Anda?</p>
                            <textarea class="w-full border border-gray-300 rounded px-3 py-2 h-12" placeholder="Click or tap here to enter text."></textarea>
                        </div>
                        <div class="space-y-2">
                            <p class="font-medium">5. Bagaimana Anda menilai fasilitas dan sumber daya yang tersedia
                                untuk mendukung kerja Anda?</p>
                            <textarea class="w-full border border-gray-300 rounded px-3 py-2 h-12" placeholder="Click or tap here to enter text."></textarea>
                        </div>
                        <h3 class="text-xl font-bold">ㅤ</h3>
                        <h3 class="text-xl font-bold">ㅤ</h3>
                        <table class="w-full border border-gray-800 table-fixed">
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
                                                    Nomor 10
                                                    Bandung 40132 Telp: +6222 86010037</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-blue-600 text-white text-center p-2">
                                                <div class="font-bold">EVALUASI EXIT INTERVIEW</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-0">
                                                <table class="w-full text-sm border-t border-gray-800">
                                                    <tr>
                                                        <td class="border-r border-gray-800 p-1">Nomor : FRM.01-OPL.08
                                                        </td>
                                                        <td class="border-r border-gray-800 p-1">Revisi : 0</td>
                                                        <td class="border-r border-gray-800 p-1">Tanggal : 22 September
                                                            2023</td>
                                                        <td class="p-1">Halaman : 2 dari 2</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <h3 class="text-xl font-bold">Saran dan Umpan Balik</h3>
                        <div class="space-y-2">
                            <p class="font-medium">6. Apa aspek terbaik dari program maang/praktik kerja di DTI yang
                                paling Anda sukai?</p>
                            <textarea class="w-full border border-gray-300 rounded px-3 py-2 h-12" placeholder="Click or tap here to enter text."></textarea>
                        </div>
                        <div class="space-y-2">
                            <p class="font-medium">7. Apa yang menurut Anda perlu ditingkatkan dalam program ini di
                                DTI?</p>
                            <textarea class="w-full border border-gray-300 rounded px-3 py-2 h-12" placeholder="Click or tap here to enter text."></textarea>
                        </div>
                        <div class="space-y-2">
                            <p class="font-medium">8. Apakah pengalaman ini membantu Anda dalam merencanakan karir di
                                masa depan?</p>
                            <textarea class="w-full border border-gray-300 rounded px-3 py-2 h-12" placeholder="Click or tap here to enter text."></textarea>
                        </div>
                        <div class="space-y-2">
                            <p class="font-medium">9. Apakah ada saran atau umpan balik yang ingin Anda berikan untuk
                                peningkatan program ini di DTI?</p>
                            <textarea class="w-full border border-gray-300 rounded px-3 py-2 h-12" placeholder="Click or tap here to enter text."></textarea>
                        </div>

                        <div class="mt-12 mb-8">
                            <!-- Location and Date -->
                            <div class="text-right mb-8">
                                <p>Bandung, <input type="text" class="border-b border-gray-400 w-48 text-center"
                                        placeholder="Click or tap here to enter text."></p>
                            </div>

                            <!-- Signature Grid -->
                            <div class="grid grid-cols-3 gap-8 text-center">
                                <!-- Personel Magang/PKL -->
                                <div class="space-y-20">
                                    <p>Personel Magang/PKL,</p>
                                    <div class="h-24 flex items-end justify-center">
                                        <p>( ................................. )</p>
                                    </div>
                                    <div class="flex items-center gap-2 justify-center">
                                        <span>NIP/Nopeg.</span>
                                        <input type="text" class="border-b border-gray-400 w-32 text-center"
                                            placeholder=".....................">
                                    </div>
                                </div>

                                <!-- PIC Offboarding -->
                                <div class="space-y-20">
                                    <p>PIC Offboarding,</p>
                                    <div class="h-24 flex items-end justify-center">
                                        <p>( ................................. )</p>
                                    </div>
                                    <div class="flex items-center gap-2 justify-center">
                                        <span>NIP/Nopeg.</span>
                                        <input type="text" class="border-b border-gray-400 w-32 text-center"
                                            placeholder=".....................">
                                    </div>
                                </div>

                                <!-- Kasubdit -->
                                <div class="space-y-20">
                                    <p>Kasubdit. Operasional & Layanan TI,</p>
                                    <div class="h-24 flex items-end justify-center">
                                        <p>( ................................. )</p>
                                    </div>
                                    <div class="flex items-center gap-2 justify-center">
                                        <span>NIP/Nopeg.</span>
                                        <input type="text" class="border-b border-gray-400 w-32 text-center"
                                            placeholder=".....................">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed bottom-4 right-4 space-x-2 no-print">
            <button onclick="showformulir_perjanjian()" class="bg-blue-500 text-white px-4 py-2 rounded">Formulir
                Perjanjian</button>
            <button onclick="showexit_clearance()" class="bg-blue-500 text-white px-4 py-2 rounded">Exit
                Clearance</button>
            <button onclick="showevaluasi_exit()" class="bg-blue-500 text-white px-4 py-2 rounded">Evaluasi
                Exit</button>
        </div>

    </body>

    </html>
