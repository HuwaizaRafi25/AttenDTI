<!-- Modal Add User -->
<div id="addModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl w-full">
        <div class="flex items-center justify-between mb-4">
            <img id="closeAddModal" src="{{ asset('assets/images/arrowBack.png') }}"
                class="cursor-pointer hover:scale-110 transition-transform duration-200" alt="Back Icon">
            <h2 class="text-xl font-bold mx-auto pr-4">Tambah Paket</h2>
        </div>

        <form id="addUserForm" action="{{ route('transactions.keranjang.insert') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="paket" class="block text-gray-700 font-medium text-sm mb-1">Paket</label>
                    <select name="paket" id="paket"
                        class="w-full border rounded-md p-2 focus:outline-none focus:border-blue-500">
                        @if ((Auth::user()->role === 'super_admin' && empty($rafi_all_packages)) ||
                             (Auth::user()->role !== 'super_admin' && empty($rafi_outlet_packages)))
                            <option hidden selected>Paket belum tersedia</option>
                        @else
                            <option selected hidden>Pilih Paket</option>
                            @if (Auth::user()->role === 'super_admin')
                                @foreach ($rafi_all_packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->nama_paket }}</option>
                                @endforeach
                            @else
                                @foreach ($rafi_outlet_packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->nama_paket }}</option>
                                @endforeach
                            @endif
                        @endif
                    </select>
                </div>
                <div>
                    <label for="jumlah" class="block text-gray-700 font-medium text-sm mb-1">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah"
                        class="w-full border rounded-md p-2 focus:outline-none focus:border-blue-500"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        placeholder="Masukkan Jumlah" min="1" required >
                </div>
            </div>

            <div class="mt-4">
                <label for="keterangan" class="block text-gray-700 font-medium text-sm mb-1">Keterangan</label>
                <textarea name="keterangan" id="keterangan"
                    class="w-full border rounded-md p-2 focus:outline-none focus:border-blue-500" required
                    placeholder="Masukkan Keterangan" rows="3"></textarea>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" id="submitPaket"
                    class="bg-blue-500 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-600 transition duration-200">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
