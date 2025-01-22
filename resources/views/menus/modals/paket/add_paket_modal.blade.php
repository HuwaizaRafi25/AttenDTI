<!-- Modal Add Paket -->
<div id="addPaketModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl w-full">
        <div class="flex items-center justify-between">
            <img id="closeAddButton" src="{{ asset('assets/images/arrowBack.png') }}"
                class="bx bx-arrow-back font-extrabold mb-4 cursor-pointer hover:scale-110 transition transform"
                alt="">
            <h2 class="text-xl font-bold mb-4 pr-4 mx-auto">Paket Baru</h2>
        </div>
        <form id="addPaketForm" action="{{ route('packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-4">
                    <!-- Ikon Paket (Hanya untuk Dekorasi) -->
                    <img src="{{ asset('assets/images/icons/paket.svg') }}" alt="Package Icon"
                        class="w-20 h-20 p-3 bg-gray-100 rounded-full shadow-md object-cover">

                    <div class="flex-1">
                        <!-- Nama Paket -->
                        <label for="nama_paket" class="text-gray-600 font-light text-sm">Nama Paket</label>
                        <input type="text" name="nama_paket" placeholder="Masukkan Nama Paket"
                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" required>
                    </div>
                </div>

                <!-- Jenis Paket -->
                <div>
                    <label for="jenis" class="text-gray-600 font-light text-sm">Jenis Paket</label>
                    <select name="jenis" id="jenis" required
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500">
                        <option value="" selected hidden>Pilih Jenis Paket</option>
                        <option value="kiloan">Kiloan</option>
                        <option value="selimut">Selimut</option>
                        <option value="bed_cover">Bed Cover</option>
                        <option value="kaos">Kaos</option>
                        <option value="lain">Lain-lain</option>
                    </select>
                </div>

                <!-- Harga Paket -->
                <div>
                    <label for="harga" class="text-gray-600 font-light text-sm">Harga (Rp)</label>
                    <div class="relative">
                        <!-- Ikon Rupiah -->
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-green-500">
                            <span class="opacity-75">
                                {!! file_get_contents(public_path('assets/images/icons/money.svg')) !!}
                            </span>
                        </span>
                        <input type="number" name="harga"
                            class="w-full border rounded p-2 pl-10 focus:outline-none focus:border-blue-500 appearance-none"
                            placeholder="Masukkan Harga Paket" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            required>
                    </div>
                </div>

                <!-- Outlet -->
                @if (Auth::user()->role === 'super_admin')
                    <div>
                        <label for="id_outlet" class="text-gray-600 font-light text-sm">Outlet</label>
                        <select name="id_outlet" id="id_outlet" required
                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500">
                            <option value="" selected hidden>Pilih Outlet</option>
                            @foreach ($rafi_outlets as $outlet)
                                <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="bg-blue-500 text-white font-bold py-2 px-6 rounded hover:bg-blue-600 transition duration-200">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
