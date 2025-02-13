@if ($users->isEmpty())
    <tr>
        <td colspan="6" class="text-center p-4 text-sm font-medium">
            User Not Found.
        </td>
    </tr>
@else
    @foreach ($users as $user)
        <tr class="border-b border-gray-200 hover:bg-gray-100"
            data-id="{{ $user->id }}"
            data-identity_number="{{ $user->identity_number }}"
            data-username="{{ $user->username }}"
            data-itb-account="{{ $user->itb_account }}"
            data-email="{{ $user->email }}"
            data-phone="{{ $user->phone }}"
            data-fullname="{{ $user->full_name }}"
            data-gender="{{ $user->gender }}"
            data-address="{{ $user->address }}"
            data-profile-pic="{{ $user->profile_pic }}"
            data-period-start="{{ $user->period_start_date ? $user->period_start_date : '' }}"
            data-period-end="{{ $user->period_end_date ? $user->period_end_date : '' }}"
            data-major="{{ $user->major ? $user->major : '' }}"
            data-institution="{{ $user->institution ? $user->institution : '' }}"
            data-placement="{{ $user->placement ? $user->placement->name : '' }}"
            @foreach ($user->roles as $role)
                data-role="{{ $role->name }}"
            @endforeach
            >
            <td class="py-3 px-6 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
            <td class="py-3 px-6 text-left">
                <div class="flex items-center">
                    <img src="{{ $user->profile_pic ? asset('storage/profilePics/' . $user->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                        alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                    <div class="w-4 h-4 mt-5 -ml-2.5 flex items-center justify-center rounded-full bg-white">
                        @if ($user->isOnline())
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        @else
                            <div class="w-3 h-3 rounded-full bg-gray-400"></div>
                        @endif
                    </div>
                    <div class="ml-2">
                        <span class="block font-semibold text-gray-800">{{ $user->full_name ? $user->full_name : 'N/A' }}</span>
                        <span class="block text-sm text-gray-500 no-print">{{ '@'.$user->username }}</span>
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
                        : ($user->institution
                            ? $user->institution
                            : 'B/T') !!}
                </span>
            </td>
            <td class="py-3 px-6 text-center opacity-80">
                @if ($user->roles->isEmpty())
                    <span class="text-white bg-yellow-400 px-2 py-1 rounded-md">Unassigned</span>
                @else
                    @foreach ($user->roles as $role)
                        <div class="bg-blue-400 min-w-[100px] py-1 rounded-md inline-block text-center">
                            <span class="text-white">{{ $role->name }}</span>
                        </div>
                    @endforeach
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
                    <a href="{{ route('users.updateView', $user->id) }}"
                        class="w-4 mr-2 scale-125 transform hover:text-indigo-500 hover:scale-150 transition duration-75">
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
