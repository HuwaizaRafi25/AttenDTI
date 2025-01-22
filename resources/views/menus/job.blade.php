@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg mt-4 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold">Recommended jobs</h2>
                <button class="flex items-center space-x-2 text-gray-600 bg-gray-100 px-4 py-2 rounded-lg">
                    <span>Most recent</span>
                    <i class="fas fa-chevron-down w-4 h-4 mr-2"></i>
                </button>
            </div>

            <div class="flex gap-6">
                <div class="w-64 flex-shrink-0">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold">Job Type</h3>
                        <a href="#" class="text-blue-500 text-sm">Clear all</a>
                    </div>
                    <div class="space-y-3">
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
                    </div>

                    <div class="mt-8">
                        <h3 class="font-semibold mb-4">Salary Range</h3>
                        <input type="range" class="w-full" min="50000" max="120000">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>$50k</span>
                            <span>$120k</span>
                        </div>
                    </div>
                </div>

                <div class="flex-1 grid grid-cols-2 gap-4">
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
                            <div class="flex gap-2 mt-3">
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
                        <div class="flex gap-2 mt-3">
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
                        <div class="flex gap-2 mt-3">
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
                        <div class="flex gap-2 mt-3">
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
                </div>
            </div>
        </div>
    </div>
@endsection
