<!-- Modal Add User -->
<div id="attendUserModal" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg space-y-2 w-[480px] max-h-[95vh] flex flex-col justify-between relative">
        <div>
            <div class="bg-slate-100 rounded-t-lg p-3 flex items-center justify-end">
                <button id="closeAttendUserModal" type="button"
                    class="w-6 h-6 flex items-center justify-center text-gray-500 hover:text-gray-700 transition-colors">
                    <img src="<?php echo e(asset('assets/images/icons/xmark.svg')); ?>" alt="Close"
                        class="w-4 h-4 opacity-75 hover:opacity-100">
                </button>
            </div>

            <div class="p-6 max-h-[80vh] overflow-auto">
                <form action="<?php echo e(route('attendance.attendUser')); ?>" method="POST" id="attendUserModalForm">
                    <?php echo csrf_field(); ?>
                    <div class="flex items-center justify-between w-full mb-4">
                        <h2 class="text-xl font-semibold text-gray-600" id="dateText">February 20th, 2025</h2>
                        <div id="attendanceContainer">
                            <select name="attendanceType" id="attendanceTypeAttendUser" class="form-select p-2 border rounded-md shadow-sm">
                                <option value="present" selected>Present</option>
                                <option value="absent">Absent</option>
                                <option value="late">Late</option>
                                <option value="sick">Sick</option>
                                <option value="permit">Permit</option>
                            </select>
                        </div>
                    </div>

                    <div class="" id="timeContainer">
                        <div id="timeInput" class="items-center space-x-1 justify-start w-full mb-4">
                            
                            <input type="time" name="time" id="timeAttendUser" value="<?php echo e(now()->format('H:i')); ?>"
                                class="form-input p-2 border rounded-md shadow-sm">
                        </div>
                    </div>

                    <hr class="my-3 border-[1.5px] border-gray-300">

                    <!-- User Information -->
                    <div class="flex flex-col items-start space-y-2 w-full mb-4">
                        <div class="flex gap-x-2 items-center">
                            <img src="<?php echo e(asset('assets/images/icons/user.svg')); ?>" class="w-4 opacity-45"
                                alt="">
                            <p class="text-base font-medium text-gray-500">User</p>
                        </div>
                        <select name="userId" id="userAttendUser"
                            class="w-full p-3 border rounded-md items-center shadow-sm gap-x-3 mt-1 disabled:bg-gray-100">
                            <option selected disabled hidden value="">
                                Select user
                            </option>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    fetch('/getUsers')
                                        .then(response => response.json())
                                        .then(data => {
                                            let dropdown = document.getElementById("userAttendUser");
                                            data.forEach(user => {
                                                let option = document.createElement("option");
                                                option.value = user.id;
                                                option.textContent = `${user.full_name} - ${user.itb_account}`;
                                                dropdown.appendChild(option);
                                            });
                                        })
                                        .catch(error => console.error('Error:', error));
                                });
                            </script>
                        </select>
                    </div>

                    <!-- Location Information -->
                    <div class="mb-4">
                        <div class="flex flex-col items-start space-y-2 w-full">
                            <div class="flex items-center gap-x-2">
                                <img src="<?php echo e(asset('assets/images/icons/building.svg')); ?>" class="w-4 opacity-45"
                                    alt="">
                                <p class="text-base font-medium text-gray-500">Location</p>
                            </div>
                        </div>
                        <select name="locationId" id="locationAttendUser"
                            class="w-full p-3 border rounded-md items-center shadow-sm gap-x-3 mt-1 disabled:bg-gray-100">
                            <option selected disabled hidden value="">
                                Select Location
                            </option>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    fetch('/getLocations')
                                        .then(response => response.json())
                                        .then(data => {
                                            let dropdown = document.getElementById("locationAttendUser");
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
                            <img src="<?php echo e(asset('assets/images/icons/documents.svg')); ?>" class="w-4 opacity-45"
                                alt="">
                            <p class="text-sm font-medium text-gray-500">Notes</p>
                        </div>
                        <div id="noteContainer" class="w-full">
                            <p class="text-sm font-light text-gray-600" id="noteText">
                            </p>
                            <textarea name="note" id="noteAttendUser" class="form-textarea p-2 border rounded-md shadow-sm w-full" placeholder="Note"></textarea>
                        </div>
                    </div>
                    <hr class="my-3 border-[1.5px] border-gray-300">
                    <div class="flex items-start justify-end gap-x-2 w-full mb-4">
                        <button
                            class=".attendUser-button items-center gap-x-1.5 px-3 py-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-600 hover:-translate-y-1 hover:shadow-lg transition-all duration-200 cursor-pointer"
                            id="attendButton" type="button">
                            <span class="w-4 h-4">
                                <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                            </span>
                            <span class="font-medium">Attend</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\dev\attenDTI_FIX\AttenDTI\AttenDTI\resources\views/menus/modals/attendance/attend_user_modal.blade.php ENDPATH**/ ?>