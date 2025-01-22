<div id="userModal" class="fixed inset-0 bg-black bg-opacity-50  items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <button id="closeModal" class="text-gray-400 hover:text-gray-500">
                <img src="{{ asset('assets/images/arrowBack.png') }}" alt="arrowBack" class="scale-90 hover:scale-105"
                    id="backViewButton">
                <span class="sr-only">Tutup</span>
            </button>
            <h2 class="text-lg font-semibold text-gray-900">Detail Anggota</h2>
            <div class="w-6"></div> <!-- Spacer for centering -->
        </div>
        <div class="p-6">
            <div class="flex flex-col items-center mb-6">
                <img id="userProfileImage" src="{{ asset('assets/images/userPlaceHolder.png') }}" alt="User Profile"
                    class="w-32 h-32 rounded-full object-cover bg-gray-100 p-2 shadow-md cursor-pointer mb-4">
                <h3 id="userName" class="text-xl font-semibold"></h3>
                <div id="genderCard" class="flex items-center">
                    <img id="genderIcon" src="" alt="Ikon Laki-Laki"
                        class="scale-75">
                    <p id="gender" class="text-sm"></p>
                </div>
            </div>
            <div id="imageOverlay"
                class="fixed inset-0 bg-black bg-opacity-75 items-center justify-center hidden z-[60]">
                <img id="fullScreenImage" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg" src=""
                    alt="Full Screen User Profile">
            </div>
            <div class="space-y-4">
                <div class="flex items-center">
                    <span class="bx bx-menu text-blue-400 mr-3 scale-110">
                        {!! file_get_contents(public_path('assets/images/icons/member.svg')) !!}
                    </span>
                    <div>
                        <p class="text-sm text-gray-500">Bergabung sejak:</p>
                        <div id="waLink" class="flex items-center">
                            <span id="memberSejak"></span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="bx bx-menu text-blue-400 mr-3 scale-110">
                        {!! file_get_contents(public_path('assets/images/icons/phone.svg')) !!}
                    </span>
                    <div>
                        <p class="text-sm text-gray-500">Kontak:</p>
                        <a id="waLink" href="" class="text-blue-600 hover:underline flex items-center">
                            <span id="userContacts"></span>
                            <span class="bx bx-menu toggle ml-0.5" style="scale: 0.6">
                                {!! file_get_contents(public_path('assets/images/icons/external.svg')) !!}
                            </span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="bx bx-menu text-red-400 mr-3 scale-110">
                        {!! file_get_contents(public_path('assets/images/icons/map.svg')) !!}
                    </span>
                    <div>
                        <p class="text-sm text-gray-500">Outlet:</p>
                        <p id="memberAlamat" class="text-gray-900"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
