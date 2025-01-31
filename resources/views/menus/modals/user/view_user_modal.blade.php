<div id="userModal" class="fixed inset-0 bg-black bg-opacity-50  items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-xl max-w-md min-w-80">
        <div id="gradientGenderColor" class="bg-gradient-to-tr from-blue-600 to-blue-300 w-full h-28 rounded-t-lg">
            <div class="flex justify-end items-center p-4">
                <img id="closeViewUserModal" src="{{ asset('assets/images/icons/xmark.svg') }}"
                    class="w-4 h-4 opacity-65 font-extrabold cursor-pointer transition-all duration-150 hover:opacity-85"
                    alt="closeIcon">
            </div>
        </div>
        <div class="p-6">
            <div class="flex flex-col items-left
             mb-6 -mt-[73px]">
                <div class="p-2 w-28 h-28 rounded-full flex items-center mb-1 bg-white relative">
                    <img id="userProfileImage" src="" alt="User Profile"
                        class="w-24 h-24 rounded-full object-cover shadow-md cursor-pointer">

                    <!-- Icon online -->
                    <div
                        class="absolute bottom-1 right-1 p-1 rounded-full bg-white w-8 h-8 flex items-center justify-center">
                        <div class="rounded-full bg-green-600 w-6 h-6 flex items-center justify-center">
                            <div class="rounded-full bg-white w-[12px] h-[12px]"></div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <h3 id="userFullname"
                        class="text-xl max-w-80 overflow-hidden whitespace-nowrap text-ellipsis text-gray-800 font-semibold">
                        Muhammad Huwaiza Rafi</h3>
                    <a href="{{ route('dashboard') }}" id="userPlacement"
                        class="text-gray-600 text-sm font-medium ml-2 flex items-center"><span
                            class="h-6 bg-gray-600 w-[2px] rounded-lg"></span><img
                            src="{{ asset('assets/images/icons/building.svg') }}" alt="placementIcon"
                            class="w-3 ml-2 mr-1 opacity-70"><span id="userPlacement">CRCS</span></a>
                </div>
                <div class="flex text-gray-600 text-sm gap-x-1">
                    <h3 id="userName">huwaiza137</h3>
                    <span>•</span>
                    <p id="userRole">User</p>
                </div>
            </div>
            <div id="imageOverlay"
                class="fixed inset-0 bg-black bg-opacity-75 items-center justify-center hidden z-[60]">
                <img id="fullScreenImage" class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg" src=""
                    alt="Full Screen User Profile">
            </div>
            <div class="space-y-4">
                <div class="flex items-center">
                    <span class="bx bx-menu text-red-400 mr-3 scale-110">
                        <img src="{{ asset('assets/images/logo_itb_512.png') }}" class="w-8" alt="">
                    </span>
                    <div>
                        <p class="text-sm text-gray-500">ITB Account:</p>
                        <a id="emailLink" href="" class="text-blue-600 hover:underline flex items-center">
                            <span id="userITBAccount">mhuwaiza.r@itb.ac.id</span>
                            <span class="bx bx-menu toggle ml-0.5" style="scale: 0.6">
                                {!! file_get_contents(public_path('assets/images/icons/external.svg')) !!}
                            </span>
                        </a>
                    </div>
                </div>
                <div id="majorContainer" class="flex items-center ml-1 gap-x-1">
                    <span class="bx bx-menu text-blue-400 mr-3 scale-110">
                        <img src="{{ asset('assets/images/icons/major.svg') }}" class="w-6 opacity-75"
                            alt="">
                    </span>
                    <div>
                        <p class="text-sm text-gray-500">Major:</p>
                        <a id="waLink" href="" class="flex items-center">
                            <span id="userMajor">Rekayasa Perangkat Lunak</span>
                        </a>
                    </div>
                </div>
                <div class="flex items-center ml-1 gap-x-1">
                    <span class="bx bx-menu text-blue-400 mr-3 scale-110">
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
            </div>
        </div>
    </div>
</div>
