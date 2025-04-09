<!-- Modal Add User -->
<div id="attendUserModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-slate-200 rounded-3xl shadow-lg w-[65%] h-[75vh] flex justify-end relative">
        <div class="w-[30%] h-full flex flex-col justify-center items-center p-6">
            <img src="{{ asset('assets/images/sunda.png') }}" alt="userPic"
                class="w-32 h-32 object-cover rounded-full mb-2 shadow-lg" id="userPicReport">
            <h1 class="font-semibold text-center">Muhammad Huwaiza Rafi</h1>
            <p class="font-light text-gray-700 text-base">huwaiza.r@itb.ac.id</p>
            <hr class="w-full border-gray-300 my-4">
            <div class="flex flex-col items-start w-full gap-y-4">
                <div id="majorContainer" class="flex items-center ml-1 gap-x-1">
                    <span class="bx bx-menu text-blue-400 mr-3 scale-110">
                        <img src="{{ asset('assets/images/icons/idBadge.svg') }}" class="w-5"
                            alt="">
                    </span>
                    <div>
                            <h1 id="userMajor" class="text-sm">876543456</h1>
                    </div>
                </div>
                <div class="flex items-center ml-1 gap-x-1">
                    <span class="bx bx-menu text-blue-400 mr-3 scale-110">
                        <img src="{{ asset('assets/images/icons/institution.svg') }}" class="w-6 opacity-75"
                            alt="">
                    </span>
                    <div>
                            <h1 id="userInstitution" class="text-sm">SMK TI Pembangunan Cimahi</h1>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="w-[70%] h-full bg-white rounded-2xl border-l-[1px] border-gray-600/30 flex flex-col justify-between">
            <div class="p-4 flex items-center justify-center relative">
                <h1 class="text-xl font-semibold text-gray-600">
                    User Attendance Report
                </h1>
                <button id="closeAttendUserModal" type="button"
                    class="w-6 h-6 flex items-center justify-center absolute right-3 text-gray-500 hover:text-gray-700 transition-colors">
                    <img src="{{ asset('assets/images/icons/xmark.svg') }}" alt="Close"
                        class="w-4 h-4 opacity-75 hover:opacity-100">
                </button>
            </div>

            <div class="">

            </div>
        </div>
    </div>
</div>
