<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Kehadiran</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg overflow-hidden">
            <div class="bg-gray-800 p-6 text-white">
                <h2 class="text-2xl font-bold text-center">Attendance Form</h2>
                <p class="text-gray-300 text-center text-sm mt-2">
                    Please explain your reason if face verification or location check failed
                </p>
            </div>

            <div class="p-6">
                <form action="{{ route('attendance.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <!-- Location Selection -->
                        <div>
                            <label for="locationOptions" class="block text-sm font-medium text-gray-700 mb-2">
                                Location:
                            </label>
                            <div class="relative">
                                <select name="location" id="locationOptions"
                                    class="w-full p-3 border border-gray-300 rounded-lg appearance-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition duration-150 pr-10">
                                    <option selected disabled hidden>
                                        Select Location
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Reason Textarea -->
                        <div>
                            <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                                Reason:
                            </label>
                            <textarea id="reason" name="reason" rows="4"
                                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition duration-150"
                                placeholder="Write your reason here..."></textarea>
                        </div>

                        <!-- Quick Reason Templates -->
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-3">
                                Quick reason templates:
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <button type="button"
                                    class="template-btn bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full text-sm hover:bg-gray-200 transition duration-200 border border-gray-200">
                                    Macet di jalan
                                </button>
                                <button type="button"
                                    class="template-btn bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full text-sm hover:bg-gray-200 transition duration-200 border border-gray-200">
                                    Kendala transportasi
                                </button>
                                <button type="button"
                                    class="template-btn bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full text-sm hover:bg-gray-200 transition duration-200 border border-gray-200">
                                    Sakit atau kurang fit
                                </button>
                                <button type="button"
                                    class="template-btn bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full text-sm hover:bg-gray-200 transition duration-200 border border-gray-200">
                                    Urusan keluarga mendadak
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-gray-800 text-white px-6 py-3 rounded-lg shadow-md hover:bg-gray-700 transition duration-200 font-medium">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('{{ route('getLocations') }}')
                .then(response => response.json())
                .then(data => {
                    let dropdown = document.getElementById("locationOptions");
                    data.forEach(location => {
                        let option = document.createElement("option");
                        option.value = location.id;
                        option.textContent = `${location.name} - ${location.address}`;
                        dropdown.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));

            // Quick reason template buttons
            document.querySelectorAll('.template-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const reasonText = this.textContent.trim();
                    document.getElementById('reason').value = reasonText;
                });
            });
        });
    </script>
</body>

</html>
