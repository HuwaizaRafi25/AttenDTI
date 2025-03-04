// ===== Toggle Filter ===== //
function toggleFilter(type, value) {
    let currentUrl = new URL(window.location.href);
    let currentValue = currentUrl.searchParams.get(type);
    if (currentValue === value) {
        currentUrl.searchParams.delete(type);
    } else {
        currentUrl.searchParams.set(type, value);
    }
    window.location.href = currentUrl.toString();
}

function getURLParam(param) {
    let currentUrl = new URL(window.location.href);
    return currentUrl.searchParams.get(param);
}

function buildExportUrl(type) {
    // Ambil parameter dari URL
    let role = getURLParam('role');
    let sort = getURLParam('sort') || 'full_name'; // Default sort: 'full_name'
    let direction = getURLParam('direction') || 'asc'; // Default direction: 'asc'
    let status = getURLParam('status');

    // Bangun query string
    let queryParams = new URLSearchParams();
    if (role) queryParams.append('role', role);
    if (sort) queryParams.append('sort', sort);
    if (direction) queryParams.append('direction', direction);
    if (status) queryParams.append('status', status);

    // Bangun URL ekspor
    let url = `/users/export/${type}?${queryParams.toString()}`;
    // Redirect ke URL ekspor
    console.log("Redirecting to:", url); // Debugging: Cek URL yang dihasilkan
    window.location.href = url
}

// ===== Toggle Sort ===== //
function applySort(column, direction) {
    let currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set("sort", column);
    currentUrl.searchParams.set("direction", direction);
    window.location.href = currentUrl.toString();
}

// ===== Ekspor Data ===== //
function exportData() {
    window.location.href = "/users/export";
}

document.addEventListener("DOMContentLoaded", function () {
    const printUserButton = document.getElementById("printUserButton");
    const userReportModal = document.getElementById("userReportModal");
    const laporanContainer = document.getElementById("laporanContainer");
    const userReportTable = document.getElementById("userReportTable");
    if (printUserButton) {
        printUserButton.addEventListener("click", function () {
            laporanContainer.innerHTML = userReportTable.innerHTML;
            userReportModal.classList.remove("hidden");
            userReportModal.classList.add("flex");
            // printData(userReportTable, userReportTableHeader);
            // userReportTable.classList.add('block');
            // const rafiTableHeader = document.getElementById("rafiTableHeader").innerHTML;
            // printTable(rafiTable, rafiTableHeader);
        });

        const closeButton = document.getElementById("userReportClose");
        closeButton.addEventListener("click", function () {
            userReportModal.classList.add("hidden");
            userReportModal.classList.remove("flex");
        });

        userReportModal.addEventListener("click", function (e) {
            if (e.target === userReportModal) {
                userReportModal.classList.add("hidden");
                userReportModal.classList.remove("flex");
            }
        });
    }

    // Event Tambah Pengguna
    const addButton = document.querySelectorAll(".add-button");
    const addModal = document.getElementById("addModal");
    const closeModal = document.getElementById("closeAddUserModal");
    const addUserForm = document.getElementById("addUserForm");
    addButton.forEach((button) => {
        button.addEventListener("click", function () {
            addModal.classList.remove("hidden");
            addModal.classList.add("flex");
        });
    });

    closeModal.addEventListener("click", function () {
        addModal.classList.add("hidden");
        addModal.classList.remove("flex");
    });

    addModal.addEventListener("click", function (e) {
        if (e.target === addModal) {
            addModal.classList.add("hidden");
            addModal.classList.remove("flex");
        }
    });

    let typingTimer;
    let searchInput = document.getElementById("searchright");
    searchInput.addEventListener("input", function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            fetch("/users/search?q=" + searchInput.value)
                .then(function (response) {
                    return response.text();
                })
                .then(function (html) {
                    document.getElementById("content").innerHTML = html;
                    pasangModal();
                })
                .catch(function (error) {
                    console.log("Gagal mencari data:", error);
                });
        }, 500);
    });

    function pasangModal() {
        let viewButton = document.querySelectorAll(".view-attendance-button");
        viewButton.forEach(function (button) {
            button.addEventListener("click", function () {
                let viewModal = document.getElementById("viewAttendanceModal");
                let idUser = button.getAttribute("data-id");
                let idAttendance = button.getAttribute("data-attendanceId");
                let attendance = button.getAttribute("data-attendance");
                let date = button.getAttribute("data-date");
                let time = button.getAttribute("data-time");
                let userFullname = button.getAttribute("data-userFullname");
                let username = button.getAttribute("data-username");
                let userPic = button.getAttribute("data-userPic");
                let locationAddress = button.getAttribute("data-locationAddress");
                let locationName = button.getAttribute("data-locationName");
                let locationPic = button.getAttribute("data-locationPic");
                let note = button.getAttribute("data-note");

                let dateText = document.getElementById("dateText");
                let timeText = document.getElementById("timeText");
                let timeLine = document.getElementById("timeLine");
                let attendanceText = document.getElementById("attendanceText");
                let attendanceBullet = document.getElementById("attendanceBullet");
                let userFullnameText = document.getElementById("userFullnameText");
                let usernameText = document.getElementById("usernameText");
                let userProfilePicture = document.getElementById("userProfilePicture");
                let locationAddressText = document.getElementById("locationAddressText");
                let locationText = document.getElementById("locationText");
                let locationPicture = document.getElementById("locationPic");
                let noteText = document.getElementById("noteText");

                dateText.textContent = date;
                timeText.textContent = time;
                if (time === "--:--"){
                    timeLine.classList.add("hidden");
                }else{
                    timeLine.classList.remove("hidden");
                }
                userFullnameText.textContent = userFullname;
                usernameText.textContent = '@'+username;
                userProfilePicture.src = `/storage/profilePics/${userPic}`;
                if (note === ''){
                    noteText.textContent = '-';
                    noteText.classList.add("ml-3");
                }else{
                    noteText.textContent = note;
                }

                if (locationName === ''){
                    locationPicture.classList.add("hidden");
                    locationText.classList.add("hidden");
                    locationAddressText.textContent = "-";
                }else{
                    // locationPicture.classList.add("flex");
                    // locationName.classList.add("flex");
                    locationAddressText.textContent = locationAddress;
                    locationText.textContent = locationName;
                    locationPicture.src = `/storage/locationPics/${locationPic}`;
                }

                function clearColor() {
                    attendanceText.classList.remove("text-green-500");
                    attendanceText.classList.remove("text-red-500");
                    attendanceText.classList.remove("text-yellow-500");
                    attendanceText.classList.remove("text-blue-500");
                    attendanceText.classList.remove("text-purple-500");
                    attendanceText.classList.remove("text-gray-500");
                    attendanceBullet.classList.remove("bg-green-500");
                    attendanceBullet.classList.remove("bg-red-500");
                    attendanceBullet.classList.remove("bg-yellow-500");
                    attendanceBullet.classList.remove("bg-blue-500");
                    attendanceBullet.classList.remove("bg-purple-500");
                    attendanceBullet.classList.remove("bg-gray-500");
                }
                attendanceText.textContent = attendance;
                if (attendance == "Present") {
                    clearColor();
                    attendanceText.classList.add("text-green-500");
                    attendanceBullet.classList.add("bg-green-500");
                } else if (attendance == "Absent") {
                    clearColor();
                    attendanceText.classList.add("text-red-500");
                    attendanceBullet.classList.add("bg-red-500");
                } else if (attendance == "Late") {
                    clearColor();
                    attendanceText.classList.add("text-yellow-500");
                    attendanceBullet.classList.add("bg-yellow-500");
                } else if (attendance == "Sick") {
                    clearColor();
                    attendanceText.classList.add("text-blue-500");
                    attendanceBullet.classList.add("bg-blue-500");
                } else if (attendance == "Permit") {
                    clearColor();
                    attendanceText.classList.add("text-purple-500");
                    attendanceBullet.classList.add("bg-purple-500");
                } else{
                    clearColor();
                    attendanceText.classList.add("text-gray-500");
                    attendanceBullet.classList.add("bg-gray-500");
                }


                viewModal.classList.remove("hidden");
                viewModal.classList.add("flex");

                window.addEventListener("click", function (event) {
                    if (event.target === viewModal) {
                        viewModal.classList.add("hidden");
                        viewModal.classList.remove("flex");
                    }
                });

                let tombolBack = document.getElementById("closeViewAttendanceModal");
                tombolBack.addEventListener("click", function () {
                    viewModal.classList.add("hidden");
                    viewModal.classList.remove("flex");
                });
            });
        });
    }
    pasangModal();
});
