<!-- Modal Add User -->
<div id="viewAttendanceModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg space-y-2 w-[480px] max-h-[95vh] flex flex-col justify-between relative">
        <div>
            <div class="bg-slate-100 rounded-t-lg p-3 flex items-center justify-end">
                <button id="closeViewAttendanceModal" type="button"
                    class="w-6 h-6 flex items-center justify-center text-gray-500 hover:text-gray-700 transition-colors">
                    <img src="{{ asset('assets/images/icons/xmark.svg') }}" alt="Close"
                        class="w-4 h-4 opacity-75 hover:opacity-100">
                </button>
            </div>

            <div class="p-6 max-h-[80vh] overflow-auto">
                <form action="" method="POST" id="viewAttendanceForm">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center justify-between w-full mb-4">
                        <h2 class="text-xl font-semibold text-gray-600" id="dateText">February 20th, 2025</h2>
                        <div id="attendanceContainer">
                            <div id="attendanceStatusContainer" class="flex items-center">
                                <div class="w-2 h-2 rounded-full mr-2" id="attendanceBullet"></div>
                                <h2 class="text-xl font-light" id="attendanceText">
                                    Present
                                </h2>
                            </div>
                            <select name="attendance" id="attendanceOptions"
                                class="form-select p-2 border rounded-md shadow-sm hidden">
                                <option id="selectedAttendance" selected hidden></option>
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="late">Late</option>
                                <option value="sick">Sick</option>
                                <option value="permit">Permit</option>
                            </select>
                        </div>
                    </div>

                    <div class="" id="timeContainer">
                        <div id="timeChild" class="flex items-center space-x-1 justify-start w-full mb-4">
                            <h2 class="text-4xl font-normal text-gray-800 text-nowrap" id="timeText">07:00</h2>
                            <hr class="w-full pl-6 bg-gray-200 border-dashed" id="timeLine">
                        </div>
                        <div id="timeInput" class="hidden items-center space-x-1 justify-start w-full mb-4">
                            <input type="time" name="time" id="timeInputText"
                                class="form-input p-2 border rounded-md shadow-sm">
                        </div>
                    </div>

                    <hr class="my-3 border-[1.5px] border-gray-300">

                    <!-- User Information -->
                    <div class="flex flex-col items-start space-y-2 w-full mb-4">
                        <div class="flex gap-x-2 items-center">
                            <img src="{{ asset('assets/images/icons/user.svg') }}" class="w-4 opacity-45"
                                alt="">
                            <p class="text-base font-medium text-gray-500">User</p>
                        </div>
                        <div class="flex items-center space-x-3 hover:bg-slate-50 hover:p-2 rounded-md transition-all duration-200 cursor-pointer"
                            id="userContainer">
                            <img src="" alt="Profile Picture"
                                class="object-cover w-12 h-12 rounded-full shadow-md" id="userProfilePicture">
                            <div>
                                <span class="block font-semibold text-gray-800" id="userFullnameText"></span>
                                <span class="block text-sm text-gray-500" id="usernameText"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Location Information -->
                    <div class="mb-4">
                        <div class="flex flex-col items-start space-y-2 w-full">
                            <div class="flex items-center gap-x-2">
                                <img src="{{ asset('assets/images/icons/building.svg') }}" class="w-4 opacity-45"
                                    alt="">
                                <p class="text-base font-medium text-gray-500">Location</p>
                            </div>
                            <div id="locationContainer"
                                class="flex items-center space-x-3 hover:bg-slate-50 hover:p-2 rounded-md transition-all duration-200 cursor-pointer">
                                <img src="" class="w-12 h-12 object-cover rounded-md shadow-md" id="locationPic"
                                    alt="">
                                <div>
                                    <span class="block font-semibold text-gray-800" id="locationText"></span>
                                    <span class="text-sm text-gray-500 flex items-center gap-x-1"
                                        id="locationAddressText"></span>
                                </div>
                            </div>
                        </div>
                        <select name="location" id="locationOptions"
                            class="w-full p-3 border rounded-md items-center shadow-sm gap-x-3 mt-1 disabled:bg-gray-100 hidden">
                            <option value="" selected disabled hidden>
                                Select Location
                            </option>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    fetch('/getLocations')
                                        .then(response => response.json())
                                        .then(data => {
                                            let dropdown = document.getElementById("locationOptions");
                                            data.forEach(location => {
                                                let option = document.createElement("option");
                                                option.value = location.id;
                                                option.textContent = `${location.name} - ${location.address}`;
                                                dropdown.appendChild(option);
                                            });
                                        })
                                        .catch(error => console.error('Error:', error));
                                });
                            </script>
                        </select>
                    </div>
                    <div class="flex flex-col items-start gap-y-2 w-full mb-4">
                        <div class="flex items-center gap-x-2">
                            <img src="{{ asset('assets/images/icons/documents.svg') }}" class="w-4 opacity-45"
                                alt="">
                            <p class="text-sm font-medium text-gray-500">Notes</p>
                        </div>
                        <div id="noteContainer" class="w-full">
                            <p class="text-sm font-light text-gray-600" id="noteText">
                            </p>
                            <textarea name="note" id="noteInput" class="form-textarea p-2 border rounded-md shadow-sm w-full hidden"
                                placeholder="Note"></textarea>
                        </div>
                    </div>
                    <hr class="my-3 border-[1.5px] border-gray-300">
                    <div class="flex items-start justify-end gap-x-2 w-full mb-4">
                        <a class="flex items-center gap-x-1.5 px-3 py-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-600 hover:-translate-y-1 hover:shadow-lg transition-all duration-200 cursor-pointer"
                            id="editButton">
                            <span class="w-4 h-4">
                                <i class="fa-solid fa-pen" style="color: #ffffff;"></i>
                            </span>
                            <span class="font-medium">Edit</span>
                        </a>
                        <a class="hidden items-center gap-x-1.5 px-2.5 py-1 bg-white rounded-md border-2 border-gray-500 text-gray-500 hover:-translate-y-1 hover:shadow-lg transition-all duration-200 cursor-pointer"
                            id="cancelButton">
                            <span class="w-4 h-4">
                                <i class="fa-solid fa-x" style="color: gray;"></i>
                            </span>
                            <span class="font-medium">Cancel</span>
                        </a>
                        <button class="hidden items-center gap-x-1.5 px-3 py-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-600 hover:-translate-y-1 hover:shadow-lg transition-all duration-200 cursor-pointer"
                            id="saveButton" type="button">
                            <span class="w-4 h-4">
                                <i class="fa-solid fa-floppy-disk" style="color: #ffffff;"></i>
                            </span>
                            <span class="font-medium">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="rounded-b-lg p-4 bg-slate-100">
            <div class="items-center justify-between hidden" id="approvalContainer">
                <h2 class="text-base font-light text-green-500 flex items-center" id="approvementStatus">
                    <div class="w-2 h-2 rounded-full bg-green-500 mr-2" id="approvementStatusBullet"></div>
                    <span id="approvementStatusText">Approved by</span>
                </h2>
                <div class="flex items-center">
                    <img src="" alt="Profile Picture" class="object-cover w-6 h-6 rounded-full shadow-md"
                        id="approverProfilePicture">
                    <div class="ml-2">
                        <span class="text-base font-semibold text-gray-700" id="approverText">huwaiza</span>
                    </div>
                </div>
            </div>
            <div class=" w-full gap-x-2 hidden" id="actionButtons">
                <a href=""
                    class="flex items-center justify-center w-1/2 h-10 border-2 border-red-500 rounded-md hover:border-red-600 text-red-500 hover:text-red-600   transition-colors"
                    id="rejectButton">
                    Reject</a>
                <a href=""
                    class="flex items-center justify-center w-1/2 h-10 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors"
                    id="approveButton">
                    Approve
                </a>
            </div>
        </div>
    </div>
</div>
