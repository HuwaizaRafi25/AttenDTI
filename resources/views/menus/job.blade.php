@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg mt-4 p-4 sm:p-6">
            <div class="mb-6 flex items-center">
                <form action="#" method="GET" class="flex-grow mr-2">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Search for jobs..."
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button type="submit"
                            class="absolute right-0 top-0 bottom-0 px-4 py-2 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <button
                    class="p-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    <i class="fas fa-filter"></i>
                </button>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">
                <div class="w-full lg:w-64 flex-shrink-0">
                    <div class="flex justify-between items-center mb-4 lg:mb-0">
                        <div class="flex flex-row">
                            <h3 class="font-semibold">Job Type</h3>
                            <button class="text-gray-700 text-sm lg:hidden flex items-center space-x-1"
                                onclick="toggleDropdown()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
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
                                <span>$50k</span>
                                <span>$120k</span>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function toggleDropdown() {
                        const dropdown = document.getElementById('jobTypeDropdown');
                        dropdown.classList.toggle('hidden');
                    }
                </script>


                <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="/job_detail">
                        <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg"></div>
                                    <div>
                                        <h3 class="font-semibold">kerjaan</h3>
                                        <p class="text-sm text-gray-600">MetaMask • 25 Applicants</p>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </div>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">Entry
                                    Level</span>
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Full-Time</span>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 line-clamp-2">deskripsi gawean...</p>
                            <div class="flex justify-between items-center mt-4">
                                <span class="font-semibold">$250/hr</span>
                                <span class="text-sm text-gray-500">Posted 12 days ago</span>
                            </div>
                        </div>
                    </a>
                    <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg"></div>
                                <div>
                                    <h3 class="font-semibold">kerjaan</h3>
                                    <p class="text-sm text-gray-600">MetaMask • 25 Applicants</p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">Entry Level</span>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Full-Time</span>
                        </div>
                        <p class="mt-3 text-sm text-gray-600 line-clamp-2">deskripsi gawean...</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="font-semibold">$250/hr</span>
                            <span class="text-sm text-gray-500">Posted 12 days ago</span>
                        </div>
                    </div>
                    <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg"></div>
                                <div>
                                    <h3 class="font-semibold">kerjaan</h3>
                                    <p class="text-sm text-gray-600">MetaMask • 25 Applicants</p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">Entry Level</span>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Full-Time</span>
                        </div>
                        <p class="mt-3 text-sm text-gray-600 line-clamp-2">deskripsi gawean...</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="font-semibold">$250/hr</span>
                            <span class="text-sm text-gray-500">Posted 12 days ago</span>
                        </div>
                    </div>
                    <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg"></div>
                                <div>
                                    <h3 class="font-semibold">kerjaan</h3>
                                    <p class="text-sm text-gray-600">MetaMask • 25 Applicants</p>
                                </div>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">Entry Level</span>
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Full-Time</span>
                        </div>
                        <p class="mt-3 text-sm text-gray-600 line-clamp-2">deskripsi gawean...</p>
                        <div class="flex justify-between items-center mt-4">
                            <span class="font-semibold">$250/hr</span>
                            <span class="text-sm text-gray-500">Posted 12 days ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
