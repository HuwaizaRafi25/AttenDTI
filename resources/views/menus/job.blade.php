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
                        </div>
                    @empty
                        <p class="text-gray-600">No jobs found.</p>
                    @endforelse
                </div>

            </div>
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mt-6">
                <div class="text-sm text-gray-700 mb-2 md:mb-0"></div>
                <div class="flex justify-center md:justify-end">
                    @if ($jobs->hasPages())
                        <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="">
                            <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                                {{-- Previous Page Link --}}
                                @if ($jobs->onFirstPage())
                                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                        <span
                                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                                            aria-hidden="true">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </span>
                                @else
                                    <a href="{{ $jobs->previousPageUrl() }}" rel="prev"
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                                        aria-label="{{ __('pagination.previous') }}">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($jobs->links()->elements as $element)
                                    {{-- "Three Dots" Separator --}}
                                    @if (is_string($element))
                                        <span aria-disabled="true">
                                            <span
                                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                                        </span>
                                    @endif

                                    {{-- Array Of Links --}}
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $jobs->currentPage())
                                                <span aria-current="page">
                                                    <span
                                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-base font-medium text-white bg-blue-300 border border-gray-300 cursor-default leading-5">{{ $page }}</span>
                                                </span>
                                            @else
                                                <a href="{{ $url }}"
                                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                    {{ $page }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                @if ($jobs->hasMorePages())
                                    <a href="{{ $jobs->nextPageUrl() }}" rel="next"
                                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                                        aria-label="{{ __('pagination.next') }}">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @else
                                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                        <span
                                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5"
                                            aria-hidden="true">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </span>
                                @endif
                            </span>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="{{ asset('assets/js/jobs.js') }}"></script>


@endsection
