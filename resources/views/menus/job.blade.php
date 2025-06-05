@extends('layouts.app')

@section('content')
    <style>
        .filter-checkbox:checked+div {
            @apply bg-blue-100 border-blue-500;
        }
    </style>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-4 mt-4 bg-white rounded-lg sm:p-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex">
                            <h2 id="jobListingsBtn"
                                class="relative mr-10 text-2xl font-bold text-gray-500 cursor-pointer hover:text-blue-500 group">
                                Job Listings
                                <span
                                    class="absolute bottom-0 left-0 w-0 h-[2px] bg-blue-500 transition-all duration-300 ease-in-out group-hover:w-full"></span>
                            </h2>
                            <h2 id="likedJobsBtn"
                                class="relative text-2xl font-bold text-gray-500 cursor-pointer hover:text-blue-500 group">
                                Liked Jobs
                                <span
                                    class="absolute bottom-0 left-0 w-0 h-[2px] bg-blue-500 transition-all duration-300 ease-in-out group-hover:w-full"></span>
                            </h2>
                        </div>
                    </div>
                </div>
                <button id="openModal"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors duration-150 bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="mr-2 fas fa-plus"></i>
                    Post a Job
                </button>
            </div>

            <!-- Modal untuk Post a Job (tidak berubah) -->
            <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-[50] items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-4xl mx-4 relative h-[90vh] flex flex-col">
                    <h2 class="mb-6 text-3xl font-bold text-gray-800">Post a Job</h2>
                    <div class="flex-grow overflow-y-auto">
                        <form id="jobPostingForm" method="POST" action="{{ route('jobs.store') }}"
                            class="max-w-4xl p-8 mx-auto bg-white rounded-lg shadow-lg">
                            @csrf
                            <div class="space-y-8">
                                <div>
                                    <h2 class="mb-4 text-xl font-semibold text-gray-800">Job Details</h2>
                                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="jobTitle" class="block mb-1 text-sm font-medium text-gray-700">Job
                                                Title <span class="text-red-700">*</span></label>
                                            <input type="text" id="jobTitle" name="jobTitle"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label for="companyName"
                                                class="block mb-1 text-sm font-medium text-gray-700">Company Name <span
                                                    class="text-red-700">*</span></label>
                                            <input type="text" id="companyName" name="companyName"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label for="location"
                                                class="block mb-1 text-sm font-medium text-gray-700">Location <span
                                                    class="text-red-700">*</span></label>
                                            <input type="text" id="location" name="location"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label for="companyEmail"
                                                class="block mb-1 text-sm font-medium text-gray-700">Company Email <span
                                                    class="text-red-700">*</span></label>
                                            <input type="email" id="companyEmail" name="companyEmail"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="mb-4 text-xl font-semibold text-gray-800">Job Specifics</h2>
                                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                        <div>
                                            <label for="salary"
                                                class="block mb-1 text-sm font-medium text-gray-700">Salary <span
                                                    class="text-red-700">*</span></label>
                                            <input type="text" id="salary" name="salary"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                        <div>
                                            <label for="end_date" class="block mb-1 text-sm font-medium text-gray-700">End
                                                Date <span class="text-red-700">*</span></label>
                                            <input type="date" id="end_date" name="end_date"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="mb-4 text-xl font-semibold text-gray-800">Job Type and Experience</h2>
                                    <div id="jobTypeValidation" class="mb-4 space-y-2"></div>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-700">Job Type <span
                                                    class="text-red-700">*</span></label>
                                            <div id="jobTypeContainer" class="flex flex-wrap gap-2">
                                                <div class="p-2 transition-colors duration-150 border border-gray-300 cursor-pointer w-max rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Full Time"
                                                        class="hidden">
                                                    <span>Full time</span>
                                                </div>
                                                <div class="p-2 transition-colors duration-150 border border-gray-300 cursor-pointer w-max rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Part Time"
                                                        class="hidden">
                                                    <span>Part time</span>
                                                </div>
                                                <div class="p-2 transition-colors duration-150 border border-gray-300 cursor-pointer w-max rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Internship"
                                                        class="hidden">
                                                    <span>Internship</span>
                                                </div>
                                                <div class="p-2 transition-colors duration-150 border border-gray-300 cursor-pointer w-max rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Project Work"
                                                        class="hidden">
                                                    <span>Project work</span>
                                                </div>
                                                <div class="p-2 transition-colors duration-150 border border-gray-300 cursor-pointer w-max rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Volunteering"
                                                        class="hidden">
                                                    <span>Volunteering</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-700">Experience Level
                                                <span class="text-red-700">*</span></label>
                                            <div id="experienceLevelContainer" class="flex flex-wrap gap-2">
                                                <div class="p-2 transition-colors duration-150 border border-gray-300 cursor-pointer w-max rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Entry Level"
                                                        class="hidden">
                                                    <span>Entry Level</span>
                                                </div>
                                                <div class="p-2 transition-colors duration-150 border border-gray-300 cursor-pointer w-max rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500"
                                                    data-id="">
                                                    <input type="checkbox" name="jobType[]" value="Intermediate"
                                                        class="hidden">
                                                    <span>Intermediate</span>
                                                </div>
                                                <div class="p-2 transition-colors duration-150 border border-gray-300 cursor-pointer w-max rounded-xl job-type-item hover:bg-blue-50 hover:border-blue-500"
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
                                    <h2 class="mb-4 text-xl font-semibold text-gray-800">Job Description</h2>
                                    <div>
                                        <label for="description"
                                            class="block mb-1 text-sm font-medium text-gray-700">Description <span
                                                class="text-red-700">*</span></label>
                                        <textarea id="description" name="description" rows="4"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required></textarea>
                                    </div>
                                </div>

                                <div>
                                    <h2 class="mb-4 text-xl font-semibold text-gray-800">Qualifications and
                                        Responsibilities</h2>
                                    <div id="respQualValidation" class="mb-4 space-y-2"></div>
                                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-700">Qualifications
                                                <span class="text-red-700">*</span></label>
                                            <div id="qualificationsContainer" class="space-y-2"></div>
                                            <button type="button" id="addQualificationBtn"
                                                class="px-4 py-2 mt-2 text-blue-700 transition-colors duration-150 bg-blue-100 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Add Qualification
                                            </button>
                                        </div>
                                        <div>
                                            <label class="block mb-2 text-sm font-medium text-gray-700">Responsibilities
                                                <span class="text-red-700">*</span></label>
                                            <div id="responsibilitiesContainer" class="space-y-2"></div>
                                            <button type="button" id="addResponsibilityBtn"
                                                class="px-4 py-2 mt-2 text-blue-700 transition-colors duration-150 bg-blue-100 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Add Responsibility
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end mt-8 space-x-3">
                                    <button type="button" id="backButton"
                                        class="px-6 py-2 text-gray-700 transition-colors duration-150 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                        Back
                                    </button>
                                    <button type="submit" id="postButton"
                                        class="px-6 py-2 text-white transition-colors duration-150 bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        Post Job
                                    </button>
                                </div>
                                <div id="validationWarnings" class="mb-4 space-y-2"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Search Form -->
            <div class="flex items-center mb-6">
                <form id="searchForm" action="{{ route('job.view') }}" method="GET" class="flex-grow mb-6 mr-2"
                    onsubmit="return false;">
                    <div class="relative -z-4">
                        <input type="text" name="search" id="searchInput" placeholder="Search for jobs..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button type="submit"
                            class="absolute top-0 bottom-0 right-0 px-4 py-2 text-white bg-blue-500 rounded-r-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Filter dan Job List -->
            <div class="flex flex-col gap-6 lg:flex-row">
                <div class="flex-shrink-0 w-full lg:w-64">
                    <div class="flex items-center justify-between mb-4 lg:hidden">
                        <button class="flex items-center space-x-1 text-sm text-gray-700 transition-all duration-200"
                            onclick="toggleDropdown(event)">
                            <h3 class="font-semibold">Filter Jobs</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-transform duration-200"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>

                    @php
                        $jobTypes = ['Full Time', 'Part Time', 'Internship', 'Project Work', 'Volunteering'];
                        $jobLevels = ['Entry Level', 'Intermediate', 'Expert'];
                    @endphp

                    <div id="jobTypeDropdown" class="hidden space-y-3 transition-all duration-200 md:block">
                        <div class="flex items-center justify-between space-x-2">
                            <h3 class="font-semibold">Job Type</h3>
                            <a href="{{ route('job.view') }}" class="text-sm text-blue-500 lg:block">Clear all</a>
                        </div>
                        <div class="space-y-2">
                            @foreach ($jobTypes as $jobType)
                                <label
                                    class="flex items-center px-3 mb-1 space-x-2 transition duration-200 rounded-md hover:bg-gray-100">
                                    <input type="checkbox" name="jobType[]" value="{{ $jobType }}"
                                        {{ in_array($jobType, (array) request('jobType', [])) ? 'checked' : '' }}
                                        class="text-blue-500 rounded filter-checkbox">
                                    <div class="flex justify-between w-full space-x-4 cursor-pointer">
                                        <span>{{ $jobType }}</span>
                                        <span>{{ $jobTypeCounts[$jobType] ?? 0 }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-between space-x-2">
                            <h3 class="font-semibold">Experience Level</h3>
                        </div>
                        @foreach ($jobLevels as $jobLevel)
                            <label
                                class="flex items-center px-3 mb-1 space-x-2 transition duration-200 rounded-md hover:bg-gray-100">
                                <input type="checkbox" name="experienceLevel[]" value="{{ $jobLevel }}"
                                    {{ in_array($jobLevel, (array) request('experienceLevel', [])) ? 'checked' : '' }}
                                    class="text-blue-500 rounded filter-checkbox">
                                <div class="flex justify-between w-full space-x-4">
                                    <span>{{ $jobLevel }}</span>
                                    <span>{{ $jobTypeCounts[$jobLevel] ?? 0 }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Job List -->
                <div id="jobList" class="grid flex-1 grid-cols-1 gap-4 sm:grid-cols-2">
                    @forelse ($jobs as $job)
                        <div class="relative">
                            <div class="p-4 transition-shadow border rounded-lg hover:shadow-lg job-card"
                                data-job-id="{{ $job->id }}">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex items-center justify-center w-10 h-10 overflow-hidden bg-blue-100 rounded-lg">
                                            <span class="font-bold text-blue-600">
                                                {{ strtoupper(substr($job->companies->company_name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold">{{ $job->job_title }}</h3>
                                            <p class="text-sm text-gray-600">{{ $job->companies->company_name }}</p>
                                        </div>
                                    </div>
                                    <div class="absolute top-4 right-4 pin-job cursor-pointer {{ $job->pinnedUsers->contains(auth()->id()) ? 'text-red-500' : 'text-gray-400 hover:text-gray-600' }}"
                                        data-job-id="{{ $job->id }}">
                                        <i
                                            class="{{ $job->pinnedUsers->contains(auth()->id()) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-3">
                                    @foreach (explode(',', $job->job_type) as $type)
                                        <span class="px-3 py-1 text-sm text-purple-700 bg-purple-100 rounded-full">
                                            {{ trim($type) }}
                                        </span>
                                    @endforeach
                                </div>
                                <p class="mt-3 text-sm text-gray-600 line-clamp-2">
                                    {{ $job->job_description }}
                                </p>
                                <div class="flex items-center justify-between mt-4">
                                    <span class="font-semibold">
                                        Rp {{ number_format($job->salary, 0, ',', '.') }}/month
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        Closing on {{ $job->end_date }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">No jobs found.</p>
                    @endforelse
                </div>
                <div id="pinnedjobs" class="grid flex-1 hidden grid-cols-1 gap-4 sm:grid-cols-2">
                    @forelse (auth()->user()->pinned as $job)
                        <div class="relative">
                            <div class="p-4 transition-shadow border rounded-lg hover:shadow-lg job-card"
                                data-job-id="{{ $job->id }}">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex items-center justify-center w-10 h-10 overflow-hidden bg-blue-100 rounded-lg">
                                            <span class="font-bold text-blue-600">
                                                {{ strtoupper(substr($job->companies->company_name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold">{{ $job->job_title }}</h3>
                                            <p class="text-sm text-gray-600">{{ $job->companies->company_name }}</p>
                                        </div>
                                    </div>
                                    <div class="absolute top-4 right-4 pin-job cursor-pointer {{ $job->pinnedUsers->contains(auth()->id()) ? 'text-red-500' : 'text-gray-400 hover:text-gray-600' }}"
                                        data-job-id="{{ $job->id }}">
                                        <i
                                            class="{{ $job->pinnedUsers->contains(auth()->id()) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-3">
                                    @foreach (explode(',', $job->job_type) as $type)
                                        <span class="px-3 py-1 text-sm text-purple-700 bg-purple-100 rounded-full">
                                            {{ trim($type) }}
                                        </span>
                                    @endforeach
                                </div>
                                <p class="mt-3 text-sm text-gray-600 line-clamp-2">
                                    {{ $job->job_description }}
                                </p>
                                <div class="flex items-center justify-between mt-4">
                                    <span class="font-semibold">
                                        Rp {{ number_format($job->salary, 0, ',', '.') }}/month
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        Closing on {{ $job->end_date }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">No pinned jobs found.</p>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex flex-col mt-6 md:flex-row md:items-center md:justify-between">
                <div class="mb-2 text-sm text-gray-700 md:mb-0"></div>
                <div id="paginationContainer" class="flex justify-center md:justify-end">
                    @if ($jobs->hasPages())
                        <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
                            <span class="relative z-0 inline-flex rounded-md shadow-sm rtl:flex-row-reverse">
                                @if ($jobs->onFirstPage())
                                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                        <span
                                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md"
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
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-l-md hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500"
                                        aria-label="{{ __('pagination.previous') }}">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif

                                @foreach ($jobs->links()->elements as $element)
                                    @if (is_string($element))
                                        <span aria-disabled="true">
                                            <span
                                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 bg-white border border-gray-300 cursor-default">{{ $element }}</span>
                                        </span>
                                    @endif

                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $jobs->currentPage())
                                                <span aria-current="page">
                                                    <span
                                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-base font-medium leading-5 bg-gray-200 border border-gray-300 cursor-default">{{ $page }}</span>
                                                </span>
                                            @else
                                                <a href="{{ $url }}"
                                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700"
                                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                    {{ $page }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                @if ($jobs->hasMorePages())
                                    <a href="{{ $jobs->nextPageUrl() }}" rel="next"
                                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-r-md hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500"
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
                                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium leading-5 text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md"
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

    <!-- Scripts -->
    <script src="{{ asset('assets/js/jobs.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jobListingsBtn = document.getElementById('jobListingsBtn');
            const likedJobsBtn = document.getElementById('likedJobsBtn');
            const jobList = document.getElementById('jobList');
            const pinnedjobs = document.getElementById('pinnedjobs');
            const paginationContainer = document.getElementById('paginationContainer');

            function setActiveButton(activeBtn, inactiveBtn) {
                [activeBtn, inactiveBtn].forEach(btn => {
                    btn.classList.remove('text-blue-500', 'active-tab');
                    btn.classList.add('text-gray-500');
                });

                activeBtn.classList.remove('text-gray-500');
                activeBtn.classList.add('text-blue-500', 'active-tab');
            }

            jobListingsBtn.addEventListener('click', () => {
                jobList.classList.remove('hidden');
                pinnedjobs.classList.add('hidden');
                paginationContainer.classList.remove('hidden');
                setActiveButton(jobListingsBtn, likedJobsBtn);
            });

            likedJobsBtn.addEventListener('click', () => {
                pinnedjobs.classList.remove('hidden');
                jobList.classList.add('hidden');
                paginationContainer.classList.add('hidden');
                setActiveButton(likedJobsBtn, jobListingsBtn);
            });

            setActiveButton(jobListingsBtn, likedJobsBtn);
        });
    </script>
@endsection
