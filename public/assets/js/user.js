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

// ===== Cetak Data ===== //
function printData(rafiTableId, rafiTableHeader) {
    // Ambil tabel berdasarkan ID
    const table = document.getElementById(rafiTableId);

    // Jika tabel tidak ditemukan, keluar dari fungsi
    if (!table) {
        console.error("Table not found with the given ID:", rafiTableId);
        return;
    }

    // Buat konten HTML untuk dicetak
    let printContents = `
        <html>
            <head>
                <title>${rafiTableHeader}</title>
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
                    @page {
                        size: landscape;
                        margin: 2cm;
                    }
                    body {
                        font-family: 'Inter', sans-serif;
                        color: #374151;
                        line-height: 1.5;
                    }
                    h2 {
                        font-size: 24px;
                        font-weight: 600;
                        margin-bottom: 16px;
                        color: #111827;
                    }
                    table {
                        width: 100%;
                        border-collapse: separate;
                        border-spacing: 0;
                    }
                    th, td {
                        border: 1px solid #e5e7eb;
                        padding: 12px 16px;
                        text-align: left;
                    }
                    th {
                        background-color: #f9fafb;
                        font-weight: 600;
                        text-transform: uppercase;
                        font-size: 12px;
                        letter-spacing: 0.05em;
                    }
                    tr:nth-child(even) {
                        background-color: #f3f4f6;
                    }
                    .flex {
                        display: flex;
                        align-items: center;
                    }
                    .flex-col {
                        flex-direction: column;
                    }
                    .items-center {
                        align-items: center;
                    }
                    .ml-3 {
                        margin-left: 12px;
                    }
                    .font-semibold {
                        font-weight: 600;
                    }
                    .text-sm {
                        font-size: 14px;
                    }
                    .text-gray-500 {
                        color: #6b7280;
                    }
                    .text-center {
                        text-align: center;
                    }
                    .rounded-full {
                        border-radius: 9999px;
                    }
                    .w-10 {
                        width: 40px;
                    }
                    .h-10 {
                        height: 40px;
                    }
                    .bg-green-100 {
                        background-color: #d1fae5;
                    }
                    .text-green-800 {
                        color: #065f46;
                    }
                    .px-2 {
                        padding-left: 8px;
                        padding-right: 8px;
                    }
                    .py-1 {
                        padding-top: 4px;
                        padding-bottom: 4px;
                    }
                    .rounded-md {
                        border-radius: 6px;
                    }
                    .bg-green-400 {
                        background-color: #34d399;
                    }
                    .bg-gray-400 {
                        background-color: #9ca3af;
                    }
                    .text-white {
                        color: white;
                    }
                    .bg-blue-400 {
                        background-color: #60a5fa;
                    }
                    .min-w-\\[100px\\] {
                        min-width: 100px;
                    }
                    .inline-block {
                        display: inline-block;
                    }
                    @media print {
                        .no-print {
                            display: none !important;
                        }
                        .printable{
                           display: flex !important;
                        }
                    }
                </style>
            </head>
            <body>
                <h2>${rafiTableHeader}</h2>
                ${table.outerHTML}
            </body>
        </html>
    `;

    // Buat window baru untuk mencetak
    let printWindow = window.open("", "_blank", "width=1200,height=600");
    printWindow.document.open();
    printWindow.document.write(printContents);
    printWindow.document.close();

    // Tunggu sampai window siap, lalu cetak dan tutup
    printWindow.onload = function () {
        printWindow.print();
        printWindow.onafterprint = function () {
            printWindow.close();
        };
    };
}
document.getElementById("role").addEventListener("change", function () {
    const gridRoleOutlet = document.getElementById("gridRoleOutlet");
    const placementContainer = document.getElementById("placementContainer");

    if (this.value === "user") {
        placementContainer.classList.remove("hidden", "opacity-0");
        placementContainer.classList.add("block", "opacity-100");

        gridRoleOutlet.classList.remove("grid-cols-1");
        gridRoleOutlet.classList.add("grid-cols-2");
    } else {
        placementContainer.classList.remove("opacity-100", "block");
        placementContainer.classList.add("hidden", "opacity-0");

        gridRoleOutlet.classList.remove("grid-cols-2");
        gridRoleOutlet.classList.add("grid-cols-1");
    }
});
// document.getElementById("roleUpdate").addEventListener("change", function () {
//     if (
//         this.value === "kasir" ||
//         this.value === "admin" ||
//         this.value === "manajer"
//     ) {
//         placementContainerUpdate.classList.remove("hidden", "opacity-0");
//         placementContainerUpdate.classList.add("block", "opacity-100");

//         gridRoleOutletUpdate.classList.remove("grid-cols-1");
//         gridRoleOutletUpdate.classList.add("grid-cols-2");
//     } else {
//         placementContainerUpdate.classList.remove("opacity-100", "block");
//         placementContainerUpdate.classList.add("hidden", "opacity-0");

//         gridRoleOutletUpdate.classList.remove("grid-cols-2");
//         gridRoleOutletUpdate.classList.add("grid-cols-1");
//     }
// });

// Preview image


function previewImageProfilePic2(event, imgId) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        const imgElement = document.getElementById(imgId);
        imgElement.src = e.target.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}

// View Image
const userProfileImage = document.getElementById("userProfileImage");
const fullScreenImage = document.getElementById("fullScreenImage");
const imageOverlay = document.getElementById("imageOverlay");

userProfileImage.addEventListener("click", function () {
    fullScreenImage.src = this.src;
    imageOverlay.style.display = "flex"; // Tampilkan overlay
});

imageOverlay.addEventListener("click", function () {
    imageOverlay.style.display = "none";
});

function closeDeleteModal() {
    document.getElementById("deleteModal").classList.add("hidden");
    document.getElementById("deleteModal").classList.remove("flex");
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

    const importUserButton = document.querySelectorAll(".importUserButton");
    const importUserModal = document.getElementById("importUserModal");
    const closeImportUserModal = document.getElementById("closeImportUserModal");
    importUserButton.forEach((button) => {
        button.addEventListener("click", function () {
            importUserModal.classList.remove("hidden");
            importUserModal.classList.add("flex");
        });
    });

    closeImportUserModal.addEventListener("click", function () {
        importUserModal.classList.add("hidden");
        importUserModal.classList.remove("flex");
    });

    importUserModal.addEventListener("click", function (e) {
        if (e.target === importUserModal) {
            importUserModal.classList.add("hidden");
            importUserModal.classList.remove("flex");
        }
    });

    let typingTimer;
    let searchInput = document.getElementById("searchright");
    searchInput.addEventListener("input", function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            fetch("/users/data/search?q=" + searchInput.value)
                .then(function (response) {
                    console.log(response);
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
        let tombolView = document.querySelectorAll(".view-button");
        tombolView.forEach(function (tombol) {
            tombol.addEventListener("click", function (e) {
                e.preventDefault();
                let baris = tombol.closest("tr");

                if (baris) {
                    let pic = baris.getAttribute("data-profile-pic");
                    let username = baris.getAttribute("data-username");
                    let fullname = baris.getAttribute("data-fullname");
                    let role = baris.getAttribute("data-role");
                    let gender = baris.getAttribute("data-gender");
                    let institution = baris.getAttribute("data-institution");
                    let ITBAccount = baris.getAttribute("data-itb-account");
                    let major = baris.getAttribute("data-major");
                    let modalLihat = document.getElementById("userModal");

                    document.getElementById("gradientGenderColor").classList.remove("from-blue-600", "to-blue-300");

                    if (gender == 1) {
                        document
                            .getElementById("gradientGenderColor")
                            .classList.remove("from-red-600", "to-red-300");
                        document
                            .getElementById("gradientGenderColor")
                            .classList.add("from-blue-600", "to-blue-300");
                    } else if (gender == 0) {
                        document
                            .getElementById("gradientGenderColor")
                            .classList.remove("from-blue-600", "to-blue-300");
                        document
                            .getElementById("gradientGenderColor")
                            .classList.add("from-red-600", "to-red-300");
                    } else {
                        document
                            .getElementById("gradientGenderColor")
                            .classList.remove("from-blue-600", "to-blue-300");
                        document
                            .getElementById("gradientGenderColor")
                            .classList.remove("from-red-600", "to-red-300");
                    }


                    if (pic) {
                        document.getElementById(
                            "userProfileImage"
                        ).src = `/storage/profilePics/${pic}`;
                    }
                    document.getElementById("userName").innerText =
                        username || "Tidak ada";
                    document.getElementById("userFullname").innerText =
                        fullname || "Tidak ada";
                    document.getElementById("userRole").innerText =
                        role || "Tidak ada";
                    document.getElementById("userITBAccount").innerText =
                        ITBAccount || "Tidak ada";
                    if (major) {
                        document
                            .getElementById("majorContainer")
                            .classList.remove("hidden");
                        document
                            .getElementById("majorContainer")
                            .classList.add("flex");
                        document.getElementById("userMajor").innerText =
                            major || "Tidak ada";
                    } else {
                        document
                            .getElementById("majorContainer")
                            .classList.remove("flex");
                        document
                            .getElementById("majorContainer")
                            .classList.add("hidden");
                    }
                    document.getElementById("userInstitution").innerText =
                        institution || "Tidak ada";

                    modalLihat.classList.remove("hidden");
                    modalLihat.classList.add("flex");

                    // Event listener untuk menutup modal jika mengklik di luar modal
                    window.addEventListener("click", function (event) {
                        if (event.target === modalLihat) {
                            modalLihat.classList.remove("flex");
                            modalLihat.classList.add("hidden");
                        }
                    });

                    // Tombol "Back" untuk menutup modal
                    let tombolViewBack =
                        document.getElementById("closeViewUserModal");
                    tombolViewBack.addEventListener("click", function () {
                        modalLihat.classList.remove("flex");
                        modalLihat.classList.add("hidden");
                    });
                }
            });
        });

        let tombolUpdate = document.querySelectorAll(".update-button");
        tombolUpdate.forEach(function (tombol) {
            tombol.addEventListener("click", function () {
                let formUpdate = document.getElementById("updateUserForm");
                let modalUpdate = document.getElementById("updateModal");
                let idUser = this.dataset.userId;

                formUpdate.action = "/users/update/" + idUser;
                formUpdate.querySelector(
                    "img#updateProfileImage"
                ).src = `/${this.dataset.userProfilePic}`;
                formUpdate.querySelector('input[name="username"]').value =
                    this.dataset.userUsername;
                formUpdate.querySelector('input[name="namaPengguna"]').value =
                    this.dataset.userNama;
                formUpdate.querySelector('input[name="email"]').value =
                    this.dataset.userEmail;
                formUpdate.querySelector('input[name="telepon"]').value =
                    this.dataset.userTelepon;

                let pilihOutlet = document.getElementById("selectedOutlet");
                let outlet = this.dataset.userOutlet;
                let outletName = this.dataset.userOutletName;
                if (outlet && outletName && pilihOutlet) {
                    pilihOutlet.value = outlet;
                    pilihOutlet.textContent = outletName;
                }

                let pilihRole = document.getElementById("selectedRole");
                let role = this.dataset.userRole;
                pilihRole.value = role;

                // Set nama role yang tampil
                let namaRole = "B/T";
                if (role === "admin") namaRole = "Admin";
                if (role === "owner") namaRole = "Owner";
                if (role === "super_admin") namaRole = "Super Admin";
                if (role === "manajer") namaRole = "Manajer";
                if (role === "kasir") namaRole = "Kasir";

                pilihRole.textContent = namaRole;

                // Logika untuk membagi outlet dan mengatur grid secara otomatis
                const gridRoleOutletUpdate = document.getElementById(
                    "gridRoleOutletUpdate"
                );
                const placementContainerUpdate = document.getElementById(
                    "placementContainerUpdate"
                );

                if (
                    role === "kasir" ||
                    role === "manajer" ||
                    role === "admin"
                ) {
                    placementContainerUpdate.classList.remove(
                        "hidden",
                        "opacity-0"
                    );
                    placementContainerUpdate.classList.add(
                        "block",
                        "opacity-100"
                    );

                    gridRoleOutletUpdate.classList.remove("grid-cols-1");
                    gridRoleOutletUpdate.classList.add("grid-cols-2");
                } else {
                    placementContainerUpdate.classList.remove(
                        "opacity-100",
                        "block"
                    );
                    placementContainerUpdate.classList.add(
                        "hidden",
                        "opacity-0"
                    );

                    gridRoleOutletUpdate.classList.remove("grid-cols-2");
                    gridRoleOutletUpdate.classList.add("grid-cols-1");
                }

                modalUpdate.classList.remove("hidden");
                modalUpdate.classList.add("flex");

                window.addEventListener("click", function (event) {
                    if (event.target === modalUpdate) {
                        modalUpdate.classList.add("hidden");
                        modalUpdate.classList.remove("flex");
                    }
                });

                let tombolBack = document.getElementById("backButton");
                tombolBack.addEventListener("click", function () {
                    modalUpdate.classList.add("hidden");
                    modalUpdate.classList.remove("flex");
                });
            });
        });

        // Delete button
        let tombolDelete = document.querySelectorAll(".delete-button");
        tombolDelete.forEach(function (tombol) {
            tombol.addEventListener("click", function (e) {
                e.preventDefault();
                let idUser = this.getAttribute("data-user-id");
                let namaUser = this.getAttribute("data-user-nama");
                let emailUser = this.getAttribute("data-user-email");
                let picUser = this.getAttribute("data-user-pic");
                let modalHapus = document.getElementById("deleteModal");

                document.getElementById(
                    "imageDelete"
                ).src = `/storage/profilePics/${picUser}`;
                document.getElementById("nameDelete").textContent = namaUser;
                document.getElementById("emailDelete").textContent = emailUser;
                console.log(idUser);
                document.getElementById(
                    "deleteUserForm"
                ).action = `/users/destroy/${idUser}`;

                modalHapus.classList.remove("hidden");
                modalHapus.classList.add("flex");

                // document.getElementById("confirmDelete").onclick = function () {
                //     let form = document.createElement("form");
                //     form.method = "POST";
                //     form.action = "/users/destroy/" + idUser;

                //     let inputToken = document.createElement("input");
                //     inputToken.type = "hidden";
                //     inputToken.name = "_token";
                //     inputToken.value = document.querySelector(
                //         'meta[name="csrf-token"]'
                //     ).content;

                //     let inputMethod = document.createElement("input");
                //     inputMethod.type = "hidden";
                //     inputMethod.name = "_method";
                //     inputMethod.value = "DELETE";

                //     form.appendChild(inputToken);
                //     form.appendChild(inputMethod);
                //     document.body.appendChild(form);
                //     form.submit();
                // };

                window.addEventListener("click", function (event) {
                    if (event.target === modalHapus) {
                        modalHapus.classList.add("hidden");
                        modalHapus.classList.remove("flex");
                    }
                });
            });
        });
    }
    // Jalankan fungsi pasang modal pertama kali
    pasangModal();
});

// ===== User Registration ===== //

let emailTimeoutId;
let timeoutId;

function validateITBAccount(email) {
    const feedback2 = document.getElementById("itb-account-feedback");
    feedback2.classList.add("hidden");
    feedback2.textContent = "";

    function checkDomain() {
        if (!email.endsWith("@itb.ac.id")) {
            feedback2.textContent = "Email harus menggunakan domain @itb.ac.id";
            feedback2.classList.remove("hidden");
            feedback2.classList.add("text-red-500");
        }
    }
    checkDomain();

    clearTimeout(emailTimeoutId);
    emailTimeoutId = setTimeout(async () => {
        try {
            const response = await fetch(
                `users/check/itb-account?itb_account=${email}`
            );
            const data = await response.json();

            if (data.availableEmail) {
                feedback2.textContent = "✅ Email tersedia!";
                feedback2.classList.remove("text-red-500");
                feedback2.classList.remove("text-yellow-500");
                feedback2.classList.add("text-green-500");
                checkDomain();
            } else {
                feedback2.textContent = "❌ Email sudah digunakan";
                feedback2.classList.remove("text-green-500");
                feedback2.classList.remove("text-yellow-500");
                feedback2.classList.add("text-red-500");
            }

            feedback2.classList.remove("hidden");
        } catch (error) {
            console.log(error);
            feedback2.textContent = "⚠️ Gagal memeriksa email";
            feedback2.classList.add("text-yellow-600");
            feedback2.classList.remove("hidden");
        }
    }, 500);
}

function checkPasswordMatch(confirmPassword) {
    const password = document.querySelector('input[name="password"]').value;
    const feedback = document.getElementById("password-feedback");

    feedback.classList.add("hidden");

    if (password !== confirmPassword) {
        feedback.textContent = "Password tidak cocok!";
        feedback.classList.remove("hidden");
        feedback.classList.add("text-red-500");
    }
}

async function checkUsername(username) {
    const feedback = document.getElementById("username-feedback");

    feedback.classList.add("hidden");
    feedback.textContent = "";

    function textMin() {
        if (username.length < 3) {
            feedback.textContent = "Username minimal 3 karakter";
            feedback.classList.remove("hidden");
            feedback.classList.remove("text-green-500");
            feedback.classList.remove("text-red-500");
            feedback.classList.add("text-yellow-500");
            return;
        }
    }
    textMin();
    if (!/^[a-z0-9_]+$/.test(username)) {
        feedback.textContent =
            "Hanya boleh huruf kecil, angka, dan underscore (_)";
        feedback.classList.remove("text-green-500");
        feedback.classList.remove("text-yellow-500");
        feedback.classList.remove("hidden");
        feedback.classList.add("text-red-500");
        return;
    }

    clearTimeout(timeoutId);
    timeoutId = setTimeout(async () => {
        try {
            const response = await fetch(`/users/check/username?username=${username}`);
            console.log(response);
            const data = await response.json();

            if (data.available) {
                feedback.textContent = "✅ Username tersedia!";
                feedback.classList.remove("text-red-500");
                feedback.classList.remove("text-yellow-500");
                feedback.classList.add("text-green-500");
                textMin();
            } else {
                feedback.textContent = "❌ Username sudah digunakan";
                feedback.classList.remove("text-green-500");
                feedback.classList.remove("text-yellow-500");
                feedback.classList.add("text-red-500");
            }

            feedback.classList.remove("hidden");
        } catch (error) {
            feedback.textContent = "⚠️ Gagal memeriksa username";
            feedback.classList.add("text-yellow-600");
            feedback.classList.remove("hidden");
        }
    }, 500);
}
