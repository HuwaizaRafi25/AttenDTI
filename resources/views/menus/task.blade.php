@extends('layouts.app')
@section('content')
    <div class="flex flex-col gap-6">
        <!-- Tab Navigasi -->
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

        <!-- Modal Konfirmasi Hapus -->
        <div id="removeConfirmationModal"
            class="fixed inset-0 items-center justify-center bg-gray-600 bg-opacity-50 z-[1000000] hidden">
            <div class="bg-white p-6 rounded-md shadow-md">
                <p class="mb-4">Are you sure you want to remove this task?</p>
                <div class="flex justify-end space-x-2">
                    <button id="cancelRemoveModal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button id="confirmRemoveModal" class="px-4 py-2 bg-red-500 text-white rounded">Remove</button>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Do The Task -->
        <div id="confirmationModal"
            class="fixed inset-0 items-center justify-center bg-gray-600 bg-opacity-50 z-[1000000] hidden">
            <div class="bg-white p-6 rounded-md shadow-md">
                <p class="mb-4">Are you sure you will do this task first?</p>
                <div class="flex justify-end space-x-2">
                    <button id="cancelModal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button id="confirmModal" class="px-4 py-2 bg-blue-500 text-white rounded">Confirm</button>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Mark Completed -->
        <div id="confirmationModalCompleted"
            class="fixed inset-0 items-center justify-center bg-gray-900 bg-opacity-50 hidden z-[10000]">
            <div class="bg-white p-6 rounded-md shadow-md">
                <p class="mb-4">Are you sure you want to mark this task as completed?</p>
                <div class="flex justify-end space-x-2">
                    <button id="cancelModalCompleted" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button id="confirmModalCompleted" class="px-4 py-2 bg-blue-500 text-white rounded">Confirm</button>
                </div>
            </div>
        </div>

        <!-- Modal Edit Task -->
        <div id="edittaskmodal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-4xl mx-4 relative h-[90vh] flex flex-col">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Edit Task</h2>
                <div class="overflow-y-auto flex-grow">
                    <form id="editTaskForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="space-y-8">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Task Details</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <input type="hidden" id="edit_task_id" name="task_id">
                                    <div>
                                        <label for="edit_title" class="block text-sm font-medium text-gray-700 mb-1">
                                            Title <span class="text-red-700">*</span>
                                        </label>
                                        <input type="text" id="edit_title" name="title"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                    </div>
                                    <div>
                                        <label for="edit_priority" class="block text-sm font-medium text-gray-700 mb-1">
                                            Priority <span class="text-red-700">*</span>
                                        </label>
                                        <select id="edit_priority" name="priority"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Dates</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="edit_start_date" class="block text-sm font-medium text-gray-700 mb-1">
                                            Start Date
                                        </label>
                                        <input type="date" id="edit_start_date" name="start_date"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="edit_due_date" class="block text-sm font-medium text-gray-700 mb-1">
                                            Due Date
                                        </label>
                                        <input type="date" id="edit_due_date" name="due_date"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Task Description</h2>
                                <div>
                                    <label for="edit_description" class="block text-sm font-medium text-gray-700 mb-1">
                                        Description
                                    </label>
                                    <textarea id="edit_description" name="description" rows="4"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>

                            <div class="flex justify-end space-x-3 mt-8">
                                <button type="button" id="cancelEdit"
                                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-150">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-150">
                                    Update Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Create Task -->
        <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-[50] items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-4xl mx-4 relative h-[90vh] flex flex-col">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Create Task</h2>
                <div class="overflow-y-auto flex-grow">
                    <form id="createTaskForm" method="POST" action="{{ route('tasks.store') }}">
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
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                    </div>
                                    <div>
                                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">
                                            Priority <span class="text-red-700">*</span>
                                        </label>
                                        <select id="priority" name="priority"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                            <option value="" disabled selected hidden>Priority</option>
                                            <option value="low">Low</option>
                                            <option value="medium">Medium</option>
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
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">
                                            Due Date <span class="text-red-700">*</span>
                                        </label>
                                        <div id="dueDateWarnings" class="space-y-2 mb-2"></div>
                                        <input type="date" id="due_date" name="due_date" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>
                            </div>

                            <div class="flex justify-end space-x-3 mt-8">
                                <button type="button" id="backButton"
                                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-150">
                                    Back
                                </button>
                                <button type="submit" id="createTaskButton"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-150">
                                    Create Task
                                </button>
                            </div>

                            <div id="validationWarnings" class="space-y-2 mb-4"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="relative overflow-x-hidden h-[100vh] w-full md:h-[468px] sm:h-screen" id="contentContainer1">
            <div class="flex w-full transition-transform duration-500" id="contentContainer">
                <!-- Task Board -->
                <div class="w-full opacity-100 translate-x-0 transition-all duration-500 ease-in-out transform"
                    id="taskBoard">
                    <button
                        class="openModal inline-flex mb-6 items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md">
                        <i class="fas fa-plus mr-2"></i>
                        New Task
                    </button>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4"
                        id="taskBoardGrid">
                        <!-- To Do Column -->
                        <div class="flex flex-col items-start" id="todoColumn">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">To Do</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">
                                    {{ $todoTasks->count() }}
                                </div>
                            </div>
                            @if ($todoTasks->isEmpty())
                                <div
                                    class="w-full h-max rounded-md mt-2 relative p-4 text-gray-500">
                                    No Task Available
                                </div>
                            @else
                                @foreach ($todoTasks as $task)
                                    <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4 task-card"
                                        id="task-{{ $task->id }}" data-status="todo">
                                        <div class="absolute top-4 right-4 dropdown">
                                            <button
                                                class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div
                                                class="dropdown-menu hidden absolute right-0 mt-2 w-28 bg-white border rounded-md shadow-lg z-10">
                                                <button
                                                    class="edit-button w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                                                    data-task-id="{{ $task->id }}" data-title="{{ $task->title }}"
                                                    data-priority="{{ $task->priority }}"
                                                    data-start-date="{{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('Y-m-d') : '' }}"
                                                    data-due-date="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}"
                                                    data-description="{{ $task->description }}">
                                                    Edit
                                                </button>
                                                <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer"
                                                    data-task-id="{{ $task->id }}">
                                                    Remove
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="text-lg font-semibold mb-2 flex items-center">
                                            @if ($task->priority == 'high')
                                                <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                                            @elseif ($task->priority == 'medium')
                                                <span class="inline-block w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                                            @elseif ($task->priority == 'low')
                                                <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                            @endif
                                            {{ $task->title }}
                                        </h2>
                                        <p class="text-gray-500 text-sm mb-4">
                                            {{ $task->description }}
                                        </p>
                                        <div class="flex items-center justify-between text-gray-500 text-xs">
                                            <div class="flex gap-x-3 items-center">
                                                <button onclick="changeTaskStatus({{ $task->id }}, 'in_progress')"
                                                    class="h-max w-max p-2 bg-blue-500 rounded-md text-white">
                                                    Do The Task
                                                </button>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fa-regular fa-clock mr-1"></i>
                                                <span>{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- In Progress Column -->
                        <div class="flex flex-col items-start" id="inProgressColumn">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">In Progress</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">
                                    {{ $inProgressTasks->count() }}
                                </div>
                            </div>
                            @if ($inProgressTasks->isEmpty())
                                <div
                                    class="w-full h-max rounded-md mt-2 relative p-4 text-gray-500">
                                    No Task Available
                                </div>
                            @else
                                @foreach ($inProgressTasks as $task)
                                    <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4 task-card"
                                        id="task-{{ $task->id }}" data-status="in_progress">
                                        <div class="absolute top-4 right-4 dropdown">
                                            <button
                                                class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div
                                                class="dropdown-menu hidden absolute right-0 mt-2 w-28 bg-white border rounded-md shadow-lg z-10">
                                                <button
                                                    class="edit-button w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                                                    data-task-id="{{ $task->id }}" data-title="{{ $task->title }}"
                                                    data-priority="{{ $task->priority }}"
                                                    data-start-date="{{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('Y-m-d') : '' }}"
                                                    data-due-date="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}"
                                                    data-description="{{ $task->description }}">
                                                    Edit
                                                </button>
                                                <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer"
                                                    data-task-id="{{ $task->id }}">
                                                    Remove
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="text-lg font-semibold mb-2 flex items-center">
                                            @if ($task->priority == 'high')
                                                <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                                            @elseif ($task->priority == 'medium')
                                                <span class="inline-block w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                                            @elseif ($task->priority == 'low')
                                                <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                            @endif
                                            {{ $task->title }}
                                        </h2>
                                        <p class="text-gray-500 text-sm mb-4">
                                            {{ $task->description }}
                                        </p>
                                        <div class="flex items-center justify-between text-gray-500 text-xs">
                                            <div class="flex gap-x-3 items-center">
                                                <button onclick="changeTaskStatus({{ $task->id }}, 'completed')"
                                                    class="h-max w-max p-2 bg-blue-500 rounded-md text-white">
                                                    Mark Completed
                                                </button>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fa-regular fa-clock mr-1"></i>
                                                <span>{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Completed Column -->
                        <div class="flex flex-col items-start" id="completedColumn">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">Completed</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">
                                    {{ $completedTasks->count() }}
                                </div>
                            </div>
                            @if ($completedTasks->isEmpty())
                                <div
                                    class="w-full h-max rounded-md mt-2 relative p-4 text-gray-500">
                                    No Task Available
                                </div>
                            @else
                                @foreach ($completedTasks as $task)
                                    <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4 task-card"
                                        id="task-{{ $task->id }}" data-status="completed">
                                        <div class="absolute top-4 right-4 dropdown">
                                            <button
                                                class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div
                                                class="dropdown-menu hidden absolute right-0 mt-2 w-28 bg-white border rounded-md shadow-lg z-10">
                                                <button
                                                    class="edit-button w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                                                    data-task-id="{{ $task->id }}" data-title="{{ $task->title }}"
                                                    data-priority="{{ $task->priority }}"
                                                    data-start-date="{{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('Y-m-d') : '' }}"
                                                    data-due-date="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}"
                                                    data-description="{{ $task->description }}">
                                                    Edit
                                                </button>
                                                <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer"
                                                    data-task-id="{{ $task->id }}">
                                                    Remove
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="text-lg font-semibold mb-2 flex items-center">
                                            @if ($task->priority == 'high')
                                                <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                                            @elseif ($task->priority == 'medium')
                                                <span class="inline-block w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                                            @elseif ($task->priority == 'low')
                                                <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                            @endif
                                            {{ $task->title }}
                                        </h2>
                                        <p class="text-gray-500 text-sm mb-4">
                                            {{ $task->description }}
                                        </p>
                                        <div class="flex items-center justify-between text-gray-500 text-xs">
                                            <div class="flex gap-x-3 items-center">
                                                <!-- Tidak ada aksi untuk update di kolom ini -->
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fa-regular fa-clock mr-1"></i>
                                                <span>{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Backlog Column -->
                        <div class="flex flex-col items-start" id="backlogColumn">
                            <div class="flex items-center w-full mb-2">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-gray-500 rounded-full mr-2"></div>
                                    <span class="flex items-center mr-2 text-sm font-medium">Backlog</span>
                                </div>
                                <div class="w-5 h-5 bg-gray-200 flex items-center justify-center rounded text-xs">
                                    {{ $backlogTasks->count() }}
                                </div>
                            </div>
                            @if ($backlogTasks->isEmpty())
                                <div
                                    class="w-full h-max rounded-md mt-2 relative p-4 text-gray-500">
                                    No Task Available
                                </div>
                            @else
                                @foreach ($backlogTasks as $task)
                                    <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4 task-card"
                                        id="task-{{ $task->id }}" data-status="backlog">
                                        <div class="absolute top-4 right-4 dropdown">
                                            <button
                                                class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div
                                                class="dropdown-menu hidden absolute right-0 mt-2 w-28 bg-white border rounded-md shadow-lg z-10">
                                                <button
                                                    class="edit-button w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                                                    data-task-id="{{ $task->id }}" data-title="{{ $task->title }}"
                                                    data-priority="{{ $task->priority }}"
                                                    data-start-date="{{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('Y-m-d') : '' }}"
                                                    data-due-date="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}"
                                                    data-description="{{ $task->description }}">
                                                    Edit
                                                </button>
                                                <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer"
                                                    data-task-id="{{ $task->id }}">
                                                    Remove
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="text-lg font-semibold mb-2 flex items-center">
                                            @if ($task->priority == 'high')
                                                <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                                            @elseif ($task->priority == 'medium')
                                                <span class="inline-block w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                                            @elseif ($task->priority == 'low')
                                                <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                            @endif
                                            {{ $task->title }}
                                        </h2>
                                        <p class="text-gray-500 text-sm mb-4">
                                            {{ $task->description }}
                                        </p>
                                        <div class="flex items-center justify-between text-gray-500 text-xs">
                                            <div class="flex gap-x-3 items-center">
                                                <button onclick="changeTaskStatus({{ $task->id }}, 'in_progress')"
                                                    class="h-max w-max p-2 bg-blue-500 rounded-md text-white">
                                                    Do The Task
                                                </button>
                                            </div>
                                            <div class="flex items-center">
                                                <i class="fa-regular fa-clock mr-1"></i>
                                                <span>{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Task List -->
                <div class="w-[99%] opacity-0 absolute translate-x-[100%] transition-all duration-500 ease-in-out transform hidden"
                    id="taskList">
                    <div class="grid grid-cols-1 gap-4" id="taskListGrid">
                        <div class="p-6 h-auto">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-4">
                                    <button
                                        class="openModal flex items-center px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                        <i class="fa-solid fa-plus mr-2"></i> New Task
                                    </button>
                                    <!-- <input type="search" placeholder="Search..."
                                            class="w-64 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"> -->
                                    <!-- <button class="p-2 border rounded-lg hover:bg-gray-50">
                                            <i class="fa-solid fa-filter"></i>
                                        </button> -->
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="w-full overflow-x-auto">
                                    <div class="min-w-max space-y-4">
                                        @foreach (['To Do' => $todoTasks, 'In Progress' => $inProgressTasks, 'Completed' => $completedTasks, 'Backlog' => $backlogTasks] as $section => $tasks)
                                            <div class="border rounded-lg">
                                                <!-- Header Section -->
                                                <div class="flex items-center justify-between p-4 bg-gray-100 rounded-t-lg cursor-pointer"
                                                    id="{{ strtolower(str_replace(' ', '', $section)) }}Dropdown">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-chevron-down w-4 h-4 mr-2"></i>
                                                        <h3 class="font-medium">{{ $section }}</h3>
                                                        <span
                                                            class="ml-2 px-2 py-1 text-xs font-medium bg-gray-200 rounded-full">
                                                            {{ $tasks->count() }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Task List -->
                                                <div id="{{ strtolower(str_replace(' ', '', $section)) }}Tasks"
                                                    class="divide-y divide-gray-200">
                                                    <!-- Table Header -->
                                                    <div
                                                        class="grid grid-cols-5 gap-4 py-2 px-4 text-sm font-medium text-gray-600 bg-gray-50">
                                                        <div class="col-span-1 text-center">Task Name</div>
                                                        <div class="col-span-2 text-center">Description</div>
                                                        <div class="col-span-1 text-center">Estimation</div>
                                                        <div class="col-span-1 text-center">Action</div>
                                                    </div>

                                                    <!-- Task Rows -->
                                                    @forelse ($tasks as $task)
                                                        <div id="task-row-{{ $task->id }}"
                                                            class="grid grid-cols-5 gap-4 py-4 px-4 items-center text-sm task-row"
                                                            data-status="{{ strtolower($section) }}"
                                                            data-task-id="{{ $task->id }}">

                                                            <div class="col-span-1 text-center font-medium truncate">
                                                                {{ $task->title }}
                                                            </div>

                                                            <div class="col-span-2 text-center truncate">
                                                                {{ $task->description }}
                                                            </div>

                                                            <div class="col-span-1 text-center truncate">
                                                                {{ \Carbon\Carbon::parse($task->start_date)->format('d M Y') }}
                                                                -
                                                                {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                                                            </div>

                                                            <div class="col-span-1 text-center relative">
                                                                <div class="flex items-center justify-center space-x-2">
                                                                    @if (in_array(strtolower($section), ['backlog', 'to do', 'in progress']))
                                                                        @if (in_array(strtolower($section), ['backlog', 'to do']))
                                                                            <button
                                                                                onclick="changeTaskStatus({{ $task->id }}, 'in_progress')"
                                                                                title="Do The Task"
                                                                                class="p-2 bg-transparent rounded-md text-blue-500">
                                                                                <i class="fas fa-play"></i>
                                                                            </button>
                                                                        @elseif (strtolower($section) == 'in progress')
                                                                            <button
                                                                                onclick="changeTaskStatus({{ $task->id }}, 'completed')"
                                                                                title="Mark Completed"
                                                                                class="p-2 bg-transparent rounded-md text-blue-500">
                                                                                <i class="fas fa-check"></i>
                                                                            </button>
                                                                        @endif
                                                                    @endif

                                                                    <div class="dropdown relative">
                                                                        <button
                                                                            class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                                                                            <i class="fas fa-ellipsis-h"></i>
                                                                        </button>
                                                                        <div
                                                                            class="dropdown-menu hidden absolute right-0 mt-2 w-28 bg-white border rounded-md shadow-lg z-10">
                                                                            <button
                                                                                class="edit-button w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                                                                                data-task-id="{{ $task->id }}"
                                                                                data-title="{{ $task->title }}"
                                                                                data-priority="{{ $task->priority }}"
                                                                                data-start-date="{{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('Y-m-d') : '' }}"
                                                                                data-due-date="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}"
                                                                                data-description="{{ $task->description }}">
                                                                                Edit
                                                                            </button>
                                                                            <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer"
                                                                                data-task-id="{{ $task->id }}">
                                                                                Remove
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="py-4 px-4 text-center text-sm text-gray-500">No tasks
                                                            available.</div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="w-[99%] ml-1 opacity-0 absolute translate-x-[100%] transition-all duration-500 ease-in-out transform hidden"
                    id="timeLine">
                    <div class="grid grid-cols-1 gap-4" id="timeLineGrid">
                        <div class="min-h-screen p-8">
                            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-center mb-8 sticky top-0 bg-white z-10">
                                        <div class="flex items-center space-x-4">
                                            <div class="relative">
                                                <!-- <input type="text" placeholder="Search..."
                                                        class="pl-2 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" /> -->
                                            </div>
                                            <button
                                                class="openModal bg-blue-600 text-white rounded-md px-4 py-2 text-sm font-medium flex items-center hover:bg-blue-700 transition duration-150 ease-in-out">
                                                <i class="fa-solid fa-plus mr-2"></i>
                                                New Task
                                            </button>
                                        </div>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <div class="min-w-max">
                                            <div class="mb-8">
                                                @php
                                                    use Carbon\Carbon;
                                                    $start = $minStartDate
                                                        ? Carbon::parse($minStartDate)
                                                        : Carbon::now();
                                                    $end = $maxDueDate ? Carbon::parse($maxDueDate) : Carbon::now();
                                                    $totalDays = $end->diffInDays($start) + 1;
                                                    $dayWidth = 50; // Lebar per hari dalam piksel
                                                    $timelineWidth = $totalDays * $dayWidth;
                                                @endphp
                                                <div class="flex mb-4 sticky top-0 bg-white"
                                                    style="width: {{ $timelineWidth }}px;">
                                                    @for ($i = 0; $i < $totalDays; $i++)
                                                        <div class="text-center" style="width: {{ $dayWidth }}px;">
                                                            <div class="text-sm font-medium text-gray-600 mb-1">
                                                                {{ $start->copy()->addDays($i)->format('M d') }}
                                                            </div>
                                                            <div class="w-px h-4 bg-gray-300 mx-auto"></div>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="space-y-6" id="timelineContent">
                                                @php
                                                    $sections = [
                                                        'To Do' => $todoTasks,
                                                        'In Progress' => $inProgressTasks,
                                                        'Completed' => $completedTasks,
                                                        'Backlog' => $backlogTasks,
                                                    ];
                                                    $colors = [
                                                        'To Do' => 'purple',
                                                        'In Progress' => 'pink',
                                                        'Completed' => 'blue',
                                                        'Backlog' => 'green',
                                                    ];
                                                @endphp
                                                @foreach ($sections as $sectionName => $tasks)
                                                    <div class="mb-8">
                                                        <h3 class="text-lg font-bold mb-4 sticky left-0 bg-white">
                                                            {{ $sectionName }}</h3>
                                                        <div class="space-y-4"
                                                            id="timeline-{{ strtolower(str_replace(' ', '', $sectionName)) }}">
                                                            @foreach ($tasks as $task)
                                                                <div class="flex min-w-max task-timeline"
                                                                    data-task-id="{{ $task->id }}">
                                                                    @php
                                                                        $taskStart = Carbon::parse($task->start_date);
                                                                        $taskEnd = Carbon::parse($task->due_date);
                                                                        $leftOffset =
                                                                            $start->diffInDays($taskStart) * $dayWidth;
                                                                        $width = max(
                                                                            $taskEnd->diffInDays($taskStart) *
                                                                                $dayWidth +
                                                                                $dayWidth,
                                                                            $dayWidth,
                                                                        );
                                                                    @endphp
                                                                    <div class="h-14 bg-{{ $colors[$sectionName] }}-100 text-{{ $colors[$sectionName] }}-800 rounded-lg relative transition-all duration-300 ease-in-out hover:shadow-md"
                                                                        style="width: {{ $width }}px; margin-left: {{ $leftOffset }}px;">
                                                                        <div class="absolute inset-0 flex items-center">
                                                                            <span
                                                                                class="text-sm font-medium truncate ml-4">{{ $task->title }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center sticky bottom-0">
                                    <div class="flex items-center text-sm text-gray-600">
                                        Project duration: {{ $start->format('M d') }} - {{ $end->format('M d') }}
                                    </div>
                                    <!-- <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                                View All Tasks
                                            </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const taskModal = document.getElementById("modal");
            const editTaskModal = document.getElementById("edittaskmodal");
            const openModalBtns = document.querySelectorAll(".openModal");
            const backButton = document.getElementById("backButton");
            const cancelEditButton = document.getElementById("cancelEdit");
            const validationWarnings = document.getElementById("validationWarnings");
            const csrfToken = "{{ csrf_token() }}";

            // Buka modal pembuatan tugas
            openModalBtns.forEach((btn) => {
                btn.addEventListener("click", () => {
                    taskModal.classList.remove("hidden");
                    taskModal.classList.add("flex");
                });
            });

            // Tutup modal pembuatan tugas
            taskModal.addEventListener("click", function(e) {
                if (e.target === this || e.target === backButton) {
                    taskModal.classList.add("hidden");
                    taskModal.classList.remove("flex");
                }
            });

            // Tutup modal edit tugas
            if (cancelEditButton) {
                cancelEditButton.addEventListener("click", function() {
                    editTaskModal.classList.add("hidden");
                    editTaskModal.classList.remove("flex");
                });
            }

            // Validasi form pembuatan tugas
            function validateTaskForm() {
                let isValid = true;
                const title = document.getElementById("title");
                const dueDate = document.getElementById("due_date");
                const description = document.getElementById("description");
                const titleWarnings = document.getElementById("titleWarnings");
                const dueDateWarnings = document.getElementById("dueDateWarnings");
                const descriptionWarnings = document.getElementById(
                    "descriptionWarnings"
                );

                titleWarnings.innerHTML = "";
                dueDateWarnings.innerHTML = "";
                descriptionWarnings.innerHTML = "";

                if (!title.value.trim()) {
                    titleWarnings.innerHTML =
                        '<div class="text-red-500 text-sm">Title is required.</div>';
                    isValid = false;
                }
                if (!dueDate.value) {
                    dueDateWarnings.innerHTML =
                        '<div class="text-red-500 text-sm">Due Date is required.</div>';
                    isValid = false;
                }
                if (!description.value.trim()) {
                    descriptionWarnings.innerHTML =
                        '<div class="text-red-500 text-sm">Description is required.</div>';
                    isValid = false;
                }

                return isValid;
            }

            // Submit form pembuatan tugas
            document
                .getElementById("createTaskForm")
                .addEventListener("submit", function(e) {
                    e.preventDefault();
                    if (!validateTaskForm()) {
                        validationWarnings.scrollIntoView({
                            behavior: "smooth",
                        });
                        return;
                    }

                    const formData = new FormData(this);
                    fetch(this.action, {
                            method: "POST",
                            headers: {
                                Accept: "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": csrfToken,
                            },
                            body: formData,
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (!data.success) throw new Error("Failed to create task");
                            const newTask = data.task;
                            addTaskToView(newTask);
                            document.getElementById("createTaskForm").reset();
                            taskModal.classList.add("hidden");
                            taskModal.classList.remove("flex");
                        })
                        .catch((error) => {
                            console.error("Error:", error);
                            validationWarnings.innerHTML =
                                '<div class="text-red-500 text-sm">Failed to create task. Please check your input.</div>';
                        });
                });

            // Fungsi untuk menambahkan tugas ke tampilan
            function addTaskToView(task) {
                const dueDate = new Date(task.due_date);
                const formattedDueDate = dueDate.toLocaleDateString("en-GB", {
                    day: "2-digit",
                    month: "short",
                    year: "numeric",
                });
                let priorityCircle = "";
                if (task.priority === "high")
                    priorityCircle =
                    '<span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>';
                else if (task.priority === "medium")
                    priorityCircle =
                    '<span class="inline-block w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>';
                else if (task.priority === "low")
                    priorityCircle =
                    '<span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>';

                const taskEl = document.createElement("div");
                taskEl.className =
                    "w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4 task-card";
                taskEl.id = `task-${task.id}`;
                taskEl.dataset.status = task.status;
                taskEl.innerHTML = `
                <div class="absolute top-4 right-4 dropdown">
                    <button class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-28 bg-white border rounded-md shadow-lg z-10">
                        <button class="edit-button w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                            data-task-id="${task.id}" data-title="${task.title}"
                            data-priority="${task.priority}"
                            data-start-date="${
                                task.start_date
                                    ? new Date(task.start_date)
                                          .toISOString()
                                          .split("T")[0]
                                    : ""
                            }"
                            data-due-date="${
                                task.due_date
                                    ? new Date(task.due_date)
                                          .toISOString()
                                          .split("T")[0]
                                    : ""
                            }"
                            data-description="${task.description}">
                            Edit
                        </button>
                        <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer"
                            data-task-id="${task.id}">
                            Remove
                        </div>
                    </div>
                </div>
                <h2 class="text-lg font-semibold mb-2 flex items-center">
                    ${priorityCircle}${task.title}
                </h2>
                <p class="text-gray-500 text-sm mb-4">${task.description}</p>
                <div class="flex items-center justify-between text-gray-500 text-xs">
                    <div class="flex gap-x-3 items-center">
                        ${
                            task.status === "todo" || task.status === "backlog"
                                ? `<button onclick="changeTaskStatus(${task.id}, 'in_progress')" class="h-max w-max p-2 bg-blue-500 rounded-md text-white">Do The Task</button>`
                                : task.status === "in_progress"
                                ? `<button onclick="changeTaskStatus(${task.id}, 'completed')" class="h-max w-max p-2 bg-blue-500 rounded-md text-white">Mark Completed</button>`
                                : ""
                        }
                    </div>
                    <div class="flex items-center">
                        <i class="fa-regular fa-clock mr-1"></i>
                        <span>${formattedDueDate}</span>
                    </div>
                </div>
            `;

                const column = document.getElementById(`${task.status}Column`);
                if (column) column.appendChild(taskEl);
                updateTaskCount(task.status);

                const taskRow = createTaskRow(task);
                const taskListSection = document.getElementById(
                    `${task.status.replace("_", "")}Tasks`
                );
                if (taskListSection) taskListSection.appendChild(taskRow);

                updateTimeline(task);
                attachDropdownListeners(); // Tambahkan listener setelah elemen baru dibuat
            }

            // Fungsi untuk membuat baris tugas di Task List
            function createTaskRow(task) {
                const row = document.createElement("div");
                row.className =
                    "grid grid-cols-6 gap-4 py-4 px-4 items-center text-sm task-row";
                row.id = `task-row-${task.id}`;
                row.dataset.status = task.status;
                row.dataset.taskId = task.id;
                row.innerHTML = `
                <div class="col-span-1 text-center">
                    <input type="checkbox" class="w-4 h-4 task-checkbox" data-task-id="${task.id}"
                        ${task.status === "completed" ? "checked disabled" : ""}>
                </div>
                <div class="col-span-1 text-center font-medium truncate">${task.title}</div>
                <div class="col-span-2 text-center truncate">${task.description}</div>
                <div class="col-span-1 text-center truncate">
                    ${new Date(task.start_date).toLocaleDateString("en-GB", {
                        day: "2-digit",
                        month: "short",
                        year: "numeric",
                    })} -
                    ${new Date(task.due_date).toLocaleDateString("en-GB", {
                        day: "2-digit",
                        month: "short",
                        year: "numeric",
                    })}
                </div>
                <div class="col-span-1 text-center relative">
                    <div class="dropdown">
                        <button class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu hidden absolute right-0 mt-2 w-28 bg-white border rounded-md shadow-lg z-10">
                            <button class="edit-button w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                                data-task-id="${task.id}" data-title="${task.title}"
                                data-priority="${task.priority}"
                                data-start-date="${
                                    task.start_date
                                        ? new Date(task.start_date)
                                              .toISOString()
                                              .split("T")[0]
                                        : ""
                                }"
                                data-due-date="${
                                    task.due_date
                                        ? new Date(task.due_date)
                                              .toISOString()
                                              .split("T")[0]
                                        : ""
                                }"
                                data-description="${task.description}">
                                Edit
                            </button>
                            <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer"
                                data-task-id="${task.id}">
                                Remove
                            </div>
                        </div>
                    </div>
                </div>
            `;
                return row;
            }

            // Event delegation untuk edit button
            document.addEventListener("click", function(e) {
                const editButton = e.target.closest(".edit-button");
                if (editButton) {
                    const taskId = editButton.dataset.taskId;
                    document.getElementById("edit_task_id").value = taskId;
                    document.getElementById("edit_title").value =
                        editButton.dataset.title || "";
                    document.getElementById("edit_priority").value =
                        editButton.dataset.priority || "";
                    document.getElementById("edit_start_date").value =
                        editButton.dataset.startDate || "";
                    document.getElementById("edit_due_date").value =
                        editButton.dataset.dueDate || "";
                    document.getElementById("edit_description").value =
                        editButton.dataset.description || "";
                    editTaskModal.classList.remove("hidden");
                    editTaskModal.classList.add("flex");
                }
            });

            // Submit form edit tugas
            document
                .getElementById("editTaskForm")
                .addEventListener("submit", function(e) {
                    e.preventDefault();
                    const taskId = document.getElementById("edit_task_id").value;
                    const formData = new FormData(this);
                    fetch(`/tasks/${taskId}`, {
                            method: "POST",
                            headers: {
                                Accept: "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": csrfToken,
                            },
                            body: formData,
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (!data.success) throw new Error("Failed to update task");
                            updateTaskInView(data.task);
                            editTaskModal.classList.add("hidden");
                            editTaskModal.classList.remove("flex");
                            attachDropdownListeners(); // Pastikan listener dropdown tetap aktif
                        })
                        .catch((error) => {
                            console.error("Error:", error);
                            alert("Failed to update task. Please check the form!");
                        });
                });

            // Fungsi untuk memperbarui tugas di tampilan
            function updateTaskInView(task) {
                const taskEl = document.getElementById(`task-${task.id}`);
                if (taskEl) {
                    const oldStatus = taskEl.dataset.status;
                    const newStatus = task.status;
                    const formattedDueDate = new Date(task.due_date).toLocaleDateString(
                        "en-GB", {
                            day: "2-digit",
                            month: "short",
                            year: "numeric",
                        }
                    );

                    let priorityCircle = "";
                    if (task.priority === "high")
                        priorityCircle =
                        '<span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>';
                    else if (task.priority === "medium")
                        priorityCircle =
                        '<span class="inline-block w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>';
                    else if (task.priority === "low")
                        priorityCircle =
                        '<span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>';

                    if (oldStatus !== newStatus) {
                        taskEl.remove();
                        addTaskToView(task);
                        updateTaskCount(oldStatus);
                        updateTaskCount(newStatus);
                    } else {
                        taskEl.innerHTML = `
                        <div class="absolute top-4 right-4 dropdown">
                            <button class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu hidden absolute right-0 mt-2 w-28 bg-white border rounded-md shadow-lg z-10">
                                <button class="edit-button w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                                    data-task-id="${task.id}" data-title="${task.title}"
                                    data-priority="${task.priority}"
                                    data-start-date="${
                                        task.start_date
                                            ? new Date(task.start_date)
                                                  .toISOString()
                                                  .split("T")[0]
                                            : ""
                                    }"
                                    data-due-date="${
                                        task.due_date
                                            ? new Date(task.due_date)
                                                  .toISOString()
                                                  .split("T")[0]
                                            : ""
                                    }"
                                    data-description="${task.description}">
                                    Edit
                                </button>
                                <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer"
                                    data-task-id="${task.id}">
                                    Remove
                                </div>
                            </div>
                        </div>
                        <h2 class="text-lg font-semibold mb-2 flex items-center">
                            ${priorityCircle}${task.title}
                        </h2>
                        <p class="text-gray-500 text-sm mb-4">${task.description}</p>
                        <div class="flex items-center justify-between text-gray-500 text-xs">
                            <div class="flex gap-x-3 items-center">
                                ${
                                    task.status === "todo" || task.status === "backlog"
                                        ? `<button onclick="changeTaskStatus(${task.id}, 'in_progress')" class="h-max w-max p-2 bg-blue-500 rounded-md text-white">Do The Task</button>`
                                        : task.status === "in_progress"
                                        ? `<button onclick="changeTaskStatus(${task.id}, 'completed')" class="h-max w-max p-2 bg-blue-500 rounded-md text-white">Mark Completed</button>`
                                        : ""
                                }
                            </div>
                            <div class="flex items-center">
                                <i class="fa-regular fa-clock mr-1"></i>
                                <span>${formattedDueDate}</span>
                            </div>
                        </div>
                    `;
                    }
                    updateTaskCount(oldStatus);
                }

                const taskRow = document.getElementById(`task-row-${task.id}`);
                if (taskRow) {
                    const oldStatus = taskRow.dataset.status;
                    if (oldStatus !== task.status) {
                        taskRow.remove();
                        const newRow = createTaskRow(task);
                        const newSection = document.getElementById(
                            `${task.status.replace("_", "")}Tasks`
                        );
                        if (newSection) newSection.appendChild(newRow);
                    } else {
                        const columns = taskRow.querySelectorAll(
                            ".col-span-1, .col-span-2"
                        );
                        columns[1].innerText = task.title;
                        columns[2].innerText = task.description;
                        columns[3].innerText = `${new Date(
                            task.start_date
                        ).toLocaleDateString("en-GB", {
                            day: "2-digit",
                            month: "short",
                            year: "numeric",
                        })} - ${new Date(task.due_date).toLocaleDateString("en-GB", {
                            day: "2-digit",
                            month: "short",
                            year: "numeric",
                        })}`;

                        const editButton = taskRow.querySelector(".edit-button");
                        if (editButton) {
                            editButton.dataset.taskId = task.id;
                            editButton.dataset.title = task.title;
                            editButton.dataset.priority = task.priority;
                            editButton.dataset.startDate = task.start_date ?
                                new Date(task.start_date).toISOString().split("T")[0] :
                                "";
                            editButton.dataset.dueDate = task.due_date ?
                                new Date(task.due_date).toISOString().split("T")[0] :
                                "";
                            editButton.dataset.description = task.description;
                        }
                    }
                    attachTaskCheckboxListeners(); // Reattach listener untuk checkbox
                }

                updateTimeline(task);
            }

            // Event listener untuk hapus tugas
            document.addEventListener("click", function(e) {
                if (e.target.classList.contains("remove-task")) {
                    const taskId = e.target.dataset.taskId;
                    const modal = document.getElementById("removeConfirmationModal");
                    modal.classList.remove("hidden");
                    modal.classList.add("flex");
                    document.getElementById("confirmRemoveModal").onclick =
                        function() {
                            fetch(`/tasks/${taskId}/deactivate`, {
                                    method: "PUT",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": csrfToken,
                                        Accept: "application/json",
                                    },
                                })
                                .then((response) => response.json())
                                .then((data) => {
                                    if (data.success) {
                                        const taskEl = document.getElementById(
                                            `task-${taskId}`
                                        );
                                        if (taskEl) {
                                            const status = taskEl.dataset.status;
                                            taskEl.remove();
                                            updateTaskCount(status);
                                        }
                                        const taskRow = document.getElementById(
                                            `task-row-${taskId}`
                                        );
                                        if (taskRow) taskRow.remove();
                                        const taskTimeline = document.querySelector(
                                            `.task-timeline[data-task-id="${taskId}"]`
                                        );
                                        if (taskTimeline) taskTimeline.remove();
                                    }
                                    modal.classList.add("hidden");
                                    modal.classList.remove("flex");
                                })
                                .catch((error) => {
                                    console.error("Error:", error);
                                    alert("Failed to remove task");
                                });
                        };
                    document.getElementById("cancelRemoveModal").onclick = function() {
                        modal.classList.add("hidden");
                        modal.classList.remove("flex");
                    };
                }
            });

            // Fungsi untuk mengubah status tugas dengan AJAX
            window.changeTaskStatus = function(taskId, newStatus) {
                const modal =
                    newStatus === "in_progress" ?
                    "confirmationModal" :
                    "confirmationModalCompleted";
                const modalElement = document.getElementById(modal);
                modalElement.classList.remove("hidden");
                modalElement.classList.add("flex");

                document.getElementById(
                    `confirmModal${newStatus === "in_progress" ? "" : "Completed"}`
                ).onclick = function() {
                    fetch(`/tasks/${taskId}/${newStatus}`, {
                            method: "PUT",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": csrfToken,
                                Accept: "application/json",
                            },
                            body: JSON.stringify({
                                status: newStatus
                            })
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                // Auto refresh halaman setelah update status
                                location.reload();
                            }
                            modalElement.classList.add("hidden");
                            modalElement.classList.remove("flex");
                        })
                        .catch((error) => {
                            console.error("Error:", error);
                            alert("Failed to change task status");
                        });
                };

                document.getElementById(
                    `cancelModal${newStatus === "in_progress" ? "" : "Completed"}`
                ).onclick = function() {
                    modalElement.classList.add("hidden");
                    modalElement.classList.remove("flex");
                };
            };

            // Fungsi untuk menangani klik checkbox di Task List
            function attachTaskCheckboxListeners() {
                document.querySelectorAll(".task-checkbox").forEach((checkbox) => {
                    checkbox.removeEventListener("change",
                        handleCheckboxChange); // Hindari duplikat listener
                    checkbox.addEventListener("change", handleCheckboxChange);
                });
            }

            function handleCheckboxChange(e) {
                const checkbox = e.target;
                const taskId = checkbox.dataset.taskId;
                const taskRow = document.getElementById(`task-row-${taskId}`);
                const currentStatus = taskRow.dataset.status;

                let newStatus;
                if (currentStatus === "to do" || currentStatus === "backlog") {
                    newStatus = "in_progress";
                } else if (currentStatus === "in_progress") {
                    newStatus = "completed";
                } else {
                    checkbox.checked = true; // Kembalikan ke checked jika status completed
                    return;
                }

                changeTaskStatus(taskId, newStatus);
            }

            // Fungsi untuk memperbarui jumlah tugas
            function updateTaskCount(status) {
                const column = document.getElementById(`${status}Column`);
                if (column) {
                    const countEl = column.querySelector(".w-5.h-5");
                    const tasks = column.querySelectorAll(".task-card").length;
                    countEl.innerText = tasks;
                }
            }

            // Fungsi untuk memperbarui Timeline
            function updateTimeline(task) {
                const timelineSection = document.getElementById(
                    `timeline-${task.status.replace("_", "")}`
                );
                if (!timelineSection) return;

                const existingTask = document.querySelector(
                    `.task-timeline[data-task-id="${task.id}"]`
                );
                if (existingTask) existingTask.remove();

                const start = new Date(
                    "{{ $minStartDate ? $minStartDate : \Carbon\Carbon::now()->toDateString() }}");

                const taskStart = new Date(task.start_date);
                const taskEnd = new Date(task.due_date);
                const leftOffset = start.diffInDays ?
                    start.diffInDays(taskStart) * 50 :
                    0;
                const width = Math.max(
                    taskEnd.diffInDays ? taskEnd.diffInDays(taskStart) * 50 + 50 : 50,
                    50
                );

                const colors = {
                    todo: "purple",
                    in_progress: "pink",
                    completed: "blue",
                    backlog: "green",
                };

                const taskEl = document.createElement("div");
                taskEl.className = "flex min-w-max task-timeline";
                taskEl.dataset.taskId = task.id;
                taskEl.innerHTML = `
                <div class="h-14 bg-${colors[task.status]}-100 text-${
                    colors[task.status]
                }-800 rounded-lg relative transition-all duration-300 ease-in-out hover:shadow-md"
                    style="width: ${width}px; margin-left: ${leftOffset}px;">
                    <div class="absolute inset-0 flex items-center">
                        <span class="text-sm font-medium truncate ml-4">${task.title}</span>
                    </div>
                </div>
            `;
                timelineSection.appendChild(taskEl);
            }

            // Fungsi untuk menambahkan event listener ke dropdown
            function attachDropdownListeners() {
                document.querySelectorAll(".dropdown-toggle").forEach((button) => {
                    button.removeEventListener("click", toggleDropdown);
                    button.addEventListener("click", toggleDropdown);
                });
            }

            function toggleDropdown(e) {
                e.stopPropagation();
                const dropdown =
                    this.closest(".dropdown").querySelector(".dropdown-menu");
                dropdown.classList.toggle("hidden");
            }

            // Inisialisasi listener dropdown dan checkbox
            attachDropdownListeners();
            attachTaskCheckboxListeners();

            // Tutup dropdown saat klik di luar
            document.addEventListener("click", function(e) {
                if (!e.target.closest(".dropdown")) {
                    document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                        if (!menu.classList.contains("hidden"))
                            menu.classList.add("hidden");
                    });
                }
            });
        });

        // Polyfill untuk diffInDays jika tidak ada
        if (!Date.prototype.diffInDays) {
            Date.prototype.diffInDays = function(otherDate) {
                const diffMs = this - otherDate;
                return Math.floor(diffMs / (1000 * 60 * 60 * 24));
            };
        }
    </script>
    <script src="{{ asset('assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/slide-animation.js') }}"></script>
    <script src="{{ asset('assets/js/desc.js') }}"></script>
@endsection
