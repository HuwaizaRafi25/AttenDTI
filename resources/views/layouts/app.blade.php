@if (Auth::user()->hasRole('user') || Auth::user()->hasRole('alumnus'))
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'AttenDTI') }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <script src="https://unpkg.com/@tailwindcss/browser@4"></script> --}}
        <link rel="stylesheet" href="{{ asset('assets/css/clock.css') }}">
        @notifyCss
        <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body class="bg-gray-50 overflow-y-scroll">
        <nav class="sticky top-0 z-50 bg-white shadow-sm">
            <div class="w-full mx-auto px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex-shrink-0">
                        <a href="/" class="flex items-center justify-center">
                            <img src="{{ asset('assets/images/icons/dti_icon.png') }}" class="h-8 w-8 mr-2"
                                alt="Logo">
                            <span class="flex text-2xl font-bold sm:text-3xl lg:text-xl">
                                <span class="text-[#9c9e9d]">
                                    Atten
                                </span>
                                <span class="text-[#2daabd]">
                                    DTI
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="hidden lg:block">
                        <div class="ml-10 text-base flex duration-[1500ms] items-baseline space-x-4">
                            <a href="/overview"
                                class="{{ Request::is('overview') ? 'text-blue-600' : 'text-gray-600' }} px-3 py-2 rounded-md font-medium transition-colors relative group">
                                <span>Overview
                                </span>
                                <span
                                    class="{{ Request::is('overview') ? 'w-[85%]' : 'w-0' }} absolute bottom-0 left-[7%] h-0.5 bg-blue-600 transition-all group-hover:w-[85%]"></span>
                            </a>
                            <a href="/attendances"
                                class="{{ Request::is('attendances') ? 'text-blue-600' : 'text-gray-600' }} px-3 py-2 rounded-md font-medium transition-colors relative group">
                                <span>Attendance</span>
                                <span
                                    class="{{ Request::is('attendance') ? 'w-[85%]' : 'w-0' }} absolute bottom-0 left-[7%] h-0.5 bg-blue-600 transition-all group-hover:w-[85%]"></span>
                            </a>
                            <a href="/announcement"
                                class="{{ Request::is(patterns: 'announcement') ? 'text-blue-600' : 'text-gray-600' }} px-3 py-2 rounded-md font-medium transition-colors relative group">
                                <span>Announcement</span>
                                <span
                                    class="{{ Request::is(patterns: 'announcement') ? 'w-[85%]' : 'w-0' }} absolute bottom-0 left-[7%] h-0.5 bg-blue-600 transition-all group-hover:w-[85%]"></span>
                            </a>
                            <a href="/task"
                                class="{{ Request::is(patterns: 'task') ? 'text-blue-600' : 'text-gray-600' }} px-3 py-2 rounded-md font-medium transition-colors relative group">
                                <span>Task</span>
                                <span
                                    class="{{ Request::is('task') ? 'w-[85%]' : 'w-0' }} absolute bottom-0 left-[7%] h-0.5 bg-blue-600 transition-all group-hover:w-[85%]"></span>
                            </a>
                            <a href="/job"
                                class="{{ Request::is(patterns: 'job') ? 'text-blue-600' : 'text-gray-600' }} px-3 py-2 rounded-md font-medium transition-colors relative group">
                                <span>Job</span>
                                <span
                                    class="{{ Request::is('job') ? 'w-[85%]' : 'w-0' }} absolute bottom-0 left-[7%] h-0.5 bg-blue-600 transition-all group-hover:w-[85%]"></span>
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="relative text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fas fa-bell text-2xl"></i>
                            <span
                                class="absolute top-0 right-0 inline-flex items-center justify-center w-2 h-2 font-bold leading-none text-white transform translate-x-1/6 translate-y-1 bg-red-500 rounded-full"></span>
                        </button>
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" x-cloak class="flex items-center focus:outline-none">
                                <img class="w-8 h-8 rounded-full object-cover bg-gray-200"
                                    src="{{ auth()->user() && auth()->user()->profile_pic ? asset('storage/profilePics/' . auth()->user()->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                                    alt="Profile">

                            </button>
                            <div x-show="open" x-cloak @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg p-2 z-50">
                                <a href="{{ route('user.view', Auth::user()->username) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-user mr-2"></i>Profile
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md"><i
                                        class="fas fa-cog mr-2"></i>Settings</a>
                                <a href="#"
                                    class="px-4 py-2 text-red-600 hover:bg-red-100 rounded-md flex items-center space-x-2"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        <div class="lg:hidden">
                            <button class="text-gray-600 hover:text-gray-900 focus:outline-none" id="mobileMenuBtn">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden md:hidden" id="mobileMenu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="/overview"
                        class="{{ Request::is('overview') ? 'text-blue-600' : 'text-gray-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors">
                        <i
                            class="fas fa-home mr-2 {{ Request::is('overview') ? 'text-blue-600' : 'text-gray-600' }}"></i>
                        Overview
                    </a>
                    <a href="/attendances"
                        class="{{ Request::is('attendance') ? 'text-blue-600' : 'text-gray-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors">
                        <i
                            class="fas fa-calendar-check mr-2 {{ Request::is('attendances') ? 'text-blue-600' : 'text-gray-600' }}"></i>
                        Attendance
                    </a>
                    <a href="/announcement"
                        class="{{ Request::is('announcement') ? 'text-blue-600' : 'text-gray-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors">
                        <i
                            class="fas fa-bullhorn mr-2 {{ Request::is('announcement') ? 'text-blue-600' : 'text-gray-600' }}"></i>
                        Announcement
                    </a>
                    <a href="/task"
                        class="{{ Request::is('task') ? 'text-blue-600' : 'text-gray-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors">
                        <i class="fas fa-tasks mr-2 {{ Request::is('task') ? 'text-blue-600' : 'text-gray-600' }}"></i>
                        Task
                    </a>
                    <a href="/job"
                        class="{{ Request::is('job') ? 'text-blue-600' : 'text-gray-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors">
                        <i
                            class="fas fa-briefcase mr-2 {{ Request::is('job') ? 'text-blue-600' : 'text-gray-600' }}"></i>
                        Job
                    </a>
                </div>
            </div>
        </nav>
        <main class="w-full px-12 py-8">
            @yield('content')
        </main>

        <script>
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');

            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        </script>
        @notifyJs
    </body>

    </html>
@elseif (Auth::user()->hasRole('admin'))
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'AttenDTI') }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {{-- <script src="https://unpkg.com/@tailwindcss/browser@4"></script> --}}
        <link rel="stylesheet" href="{{ asset('assets/css/clock.css') }}">

        @notifyCss
        <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
        @if (Route::currentRouteName() === 'user.index')
            <link rel="stylesheet" href="{{ asset('node_modules/cropperjs/dist/cropper.min.css') }}">
        @endif
        <meta name="csrf-token" content="{{ csrf_token() }}">


    </head>

    <body class="font-sans antialiased overflow-y-scroll bg-gray-50">
        <!-- Sidebar -->
        <div id="notif"
            class="fixed inset-0 top-0 items-start pt-[74px] md:pr-24 pr-9 bg-black bg-opacity-15 justify-end hidden z-50 transition-all transform duration-300">
            <div class="bg-white shadow-lg md:w-96 w-80 rounded-lg h-auto p-4">
                <div class="flex justify-between items-center">
                    <h2 class="font-semibold text-lg text-gray-800">Notifikasi</h2>
                    <i id="closeNotif"
                        class="bx bx-x text-gray-600 scale-150 p-1 cursor-pointer hover:text-red-500"></i>
                </div>
                <hr class="mt-2">
                <div class="notifCard max-h-44 overflow-y-scroll">
                    @if ($allNotifications->isEmpty())
                        <div class="py-6 text-center text-gray-500">
                            <svg class="w-8 h-8 opacity-70 mx-auto" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                style="fill: rgba(0, 0, 0, 1);">
                                <path
                                    d="M12 22a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22zm9-4v-2a.996.996 0 0 0-.293-.707L19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258c-1.323.364-2.463 1.128-3.346 2.127L3.707 2.293 2.293 3.707l18 18 1.414-1.414-1.362-1.362A.993.993 0 0 0 21 18zM12 5c2.757 0 5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17h-.586L8.207 6.793C9.12 5.705 10.471 5 12 5zm-5.293 9.707A.996.996 0 0 0 7 14v-2.879L5.068 9.189C5.037 9.457 5 9.724 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h10.879l-2-2H5v-.586l1.707-1.707z">
                                </path>
                            </svg>
                            <p class="mt-2">Tidak ada notifikasi untuk ditampilkan</p>
                        </div>
                    @else
                        @foreach ($allNotifications as $notification)
                            <form action="{{ route('notification.markAsRead', $notification->id) }}" method="post"
                                onclick="submit()">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="routeNotif" value="{{ $notification->rute }}">
                                <div
                                    class="flex py-3 px-4 rounded-lg mt-2 justify-between hover:bg-blue-50 cursor-pointer transition-all">
                                    <div class="flex items-center ">
                                        @if (file_exists(public_path("assets/images/icons/{$notification->ikon}.svg")))
                                            <span
                                                class="scale-125 h-min w-min mr-3 bg-[#6972c4] text-[#3d4483] bg-opacity-40 rounded-lg p-1">
                                                {!! file_get_contents(public_path("assets/images/icons/{$notification->ikon}.svg")) !!}
                                            </span>
                                        @else
                                            <i class="bx bx-error scale-125 h-min w-min mr-3"></i>
                                        @endif
                                        <p class="text-sm max-w-60 break-words text-gray-700">
                                            {{ $notification->pesan }}</p>
                                    </div>
                                    @if ($notification->status_baca == 0)
                                        <div class="bg-red-500 h-2 w-2 flex-shrink-0 rounded-full"></div>
                                    @endif
                                </div>
                            </form>
                        @endforeach
                    @endif
                </div>
                <hr class="my-2">
                @if (!$allNotifications->isEmpty())
                    <div
                        class="flex justify-end items-center text-blue-500 mt-2 cursor-pointer hover:text-blue-700 transition-all">
                        <i class="bx bx-check-double scale-150"></i>
                        <h2 class="font-semibold pl-2">Tandai semua sebagai dibaca</h2>
                    </div>
                @endif
            </div>
        </div>

        <nav
            class="sidebar fixed md:absolute top-0 left-0 h-screen w-[296px] py-[10px] px-[14px] bg-white transition-all duration-300 transform z-30 shadow-lg">
            <div id="sidebarLayer"
                class="absolute left-[296px] top-0 w-screen h-screen bg-black/10 backdrop-blur-sm hidden lg:hidden transition-opacity duration-300">
            </div>
            <header class="pt-2 pb-3">
                <div class="image-text">
                    <a href="">
                        <span class="image">
                            <img src="{{ asset('assets/images/icons/dti_icon.png') }}" alt="">
                        </span>
                    </a>

                    <div class="text logo-text">
                        <span class="name">{{ config('app.name', 'AttendDTI') }}</span>
                        {{-- <span class="profession">Web developer</span> --}}
                    </div>
                    <span class="bx bx-menu toggle -mr-10 -mt-1 scale-150">
                        {!! file_get_contents(public_path('assets/images/icons/menu.svg')) !!}
                    </span>
                </div>
            </header>
            <hr>

            <div class="menu-bar">
                <div class="menu">
                    <li class="nav-link" data-navLink="1">
                        <div class="navhead">
                            <span class="icon">
                                {!! file_get_contents(public_path('assets/images/icons/dashboard.svg')) !!}
                            </span>
                            <span class="text nav-text">Dashboard</span>
                        </div>
                    </li>
                </div>

                <div class="menu">
                    <li class="nav-link">
                        <div class="navhead">
                            <span class="icon">
                                {!! file_get_contents(public_path('assets/images/icons/dataMaster.svg')) !!}
                            </span>
                            <div class="flex justify-between items-center">
                                <span class="text nav-text">Management</span>
                                <span class="icon bx bx-chevron-down scale-75 opacity-85 icon transition-transform"
                                    style="margin-left: 40px; rotate: 180deg;">
                                    {!! file_get_contents(public_path('assets/images/icons/chevron.svg')) !!}
                                </span>
                            </div>
                        </div>
                    </li>
                    <div class="submenu">
                        <ul class="submenu-links flex flex-col gap-y-3 mt-3">
                            <li class="sub-nav-link">
                                <span class="text sub-nav-text" data-subNavText="1">Users</span>
                            </li>
                            <li class="sub-nav-link">
                                <span class="text sub-nav-text" data-subNavText="2">Roles & Permissions</span>
                            </li>
                            <li class="sub-nav-link">
                                <span class="text sub-nav-text" data-subNavText="3">Locations</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="menu">
                    <li class="nav-link" data-navLink="2">
                        <div class="navhead">
                            <span class="icon">
                                {!! file_get_contents(public_path('assets/images/icons/attendance.svg')) !!}
                            </span>
                            <span class="text nav-text">Attendances</span>
                        </div>
                    </li>
                </div>

                <div class="menu">
                    <li class="nav-link" data-navLink="3">
                        <div class="navhead">
                            <span class="icon">
                                {!! file_get_contents(public_path('assets/images/icons/announcement.svg')) !!}
                            </span>
                            <span class="text nav-text">Announcements</span>
                        </div>
                    </li>
                </div>

                <div class="menu">
                    <li class="nav-link" data-navLink="4">
                        <div class="navhead">
                            <span class="icon">
                                {!! file_get_contents(public_path('assets/images/icons/job.svg')) !!}
                            </span>
                            <span class="text nav-text">Jobs</span>
                        </div>
                    </li>
                </div>

                <div class="menu">
                    <li class="nav-link" data-navLink="5">
                        <div class="navhead">
                            <span class="icon">
                                {!! file_get_contents(public_path('assets/images/icons/documents.svg')) !!}
                            </span>
                            <span class="text nav-text">Documents</span>
                        </div>
                    </li>
                </div>

                <div class="menu">
                    <li class="nav-link">
                        <div class="navhead">
                            <span class="icon">
                                {!! file_get_contents(public_path('assets/images/icons/support.svg')) !!}
                            </span>
                            <div class="flex justify-between items-center">
                                <span class="text nav-text">Support</span>
                                <span class="icon bx bx-chevron-down scale-75 opacity-85 icon transition-transform"
                                    style="margin-left: 88px; rotate: 180deg;">
                                    {!! file_get_contents(public_path('assets/images/icons/chevron.svg')) !!}
                                </span>
                            </div>
                        </div>
                    </li>
                    <div class="submenu">
                        <ul class="submenu-links flex flex-col gap-y-4 mt-2">
                            <li class="sub-nav-link">
                                <span class="text sub-nav-text" data-subNavText="4">Help Center</span>
                            </li>
                            <li class="sub-nav-link">
                                <span class="text sub-nav-text" data-subNavText="5">Contact Support</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="menu">
                    <li class="nav-link" data-navLink="6">
                        <div class="navhead">
                            <span class="icon">
                                {!! file_get_contents(public_path('assets/images/icons/setting.svg')) !!}
                            </span>
                            <span class="text nav-text">Settings</span>
                        </div>
                    </li>
                </div>

                <div class="menu">
                    <li class="nav-link" data-navLink="7">
                        <div class="navhead">
                            <span class="icon">
                                {!! file_get_contents(public_path('assets/images/icons/activityLog.svg')) !!}
                            </span>
                            <span class="text nav-text">Activity Logs</span>
                        </div>
                    </li>
                </div>
            </div>

            <div class="sticky -bottom-6 mt-2.5 z-20">
                <div class="p-2 rounded-md bg-[#bec2eb]">
                    <div class="flex items-center justify-between w-full">
                        <div class="flex items-center gap-x-2">
                            <div class="relative flex-shrink-0">
                                <img src="{{ Auth::user()->profile_pic ? asset('storage/profilePics/' . Auth::user()->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                                    alt="Profile Picture"
                                    class="object-cover w-10 h-10 rounded-full bg-slate-50 {{ Auth::user()->profile_pic ? 'p-0' : 'p-1' }}">
                            </div>
                            <div class="">
                                <span
                                    class="text-profile block font-semibold text-gray-800">{{ Auth::user()->username }}</span>
                                <span
                                    class="text-profile block text-xs text-gray-500">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                        <span
                            class="icon-profile bx bx-chevron-down w-min cursor-pointer hover:opacity-100 -mr-3 hover:scale-105 opacity-85 icon transition-transform"
                            onclick="window.location.href = '/profile'">
                            {!! file_get_contents(public_path('assets/images/icons/info.svg')) !!}
                        </span>
                    </div>
                </div>
            </div>
        </nav>

        @include('menus.modals.user.report_user_modal')
        @include('menus.modals.user.add_user_modal')
        @include('menus.modals.user.view_user_modal')
        {{-- @include('menus.modals.user.edit_user_modal') --}}
        @include('menus.modals.user.delete_user_modal')
        @include('menus.modals.attendance.view_attendance_modal')

        <div
            class="home absolute top-0 lg:left-[296px] w-screen left-0 min-h-screen h-screen bg-gray-50 transition-all transform duration-300">
            <!-- Header -->
            <header class="bg-gray-50 w-full sticky top-0" style="z-index: 29">
                <div class="w-full py-4 px-4 sm:px-6 lg:px-8 flex justify-end items-center">
                    <!-- Search, Notification, Profile Section -->
                    {{-- <div class="ml-12 hidden md:flex items-center justify-center gap-x-2">
                        <h1 class="text-xl">Wilujeng Enjing, <span
                                class="font-bold">{{ Auth::user()->full_name }}</span></h1>
                        <h1 class="font-semibold text-gray-800">!</h1>
                    </div> --}}
                    <div class="flex items-center space-x-4 mr-0 md:mr-3">
                        <!-- Search Bar -->
                        <div class="relative">
                            <input type="text" placeholder="Cari"
                                class="lg:w-64 md:w-[196px] w-[164px] bg-gray-50 transition-all transform duration-300 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-transparent">
                            <svg class="w-5 h-5 text-gray-500 absolute right-3 top-3" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <!-- Notification Icon -->
                        <button id="notifButton" class="relative">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 01-6 0v-1m6 0H9">
                                </path>
                            </svg>
                            @if ($unreadNotifications && $unreadNotifications->count() > 0)
                                <span
                                    class="absolute top-2 right-2 inline-block w-2 h-2 transform translate-x-1 -translate-y-1 bg-red-600 rounded-full"></span>
                            @endif
                        </button>

                        {{-- Language Dropdown --}}
                        <div x-data="{ open: false }" class="relative">
                            <!-- Trigger Button -->
                            <button @click="open = !open" class="flex items-center focus:outline-none">
                                <!-- Default Flag Icon -->
                                <img class="w-10 h-10 p-1 rounded-full object-cover bg-slate-100"
                                    src="{{ asset('assets/images/english.png') }}" alt="Language">
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" x-cloak @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg p-2 z-50">
                                <!-- Indonesian -->
                                <a href="/set-locale/id"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                                    <img class="w-7 h-7 border-sm border-gray-200 mr-2 shadow-xl rounded-full object-cover"
                                        src="{{ asset('assets/images/indonesia.png') }}" alt="Bahasa Indonesia">
                                    <span>Bahasa Indonesia</span>
                                </a>
                                <!-- Sundanese -->
                                <a href="/set-locale/su"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                                    <img class="w-7 h-7 border-sm border-gray-200 mr-2 shadow-xl rounded-full object-cover"
                                        src="{{ asset('assets/images/sunda.png') }}" alt="Basa Sunda">
                                    <span>Basa Sunda</span>
                                </a>
                                <!-- English -->
                                <a href="/set-locale/en"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                                    <img class="w-7 h-7 mr-2 shadow-xl rounded-full object-cover"
                                        src="{{ asset('assets/images/english.png') }}" alt="English">
                                    <span>English</span>
                                </a>
                            </div>
                        </div>


                        <!-- Profile Dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center focus:outline-none">
                                <img class="w-10 h-10 p-1 rounded-full object-cover bg-slate-100"
                                    src="{{ Auth::user()->profile_pic ? asset('storage/profilePics/' . Auth::user()->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                                    alt="Profile">
                            </button>

                            <div x-show="open" x-cloak @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg p-2 z-50">
                                <a href="{{ route('user.view', Auth::user()->username) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                                    <i class="fas fa-user mr-2"></i>Profile
                                </a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md"><i
                                        class="fas fa-cog mr-2"></i>Settings</a>
                                <a href="#"
                                    class="px-4 py-2 text-red-600 hover:bg-red-100 rounded-md flex items-center space-x-2"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="icon scale-125">
                                        {!! file_get_contents(public_path('assets/images/icons/exit.svg')) !!}
                                    </span>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
        <div class="fixed flex bottom-4 right-4 cursor-pointer hover:scale-110 transition transform">
            <a href="https://wa.me/628815184624" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('assets/images/whatsapp-icon.png') }}" class="w-20" alt="">
            </a>
        </div>

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/modalComponents.js') }}"></script>

        <x-notify::notify />
        @notifyJs
    </body>

    </html>
@else
    <div class="flex items-center justify-center h-screen bg-gray-100">
        <div class="text-center">
            <h1 class="text-9xl font-bold text-blue-600">404</h1>
            <p class="text-2xl font-semibold text-gray-800 mt-4">Oops! Page Not Found</p>
            <p class="text-lg text-gray-600 mt-2">The page you are looking for doesn't exist or has been moved.</p>
            <a href="{{ url('/') }}"
                class="mt-6 inline-block px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300">
                Back to Homepage
            </a>
        </div>
    </div>
@endif
