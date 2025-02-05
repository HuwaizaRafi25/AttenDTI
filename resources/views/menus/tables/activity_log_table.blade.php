@foreach ($logs as $activityLog)
    <tr class="border-b border-gray-200 hover:bg-gray-100" data-profile-image="{{ $activityLog->profile_picture }}"
        data-name="{{ $activityLog->name }}" data-email="{{ $activityLog->email }}"
        data-contacts="{{ $activityLog->contact_info }}" data-address="{{ $activityLog->address }}"
        data-id="{{ $activityLog->id }}">
        <td class="py-3 px-6 text-left whitespace-nowrap">
            <div class="flex flex-col">
                <div class="font-semibold text-sm">
                    {{ $activityLog->created_at->format('d M, Y') }}
                </div>
                <div>
                    {{ $activityLog->created_at->format('H:i:s') }}
                </div>
            </div>
        </td>
        <td class="py-3 pl-3 text-left">
            <div class="flex items-center">
                <img src="{{ $activityLog->user->profile_pic ? asset('storage/profilePics/' . $activityLog->user->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                        alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                <div class="flex flex-col items-left ml-2 gap-y-1">
                    <span
                    class="block font-semibold text-gray-800">{{ $activityLog->user ? $activityLog->user->username : 'Not found' }}</span>
                    <span
                    class="block font-semibold bg-blue-500 w-min px-2 rounded-md py-1 text-white">{{ $activityLog->user ? $activityLog->user->roles->first()->name : 'Not found' }}</span>
                </div>
            </div>
        </td>
        <td class="py-3 pl-3 text-center">
            {{ $activityLog->event }}
        </td>
        {{-- <td class="py-3 pl-3 text-center">
            {{ $activityLog->subject_type }}
        </td> --}}
        <td class="py-3 px-3 text-left">
            {{ $activityLog->description }}
        </td>
        {{-- <td class="py-3 px-6 text-center">
            <div class="flex item-center justify-center">
                <a href="#"
                    class="delete-button w-4 mr-2 scale-125 transform hover:text-red-500 hover:scale-150 transition duration-75">
                    <span class="icon">
                        {!! file_get_contents(public_path('assets/images/icons/delete.svg')) !!}
                    </span>
                </a>
            </div>
        </td> --}}
    </tr>
@endforeach
