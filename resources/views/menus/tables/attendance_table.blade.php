@if ($users->isEmpty())
    <tr>
        <td colspan="14" class="text-center p-4 text-sm font-medium">
            <div class="flex items-center justify-center">
                <span class="text-gray-500">No data available</span>
            </div>
        </td>
    </tr>
@else
    <style>
        .view-attendance-button:hover+.span-attendance {
            opacity: 1;
            display: flex;
        }
    </style>
    @foreach ($users as $user)
        <tr class="hover:bg-gray-50 whitespace-nowrap">
            <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
            <td class="px-4 py-3 text-left">
                {{ $user->identity_number ?? 'N/A' }}
            </td>
            <td class="px-4 py-3 text-left">
                {{ $user->full_name ?? 'N/A' }}
            </td>
            <td class="px-4 py-3 text-left">
                {{ $user->institution ?? 'N/A' }}
            </td>
            @foreach ($dates as $date)
                @if (\Carbon\Carbon::parse($date)->isWeekend())
                    @if (in_array(\Carbon\Carbon::parse($date)->format('Y-m-d'), $holidays))
                        @if ($user === $users->first())
                            <td class="px-4 py-3 text-center bg-red-100 text-red-800" rowspan="{{ $users->count() }}">
                                <p style="writing-mode: vertical-rl; transform: rotate(180deg);">
                                    {{ $holidaysNames[\Carbon\Carbon::parse($date)->format('Y-m-d')] }}</p>
                            </td>
                        @endif
                    @else
                        <td class="px-4 py-3 text-center bg-gray-200 text-gray-600"></td>
                    @endif
                @else
                    @if (in_array(\Carbon\Carbon::parse($date)->format('Y-m-d'), $holidays))
                        @if ($user === $users->first())
                            <td class="px-4 py-3 text-center bg-red-100 text-red-800" rowspan="{{ $users->count() }}">
                                <p style="writing-mode: vertical-rl; transform: rotate(180deg);">
                                    {{ $holidaysNames[\Carbon\Carbon::parse($date)->format('Y-m-d')] }}</p>
                            </td>
                        @endif
                    @else
                        <td
                            class="relative px-4 py-3 text-center {{ \Carbon\Carbon::parse($date)->isToday() ? 'bg-blue-100 text-blue-800' : '' }}">
                            @php
                                $attendance = $user->attendances->first(function ($att) use ($date) {
                                    return \Carbon\Carbon::parse($att->created_at)->format('Y-m-d') === $date;
                                });
                                $uniqueId =
                                    'spanAttendance_' . $user->id . '_' . \Carbon\Carbon::parse($date)->format('Ymd');
                            @endphp
                            @if ($attendance && \Carbon\Carbon::parse($attendance->created_at)->translatedFormat('Y-m-d') === $date)
                                @if ($attendance->attendance === 'present' || $attendance->attendance === 'late')
                                    <span
                                        class="view-attendance-button cursor-pointer hover:scale-125 hover:shadow-md transition-all transform duration-200
                                        {{ $attendance->attendance === 'late' ? 'border-yellow-800 bg-yellow-100 text-yellow-800 hover:bg-yellow-200' : 'border-green-800 bg-green-100 text-green-800 hover:bg-green-200' }}
                                          px-2 inline-flex text-xs leading-5 font-semibold rounded-full border "
                                        data-userId="{{ $user->id }}" data-userFullname="{{ $user->full_name }}"
                                        data-username="{{ $user->username }}" data-userPic="{{ $user->profile_pic }}"
                                        data-date="{{ \Carbon\Carbon::parse($date)->format('F jS, Y') }}"
                                        data-time="{{ \Carbon\Carbon::parse($attendance->check_in)->format('h:i') }}"
                                        data-attendanceId="{{ $attendance->id }}"
                                        data-attendance="{{ ucfirst($attendance->attendance) }}"
                                        data-status="{{ $attendance->status }}"
                                        data-locationName="{{ $attendance->location ? $attendance->location->name . ' - ' . $attendance->location->campus : '' }}"
                                        data-locationAddress="{{ $attendance->location ? $attendance->location->address : '' }}"
                                        data-locationPic="{{ $attendance->location ? $attendance->location->pic : '' }}"
                                        data-note="{{ $attendance->note }}"
                                        data-approver="{{ $attendance->approver ? $attendance->approver->username : '' }}"
                                        data-approverPic="{{ $attendance->approver ? $attendance->approver->profile_pic : '' }}">
                                        ✓
                                        @if ($attendance->status === 'pending')
                                            <span
                                                class="absolute -top-1.5 -right-2 bg-red-500 text-white text-xs font-semibold rounded-full px-1">!</span>
                                        @endif
                                    </span>
                                @elseif ($attendance->attendance === 'permit')
                                    <span
                                        class="view-attendance-button cursor-pointer hover:scale-125 hover:shadow-md transition-all transform duration-200 hover:bg-blue-200 px-3 inline-flex text-xs leading-5 font-semibold rounded-full border border-blue-800 bg-blue-100 text-blue-800"
                                        data-userId="{{ $user->id }}" data-userFullname="{{ $user->full_name }}"
                                        data-username="{{ $user->username }}" data-userPic="{{ $user->profile_pic }}"
                                        data-date="{{ \Carbon\Carbon::parse($date)->format('F jS, Y') }}"
                                        data-time="{{ \Carbon\Carbon::parse($attendance->check_in)->format('h:i') }}"
                                        data-attendanceId="{{ $attendance->id }}" data-attendance="Permit"
                                        data-status="{{ $attendance->status }}"
                                        data-locationName="{{ $attendance->location ? $attendance->location->name . ' - ' . $attendance->location->campus : '' }}"
                                        data-locationAddress="{{ $attendance->location ? $attendance->location->address : '' }}"
                                        data-locationPic="{{ $attendance->location ? $attendance->location->pic : '' }}"
                                        data-note="{{ $attendance->note }}"
                                        data-approver="{{ $attendance->approver ? $attendance->approver->username : '' }}"
                                        data-approverPic="{{ $attendance->approver ? $attendance->approver->profile_pic : '' }}">
                                        ¡
                                        @if ($attendance->status === 'pending')
                                            <span
                                                class="absolute -top-1.5 -right-2 bg-red-500 text-white text-xs font-semibold rounded-full px-1">!</span>
                                        @endif
                                    </span>
                                @elseif ($attendance->attendance === 'sick')
                                    <span
                                        class="view-attendance-button cursor-pointer hover:scale-125 hover:shadow-md transition-all transform duration-200 hover:bg-gray-200 px-2.5 inline-flex text-sm leading-5 font-semibold rounded-full border border-gray-800 bg-gray-100 text-gray-800"
                                        data-userId="{{ $user->id }}" data-userFullname="{{ $user->full_name }}"
                                        data-username="{{ $user->username }}" data-userPic="{{ $user->profile_pic }}"
                                        data-date="{{ \Carbon\Carbon::parse($date)->format('F jS, Y') }}"
                                        data-time="{{ \Carbon\Carbon::parse($attendance->check_in)->format('h:i') }}"
                                        data-attendanceId="{{ $attendance->id }}" data-attendance="Sick"
                                        data-status="{{ $attendance->status }}"
                                        data-locationName="{{ $attendance->location ? $attendance->location->name . ' - ' . $attendance->location->campus : '' }}"
                                        data-locationAddress="{{ $attendance->location ? $attendance->location->address : '' }}"
                                        data-locationPic="{{ $attendance->location ? $attendance->location->pic : '' }}"
                                        data-note="{{ $attendance->note }}"
                                        data-approver="{{ $attendance->approver ? $attendance->approver->username : '' }}"
                                        data-approverPic="{{ $attendance->approver ? $attendance->approver->profile_pic : '' }}">
                                        s
                                        @if ($attendance->status === 'pending')
                                            <span
                                                class="absolute -top-1.5 -right-2 bg-red-500 text-white text-xs font-semibold rounded-full px-1">!</span>
                                        @endif
                                    </span>
                                @elseif ($attendance->attendance === 'absent')
                                    <span
                                        class="view-attendance-button cursor-pointer hover:scale-125 hover:shadow-md transition-all transform duration-200 hover:bg-red-200 px-2 inline-flex text-xs leading-5 font-semibold rounded-full border border-red-800 bg-red-100 text-red-800"
                                        data-userId="{{ $user->id }}" data-userFullname="{{ $user->full_name }}"
                                        data-username="{{ $user->username }}" data-userPic="{{ $user->profile_pic }}"
                                        data-date="{{ \Carbon\Carbon::parse($date)->format('F jS, Y') }}"
                                        data-time="{{ \Carbon\Carbon::parse($attendance->check_in)->format('--:--') }}"
                                        data-attendanceId="{{ $attendance->id }}" data-attendance="Absent"
                                        data-status="{{ $attendance->status }}"
                                        data-locationName="{{ $attendance->location ? $attendance->location->name . ' - ' . $attendance->location->campus : '' }}"
                                        data-locationAddress="{{ $attendance->location ? $attendance->location->address : '' }}"
                                        data-locationPic="{{ $attendance->location ? $attendance->location->pic : '' }}"
                                        data-note="{{ $attendance->note }}"
                                        data-approver="{{ $attendance->approver ? $attendance->approver->username : '' }}"
                                        data-approverPic="{{ $attendance->approver ? $attendance->approver->profile_pic : '' }}">
                                        ✕
                                    </span>
                                @endif
                                <span id="{{ $uniqueId }}"
                                    class="span-attendance space-x-2 absolute opacity-0 hidden top-1.5 left-14 z-30 bg-white border border-gray-300 rounded-md py-1.5 px-2 w-auto pr-9">
                                    <img src="{{ $user->profile_pic && file_exists(storage_path('app/public/profilePics/' . $user->profile_pic))
                                        ? asset('storage/profilePics/' . $user->profile_pic)
                                        : asset('assets/images/userPlaceHolder.png') }}"
                                        class="w-6 h-6 rounded-full shadow-md object-cover">
                                    <div>
                                        {{ $user->full_name ?? 'Namauser' }}
                                    </div>
                                </span>
                            @else
                                -
                            @endif
                        </td>
                    @endif
                @endif
            @endforeach

            <td class="px-4 py-3 text-center">
                {{ $user->attendances->whereIn('attendance', ['present', 'late'])->count() }}</td>
            <td class="px-4 py-3 text-center">{{ $user->attendances->count() }}</td>
            <td class="px-4 py-3 text-center flex items-end gap-x-2">
                <div class="flex flex-col items-center w-full">
                    @php
                        $presentLateCount = $user->attendances->whereIn('attendance', ['present', 'late'])->count();
                        $totalCount = $user->attendances->count();
                        $percentage = $totalCount > 0 ? round(($presentLateCount / $totalCount) * 100, 2) : 0;
                        $color = '';
                        if ($percentage >= 80) {
                            $color = 'bg-green-500';
                        } elseif ($percentage >= 50) {
                            $color = 'bg-yellow-500';
                        } else {
                            $color = 'bg-red-500';
                        }
                    @endphp

                    {{ $percentage }}%
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1 flex flex-col">
                        <div class="{{ $color }} h-2.5 rounded-full" style="width: {{ $percentage }}%;">
                        </div>
                    </div>
                </div>
                <i class="reportAttendanceButton fa-solid fa-circle-info relative text-gray-400 hover:scale-125 hover:text-gray-600 transition-all transform duration-100 cursor-pointer" data-userId="{{ $user->id }}" ></i>
            </td>
        </tr>
    @endforeach
@endif
