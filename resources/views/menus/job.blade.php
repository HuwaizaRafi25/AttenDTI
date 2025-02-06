@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg mt-4 p-4 sm:p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Job Listings</h2>
                <button id="openModal"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                    <i class="fas fa-plus mr-2"></i>
                    Post a Job
                </button>
            </div>

            <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-[50] items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-4xl mx-4 relative h-[90vh] flex flex-col">
                    <h2 class="text-2xl font-bold mb-4">Post a Job</h2>
                    <div class="overflow-y-auto flex-grow">
                        <form id="jobPostingForm" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="jobTitle" class="block text-sm font-medium text-gray-700">Job Title</label>
                                    <input type="text" id="jobTitle" name="jobTitle"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        required>
                                </div>
                                <div>
                                    <label for="companyName" class="block text-sm font-medium text-gray-700">Company
                                        Name</label>
                                    <input type="text" id="companyName" name="companyName"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        required>
                                </div>
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                    <input type="text" id="location" name="location"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        required>
                                </div>
                                <div>
                                    <label for="companyEmail" class="block text-sm font-medium text-gray-700">Company
                                        Email</label>
                                    <input type="email" id="companyEmail" name="companyEmail"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        required>
                                </div>
                                <div>
                                    <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                                    <input type="text" id="salary" name="salary"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Job Type</label>
                                    <div id="jobTypeContainer" class="flex flex-wrap gap-2">
                                        @foreach ($jobTypes as $jobType)
                                            <div class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item"
                                                data-id="{{ $jobType->id }}">
                                                {{ $jobType->job_type_name }}
                                            </div>
                                        @endforeach
                                        <div id="addJobTypeBtn"
                                            class="w-max p-2 cursor-pointer border border-blue-500 text-blue-500 rounded-xl hover:bg-blue-50 transition-colors duration-150">
                                            + Job Type
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" name="description" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    required></textarea>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Qualifications</label>
                                    <div id="qualificationsContainer"></div>
                                    <button type="button" id="addQualificationBtn"
                                        class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-colors duration-150">
                                        Add Qualification
                                    </button>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Responsibilities</label>
                                    <div id="responsibilitiesContainer"></div>
                                    <button type="button" id="addResponsibilityBtn"
                                        class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-colors duration-150">
                                        Add Responsibility
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mt-6 flex justify-end space-x-2">
                        <button id="backButton"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-150">
                            Back
                        </button>
                        <button id="postButton"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-150">
                            Post
                        </button>
                    </div>
                </div>
            </div>

            <div id="addJobTypeModal"
                class="fixed inset-0 bg-gray-600 bg-opacity-50 z-[60] items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4 relative">
                    <form id="addJobTypeForm">
                        <h3 class="text-xl font-bold mb-4">Add New Job Type</h3>
                        <input type="text" id="newJobType" name="job_type_name"
                            class="w-full px-3 py-2 border rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            placeholder="Enter new job type">
                        <div class="mt-4 flex justify-end space-x-2">
                            <button type="button" id="cancelAddJobType"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-150">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-150">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mb-6 flex items-center">
                <form action="#" method="GET" class="flex-grow mr-2">
                    <div class="relative -z-4">
                        <input type="text" name="search" placeholder="Search for jobs..."
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
                    <div class="flex justify-between items-center mb-4 lg:mb-0">
                        <div class="flex flex-row">
                            <h3 class="font-semibold">Job Type</h3>
                            <button class="text-gray-700 text-sm lg:hidden flex items-center space-x-1"
                                onclick="toggleDropdown()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                        <a href="#" class="text-blue-500 text-sm lg:block">Clear all</a>
                    </div>

                    <div id="jobTypeDropdown" class="hidden lg:block space-y-3">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="rounded text-blue-500">
                            <span>Full time</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="rounded text-blue-500">
                            <span>Part time</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="rounded text-blue-500">
                            <span>Internship</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="rounded text-blue-500">
                            <span>Project work</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="rounded text-blue-500">
                            <span>Volunteering</span>
                        </label>
                        <div class="mt-8">
                            <h3 class="font-semibold mb-4">Salary Range</h3>
                            <input type="range" class="w-full" min="50000" max="120000">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Rp.0,00</span>
                                <span>Rp.50.000.000,00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($jobs as $job)
                        <a href="{{ route('job.detail', $job->id) }}">
                            <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg">
                                            <!-- untuk img -->
                                        </div>
                                        <div>
                                            <h3 class="font-semibold">{{ $job->job_title }}</h3>
                                            <p class="text-sm text-gray-600">{{ $job->company_name }}</p>
                                        </div>
                                    </div>
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-3">
                                    @foreach ($job->jobTypes as $jobType)
                                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">
                                            {{ $jobType->job_type_name }}
                                        </span>
                                    @endforeach
                                </div>
                                <p class="mt-3 text-sm text-gray-600 line-clamp-2">
                                    {{ \Illuminate\Support\Str::limit($job->job_description, 100) }}
                                </p>
                                <div class="flex justify-between items-center mt-4">
                                    <span class="font-semibold">Rp {{ $job->salary }}/month</span>
                                    <span class="text-sm text-gray-500">Posted
                                        {{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addJobTypeForm').on('submit', function(e) {
                e.preventDefault();
                const newJobType = $('#newJobType').val();
                $.ajax({
                    url: '{{ route('job-types.store') }}',
                    type: 'POST',
                    data: {
                        job_type_name: newJobType,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#addJobTypeModal').addClass('hidden').removeClass('flex');
                        $('#addJobTypeBtn').before(
                            `<div class="w-max p-2 cursor-pointer border border-gray-300 rounded-xl job-type-item" data-id="${response.data.id}">
                        ${response.data.job_type_name}
                    </div>`
                        );
                        $('#newJobType').val('');
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        if (errors && errors.job_type_name) {
                        } else {
                        }
                    }
                });
            });

            $('#cancelAddJobType').on('click', function() {
                $('#addJobTypeModal').addClass('hidden').removeClass('flex');
                $('#newJobType').val('');
            });

            $('#addJobTypeBtn').on('click', function() {
                $('#addJobTypeModal').removeClass('hidden').addClass('flex');
            });

            $('#jobTypeContainer').on('click', '.job-type-item', function() {
                $(this).toggleClass('border-blue-500 bg-blue-50 selected');
            });

            const modal = document.getElementById('modal');
            const openModalButton = document.getElementById('openModal');
            const closeModalButton = document.getElementById('backButton');

            openModalButton.addEventListener('click', () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });

            closeModalButton.addEventListener('click', () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });

            function addInput(container, placeholder) {
                const inputDiv = document.createElement('div');
                inputDiv.classList.add('mb-2', 'flex', 'items-center', 'space-x-2');
                const input = document.createElement('input');
                input.type = 'text';
                input.placeholder = placeholder;
                input.required = true;
                input.classList.add(
                    'flex-grow', 'mt-1', 'block', 'w-full', 'rounded-md', 'border-gray-300', 'shadow-sm',
                    'focus:border-blue-300', 'focus:ring', 'focus:ring-blue-200', 'focus:ring-opacity-50'
                );
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.textContent = 'X';
                removeBtn.classList.add(
                    'px-2', 'py-1', 'text-red-500', 'rounded',
                    'hover:bg-red-600', 'hover:text-white', 'focus:outline-none', 'focus:ring-2',
                    'focus:ring-red-400',
                    'transition-colors', 'duration-150'
                );
                removeBtn.addEventListener('click', () => inputDiv.remove());
                inputDiv.appendChild(input);
                inputDiv.appendChild(removeBtn);
                container.appendChild(inputDiv);
            }

            const qualificationsContainer = document.getElementById('qualificationsContainer');
            const responsibilitiesContainer = document.getElementById('responsibilitiesContainer');
            const addQualificationBtn = document.getElementById('addQualificationBtn');
            const addResponsibilityBtn = document.getElementById('addResponsibilityBtn');

            addQualificationBtn.addEventListener('click', () => addInput(qualificationsContainer,
                'Enter qualification'));
            addResponsibilityBtn.addEventListener('click', () => addInput(responsibilitiesContainer,
                'Enter responsibility'));

            addInput(qualificationsContainer, 'Enter qualification');
            addInput(responsibilitiesContainer, 'Enter responsibility');

            $('#postButton').on('click', function(e) {
                e.preventDefault();
                const formData = {
                    jobTitle: $('#jobTitle').val(),
                    companyName: $('#companyName').val(),
                    location: $('#location').val(),
                    companyEmail: $('#companyEmail').val(),
                    salary: $('#salary').val(),
                    jobType: $('.job-type-item.selected').map(function() {
                        return $(this).data('id');
                    }).get(),
                    description: $('#description').val(),
                    qualification: $('#qualificationsContainer input').map(function() {
                        return $(this).val();
                    }).get(),
                    responsibility: $('#responsibilitiesContainer input').map(function() {
                        return $(this).val();
                    }).get(),
                    _token: '{{ csrf_token() }}'
                };

                $.ajax({
                    url: '{{ route('jobs.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#jobPostingForm')[0].reset();
                        $('#modal').addClass('hidden');
                        $('.job-type-item').removeClass('selected');
                    },
                    error: function(xhr) {
                    }
                });
            });
        });
    </script>
@endsection
