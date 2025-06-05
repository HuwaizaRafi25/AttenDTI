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

        .animate-fadeIn {
            animation: fadeIn 0.2s ease-out forwards;
        }

        .animate-slideDown {
            animation: slideDown 0.3s ease-out forwards;
        }

        .group:hover .group-hover\:opacity-100 {
            opacity: 1;
        }

        .group:hover .group-hover\:brightness-90 {
            filter: brightness(0.9);
        }

        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }

        .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .announcement-image:hover {
            transform: scale(1.02);
        }

        img[loading="lazy"] {
            transition: opacity 0.3s ease-in-out;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
        <div class="container px-4 py-8 mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Announcement Details</h1>
                        <p class="mt-1 text-sm text-gray-500">View the full details of the announcement</p>
                    </div>
                    <a href="{{ route('announcements.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-all bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="mr-2 text-blue-500 fas fa-arrow-left"></i>
                        Back to Announcements
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-3xl mx-auto">
                <div class="overflow-hidden bg-white border border-gray-200 shadow-md rounded-xl animate-fadeIn">
                    <div class="p-6 sm:p-8">
                        <!-- Announcement Header -->
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4">
                                <img src="{{ $announcement->user->profile_picture ? asset('storage/' . $announcement->user->profile_picture) : asset('assets/images/userPlaceHolder.png') }}"
                                    class="object-cover w-12 h-12 bg-gray-200 rounded-full ring-2 ring-gray-100"
                                    alt="User avatar">
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $announcement->user->username }}</h3>
                                        <span class="text-gray-400">•</span>
                                        <span class="text-sm text-gray-500">{{ $announcement->user->role ?? 'User' }}</span>
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        {{ $announcement->created_at->format('F j, Y, h:i A') }}
                                    </p>
                                </div>
                            </div>
                            @if (Auth::check() && (Auth::id() === $announcement->user_id || Auth::user()->role === 'admin'))
                                <div class="relative group">
                                    <button class="p-2 text-gray-400 transition-colors rounded-lg hover:text-gray-600 hover:bg-gray-50">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="absolute right-0 z-10 hidden w-48 p-2 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg group-hover:block">
                                        <ul class="space-y-1">
                                            <li>
                                                <a href="{{ route('announcements.edit', $announcement->id) }}"
                                                    class="flex items-center w-full px-3 py-2 text-sm text-gray-700 rounded-md hover:bg-gray-100">
                                                    <i class="w-4 h-4 mr-2 fas fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('announcements.destroy', $announcement->id) }}"
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
                            @endif
                        </div>

                        <!-- Announcement Content -->
                        <div class="mt-6">
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
                                {{ $category->category_name ?? 'Uncategorized' }}
                            </span>
                            <h2 class="mt-4 text-2xl font-bold text-gray-900">{{ $announcement->title }}</h2>
                            <p class="mt-4 leading-relaxed text-gray-700">{!! nl2br(e($announcement->text)) !!}</p>

                            @if ($announcement->image_path)
                                <div class="mt-6">
                                    <div class="relative inline-block group">
                                        <img src="{{ asset('storage/' . $announcement->image_path) }}"
                                            class="announcement-image object-cover w-full transition-all duration-300 rounded-lg shadow-md max-h-[500px] hover:shadow-lg"
                                            alt="Announcement image" loading="lazy"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="items-center justify-center hidden w-full h-48 bg-gray-100 rounded-lg">
                                            <div class="text-center text-gray-500">
                                                <i class="mb-2 text-3xl fas fa-image"></i>
                                                <p class="text-sm">Image not available</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="pt-6 mt-6 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <button
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 transition-colors bg-white border border-gray-200 rounded-lg hover:text-blue-600 hover:border-blue-300 hover:bg-blue-50">
                                    <i class="mr-2 fas fa-share"></i>
                                    Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection