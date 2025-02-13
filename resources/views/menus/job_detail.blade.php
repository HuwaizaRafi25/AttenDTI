@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 sm:px-0">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Bagian Detail Job -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $job->job_title }}</h1>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>{{ $job->companies->company_address }}</span>
                                </div>
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
                                            <div class="block px-4 py-2 hover:bg-gray-50">
                                                <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                                            </div>
                                            <div class="w-full text-left px-4 py-2 bg-white rounded shadow hover:bg-gray-50 cursor-pointer"
                                                @click="showDeleteModal = true">
                                                <i class="fas fa-trash mr-2"></i> Remove
                                            </div>
                                        </div>

                                        <div x-show="showDeleteModal"
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

                        <div class="space-y-6">
                            <section>
                                <h2 class="text-lg font-semibold mb-3">About this role</h2>
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

    <script>
        document.querySelectorAll('.ellipsis-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();
                const dropdownId = this.getAttribute('data-dropdown-target');
                const dropdown = document.getElementById(dropdownId);
                dropdown.classList.toggle('hidden');
            });
        });

        document.addEventListener('click', function(event) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
@endsection
