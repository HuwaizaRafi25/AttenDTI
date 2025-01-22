<!-- Modal Add User -->
<div id="updateModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl w-full">
        <div class="flex items-center justify-between">
            <i id="closeUpdateModal"
                class="bx bx-arrow-back scale-125 font-extrabold mb-4 cursor-pointer hover:scale-150"></i>
            <h2 class="text-xl font-bold pr-4 mx-auto">Edit Pengguna</h2>
        </div>
        <hr class="my-3">
        <form id="updateUserForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex items-center justify-center w-full gap-4">
                <!-- Profile Image Input -->
                <div class="flex justify-center w-1/4">
                    <input type="file" name="userProfilePic" id="updateProfileImageInput" accept="image/*"
                        class="hidden" onchange="previewImageProfilePic2(event, 'updateProfileImage')">
                    <label for="updateProfileImageInput" class="relative cursor-pointer inline-block">
                        <img id="updateProfileImage" src="{{ asset('assets/images/placeHolder.png') }}" alt="User Profile"
                            class="w-32 h-32 rounded-full shadow-md object-cover">
                        <div
                            class="absolute w-8 h-8 flex justify-center items-center bottom-4 right-4 bg-white p-1 rounded-full shadow-md transform translate-x-1/2 translate-y-1/2">
                            <span class="icon text-gray-600 scale-150">
                                {!! file_get_contents(public_path('assets/images/icons/pencil.svg')) !!}
                            </span>
                        </div>
                    </label>
                </div>
                <!-- User Info Input Fields -->
                <div class="flex flex-col w-3/4">
                    <div>
                        <label for="username" class="text-gray-600 font-light text-sm">Username</label>
                        <input type="text" name="username" placeholder="Masukkan Username"
                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="nama" class="text-gray-600 font-light text-sm">Nama Lengkap</label>
                        <input type="text" name="namaPengguna" placeholder="Masukkan Nama"
                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" required>
                    </div>
                </div>
            </div>
            <!-- Email and Phone Input Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="email" class="text-gray-600 font-light text-sm">Email</label>
                    <input type="email" name="email" placeholder="Masukkan Alamat Email"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" required>
                </div>
                <div>
                    <label for="telepon" class="text-gray-600 font-light text-sm">Telepon</label>
                    <input type="number" name="telepon"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500 appearance-none"
                        placeholder="Masukkan Nomor Telepon" required pattern="[0-9]*"
                        title="Please enter numbers only">
                </div>
            </div>
            <!-- Role and Outlet Select Fields -->
            <div id="gridRoleOutletUpdate" class="grid grid-cols-1 gap-4 transition-all duration-300">
                <div>
                    <label for="role" class="text-gray-600 font-light text-sm">Peran</label>
                    <select name="roleUpdate" id="roleUpdate" class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" required>
                        <option id="selectedRole" value="" selected hidden></option>
                        <option value="super_admin">Super Admin</option>
                        <option value="owner">Owner</option>
                        <option value="manajer">Manajer</option>
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                    </select>
                </div>
                <div id="outletContainerUpdate" class="w-full opacity-0 hidden transition-all duration-300">
                    <label for="outlet" class="text-gray-600 font-light text-sm">Outlet</label>
                    <select name="id_outlet_update" id="outlet_update" class="w-full border rounded p-2 focus:outline-none focus:border-blue-500">
                        <option id="selectedOutlet" value="" selected hidden>Pilih Outlet</option>
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
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" >
                </div>
                <div>
                    <label for="password_confirmation" class="text-gray-600 font-light text-sm">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" >
                </div>
            </div>
            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="bg-blue-500 text-white font-bold py-2 px-6 rounded hover:bg-blue-600 transition duration-200">
                    Edit
                </button>
            </div>
        </form>
    </div>
</div>
