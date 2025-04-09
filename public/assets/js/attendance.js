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
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

function buildExportUrl(type) {
    let role = getURLParam("role");
    let sort = getURLParam("sort") || "full_name"; // Default sort: 'full_name'
    let direction = getURLParam("direction") || "asc"; // Default direction: 'asc'
    let status = getURLParam("status");
    let month = getURLParam("month");
    let year = getURLParam("year");

    // Bangun query string
    let queryParams = new URLSearchParams();
    if (sort) queryParams.append("sort", sort);
    if (direction) queryParams.append("direction", direction);
    if (status) queryParams.append("status", status);
    if (month) queryParams.append("month", month);
    if (year) queryParams.append("year", year);

    // Bangun URL ekspor
    let url = `/users/export/${type}?${queryParams.toString()}`;
    // Redirect ke URL ekspor
    console.log("Redirecting to:", url); // Debugging: Cek URL yang dihasilkan
    window.location.href = url;
}

// ===== Toggle Sort ===== //
function applySort(column, direction) {
    let currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set("sort", column);
    currentUrl.searchParams.set("direction", direction);
    window.location.href = currentUrl.toString();
}

function setFilter(type, value) {
    let currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set(type, value);
    window.location.href = currentUrl.toString();
}

function applyMonthFilter(month) {
    let currentUrl = new URL(window.location.href);
    let currentMonth = currentUrl.searchParams.get("month");
    if (currentMonth === month) {
        currentUrl.searchParams.delete("month");
    } else {
        currentUrl.searchParams.set("month", month);
    }
}
function applyYearFilter(year) {
    let currentUrl = new URL(window.location.href);
    let currentYear = currentUrl.searchParams.get("year");
    if (currentYear === year) {
        currentUrl.searchParams.delete("year");
    } else {
        currentUrl.searchParams.set("year", year);
    }
}

document.addEventListener("click", function (event) {
    const button = document.getElementById("sortButton");
    const dropdown = document.getElementById("sortDropdown");

    // Kalau klik di luar button dan dropdown
    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add("hidden");
    }
});

// ===== Ekspor Data ===== //
function exportData() {
    window.location.href = "/users/export";
}

const monthButton = document.getElementById("monthButton");
const monthDropdown = document.getElementById("monthDropdown");
const selectedMonth = document.getElementById("selectedMonth");
const monthOptions = document.querySelectorAll(".month-option");
const monthInput = document.getElementById("monthInput");

// Year Selector
const yearButton = document.getElementById("yearButton");
const yearDropdown = document.getElementById("yearDropdown");
const selectedYear = document.getElementById("selectedYear");
const yearOptions = document.querySelectorAll(".year-option");
const yearInput = document.getElementById("yearInput");

// Toggle month dropdown
monthButton.addEventListener("click", function () {
    monthDropdown.classList.toggle("hidden");
    // Close year dropdown if open
    yearDropdown.classList.add("hidden");
});

// Toggle year dropdown
yearButton.addEventListener("click", function () {
    yearDropdown.classList.toggle("hidden");
    // Close month dropdown if open
    monthDropdown.classList.add("hidden");
});

monthOptions.forEach((option) => {
    option.addEventListener("click", function () {
        const month = this.getAttribute("data-month");
        const monthText = this.getAttribute("data-monthText");
        selectedMonth.textContent = monthText;
        monthInput.value = month;
        monthOptions.forEach((opt) => {
            opt.classList.remove("bg-blue-50", "text-blue-600", "font-medium");
        });
        this.classList.add("bg-blue-50", "text-blue-600", "font-medium");
        monthDropdown.classList.add("hidden");
        setFilter("month", month); // Apply filter
    });
});

// Handle year selection
yearOptions.forEach((option) => {
    option.addEventListener("click", function () {
        const year = this.getAttribute("data-year");
        const yearText = this.getAttribute("data-yearText");
        selectedYear.textContent = year;
        yearInput.value = year;
        yearOptions.forEach((opt) => {
            opt.classList.remove("bg-blue-50", "text-blue-600", "font-medium");
        });
        this.classList.add("bg-blue-50", "text-blue-600", "font-medium");
        yearDropdown.classList.add("hidden");
        setFilter("year", year); // Apply filter
    });
});

// Close dropdowns when clicking outside
document.addEventListener("click", function (event) {
    if (
        !monthButton.contains(event.target) &&
        !monthDropdown.contains(event.target)
    ) {
        monthDropdown.classList.add("hidden");
    }

    if (
        !yearButton.contains(event.target) &&
        !yearDropdown.contains(event.target)
    ) {
        yearDropdown.classList.add("hidden");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    attendanceOptions.addEventListener("change", function () {
        let selected =
            attendanceOptions.options[attendanceOptions.selectedIndex];
        selectedAttendance.value = selected.value;
        selectedAttendance.textContent = selected.textContent;
        if (selected.value === "absent") {
            locationOptions.disabled = true;
            noteInput.disabled = true;
            timeInputText.disabled = true;
        } else {
            locationOptions.disabled = false;
            noteInput.disabled = false;
            timeInputText.disabled = false;
        }
    });

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
    const importButton = document.querySelectorAll(".importButton");
    const importAttendanceModal = document.getElementById(
        "importAttendanceModal"
    );
    const closeImportModal = document.getElementById(
        "closeImportAttendanceModal"
    );
    const attendUserButton = document.querySelectorAll(".attendUser-button");
    const attendUserModal = document.getElementById("attendUserModal");
    const closeModal = document.getElementById("closeAttendUserModal");
    const addUserForm = document.getElementById("addUserForm");
    attendUserButton.forEach((button) => {
        button.addEventListener("click", function () {
            attendUserModal.classList.remove("hidden");
            attendUserModal.classList.add("flex");
        });
    });

    attendanceTypeAttendUser = document.getElementById(
        "attendanceTypeAttendUser"
    );
    timeAttendUser = document.getElementById("timeAttendUser");
    locationAttendUser =
        document.getElementById("locationAttendUser");
    noteAttendUser = document.getElementById("noteAttendUser");
    attendButton = document.getElementById("attendButton");
    attendUserModalForm = document.getElementById(
        "attendUserModalForm"
    );
    userAttendUser = document.getElementById("userAttendUser");

    attendButton.onclick = function () {
        const type = attendanceTypeAttendUser.value;

        if (!type) {
            alert("Please select an attendance status");
            return;
        }

        const isTimeRequired = ["present", "sick", "permit", "late"].includes(type);
        const isLocationRequired = ["present", "late"].includes(type);
        const isNoteRequired = ["sick", "permit", "late"].includes(type);
        const isUserRequired = ["present", "sick", "permit", "late","absent"].includes(type);
        if (isUserRequired && !userAttendUser.value) {
            alert("Please select a user");
            return;
        }
        if (isTimeRequired && !timeAttendUser.value) {
            alert("Please fill in the time");
            return;
        }

        if (isLocationRequired && !locationAttendUser.value) {
            alert("Please select a location");
            return;
        }

        if (isNoteRequired && !noteAttendUser.value) {
            alert("Please fill in the note");
            return;
        }

        attendUserModalForm.submit();
    };


    closeModal.addEventListener("click", function () {
        attendUserModal.classList.add("hidden");
        attendUserModal.classList.remove("flex");
    });

    attendUserModal.addEventListener("click", function (e) {
        if (e.target === attendUserModal) {
            attendUserModal.classList.add("hidden");
            attendUserModal.classList.remove("flex");
        }
    });

    importButton.forEach((button) => {
        button.addEventListener("click", function () {
            importAttendanceModal.classList.remove("hidden");
            importAttendanceModal.classList.add("flex");
        });
    });
    closeImportModal.addEventListener("click", function () {
        importAttendanceModal.classList.add("hidden");
        importAttendanceModal.classList.remove("flex");
    });
    importAttendanceModal.addEventListener("click", function (e) {
        if (e.target === importAttendanceModal) {
            importAttendanceModal.classList.add("hidden");
            importAttendanceModal.classList.remove("flex");
        }
    });
    let typingTimer;
    let searchInput = document.getElementById("searchright");
    searchInput.addEventListener("input", function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            // memperbarui url dengan parameter pencarian
            toggleFilter("search", searchInput.value);
        }, 1000); // 500 ms delay
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
                console.log(time);
                let userFullname = button.getAttribute("data-userFullname");
                let username = button.getAttribute("data-username");
                let userPic = button.getAttribute("data-userPic");
                let locationAddress = button.getAttribute(
                    "data-locationAddress"
                );
                let locationName = button.getAttribute("data-locationName");
                let locationPic = button.getAttribute("data-locationPic");
                let note = button.getAttribute("data-note");
                let status = button.getAttribute("data-status");
                let approver = button.getAttribute("data-approver");
                let approverPic = button.getAttribute("data-approverPic");

                let dateText = document.getElementById("dateText");
                let timeText = document.getElementById("timeText");
                let timeLine = document.getElementById("timeLine");
                let attendanceText = document.getElementById("attendanceText");
                let attendanceBullet =
                    document.getElementById("attendanceBullet");
                let userFullnameText =
                    document.getElementById("userFullnameText");
                let usernameText = document.getElementById("usernameText");
                let userProfilePicture =
                    document.getElementById("userProfilePicture");
                let locationAddressText = document.getElementById(
                    "locationAddressText"
                );
                let locationText = document.getElementById("locationText");
                let locationPicture = document.getElementById("locationPic");
                let noteText = document.getElementById("noteText");
                let noteInput = document.getElementById("noteInput");
                let approvalContainer =
                    document.getElementById("approvalContainer");
                let actionButtons = document.getElementById("actionButtons");
                let approverText = document.getElementById("approverText");
                let approverProfilePicture = document.getElementById(
                    "approverProfilePicture"
                );
                let approvementStatusText = document.getElementById(
                    "approvementStatusText"
                );
                let approvementStatus =
                    document.getElementById("approvementStatus");
                let approvementStatusBullet = document.getElementById(
                    "approvementStatusBullet"
                );
                let approveButton = document.getElementById("approveButton");
                let rejectButton = document.getElementById("rejectButton");
                let editButton = document.getElementById("editButton");
                let saveButton = document.getElementById("saveButton");
                let cancelButton = document.getElementById("cancelButton");
                let userContainer = document.getElementById("userContainer");
                let attendanceOptions =
                    document.getElementById("attendanceOptions");
                let selectedAttendance =
                    document.getElementById("selectedAttendance");
                let attendanceStatusContainer = document.getElementById(
                    "attendanceStatusContainer"
                );
                let timeChild = document.getElementById("timeChild");
                let timeInput = document.getElementById("timeInput");
                let timeInputText = document.getElementById("timeInputText");
                let locationContainer =
                    document.getElementById("locationContainer");
                let locationOptions =
                    document.getElementById("locationOptions");
                let noteContainer = document.getElementById("noteContainer");
                let viewAttendanceForm =
                    document.getElementById("viewAttendanceForm");

                editButton.onclick = function () {
                    viewAttendanceForm.setAttribute(
                        "action",
                        `/attendance/update/${idAttendance}`
                    );

                    if (attendance === "Absent") {
                        locationOptions.disabled = true;
                        noteInput.disabled = true;
                        timeInputText.disabled = true;
                    } else {
                        locationOptions.disabled = false;
                        noteInput.disabled = false;
                        timeInputText.disabled = false;
                    }
                    timeInputText.value = time;
                    tombolBack.classList.add("hidden");
                    tombolBack.classList.remove("flex");
                    saveButton = document.getElementById("saveButton");
                    cancelButton = document.getElementById("cancelButton");
                    saveButton.classList.remove("hidden");
                    saveButton.classList.add("flex");
                    cancelButton.classList.remove("hidden");
                    cancelButton.classList.add("flex");
                    editButton.classList.add("hidden");
                    editButton.classList.remove("flex");

                    attendanceOptions.classList.remove("hidden");
                    selectedAttendance.value = attendance.toLocaleLowerCase;
                    selectedAttendance.textContent = attendance;

                    attendanceStatusContainer.classList.add("hidden");
                    attendanceStatusContainer.classList.remove("flex");

                    timeChild.classList.add("hidden");
                    timeChild.classList.remove("flex");
                    timeInput.classList.remove("hidden");

                    locationContainer.classList.remove("flex");
                    locationContainer.classList.add("hidden");
                    locationOptions.classList.remove("hidden");

                    userContainer.classList.remove(
                        "hover:bg-slate-50",
                        "hover:p-2",
                        "cursor-pointer"
                    );
                    userContainer.onclick = function () {
                        return false;
                    };

                    noteText.classList.add("hidden");
                    noteInput.classList.remove("hidden");
                    noteInput.value = note;
                };

                saveButton.onclick = function () {
                    if (attendanceOptions.value === "absent") {
                        // Langsung submit form
                        viewAttendanceForm.submit();
                    } else if (attendanceOptions.value === "present") {
                        if (timeInputText.value === "") {
                            alert("Please fill in the time");
                            return;
                        }
                        if (locationOptions.value === "") {
                            alert("Please select a location");
                            return;
                        }
                        viewAttendanceForm.submit();
                    } else if (
                        attendanceOptions.value === "sick" ||
                        attendanceOptions.value === "permit"
                    ) {
                        if (timeInputText.value === "") {
                            alert("Please fill in the time");
                            return;
                        }
                        if (noteInput.value === "") {
                            alert("Please fill in the note");
                            return;
                        }
                        viewAttendanceForm.submit();
                    } else if (attendanceOptions.value === "late") {
                        if (timeInputText.value === "") {
                            alert("Please fill in the time");
                            return;
                        }
                        if (locationOptions.value === "") {
                            alert("Please select a location");
                            return;
                        }
                        if (noteInput.value === "") {
                            alert("Please fill in the note");
                            return;
                        }
                        viewAttendanceForm.submit();
                    } else {
                        alert("Please select an attendance status");
                    }
                };

                cancelButton.onclick = function () {
                    tombolBack.classList.remove("hidden");
                    tombolBack.classList.add("flex");
                    saveButton.classList.add("hidden");
                    saveButton.classList.remove("flex");
                    cancelButton.classList.add("hidden");
                    cancelButton.classList.remove("flex");
                    editButton.classList.remove("hidden");
                    editButton.classList.add("flex");

                    attendanceOptions.classList.add("hidden");
                    attendanceStatusContainer.classList.remove("hidden");
                    attendanceStatusContainer.classList.add("flex");

                    timeChild.classList.remove("hidden");
                    timeChild.classList.add("flex");
                    timeInput.classList.add("hidden");

                    locationContainer.classList.add("flex");
                    locationContainer.classList.remove("hidden");
                    locationOptions.classList.add("hidden");

                    userContainer.classList.add(
                        "hover:bg-slate-50",
                        "hover:p-2",
                        "cursor-pointer"
                    );
                    userContainer.onclick = function () {
                        window.location.href = `/users/${username}`;
                    };

                    noteText.classList.remove("hidden");
                    noteInput.classList.add("hidden");
                };

                function hiddenActionButtons() {
                    actionButtons.classList.remove("flex");
                    actionButtons.classList.add("hidden");
                    approvalContainer.classList.remove("flex");
                    approvalContainer.classList.add("hidden");
                }

                function resetApprovementStatus() {
                    approvementStatusText.textContent = "";
                    approvementStatusText.classList.remove(
                        "text-green-500",
                        "text-red-500",
                        "text-gray-500"
                    );
                    approvementStatusBullet.classList.remove(
                        "bg-green-500",
                        "bg-red-500",
                        "bg-gray-500"
                    );
                }

                if (attendance == "Absent" && status == "approved") {
                    resetApprovementStatus();
                    approvementStatusText.textContent = "Absented by";
                    approvementStatusText.classList.add("text-gray-500");
                    approvementStatusBullet.classList.add("bg-gray-500");
                } else if (attendance == "Absent" && status == "rejected") {
                    resetApprovementStatus();
                    approvementStatusText.textContent = "Rejected by";
                    approvementStatusText.classList.add("text-red-500");
                    approvementStatusBullet.classList.add("bg-red-500");
                } else {
                    resetApprovementStatus();
                    approvementStatusText.textContent = "Approved by";
                    approvementStatusText.classList.add("text-green-500");
                    approvementStatusBullet.classList.add("bg-green-500");
                }

                if (status === "pending") {
                    hiddenActionButtons();
                    actionButtons.classList.remove("hidden");
                    actionButtons.classList.add("flex");
                    approveButton.href = `../attendance/approval/1/${idAttendance}`;
                    rejectButton.href = `../attendance/approval/0/${idAttendance}`;
                } else {
                    hiddenActionButtons();
                    approvalContainer.classList.remove("hidden");
                    approvalContainer.classList.add("flex");
                    if (approver === "") {
                        approverText.textContent = "System";
                        approverProfilePicture.src =
                            "/assets/images/icons/setting.svg";
                    } else {
                        approverText.textContent = approver;
                        if (approverPic === "") {
                            approverProfilePicture.src =
                                "/assets/images/userPlaceholder.png";
                        } else {
                            approverProfilePicture.src = `/storage/profilePics/${approverPic}`;
                        }
                    }
                }

                dateText.textContent = date;
                timeText.textContent = time;
                if (time === "--:--") {
                    timeLine.classList.add("hidden");
                } else {
                    timeLine.classList.remove("hidden");
                }
                userFullnameText.textContent = userFullname;
                usernameText.textContent = "@" + username;
                if (userPic === null) {
                    userProfilePicture.src =
                        "/assets/images/userPlaceholder.png";
                } else {
                    fetch(`/storage/profilePics/${userPic}`, { method: "HEAD" })
                        .then((response) => {
                            if (response.ok) {
                                userProfilePicture.src = `/storage/profilePics/${userPic}`;
                            } else {
                                userProfilePicture.src =
                                    "/assets/images/userPlaceholder.png";
                            }
                        })
                        .catch((error) => {
                            console.error(
                                "Error checking profile picture:",
                                error
                            );
                            userProfilePicture.src =
                                "/assets/images/userPlaceholder.png";
                        });
                }
                if (note === "") {
                    noteText.textContent = "-";
                    noteText.classList.add("ml-3");
                } else {
                    noteText.textContent = note;
                    noteText.classList.remove("ml-3");
                }

                userContainer.onclick = function () {
                    window.location.href = `/users/${username}`;
                };

                if (locationName === "") {
                    locationPicture.classList.add("hidden");
                    locationText.classList.add("hidden");
                    locationAddressText.textContent = "-";
                } else {
                    locationPicture.classList.remove("hidden");
                    locationText.classList.remove("hidden");
                    locationAddressText.textContent = locationAddress;
                    locationText.textContent = locationName;
                    if (locationPic === null) {
                        locationPicture.src =
                            "/assets/images/picPlaceholder.png";
                    } else {
                        fetch(`/storage/locationPics/${locationPic}`, {
                            method: "HEAD",
                        })
                            .then((response) => {
                                if (response.ok) {
                                    locationPicture.src = `/storage/locationPics/${locationPic}`;
                                } else {
                                    locationPicture.src =
                                        "/assets/images/picPlaceholder.png";
                                }
                            })
                            .catch((error) => {
                                console.error(
                                    "Error checking profile picture:",
                                    error
                                );
                                locationPicture.src =
                                    "/assets/images/picPlaceholder.png";
                            });
                    }
                }

                attendanceText.textContent = attendance;
                let color = "gray"; // Default color
                if (attendance === "Present") color = "green";
                else if (attendance === "Absent") color = "red";
                else if (attendance === "Late") color = "yellow";
                else if (attendance === "Sick") color = "gray";
                else if (attendance === "Permit") color = "blue";

                attendanceText.classList.remove(
                    "text-green-500",
                    "text-gray-500",
                    "text-yellow-500",
                    "text-red-500",
                    "text-blue-500"
                );
                attendanceBullet.classList.remove(
                    "bg-green-500",
                    "bg-yellow-500",
                    "bg-blue-500",
                    "bg-red-500",
                    "bg-gray-500"
                );

                // Tambahkan warna baru
                attendanceText.classList.add(`text-${color}-500`);
                attendanceBullet.classList.add(`bg-${color}-500`);

                viewModal.classList.remove("hidden");
                viewModal.classList.add("flex");

                // window.addEventListener("click", function (event) {
                //     if (event.target === viewModal) {
                //         viewModal.classList.add("hidden");
                //         viewModal.classList.remove("flex");
                //     }
                // });

                let tombolBack = document.getElementById(
                    "closeViewAttendanceModal"
                );
                tombolBack.addEventListener("click", function () {
                    viewModal.classList.add("hidden");
                    viewModal.classList.remove("flex");
                });
            });
        });
    }
    pasangModal();
});
