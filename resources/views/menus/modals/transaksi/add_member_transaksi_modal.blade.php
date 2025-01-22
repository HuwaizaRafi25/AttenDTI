<!-- Modal Add User -->
<div id="addMemberTransaksi" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl w-full">
        <div class="flex items-center justify-between mb-4">
            <img id="closeAddMemberTransaksi" src="{{ asset('assets/images/arrowBack.png') }}"
                class="cursor-pointer hover:scale-110 transition-transform duration-200" alt="Back Icon">
            <h2 class="text-xl font-bold mx-auto pr-4">Daftar Member</h2>
        </div>

        <div class="flex flex-col gap-y-1">
            <div class="relative inline-block h-12 w-full -mr-6">
                <!-- Ikon Pencarian -->
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                    <span class="opacity-60 -mt-0.5">
                        {!! file_get_contents(public_path('assets/images/icons/search.svg')) !!}
                    </span>
                </span>
                <!-- Input -->
                <input type="text" name="searchMember" id="searchMember"
                    class="w-full pl-10 border rounded p-2 focus:outline-none focus:border-blue-500"
                    placeholder="Cari Member" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
            </div>

            <div>
                <div id="user-table">
                    <table class="min-w-full table-auto" id="userTable">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 pl-3 text-center">No</th>
                                <th class="py-3 pl-3 text-left">Anggota</th>
                                <th class="py-3 pl-3 text-left ">Kontak</th>
                                <th class="py-3 px-3 text-center no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="content" class="text-gray-600 text-sm font-light">
                            @if ($rafi_all_members->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center p-4 text-sm font-medium">
                                        Pengguna tidak ditemukan.
                                    </td>
                                </tr>
                            @else
                                @foreach ($rafi_all_members as $rafi_member)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100"  data-id="{{ $rafi_member->id }}" data-nama="{{ $rafi_member->nama }}" data-telepon="{{ $rafi_member->tlp }}" data-alamat="{{ $rafi_member->alamat }}">
                                        <td class="py-3 pl-3 text-center whitespace-nowrap">{{ $loop->iteration }}
                                        </td>
                                        <td class="py-3 pl-3 text-left">
                                            <div class="flex items-center">
                                                <img src="{{ $rafi_member->profile_pic ? asset($rafi_member->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                                                    alt="Profile Picture"
                                                    class="object-cover w-10 h-10 rounded-full border border-gray-300 shadow-sm">
                                                <div class="ml-3 flex flex-col">
                                                    <span
                                                        class="block font-semibold text-gray-800">{{ $rafi_member->nama }}</span>
                                                    <span class="block font-semibold text-gray-800">
                                                        @if ($rafi_member->jenis_kelamin == 'L')
                                                            <div class="flex items-center text-blue-600">
                                                                <span class="bx bx-menu no-print"
                                                                    style="scale: 0.7">
                                                                    {!! file_get_contents(public_path('assets/images/icons/lakiLaki.svg')) !!}
                                                                </span>
                                                                <span class="text-xs">Laki-laki</span>
                                                                </p>
                                                            </div>
                                                            @else
                                                            <div class="flex items-center text-pink-600">
                                                                <span class="bx bx-menu no-print"
                                                                    style="scale: 0.7">
                                                                    {!! file_get_contents(public_path('assets/images/icons/perempuan.svg')) !!}
                                                                </span>
                                                                <span class="text-xs">Perempuan</span>
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </span>
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

                                        <td class="py-3 items-center flex justify-center no-print">
                                            <button id="addMemberButton"
                                                class="addMember-button -mt-1 h-10 flex items-center bg-blue-500 text-white font-semibold px-4 text-sm rounded hover:bg-blue-600 transition duration-200">
                                                Pilih
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div id="pagination-container" class="mt-4">
                        {{ $rafi_all_members->links() }}
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
