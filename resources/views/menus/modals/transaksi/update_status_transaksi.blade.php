<div id="updateModal1" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-lg w-full">
        <div class="flex items-center justify-between mb-4">
            <img id="backUpdateButton1" src="{{ asset('assets/images/arrowBack.png') }}"
                class="w-6 h-6 cursor-pointer hover:scale-110 transition transform" alt="Back" />
            <h2 class="text-2xl font-bold text-gray-800">Perbarui Status</h2>
            <div class="w-6"></div>
        </div>
        <hr class="mb-6 border-gray-200" />
        <form id="updateUserForm" action="" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="space-y-4 grid grid-cols-1 gap-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-600 font-medium">Invoice:</span>
                        <span class="text-gray-800 font-bold" id="transaksiInvoice">#TRS0003</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-600 font-medium">Tanggal:</span>
                        <span class="text-gray-800" id="transaksiTanggal">3 Juni 2024</span>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-600 font-medium">Pelanggan:</span>
                        <span class="text-gray-800" id="transaksiPelanggan">Sumargo</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-600 font-medium">Telepon:</span>
                        <span class="text-gray-800" id="transaksiPelangganTlp">6288970809</span>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="status_laundry" class="block text-sm font-medium text-gray-700 mb-1">
                        Status Laundry
                    </label>
                    <select id="status_laundry" name="status_laundry"
                        class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option selected hidden id="selectedStatusLaundry" value=""></option>
                        <option value="baru">Baru</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                        <option value="diambil">Diambil</option>
                    </select>
                </div>
                <div>
                    <label for="status_pembayaran" class="block text-sm font-medium text-gray-700 mb-1">
                        Status Pembayaran
                    </label>
                    <select id="status_pembayaran" name="status_pembayaran"
                    class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option selected hidden id="selectedStatusPembayaran" value=""></option>
                        <option value="dibayar">Dibayar</option>
                        <option value="belum_dibayar">Belum Dibayar</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>
