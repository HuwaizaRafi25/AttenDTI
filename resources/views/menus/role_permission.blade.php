@extends('layouts.app')
@section('content')
    <style>
        #userModal {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            /* Awalnya disembunyikan */
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: 0.5s ease;
            z-index: 1000;
            transform: translateY(20);
        }

        #userModal.show {
            transition: 0.5s ease;
            display: flex;
            /* Menampilkan modal */
            opacity: 1;
            transform: translateY(0);
            /* Menampilkan efek muncul */
        }

        .full-screen-image {
            width: auto;
            height: auto;
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            border-radius: 15px;
            /* Menjaga proporsi gambar */
        }

        #deleteModal.show {
            display: flex;
            z-index: 101
        }

        #addModal {
            z-index: 101;
        }

        #addModal.show {
            display: flex
        }

        #updateModal {
            z-index: 101;
        }

        #updateModal .show {
            display: flex
        }

        #imageOverlay {
            display: none;
            /* Sembunyikan overlay secara default */
        }

        input[type="number"] {
            -moz-appearance: textfield;
            /* Untuk Firefox */
            -webkit-appearance: none;
            /* Untuk Chrome dan Safari */
            appearance: none;
            /* Untuk browser lain */
        }

        /* Sembunyikan spinner */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        #optionsMenu.show {
            display: block;
            position: absolute !important;
            left: 44px;
            margin-top: 24px;
            z-index: 50;
            width: 128px;
        }

        #moreButton.open+#optionsMenu {
            display: block;
        }

        [x-cloak] {
            display: none;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('expenses') }}
        </h2>
    </x-slot>

    <div class="">
        {{-- <nav class="flex pb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Qc Ops</span>
                    </div>
                </li>
            </ol>
        </nav> --}}
        <div>
            <div class="flex flex-col ml-8">
                <div class="flex">
                    <button id="work" class="ml-1.5 mr-4 text-blue-500 font-semibold">
                        Role Permission
                    </button>
                    <button id="done" class="mr-4">
                        User Permission
                    </button>
                </div>
                <!-- Tambahkan hr setelah button pertama -->
                <hr id="underline" class="ml-1 w-0 border-blue-500 mb-3"
                    style="border-width: 1.5px; transition: 0.5s ease;">
            </div>
            <div id="qcOps" class="max-w-7xl mx-auto sm:px-6 lg:px-8 transition-all duration-500 opacity-100">
                <div class="bg-white shadow-xl sm:rounded-lg p-6 flex w-full flex-col h-auto  items-center">
                    <div class="w-full flex justify-between h-auto px-4">
                        <div class="w-4/6">
                            <span class="text-gray-600">Action</span>
                        </div>
                        <div class="space-x-7 w-2/6 flex justify-end">
                            <span>Alumni</span>
                            <span>User</span>
                            <span>Admin</span>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-1">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/user_group.svg') }}" class="w-6 opacity-85" alt="">
                        <span class="font-semibold opacity-90">Accounts Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read User Account</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage User Account</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Role Permission</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Activity Log</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/attendance_blue.svg') }}" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Attendances Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Attendance</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Record Attendance</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Attendance</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/building_blue.svg') }}" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Locations Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Location</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Location</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/job_blue.svg') }}" class="w-5 opacity-85" alt="">
                        <span class="font-semibold opacity-90">Jobs Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Job Vacancy</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Job Vacancy</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/announcement_blue.svg') }}" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Announcements Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Announcement</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Announcement</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/document_blue.svg') }}" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Documents Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Create Document</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Read Users Document</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal">
                                <span class="">Manage Users Document</span>
                            </div>
                            <div class="space-x-14 mr-4 w-2/6 flex justify-end">
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled>
                                <input type="checkbox" class="w-4 opacity-85 hover:opacity-100 cursor-pointer rounded-lg"
                                    name="" id="" disabled checked>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="accomplishedQcTable"
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 transition-all transform ease-in-out duration-500 opacity-0 hidden">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    {{-- tombol link user permission --}}
                    <div class="flex justify-end mb-4">
                        <button id="linkUserPermission"
                            class="linkUserPermissionButton bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                            <i class="fa-solid fa-link"></i>
                            Assign User
                        </button>
                    </div>
                    <div class="w-full flex justify-between h-auto px-4">
                        <div class="w-4/6">
                            <span class="text-gray-600">Action</span>
                        </div>
                        <div class="space-x-7 w-2/6 flex justify-end">
                            <span>User Account</span>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-1">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/user_group.svg') }}" class="w-6 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Accounts Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        {{-- Read User Account --}}
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read User Account</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['read_user']) || $groupedPermissions['read_user']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['read_user'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>

                        {{-- Manage User Account --}}
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage User Account</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['manage_user_account']) || $groupedPermissions['manage_user_account']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['manage_user_account'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>

                        {{-- Manage Role Permission --}}
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Role Permission</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['manage_role_permission']) || $groupedPermissions['manage_role_permission']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['manage_role_permission'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>

                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read Activity Log</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['read_activity_log']) || $groupedPermissions['read_activity_log']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['read_activity_log'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/attendance_blue.svg') }}" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Attendances Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read Attendance</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['read_attendance']) || $groupedPermissions['read_attendance']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['read_attendance'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Record Attendance</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['record_attendance']) || $groupedPermissions['record_attendance']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['record_attendance'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Attendance</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['manage_attendance']) || $groupedPermissions['manage_attendance']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['manage_attendance'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/building_blue.svg') }}" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Locations Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read Location</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['read_location']) || $groupedPermissions['read_location']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['read_location'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Location</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['manage_location']) || $groupedPermissions['manage_location']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['manage_location'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/job_blue.svg') }}" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Jobs Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read Job Vacancy</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['read_job']) || $groupedPermissions['read_job']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['read_job'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Job Vacancy</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['manage_job']) || $groupedPermissions['manage_job']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['manage_job'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/announcement_blue.svg') }}" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Announcements Management</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read Announcement</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['read_announcement']) || $groupedPermissions['read_announcement']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['read_announcement'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Announcement</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['manage_announcement']) || $groupedPermissions['manage_announcement']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['manage_announcement'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr class="w-full border-gray-300 mt-4">
                    <div class="w-full flex items-center space-x-5 h-14 bg-slate-50 px-4">
                        <img src="{{ asset('assets/images/icons/document_blue.svg') }}" class="w-5 opacity-85"
                            alt="">
                        <span class="font-semibold opacity-90">Others</span>
                    </div>
                    <hr class="w-full border-gray-300 mb-4">
                    <div class="flex flex-col space-y-4 w-full">
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage Dues</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['manage_dues']) || $groupedPermissions['manage_dues']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['manage_dues'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission"
                                                        value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        {{-- <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Read Users Document</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['read_document']) || $groupedPermissions['read_document']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['read_document'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission" value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="w-full flex justify-between h-auto px-4">
                            <div class="w-4/6 font-normal flex items-center">
                                <span>Manage User Document</span>
                            </div>
                            <div class="mr-4 w-2/6 flex flex-col justify-center items-start space-y-2">
                                @if (!isset($groupedPermissions['manage_user_document']) || $groupedPermissions['manage_user_document']->isEmpty())
                                    <span class="text-gray-400">User Not Found</span>
                                @else
                                    @foreach ($groupedPermissions['manage_user_document'] as $mp)
                                        <div class="flex w-full justify-between items-center">
                                            <div class="flex items-center space-x-3">
                                                <img src="{{ $mp->user->profile_pic
                                                    ? asset('storage/profilePics/' . $mp->user->profile_pic)
                                                    : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                                                <div class="flex flex-col ml-2">
                                                    <span
                                                        class="font-semibold text-gray-800">{{ $mp->user->username }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('userPermission.unlink', $mp->user->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="permission" value="{{ $mp->permission->name }}">
                                                    <button type="submit"
                                                        class="w-4 mr-2 transform saturate-0 hover:saturate-100 hover:scale-125 transition duration-75">
                                                        <span class="icon">
                                                            <img width="18"
                                                                src="{{ asset('assets/images/icons/unlink_blue.svg') }}"
                                                                alt="unlinkButton">
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div> --}}
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const underLine = document.getElementById('underline');
            const workButton = document.getElementById('work');
            const doneButton = document.getElementById('done');
            const workTable = document.getElementById('qcOps');
            const doneTable = document.getElementById('accomplishedQcTable');

            function setActiveButton(activeButton, inactiveButton) {
                activeButton.classList.add('text-blue-500', 'font-semibold');
                inactiveButton.classList.remove('text-blue-500', 'font-semibold');

                const activeButtonRect = activeButton.getBoundingClientRect();
                underLine.style.width = `${activeButtonRect.width}px`;
                underLine.style.marginLeft =
                    `${activeButtonRect.left - workButton.getBoundingClientRect().left + 3}px`;
            }

            function switchTables(showTable, hideTable) {
                // Fade out the current table
                hideTable.style.opacity = '0';
                hideTable.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    hideTable.classList.add('hidden');
                    showTable.classList.remove('hidden');

                    // Trigger reflow
                    void showTable.offsetWidth;

                    // Fade in the new table
                    showTable.style.opacity = '1';
                    showTable.style.transform = 'translateY(0)';
                }, 300); // Match this with your CSS transition duration
            }

            doneButton.addEventListener('click', function() {
                setActiveButton(doneButton, workButton);
                switchTables(doneTable, workTable);
            });

            workButton.addEventListener('click', function() {
                setActiveButton(workButton, doneButton);
                switchTables(workTable, doneTable);
            });

            // Initial setup
            setActiveButton(workButton, doneButton);

            const linkUserPermissionButton = document.querySelectorAll('.linkUserPermissionButton');
            const linkUserPermission = document.getElementById('linkUserPermission');
            const closeButton = document.querySelectorAll('.closeLinkUser');

            linkUserPermissionButton.forEach(button => {
                button.addEventListener('click', function() {
                    linkUserPermission.classList.remove('hidden');
                    linkUserPermission.classList.add('flex');
                });
            });

            closeButton.forEach(button => {
                button.addEventListener('click', function() {
                    linkUserPermission.classList.add('hidden');
                    linkUserPermission.classList.remove('flex');
                });
            });

            document.addEventListener('click', function(event) {
                if (event.target === linkUserPermission) {
                    linkUserPermission.classList.add('hidden');
                    linkUserPermission.classList.remove('flex');
                }
            });
        });
    </script>
@endsection
