<div id="cashModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50">
    <div class="max-w-md bg-white shadow-xl rounded-xl min-w-80 max-h-[80vh] overflow-y-auto">
        <div id="gradientGenderColor" class="w-full rounded-t-lg bg-gradient-to-tr from-blue-600 to-blue-300 h-28">
            <div class="flex items-center justify-end p-4">
                <img id="closeViewcashModal" src="{{ asset('assets/images/icons/xmark.svg') }}"
                    class="w-4 h-4 font-extrabold transition-all duration-150 cursor-pointer opacity-65 hover:opacity-85"
                    alt="closeIcon">
            </div>
        </div>
        <div class="p-6">
            <div class="flex flex-col items-left mb-6 -mt-[73px]">
                <div class="relative flex items-center p-2 mb-1 bg-white rounded-full w-28 h-28">
                    <img id="userProfileImage" src="" alt="User Profile"
                        class="object-cover w-24 h-24 rounded-full shadow-md cursor-pointer">
                    <div
                        class="absolute flex items-center justify-center w-8 h-8 p-1 bg-white rounded-full bottom-1 right-1">
                        <div class="flex items-center justify-center w-6 h-6 bg-green-600 rounded-full">
                            <div class="rounded-full bg-white w-[12px] h-[12px]"></div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <h3 id="userFullname"
                        class="overflow-hidden text-xl font-semibold text-gray-800 max-w-80 whitespace-nowrap text-ellipsis">
                        Nama Siswa
                    </h3>
                    <a href="{{ route('dashboard') }}" id="userPlacement"
                        class="flex items-center ml-2 text-sm font-medium text-gray-600">
                        <span class="h-6 bg-gray-600 w-[2px] rounded-lg"></span>
                        <img src="{{ asset('assets/images/icons/building.svg') }}" alt="placementIcon"
                            class="w-3 ml-2 mr-1 opacity-70">
                        <span id="userPlacement">CRCS</span>
                    </a>
                </div>
            </div>
            <div id="imageOverlay"
                class="fixed inset-0 bg-black bg-opacity-75 items-center justify-center hidden z-[60]">
                <img id="fullScreenImage" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg" src=""
                    alt="Full Screen User Profile">
            </div>
            <div class="space-y-4">
                <div id="majorContainer" class="flex items-center ml-1 gap-x-1">
                    <span class="mr-3 text-blue-400 scale-110 bx bx-menu">
                        <img src="{{ asset('assets/images/icons/major.svg') }}" class="w-6 opacity-75" alt="">
                    </span>
                    <div>
                        <p class="text-sm text-gray-500">Major:</p>
                        <a id="waLink" href="" class="flex items-center">
                            <span id="userMajor">Rekayasa Perangkat Lunak</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center ml-1 gap-x-1">
                    <span class="mr-3 text-blue-400 scale-110 bx bx-menu">
                        <img src="{{ asset('assets/images/icons/institution.svg') }}" class="w-6 opacity-75"
                            alt="">
                    </span>
                    <div>
                        <p class="text-sm text-gray-500">Institution:</p>
                        <a id="waLink" href="" class="flex items-center">
                            <span id="userInstitution">SMK TI Pembangunan Cimahi</span>
                        </a>
                    </div>
                </div>
                <hr class="my-4 border-gray-300">
                <div id="monthInputs" class="space-y-2">
                    <!-- Input bulan ditambahkan via JavaScript; modal akan menampilkan seluruh periode aktif user -->
                </div>
                <div class="flex justify-end mt-6">
                    <button
                        class="px-4 py-2 font-semibold text-white transition-all bg-blue-600 shadow-md save-button hover:bg-blue-700 rounded-xl">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
