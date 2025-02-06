<!-- Modal Add User -->
<div id="userReportModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-70 z-50 hidden">
    <div class="bg-gray-50 text-white rounded-lg shadow-lg m-6 p-6 h-[95vh] w-min">
        <div class="overflow-y-auto h-[80vh] space-y-4">
            {{-- Printed Container --}}
            <div id="laporanTransaksi"
                class="laporanTransaksi h-auto p-8 rounded-md w-[80vw] md:w-[64vw] border-2 bg-white text-black"
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
                                        <div class="text-base font-bold">DIREKTORAT TEKNOLOGI INFORMASI ITB</div>
                                        <div class="text-sm text-gray-600">Gedung CRCS Lantai 4, Jalan Ganesha Nomor 10
                                            Bandung 40132 Telp: +6222 86010037</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bg-blue-600 text-white text-center p-2">
                                        <div class="font-bold">LAPORAN DATA SISWA PKL</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-0">
                                        <table class="w-full text-sm border-t border-gray-800">
                                            <tr>
                                                <td class="border-r border-gray-800 p-1">Nomor : FRM.01-OPL.08</td>
                                                <td class="border-r border-gray-800 p-1">Revisi : 0</td>
                                                <td class="border-r border-gray-800 p-1">Tanggal : 22 September 2023
                                                </td>
                                                <td class="p-1">Halaman : 1 dari 2</td>
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
                </div>
            </div>
        </div>
        <div class="flex gap-x-2 py-3">
            <button class="w-full px-4 py-2 text-sm font-medium text-gray-800 rounded-md hover:text-gray-900 border-2"
                id="userReportClose">Kembali</button>
            <button class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700"
                onclick="printDiv('laporanTransaksi')">Cetak Laporan</button>
        </div>
    </div>
</div>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
