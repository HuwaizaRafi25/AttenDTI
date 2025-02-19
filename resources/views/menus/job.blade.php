@extends('layouts.app')

@section('content')

    <style>
        .filter-checkbox:checked+div {
            @apply bg-blue-100 border-blue-500;
        }
    </style>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg mt-4 p-4 sm:p-6">
            <div class="flex justify-between items-center mb-6">
                <div class="flex">
                    <h2 class="text-2xl font-bold text-gray-900 mr-10 cursor-pointer">Job Listings</h2>
                    <!-- <h2 class="text-2xl font-bold text-gray-900 cursor-pointer">Liked Jobs</h2> -->
                </div>
                <button id="openModal"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                    <i class="fas fa-plus mr-2"></i>
                    Post a Job
                </button>
            </div>

            <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-[50] items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-4xl mx-4 relative h-[90vh] flex flex-col">
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">Post a Job</h2>
                    <div class="overflow-y-auto flex-grow">
                        <form id="jobPostingForm" method="POST" action="{{ route('jobs.store') }}"
                            class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
                            @csrf
                            <div class="space-y-8">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Job Details</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="jobTitle" class="block text-sm font-medium text-gray-700 mb-1">Job
                                                Title <span class="text-red-700">*</span></label>
                                            <input type="text" id="jobTitle" name="jobTitle"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label for="companyName"
                                                class="block text-sm font-medium text-gray-700 mb-1">Company Name <span
                                                    class="text-red-700">*</span></label>
                                            <input type="text" id="companyName" name="companyName"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label for="location"
                                                class="block text-sm font-medium text-gray-700 mb-1">Location <span
                                                    class="text-red-700">*</span></label>
                                            <input type="text" id="location" name="location"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label for="companyEmail"
                                                class="block text-sm font-medium text-gray-700 mb-1">Company Email <span
                                                    class="text-red-700">*</span></label>
                                            <input type="email" id="companyEmail" name="companyEmail"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Job Specifics </h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="salary"
                                                class="block text-sm font-medium text-gray-700 mb-1">Salary <span
                                                    class="text-red-700">*</span></label>
                                            <input type="text" id="salary" name="salary"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End
                                                Date <span class="text-red-700">*</span></label>
                                            <input type="date" id="end_date" name="end_date"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Job Type and Experience</h2>
                                    <div id="jobTypeValidation" class="space-y-2 mb-4"></div>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Job Type <span
                                                    class="text-red-700">*</span></label>
                                            <div id="jobTypeContainer" class="flex flex-wrap gap-2">
                                                <div class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Full Time"
                                                        class="hidden">
                                                    <span>Full time</span>
                                                </div>
                                                <div class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Part Time"
                                                        class="hidden">
                                                    <span>Part time</span>
                                                </div>
                                                <div class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Internship"
                                                        class="hidden">
                                                    <span>Internship</span>
                                                </div>
                                                <div class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Project Work"
                                                        class="hidden">
                                                    <span>Project work</span>
                                                </div>
                                                <div class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Volunteering"
                                                        class="hidden">
                                                    <span>Volunteering</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Experience
                                                Level <span class="text-red-700">*</span></label>
                                            <div id="experienceLevelContainer" class="flex flex-wrap gap-2">
                                                <div class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Entry Level"
                                                        class="hidden">
                                                    <span>Entry Level</span>
                                                </div>
                                                <div class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Intermediate"
                                                        class="hidden">
                                                    <span>Intermediate</span>
                                                </div>
                                                <div class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Expert"
                                                        class="hidden">
                                                    <span>Expert</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Job Description</h2>
                                    <div>
                                        <label for="description"
                                            class="block text-sm font-medium text-gray-700 mb-1">Description <span
                                                class="text-red-700">*</span></label>
                                        <textarea id="description" name="description" rows="4"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required></textarea>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Qualifications and
                                        Responsibilities</h2>
                                    <div id="respQualValidation" class="space-y-2 mb-4"></div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Qualifications
                                                <span class="text-red-700">*</span></label>
                                            <div id="qualificationsContainer" class="space-y-2"></div>
                                            <button type="button" id="addQualificationBtn"
                                                class="mt-2 px-4 py-2 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-150">
                                                Add Qualification
                                            </button>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Responsibilities
                                                <span class="text-red-700">*</span></label>
                                            <div id="responsibilitiesContainer" class="space-y-2"></div>
                                            <button type="button" id="addResponsibilityBtn"
                                                class="mt-2 px-4 py-2 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-150">
                                                Add Responsibility
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end space-x-3 mt-8">
                                    <button type="button" id="backButton"
                                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-150">
                                        Back
                                    </button>
                                    <button type="submit" id="postButton"
                                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-150">
                                        Post Job
                                    </button>
                                </div>
                                <div id="validationWarnings" class="space-y-2 mb-4"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mb-6 flex items-center">
                <form id="searchForm" action="{{ route('job.view') }}" method="GET" class="flex-grow mr-2 mb-6"
                    onsubmit="return false;">
                    <div class="relative -z-4">
                        <input type="text" name="search" id="searchInput" placeholder="Search for jobs..."
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button type="submit"
                            class="absolute right-0 top-0 bottom-0 px-4 py-2 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">
                <div class="w-full lg:w-64 flex-shrink-0">
                    <div class="flex justify-between items-center mb-4 lg:hidden">
                        <button class="text-gray-700 text-sm flex items-center space-x-1 transition-all duration-200"
                            onclick="toggleDropdown(event)">
                            <h3 class="font-semibold">Filter Jobs</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-200"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                    </div>

                    @php
                        // Daftar job types (kategori utama)
                        $jobTypes = ['Full Time', 'Part Time', 'Internship', 'Project Work', 'Volunteering'];

                        // Daftar experience levels (tingkatan pengalaman)
                        $jobLevels = ['Entry Level', 'Intermediate', 'Expert'];
                    @endphp

                    <!-- Di dalam bagian filter -->
                    <div id="jobTypeDropdown" class="hidden md:block space-y-3 transition-all duration-200">
                        <div class="flex items-center space-x-2 justify-between">
                            <h3 class="font-semibold">Job Type</h3>
                            <a href="{{ route('job.view') }}" class="text-blue-500 text-sm lg:block">Clear all</a>
                        </div>
                        <div class="space-y-2">
                            @foreach ($jobTypes as $jobType)
                                <label class="flex items-center space-x-2 mb-1">
                                    <input type="checkbox" name="jobType[]" value="{{ $jobType }}"
                                        {{ in_array($jobType, (array) request('jobType', [])) ? 'checked' : '' }}
                                        class="rounded text-blue-500 filter-checkbox">
                                    <div class="flex space-x-4 w-full justify-between">
                                        <span>{{ $jobType }}</span>
                                        <span>{{ $jobTypeCounts[$jobType] ?? 0 }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div class="flex items-center space-x-2 justify-between">
                            <h3 class="font-semibold">Experience Level</h3>
                        </div>
                        @foreach ($jobLevels as $jobLevel)
                            <label class="flex items-center space-x-2 mb-1">
                                <input type="checkbox" name="experienceLevel[]" value="{{ $jobLevel }}"
                                    {{ in_array($jobLevel, (array) request('experienceLevel', [])) ? 'checked' : '' }}
                                    class="rounded text-blue-500 filter-checkbox">
                                <div class="flex space-x-4 w-full justify-between">
                                    <span>{{ $jobLevel }}</span>
                                    <span>{{ $jobTypeCounts[$jobLevel] ?? 0 }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div id="jobList" class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse ($jobs as $job)
                        @if (!$job->active_status)
                            {{-- Jika job sudah tidak aktif, Anda bisa menampilkan label "Closed" atau bahkan melewati render --}}
                            @continue
                        @endif

                        @php
                            $isPinned =
                                auth()->check() &&
                                $job
                                    ->pinnedUsers()
                                    ->where('users.id', auth()->user()->id)
                                    ->exists();
                        @endphp
                        <div class="relative">
                            <a href="{{ route('job.detail', $job->id) }}">
                                <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 bg-blue-100 rounded-lg overflow-hidden flex items-center justify-center">
                                                <span class="text-blue-600 font-bold">
                                                    {{ strtoupper(substr($job->companies->company_name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold">{{ $job->job_title }}</h3>
                                                <p class="text-sm text-gray-600">{{ $job->companies->company_name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        @foreach (explode(',', $job->job_type) as $type)
                                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">
                                                {{ trim($type) }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <p class="mt-3 text-sm text-gray-600 line-clamp-2">
                                        {{ $job->job_description }}
                                    </p>
                                    <div class="flex justify-between items-center mt-4">
                                        <span class="font-semibold">
                                            Rp {{ number_format($job->salary, 0, ',', '.') }}/month
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            Closing on {{ $job->end_date }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <div class="absolute top-4 right-4 pin-job cursor-pointer
                {{ $isPinned ? 'text-red-500' : 'text-gray-400 hover:text-gray-600' }}"
                                data-job-id="{{ $job->id }}">
                                <i class="{{ $isPinned ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">No jobs found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        function fetchJobs() {
            const searchTerm = document.getElementById('searchInput')?.value || '';
            const selectedJobTypes = Array.from(document.querySelectorAll('input[name="jobType[]"]:checked'))
                .map(cb => cb.value);
            const selectedExperienceLevels = Array.from(document.querySelectorAll(
                    'input[name="experienceLevel[]"]:checked'))
                .map(cb => cb.value);

            const params = new URLSearchParams();
            params.append('search', searchTerm);
            selectedJobTypes.forEach(type => params.append('jobType[]', type));
            selectedExperienceLevels.forEach(level => params.append('jobType[]', level));

            // Tampilkan loading state
            const jobList = document.getElementById('jobList');
            if (jobList) {
                jobList.innerHTML = '<div class="col-span-full text-center py-4">Loading...</div>';
            }

            fetch(`${window.location.pathname}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    updateJobList(data.jobs);
                    updateURL(params);
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (jobList) {
                        jobList.innerHTML =
                            '<div class="col-span-full text-center py-4 text-red-500">Error loading jobs. Please try again.</div>';
                    }
                });
        }

        function updateJobList(jobs) {
            const jobList = document.getElementById('jobList');
            if (!jobList) return;

            if (!jobs.length) {
                jobList.innerHTML = '<div class="col-span-full text-center py-4">No jobs found.</div>';
                return;
            }

            jobList.innerHTML = jobs.map(job => {
                const companyName = job.companies?.company_name || '';
                const firstLetter = companyName.charAt(0).toUpperCase();
                const jobTypes = job.job_type?.split(',').map(type =>
                    `<span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">${type.trim()}</span>`
                ).join('') || '';

                const isPinned = job.pinned_users?.some(user => user.id === window.userId);

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
                                        <h3 class="font-semibold">${job.job_title}</h3>
                                        <p class="text-sm text-gray-600">${companyName}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-2 mt-3">
                                ${jobTypes}
                            </div>
                            <p class="mt-3 text-sm text-gray-600 line-clamp-2">${job.job_description}</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="font-semibold">
                                    Rp ${parseInt(job.salary).toLocaleString('id-ID')}/month
                                </span>
                                <span class="text-sm text-gray-500">
                                    Closing on ${job.end_date}
                                </span>
                            </div>
                        </div>
                    </a>
                    <div class="absolute top-4 right-4 pin-job cursor-pointer ${isPinned ? 'text-red-500' : 'text-gray-400 hover:text-gray-600'}"
                         data-job-id="${job.id}">
                        <i class="${isPinned ? 'fa-solid' : 'fa-regular'} fa-heart"></i>
                    </div>
                </div>
            `;
            }).join('');

            // Pasang ulang event listener untuk pin job
            attachPinJobListeners();
        }

        function attachPinJobListeners() {
            document.querySelectorAll('.pin-job').forEach(element => {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    event.stopPropagation();

                    const jobId = this.getAttribute('data-job-id');
                    const heartContainer = this;
                    const icon = this.querySelector('i');

                    fetch(`/jobs/${jobId}/pin`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                icon.classList.replace('fa-regular', 'fa-solid');
                                heartContainer.classList.remove('text-gray-400', 'hover:text-gray-600');
                                heartContainer.classList.add('text-red-500');
                            } else if (data.status === 'removed') {
                                icon.classList.replace('fa-solid', 'fa-regular');
                                heartContainer.classList.remove('text-red-500');
                                heartContainer.classList.add('text-gray-400', 'hover:text-gray-600');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        }

        function updateURL(params) {
            const newUrl = `${window.location.pathname}?${params.toString()}`;
            window.history.pushState({}, '', newUrl);
        }

        function debounce(func, wait) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        }

        // Inisialisasi event listener untuk filter dan pencarian
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', fetchJobs);
            });

            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', debounce(fetchJobs, 300));
            }

            // Lakukan fetch awal jika ada filter yang dipilih
            if (document.querySelectorAll('.filter-checkbox:checked').length > 0) {
                fetchJobs();
            }
        });


        /* === Modal, Form Input, dan Validasi (Kode Kedua) === */
        document.addEventListener('DOMContentLoaded', function() {
            // Modal dan penanganan form job posting
            const modal = document.getElementById('modal');
            const openModalBtn = document.getElementById('openModal');
            const backButton = document.getElementById('backButton');
            const addQualificationBtn = document.getElementById('addQualificationBtn');
            const addResponsibilityBtn = document.getElementById('addResponsibilityBtn');
            const qualificationsContainer = document.getElementById('qualificationsContainer');
            const responsibilitiesContainer = document.getElementById('responsibilitiesContainer');

            if (openModalBtn) {
                openModalBtn.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            }

            modal.addEventListener('click', function(e) {
                if (e.target === this || e.target === backButton) {
                    this.classList.add('hidden');
                    this.classList.remove('flex');
                }
            });

            function createInputField(name, placeholderText) {
                const container = document.createElement('div');
                container.className = 'flex items-center mt-2';

                const input = document.createElement('input');
                input.type = 'text';
                input.name = `${name}[]`;
                input.placeholder = `Enter ${placeholderText}`;
                input.className =
                    'w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.innerHTML = '&times;';
                removeBtn.className =
                    'ml-2 px-3 py-1 bg-transparent text-red-500 rounded hover:bg-red-200 focus:outline-none';
                removeBtn.addEventListener('click', () => {
                    container.remove();
                });

                container.appendChild(input);
                container.appendChild(removeBtn);

                return container;
            }

            addQualificationBtn && addQualificationBtn.addEventListener('click', () => {
                if (qualificationsContainer.children.length < 10) {
                    const inputField = createInputField('qualifications', 'Qualification');
                    qualificationsContainer.appendChild(inputField);
                } else {
                    alert('Maksimal 10 input Qualification telah ditambahkan.');
                }
            });

            addResponsibilityBtn && addResponsibilityBtn.addEventListener('click', () => {
                if (responsibilitiesContainer.children.length < 10) {
                    const inputField = createInputField('responsibilities', 'Responsibility');
                    responsibilitiesContainer.appendChild(inputField);
                } else {
                    alert('Maksimal 10 input Responsibility telah ditambahkan.');
                }
            });

            // Penanganan pemilihan job type
            document.querySelectorAll('.job-type-item').forEach(item => {
                item.addEventListener('click', function() {
                    const checkbox = this.querySelector('input[type="checkbox"]');
                    checkbox.checked = !checkbox.checked;
                    if (checkbox.checked) {
                        this.classList.add('bg-blue-500', 'text-white');
                        this.classList.remove('border-gray-300', 'hover:bg-blue-50');
                    } else {
                        this.classList.remove('bg-blue-500', 'text-white');
                        this.classList.add('border-gray-300', 'hover:bg-blue-50');
                    }
                });
            });

            // Dropdown untuk filter job type
            function toggleDropdown(e) {
                e.stopPropagation(); // Hentikan propagasi event agar tidak ditangani oleh listener dokumen
                const dropdown = document.getElementById('jobTypeDropdown');
                // Gunakan e.currentTarget untuk mendapatkan tombol yang diklik
                const button = e.currentTarget;
                const icon = button.querySelector('svg');
                if (dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('hidden');
                    dropdown.classList.add('block');
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    dropdown.classList.add('hidden');
                    dropdown.classList.remove('block');
                    icon.style.transform = 'rotate(0deg)';
                }
            }

            // Pastikan tombol dropdown menggunakan event listener daripada inline JS jika memungkinkan
            const dropdownToggleBtn = document.querySelector('button[onclick^="toggleDropdown"]');
            if (dropdownToggleBtn) {
                dropdownToggleBtn.addEventListener('click', toggleDropdown);
            }

            document.addEventListener('click', function(event) {
                const dropdown = document.getElementById('jobTypeDropdown');
                const button = document.querySelector('button[onclick^="toggleDropdown"]');
                if (button && !button.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                    dropdown.classList.remove('block');
                    const icon = button.querySelector('svg');
                    if (icon) {
                        icon.style.transform = 'rotate(0deg)';
                    }
                }
            });

            const dropdownIcon = document.querySelector('button[onclick^="toggleDropdown"] svg');
            if (dropdownIcon) {
                dropdownIcon.style.transition = 'transform 0.2s ease-in-out';
            }

            // Atur tanggal minimum untuk input end date
            const endDateInput = document.getElementById('end_date');
            if (endDateInput) {
                const today = new Date();
                const minDate = new Date();
                minDate.setDate(today.getDate() + 3);
                const year = minDate.getFullYear();
                const month = String(minDate.getMonth() + 1).padStart(2, '0');
                const day = String(minDate.getDate()).padStart(2, '0');
                endDateInput.setAttribute('min', `${year}-${month}-${day}`);
            }
        });

        // Validasi form job posting
        document.addEventListener('DOMContentLoaded', function() {
            const jobTypeContainer = document.getElementById('jobTypeContainer');
            const responsibilitiesContainer = document.getElementById('responsibilitiesContainer');
            const qualificationsContainer = document.getElementById('qualificationsContainer');
            const jobTypeValidation = document.getElementById('jobTypeValidation');
            const respQualValidation = document.getElementById('respQualValidation');
            const jobPostingForm = document.getElementById('jobPostingForm');
            const addResponsibilityBtn = document.getElementById('addResponsibilityBtn');
            const addQualificationBtn = document.getElementById('addQualificationBtn');

            function validateForm() {
                let isValid = true;
                let jobTypeWarnings = [];
                let respQualWarnings = [];

                const selectedJobTypes = jobTypeContainer.querySelectorAll('input[type="checkbox"]:checked');
                if (selectedJobTypes.length === 0) {
                    jobTypeWarnings.push('Please select at least one Job Type');
                    isValid = false;
                }

                const responsibilities = responsibilitiesContainer.querySelectorAll('input[type="text"]');
                const qualifications = qualificationsContainer.querySelectorAll('input[type="text"]');

                if (responsibilities.length === 0 || qualifications.length === 0) {
                    respQualWarnings.push('Please add at least one Responsibility and one Qualification');
                    isValid = false;
                } else {
                    const emptyResponsibilities = Array.from(responsibilities).some(input => !input.value.trim());
                    const emptyQualifications = Array.from(qualifications).some(input => !input.value.trim());
                    if (emptyResponsibilities || emptyQualifications) {
                        respQualWarnings.push('Please fill in all Responsibilities and Qualifications');
                        isValid = false;
                    }
                }

                jobTypeValidation.innerHTML = jobTypeWarnings
                    .map(warning => `<div class="text-red-500 text-sm">${warning}</div>`)
                    .join('');
                respQualValidation.innerHTML = respQualWarnings
                    .map(warning => `<div class="text-red-500 text-sm">${warning}</div>`)
                    .join('');

                return isValid;
            }

            jobTypeContainer.addEventListener('click', validateForm);
            responsibilitiesContainer.addEventListener('input', validateForm);
            qualificationsContainer.addEventListener('input', validateForm);

            jobPostingForm.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    jobTypeValidation.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });

            addResponsibilityBtn.addEventListener('click', () => setTimeout(validateForm, 0));
            addQualificationBtn.addEventListener('click', () => setTimeout(validateForm, 0));

            responsibilitiesContainer.addEventListener('click', function(e) {
                if (e.target.tagName === 'BUTTON') {
                    setTimeout(validateForm, 0);
                }
            });

            qualificationsContainer.addEventListener('click', function(e) {
                if (e.target.tagName === 'BUTTON') {
                    setTimeout(validateForm, 0);
                }
            });
        });

        // Format input salary (tetap dipertahankan)
        const salaryInput = document.getElementById('salary');
        if (salaryInput) {
            salaryInput.addEventListener('input', function(e) {
                let numericValue = this.value.replace(/\D/g, '');
                if (numericValue) {
                    let formattedValue = new Intl.NumberFormat('id-ID').format(numericValue);
                    this.value = formattedValue;
                } else {
                    this.value = '';
                }
            });
        }

        // Penanganan pin job (jika diperlukan)
        document.querySelectorAll('.pin-job').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();

                const jobId = this.getAttribute('data-job-id');
                const heartContainer = this;
                const icon = this.querySelector('i');
                const url = "{{ url('/jobs') }}/" + jobId + "/pin";

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            job_id: jobId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Toggle pin response:', data);
                        if (data.status === 'success') {
                            icon.classList.remove('fa-regular');
                            icon.classList.add('fa-solid');
                            heartContainer.classList.remove('text-gray-300', 'hover:bg-gray-50');
                            heartContainer.classList.add('text-red-500');
                        } else if (data.status === 'removed') {
                            icon.classList.remove('fa-solid');
                            icon.classList.add('fa-regular');
                            heartContainer.classList.remove('text-red-500');
                            heartContainer.classList.add('text-gray-300', 'hover:bg-gray-50');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>


@endsection
