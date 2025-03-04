<!-- Modal Add User -->
<div id="viewAttendanceModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg space-y-2 w-[480px] max-h-[95vh] flex flex-col justify-between relative">
        <div>
            <div class="bg-slate-100 rounded-t-lg p-3 flex items-center justify-end">
                <button id="closeViewAttendanceModal"
                    class="w-6 h-6 flex items-center justify-center text-gray-500 hover:text-gray-700 transition-colors">
                    <img src="{{ asset('assets/images/icons/xmark.svg') }}" alt="Close"
                        class="w-4 h-4 opacity-75 hover:opacity-100">
                </button>
            </div>

            <div class="p-6 max-h-[80vh] overflow-auto">
                <div class="flex items-center justify-between w-full mb-4">
                    <h2 class="text-xl font-semibold text-gray-600" id="dateText">February 20th, 2025</h2>
                    <div class="flex items-center">
                        <div class="w-2 h-2 rounded-full bg-green-600 mr-2" id="attendanceBullet"></div>
                        <h2 class="text-xl font-light text-green-600" id="attendanceText">
                            Present
                        </h2>
                    </div>
                </div>

                <div class="flex items-center space-x-1 justify-start w-full mb-4">
                    <h2 class="text-4xl font-normal text-gray-800 text-nowrap" id="timeText">07:00</h2>
                    <hr class="w-full pl-6 bg-gray-200" id="timeLine">
                </div>

                <hr class="my-3 border-gray-200">

                <!-- User Information -->
                <div class="flex flex-col items-start space-y-2 w-full mb-4">
                    <div class="flex gap-x-2 items-center">
                        <img src="{{ asset('assets/images/icons/user.svg') }}" class="w-4 opacity-45" alt="">
                        <p class="text-base font-medium text-gray-500">User</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('assets/images/english.png') }}" alt="Profile Picture"
                            class="object-cover w-12 h-12 rounded-full shadow-md" id="userProfilePicture">
                        <div>
                            <span class="block font-semibold text-gray-800" id="userFullnameText">Muhammad Huwaiza Rafi</span>
                            <span class="block text-sm text-gray-500" id="usernameText">@huwaiza</span>
                        </div>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="flex flex-col items-start space-y-2 w-full mb-4">
                    <div class="flex items-center gap-x-2">
                        <img src="{{ asset('assets/images/icons/building.svg') }}" class="w-4 opacity-45"
                            alt="">
                        <p class="text-base font-medium text-gray-500">Location</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('assets/images/CRCS-2018.jpg') }}"
                            class="w-12 h-12 object-cover rounded-md shadow-md" id="locationPic" alt="">
                        <div>
                            <span class="block font-semibold text-gray-800" id="locationText">CRCS - ITB Kampus Ganesha</span>
                            <span class="text-sm text-gray-500 flex items-center gap-x-1" id="locationAddressText">
                                Jl. Dayang Sumbi
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-start gap-y-2 w-full mb-4">
                    <div class="flex items-center gap-x-2">
                        <img src="{{ asset('assets/images/icons/documents.svg') }}" class="w-4 opacity-45"
                            alt="">
                        <p class="text-sm font-medium text-gray-500">Notes</p>
                    </div>
                    <p class="text-sm font-light text-gray-600" id="noteText">Lorem ipsum dolor sit amet consectetur, adipisicing
                        elit. Maiores quae, voluptas enim dignissimos sed perferendis aut possimus commodi deleniti
                        itaque corporis aliquid. Inventore, omnis? Corrupti tempora dignissimos cumque quibusdam dolor?
                    </p>
                </div>
                <div class="flex flex-col items-start gap-y-2 w-full mb-4">
                    <div class="flex items w-full
                    -center gap-x-2">
                        <button
                            class=" items-center justify-center w-24 h-8 hidden bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="rounded-b-lg p-4 bg-slate-100">
            <div class="items-center justify-between hidden">
                <h2 class="text-base font-light text-green-500 flex items-center">
                    <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div> Approved by
                </h2>
                <div class="flex items-center">
                    <img src="{{ asset('assets/images/sunda.png') }}" alt="Profile Picture"
                        class="object-cover w-6 h-6 rounded-full shadow-md">
                    <div class="ml-2">
                        <span class="text-base font-semibold text-gray-700">huwaiza</span>
                    </div>
                </div>
            </div>
            <div class=" w-full gap-x-2 flex">
                <button
                    class="flex items-center justify-center w-1/2 h-10 border-2 border-red-500 rounded-md hover:border-red-600 text-red-500 hover:text-red-600   transition-colors">Reject</button>
                <button
                    class="flex items-center justify-center w-1/2 h-10 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors">Approve</button>
            </div>
        </div>
    </div>
</div>
