@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 sm:px-0">
            <div class="flex flex-col lg:flex-row gap-6">
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $job->job_title }}</h1>
                            </div>
                            <div class="mt-4 sm:mt-0 flex space-x-3">
                                <a href="mailto:{{ $job->companies->company_email }}">
                                    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                        Apply Now
                                    </button>
                                </a>
                                @php
                                    $isPinned =
                                        auth()->check() &&
                                        $job
                                            ->pinnedUsers()
                                            ->where('users.id', auth()->user()->id)
                                            ->exists();
                                @endphp

                                <button
                                    class="border border-gray-300 p-2 rounded-lg cursor-pointer {{ $isPinned ? 'text-red-500' : 'hover:bg-gray-50' }} pin-job"
                                    data-job-id="{{ $job->id }}">
                                    <i class="{{ $isPinned ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                </button>
                                @if (auth()->check() && (auth()->user()->id === $job->user_id || auth()->user()->hasRole('admin')))
                                    <div class="relative inline-block text-left" x-data="{ showDeleteModal: false }">
                                        <button
                                            class="border border-gray-300 p-2 rounded-lg hover:bg-gray-50 ellipsis-button cursor-pointer"
                                            data-dropdown-target="dropdown-{{ $job->id }}">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>

                                        <div id="dropdown-{{ $job->id }}"
                                            class="dropdown-menu hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-xl shadow-lg z-10">
                                            <div id="openModal" class="block px-4 py-2 hover:bg-gray-50">
                                                <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                                            </div>
                                            <div class="w-full text-left px-4 py-2 bg-white rounded shadow hover:bg-gray-50 cursor-pointer"
                                                @click="showDeleteModal = true">
                                                <i class="fas fa-trash mr-2"></i> Remove
                                            </div>
                                        </div>

                                        <div x-show="showDeleteModal" x-cloak
                                            class="fixed inset-0 flex items-center justify-center z-50">
                                            <div class="fixed inset-0 bg-black opacity-50"></div>
                                            <div class="bg-white rounded-lg overflow-hidden shadow-lg z-10 w-1/3">
                                                <div class="px-6 py-4">
                                                    <h5 class="text-lg font-bold">Confirm Removal</h5>
                                                    <p class="mt-2">
                                                        Are you sure you want to remove this job? This action cannot be
                                                        undone.
                                                    </p>
                                                </div>
                                                <div class="px-6 py-4 flex justify-end">
                                                    <button @click="showDeleteModal = false"
                                                        class="bg-gray-300 text-gray-700 rounded px-4 py-2 mr-2">
                                                        Cancel
                                                    </button>
                                                    <form action="{{ route('jobs.remove', $job->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="bg-red-500 text-white rounded px-4 py-2">
                                                            Remove
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach (explode(',', $job->job_type) as $type)
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                    {{ trim($type) }}
                                </span>
                            @endforeach
                        </div>

                        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-money-bill-wave text-gray-400 mr-3 text-xl"></i>
                                <span>Salary: Rp {{ number_format($job->salary, 0, ',', '.') }} per month</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-calendar-alt text-gray-400 mr-3 text-xl"></i>
                                <span>Apply before: {{ \Carbon\Carbon::parse($job->end_date)->format('d F Y') }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-3 text-xl"></i>
                                <span>{{ $job->companies->company_address }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-clock text-gray-400 mr-3 text-xl"></i>
                                <span>Posted: {{ $job->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <section>
                                <h2 class="text-lg font-semibold mb-3">Description</h2>
                                <p class="text-gray-600">
                                    {{ $job->job_description }}
                                </p>
                            </section>

                            <section>
                                <h2 class="text-lg font-semibold mb-3">Qualification</h2>
                                <ul class="list-disc pl-5 text-gray-600 space-y-2">
                                    @php
                                        $qualifications = $job->qualification ? explode(',', $job->qualification) : [];
                                    @endphp
                                    @foreach ($qualifications as $qual)
                                        <li>{{ trim($qual) }}</li>
                                    @endforeach
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-lg font-semibold mb-3">Responsibility</h2>
                                <ul class="list-disc pl-5 text-gray-600 space-y-2">
                                    @php
                                        $responsibilities = $job->responsibility
                                            ? explode(',', $job->responsibility)
                                            : [];
                                    @endphp
                                    @foreach ($responsibilities as $resp)
                                        <li>{{ trim($resp) }}</li>
                                    @endforeach
                                </ul>
                            </section>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/3">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-semibold mb-4">Similar Jobs</h2>
                        <div class="space-y-4">
                            @if ($similarJobs->count())
                                @foreach ($similarJobs as $similar)
                                    <a href="{{ route('job.detail', $similar->id) }}" class="block">
                                        <div class="border rounded-lg p-4">
                                            <div class="flex items-start justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <div
                                                        class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                                        <span class="text-green-600 font-bold">
                                                            {{ strtoupper(substr($similar->companies->company_name, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <h3 class="font-semibold">{{ $similar->job_title }}</h3>
                                                        <p class="text-sm text-gray-600">
                                                            {{ $similar->companies->company_name }} •
                                                            {{ $similar->companies->company_address }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <button class="text-gray-400 hover:text-gray-600">
                                                    <i class="fa-regular fa-heart"></i>
                                                </button>
                                            </div>
                                            <div class="mt-3 flex flex-wrap gap-2">
                                                @foreach (explode(',', $similar->job_type) as $type)
                                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                                        {{ trim($type) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                            <div class="mt-3 text-sm text-gray-500">
                                                <span>Closing on {{ $similar->end_date }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <p class="text-gray-600">No jobs found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-[50] items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-4xl mx-4 relative h-[90vh] flex flex-col">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Post a Job</h2>
            <div class="overflow-y-auto flex-grow">
                <form method="POST" action="{{ route('jobs.update', $job->id) }}"
                    class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
                    @csrf
                    @method('PUT')
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Job Details</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="jobTitle" class="block text-sm font-medium text-gray-700 mb-1">Job
                                        Title <span class="text-red-700">*</span></label>
                                    <input type="text" id="jobTitle" name="jobTitle"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        value="{{ $job->job_title }}">
                                </div>
                                <div>
                                    <label for="companyName" class="block text-sm font-medium text-gray-700 mb-1">Company
                                        Name <span class="text-red-700">*</span></label>
                                    <input type="text" id="companyName" name="companyName"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        value="{{ $job->companies->company_name }}">
                                </div>
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location
                                        <span class="text-red-700">*</span></label>
                                    <input type="text" id="location" name="location"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        value="{{ $job->companies->company_address }}">
                                </div>
                                <div>
                                    <label for="companyEmail" class="block text-sm font-medium text-gray-700 mb-1">Company
                                        Email <span class="text-red-700">*</span></label>
                                    <input type="email" id="companyEmail" name="companyEmail"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        value="{{ $job->companies->company_email }}">
                                </div>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Job Specifics </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="salary" class="block text-sm font-medium text-gray-700 mb-1">Salary
                                        <span class="text-red-700">*</span></label>
                                    <input type="text" id="salary" name="salary"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        value="{{ number_format($job->salary, 0, ',', '.') }}">
                                </div>
                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End
                                        Date <span class="text-red-700">*</span></label>
                                    <input type="date" id="end_date" name="end_date"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        value="{{ $job->end_date }}">
                                </div>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Job Type and Experience</h2>

                            <!-- Bagian Job Type -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Job Type <span class="text-red-700">*</span>
                                </label>
                                <div id="jobTypeContainer" class="flex flex-wrap gap-2">
                                    <div
                                        class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150">
                                        <input type="checkbox" name="jobType[]" value="Full Time" class="hidden">
                                        <span>Full Time</span>
                                    </div>
                                    <div
                                        class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150">
                                        <input type="checkbox" name="jobType[]" value="Part Time" class="hidden">
                                        <span>Part Time</span>
                                    </div>
                                    <div
                                        class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150">
                                        <input type="checkbox" name="jobType[]" value="Internship" class="hidden">
                                        <span>Internship</span>
                                    </div>
                                    <div
                                        class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150">
                                        <input type="checkbox" name="jobType[]" value="Project Work" class="hidden">
                                        <span>Project Work</span>
                                    </div>
                                    <div
                                        class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150">
                                        <input type="checkbox" name="jobType[]" value="Volunteering" class="hidden">
                                        <span>Volunteering</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian Experience Level -->
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Experience Level <span class="text-red-700">*</span>
                                </label>
                                <div id="experienceLevelContainer" class="flex flex-wrap gap-2">
                                    <div
                                        class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150">
                                        <input type="checkbox" name="jobType[]" value="Entry Level" class="hidden">
                                        <span>Entry Level</span>
                                    </div>
                                    <div
                                        class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150">
                                        <input type="checkbox" name="jobType[]" value="Intermediate" class="hidden">
                                        <span>Intermediate</span>
                                    </div>
                                    <div
                                        class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500 transition-colors duration-150">
                                        <input type="checkbox" name="jobType[]" value="Expert" class="hidden">
                                        <span>Expert</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Job Description</h2>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description
                                    <span class="text-red-700">*</span></label>
                                <textarea id="description" name="description" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $job->job_description }}</textarea>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Qualifications and
                                Responsibilities</h2>
                        </div>

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
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-150">
                            Update
                        </button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle dropdown pada ellipsis button
            document.querySelectorAll('.ellipsis-button').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const dropdownId = this.getAttribute('data-dropdown-target');
                    const dropdown = document.getElementById(dropdownId);
                    dropdown.classList.toggle('hidden');
                });
            });

            // Sembunyikan dropdown-menu ketika klik di luar
            document.addEventListener('click', function(event) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (!menu.classList.contains('hidden')) {
                        menu.classList.add('hidden');
                    }
                });
            });

            // Pin Job Functionality
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
                                heartContainer.classList.remove('text-gray-300',
                                    'hover:bg-gray-50');
                                heartContainer.classList.add('text-red-500');
                            } else if (data.status === 'removed') {
                                icon.classList.remove('fa-solid');
                                icon.classList.add('fa-regular');
                                heartContainer.classList.remove('text-red-500');
                                heartContainer.classList.add('text-gray-300',
                                    'hover:bg-gray-50');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });

            // Modal Logic
            const modal = document.getElementById('modal');
            const openModalBtn = document.getElementById('openModal');
            const backButton = document.getElementById('backButton');
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

            // Format Input Salary
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
            const jobPostingForm = document.getElementById('jobPostingForm');
            if (jobPostingForm && salaryInput) {
                jobPostingForm.addEventListener('submit', function(e) {
                    salaryInput.value = salaryInput.value.replace(/\./g, '');
                });
            }

            // Input Field untuk Qualifications & Responsibilities
            const qualificationsContainer = document.getElementById('qualificationsContainer');
            const responsibilitiesContainer = document.getElementById('responsibilitiesContainer');
            const addQualificationBtn = document.getElementById('addQualificationBtn');
            const addResponsibilityBtn = document.getElementById('addResponsibilityBtn');

            function createInputField(name, placeholderText, value = '') {
                const container = document.createElement('div');
                container.className = 'flex flex-col mt-2';

                const inputWrapper = document.createElement('div');
                inputWrapper.className = 'flex items-center';

                const input = document.createElement('input');
                input.type = 'text';
                input.name = `${name}[]`;
                input.placeholder = `Enter ${placeholderText}`;
                input.className =
                    'w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
                if (value) {
                    input.value = value.trim();
                }

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.innerHTML = '&times;';
                removeBtn.className =
                    'ml-2 px-3 py-1 bg-transparent text-red-500 rounded hover:bg-red-200 focus:outline-none';
                removeBtn.addEventListener('click', () => {
                    if (container.parentElement && container.parentElement.children.length > 1) {
                        container.remove();
                    } else {
                        let deleteError = container.querySelector('.delete-error');
                        if (!deleteError) {
                            deleteError = document.createElement('div');
                            deleteError.className = 'delete-error text-red-500 text-sm mt-1';
                            deleteError.innerText =
                                'The field cannot be deleted if it is the last one remaining.';
                            container.appendChild(deleteError);
                        }
                        deleteError.classList.remove('hidden');
                        setTimeout(() => {
                            deleteError.classList.add('hidden');
                        }, 3000);
                    }
                });

                inputWrapper.appendChild(input);
                inputWrapper.appendChild(removeBtn);
                container.appendChild(inputWrapper);

                const errorMsg = document.createElement('div');
                errorMsg.className = 'text-red-500 text-sm mt-1 hidden';
                errorMsg.innerText = 'The field must not be left empty.';
                container.appendChild(errorMsg);

                input.addEventListener('blur', () => {
                    if (!input.value.trim()) {
                        errorMsg.classList.remove('hidden');
                    } else {
                        errorMsg.classList.add('hidden');
                    }
                });
                input.addEventListener('input', () => {
                    if (input.value.trim()) {
                        errorMsg.classList.add('hidden');
                    }
                });

                return container;
            }

            // Populate input awal untuk Qualifications & Responsibilities
            const initialQualifications = {!! json_encode($qualifications) !!};
            const initialResponsibilities = {!! json_encode($responsibilities) !!};

            if (Array.isArray(initialQualifications) && initialQualifications.length > 0) {
                initialQualifications.forEach(q => {
                    if (q.trim() !== '') {
                        const inputField = createInputField('qualifications', 'Qualification', q);
                        qualificationsContainer.appendChild(inputField);
                    }
                });
            }

            if (Array.isArray(initialResponsibilities) && initialResponsibilities.length > 0) {
                initialResponsibilities.forEach(r => {
                    if (r.trim() !== '') {
                        const inputField = createInputField('responsibilities', 'Responsibility', r);
                        responsibilitiesContainer.appendChild(inputField);
                    }
                });
            }

            if (addQualificationBtn) {
                addQualificationBtn.addEventListener('click', () => {
                    if (qualificationsContainer.children.length < 10) {
                        const inputField = createInputField('qualifications', 'Qualification');
                        qualificationsContainer.appendChild(inputField);
                    } else {
                        alert('Maksimal 10 input Qualification telah ditambahkan.');
                    }
                });
            }

            if (addResponsibilityBtn) {
                addResponsibilityBtn.addEventListener('click', () => {
                    if (responsibilitiesContainer.children.length < 10) {
                        const inputField = createInputField('responsibilities', 'Responsibility');
                        responsibilitiesContainer.appendChild(inputField);
                    } else {
                        alert('Maksimal 10 input Responsibility telah ditambahkan.');
                    }
                });
            }

            // Logika pemilihan Job Type & Experience (design terpisah, logic sama)
            const selectedJobTypes = ({!! json_encode($selectedJobTypes ?? []) !!}).map(item => item.trim());
            const jobTypeItems = document.querySelectorAll(
                '#jobTypeContainer .job-type-item, #experienceLevelContainer .job-type-item'
            );

            jobTypeItems.forEach(item => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                if (selectedJobTypes.includes(checkbox.value.trim())) {
                    checkbox.checked = true;
                    item.classList.add('bg-blue-500', 'text-white');
                    item.classList.remove('border-gray-300', 'hover:bg-blue-50');
                }
                item.addEventListener('click', function() {
                    checkbox.checked = !checkbox.checked;
                    if (checkbox.checked) {
                        item.classList.add('bg-blue-500', 'text-white');
                        item.classList.remove('border-gray-300', 'hover:bg-blue-50');
                    } else {
                        item.classList.remove('bg-blue-500', 'text-white');
                        item.classList.add('border-gray-300', 'hover:bg-blue-50');
                    }
                });
            });
        });
    </script>

@endsection
