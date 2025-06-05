@extends('layouts.app')
@section('content')
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: scale(1);
            }

            to {
                opacity: 0;
                transform: scale(0.95);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.2s ease-out forwards;
        }

        .animate-fadeOut {
            animation: fadeOut 0.2s ease-in forwards;
        }

        .animate-slideDown {
            animation: slideDown 0.3s ease-out forwards;
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .group:hover .group-hover\:opacity-100 {
            opacity: 1;
        }

        .group:hover .group-hover\:brightness-75 {
            filter: brightness(0.75);
        }

        .group:hover .group-hover\:brightness-90 {
            filter: brightness(0.9);
        }

        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }

        .category-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .category-btn.scale-105 {
            transform: scale(1.05);
        }

        #imagePreview:hover,
        #editImagePreview:hover {
            transform: scale(1.02);
        }

        #cancelImageBtn:hover,
        #editCancelImageBtn:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        #imageModal {
            backdrop-filter: blur(4px);
            transition: all 0.3s ease-in-out;
        }

        #imageModal .max-w-4xl {
            transition: transform 0.3s ease-out;
        }

        #imageModal.animate-fadeIn .max-w-4xl {
            transform: scale(1);
        }

        #imageModal.animate-fadeOut .max-w-4xl {
            transform: scale(0.95);
        }

        .announcement-image-container:hover img {
            transform: scale(1.02);
        }

        img[loading="lazy"] {
            transition: opacity 0.3s ease-in-out;
        }

        .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        #modalImage {
            transition: transform 0.3s ease-in-out;
            cursor: zoom-in;
        }

        #modalImage:hover {
            transform: scale(1.05);
        }
    </style>

    <!-- Success Message -->
    @if (session('success'))
        <div class="fixed z-50 p-4 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg shadow-lg top-4 right-4"
            role="alert">
            <div class="flex items-center">
                <i class="mr-2 fas fa-check-circle"></i>
                <span class="font-medium">{{ session('success') }}</span>
                <button type="button" class="ml-auto text-green-800 hover:text-green-900"
                    onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="fixed z-50 p-4 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded-lg shadow-lg top-4 right-4"
            role="alert">
            <div class="flex items-center">
                <i class="mr-2 fas fa-exclamation-circle"></i>
                <div>
                    <span class="font-medium">Please fix the following errors:</span>
                    <ul class="mt-1 ml-4 list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="ml-auto text-red-800 hover:text-red-900"
                    onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <div class="min-h-screen">
        <div class="container px-4 py-8 mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col items-start justify-between space-y-4 sm:flex-row sm:items-center sm:space-y-0">
                    <div>
                        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Announcements</h1>
                        <p class="mt-1 text-sm text-gray-500">Stay updated with the latest company news and updates</p>
                    </div>

                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">
                <!-- Left Sidebar - Categories -->
                <div class="lg:col-span-3">
                    <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-lg font-semibold text-gray-900">Categories</h2>
                                @if (Auth::check() && Auth::user()->role === 'admin')
                                    <button
                                        class="inline-flex items-center text-sm font-medium text-blue-600 transition-colors hover:text-blue-700">
                                        <i class="mr-1 fas fa-plus-circle"></i>
                                        Add New
                                    </button>
                                @endif
                            </div>
                            <nav>
                                <ul class="space-y-2">
                                    <li>
                                        <a href="#" data-category-id="all"
                                            class="category-link flex items-center px-3 py-2.5 text-sm font-medium text-blue-700 bg-blue-50 rounded-lg transition-all duration-200 hover:bg-blue-100">
                                            <i
                                                class="flex items-center justify-center w-6 h-6 mr-3 text-blue-600 bg-blue-100 rounded-md fas fa-bullhorn"></i>
                                            All Announcements
                                        </a>
                                    </li>
                                    @php
                                        $icons = [
                                            'General' => 'fa-globe',
                                            'Training' => 'fa-book-open',
                                            'Policy Updates' => 'fa-file-alt',
                                            'New Hire' => 'fa-user-plus',
                                        ];
                                        $colors = [
                                            'General' => 'text-green-600 bg-green-100',
                                            'Training' => 'text-purple-600 bg-purple-100',
                                            'Policy Updates' => 'text-orange-600 bg-orange-100',
                                            'New Hire' => 'text-blue-600 bg-blue-100',
                                        ];
                                    @endphp
                                    @foreach ($categories as $category)
                                        @php
                                            $icon = $icons[$category->category_name] ?? 'fa-tag';
                                            $color = $colors[$category->category_name] ?? 'text-gray-600 bg-gray-100';
                                        @endphp
                                        <li>
                                            <a href="#" data-category-id="{{ $category->id }}"
                                                class="category-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 transition-all duration-200 rounded-lg hover:bg-gray-50 hover:text-gray-900">
                                                <i
                                                    class="flex items-center justify-center w-6 h-6 mr-3 rounded-md fas {{ $icon }} {{ $color }}"></i>
                                                {{ $category->category_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Announcement Section -->
                <div class="lg:col-span-6">
                    <div class="space-y-6" id="announcementContainer">
                        <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                            <div class="p-6">
                                <div class="flex items-start space-x-4">
                                    <img src="{{ asset('assets/images/userPlaceHolder.png') }}"
                                        class="object-cover w-12 h-12 bg-gray-200 rounded-full ring-2 ring-gray-100"
                                        alt="User avatar">
                                    <div class="flex-1">
                                        <button id="announcementButton"
                                            class="w-full p-4 text-left text-gray-500 transition-all duration-200 border border-gray-200 rounded-lg open-create-modal-trigger bg-gray-50 hover:bg-gray-100 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            What's on your mind? Share an announcement...
                                        </button>
                                        <div class="flex items-center mt-4 space-x-6">
                                            <button
                                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 transition-colors bg-white border border-gray-200 rounded-lg open-create-modal-trigger hover:text-blue-600 hover:border-blue-300 hover:bg-blue-50">
                                                <i class="mr-2 text-green-500 fas fa-image"></i>
                                                Photo
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Announcements will be dynamically loaded here -->
                        @foreach ($announcements as $announcement)
                            <div class="mb-6 overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                                <div class="p-6">
                                    <div class="flex items-start justify-between">
                                        <div class="flex space-x-4">
                                            <img src="{{ $announcement->user->profile_pic ? asset('storage/' . $announcement->user->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                                                class="object-cover w-12 h-12 bg-gray-200 rounded-full ring-2 ring-gray-100"
                                                alt="User avatar">
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2">
                                                    <h3 class="font-semibold text-gray-900">
                                                        {{ $announcement->user->username }}
                                                    </h3>
                                                    <span class="text-gray-400">•</span>
                                                    <span
                                                        class="text-sm text-gray-500">{{ $announcement->user->role ?? 'User' }}</span>
                                                </div>
                                                <p class="text-sm text-gray-500">
                                                    {{ $announcement->created_at->format('M d, h:i a') }}</p>
                                                <div class="mt-3">
                                                    @php
                                                        $category = $announcement->category;
                                                        $categoryId = $announcement->announcement_category_id;
                                                        switch ($categoryId) {
                                                            case 1:
                                                                $icon = 'fas fa-globe';
                                                                $bgColor = 'bg-green-100';
                                                                $textColor = 'text-green-700';
                                                                break;
                                                            case 2:
                                                                $icon = 'fas fa-book-open';
                                                                $bgColor = 'bg-purple-100';
                                                                $textColor = 'text-purple-700';
                                                                break;
                                                            case 3:
                                                                $icon = 'fas fa-file-alt';
                                                                $bgColor = 'bg-orange-100';
                                                                $textColor = 'text-orange-700';
                                                                break;
                                                            default:
                                                                $icon = 'fas fa-user-plus';
                                                                $bgColor = 'bg-blue-100';
                                                                $textColor = 'text-blue-700';
                                                                break;
                                                        }
                                                    @endphp
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium {{ $textColor }} {{ $bgColor }} rounded-full">
                                                        <i class="w-3 h-3 mr-1 {{ $icon }}"></i>
                                                        {{ $category->category_name ?? 'Tanpa Kategori' }}
                                                    </span>
                                                </div>
                                                <div class="mt-4">
                                                    <h4 class="text-lg font-semibold text-gray-900">
                                                        {{ $announcement->title }}</h4>
                                                    <p class="mt-2 text-gray-700">{{ $announcement->text }}</p>

                                                    {{-- Enhanced Image Display Section --}}
                                                    @if ($announcement->image)
                                                        <div class="mt-4">
                                                            <div class="relative inline-block group">
                                                                <img src="{{ asset('storage/' . $announcement->image) }}"
                                                                    class="object-cover w-full transition-all duration-300 rounded-lg shadow-md max-h-96 hover:shadow-lg"
                                                                    alt="Announcement image" loading="lazy"
                                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                                                {{-- Fallback if image fails to load --}}
                                                                <div
                                                                    class="items-center justify-center hidden w-full h-48 bg-gray-100 rounded-lg">
                                                                    <div class="text-center text-gray-500">
                                                                        <i class="mb-2 text-3xl fas fa-image"></i>
                                                                        <p class="text-sm">Image not available</p>
                                                                    </div>
                                                                </div>

                                                                {{-- Image overlay with zoom icon --}}
                                                                <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-0 rounded-lg opacity-0 cursor-pointer group-hover:bg-opacity-30 group-hover:opacity-100"
                                                                    onclick="openImageModal('{{ asset('storage/' . $announcement->image) }}', '{{ $announcement->title }}')">
                                                                    <div
                                                                        class="text-white transition-transform duration-300 transform scale-0 group-hover:scale-100">
                                                                        <i class="text-2xl fas fa-search-plus"></i>
                                                                        <p class="mt-1 text-sm">Click to enlarge</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif ($announcement->image_path)
                                                        {{-- Alternative field name check --}}
                                                        <div class="mt-4">
                                                            <div class="relative inline-block group">
                                                                <img src="{{ asset('storage/' . $announcement->image_path) }}"
                                                                    class="object-cover w-full transition-all duration-300 rounded-lg shadow-md max-h-96 hover:shadow-lg"
                                                                    alt="Announcement image" loading="lazy"
                                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                                                <div
                                                                    class="items-center justify-center hidden w-full h-48 bg-gray-100 rounded-lg">
                                                                    <div class="text-center text-gray-500">
                                                                        <i class="mb-2 text-3xl fas fa-image"></i>
                                                                        <p class="text-sm">Image not available</p>
                                                                    </div>
                                                                </div>

                                                                <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-0 rounded-lg opacity-0 cursor-pointer group-hover:bg-opacity-30 group-hover:opacity-100"
                                                                    onclick="openImageModal('{{ asset('storage/' . $announcement->image_path) }}', '{{ $announcement->title }}')">
                                                                    <div
                                                                        class="text-white transition-transform duration-300 transform scale-0 group-hover:scale-100">
                                                                        <i class="text-2xl fas fa-search-plus"></i>
                                                                        <p class="mt-1 text-sm">Click to enlarge</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <form action="{{ route('announcements.pin', $announcement->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="p-2 text-gray-400 transition-colors rounded-lg hover:text-yellow-500 hover:bg-yellow-50">
                                                    <i class="fas fa-thumbtack"></i>
                                                </button>
                                            </form>
                                            <div class="relative group">
                                                <button
                                                    class="p-2 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-50">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div
                                                    class="absolute right-0 z-10 hidden w-48 p-2 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg group-hover:block">
                                                    <ul class="space-y-1">
                                                        <li>
                                                            <button
                                                                onclick="openEditModal({{ $announcement->id }}, '{{ addslashes($announcement->title) }}', '{{ addslashes($announcement->text) }}', {{ $announcement->announcement_category_id }}, '{{ $announcement->image ?? ($announcement->image_path ?? '') }}')"
                                                                class="flex items-center w-full px-3 py-2 text-sm text-gray-700 rounded-md hover:bg-gray-100">
                                                                <i class="w-4 h-4 mr-2 fas fa-edit"></i> Edit
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <form
                                                                action="{{ route('announcements.destroy', $announcement->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this announcement?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="flex items-center w-full px-3 py-2 text-sm text-red-600 rounded-md hover:bg-red-50">
                                                                    <i class="w-4 h-4 mr-2 fas fa-trash-alt"></i> Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-4 mt-6 border-t border-gray-100">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-6">
                                                <button
                                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 transition-colors bg-white border border-gray-200 rounded-lg hover:text-blue-600 hover:border-blue-300 hover:bg-blue-50">
                                                    <i class="mr-2 fas fa-share"></i>
                                                    Share
                                                </button>
                                            </div>
                                            <a href="{{ route('announcements.show', $announcement->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 transition-colors bg-white border border-blue-200 rounded-lg hover:text-blue-700 hover:bg-blue-50">
                                                View Full Post <i class="ml-1 fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Image Modal -->
                <div id="imageModal"
                    class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-75 backdrop-blur-sm">
                    <div class="relative max-w-4xl max-h-screen p-4 mx-auto">
                        <button onclick="closeImageModal()"
                            class="absolute z-10 flex items-center justify-center w-10 h-10 text-white transition-all duration-200 bg-black bg-opacity-50 rounded-full top-4 right-4 hover:bg-opacity-75">
                            <i class="fas fa-times"></i>
                        </button>
                        <img id="modalImage" src="/placeholder.svg" alt=""
                            class="max-w-full max-h-full rounded-lg shadow-2xl">
                        <div class="mt-4 text-center">
                            <h3 id="modalTitle" class="text-lg font-semibold text-white"></h3>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar - Pinned Announcements -->
                <div class="lg:col-span-3">
                    <div class="sticky top-6">
                        <div class="bg-white border border-gray-200 shadow-sm rounded-xl">
                            <div class="p-6">
                                <h3 class="mb-6 text-lg font-semibold text-gray-900">Pinned Announcements</h3>
                                <div class="space-y-4">
                                    @forelse ($pinned as $pin)
                                        @php
                                            $announcement = $pin->announcement;
                                            $user = $announcement->user;
                                            $category = $announcement->category;
                                            $categoryId = $announcement->announcement_category_id;

                                            // Dynamic category styling
                                            switch ($categoryId) {
                                                case 1:
                                                    $categoryIcon = 'fas fa-globe';
                                                    $categoryBgColor = 'bg-green-100';
                                                    $categoryTextColor = 'text-green-700';
                                                    $cardGradient = 'from-green-50 to-emerald-50';
                                                    $borderColor = 'border-green-200';
                                                    break;
                                                case 2:
                                                    $categoryIcon = 'fas fa-book-open';
                                                    $categoryBgColor = 'bg-purple-100';
                                                    $categoryTextColor = 'text-purple-700';
                                                    $cardGradient = 'from-purple-50 to-violet-50';
                                                    $borderColor = 'border-purple-200';
                                                    break;
                                                case 3:
                                                    $categoryIcon = 'fas fa-file-alt';
                                                    $categoryBgColor = 'bg-orange-100';
                                                    $categoryTextColor = 'text-orange-700';
                                                    $cardGradient = 'from-orange-50 to-amber-50';
                                                    $borderColor = 'border-orange-200';
                                                    break;
                                                case 4:
                                                    $categoryIcon = 'fas fa-user-plus';
                                                    $categoryBgColor = 'bg-blue-100';
                                                    $categoryTextColor = 'text-blue-700';
                                                    $cardGradient = 'from-blue-50 to-indigo-50';
                                                    $borderColor = 'border-blue-200';
                                                    break;
                                                default:
                                                    $categoryIcon = 'fas fa-tag';
                                                    $categoryBgColor = 'bg-gray-100';
                                                    $categoryTextColor = 'text-gray-700';
                                                    $cardGradient = 'from-gray-50 to-slate-50';
                                                    $borderColor = 'border-gray-200';
                                                    break;
                                            }

                                            // Truncate long text
                                            $truncatedText = Str::limit($announcement->text, 80, '...');
                                            $truncatedTitle = Str::limit($announcement->title, 40, '...');
                                        @endphp

                                        <div
                                            class="p-4 border {{ $borderColor }} rounded-lg bg-gradient-to-r {{ $cardGradient }} hover:shadow-md transition-all duration-200">
                                            <!-- Header with user info and pinned badge -->
                                            <div class="flex items-start justify-between mb-3">
                                                <div class="flex items-center flex-1 min-w-0 space-x-2">
                                                    <img src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                                                        class="flex-shrink-0 object-cover w-8 h-8 bg-gray-200 rounded-full ring-2 ring-white"
                                                        alt="{{ $user->username ?? 'User' }} avatar"
                                                        onerror="this.src='{{ asset('assets/images/userPlaceHolder.png') }}'">
                                                    <h4 class="text-sm font-semibold text-gray-900 truncate">
                                                        {{ $user->username ?? 'Unknown User' }}
                                                    </h4>
                                                </div>
                                                <form action="{{ route('announcements.pin', $announcement->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center flex-shrink-0 px-2 py-1 ml-2 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full hover:bg-yellow-200">
                                                        <i class="w-3 h-3 mr-1 fas fa-thumbtack"></i>
                                                        Pinned
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Category badge -->
                                            <div class="mb-3">
                                                <span
                                                    class="inline-flex items-center px-2 py-1 text-xs font-medium {{ $categoryTextColor }} {{ $categoryBgColor }} rounded-full">
                                                    <i class="w-3 h-3 mr-1 {{ $categoryIcon }}"></i>
                                                    {{ $category->category_name ?? 'No Category' }}
                                                </span>
                                            </div>

                                            <!-- Content -->
                                            <div class="space-y-2">
                                                <h5 class="font-semibold leading-tight text-gray-900"
                                                    title="{{ $announcement->title }}">
                                                    {{ $truncatedTitle }}
                                                </h5>
                                                <p class="text-sm leading-relaxed text-gray-600"
                                                    title="{{ $announcement->text }}">
                                                    {{ $truncatedText }}
                                                </p>
                                            </div>

                                            <!-- Footer with timestamp and action -->
                                            <div
                                                class="flex items-center justify-between pt-3 mt-4 border-t border-gray-200/50">
                                                <span class="text-xs text-gray-500">
                                                    {{ $announcement->created_at->diffForHumans() }}
                                                </span>
                                                <a href="{{ route('announcements.show', $announcement->id) }}"
                                                    class="inline-flex items-center text-sm font-medium text-blue-600 transition-colors hover:text-blue-700 hover:underline">
                                                    View Post
                                                    <i class="ml-1 text-xs fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-6 text-center border border-gray-200 rounded-lg bg-gray-50">
                                            <form action="{{ route('announcements.pin', $announcement->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="p-2 text-gray-400 transition-colors rounded-lg hover:text-yellow-500 hover:bg-yellow-50">
                                                    <i class="fas fa-thumbtack"></i>
                                                </button>
                                            </form>
                                            <p class="text-sm font-medium text-gray-500">No pinned announcements</p>
                                            <p class="mt-1 text-xs text-gray-400">Pin important announcements to see them
                                                here</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CREATE MODAL -->
    <div id="createModal"
        class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50 backdrop-blur-sm">
        <div class="relative w-full max-w-lg mx-4 overflow-hidden bg-white shadow-2xl rounded-2xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Create Announcement</h2>
                    <button id="closeCreateModalBtn"
                        class="p-2 text-gray-400 transition-colors rounded-full hover:text-gray-600 hover:bg-gray-100">
                        <i class="text-xl fas fa-times"></i>
                    </button>
                </div>

                <form id="createAnnouncementForm" method="POST" action="{{ route('announcements.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6 space-y-4">
                        <div>
                            <label for="createTitle" class="block mb-1 text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="createTitle"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Announcement Title" required>
                        </div>
                        <div>
                            <label for="createMessage"
                                class="block mb-1 text-sm font-medium text-gray-700">Message</label>
                            <textarea id="createMessage" name="text" rows="5"
                                class="w-full p-4 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Share your announcement with the team..." required></textarea>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <button type="button" id="createAddPhotoBtn"
                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 transition-colors bg-white border border-gray-200 rounded-lg hover:text-green-600 hover:border-green-300 hover:bg-green-50">
                                        <i class="mr-2 text-green-500 fas fa-image"></i>
                                        Add Photo
                                    </button>
                                    <input type="file" id="createImageInput" name="image_path" accept="image/*"
                                        class="hidden">
                                </div>
                                <button type="button" id="createAddCategoryBtn"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 transition-colors bg-white border border-gray-200 rounded-lg hover:text-purple-600 hover:border-purple-300 hover:bg-purple-50">
                                    <i class="mr-2 text-purple-500 fas fa-tag"></i>
                                    Add Category
                                </button>
                                <input type="hidden" name="category_id" id="createCategoryId" required>
                            </div>
                        </div>

                        <!-- Image Preview Container -->
                        <div id="createImagePreviewContainer" class="hidden">
                            <div class="p-4 mt-2 border border-gray-200 rounded-lg bg-gray-50">
                                <div class="relative inline-block group">
                                    <img id="createImagePreview" src="/placeholder.svg" alt="Selected image"
                                        class="object-cover w-32 h-32 transition-all duration-300 rounded-lg cursor-pointer group-hover:brightness-75">

                                    <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 rounded-lg opacity-0 cursor-pointer group-hover:opacity-100"
                                        onclick="document.getElementById('createImageInput').click()">
                                        <div class="text-center text-white">
                                            <i class="mb-1 text-xl fas fa-camera"></i>
                                            <p class="text-xs font-medium">Change Photo</p>
                                        </div>
                                    </div>

                                    <button type="button" id="createCancelImageBtn"
                                        class="absolute flex items-center justify-center w-6 h-6 text-white transition-all duration-200 bg-red-500 rounded-full shadow-lg -top-2 -right-2 hover:bg-red-600 hover:scale-110">
                                        <i class="text-xs fas fa-times"></i>
                                    </button>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">Click on the image to change it, or click the X to
                                    remove it</p>
                            </div>
                        </div>

                        <!-- Category List Container -->
                        <div id="createCategoryListContainer"
                            class="flex flex-wrap hidden gap-2 p-4 mt-2 border border-gray-200 rounded-lg bg-gray-50">
                            @foreach ($categories as $category)
                                <button type="button"
                                    class="create-category-btn px-3 py-1.5 text-sm border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-blue-100 hover:border-blue-300 transition-all duration-200 transform hover:scale-105"
                                    data-id="{{ $category->id }}">
                                    <i
                                        class="mr-2 fas {{ $category->category_name === 'General'
                                            ? 'fa-globe text-green-500'
                                            : ($category->category_name === 'Training'
                                                ? 'fa-book-open text-purple-500'
                                                : ($category->category_name === 'Policy Updates'
                                                    ? 'fa-file-alt text-orange-500'
                                                    : ($category->category_name === 'New Hire'
                                                        ? 'fa-user-plus text-blue-500'
                                                        : 'fa-tag text-gray-500'))) }}"></i>
                                    {{ $category->category_name }}
                                </button>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-end mt-4 space-x-3">
                            <button type="button" id="createCancelBtn"
                                class="px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400">
                                Cancel
                            </button>
                            <button type="submit" id="createSubmitBtn"
                                class="px-6 py-2 text-sm font-medium text-white transition-all duration-200 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Publish
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div id="editModal"
        class="fixed inset-0 z-50 items-center justify-center hidden bg-black bg-opacity-50 backdrop-blur-sm">
        <div class="relative w-full max-w-lg mx-4 overflow-hidden bg-white shadow-2xl rounded-2xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Edit Announcement</h2>
                    <button id="closeEditModalBtn"
                        class="p-2 text-gray-400 transition-colors rounded-full hover:text-gray-600 hover:bg-gray-100">
                        <i class="text-xl fas fa-times"></i>
                    </button>
                </div>

                <form id="editAnnouncementForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6 space-y-4">
                        <div>
                            <label for="editTitle" class="block mb-1 text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="editTitle"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Announcement Title" required>
                        </div>
                        <div>
                            <label for="editMessage" class="block mb-1 text-sm font-medium text-gray-700">Message</label>
                            <textarea id="editMessage" name="text" rows="5"
                                class="w-full p-4 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Share your announcement with the team..." required></textarea>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <button type="button" id="editAddPhotoBtn"
                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 transition-colors bg-white border border-gray-200 rounded-lg hover:text-green-600 hover:border-green-300 hover:bg-green-50">
                                        <i class="mr-2 text-green-500 fas fa-image"></i>
                                        Add Photo
                                    </button>
                                    <input type="file" id="editImageInput" name="image_path" accept="image/*"
                                        class="hidden">
                                </div>
                                <button type="button" id="editAddCategoryBtn"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 transition-colors bg-white border border-gray-200 rounded-lg hover:text-purple-600 hover:border-purple-300 hover:bg-purple-50">
                                    <i class="mr-2 text-purple-500 fas fa-tag"></i>
                                    Add Category
                                </button>
                                <input type="hidden" name="category_id" id="editCategoryId" required>
                            </div>
                        </div>

                        <!-- Image Preview Container -->
                        <div id="editImagePreviewContainer" class="hidden">
                            <div class="p-4 mt-2 border border-gray-200 rounded-lg bg-gray-50">
                                <div class="relative inline-block group">
                                    <img id="editImagePreview" src="/placeholder.svg" alt="Selected image"
                                        class="object-cover w-32 h-32 transition-all duration-300 rounded-lg cursor-pointer group-hover:brightness-75">

                                    <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 rounded-lg opacity-0 cursor-pointer group-hover:opacity-100"
                                        onclick="document.getElementById('editImageInput').click()">
                                        <div class="text-center text-white">
                                            <i class="mb-1 text-xl fas fa-camera"></i>
                                            <p class="text-xs font-medium">Change Photo</p>
                                        </div>
                                    </div>

                                    <button type="button" id="editCancelImageBtn"
                                        class="absolute flex items-center justify-center w-6 h-6 text-white transition-all duration-200 bg-red-500 rounded-full shadow-lg -top-2 -right-2 hover:bg-red-600 hover:scale-110">
                                        <i class="text-xs fas fa-times"></i>
                                    </button>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">Click on the image to change it, or click the X to
                                    remove it</p>
                            </div>
                        </div>

                        <!-- Category List Container -->
                        <div id="editCategoryListContainer"
                            class="flex flex-wrap hidden gap-2 p-4 mt-2 border border-gray-200 rounded-lg bg-gray-50">
                            @foreach ($categories as $category)
                                <button type="button"
                                    class="edit-category-btn px-3 py-1.5 text-sm border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-blue-100 hover:border-blue-300 transition-all duration-200 transform hover:scale-105"
                                    data-id="{{ $category->id }}">
                                    <i
                                        class="mr-2 fas {{ $category->category_name === 'General'
                                            ? 'fa-globe text-green-500'
                                            : ($category->category_name === 'Training'
                                                ? 'fa-book-open text-purple-500'
                                                : ($category->category_name === 'Policy Updates'
                                                    ? 'fa-file-alt text-orange-500'
                                                    : ($category->category_name === 'New Hire'
                                                        ? 'fa-user-plus text-blue-500'
                                                        : 'fa-tag text-gray-500'))) }}"></i>
                                    {{ $category->category_name }}
                                </button>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-end mt-4 space-x-3">
                            <button type="button" id="editCancelBtn"
                                class="px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400">
                                Cancel
                            </button>
                            <button type="submit" id="editSubmitBtn"
                                class="px-6 py-2 text-sm font-medium text-white transition-all duration-200 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Elements
            const createModal = document.getElementById('createModal');
            const editModal = document.getElementById('editModal');
            const imageModal = document.getElementById('imageModal');

            // Create Modal Elements
            const createForm = document.getElementById('createAnnouncementForm');
            const createTitleInput = document.getElementById('createTitle');
            const createMessageInput = document.getElementById('createMessage');
            const createCategoryIdInput = document.getElementById('createCategoryId');
            const createImageInput = document.getElementById('createImageInput');
            const createImagePreview = document.getElementById('createImagePreview');
            const createImagePreviewContainer = document.getElementById('createImagePreviewContainer');
            const createAddPhotoBtn = document.getElementById('createAddPhotoBtn');
            const createCancelImageBtn = document.getElementById('createCancelImageBtn');
            const createAddCategoryBtn = document.getElementById('createAddCategoryBtn');
            const createCategoryListContainer = document.getElementById('createCategoryListContainer');

            // Edit Modal Elements
            const editForm = document.getElementById('editAnnouncementForm');
            const editTitleInput = document.getElementById('editTitle');
            const editMessageInput = document.getElementById('editMessage');
            const editCategoryIdInput = document.getElementById('editCategoryId');
            const editImageInput = document.getElementById('editImageInput');
            const editImagePreview = document.getElementById('editImagePreview');
            const editImagePreviewContainer = document.getElementById('editImagePreviewContainer');
            const editAddPhotoBtn = document.getElementById('editAddPhotoBtn');
            const editCancelImageBtn = document.getElementById('editCancelImageBtn');
            const editAddCategoryBtn = document.getElementById('editAddCategoryBtn');
            const editCategoryListContainer = document.getElementById('editCategoryListContainer');

            // Other Elements
            const announcementContainer = document.getElementById('announcementContainer');
            const categoryLinks = document.querySelectorAll('.category-link');
            const modalImage = document.getElementById('modalImage');
            const modalImageTitle = document.getElementById('modalTitle');

            let selectedCreateCategoryId = null;
            let selectedEditCategoryId = null;

            // Auto-hide success/error messages
            setTimeout(function() {
                const alerts = document.querySelectorAll('[role="alert"]');
                alerts.forEach(alert => {
                    alert.style.transition = 'opacity 0.5s ease-out';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);

            // CREATE MODAL FUNCTIONS
            function openCreateModal() {
                createModal.classList.remove('hidden');
                createModal.classList.add('flex');
                document.body.style.overflow = 'hidden';
                resetCreateForm();
            }

            function closeCreateModal() {
                createModal.classList.add('hidden');
                createModal.classList.remove('flex');
                document.body.style.overflow = 'auto';
                resetCreateForm();
            }

            function resetCreateForm() {
                createTitleInput.value = '';
                createMessageInput.value = '';
                createCategoryIdInput.value = '';
                selectedCreateCategoryId = null;
                resetCreateImagePreview();
                resetCreateCategorySelection();
            }

            function resetCreateImagePreview() {
                createImagePreviewContainer.classList.add('hidden');
                createImagePreview.src = '';
                createImageInput.value = '';
            }

            function showCreateImagePreview(src) {
                createImagePreview.src = src;
                createImagePreviewContainer.classList.remove('hidden');
            }

            function resetCreateCategorySelection() {
                createCategoryListContainer.classList.add('hidden');
                updateCreateCategoryUI();
            }

            function updateCreateCategoryUI() {
                const buttons = document.querySelectorAll('.create-category-btn');
                buttons.forEach(btn => {
                    const id = btn.getAttribute('data-id');
                    if (id === selectedCreateCategoryId) {
                        btn.classList.add('bg-blue-100', 'border-blue-300', 'text-blue-700', 'scale-105');
                        btn.classList.remove('bg-white', 'text-gray-700');
                    } else {
                        btn.classList.remove('bg-blue-100', 'border-blue-300', 'text-blue-700',
                            'scale-105');
                        btn.classList.add('bg-white', 'text-gray-700');
                    }
                });
                createCategoryIdInput.value = selectedCreateCategoryId || '';
            }

            // EDIT MODAL FUNCTIONS
            function openEditModal() {
                editModal.classList.remove('hidden');
                editModal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }

            function closeEditModal() {
                editModal.classList.add('hidden');
                editModal.classList.remove('flex');
                document.body.style.overflow = 'auto';
                resetEditForm();
            }

            function resetEditForm() {
                editTitleInput.value = '';
                editMessageInput.value = '';
                editCategoryIdInput.value = '';
                selectedEditCategoryId = null;
                resetEditImagePreview();
                resetEditCategorySelection();
            }

            function resetEditImagePreview() {
                editImagePreviewContainer.classList.add('hidden');
                editImagePreview.src = '';
                editImageInput.value = '';
            }

            function showEditImagePreview(src) {
                editImagePreview.src = src;
                editImagePreviewContainer.classList.remove('hidden');
            }

            function resetEditCategorySelection() {
                editCategoryListContainer.classList.add('hidden');
                updateEditCategoryUI();
            }

            function updateEditCategoryUI() {
                const buttons = document.querySelectorAll('.edit-category-btn');
                buttons.forEach(btn => {
                    const id = btn.getAttribute('data-id');
                    if (id === selectedEditCategoryId) {
                        btn.classList.add('bg-blue-100', 'border-blue-300', 'text-blue-700', 'scale-105');
                        btn.classList.remove('bg-white', 'text-gray-700');
                    } else {
                        btn.classList.remove('bg-blue-100', 'border-blue-300', 'text-blue-700',
                            'scale-105');
                        btn.classList.add('bg-white', 'text-gray-700');
                    }
                });
                editCategoryIdInput.value = selectedEditCategoryId || '';
            }

            // IMAGE MODAL FUNCTIONS
            function openImageModal(imageSrc, title) {
                if (imageModal && modalImage && modalImageTitle) {
                    modalImage.src = imageSrc;
                    modalImageTitle.textContent = title;
                    imageModal.classList.remove('hidden');
                    imageModal.classList.add('flex');
                    imageModal.classList.add('animate-fadeIn');
                    document.body.style.overflow = 'hidden';
                }
            }

            function closeImageModal() {
                if (imageModal) {
                    imageModal.classList.add('animate-fadeOut');
                    setTimeout(() => {
                        imageModal.classList.add('hidden');
                        imageModal.classList.remove('flex', 'animate-fadeIn', 'animate-fadeOut');
                        document.body.style.overflow = 'auto';
                    }, 200);
                }
            }

            // EVENT LISTENERS

            // Create Modal Triggers
            announcementContainer.addEventListener('click', function(e) {
                if (e.target.closest('.open-create-modal-trigger')) {
                    openCreateModal();
                }
            });

            // Create Modal Close
            document.getElementById('closeCreateModalBtn').addEventListener('click', closeCreateModal);
            document.getElementById('createCancelBtn').addEventListener('click', closeCreateModal);

            // Edit Modal Close
            document.getElementById('closeEditModalBtn').addEventListener('click', closeEditModal);
            document.getElementById('editCancelBtn').addEventListener('click', closeEditModal);

            // Create Modal Image Handling
            createAddPhotoBtn.addEventListener('click', () => createImageInput.click());
            createImageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (!file.type.startsWith('image/')) {
                        alert('Please select a valid image file.');
                        return;
                    }
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Image size should be less than 5MB.');
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        showCreateImagePreview(e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
            createCancelImageBtn.addEventListener('click', resetCreateImagePreview);

            // Edit Modal Image Handling
            editAddPhotoBtn.addEventListener('click', () => editImageInput.click());
            editImageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (!file.type.startsWith('image/')) {
                        alert('Please select a valid image file.');
                        return;
                    }
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Image size should be less than 5MB.');
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        showEditImagePreview(e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
            editCancelImageBtn.addEventListener('click', resetEditImagePreview);

            // Create Modal Category Handling
            createAddCategoryBtn.addEventListener('click', function() {
                createCategoryListContainer.classList.toggle('hidden');
            });

            createCategoryListContainer.addEventListener('click', function(e) {
                const btn = e.target.closest('.create-category-btn');
                if (btn) {
                    selectedCreateCategoryId = btn.getAttribute('data-id');
                    updateCreateCategoryUI();
                }
            });

            // Edit Modal Category Handling
            editAddCategoryBtn.addEventListener('click', function() {
                editCategoryListContainer.classList.toggle('hidden');
            });

            editCategoryListContainer.addEventListener('click', function(e) {
                const btn = e.target.closest('.edit-category-btn');
                if (btn) {
                    selectedEditCategoryId = btn.getAttribute('data-id');
                    updateEditCategoryUI();
                }
            });

            // Form Validation
            createForm.addEventListener('submit', function(e) {
                if (!createCategoryIdInput.value) {
                    e.preventDefault();
                    alert('Please select a category before submitting.');
                    return;
                }
            });

            editForm.addEventListener('submit', function(e) {
                if (!editCategoryIdInput.value) {
                    e.preventDefault();
                    alert('Please select a category before submitting.');
                    return;
                }
            });

            // Image Modal Event Listeners
            if (imageModal) {
                imageModal.addEventListener('click', function(e) {
                    if (e.target === imageModal) {
                        closeImageModal();
                    }
                });
            }

            // Keyboard Events
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    if (!createModal.classList.contains('hidden')) {
                        closeCreateModal();
                    } else if (!editModal.classList.contains('hidden')) {
                        closeEditModal();
                    } else if (imageModal && !imageModal.classList.contains('hidden')) {
                        closeImageModal();
                    }
                }
            });

            // Global Edit Modal Function
            window.openEditModal = function(id, title, text, categoryId, imagePath) {
                // Set form action
                editForm.action = `/announcements/${id}`;

                // Populate form fields
                editTitleInput.value = title;
                editMessageInput.value = text;
                editCategoryIdInput.value = categoryId;

                // Set selected category
                selectedEditCategoryId = categoryId.toString();
                updateEditCategoryUI();

                // Show existing image if available
                if (imagePath && imagePath.trim() !== '') {
                    showEditImagePreview(`/storage/${imagePath}`);
                }

                openEditModal();
            };

            // Category Filtering (AJAX remains for filtering)
            let selectedCategoryId = 'all';

            function updateCategoryUI() {
                categoryLinks.forEach(link => {
                    const id = link.getAttribute('data-category-id');
                    if (id === selectedCategoryId) {
                        link.classList.add('text-blue-700', 'bg-blue-50', 'border-blue-200');
                        link.classList.remove('text-gray-700', 'bg-white', 'border-gray-200');
                    } else {
                        link.classList.remove('text-blue-700', 'bg-blue-50', 'border-blue-200');
                        link.classList.add('text-gray-700', 'bg-white', 'border-gray-200');
                    }
                });
            }

            function fetchAnnouncements(categoryId) {
                const url = categoryId === 'all' ?
                    '{{ route('announcements.index') }}' :
                    `{{ route('announcements.index') }}?category_id=${categoryId}`;

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        renderAnnouncements(data.announcements);
                    })
                    .catch(error => {
                        console.error('Error fetching announcements:', error);
                        announcementContainer.innerHTML =
                            '<p class="mt-6 text-center text-red-500">Error loading announcements. Please try again.</p>';
                    });
            }

            function renderAnnouncements(announcements) {
                // Preserve the create announcement form
                const formSection = announcementContainer.querySelector(
                    '.overflow-hidden.bg-white.border.border-gray-200.shadow-sm.rounded-xl');
                announcementContainer.innerHTML = '';
                announcementContainer.appendChild(formSection);

                if (announcements.length === 0) {
                    announcementContainer.innerHTML += `
                    <p class="mt-6 text-center text-gray-500">No announcements found for this category.</p>
                `;
                    return;
                }

                announcements.forEach(announcement => {
                    const category = announcement.category || {
                        category_name: 'Tanpa Kategori'
                    };
                    const categoryId = announcement.announcement_category_id;
                    let icon, bgColor, textColor;

                    switch (categoryId) {
                        case 1:
                            icon = 'fas fa-globe';
                            bgColor = 'bg-green-100';
                            textColor = 'text-green-700';
                            break;
                        case 2:
                            icon = 'fas fa-book-open';
                            bgColor = 'bg-purple-100';
                            textColor = 'text-purple-700';
                            break;
                        case 3:
                            icon = 'fas fa-file-alt';
                            bgColor = 'bg-orange-100';
                            textColor = 'text-orange-700';
                            break;
                        default:
                            icon = 'fas fa-user-plus';
                            bgColor = 'bg-blue-100';
                            textColor = 'text-blue-700';
                            break;
                    }

                    // Enhanced image HTML with modal functionality
                    const imageHtml = (announcement.image || announcement.image_path) ? `
                    <div class="mt-4">
                        <div class="relative inline-block cursor-pointer group" onclick="openImageModal('/storage/${announcement.image || announcement.image_path}', '${announcement.title.replace(/'/g, "\\'")}')">
                            <img src="/storage/${announcement.image || announcement.image_path}" 
                                 class="object-cover w-full transition-all duration-300 rounded-lg shadow-md max-h-96 hover:shadow-lg group-hover:brightness-90" 
                                 alt="Announcement image"
                                 loading="lazy"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            
                            <div class="items-center justify-center hidden w-full h-48 bg-gray-100 rounded-lg">
                                <div class="text-center text-gray-500">
                                    <i class="mb-2 text-3xl fas fa-image"></i>
                                    <p class="text-sm">Image not available</p>
                                </div>
                            </div>
                            
                            <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-0 rounded-lg opacity-0 group-hover:bg-opacity-30 group-hover:opacity-100">
                                <div class="text-white transition-transform duration-300 transform scale-0 group-hover:scale-100">
                                    <i class="text-2xl fas fa-search-plus"></i>
                                    <p class="mt-1 text-sm">Click to enlarge</p>
                                </div>
                            </div>
                        </div>
                    </div>
                ` : '';

                    const announcementHTML = `
                    <div class="mb-6 overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex space-x-4">
                                    <img src="${announcement.user.profile_pic ? `/storage/${announcement.user.profile_pic}` : '{{ asset('assets/images/userPlaceHolder.png') }}'}"
                                        class="object-cover w-12 h-12 bg-gray-200 rounded-full ring-2 ring-gray-100"
                                        alt="User avatar">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2">
                                            <h3 class="font-semibold text-gray-900">${announcement.user.username}</h3>
                                            <span class="text-gray-400">•</span>
                                            <span class="text-sm text-gray-500">${announcement.user.role || 'User'}</span>
                                        </div>
                                        <p class="text-sm text-gray-500">${new Date(announcement.created_at).toLocaleString('en-US', { month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true })}</p>
                                        <div class="mt-3">
                                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium ${textColor} ${bgColor} rounded-full">
                                                <i class="w-3 h-3 mr-1 ${icon}"></i>
                                                ${category.category_name}
                                            </span>
                                        </div>
                                        <div class="mt-4">
                                            <h4 class="text-lg font-semibold text-gray-900">${announcement.title}</h4>
                                            <p class="mt-2 text-gray-700">${announcement.text}</p>
                                            ${imageHtml}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <form action="/announcements/pin/${announcement.id}" method="POST">
            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
            <button type="submit"
                class="p-2 ${announcement.is_pinned ? 'text-yellow-500' : 'text-gray-400'} transition-colors rounded-lg hover:text-yellow-500 hover:bg-yellow-50">
                <i class="fas fa-thumbtack"></i>
            </button>
        </form>
                                    <div class="relative group">
                                        <button class="p-2 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-50">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="absolute right-0 z-10 hidden w-48 p-2 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg group-hover:block">
                                            <ul class="space-y-1">
                                                <li>
                                                    <button onclick="openEditModal(${announcement.id}, '${announcement.title.replace(/'/g, "\\'")}', '${announcement.text.replace(/'/g, "\\'")}', ${announcement.announcement_category_id}, '${announcement.image || announcement.image_path || ''}')" class="flex items-center w-full px-3 py-2 text-sm text-gray-700 rounded-md hover:bg-gray-100">
                                                        <i class="w-4 h-4 mr-2 fas fa-edit"></i> Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <form action="/announcements/${announcement.id}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="flex items-center w-full px-3 py-2 text-sm text-red-600 rounded-md hover:bg-red-50">
                                                            <i class="w-4 h-4 mr-2 fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 mt-6 border-t border-gray-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-6">
                                        <button class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 transition-colors bg-white border border-gray-200 rounded-lg hover:text-blue-600 hover:border-blue-300 hover:bg-blue-50">
                                            <i class="mr-2 fas fa-share"></i>
                                            Share
                                        </button>
                                    </div>
                                    <a href="/announcements/${announcement.id}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 transition-colors bg-white border border-blue-200 rounded-lg hover:text-blue-700 hover:bg-blue-50">
                                        View Full Post <i class="ml-1 fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                    announcementContainer.innerHTML += announcementHTML;
                });

                // Re-attach event listeners for dynamically created elements
                attachImageModalListeners();
            }

            // Function to attach event listeners to dynamically created image elements
            function attachImageModalListeners() {
                const imageContainers = document.querySelectorAll('[onclick*="openImageModal"]');
                imageContainers.forEach(container => {
                    container.addEventListener('click', function(e) {
                        e.preventDefault();
                        const onclickAttr = this.getAttribute('onclick');
                        if (onclickAttr) {
                            // Extract parameters from onclick attribute
                            const match = onclickAttr.match(
                                /openImageModal$$'([^']+)',\s*'([^']+)'$$/);
                            if (match) {
                                const imageSrc = match[1];
                                const title = match[2];
                                openImageModal(imageSrc, title);
                            }
                        }
                    });
                });
            }

            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    selectedCategoryId = this.getAttribute('data-category-id');
                    updateCategoryUI();
                    fetchAnnouncements(selectedCategoryId);
                });
            });

            // Initial attachment of image modal listeners for existing content
            attachImageModalListeners();

            // Make functions globally available
            window.openImageModal = openImageModal;
            window.closeImageModal = closeImageModal;
        });
    </script>
@endsection
