@extends('layouts.app')
@section('content')
    <div class="flex flex-col gap-6">
        <div class="flex flex-row justify-between items-center">
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
        </div>

        <div id="modal"
            class="modal-overlay fixed inset-0 bg-gray-600 bg-opacity-50 z-[50] items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-4xl mx-4 relative h-[90vh] flex flex-col">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Create Task</h2>
                <div class="overflow-y-auto flex-grow">
                    <form id="taskForm" method="POST" action="{{ route('tasks.store') }}"
                        class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
                        @csrf
                        <div class="space-y-8">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Task Details</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                            Title <span class="text-red-700">*</span>
                                        </label>
                                        <div id="titleWarnings" class="space-y-2 mb-2"></div>
                                        <input type="text" id="title" name="title"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                         focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                    </div>
                                    <div>
                                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">
                                            Priority <span class="text-red-700">*</span>
                                        </label>
                                        <select id="priority" name="priority"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                         focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                            <option value="low">Low</option>
                                            <option value="medium" selected>Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Dates</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
                                            Start Date
                                        </label>
                                        <input type="date" id="start_date" name="start_date"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                         focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">
                                            Due Date <span class="text-red-700">*</span>
                                        </label>
                                        <div id="dueDateWarnings" class="space-y-2 mb-2"></div>
                                        <input type="date" id="due_date" name="due_date" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                         focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Task Description</h2>
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                        Description <span class="text-red-700">*</span>
                                    </label>
                                    <div id="descriptionWarnings" class="space-y-2 mb-4"></div>
                                    <textarea id="description" name="description" rows="4" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>

                            <div class="flex justify-end space-x-3 mt-8">
                                <button type="button"
                                    class="backButton px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300
                     focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-150">
                                    Back
                                </button>
                                <button type="submit" id="createTaskButton"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700
                     focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-150">
                                    Create Task
                                </button>
                            </div>

                            <div id="validationWarnings" class="space-y-2 mb-4"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="Editmodal"
            class="modal-overlay fixed inset-0 bg-gray-600 bg-opacity-50 z-[50] items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-4xl mx-4 relative h-[90vh] flex flex-col">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Edit Task</h2>
                <div class="overflow-y-auto flex-grow">
                    <form id="taskForm" method="POST" class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
                        @csrf
                        <div class="space-y-8">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Task Details</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                            Title <span class="text-red-700">*</span>
                                        </label>
                                        <div id="titleWarnings" class="space-y-2 mb-2"></div>
                                        <input type="text" id="title" name="title"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                         focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                    </div>
                                    <div>
                                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">
                                            Priority <span class="text-red-700">*</span>
                                        </label>
                                        <select id="priority" name="priority"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                         focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                            <option value="low">Low</option>
                                            <option value="medium" selected>Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Dates</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
                                            Start Date
                                        </label>
                                        <input type="date" id="start_date" name="start_date"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                         focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">
                                            Due Date <span class="text-red-700">*</span>
                                        </label>
                                        <div id="dueDateWarnings" class="space-y-2 mb-2"></div>
                                        <input type="date" id="due_date" name="due_date" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                         focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Task Description</h2>
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                        Description <span class="text-red-700">*</span>
                                    </label>
                                    <div id="descriptionWarnings" class="space-y-2 mb-4"></div>
                                    <textarea id="description" name="description" rows="4" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>

                            <div class="flex justify-end space-x-3 mt-8">
                                <button type="button"
                                    class="backButton px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300
                     focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-150">
                                    Back
                                </button>
                                <button type="submit" id="createTaskButton"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700
                     focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-150">
                                    Edit Task
                                </button>
                            </div>

                            <div id="validationWarnings" class="space-y-2 mb-4"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="relative overflow-x-hidden h-[100vh] w-full md:h-[468px] sm:h-screen" id="contentContainer1">
            <div class="flex w-full transition-transform duration-500" id="contentContainer">
                <div class="w-full opacity-100 translate-x-0 transition-all duration-500 ease-in-out transform"
                    id="taskBoard">
                    <button
                        class="openModal inline-flex mb-6 items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md">
                        <i class="fas fa-plus mr-2"></i>
                        New Task
                    </button>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4"
                        id="taskBoardGrid">
                        <!-- To Do Column -->
                        <div class="flex flex-col items-start">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">To Do</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">
                                    {{ $todoTasks->count() }}
                                </div>
                            </div>
                            @foreach ($todoTasks as $task)
                                <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4">
                                    <div class="absolute top-4 right-4 dropdown">
                                        <button
                                            class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>

                                        <div
                                            class="dropdown-menu hidden absolute right-0 mt-2 w-28 bg-white border rounded-md shadow-lg z-10">
                                            <div class="openEditModal block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit
                                            </div>
                                            <div class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Hapus</div>
                                        </div>
                                    </div>
                                    <h2 class="text-lg font-semibold mb-2">{{ $task->title }}</h2>
                                    <p class="text-gray-500 text-sm mb-4">
                                        {{ $task->description }}
                                    </p>
                                    <div class="flex items-center justify-between text-gray-500 text-xs">
                                        <div class="flex gap-x-3 items-center">
                                            <div class="relative flex items-center group">
                                                <i class="fa-solid fa-arrow-left"></i>
                                                <span
                                                    class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 opacity-0 group-hover:opacity-100 transition-opacity text-xs bg-gray-700 text-white px-2 py-1 rounded">
                                                    Previous
                                                </span>
                                            </div>

                                            <div class="relative flex items-center group">
                                                <i class="fa-solid fa-arrow-right"></i>
                                                <span
                                                    class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 opacity-0 group-hover:opacity-100 transition-opacity text-xs bg-gray-700 text-white px-2 py-1 rounded">
                                                    Next
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fa-regular fa-clock mr-1"></i>
                                            <span>{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- In Progress Column -->
                        <div class="flex flex-col items-start">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">In Progress</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">
                                    {{ $inProgressTasks->count() }}
                                </div>
                            </div>
                            @foreach ($inProgressTasks as $task)
                                <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4">
                                    <div class="absolute top-4 right-4">
                                        <button
                                            class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                    <h2 class="text-lg font-semibold mb-2">{{ $task->title }}</h2>
                                    <p class="text-gray-500 text-sm mb-4">
                                        {{ $task->description }}
                                    </p>
                                    <div class="flex items-center justify-between text-gray-500 text-xs">
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
                                            <span>{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- In Review Column -->
                        <div class="flex flex-col items-start">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">In Review</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">
                                    {{ $inReviewTasks->count() }}
                                </div>
                            </div>
                            @foreach ($inReviewTasks as $task)
                                <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4">
                                    <div class="absolute top-4 right-4">
                                        <button
                                            class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                    <h2 class="text-lg font-semibold mb-2">{{ $task->title }}</h2>
                                    <p class="text-gray-500 text-sm mb-4">
                                        {{ $task->description }}
                                    </p>
                                    <div class="flex items-center justify-between text-gray-500 text-xs">
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
                                            <span>{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Completed Column -->
                        <div class="flex flex-col items-start">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">Completed</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">
                                    {{ $completedTasks->count() }}
                                </div>
                            </div>
                            @foreach ($completedTasks as $task)
                                <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4">
                                    <div class="absolute top-4 right-4">
                                        <button
                                            class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                    <h2 class="text-lg font-semibold mb-2">{{ $task->title }}</h2>
                                    <p class="text-gray-500 text-sm mb-4">
                                        {{ $task->description }}
                                    </p>
                                    <div class="flex items-center justify-between text-gray-500 text-xs">
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
                                            <span>{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Backlog Column -->
                        <div class="flex flex-col items-start">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-gray-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">Backlog</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">
                                    {{ $backlogTasks->count() }}
                                </div>
                            </div>
                            @foreach ($backlogTasks as $task)
                                <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4">
                                    <div class="absolute top-4 right-4">
                                        <button
                                            class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                    <h2 class="text-lg font-semibold mb-2">{{ $task->title }}</h2>
                                    <p class="text-gray-500 text-sm mb-4">
                                        {{ $task->description }}
                                    </p>
                                    <div class="flex items-center justify-between text-gray-500 text-xs">
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
                                            <span>{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                                    class="openModal flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
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
                                                class="openModal bg-indigo-600 text-white rounded-md px-4 py-2 text-sm font-medium flex items-center hover:bg-indigo-700 transition duration-150 ease-in-out">
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
                                                        <!-- <div class="flex items-center justify-center relative"> -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const taskModal = document.getElementById('modal');
            const openModalBtns = document.querySelectorAll('.openModal');
            const taskEditModal = document.getElementById('Editmodal');
            const openEditModalBtns = document.querySelectorAll('.openEditModal');
            const taskForm = document.getElementById('taskForm');
            const validationWarnings = document.getElementById('validationWarnings');

            // Buka modal Create Task
            openModalBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    taskModal.classList.remove('hidden');
                    taskModal.classList.add('flex');
                });
            });

            // Buka modal Edit Task
            openEditModalBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    taskEditModal.classList.remove('hidden');
                    taskEditModal.classList.add('flex');
                });
            });

            // Event listener untuk tombol back (menggunakan class .backButton)
            document.querySelectorAll('.backButton').forEach(btn => {
                btn.addEventListener('click', function() {
                    const modalContainer = this.closest('.modal-overlay');
                    if (modalContainer) {
                        modalContainer.classList.add('hidden');
                        modalContainer.classList.remove('flex');
                    }
                });
            });

            // Tutup modal saat klik di luar konten modal (pada overlay)
            document.querySelectorAll('.modal-overlay').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }
                });
            });

            // Fungsi validasi form task
            function validateTaskForm() {
                let isValid = true;

                const title = document.getElementById('title');
                const dueDate = document.getElementById('due_date');
                const description = document.getElementById('description');

                const titleWarnings = document.getElementById('titleWarnings');
                const dueDateWarnings = document.getElementById('dueDateWarnings');
                const descriptionWarnings = document.getElementById('descriptionWarnings');

                titleWarnings.innerHTML = '';
                dueDateWarnings.innerHTML = '';
                descriptionWarnings.innerHTML = '';

                if (!title.value.trim()) {
                    titleWarnings.innerHTML = '<div class="text-red-500 text-sm">Title is required.</div>';
                    isValid = false;
                }
                if (!dueDate.value) {
                    dueDateWarnings.innerHTML = '<div class="text-red-500 text-sm">Due Date is required.</div>';
                    isValid = false;
                }
                if (!description.value.trim()) {
                    descriptionWarnings.innerHTML =
                        '<div class="text-red-500 text-sm">Description is required.</div>';
                    isValid = false;
                }

                return isValid;
            }

            // Validasi form saat disubmit
            if (taskForm) {
                taskForm.addEventListener('submit', function(e) {
                    if (!validateTaskForm()) {
                        e.preventDefault();
                        // Scroll ke bagian validasi bila ada pesan error
                        validationWarnings.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            }

            // Validasi secara real-time pada input yang diperlukan
            ['title', 'due_date', 'description'].forEach(function(fieldId) {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('input', validateTaskForm);
                }
            });

            // Tetapkan tanggal minimal untuk Due Date (misalnya 3 hari dari hari ini)
            const dueDateInput = document.getElementById('due_date');
            if (dueDateInput) {
                const today = new Date();
                const minDate = new Date();
                minDate.setDate(today.getDate() + 3);
                const year = minDate.getFullYear();
                const month = String(minDate.getMonth() + 1).padStart(2, '0');
                const day = String(minDate.getDate()).padStart(2, '0');
                dueDateInput.setAttribute('min', `${year}-${month}-${day}`);
            }
        });
    </script>


    <script>
        document.getElementById('taskForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errData => {
                            throw errData;
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    const newTask = data.task;

                    const dueDate = new Date(newTask.due_date);
                    let day = dueDate.getDate();
                    day = day.toString().padStart(2, '0');
                    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct",
                        "Nov", "Dec"
                    ];
                    const month = monthNames[dueDate.getMonth()];
                    const year = dueDate.getFullYear();
                    const formattedDueDate = `${day} ${month}, ${year}`;


                    const newTaskEl = document.createElement('div');
                    newTaskEl.className = "w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4";
                    newTaskEl.innerHTML = `
                    <div class="absolute top-4 right-4">
                        <button class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>

                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-28 bg-white border rounded-md shadow-lg z-10">
    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit</a>
    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Hapus</a>
  </div>
                    </div>
                    <h2 class="text-lg font-semibold mb-2">${newTask.title}</h2>
                    <p class="text-gray-500 text-sm mb-4">${newTask.description}</p>
                    <div class="flex items-center justify-between text-gray-500 text-xs">
                        <div class="flex gap-x-3 items-center">
                            <!-- Left Arrow dengan tooltip "Previous" -->
                            <div class="relative flex items-center group">
                                <i class="fa-solid fa-arrow-left text-xl"></i>
                                <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 opacity-0 group-hover:opacity-100 transition-opacity text-xs bg-gray-700 text-white px-2 py-1 rounded">
                                    Previous
                                </span>
                            </div>
                            <!-- Right Arrow dengan tooltip "Next" -->
                            <div class="relative flex items-center group">
                                <i class="fa-solid fa-arrow-right text-xl"></i>
                                <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 opacity-0 group-hover:opacity-100 transition-opacity text-xs bg-gray-700 text-white px-2 py-1 rounded">
                                    Next
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fa-regular fa-clock mr-1"></i>
                            <span>${formattedDueDate}</span>
                        </div>
                    </div>
                `;

                    const todoColumn = document.querySelector('#taskBoardGrid > div:first-child');
                    if (todoColumn) {
                        todoColumn.appendChild(newTaskEl);
                    }

                    document.getElementById('taskForm').reset();
                    const taskModal = document.getElementById('modal');
                    taskModal.classList.add('hidden');
                    taskModal.classList.remove('flex');
                })
                .catch(errorData => {
                    const validationWarnings = document.getElementById('validationWarnings');
                    validationWarnings.innerHTML = '';
                    if (errorData.errors) {
                        Object.entries(errorData.errors).forEach(([field, messages]) => {
                            messages.forEach(message => {
                                validationWarnings.innerHTML +=
                                    `<div class="text-red-500 text-sm">${message}</div>`;
                            });
                        });
                    }
                });
        });
    </script>

    <script>
        // Tambahkan event listener ke semua tombol dropdown-toggle
        document.querySelectorAll('.dropdown-toggle').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation(); // Mencegah event bubbling agar dropdown tidak langsung tertutup
                // Cari dropdown-menu yang berada di dalam container terdekat dengan class "dropdown"
                const dropdown = this.closest('.dropdown').querySelector('.dropdown-menu');
                dropdown.classList.toggle('hidden');
            });
        });

        // Tutup semua dropdown ketika klik di area lain halaman
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>


    <script src="{{ asset('assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/slide-animation.js') }}"></script>
    <script src="{{ asset('assets/js/desc.js') }}"></script>
@endsection
