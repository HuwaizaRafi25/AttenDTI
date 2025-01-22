<!-- Modal Add User -->
<div id="laporanModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-70 z-50 hidden">
    <div class="bg-gray-50 text-white rounded-lg shadow-lg p-6 h-[95vh] max-w-3xl w-full">
        <div>
            <div class="flex justify-start pb-3 pl-3">
                <button class="text-gray-600 hover:text-gray-900" onclick="$('#laporanModal').modal('hide')">
                    <img src="{{ asset('assets/images/arrowBack.png') }}" alt="">
                </button>
            </div>
        </div>
        {{-- Printed Container --}}
        <div id="laporanTransaksi"
            class="laporanTransaksi h-full max-h-[75vh] rounded-md w-full border-2 bg-white text-black overflow-auto"
            style="aspect-ratio: 2480 / 3508;">
            <div class="p-6 border-b-2 border-gray-300">
                <div class="flex items-center">
                    <div class="w-20 h-20">
                        <img src="{{ asset('assets/images/logoti.png') }}" alt="Logo Wasuhin"
                            class="object-contain w-full h-full">
                    </div>
                    <div class="flex-grow text-center">
                        <h1 class="text-2xl font-bold">WASUHIN LAUNDRY SERVICES</h1>
                        <p class="text-sm">Jl. Kebersihan No. 10, Kota Bersih, Indonesia</p>
                        <p class="text-sm">Telepon: (021) 123-4567 | Email: info@wasuhin.com</p>
                        <p class="text-sm">Website: www.wasuhin.com</p>
                    </div>
                </div>
            </div>

            <!-- Body Laporan -->
            <div class="p-6" id="laporanContainer">

            </div>
        </div>
        <div class="flex gap-x-2 p-3">
            <button class="w-full px-4 py-2 text-sm font-medium text-gray-800 rounded-md hover:text-gray-900 border"
                id="notaBackButton">Kembali</button>
            <button class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700"
                onclick="printDiv('laporanTransaksi')">Cetak Laporan</button>
        </div>
    </div>
</div>
