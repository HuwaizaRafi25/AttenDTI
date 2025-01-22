@if ($rafi_outlets->isEmpty())
    <tr>
        <td colspan="6" class="text-center p-4 text-sm font-medium">
            Outlet tidak ditemukan.
        </td>
    </tr>
@else
    @foreach ($rafi_outlets as $rafi_outlet)
        <tr class="border-b border-gray-200 hover:bg-gray-100"
            data-member-sejak="{{ $rafi_outlet->created_at->format('d M Y') }}" data-pengguna="{{ $rafi_outlet->nama }}"
            data-nama-manajer="{{ $rafi_outlet->manajer ? $rafi_outlet->manajer->nama : '' }}" data-pic-manajer="{{ $rafi_outlet->manajer ? $rafi_outlet->manajer->profile_pic  : ''}}" data-telepon="{{ $rafi_outlet->tlp }}"
            data-alamat="{{ $rafi_outlet->alamat }}" data-id="{{ $rafi_outlet->id }}"">
            <td class="py-3 pl-3 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
            <td class="py-3 pl-6 text-center">
                <div class="flex items-center justify-center">
                    <img src="{{ $rafi_outlet->profile_pic ? asset($rafi_outlet->profile_pic) : asset('assets/images/logoti.png') }}"
                        alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                    <div class="ml-3">
                        <span class="block font-semibold text-base text-gray-800">{{ $rafi_outlet->nama }}</span>
                    </div>
                </div>
            </td>
            <td class="py-3 pl-3 text-left">
                <a href="https://wa.me/{{ $rafi_outlet->tlp }}" target="_blank"
                    class="flex items-center text-gray-600 hover:text-green-500">
                    <!-- Ikon Telepon -->
                    <span class="bx bx-menu mr-1 scale-90 no-print">
                        {!! file_get_contents(public_path('assets/images/icons/phone.svg')) !!}
                    </span>
                    <!-- Nomor Telepon -->
                    <span class="font-medium">{{ $rafi_outlet->tlp }}</span>
                </a>
            </td>

            <td class="py-3 px-6 text-left flex flex-col gap-2">
                @if ($rafi_outlet->manajer === null)
                    <p class="text-sm text-gray-600 font-semibold">Belum ada manajer</p>
                @else
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-600 font-semibold">Manajer:</span>
                        <img src="{{ $rafi_outlet->manajer->profile_pic ? asset($rafi_outlet->manajer->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                            alt="Profile Picture" class="object-cover no-print w-6 h-6 rounded-full">
                        <div class="ml-2">
                            <span class="block font-semibold text-gray-800">{{ $rafi_outlet->manajer->nama }}</span>
                        </div>
                    </div>
                @endif
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600 font-semibold">Beroperasi sejak:</span>

                    <span
                        class="text-sm text-gray-800">{{ \Carbon\Carbon::parse($rafi_outlet->created_at)->format('d M Y') }}</span>
                </div>

                <div class="mt-1 flex items-center space-x-2">
                    <span class="text-xs text-gray-500">Lama beroperasi:</span>
                    <span class="text-xs font-medium text-blue-500">
                        {{ \Carbon\Carbon::parse($rafi_outlet->created_at)->diffInDays(\Carbon\Carbon::now()) }} hari
                    </span>
                </div>

            </td>
            <td class="py-3 px-3 text-center no-print">
                <div class="flex item-center pt-6 justify-center">
                    <a href="#"
                        class="view-button w-4 mr-2 scale-125 transform hover:text-green-500 hover:scale-150 transition duration-75">
                        <span class="icon">
                            {!! file_get_contents(public_path('assets/images/icons/showAlt.svg')) !!}
                        </span>
                    </a>
                    <a href="#"
                        class="update-button w-4 mr-2 scale-125 transform hover:text-indigo-500 hover:scale-150 transition duration-75">
                        <span
                            class="bx bx-edit w-4 mr-2 scale-125 transform hover:text-green-500 hover:scale-150 transition duration-75">
                            <span class="icon">
                                {!! file_get_contents(public_path('assets/images/icons/editBold.svg')) !!}
                            </span>
                        </span>
                    </a>
                    <a href="#" data-user-id="{{ $rafi_outlet->id }}" data-user-nama="{{ $rafi_outlet->nama }}"
                        data-user-email="{{ $rafi_outlet->email }}" data-user-pic="{{ $rafi_outlet->profile_pic }}"
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
