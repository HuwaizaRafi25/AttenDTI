<div id="userModal" class="fixed inset-0 bg-black bg-opacity-50  items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <button id="closeModal" class="text-gray-400 hover:text-gray-500">
                <img src="{{ asset('assets/images/arrowBack.png') }}" alt="arrowBack" class="scale-90 hover:scale-105"
                    id="backViewButton">
                <span class="sr-only">Tutup</span>
            </button>
            <h2 class="text-lg font-semibold text-gray-900">Detail Paket</h2>
            <div class="w-6"></div> <!-- Spacer for centering -->
        </div>
        <div class="p-6">
            <div class="flex flex-col items-center mb-6">
                <img id="userProfileImage" src="{{ asset('assets/images/icons/paket.svg') }}" alt="User Profile"
                    class="w-32 h-32 rounded-full object-cover bg-gray-100 p-2 shadow-md cursor-pointer mb-4">
                <h3 id="namaPaket" class="text-xl font-semibold">Cuci Kering</h3>
            </div>
            <div class="space-y-4">
                <div class="flex items-center">
                    <span class="bx bx-menu text-blue-400 mr-3 scale-110">
                        {!! file_get_contents(public_path('assets/images/icons/laundry.svg')) !!}
                    </span>
                    <div>
                        <p class="text-sm text-gray-500">Jenis paket:</p>
                        <div id="waLink" class="flex items-center">
                            <span id="jenisPaket">Kiloan</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="bx bx-menu text-green-400 mr-3 scale-110">
                        {!! file_get_contents(public_path('assets/images/icons/money.svg')) !!}
                    </span>
                    <div>
                        <p class="text-sm text-gray-500">Harga:</p>
                        <p id="hargaPaket" class="text-gray-900">Rp25.000,00</p>
                    </div>
                </div>
                @if (Auth::user()->role === 'super_admin')
                <div class="flex items-center">
                    <span class="bx bx-menu text-red-400 mr-3 scale-110">
                        {!! file_get_contents(public_path('assets/images/icons/map.svg')) !!}
                    </span>
                    <div>
                        <p class="text-sm text-gray-500">Outlet:</p>
                        <p id="outletPaket" class="text-gray-900">Wasuhin Cisaat</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
