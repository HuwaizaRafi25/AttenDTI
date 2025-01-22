<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full overflow-hidden">
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h2>
            <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-500">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Tutup</span>
            </button>
        </div>
        <div class="p-4">
            <div class="flex items-center space-x-4">
                <img id="imageDelete" src="" alt="Foto Profil" class="w-10 h-10 rounded-full object-cover">
                <div>
                    <p id="nameDelete" class="font-medium text-gray-900"></p>
                    <p id="emailDelete" class="text-sm text-gray-500"></p>
                </div>
            </div>
            <p class="mt-4 text-sm text-gray-600">
                Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>
        <div class="flex justify-end space-x-3 px-4 py-3 bg-gray-50">
            <button onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Batal
            </button>
            <button id="confirmDelete" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Hapus
            </button>
        </div>
    </div>
</div>
