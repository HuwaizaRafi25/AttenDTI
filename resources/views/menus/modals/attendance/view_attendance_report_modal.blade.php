<!-- Modal Add User -->
<div id="attendanceReportModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-slate-200 rounded-3xl shadow-lg w-[65%] h-[75vh] flex justify-end relative">
        <div class="w-[30%] h-full flex flex-col justify-center items-center p-6">
            <img src="{{ asset('assets/images/huwajawa.jpg') }}" alt="userPic"
                class="w-32 h-32 object-cover rounded-full mb-2 shadow-lg" id="userPicReport">
            <h1 class="font-semibold text-center">Muhammad Huwaiza Rafi</h1>
            <p class="font-light text-gray-700 text-base">huwaiza.r@itb.ac.id</p>
            <hr class="w-full border-gray-300 my-4">
            <div class="flex flex-col items-start w-full gap-y-4">
                <div id="majorContainer" class="flex items-center ml-1 gap-x-1">
                    <span class="bx bx-menu text-blue-400 mr-3 scale-110">
                        <img src="{{ asset('assets/images/icons/idBadge.svg') }}" class="w-5" alt="">
                    </span>
                    <div>
                        <input type="hidden" name="userId" id="userId">
                        <h1 id="userMajor" class="text-sm">876543456</h1>
                    </div>
                </div>
                <div id="majorContainer" class="flex items-center ml-1 gap-x-1">
                    <span class="bx bx-menu text-blue-400 mr-3 scale-110">
                        <img src="{{ asset('assets/images/icons/major.svg') }}" class="w-6 opacity-75"
                            alt="">
                    </span>
                    <div>
                            <h1 id="userMajor" class="text-sm">Rekayasa Perangkat Lunak</h1>
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
                <button id="closeAttendanceReportModal" type="button"
                    class="w-6 h-6 flex items-center justify-center absolute right-3 text-gray-500 hover:text-gray-700 transition-colors">
                    <img src="{{ asset('assets/images/icons/xmark.svg') }}" alt="Close"
                        class="w-4 h-4 opacity-75 hover:opacity-100">
                </button>
            </div>

            <div class="p-4 flex-1 overflow-y-auto">
                <!-- Main Content -->
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Charts Section -->
                    <div class="w-full md:w-2/3 space-y-6">
                        <!-- Average Check-in Time Chart -->
                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-gray-700 font-medium mb-4">Average Check-in Time</h3>
                            </div>
                            <div class="h-64">
                                <canvas id="checkInTimeChart"></canvas>
                            </div>
                        </div>

                        <!-- Attendance Distribution Chart -->
                        <div class="bg-white rounded-lg shadow p-4">
                            <h3 class="text-gray-700 font-medium mb-4">Attendance Distribution</h3>
                            <div class="h-64">
                                <canvas id="attendanceDistributionChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Section -->
                    <div class="w-full md:w-1/3 space-y-4">
                        <div class="bg-green-50 rounded-lg p-4 border-l-4 border-green-500">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Present</p>
                                    <p id="presentCount" class="text-xl font-bold text-gray-800">0</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-red-50 rounded-lg p-4 border-l-4 border-red-500">
                            <div class="flex items-center">
                                <div class="bg-red-100 p-2 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Absent</p>
                                    <p id="absentCount" class="text-xl font-bold text-gray-800">0</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-amber-50 rounded-lg p-4 border-l-4 border-amber-500">
                            <div class="flex items-center">
                                <div class="bg-amber-100 p-2 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Late</p>
                                    <p id="lateCount" class="text-xl font-bold text-gray-800">0</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 rounded-lg p-4 border-l-4 border-blue-500">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Sick</p>
                                    <p id="sickCount" class="text-xl font-bold text-gray-800">0</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 rounded-lg p-4 border-l-4 border-purple-500">
                            <div class="flex items-center">
                                <div class="bg-purple-100 p-2 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Permit</p>
                                    <p id="permitCount" class="text-xl font-bold text-gray-800">0</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 mt-4">
                            <h4 class="text-gray-700 font-medium mb-2">Attendance Rate</h4>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div id="attendanceRateBar" class="bg-green-600 h-2.5 rounded-full"
                                    style="width: 0%"></div>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span id="attendanceRateText" class="text-sm text-gray-600">0%</span>
                                <span class="text-sm text-gray-500">Target: 100%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>

        </script>

    </div>
</div>
