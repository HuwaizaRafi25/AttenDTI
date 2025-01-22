<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'AttenDTI') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @notifyCss
</head>

<body class="bg-gray-50 p-8">
    <div class="min-h-screen flex flex-col items-center">
        <div class="max-w-6xl w-full">
            <div class="flex items-center mb-8">
                <a href="/overview">
                    <h1><i class="fa-solid fa-arrow-left"></i></h1>
                </a>
                <h1 class="text-2xl font-bold text-gray-900 ml-6">Account Settings</h1>
            </div>

            <div class="flex space-x-6">
                <div class="flex-[3] bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-4">Personal Information</h4>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                                        <input type="text" value="Fauzi Eka"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                        <input type="text" value="Putra"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                                        <input type="number" value="08134834"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">NISN</label>
                                        <input type="number" value="21481204"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50">
                                    </div>
                                    <div class="mt-6">
                                        <label class="block text-sm font-medium text-gray-700">Full Address</label>
                                        <input type="text" value="Komplek Cibogo Permai"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50">
                                    </div>
                                    <div class="mt-6">
                                        <label class="block text-sm font-medium text-gray-700">School</label>
                                        <input type="text" value="SMK TI Pembangunan"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50">
                                    </div>
                                </div>
                            </div>

                            <!-- <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-4">School</h4>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Province</label>
                                        <input type="text" value="Jawa Barat"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">City</label>
                                        <input type="text" value="Cimahi"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">School</label>
                                        <input type="text" value="SMK TI Pembangunan"
                                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button
                                class="mt-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex-[1] w-64">
                    <div
                        class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 px-6 py-8 sticky top-20 border gradient-border">
                        <div class="flex flex-col items-center justify-center space-y-4">
                            <div class="relative group">
                                <div
                                    class="w-32 h-32 rounded-full overflow-hidden ring-4 ring-indigo-100 group-hover:ring-indigo-300 transition-all duration-300">
                                    <img src="{{ asset('assets/images/userPlaceHolder.png') }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                        alt="Profile Picture">
                                </div>
                                <div
                                    class="absolute bottom-0 right-0 w-6 h-6 bg-green-400 rounded-full border-4 border-white">
                                </div>
                            </div>

                            <div class="text-center space-y-2">
                                <h3 class="text-xl font-bold text-gray-900">@Fauzzii._</h3>
                                <p class="text-indigo-600">fauziekaputra@gmail.com</p>
                                <div class="flex items-center justify-center text-sm text-gray-500 space-x-2">
                                    <i class="fa-regular fa-calendar"></i>
                                    <p>2 Jan 2025 - 12 Apr 2025</p>
                                </div>
                                <div class="flex items-center justify-center text-sm text-gray-500 space-x-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <p>Aquarium CRCS, ITB Ganesha</p>
                                </div>
                            </div>

                            <button
                                class="mt-4 px-6 py-3 rounded-xl bg-gray-100 hover:bg-gray-200 transition-all font-medium">
                                Edit Profile
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
