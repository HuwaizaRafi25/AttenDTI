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
                                    <input type="hidden" id="task_id" name="task_id">
                                    <div>
                                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                            Title <span class="text-red-700">*</span>
                                        </label>
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
                                            Due Date
                                        </label>
                                        <input type="date" id="due_date" name="due_date"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-4">Task Description</h2>
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                        Description
                                    </label>
                                    <textarea id="description" name="description" rows="4"
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

        <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-[50] items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-4xl mx-4 relative h-[90vh] flex flex-col">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Create Task</h2>
                <div class="overflow-y-auto flex-grow">
                    <form id="createTaskForm" method="POST" action="{{ route('tasks.store') }}"
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
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm
              focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">
                                            Due Date
                                            <!-- <span class="text-red-700">*</span> -->
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
                                <button type="button" id="backButton"
                                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300
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


        <div class="relative overflow-x-hidden h-[100vh] w-full md:h-[468px] sm:h-screen" id="contentContainer1">
            <div class="flex w-full transition-transform duration-500" id="contentContainer">
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
                                <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4"
                                    id="task-{{ $task->id }}">
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

                                            <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
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
                                            <form id="update-task-{{ $task->id }}"
                                                action="{{ route('tasks.in_progress', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="in_progress">
                                                <button type="button"
                                                    onclick="openConfirmationModal({{ $task->id }})"
                                                    class="h-max w-max p-2 bg-blue-500 rounded-md text-white">
                                                    Do The Task
                                                </button>
                                            </form>
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
                                <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4"
                                    id="task-{{ $task->id }}">
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

                                            <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
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
                                            <form id="complete-task-{{ $task->id }}"
                                                action="{{ route('tasks.completed', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="completed">
                                                <div class="h-max w-max p-2 bg-blue-500 rounded-md text-white cursor-pointer"
                                                    onclick="openConfirmationModalCompleted({{ $task->id }})">
                                                    Mark Completed
                                                </div>
                                            </form>
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
                                <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4"
                                    id="task-{{ $task->id }}">
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

                                            <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
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
                                            {{-- Tidak ada aksi untuk update di kolom ini --}}
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
                                <div class="w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4"
                                    id="task-{{ $task->id }}">
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

                                            <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
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
                                            <form id="update-task-{{ $task->id }}"
                                                action="{{ route('tasks.in_progress', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="in_progress">
                                                <button type="button"
                                                    onclick="openConfirmationModal({{ $task->id }})"
                                                    class="h-max w-max p-2 bg-blue-500 rounded-md text-white">
                                                    Do The Task
                                                </button>
                                            </form>
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
                    <div class="grid grid-cols-1 gap-4" id="taskListGrid">
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
                                    <i class="fa-solid fa-plus mr-2"></i> New Task
                                </button>
                            </div>

                            <div class="space-y-4">
                                <div class="w-full overflow-x-auto">
                                    <div class="min-w-max space-y-4">
                                        @foreach (['To Do' => $todoTasks, 'In Progress' => $inProgressTasks, 'Completed' => $completedTasks, 'Backlog' => $backlogTasks] as $section => $tasks)
                                            <div class="border rounded-lg">
                                                <div class="flex items-center justify-between p-4 bg-gray-100 rounded-t-lg cursor-pointer"
                                                    id="{{ strtolower(str_replace(' ', '', $section)) }}Dropdown">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-chevron-down w-4 h-4 mr-2"></i>
                                                        <h3 class="font-medium">{{ $section }}</h3>
                                                        <span
                                                            class="ml-2 px-2 py-1 text-xs font-medium bg-gray-200 rounded-full">{{ $tasks->count() }}</span>
                                                    </div>
                                                </div>

                                                <div id="{{ strtolower(str_replace(' ', '', $section)) }}Tasks"
                                                    class="divide-y divide-gray-200">
                                                    <div
                                                        class="grid grid-cols-6 gap-4 py-2 px-4 text-sm font-medium text-gray-600 bg-gray-50">
                                                        <div class="col-span-1 text-center">Status</div>
                                                        <div class="col-span-1 text-center">Task Name</div>
                                                        <div class="col-span-2 text-center">Description</div>
                                                        <div class="col-span-1 text-center">Estimation</div>
                                                        <div class="col-span-1 text-center">Action</div>
                                                    </div>

                                                    @forelse ($tasks as $task)
                                                        <div class="grid grid-cols-6 gap-4 py-4 px-4 items-center text-sm">
                                                            <div class="col-span-1 text-center">
                                                                <input type="checkbox" class="w-4 h-4"
                                                                    @if ($section === 'Completed') checked disabled @endif>
                                                            </div>
                                                            <div class="col-span-1 text-center font-medium truncate">
                                                                {{ $task->title }}</div>
                                                            <div class="col-span-2 text-center truncate">
                                                                {{ $task->description }}</div>
                                                            <div class="col-span-1 text-center truncate">
                                                                {{ \Carbon\Carbon::parse($task->start_date)->format('d M Y') }}
                                                                -
                                                                {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                                                            </div>
                                                            <div class="col-span-1 text-center">
                                                                <button class="text-gray-400 hover:text-gray-600">
                                                                    <i class="fas fa-ellipsis-h"></i>
                                                                </button>
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
                <div class="w-[99%] ml-1 opacity-0 absolute translate-x-[100%] transition-all duration-500 ease-in-out transform hidden"
                    id="timeLine">
                    <div class="grid grid-cols-1 gap-4" id="timeLineGrid">
                        <div class="min-h-screen p-8">
                            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-center mb-8 sticky top-0 bg-white z-10">
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
                                                    $dayWidth = 50; // Width per day in pixels
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

                                            <div class="space-y-6">
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
                                                        <div class="space-y-4">
                                                            @foreach ($tasks as $task)
                                                                <div class="flex min-w-max">
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
            const backButton = document.getElementById('backButton');
            const taskForm = document.getElementById('taskForm');
            const validationWarnings = document.getElementById('validationWarnings');

            openModalBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    taskModal.classList.remove('hidden');
                    taskModal.classList.add('flex');
                });
            });

            taskModal.addEventListener('click', function(e) {
                if (e.target === this || e.target === backButton) {
                    taskModal.classList.add('hidden');
                    taskModal.classList.remove('flex');
                }
            });

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

            if (taskForm) {
                taskForm.addEventListener('submit', function(e) {
                    if (!validateTaskForm()) {
                        e.preventDefault();
                        validationWarnings.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            }

            ['title', 'due_date', 'description'].forEach(function(fieldId) {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('input', validateTaskForm);
                }
            });

            // Mengatur input start_date dengan tanggal saat ini dan membatasi pilihan tanggal
            const startDateInput = document.getElementById('start_date');
            if (startDateInput) {
                const today = new Date();
                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0');
                const minDate = `${year}-${month}-${day}`;

                // Mengatur nilai awal dan atribut min
                startDateInput.value = minDate;
                startDateInput.setAttribute('min', minDate);
            }

            // Mengatur input due_date agar tidak bisa memilih tanggal sebelum hari ini
            const dueDateInput = document.getElementById('due_date');
            if (dueDateInput) {
                dueDateInput.setAttribute('min', startDateInput.value);
            }
        });
    </script>

    <script>
        document.getElementById('createTaskForm').addEventListener('submit', function(e) {
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

                    let priorityCircle = '';
                    if (newTask.priority === 'high') {
                        priorityCircle =
                            `<span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>`;
                    } else if (newTask.priority === 'medium') {
                        priorityCircle =
                            `<span class="inline-block w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>`;
                    } else if (newTask.priority === 'low') {
                        priorityCircle =
                            `<span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>`;
                    }

                    const newTaskEl = document.createElement('div');
                    newTaskEl.className = "w-full h-max shadow-md bg-white rounded-md mt-2 relative p-4";
                    newTaskEl.innerHTML = `
                    <div class="absolute top-4 right-4">
                        <button class="dropdown-toggle text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        @foreach ($todoTasks as $task)
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

                                            <div class="remove-task block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                                                data-task-id="{{ $task->id }}">
                                                Remove
                                            </div>
                                        </div>
@endforeach

                    </div>
                    <h2 class="text-lg font-semibold mb-2 flex items-center">
                        ${priorityCircle}${newTask.title}
                    </h2>
                    <p class="text-gray-500 text-sm mb-4">${newTask.description}</p>
                    <div class="flex items-center justify-between text-gray-500 text-xs">
                        <div class="flex gap-x-3 items-center">
                            <button class="h-max w-max p-2 bg-blue-500 rounded-md text-white">
                                Do The Task
                            </button>
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
        document.querySelectorAll('.dropdown-toggle').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.closest('.dropdown').querySelector('.dropdown-menu');
                dropdown.classList.toggle('hidden');
            });
        });

        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                }
            });
        });

        let currentFormId = null;

        function openConfirmationModal(taskId) {
            currentFormId = "update-task-" + taskId;
            document.getElementById("confirmationModal").classList.remove("hidden");
            document.getElementById("confirmationModal").classList.add("flex");
        }

        document.getElementById("cancelModal").addEventListener("click", function() {
            document.getElementById("confirmationModal").classList.add("hidden");
            document.getElementById("confirmationModal").classList.remove("flex");
            currentFormId = null;
        });

        document.getElementById("confirmModal").addEventListener("click", function() {
            if (currentFormId) {
                document.getElementById(currentFormId).submit();
            }
        });

        let currentCompleteFormId = null;

        function openConfirmationModalCompleted(taskId) {
            currentCompleteFormId = "complete-task-" + taskId;
            document.getElementById("confirmationModalCompleted").classList.remove("hidden");
            document.getElementById("confirmationModalCompleted").classList.add("flex");
        }

        document.getElementById("cancelModalCompleted").addEventListener("click", function() {
            document.getElementById("confirmationModalCompleted").classList.add("hidden");
            document.getElementById("confirmationModalCompleted").classList.remove("flex");
            currentCompleteFormId = null;
        });

        document.getElementById("confirmModalCompleted").addEventListener("click", function() {
            if (currentCompleteFormId) {
                document.getElementById(currentCompleteFormId).submit();
            }
        });

        let taskIdToRemove = null;

        document.querySelectorAll('.remove-task').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                taskIdToRemove = this.dataset.taskId;
                document.getElementById('removeConfirmationModal').classList.remove('hidden');
                document.getElementById('removeConfirmationModal').classList.add('flex');
            });
        });

        document.getElementById('cancelRemoveModal').addEventListener('click', function() {
            document.getElementById('removeConfirmationModal').classList.add('hidden');
            document.getElementById('removeConfirmationModal').classList.remove('flex');
            taskIdToRemove = null;
        });

        document.getElementById('confirmRemoveModal').addEventListener('click', function() {
            if (taskIdToRemove) {
                const url = `/tasks/${taskIdToRemove}/deactivate`;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                fetch(url, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const taskElement = document.getElementById(`task-${taskIdToRemove}`);
                            if (taskElement) {
                                taskElement.remove();
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to remove task');
                    })
                    .finally(() => {
                        document.getElementById('removeConfirmationModal').classList.add('hidden');
                        document.getElementById('removeConfirmationModal').classList.remove('flex');
                        taskIdToRemove = null;
                    });
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("editTaskForm");
            const modal = document.getElementById("edittaskmodal");
            const cancelButton = document.getElementById("cancelEdit");

            document.querySelectorAll(".edit-button").forEach(button => {
                button.addEventListener("click", function() {
                    const taskId = this.dataset.taskId;
                    form.setAttribute("action", `/tasks/${taskId}`);

                    document.getElementById("task_id").value = taskId;
                    document.getElementById("title").value = this.dataset.title || "";
                    document.getElementById("priority").value = this.dataset.priority || "";
                    document.getElementById("start_date").value = this.dataset.startDate || "";
                    document.getElementById("due_date").value = this.dataset.dueDate || "";
                    document.getElementById("description").value = this.dataset.description || "";

                    if (modal) {
                        modal.classList.remove("hidden");
                        modal.classList.add("flex");
                    }
                });
            });

            if (cancelButton && modal) {
                cancelButton.addEventListener("click", function() {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                });
            }

            form.addEventListener("submit", function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch(this.action, {
                        method: "POST",
                        headers: {
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
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
                        if (modal) {
                            modal.classList.add("hidden");
                            modal.classList.remove("flex");
                        }

                        const taskElement = document.getElementById(`task-${data.task.id}`);
                        if (taskElement) {
                            taskElement.querySelector("h2").innerText = data.task
                                .title;
                            taskElement.querySelector("p").innerText = data.task
                                .description;
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Gagal memperbarui tugas. Silakan cek form.");
                    });
            });
        });
    </script>


    <script src="{{ asset('assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/slide-animation.js') }}"></script>
    <script src="{{ asset('assets/js/desc.js') }}"></script>
@endsection
