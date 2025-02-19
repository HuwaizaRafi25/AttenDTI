@if ($users->isEmpty())
    <tr>
        <td colspan="6" class="text-center p-4 text-sm font-medium">
            User Not Found.
        </td>
    </tr>
@else
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
                                <p style="writing-mode: vertical-rl; transform: rotate(180deg);">{{ $holidaysNames[\Carbon\Carbon::parse($date)->format('Y-m-d')] }}</p>
                            </td>
                        @endif
                    @else
                        <td class="px-4 py-3 text-center bg-gray-200 text-gray-600"></td>
                    @endif
                @else
                    @if (in_array(\Carbon\Carbon::parse($date)->format('Y-m-d'), $holidays))
                        @if ($user === $users->first())
                            <td class="px-4 py-3 text-center bg-red-100 text-red-800" rowspan="{{ $users->count() }}">
                                <p style="writing-mode: vertical-rl; transform: rotate(180deg);">{{ $holidaysNames[\Carbon\Carbon::parse($date)->format('Y-m-d')] }}</p>
                            </td>
                        @endif
                    @else
                        <td class="px-4 py-3 text-center">
                            @php
                                $attendance = $user->attendances->first();
                            @endphp
                            @if ($attendance && \Carbon\Carbon::parse($attendance->created_at)->translatedFormat('Y-m-d') === $date)
                                @if ($attendance->attendance === 'present')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        ✓
                                    </span>
                                @elseif ($attendance->attendance === 'permit')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        ¡
                                    </span>
                                @elseif ($attendance->attendance === 'sick')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        s
                                    </span>
                                @elseif ($attendance->attendance === 'absent')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        ✕
                                    </span>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                    @endif
                @endif
            @endforeach

            <td class="px-4 py-3 text-center">{{ $user->attendances->where('attendance', 'present')->count() }}</td>
            <td class="px-4 py-3 text-center">{{ $user->attendances->count() }}</td>
            <td class="px-4 py-3 text-center"></td>
        </tr>
    @endforeach
@endif
