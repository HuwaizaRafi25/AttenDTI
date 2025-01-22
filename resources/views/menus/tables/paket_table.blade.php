@if ($rafi_packages->isEmpty())
    <tr>
        <td colspan="6" class="text-center p-4 text-sm font-medium">
            Paket tidak ditemukan.
        </td>
    </tr>
@else
    @foreach ($rafi_packages as $rafi_package)
        <tr class="border-b border-gray-200 hover:bg-gray-100" data-paket="{{ $rafi_package->nama_paket }}"
            data-jenis="{{ $rafi_package->jenis }}" data-harga="{{ $rafi_package->harga }}"
            data-outlet="{{ $rafi_package->outlet->nama }}" data-outletid="{{ $rafi_package->id_outlet }}" data-id="{{ $rafi_package->id }}">
            <td class="py-3 pl-3 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
            <td class="py-3 pl-3 text-left">
                <div class="flex items-center">
                    <img src="{{ $rafi_package->profile_pic ? asset($rafi_package->profile_pic) : asset('assets/images/icons/paket.svg') }}"
                        alt="Profile Picture" class="object-cover w-6 h-6 rounded-full">
                    <div class="ml-2">
                        <span class="block font-semibold text-gray-800">{{ $rafi_package->nama_paket }}</span>
                    </div>
                </div>
            </td>
            <td class="py-3 pl-6 text-left">
                @if ($rafi_package->jenis == null)
                    <span class="text-white bg-yellow-400 px-2 py-1 rounded-md">B/T</span>
                @else
                    <div class="bg-blue-400 min-w-[100px] py-1 rounded-md inline-block text-center">
                        <span class="text-white">{{ $rafi_package->jenis }}</span>
                    </div>
                @endif
            </td>

            <td class="py-3 pl-3 text-center">
                <p class="text-base font-semibold">
                    {{ 'Rp'.number_format($rafi_package->harga, 0, ',', '.') }}
                </p>
                </td>
            <td class="py-3 px-6 text-center">
                <div class="flex items-center justify-center">
                    <img src="{{ $rafi_package->outlet->profile_pic ? asset($rafi_package->outlet->profile_pic) : asset('assets/images/logoti.png') }}"
                        alt="Profile Picture" class="object-cover w-8 h-8 no-print rounded-full">
                    <div class="ml-3">
                        <span class="block font-semibold text-base text-gray-800">{{ $rafi_package->outlet->nama }}</span>
                    </div>
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
                    <a href="#" data-user-id="{{ $rafi_package->id }}" data-user-nama="{{ $rafi_package->nama }}"
                        data-user-email="{{ $rafi_package->email }}" data-user-pic="{{ $rafi_package->profile_pic }}"
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
