<!-- Modal Add User -->
<div id="addModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl w-full">
        <div class="flex items-center justify-between">
            <img id="backAddOutlet" src="{{ asset('assets/images/arrowBack.png') }}" class="bx bx-arrow-back font-extrabold mb-4 cursor-pointer hover:scale-110 transition transform" alt="">
            <h2 class="text-xl font-bold mb-4 pr-4 mx-auto">Outlet Baru</h2>
        </div>
        <form id="addUserForm" action="{{ route('outlets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center justify-center w-full gap-4">
                <div class="flex justify-center w-1/4">
                    <img id="profileImage" src="{{ asset('assets/images/logoti.png') }}" alt="User Profile"
                        class="w-32 h-32 rounded-full shadow-lg object-cover">
                    </label>
                </div>
                <div class="flex flex-col w-3/4">
                    <div>
                        <label for="nama" class="text-gray-600 font-light text-sm">Nama Outlet</label>
                        <input type="text" id="namaOutlet" name="nama" placeholder="Masukkan Nama Outlet"
                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                            oninput="enforceUneditablePrefixAndFilter()" value="Wasuhin " required>
                    </div>

                    <div>
                        <label for="telepon" class="text-gray-600 font-light text-sm">Telepon</label>
                        <input type="number" name="telepon"
                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500 appearance-none"
                            placeholder="Masukkan Nomor Telepon" required
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" title="Please enter numbers only">
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <label for="alamat" class="text-gray-600 font-light text-sm ml-2">Alamat</label>
                <textarea name="alamat" id="alamat" class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                    required placeholder="Masukkan Alamat Outlet" rows="3"></textarea>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="bg-blue-500 text-white font-bold py-2 px-6 rounded hover:bg-blue-600 transition duration-200">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</div>
