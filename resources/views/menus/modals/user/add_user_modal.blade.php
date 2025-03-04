<!-- Modal Add User -->
<div id="addModal" class="fixed inset-0 -left-96 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 m-6 max-w-2xl w-full">
        <div class="flex items-center pb-4 mb-4 justify-between">
            <h2 class="text-xl font-semibold">Add User</h2>
            <img id="closeAddUserModal" src="{{ asset('assets/images/icons/xmark.svg') }}"
                class="w-4 h-4 opacity-65 font-extrabold cursor-pointer transition-all duration-150 hover:opacity-85"
                alt="closeIcon">
        </div>
        <form id="addUserForm" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="md:flex items-center justify-center w-full gap-4">
                <!-- Profile Image Input -->
                <div class="flex justify-center md:w-1/4">
                    <input type="file" name="userProfilePic" id="profileImageInput" accept="image/*" class="hidden"
                        onchange="previewImageProfilePic(event, 'profileImage', 'cropperAddUserModal', 'cropperAddUserImage')">
                    <label for="profileImageInput" class="relative cursor-pointer inline-block">
                        <img id="profileImage" src="{{ asset('assets/images/userPlaceHolder.png') }}" alt="User Profile"
                            class="w-32 h-32 rounded-full border-2 p-2 shadow-md object-cover">
                        <div
                            class="absolute w-8 h-8 flex justify-center items-center bottom-4 right-4 bg-white p-1 rounded-full shadow-md transform translate-x-1/2 translate-y-1/2">
                            <span class="icon text-gray-600 scale-150">
                                {!! file_get_contents(public_path('assets/images/icons/plus.svg')) !!}
                            </span>
                        </div>
                    </label>
                    <div id="cropperAddUserModal" class="fixed inset-0 bg-black bg-opacity-70 z-50 hidden">
                        <div class="flex items-center justify-center h-screen">
                            <div class="bg-white p-4 rounded-lg">
                                <!-- Area Pratinjau Gambar -->
                                <img id="cropperAddUserImage" src="#" alt="Crop Image" class="max-w-full max-h-[50vh]">

                                <!-- Tombol Aksi -->
                                <div class="flex justify-end mt-4">
                                    <button id="cancelCropButton" type="button" class="px-4 py-2 bg-gray-300 rounded mr-2">Batal</button>
                                    <button id="cropImageButton" type="button" class="px-4 py-2 bg-green-600 text-white rounded">Potong & Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Info Input Fields -->
                <div class="flex flex-col gap-y-2 md:w-3/4">
                    <div class="space-y-1">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" name="username" id="username" placeholder="Input Username"
                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                            oninput="
                            checkUsername(this.value);" required>
                        <div id="username-feedback" class="text-sm mt-1 hidden"></div>
                    </div>

                    <div class="space-y-1">
                        <label for="itb_account" class="block text-sm font-medium text-gray-700 mb-1">ITB
                            Account</label>
                        <input type="text" name="itb_account" id="itb_account"
                            placeholder="Email ITB (contoh: user@itb.ac.id)"
                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                            oninput="
                                validateITBAccount(this.value);
                            "
                            required>
                        <div id="itb-account-feedback" class="text-sm mt-1 hidden"></div>
                    </div>
                    <script>

                    </script>
                </div>
            </div>
            <div id="gridRoleOutlet" class="grid grid-cols-1 gap-4 transition-all duration-300 mt-2">
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" id="role"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500" required>
                        <option selected disabled hidden>Choose Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="alumni">Alumni</option>
                    </select>
                </div>
                <div id="placementContainer" class="w-full opacity-0 hidden transition-all duration-300">
                    <label for="outlet" class="block text-sm font-medium text-gray-700 mb-1">Placement</label>
                    <select name="id_placement" id="placement"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500">
                        <option selected disabled hidden value="">Choose placement</option>
                        <!-- Options akan diisi oleh JavaScript -->
                    </select>
                </div>
            </div>

            <!-- Password Input Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4 mt-2">
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <div class="relative"> <!-- Tambahkan wrapper div ini -->
                        <input type="password" required id="password" name="password" placeholder="Enter your new password"
                            class="w-full border rounded p-2 focus:outline-none focus:border-blue-500 pr-10 @error('password') border-red-500 @enderror">
                        <button type="button" id="togglePassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password"
                        class="w-full border rounded p-2 focus:outline-none focus:border-blue-500"
                        oninput="checkPasswordMatch(this.value)" required>
                    <div id="password-feedback" class="text-sm mt-1"></div>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="flex items-center justify-center bg-blue-500 text-white font-medium py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 transition duration-200">
                    <img src="{{ asset('assets/images/icons/whitePlus.svg') }}" class="w-5 h-5 mr-2" alt="Add Icon">
                    <span>Add</span>
                </button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('assets/js/togglePassword.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
