@if ($rafi_members->isEmpty())
    <tr>
        <td colspan="6" class="text-center p-4 text-sm font-medium">
            Pengguna tidak ditemukan.
        </td>
    </tr>
@else
    @foreach ($rafi_members as $rafi_member)
        <tr class="border-b border-gray-200 hover:bg-gray-100"
            data-member-sejak="{{ $rafi_member->created_at->format('d M Y') }}" data-pengguna="{{ $rafi_member->nama }}"
            data-jenis-kelamin="{{ $rafi_member->jenis_kelamin }}" data-telepon="{{ $rafi_member->tlp }}"
            data-alamat="{{ $rafi_member->alamat }}" data-id="{{ $rafi_member->id }}"">
            <td class="py-3 pl-3 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
            <td class="py-3 pl-3 text-left">
                <div class="flex items-center">
                    <img src="{{ $rafi_member->profile_pic ? asset($rafi_member->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                        alt="Profile Picture" class="object-cover w-10 h-10 rounded-full">
                    <div class="ml-3">
                        <span class="block font-semibold text-gray-800">{{ $rafi_member->nama }}</span>
                    </div>
                </div>
            </td>
            <td class="py-3 pl-3 text-left">
                <a href="https://wa.me/{{ $rafi_member->tlp }}" target="_blank"
                    class="flex items-center text-gray-600 hover:text-green-500">
                    <!-- Ikon Telepon -->
                    <span class="bx bx-menu mr-1 scale-90 no-print">
                        {!! file_get_contents(public_path('assets/images/icons/phone.svg')) !!}
                    </span>
                    <!-- Nomor Telepon -->
                    <span class="font-medium">{{ $rafi_member->tlp }}</span>
                </a>
            </td>

            <td class="py-3 pl-3 text-center">
                <div
                    class="no-print text-white {{ $rafi_member->jenis_kelamin === 'L' ? 'bg-blue-400/70' : 'bg-pink-400/70' }} px-2 py-1 rounded-md">
                    {{ $rafi_member->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </div>
                <p class="printable text-center hidden">
                    {{ $rafi_member->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </p>

            </td>
            <td class="py-3 px-6 text-left">
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600 font-semibold">Bergabung sejak:</span>

                    <span
                        class="text-sm text-gray-800">{{ \Carbon\Carbon::parse($rafi_member->created_at)->format('d M Y') }}</span>
                </div>

                <div class="mt-1 flex items-center space-x-2">
                    <span class="text-xs text-gray-500">Lama menjadi member:</span>
                    <span class="text-xs font-medium text-blue-500">
                        {{ \Carbon\Carbon::parse($rafi_member->created_at)->diffInDays(\Carbon\Carbon::now()) }} hari
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
                    <a href="#" data-user-id="{{ $rafi_member->id }}" data-user-nama="{{ $rafi_member->nama }}"
                        data-user-email="{{ $rafi_member->email }}" data-user-pic="{{ $rafi_member->profile_pic }}"
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
