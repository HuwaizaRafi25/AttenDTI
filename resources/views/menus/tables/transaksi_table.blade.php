@if ($rafi_transactions->isEmpty())
    <tr>
        <td colspan="6" class="text-center p-4 text-sm font-medium">
            Transaksi tidak ditemukan.
        </td>
    </tr>
@else
    @foreach ($rafi_transactions as $rafi_transaction)
        <tr class="border-b border-gray-200 hover:bg-gray-100" data-invoice="{{ $rafi_transaction->kode_invoice }}"
            data-tanggal="{{ $rafi_transaction->tgl->format('d M Y') }}" data-pelanggan="{{ $rafi_transaction->nama_pelanggan }}" data-pelanggan-telepon="{{ $rafi_transaction->tlp_pelanggan }}"
            data-batas-waktu="{{ $rafi_transaction->batas_waktu->format('d M Y') }}"
            data-status-laundry="{{ $rafi_transaction->status_laundry }}"
            data-status-pembayaran="{{ $rafi_transaction->status_pembayaran }}"
            data-biaya-tambahan="{{ 'Rp'.number_format($rafi_transaction->biaya_tambahan, 2, ',', '.') }}" data-diskon="{{ 'Rp'.number_format($rafi_transaction->diskon, 2, ',', '.') }}" data-pajak="{{ 'Rp'.number_format($rafi_transaction->pajak, 2, ',', '.') }}" data-total="{{ 'Rp'.number_format($rafi_transaction->total_bayar, 2, ',', '.') }}" data-id="{{ $rafi_transaction->id }}">
            <td class="py-3 pl-3 text-center whitespace-nowrap">{{ $loop->iteration }}</td>
            <td class="py-3 pl-3 text-center whitespace-nowrap">
                <div class="flex items-center text-gray-600">
                    <!-- Ikon Telepon -->
                    <span class="bx bx-menu mr-1 scale-90 no-print">
                        {!! file_get_contents(public_path('assets/images/icons/receipt.svg')) !!}
                    </span>
                    <!-- Nomor Telepon -->
                    <span class="font-medium">{{ $rafi_transaction->kode_invoice }}</span>
                </div>
            </td>
            <td class="py-3 pl-3 text-left">
                <div class="flex items-center">
                    <!-- Gambar Profil -->
                    <img src="{{ asset('assets/images/userPlaceHolder.png') }}" alt="Profile Picture"
                        class="object-cover w-10 h-10 rounded-full border border-gray-300 shadow-sm">

                    <!-- Informasi Pelanggan -->
                    <div class="ml-3">
                        <!-- Nama dan Status Member -->
                        <div class="flex items-center gap-x-2">
                            <!-- Nama dengan ellipsis -->
                            <span class="font-semibold text-gray-800 truncate max-w-[50px] block"
                                title="{{ $rafi_transaction->nama_pelanggan }}">
                                {{ $rafi_transaction->nama_pelanggan }}
                            </span>
                            <!-- Status Member (Tetap utuh) -->
                            @if (!empty($rafi_transaction->id_member))
                                <span class="flex items-center text-blue-600/85 font-medium gap-x-1">
                                    <span class="bx bx-menu scale-75 no-print">
                                        {!! file_get_contents(public_path('assets/images/icons/member2.svg')) !!}
                                    </span>
                                    <span>Member</span>
                                </span>
                            @endif
                        </div>
                        <!-- Nomor Telepon -->
                        <span class="block text-gray-600 text-sm">{{ $rafi_transaction->tlp_pelanggan }}</span>
                    </div>
                </div>
            </td>

            <td class="py-3 pl-3 text-center">
                <p class="text-base font-semibold">
                    {{ 'Rp' . number_format($rafi_transaction->total_bayar, 2, ',', '.') }}
                </p>
            </td>

            <td class="py-3 px-6 text-left flex flex-col gap-y-4">
                <!-- Status Laundry -->
                <div class="flex flex-col">
                    <p class="font-medium text-gray-800">Status Laundry:</p>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                        @php
                            $progressData = match ($rafi_transaction->status_laundry) {
                                'baru' => ['percentage' => 25, 'color' => 'bg-red-500', 'icon' => 'time'],
                                'proses' => ['percentage' => 50, 'color' => 'bg-orange-500', 'icon' => 'laundry'],
                                'selesai' => ['percentage' => 75, 'color' => 'bg-yellow-500', 'icon' => 'timeFive'],
                                'diambil' => ['percentage' => 100, 'color' => 'bg-green-500', 'icon' => 'check'],
                                default => ['percentage' => 0, 'color' => 'bg-gray-500', 'icon' => 'error'],
                            };
                        @endphp
                        <div class="h-2.5 rounded-full {{ $progressData['color'] }}"
                            style="width: {{ $progressData['percentage'] }}%;"></div>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <span class="w-4 h-4 inline-block">
                            <img src="{{ asset('assets/images/icons/' . $progressData['icon'] . '.svg') }}"
                                alt="{{ $rafi_transaction->status_laundry }}" class="w-full h-full">
                        </span>
                        <span class="text-sm font-medium text-gray-700">
                            {{ ucfirst($rafi_transaction->status_laundry) }}
                        </span>
                    </div>
                </div>

                <hr>

                <!-- Status Pembayaran -->
                <div class="flex flex-col">
                    <p class="font-medium text-gray-800">Status Pembayaran:</p>
                    <div class="flex items-center">
                        @php
                            $paymentStatus =
                                $rafi_transaction->status_pembayaran === 'dibayar'
                                    ? ['text' => 'Dibayar', 'color' => 'bg-green-100 text-green-700']
                                    : ['text' => 'Belum Dibayar', 'color' => 'bg-red-100 text-red-700'];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $paymentStatus['color'] }}">
                            {{ $paymentStatus['text'] }}
                        </span>
                    </div>
                </div>
            </td>


            <td class="py-3 px-6 text-left">
                <div class="flex flex-col items-start space-x-2">
                    <span class="text-sm text-gray-600 font-semibold">Tanggal Transaksi:</span>
                    <span
                        class="text-sm text-gray-800">{{ \Carbon\Carbon::parse($rafi_transaction->created_at)->format('d M Y') }}</span>
                </div>
                <div class="flex flex-col items-start space-x-2">
                    <span class="text-sm text-gray-600 font-semibold">Tanggal Bayar:</span>
                    <span class="text-sm text-gray-800">
                        {{ $rafi_transaction->tgl_bayar ? $rafi_transaction->tgl_bayar->format('d M Y') : '-' }}
                    </span>
                </div>
                <div class="flex flex-col items-start space-x-2 space-y-1">
                    <span class="text-sm text-gray-600 font-semibold">Dilayani Oleh:</span>
                    <div class="flex">
                        <img src="{{ $rafi_transaction->user->profile_pic ? asset($rafi_transaction->user->profile_pic) : asset('assets/images/userPlaceHolder.png') }}"
                            alt="Profile Picture" class="object-cover w-6 h-6 rounded-full">
                        <div class="ml-2">
                            <span class="block font-semibold text-gray-800">{{ $rafi_transaction->user->nama }}</span>
                        </div>
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
                    @if ($rafi_transaction->status_laundry == 'diambil' && $rafi_transaction->status_pembayaran == 'dibayar')   

                @else
                <a href="#"
                class="update-button w-4 mr-2 scale-125 transform hover:text-blue-500 hover:scale-150 transition duration-75">
                <span class="icon">
                    {!! file_get_contents(public_path('assets/images/icons/editBold.svg')) !!}
                </span>
                </a>    
                @endif
                </div>
            </td>
        </tr>
    @endforeach
@endif
