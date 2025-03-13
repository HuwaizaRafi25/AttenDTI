<!-- Absence Reporting Modal -->
<div id="absentModal" class="fixed inset-0 items-center justify-center bg-black/50 backdrop-blur-sm z-50 hidden">
    <div class="bg-white rounded-xl shadow-lg p-6 m-4 max-w-md w-full animate-fade-in">
        <div class="flex items-center pb-4 mb-2 justify-between border-b">
            <h2 class="text-xl font-semibold text-gray-800">Report Absence</h2>
            <button id="closeAddUserModal" class="text-gray-500 hover:text-gray-700 transition-colors duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>

        <form id="absentForm" action="{{ route('attendance.absent') }}" method="POST" class="space-y-5">
            @csrf
            <div class="space-y-4">
                <!-- Absence Type Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Absence Type <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="absence-option">
                            <input type="radio" id="sick" name="absenceType" value="sick" class="peer hidden" required>
                            <label for="sick" class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-lg cursor-pointer transition-all duration-200 hover:bg-gray-50 peer-checked:border-green-500 peer-checked:bg-green-50">
                                <div class="mb-2 p-2 bg-red-100 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-700">Sick Leave</span>
                            </label>
                        </div>

                        <div class="absence-option">
                            <input type="radio" id="permit" name="absenceType" value="permit" class="peer hidden" required>
                            <label for="permit" class="flex flex-col items-center justify-center p-4 border border-gray-200 rounded-lg cursor-pointer transition-all duration-200 hover:bg-gray-50 peer-checked:border-green-500 peer-checked:bg-green-50">
                                <div class="mb-2 p-2 bg-blue-100 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-700">Permit</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Note Field -->
                <div>
                    <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                        Reason <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        name="note"
                        id="note"
                        rows="3"
                        placeholder="Please provide details about your absence..."
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-0 focus:ring-green-500 focus:border-green-500 transition-all duration-200"
                        required
                    ></textarea>
                    <p class="text-xs text-gray-500 mt-1">Please provide specific details to help us process your request faster.</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 pt-2 border-t">
                <button
                    type="button"
                    id="closeAbsentButton"
                    class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center gap-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

