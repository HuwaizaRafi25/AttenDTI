@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- <div class="flex items-center mb-8">
            <a href="/job">
                <h1><i class="fa-solid fa-arrow-left"></i></h1>
            </a>
            <h1 class="text-2xl font-bold text-gray-900 ml-6">Job Details</h1>
        </div> -->
        <div class="px-4 sm:px-0">
            <div class="flex flex-col lg:flex-row gap-6">
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">UI/UX Designer</h1>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>Yogyakarta, Indonesia</span>
                                </div>
                            </div>
                            <div class="mt-4 sm:mt-0 flex space-x-3">
                                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                    Apply Now
                                </button>
                                <button class="border border-gray-300 p-2 rounded-lg hover:bg-gray-50">
                                    <i class="far fa-bookmark"></i>
                                </button>
                                <button class="border border-gray-300 p-2 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Fulltime</span>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Remote</span>
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">2-4 Years</span>
                        </div>

                        <div class="space-y-6">
                            <section>
                                <h2 class="text-lg font-semibold mb-3">About this role</h2>
                                <p class="text-gray-600">
                                    As an UI/UX Designer on Pixelz Studio, you'll focus on design user-friendly on
                                    several platform (web, mobile, dashboard, etc) to our users needs. Your innovative
                                    solution will enhance the user experience on several platforms. Join us and let's
                                    making impact on user engagement at Pixelz Studio.
                                </p>
                            </section>

                            <section>
                                <h2 class="text-lg font-semibold mb-3">Qualification</h2>
                                <ul class="list-disc pl-5 text-gray-600 space-y-2">
                                    <li>At least 2-4 years of relevant experience in product design or related roles.
                                    </li>
                                    <li>Knowledge of design validation, either through quantitative or qualitative
                                        research.</li>
                                    <li>Have good knowledge using Figma and Figjam</li>
                                    <li>Experience with analytics tools to gather data from users.</li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-lg font-semibold mb-3">Responsibility</h2>
                                <ul class="list-disc pl-5 text-gray-600 space-y-2">
                                    <li>Create design and user journey on every features and product/business units
                                        across multiples devices (Web+App)</li>
                                    <li>Identifying design problems through user journey and devising elegant solutions
                                    </li>
                                    <li>Develop low and hi fidelity designs, user experience flow, & prototype,
                                        translate it into highly-polished visual composites following style and brand
                                        guidelines.</li>
                                    <li>Brainstorm and works together with Design Lead, UX Engineers, and PMs to execute
                                        a design sprint on specific story or task</li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-lg font-semibold mb-3">Attachment</h2>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="border rounded-lg p-4 flex items-center space-x-3">
                                        <div class="bg-blue-100 p-3 rounded-lg">
                                            <i class="fas fa-file-pdf text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium">Jobs Requirements</p>
                                            <p class="text-sm text-gray-500">PDF • 2.4MB</p>
                                        </div>
                                    </div>
                                    <div class="border rounded-lg p-4 flex items-center space-x-3">
                                        <div class="bg-blue-100 p-3 rounded-lg">
                                            <i class="fas fa-file-pdf text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium">Company Benefits</p>
                                            <p class="text-sm text-gray-500">PDF • 1.8MB</p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/3">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-lg font-semibold mb-4">Similar Jobs</h2>
                        <div class="space-y-4">
                            <div class="border rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                            <span class="text-green-600 font-bold">G</span>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold">Lead UI Designer</h3>
                                            <p class="text-sm text-gray-600">Gojek • Jakarta, Indonesia</p>
                                        </div>
                                    </div>
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class="far fa-bookmark"></i>
                                    </button>
                                </div>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Fulltime</span>
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Onsite</span>
                                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">3-5
                                        Years</span>
                                </div>
                                <div class="mt-3 text-sm text-gray-500">
                                    <span>2 days ago • 521 Applicants</span>
                                </div>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <span class="text-blue-600 font-bold">G</span>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold">Sr. UX Designer</h3>
                                            <p class="text-sm text-gray-600">GoPay • Jakarta, Indonesia</p>
                                        </div>
                                    </div>
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class="far fa-bookmark"></i>
                                    </button>
                                </div>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Fulltime</span>
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Onsite</span>
                                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">3-5
                                        Years</span>
                                </div>
                                <div class="mt-3 text-sm text-gray-500">
                                    <span>2 days ago • 210 Applicants</span>
                                </div>
                            </div>

                            <div class="border rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <span class="text-purple-600 font-bold">O</span>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold">Jr. UI Designer</h3>
                                            <p class="text-sm text-gray-600">OVO • Jakarta, Indonesia</p>
                                        </div>
                                    </div>
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class="far fa-bookmark"></i>
                                    </button>
                                </div>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Fulltime</span>
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Onsite</span>
                                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">1-3
                                        Years</span>
                                </div>
                                <div class="mt-3 text-sm text-gray-500">
                                    <span>an hour ago • 120 Applicants</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
