function fetchJobs() {
    const searchTerm = document.getElementById("searchInput")?.value || "";
    const selectedJobTypes = Array.from(
        document.querySelectorAll('input[name="jobType[]"]:checked')
    ).map((cb) => cb.value);
    const selectedExperienceLevels = Array.from(
        document.querySelectorAll('input[name="experienceLevel[]"]:checked')
    ).map((cb) => cb.value);

    const params = new URLSearchParams();
    params.append("search", searchTerm);
    selectedJobTypes.forEach((type) => params.append("jobType[]", type));
    selectedExperienceLevels.forEach((level) =>
        params.append("experienceLevel[]", level)
    );

    // Tampilkan loading state
    const jobList = document.getElementById("jobList");
    if (jobList) {
        jobList.innerHTML =
            '<div class="col-span-full text-center py-4">Loading...</div>';
    }

    fetch(`${window.location.pathname}?${params.toString()}`, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            Accept: "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            updateJobList(data.jobs);
            updateURL(params);
        })
        .catch((error) => {
            console.error("Error:", error);
            if (jobList) {
                jobList.innerHTML =
                    '<div class="col-span-full text-center py-4 text-red-500">Error loading jobs. Please try again.</div>';
            }
        });
}

function updateJobList(jobs) {
    const jobList = document.getElementById("jobList");
    if (!jobList) return;

    if (!jobs.length) {
        jobList.innerHTML =
            '<div class="col-span-full text-center py-4">No jobs found.</div>';
        return;
    }

    jobList.innerHTML = jobs
        .map((job) => {
            const companyName = job.companies?.company_name || "";
            const firstLetter = companyName.charAt(0).toUpperCase();
            const jobTypes =
                job.job_type
                    ?.split(",")
                    .map(
                        (type) =>
                            `<span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">${type.trim()}</span>`
                    )
                    .join("") || "";

            const isPinned = job.pinned_users?.some(
                (user) => user.id === window.userId
            );

            return `
                <div class="relative">
                    <a href="/job_detail/${job.id}">
                        <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg overflow-hidden flex items-center justify-center">
                                        <span class="text-blue-600 font-bold">${firstLetter}</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold">${
                                            job.job_title
                                        }</h3>
                                        <p class="text-sm text-gray-600">${companyName}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-2 mt-3">
                                ${jobTypes}
                            </div>
                            <p class="mt-3 text-sm text-gray-600 line-clamp-2">${
                                job.job_description
                            }</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="font-semibold">
                                    Rp ${parseInt(job.salary).toLocaleString(
                                        "id-ID"
                                    )}/month
                                </span>
                                <span class="text-sm text-gray-500">
                                    Closing on ${job.end_date}
                                </span>
                            </div>
                        </div>
                    </a>
                    <div class="absolute top-4 right-4 pin-job cursor-pointer ${
                        isPinned
                            ? "text-red-500"
                            : "text-gray-400 hover:text-gray-600"
                    }"
                         data-job-id="${job.id}">
                        <i class="${
                            isPinned ? "fa-solid" : "fa-regular"
                        } fa-heart"></i>
                    </div>
                </div>
            `;
        })
        .join("");

    // Pasang ulang event listener untuk pin job
    attachPinJobListeners();
}

function attachPinJobListeners() {
    document.querySelectorAll(".pin-job").forEach((element) => {
        element.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();

            const jobId = this.getAttribute("data-job-id");
            const heartContainer = this;
            const icon = this.querySelector("i");

            fetch(`/jobs/${jobId}/pin`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === "success") {
                        icon.classList.replace("fa-regular", "fa-solid");
                        heartContainer.classList.remove(
                            "text-gray-400",
                            "hover:text-gray-600"
                        );
                        heartContainer.classList.add("text-red-500");
                        // Refresh halaman setelah pin berhasil
                        location.reload();
                    } else if (data.status === "removed") {
                        icon.classList.replace("fa-solid", "fa-regular");
                        heartContainer.classList.remove("text-red-500");
                        heartContainer.classList.add(
                            "text-gray-400",
                            "hover:text-gray-600"
                        );
                        // Refresh halaman setelah unpin berhasil (optional)
                        location.reload();
                    }
                })
                .catch((error) => console.error("Error:", error));
        });
    });
}

function updateURL(params) {
    const newUrl = `${window.location.pathname}?${params.toString()}`;
    window.history.pushState({}, "", newUrl);
}

function debounce(func, wait) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

// Inisialisasi event listener untuk filter dan pencarian
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".filter-checkbox").forEach((checkbox) => {
        checkbox.addEventListener("change", fetchJobs);
    });

    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.addEventListener("input", debounce(fetchJobs, 300));
    }

    // Lakukan fetch awal jika ada filter yang dipilih
    if (document.querySelectorAll(".filter-checkbox:checked").length > 0) {
        fetchJobs();
    }
});

/* === Modal, Form Input, dan Validasi (Kode Kedua) === */
document.addEventListener("DOMContentLoaded", function () {
    // Modal dan penanganan form job posting
    const modal = document.getElementById("modal");
    const openModalBtn = document.getElementById("openModal");
    const backButton = document.getElementById("backButton");
    const addQualificationBtn = document.getElementById("addQualificationBtn");
    const addResponsibilityBtn = document.getElementById(
        "addResponsibilityBtn"
    );
    const qualificationsContainer = document.getElementById(
        "qualificationsContainer"
    );
    const responsibilitiesContainer = document.getElementById(
        "responsibilitiesContainer"
    );

    if (openModalBtn) {
        openModalBtn.addEventListener("click", () => {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        });
    }

    modal.addEventListener("click", function (e) {
        if (e.target === this || e.target === backButton) {
            this.classList.add("hidden");
            this.classList.remove("flex");
        }
    });

    function createInputField(name, placeholderText) {
        const container = document.createElement("div");
        container.className = "flex items-center mt-2";

        const input = document.createElement("input");
        input.type = "text";
        input.name = `${name}[]`;
        input.placeholder = `Enter ${placeholderText}`;
        input.className =
            "w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500";

        const removeBtn = document.createElement("button");
        removeBtn.type = "button";
        removeBtn.innerHTML = "&times;";
        removeBtn.className =
            "ml-2 px-3 py-1 bg-transparent text-red-500 rounded hover:bg-red-200 focus:outline-none";
        removeBtn.addEventListener("click", () => {
            container.remove();
        });

        container.appendChild(input);
        container.appendChild(removeBtn);

        return container;
    }

    addQualificationBtn &&
        addQualificationBtn.addEventListener("click", () => {
            if (qualificationsContainer.children.length < 10) {
                const inputField = createInputField(
                    "qualifications",
                    "Qualification"
                );
                qualificationsContainer.appendChild(inputField);
            } else {
                alert("Maksimal 10 input Qualification telah ditambahkan.");
            }
        });

    addResponsibilityBtn &&
        addResponsibilityBtn.addEventListener("click", () => {
            if (responsibilitiesContainer.children.length < 10) {
                const inputField = createInputField(
                    "responsibilities",
                    "Responsibility"
                );
                responsibilitiesContainer.appendChild(inputField);
            } else {
                alert("Maksimal 10 input Responsibility telah ditambahkan.");
            }
        });

    // Penanganan pemilihan job type
    document.querySelectorAll(".job-type-item").forEach((item) => {
        item.addEventListener("click", function () {
            const checkbox = this.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;
            if (checkbox.checked) {
                this.classList.add("bg-blue-500", "text-white");
                this.classList.remove("border-gray-300", "hover:bg-blue-50");
            } else {
                this.classList.remove("bg-blue-500", "text-white");
                this.classList.add("border-gray-300", "hover:bg-blue-50");
            }
        });
    });

    // Dropdown untuk filter job type
    function toggleDropdown(e) {
        e.stopPropagation(); // Hentikan propagasi event agar tidak ditangani oleh listener dokumen
        const dropdown = document.getElementById("jobTypeDropdown");
        // Gunakan e.currentTarget untuk mendapatkan tombol yang diklik
        const button = e.currentTarget;
        const icon = button.querySelector("svg");
        if (dropdown.classList.contains("hidden")) {
            dropdown.classList.remove("hidden");
            dropdown.classList.add("block");
            icon.style.transform = "rotate(180deg)";
        } else {
            dropdown.classList.add("hidden");
            dropdown.classList.remove("block");
            icon.style.transform = "rotate(0deg)";
        }
    }

    // Pastikan tombol dropdown menggunakan event listener daripada inline JS jika memungkinkan
    const dropdownToggleBtn = document.querySelector(
        'button[onclick^="toggleDropdown"]'
    );
    if (dropdownToggleBtn) {
        dropdownToggleBtn.addEventListener("click", toggleDropdown);
    }

    document.addEventListener("click", function (event) {
        const dropdown = document.getElementById("jobTypeDropdown");
        const button = document.querySelector(
            'button[onclick^="toggleDropdown"]'
        );
        if (
            button &&
            !button.contains(event.target) &&
            !dropdown.contains(event.target)
        ) {
            dropdown.classList.add("hidden");
            dropdown.classList.remove("block");
            const icon = button.querySelector("svg");
            if (icon) {
                icon.style.transform = "rotate(0deg)";
            }
        }
    });

    const dropdownIcon = document.querySelector(
        'button[onclick^="toggleDropdown"] svg'
    );
    if (dropdownIcon) {
        dropdownIcon.style.transition = "transform 0.2s ease-in-out";
    }

    // Atur tanggal minimum untuk input end date
    const endDateInput = document.getElementById("end_date");
    if (endDateInput) {
        const today = new Date();
        const minDate = new Date();
        minDate.setDate(today.getDate() + 3);
        const year = minDate.getFullYear();
        const month = String(minDate.getMonth() + 1).padStart(2, "0");
        const day = String(minDate.getDate()).padStart(2, "0");
        endDateInput.setAttribute("min", `${year}-${month}-${day}`);
    }
});

// Validasi form job posting
document.addEventListener("DOMContentLoaded", function () {
    const jobTypeContainer = document.getElementById("jobTypeContainer");
    const responsibilitiesContainer = document.getElementById(
        "responsibilitiesContainer"
    );
    const qualificationsContainer = document.getElementById(
        "qualificationsContainer"
    );
    const jobTypeValidation = document.getElementById("jobTypeValidation");
    const respQualValidation = document.getElementById("respQualValidation");
    const jobPostingForm = document.getElementById("jobPostingForm");
    const addResponsibilityBtn = document.getElementById(
        "addResponsibilityBtn"
    );
    const addQualificationBtn = document.getElementById("addQualificationBtn");

    function validateForm() {
        let isValid = true;
        let jobTypeWarnings = [];
        let respQualWarnings = [];

        const selectedJobTypes = jobTypeContainer.querySelectorAll(
            'input[type="checkbox"]:checked'
        );
        if (selectedJobTypes.length === 0) {
            jobTypeWarnings.push("Please select at least one Job Type");
            isValid = false;
        }

        const responsibilities =
            responsibilitiesContainer.querySelectorAll('input[type="text"]');
        const qualifications =
            qualificationsContainer.querySelectorAll('input[type="text"]');

        if (responsibilities.length === 0 || qualifications.length === 0) {
            respQualWarnings.push(
                "Please add at least one Responsibility and one Qualification"
            );
            isValid = false;
        } else {
            const emptyResponsibilities = Array.from(responsibilities).some(
                (input) => !input.value.trim()
            );
            const emptyQualifications = Array.from(qualifications).some(
                (input) => !input.value.trim()
            );
            if (emptyResponsibilities || emptyQualifications) {
                respQualWarnings.push(
                    "Please fill in all Responsibilities and Qualifications"
                );
                isValid = false;
            }
        }

        jobTypeValidation.innerHTML = jobTypeWarnings
            .map(
                (warning) =>
                    `<div class="text-red-500 text-sm">${warning}</div>`
            )
            .join("");
        respQualValidation.innerHTML = respQualWarnings
            .map(
                (warning) =>
                    `<div class="text-red-500 text-sm">${warning}</div>`
            )
            .join("");

        return isValid;
    }

    jobTypeContainer.addEventListener("click", validateForm);
    responsibilitiesContainer.addEventListener("input", validateForm);
    qualificationsContainer.addEventListener("input", validateForm);

    jobPostingForm.addEventListener("submit", function (e) {
        if (!validateForm()) {
            e.preventDefault();
            jobTypeValidation.scrollIntoView({
                behavior: "smooth",
            });
        }
    });

    addResponsibilityBtn.addEventListener("click", () =>
        setTimeout(validateForm, 0)
    );
    addQualificationBtn.addEventListener("click", () =>
        setTimeout(validateForm, 0)
    );

    responsibilitiesContainer.addEventListener("click", function (e) {
        if (e.target.tagName === "BUTTON") {
            setTimeout(validateForm, 0);
        }
    });

    qualificationsContainer.addEventListener("click", function (e) {
        if (e.target.tagName === "BUTTON") {
            setTimeout(validateForm, 0);
        }
    });
});

// Format input salary (tetap dipertahankan)
const salaryInput = document.getElementById("salary");
if (salaryInput) {
    salaryInput.addEventListener("input", function (e) {
        let numericValue = this.value.replace(/\D/g, "");
        if (numericValue) {
            let formattedValue = new Intl.NumberFormat("id-ID").format(
                numericValue
            );
            this.value = formattedValue;
        } else {
            this.value = "";
        }
    });
}

// Penanganan pin job (jika diperlukan)
document.querySelectorAll(".pin-job").forEach(function (element) {
    element.addEventListener("click", function (event) {
        event.preventDefault();

        const jobId = this.getAttribute("data-job-id");
        const heartContainer = this;
        const icon = this.querySelector("i");
        const url = "jobs/" + jobId + "/pin";
        console.log(url);

        // Ambil CSRF token dari meta tag
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken, // Gunakan token dari meta tag
            },
            body: JSON.stringify({
                job_id: jobId,
            }),
        })
            .then((response) => {
                // Cek apakah respons OK sebelum parsing JSON
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                console.log("Toggle pin response:", data);
                if (data.status === "success") {
                    icon.classList.remove("fa-regular");
                    icon.classList.add("fa-solid");
                    heartContainer.classList.remove(
                        "text-gray-300",
                        "hover:bg-gray-50"
                    );
                    heartContainer.classList.add("text-red-500");
                } else if (data.status === "removed") {
                    icon.classList.remove("fa-solid");
                    icon.classList.add("fa-regular");
                    heartContainer.classList.remove("text-red-500");
                    heartContainer.classList.add(
                        "text-gray-300",
                        "hover:bg-gray-50"
                    );
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
});
