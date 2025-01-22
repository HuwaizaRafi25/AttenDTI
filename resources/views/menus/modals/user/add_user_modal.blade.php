<!-- Modal Add User -->
<div id="addModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl w-full">
        <div class="flex items-center justify-between">
            <i id="closeAddModal"
                class="bx bx-arrow-back scale-125 font-extrabold mb-4 cursor-pointer hover:scale-150"></i>
            <h2 class="text-xl font-bold mb-4 pr-4 mx-auto">Pengguna Baru</h2>
        </div>
        <form id="addUserForm" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex items-center justify-center w-full gap-4">
                <!-- Profile Image Input -->
                <div class="flex justify-center w-1/4">
                    <input type="file" name="userProfilePic" id="profileImageInput" accept="image/*"
                        class="hidden" onchange="previewImageProfilePic(event, 'profileImage')" required>
                    <label for="profileImageInput" class="relative cursor-pointer inline-block">
                        <img id="profileImage" src="{{ asset('assets/images/placeHolder.png') }}" alt="User Profile"
                            class="w-32 h-32 rounded-full shadow-md object-cover">
                        <div
                            class="absolute w-8 h-8 flex justify-center items-center bottom-4 right-4 bg-white p-1 rounded-full shadow-md transform translate-x-1/2 translate-y-1/2">
                            <span class="icon text-gray-600 scale-150">
                                {!! file_get_contents(public_path('assets/images/icons/plus.svg')) !!}
                            </span>
                        </div>
                    </label>
                </div>
                <!-- User Info Input Fields -->
                <div class="flex flex-col w-3/4">
                    <div>
                        <label for="username" class="text-gray-600 font-light text-sm">Username</label>
                        <input type="text" name="username" placeholder="Masukkan Username"
                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" oninput="this.value = this.value.replace(/[^a-z]/g, '')" required>
                    </div>
                    <div>
                        <label for="nama" class="text-gray-600 font-light text-sm">Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Masukkan Nama"
                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" oninput="this.value = this.value.replace(/[^a-zA-Z ]/g, '')" required>
                    </div>
                </div>
            </div>
            <!-- Email and Phone Input Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="email" class="text-gray-600 font-light text-sm">Email</label>
                    <input type="email" name="email" placeholder="Masukkan Alamat Email"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" oninput="this.value = this.value.replace(/[^a-z0-9@.]/g, '')" required>
                </div>
                <div>
                    <label for="telepon" class="text-gray-600 font-light text-sm">Telepon</label>
                    <input type="number" name="telepon"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500 appearance-none"
                        placeholder="Masukkan Nomor Telepon" min="1000" required oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        title="Please enter numbers only">
                </div>
            </div>
            <!-- Role and Outlet Select Fields -->
            <div id="gridRoleOutlet" class="grid grid-cols-1 gap-4 transition-all duration-300">
                <div>
                    <label for="role" class="text-gray-600 font-light text-sm">Peran</label>
                    <select name="role" id="role" class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" required>
                        <option selected hidden>Pilih Peran</option>
                        <option value="super_admin">Super Admin</option>
                        <option value="owner">Owner</option>
                        <option value="manajer">Manajer</option>
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                    </select>
                </div>
                <div id="outletContainer" class="w-full opacity-0 hidden transition-all duration-300">
                    <label for="outlet" class="text-gray-600 font-light text-sm">Outlet</label>
                    <select name="id_outlet" id="outlet" class="w-full border rounded p-2 focus:outline-none focus:border-blue-500">
                        <option selected hidden value="">Pilih Outlet</option>
                        {{-- @foreach ($rafi_outlets as $rafi_outlet)
                            <option value="{{ $rafi_outlet->id }}">{{ $rafi_outlet->nama }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>
            <!-- Password Input Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="password" class="text-gray-600 font-light text-sm">Password</label>
                    <input type="password" name="password" placeholder="Enter Password"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" required>
                </div>
                <div>
                    <label for="password_confirmation" class="text-gray-600 font-light text-sm">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" required>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="bg-[#6770c6] text-white font-bold py-2 px-6 rounded hover:bg-[#545DB0ff] transition duration-200">
                    Tambah Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
