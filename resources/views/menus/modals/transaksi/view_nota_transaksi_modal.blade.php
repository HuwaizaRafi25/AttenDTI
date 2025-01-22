<div id="receipt" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50 p-4">
    <div class="max-w-lg w-full h-[95%] m-4 border border-gray-300 rounded-md shadow-md bg-white flex flex-col">
        <div id="notePanel" class=" flex-grow m-5 border rounded-md overflow-y-auto">
            <!-- Header: Logo dan Informasi Usaha -->
            <div class="p-5 text-center border-b border-gray-300">
                <img src="{{ asset('assets/images/logoti.png') }}" alt="Wasuhin Laundry" class="h-16 mx-auto">
                <h3 class="font-bold text-lg mt-2">Wasuhin Laundry Services</h3>
                <p class="text-sm text-gray-600">Jl. Kebersihan No. 10, Kota Bersih, Indonesia</p>
                <p class="text-sm text-gray-600">Tel: (021) 123-4567 | Email: info@wasuhin.com</p>
            </div>

            <!-- Informasi Transaksi -->
            <div class="p-5">
                <div class="grid grid-cols-2 gap-y-2 text-sm">
                    <div class="font-medium text-gray-600">Invoice</div>
                    <div class="font-semibold text-gray-800" id="invoiceTransaksi">: INV-001</div>

                    <div class="font-medium text-gray-600">Tanggal</div>
                    <div class="font-semibold text-gray-800" id="tanggalTransaksi">: 22 November 2024</div>

                    <div class="font-medium text-gray-600">Nama Pelanggan</div>
                    <div class="font-semibold text-gray-800" id="pelangganTransaksi">: Rafi Ahmad</div>

                    <div class="font-medium text-gray-600">Batas Waktu</div>
                    <div class="font-semibold text-gray-800" id="batasTransaksi">: 25 November 2024</div>

                    <div class="font-medium text-gray-600">Status Laundry</div>
                    <div class="font-semibold" id="statusLaundryTransaksi">: Selesai</div>

                    <div class="font-medium text-gray-600">Status Pembayaran</div>
                    <div class="font-semibold" id="statusPembayaranTransaksi">: Dibayar</div>
                </div>
            </div>

            <!-- Detail Transaksi -->
            <div class="overflow-x-auto p-5">
                <table class="w-full border-collapse border border-gray-300 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 p-2 text-left">No</th>
                            <th class="border border-gray-300 p-2 text-left">Item</th>
                            <th class="border border-gray-300 p-2 text-center">Qty</th>
                            <th class="border border-gray-300 p-2 text-right">Harga</th>
                            <th class="border border-gray-300 p-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="tableContainer" class="text-gray-700">
                        {{-- <tr>
                            <td colspan="5" class="text-center border border-gray-300 p-2">Tidak ada data transaksi.</td>
                        </tr> --}}
                            {{-- <tr>
                                <td class="border border-gray-300 p-2">1</td>
                                <td class="border border-gray-300 p-2">Cuci Kering</td>
                                <td class="border border-gray-300 p-2 text-center">2</td>
                                <td class="border border-gray-300 p-2 text-right">30,000</td>
                                <td class="border border-gray-300 p-2 text-right">60,000</td>
                            </tr> --}}
                    </tbody>
                </table>
            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="p-5 border-t border-gray-300">
                <div class="flex justify-between text-sm">
                    <span>Biaya Tambahan:</span>
                    <span id="biayaTambahanTransaksi">Rp10,000</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span>Diskon (10%):</span>
                    <span id="diskonTransaksi">-Rp12,000</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span>Pajak:</span>
                    <span id="pajakTransaksi">Rp5,000</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between text-lg font-bold">
                    <span>Total Bayar:</span>
                    <span id="totalTransaksi">Rp123,000</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center p-5 text-xs text-gray-500 border-t border-gray-300">
                <p>Terima kasih telah mempercayakan laundry Anda kepada Wasuhin Laundry Services!</p>
                <p>Struk ini merupakan bukti pembayaran yang sah.</p>
            </div>
        </div>
        <div class="flex gap-x-2 p-3">
            <button class="w-full px-4 py-2 text-sm font-medium text-gray-800 rounded-md hover:text-gray-900 border" id="notaBackButton">Kembali</button>
            <button class="w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700"
                onclick="printDiv('notePanel')">Cetak Struk</button>
        </div>
    </div>
</div>
