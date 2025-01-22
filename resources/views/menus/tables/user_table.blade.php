@if ($users->isEmpty())
    <tr>
        <td colspan="6" class="text-center p-4 text-sm font-medium">
            User Not Found.
        </td>
    </tr>
@else
    @foreach ($users as $user)
        <tr class="border-b border-gray-200 hover:bg-gray-100" data-profile-image="{{ $user->profile_pic }}"
            data-pengguna="{{ $user->nama }}" data-username="{{ $user->username }}" data-email="{{ $user->email }}"
            data-telepon="{{ $user->tlp }}" data-role="{{ $user->role }}"
            data-outlet="{{ $user->outlet ? $user->outlet->nama : '' }}" data-id="{{ $user->id }}"
            data-role="{{ $user->role }}">
            <td class="py-3 px-6 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
            <td class="py-3 px-6 text-left">
                <div class="flex items-center">
                    <img src="{{ $user->profile_pic ? asset('storage/profilePics/' . $user->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                        alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                    <div class="w-4 h-4 mt-5 -ml-2.5 flex items-center justify-center rounded-full bg-white">
                        {{-- @php
                            $now = \Carbon\Carbon::now();
                            $lastSeen = \Carbon\Carbon::parse($user->last_seen);
                            $isOnline = $lastSeen->diffInMinutes($now) <= 5;
                        @endphp --}}
                        @if ($user->isOnline())
                            <div class="w-3 h-3 rounded-full bg-green-400"></div> 
                        @else
                            <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                        @endif
                    </div>
                    <div class="ml-2">
                        <span class="block font-semibold text-gray-800">{{ $user->username }}</span>
                        <span class="block text-sm text-gray-500 no-print">{{ $user->itb_account }}</span>
                    </div>
                </div>
            </td>
            <td class="py-3 px-6 text-left printable hidden">
                <p class="font-semibold text-gray-800">{{ $user->itb_account }}</p>
            </td>
            <td class="py-3 pl-6 text-left">
                <span class="text-[#545DB0ff] text-base font-semibold rounded-md">
                    {!! $user->hasRole('admin')
                        ? '<p class="p-1 px-2 bg-[#6770c6]/30 rounded-md w-fit">DTI ITB</p>'
                        : ($user->school
                            ? $user->school
                            : 'B/T') !!}
                </span>
            </td>
            {{-- <td class="py-3 px-6 text-center no-print">
                <span
                    class="text-white {{ $user->status ? 'bg-green-400' : 'bg-gray-400' }} px-2 py-1 rounded-md">
                    {{ $user->status ? 'Daring' : 'Luring' }}
                </span>
            </td> --}}
            <td class="py-3 px-6 text-center opacity-80">
                @if ($user->role == null)
                    <span class="text-white bg-yellow-400 px-2 py-1 rounded-md">Unassigned</span>
                @else
                    <div class="bg-blue-400 min-w-[100px] py-1 rounded-md inline-block text-center">
                        @if ($user->role == 'super_admin')
                            <span class="text-white">Super Admin</span>
                        @elseif ($user->role == 'owner')
                            <span class="text-white">Owner</span>
                        @elseif ($user->role == 'manager')
                            <span class="text-white">Manager</span>
                        @elseif ($user->role == 'admin')
                            <span class="text-white">Admin</span>
                        @elseif ($user->role == 'kasir')
                            <span class="text-white">Kasir</span>
                        @else
                            <span class="text-white">Unknown Role</span>
                        @endif
                    </div>
                @endif
            </td>
            <td class="py-3 px-6 text-center no-print">
                <div class="flex item-center justify-center">
                    <a href="#"
                        class="view-button w-4 mr-2 scale-125 transform hover:text-green-500 hover:scale-150 transition duration-75">
                        <span class="icon">
                            {!! file_get_contents(public_path('assets/images/icons/showAlt.svg')) !!}
                        </span>
                    </a>
                    <a href="#"
                        class="update-button w-4 mr-2 scale-125 transform hover:text-indigo-500 hover:scale-150 transition duration-75"
                        data-user-id="{{ $user->id }}" data-user-username="{{ $user->username }}"
                        data-user-nama="{{ $user->nama }}" data-user-email="{{ $user->email }}"
                        data-user-telepon="{{ $user->tlp }}" data-user-role="{{ $user->role }}"
                        data-user-outlet="{{ $user->id_outlet }}"
                        data-user-outlet-name="{{ $user->outlet ? $user->outlet->nama : null }}"
                        data-user-profile-pic="{{ $user->profile_pic }}">
                        <span
                            class="bx bx-edit w-4 mr-2 scale-125 transform hover:text-green-500 hover:scale-150 transition duration-75">
                            <span class="icon">
                                {!! file_get_contents(public_path('assets/images/icons/editBold.svg')) !!}
                            </span>
                        </span>
                    </a>
                    <a href="#" data-user-id="{{ $user->id }}" data-user-nama="{{ $user->nama }}"
                        data-user-email="{{ $user->email }}" data-user-pic="{{ $user->profile_pic }}"
                        class="delete-button w-4 mr-2 scale-125 transform hover:text-red-500 hover:scale-150 transition duration-75">
                        <span class="icon">
                            {!! file_get_contents(public_path('assets/images/icons/delete.svg')) !!}
                        </span>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
@endif
