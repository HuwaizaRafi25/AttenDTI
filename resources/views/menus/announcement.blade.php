@extends('layouts.app')
@section('content')
    <div class="container pb-8">
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-semibold">Announcement</h1>
                <div class="flex items-center space-x-2">
                    <button class="px-4 py-2 text-sm border rounded-md hover:bg-gray-50">Date Range</button>
                    <button class="px-4 py-2 text-sm border rounded-md hover:bg-gray-50">Sort by</button>
                </div>
            </div>
        </div>
        <div class="flex flex-row lg:flex-row gap-6">
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-lg shadow-sm mb-6">
                    <div class="p-4">
                        <div class="flex items-start space-x-3">
                            <img src="{{ asset('assets/images/userPlaceHolder.png') }}"
                                class="w-10 h-10 rounded-full bg-gray-200" alt="User avatar">
                            <div class="flex-1">
                                <input type="text" placeholder="Create Announcement"
                                    class="w-full p-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="flex items-center justify-between mt-3">
                                    <div class="flex space-x-4">
                                        <button class="flex items-center text-sm text-gray-600 hover:text-blue-600">
                                            <i class="fas fa-image mr-2"></i>Photo
                                        </button>
                                        <button class="flex items-center text-sm text-gray-600 hover:text-blue-600">
                                            <i class="fas fa-video mr-2"></i>Video
                                        </button>
                                        <button class="flex items-center text-sm text-gray-600 hover:text-blue-600">
                                            <i class="fas fa-calendar mr-2"></i>Event
                                        </button>
                                    </div>
                                    <button
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Generate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/3">
                <div class="space-y-4 flex flex-col">
                    <div class="bg-white rounded-lg shadow-sm">
                        <div class="p-4">
                            <div class="flex items-start space-x-3">
                                <img src="{{ asset('assets/images/userPlaceHolder.png') }}"
                                    class="w-10 h-10 rounded-full bg-gray-200" alt="User avatar">
                                <div class="flex-1">
                                    <input type="text" placeholder="Create Announcement"
                                        class="w-full p-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <div class="flex items-center justify-between mt-3">
                                        <div class="flex space-x-4">
                                            <button class="flex items-center text-sm text-gray-600 hover:text-blue-600">
                                                <i class="fas fa-image mr-2"></i>Photo
                                            </button>
                                            <button class="flex items-center text-sm text-gray-600 hover:text-blue-600">
                                                <i class="fas fa-video mr-2"></i>Video
                                            </button>
                                            <button class="flex items-center text-sm text-gray-600 hover:text-blue-600">
                                                <i class="fas fa-calendar mr-2"></i>Event
                                            </button>
                                        </div>
                                        <button
                                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col gap-y-2 bg-white rounded-lg shadow-sm">
                        <div class="">
                            <div class="flex justify-between items-start">
                                <div class="flex space-x-3">
                                    <img src="{{ asset('assets/images/userPlaceHolder.png') }}"
                                        class="w-10 h-10 rounded-full bg-gray-200" alt="User avatar">
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <div class="flex-col">
                                                <h3 class="font-semibold">Mufti Hidayat</h3>
                                                <span class="text-sm text-gray-500">Project Manager | Mar 16, 09:00
                                                    pm</span>
                                            </div>
                                        </div>
                                        <span
                                            class="inline-block px-2 font-semibold text-sm border rounded-full mt-1">General</span>
                                        <p class="mt-2 font-semibold">Judul</p>
                                        <p class="text-gray-600 text-xs mt-1">Isi Info</p>
                                    </div>
                                </div>
                                <div class="flex">
                                    <button class="mr-5 text-gray-400 hover:text-gray-600">
                                        <i class="fa-solid fa-thumbtack"></i>
                                    </button>
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-300"></div>

                        <div class="flex justify-between items-center">
                            <div class="flex space-x-4">
                                <button class="text-blue-500 hover:text-blue-700 font-semibold">React</button>
                                <button class="text-blue-500 hover:text-blue-700 font-semibold">Comment</button>
                                <button class="text-blue-500 hover:text-blue-700 font-semibold">Share</button>
                            </div>
                            <button class="text-gray-500 hover:text-gray-700 font-semibold">View Full Post</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-20">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Pinned Announcement</h3>
                    <div class="h-96 overflow-y-auto">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex">
                                <img src="{{ asset('assets/images/userPlaceHolder.png') }}"
                                    class="w-7 h-7 rounded-full bg-gray-200" alt="User avatar">
                                <h3 class="text-sm font-semibold ml-3">Qin Shi Huwa</h3>
                                <div
                                    class="rounded-full w-[5vw] text-xs h-6 bg-black text-white flex items-center justify-center ml-auto">
                                    Pinned
                                </div>
                            </div>
                            <span class="inline-block font-semibold px-2 text-sm border rounded-full mt-1">General</span>
                            <p class="mt-2 font-semibold">Judul</p>
                            <p class="text-gray-600 mt-1 text-xs">Isi Info</p>
                            <div class="cursor-pointer text-gray-500 hover:text-gray-700 mt-2">View Post ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
