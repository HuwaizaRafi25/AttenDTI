@extends('layouts.app')
@section('content')
    <div class="flex flex-col gap-6">
        <div class="flex flex-row space-x-6">
            <div>
                <h2 class="relative group cursor-pointer" id="taskBoardTab">
                    <span class="text-gray-800 transition-colors duration-200">Task Board</span>
                    <span
                        class="absolute -bottom-1 left-0 w-full h-0.5 bg-blue-500 origin-left transform transition-transform duration-200 scale-x-100 group-hover:scale-x-100"></span>
                </h2>
            </div>
            <div>
                <h2 class="relative group cursor-pointer" id="taskListTab">
                    <span class="text-gray-800 transition-colors duration-200">Task List</span>
                    <span
                        class="absolute -bottom-1 left-0 w-full h-0.5 bg-blue-500 origin-left transform transition-transform duration-200 scale-x-0 group-hover:scale-x-100"></span>
                </h2>
            </div>
            <div>
                <h2 class="relative group cursor-pointer" id="timeLineTab">
                    <span class="text-gray-800 transition-colors duration-200">Timeline</span>
                    <span
                        class="absolute -bottom-1 left-0 w-full h-0.5 bg-blue-500 origin-left transform transition-transform duration-200 scale-x-0 group-hover:scale-x-100"></span>
                </h2>
            </div>
        </div>
        <div class="relative overflow-x-hidden h-[100vh] w-full md:h-[468px] sm:h-screen" id="contentContainer1">
            <div class="flex w-full transition-transform duration-500" id="contentContainer">
                <div class="w-full opacity-100 translate-x-0 transition-all duration-500 ease-in-out transform"
                    id="taskBoard">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4"
                        id="taskBoardGrid">
                        <div class="flex flex-col items-start">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">To Do</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">1</div>
                            </div>
                            <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4" id="content">
                                <div class="absolute top-4 right-4">
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                                <h2 class="text-lg font-semibold mb-2">Judul</h2>
                                <p class="text-gray-500 text-sm mb-4" id="description">
                                    Ini adalah deskripsi dari konten keren
                                </p>
                                <div class="flex justify-center mb-4">
                                    <img src="{{ asset('assets/images/icons/dti_icon.png') }}" alt="DTI Icon"
                                        class="max-w-full h-auto">
                                </div>
                                <div class="flex items-center justify-start mb-4 relative h-7">
                                    <div class="w-7 h-7 bg-blue-500 rounded-full absolute left-0"></div>
                                    <div class="w-7 h-7 bg-green-500 rounded-full absolute left-5"></div>
                                    <div
                                        class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white text-sm font-semibold absolute left-10">
                                        <span>+</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-gray-500 text-xs">
                                    <div class="flex gap-x-3 items-center">
                                        <div class="flex items-center">
                                            <i class="fa-regular fa-comments mr-1"></i>
                                            <span>4</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-paperclip mr-1"></i>
                                            <span>5</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-regular fa-clock mr-1"></i>
                                        <span>17 Jan, 2025</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-start">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">In Progress</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">2</div>
                            </div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                            <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4" id="content">
                                <div class="absolute top-4 right-4">
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </div>
                                <h2 class="text-lg font-semibold mb-2">Judul</h2>
                                <p class="text-gray-500 text-sm mb-4" id="description">
                                    Ini adalah deskripsi dari konten keren
                                </p>
                                <div class="flex items-center justify-start mb-4 relative h-7">
                                    <div class="w-7 h-7 bg-blue-500 rounded-full absolute left-0"></div>
                                    <div class="w-7 h-7 bg-green-500 rounded-full absolute left-5"></div>
                                    <div
                                        class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white text-sm font-semibold absolute left-10">
                                        <span>+</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-gray-500 text-xs">
                                    <div class="flex gap-x-3 items-center">
                                        <div class="flex items-center">
                                            <i class="fa-regular fa-comments mr-1"></i>
                                            <span>4</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-solid fa-paperclip mr-1"></i>
                                            <span>5</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fa-regular fa-clock mr-1"></i>
                                        <span>17 Jan, 2025</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-start">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">In Review</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">3</div>
                            </div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                        </div>
                        <div class="flex flex-col items-start">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">Completed</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">4</div>
                            </div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                        </div>
                        <div class="flex flex-col items-start">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-gray-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">Backlog</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">5</div>
                            </div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                            <div class="w-full h-20 bg-white rounded-md mt-2 shadow-md"></div>
                        </div>
                    </div>
                </div>
                <div class="w-[99%] opacity-0 absolute translate-x-[100%] transition-all duration-500 ease-in-out transform hidden"
                    id="taskList">
                    <div class="grid grid-cols-1 gap-4 " id="taskListGrid">
                        <div class="p-6 h-auto">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-4">
                                    <input type="search" placeholder="Search..."
                                        class="w-64 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <button class="p-2 border rounded-lg hover:bg-gray-50">
                                        <i class="fa-solid fa-filter"></i>
                                    </button>
                                </div>
                                <button
                                    class="flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <i class="fa-solid fa-plus mr-2"></i>
                                    New Task
                                </button>
                            </div>

                            <div class="space-y-4">
                                <div class="w-full overflow-x-auto">
                                    <div class="min-w-max space-y-4">
                                        <!-- Section: To Do -->
                                        <div class="border rounded-lg">
                                            <div class="flex items-center justify-between p-4 bg-gray-100 rounded-t-lg cursor-pointer"
                                                id="todoDropdown">
                                                <div class="flex items-center">
                                                    <i class="fas fa-chevron-down w-4 h-4 mr-2"></i>
                                                    <h3 class="font-medium">To Do</h3>
                                                    <span
                                                        class="ml-2 px-2 py-1 text-xs font-medium bg-gray-200 rounded-full">3</span>
                                                </div>
                                            </div>

                                            <!-- Task List -->
                                            <div id="todoTasks" class="divide-y divide-gray-200">
                                                <div
                                                    class="grid grid-cols-6 gap-4 py-2 px-4 text-sm font-medium text-gray-600 bg-gray-50">
                                                    <div class="col-span-1 flex items-center justify-center">Status</div>
                                                    <div class="col-span-1 flex items-center justify-center">Task Name
                                                    </div>
                                                    <div class="col-span-2 flex items-center justify-center">Description
                                                    </div>
                                                    <div class="col-span-1 flex items-center justify-center">Estimation
                                                    </div>
                                                    <div class="col-span-1 flex items-center justify-center">Action</div>
                                                </div>

                                                <!-- Task items (repeated for each task) -->
                                                <div class="grid grid-cols-6 gap-4 py-4 px-4 items-center text-sm">
                                                    <div class="col-span-1 flex items-center justify-center">
                                                        <input type="checkbox" class="w-4 h-4">
                                                    </div>
                                                    <div class="col-span-1 font-medium truncate">Employee Details</div>
                                                    <div class="col-span-2 truncate">
                                                        Create a page where there is information about employees
                                                    </div>
                                                    <div class="col-span-1 whitespace-nowrap truncate">Feb 14, 2024 - Feb
                                                        1, 2024</div>
                                                    <div class="col-span-1 flex items-center justify-center">
                                                        <button class="text-gray-400 hover:text-gray-600">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- More task items... -->
                                            </div>
                                        </div>

                                        <!-- In Progress -->
                                        <div class="border rounded-lg">
                                            <div class="flex items-center justify-between p-4 bg-gray-100 rounded-t-lg cursor-pointer"
                                                id="inprogressDropdown">
                                                <div class="flex items-center">
                                                    <i class="fas fa-chevron-down w-4 h-4 mr-2"></i>
                                                    <h3 class="font-medium">In Progress</h3>
                                                    <span
                                                        class="ml-2 px-2 py-1 text-xs font-medium bg-gray-200 rounded-full">3</span>
                                                </div>
                                            </div>

                                            <!-- Task List -->
                                            <div id="inprogressTasks" class="divide-y divide-gray-200">
                                                <div
                                                    class="grid grid-cols-6 gap-4 py-2 px-4 text-sm font-medium text-gray-600 bg-gray-50">
                                                    <div class="col-span-1 flex items-center justify-center">Status</div>
                                                    <div class="col-span-1 flex items-center justify-center">Task Name
                                                    </div>
                                                    <div class="col-span-2 flex items-center justify-center">Description
                                                    </div>
                                                    <div class="col-span-1 flex items-center justify-center">Estimation
                                                    </div>
                                                    <div class="col-span-1 flex items-center justify-center">Action</div>
                                                </div>

                                                <!-- Task items (repeated for each task) -->
                                                <div class="grid grid-cols-6 gap-4 py-4 px-4 items-center text-sm">
                                                    <div class="col-span-1 flex items-center justify-center">
                                                        <input type="checkbox" class="w-4 h-4">
                                                    </div>
                                                    <div class="col-span-1 font-medium truncate">Employee Details</div>
                                                    <div class="col-span-2 truncate">
                                                        Create a page where there is information about employees
                                                    </div>
                                                    <div class="col-span-1 whitespace-nowrap truncate">Feb 14, 2024 - Feb
                                                        1, 2024</div>
                                                    <div class="col-span-1 flex items-center justify-center">
                                                        <button class="text-gray-400 hover:text-gray-600">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- More task items... -->
                                            </div>
                                        </div>

                                        <!-- In Review -->
                                        <div class="border rounded-lg">
                                            <div class="flex items-center justify-between p-4 bg-gray-100 rounded-t-lg cursor-pointer"
                                                id="inreviewDropdown">
                                                <div class="flex items-center">
                                                    <i class="fas fa-chevron-down w-4 h-4 mr-2"></i>
                                                    <h3 class="font-medium">In Review</h3>
                                                    <span
                                                        class="ml-2 px-2 py-1 text-xs font-medium bg-gray-200 rounded-full">3</span>
                                                </div>
                                            </div>

                                            <!-- Task List -->
                                            <div id="inreviewTasks" class="divide-y divide-gray-200">
                                                <div
                                                    class="grid grid-cols-6 gap-4 py-2 px-4 text-sm font-medium text-gray-600 bg-gray-50">
                                                    <div class="col-span-1 flex items-center justify-center">Status</div>
                                                    <div class="col-span-1 flex items-center justify-center">Task Name
                                                    </div>
                                                    <div class="col-span-2 flex items-center justify-center">Description
                                                    </div>
                                                    <div class="col-span-1 flex items-center justify-center">Estimation
                                                    </div>
                                                    <div class="col-span-1 flex items-center justify-center">Action</div>
                                                </div>

                                                <!-- Task items (repeated for each task) -->
                                                <div class="grid grid-cols-6 gap-4 py-4 px-4 items-center text-sm">
                                                    <div class="col-span-1 flex items-center justify-center">
                                                        <input type="checkbox" class="w-4 h-4">
                                                    </div>
                                                    <div class="col-span-1 font-medium truncate">Employee Details</div>
                                                    <div class="col-span-2 truncate">
                                                        Create a page where there is information about employees
                                                    </div>
                                                    <div class="col-span-1 whitespace-nowrap truncate">Feb 14, 2024 - Feb
                                                        1, 2024</div>
                                                    <div class="col-span-1 flex items-center justify-center">
                                                        <button class="text-gray-400 hover:text-gray-600">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- More task items... -->
                                            </div>
                                        </div>

                                        <!-- Completed -->
                                        <div class="border rounded-lg">
                                            <div class="flex items-center justify-between p-4 bg-gray-100 rounded-t-lg cursor-pointer"
                                                id="completedDropdown">
                                                <div class="flex items-center">
                                                    <i class="fas fa-chevron-down w-4 h-4 mr-2"></i>
                                                    <h3 class="font-medium">Completed</h3>
                                                    <span
                                                        class="ml-2 px-2 py-1 text-xs font-medium bg-gray-200 rounded-full">3</span>
                                                </div>
                                            </div>

                                            <!-- Task List -->
                                            <div id="completedTasks" class="divide-y divide-gray-200">
                                                <div
                                                    class="grid grid-cols-6 gap-4 py-2 px-4 text-sm font-medium text-gray-600 bg-gray-50">
                                                    <div class="col-span-1 flex items-center justify-center">Status</div>
                                                    <div class="col-span-1 flex items-center justify-center">Task Name
                                                    </div>
                                                    <div class="col-span-2 flex items-center justify-center">Description
                                                    </div>
                                                    <div class="col-span-1 flex items-center justify-center">Estimation
                                                    </div>
                                                    <div class="col-span-1 flex items-center justify-center">Action</div>
                                                </div>

                                                <!-- Task items (repeated for each task) -->
                                                <div class="grid grid-cols-6 gap-4 py-4 px-4 items-center text-sm">
                                                    <div class="col-span-1 flex items-center justify-center">
                                                        <input type="checkbox" class="w-4 h-4">
                                                    </div>
                                                    <div class="col-span-1 font-medium truncate">Employee Details</div>
                                                    <div class="col-span-2 truncate">
                                                        Create a page where there is information about employees
                                                    </div>
                                                    <div class="col-span-1 whitespace-nowrap truncate">Feb 14, 2024 - Feb
                                                        1, 2024</div>
                                                    <div class="col-span-1 flex items-center justify-center">
                                                        <button class="text-gray-400 hover:text-gray-600">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- More task items... -->
                                            </div>
                                        </div>
                                        <!-- Backlog -->
                                        <div class="border rounded-lg">
                                            <div class="flex items-center justify-between p-4 bg-gray-100 rounded-t-lg cursor-pointer"
                                                id="backlogDropdown">
                                                <div class="flex items-center">
                                                    <i class="fas fa-chevron-down w-4 h-4 mr-2"></i>
                                                    <h3 class="font-medium">Backlog</h3>
                                                    <span
                                                        class="ml-2 px-2 py-1 text-xs font-medium bg-gray-200 rounded-full">3</span>
                                                </div>
                                            </div>

                                            <!-- Task List -->
                                            <div id="backlogTasks" class="divide-y divide-gray-200">
                                                <div
                                                    class="grid grid-cols-6 gap-4 py-2 px-4 text-sm font-medium text-gray-600 bg-gray-50">
                                                    <div class="col-span-1 flex items-center justify-center">Status</div>
                                                    <div class="col-span-1 flex items-center justify-center">Task Name
                                                    </div>
                                                    <div class="col-span-2 flex items-center justify-center">Description
                                                    </div>
                                                    <div class="col-span-1 flex items-center justify-center">Estimation
                                                    </div>
                                                    <div class="col-span-1 flex items-center justify-center">Action</div>
                                                </div>

                                                <!-- Task items (repeated for each task) -->
                                                <div class="grid grid-cols-6 gap-4 py-4 px-4 items-center text-sm">
                                                    <div class="col-span-1 flex items-center justify-center">
                                                        <input type="checkbox" class="w-4 h-4">
                                                    </div>
                                                    <div class="col-span-1 font-medium truncate">Employee Details</div>
                                                    <div class="col-span-2 truncate">
                                                        Create a page where there is information about employees
                                                    </div>
                                                    <div class="col-span-1 whitespace-nowrap truncate">Feb 14, 2024 - Feb
                                                        1, 2024</div>
                                                    <div class="col-span-1 flex items-center justify-center">
                                                        <button class="text-gray-400 hover:text-gray-600">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- More task items... -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-[99%] ml-1 opacity-0 absolute translate-x-[100%] transition-all duration-500 ease-in-out transform hidden"
                    id="timeLine">
                    <div class="grid grid-cols-1 gap-4 h-0" id="timeLineGrid">
                        <div class="min-h-screen p-8">
                            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-center mb-8">
                                        <div class="flex items-center space-x-4">
                                            <div class="relative">
                                                <input type="text" placeholder="Search..."
                                                    class="pl-2 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                            </div>
                                            <button
                                                class="bg-indigo-600 text-white rounded-md px-4 py-2 text-sm font-medium flex items-center hover:bg-indigo-700 transition duration-150 ease-in-out">
                                                <i class="fa-solid fa-plus mr-2"></i>
                                                New Task
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-8">
                                        <div class="flex justify-between items-center mb-4">
                                            <div class="text-center">
                                                <div class="text-sm font-medium text-gray-600 mb-1">Nov 15</div>
                                                <div class="w-px h-4 bg-gray-300 mx-auto"></div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-sm font-medium text-gray-600 mb-1">Nov 16</div>
                                                <div class="w-px h-4 bg-gray-300 mx-auto"></div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-sm font-medium text-gray-600 mb-1">Nov 17</div>
                                                <div class="w-px h-4 bg-gray-300 mx-auto"></div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-sm font-medium text-gray-600 mb-1">Nov 18</div>
                                                <div class="w-px h-4 bg-gray-300 mx-auto"></div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-sm font-medium text-gray-600 mb-1">Nov 19</div>
                                                <div class="w-px h-4 bg-gray-300 mx-auto"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-6">
                                        <div class="flex items-center space-x-4">

                                            <div class="flex-1">
                                                <div class="h-14 bg-purple-100 text-purple-800 rounded-lg relative transition-all duration-300 ease-in-out hover:shadow-md"
                                                    style="width: 60%; margin-left: 20%;">
                                                    <div class="absolute inset-0 flex items-center justify-between px-4">
                                                        <span class="text-sm font-medium">Competition analysis</span>
                                                        <!-- <div class="flex items-center justify-center relative">
                                                                                    <div class="w-7 h-7 bg-blue-500 rounded-full absolute left-0">
                                                                                    </div>
                                                                                    <div class="w-7 h-7 bg-green-500 rounded-full absolute left-3">
                                                                                    </div>
                                                                                    <div
                                                                                        class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center absolute left-6">
                                                                                        <p class="text-white text-sm font-semibold">+</p>
                                                                                    </div>
                                                                                </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">

                                            <div class="flex-1 relative">
                                                <div class="h-14 bg-pink-100 text-pink-800 rounded-lg relative transition-all duration-300 ease-in-out hover:shadow-md"
                                                    style="width: 40%; margin-left: 30%;">
                                                    <div class="absolute inset-0 flex items-center px-4">
                                                        <span class="text-sm font-medium">Design sprint</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">

                                            <div class="flex-1 relative">
                                                <div class="h-14 bg-blue-100 text-blue-800 rounded-lg relative transition-all duration-300 ease-in-out hover:shadow-md"
                                                    style="width: 50%; margin-left: 10%;">
                                                    <div class="absolute inset-0 flex items-center px-4">
                                                        <span class="text-sm font-medium">User testing</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">

                                            <div class="flex-1 relative">
                                                <div class="h-14 bg-green-100 text-green-800 rounded-lg relative transition-all duration-300 ease-in-out hover:shadow-md"
                                                    style="width: 70%; margin-left: 5%;">
                                                    <div class="absolute inset-0 flex items-center px-4">
                                                        <span class="text-sm font-medium">Marketing campaign</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                                    <div class="flex items-center text-sm text-gray-600">
                                        Project duration: Nov 15 - Nov 30
                                    </div>
                                    <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                        View All Tasks
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/slide-animation.js') }}"></script>
    <script src="{{ asset('assets/js/desc.js') }}"></script>
@endsection
