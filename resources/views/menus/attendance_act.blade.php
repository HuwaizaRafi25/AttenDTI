<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AttenDTI') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @notifyCss
    <style>
        #vid {
            filter: contrast(1.2) brightness(1.1) sepia(0.2) grayscale(0.1) saturate(1.3) hue-rotate(10deg);
        }
    </style>
</head>

<body>
    <div class="w-screen h-screen flex justify-center items-center bg-slate-200">
        <div
            class="bg-[#F5F7F3] w-[64vw] min-h-[90vh] h-auto flex justify-start items-center flex-col rounded-lg shadow-lg p-6">
            <h1 class="font-bold text-2xl text-gray-700">ATTENDANCE VERIFICATION</h1>
            <div class="w-full flex flex-col justify-between items-center mt-8">
                <div class="w-full flex justify-between items-center mt-8 md:px-28 px-8">
                    <div class="relative flex justify-center items-center">
                        <div class="flex justify-center items-center bg-blue-500/15 w-9 h-9 rounded-full"
                            id="stepContainer1">
                            <div class="bg-white border-2 border-blue-500 w-6 h-6 rounded-full flex justify-center items-center"
                                id="stepSubcontainer1">
                                <div class="bg-blue-500 w-2 h-2 rounded-full" id="stepCircle1"></div>
                            </div>
                        </div>
                        <span class="absolute text-nowrap -bottom-6 font-semibold" id="stepName1">Geofencing</span>
                        <span class="absolute text-nowrap -bottom-10 italic text-sm" id="statusGeofence"></span>
                    </div>
                    <hr class="border-2 border-gray-500 opacity-60 w-full mx-[1px] rounded-full" id="stepLine1">
                    <div class="relative flex justify-center items-center">
                        <div class="flex justify-center items-center w-8 h-8 rounded-full" id="stepContainer2">
                            <div class="bg-white border-2 border-gray-500 opacity-60 w-6 h-6 rounded-full flex justify-center items-center"
                                id="stepSubcontainer2">
                                <div class="bg-gray-500 w-2 h-2 rounded-full" id="stepCircle2"></div>
                            </div>
                            <span class="absolute text-nowrap -bottom-6" id="stepName2">Face Recognition</span>
                        </div>
                    </div>
                    <hr class="border-2 border-gray-500 opacity-60 w-full mx-[1px] rounded-full" id="stepLine2">
                    <div class="relative flex justify-center items-center">
                        <div class="flex justify-center items-center w-8 h-8 rounded-full" id="stepContainer3">
                            <div class="bg-white border-2 border-gray-500 opacity-60 w-6 h-6 rounded-full flex justify-center items-center"
                                id="stepSubcontainer3">
                                <div class="bg-gray-500 w-2 h-2 rounded-full" id="stepCircle3"></div>
                            </div>
                        </div>
                        <span class="absolute text-nowrap -bottom-6" id="stepName3">Complete</span>
                    </div>
                </div>
            </div>

            <div class="mt-8 relative flex flex-col w-full items-center" id="content">
                <img id="loadingGif" src="{{ asset('assets/images/deals_radar2.gif') }}" class="hidden" alt="Loading..."
                    style="width:480px;">
                {{-- <p class="text-lg font-semibold absolute bottom-6" id="processText">Getting your location...</p> --}}
                <div>
                    <video id="vid"
                        class="rounded-lg shadow-md w-96 h-64 object-cover bg-black -scale-x-[1] mt-10 hidden"></video>
                </div>
            </div>
            <p class="text-lg font-semibold absolute bottom-6 hidden" id="statusText">Getting your location...</p>
            {{-- Jika proses sudah selesai --}}
            <div class="flex-col items-center justify-center space-y-4 p-6 rounded-lg max-w-md mx-auto hidden"
                id="completeContainer">
                <!-- Header -->
                <div class="flex flex-col items-center space-y-2">
                    <p class="text-2xl font-bold text-blue-600">Attendance Completed!</p>
                    <p class="text-sm text-gray-500">You've successfully recorded your attendance for today.</p>
                </div>

                <!-- Profile Picture -->
                <div class="relative">
                    <img src="{{ asset('storage/profilePics/' . Auth::user()->profile_pic) }}" alt="Profile Picture"
                        class="w-24 h-24 object-cover rounded-full border-4 border-blue-500 shadow-md">
                    <div
                        class="absolute bottom-0 right-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center shadow-md">
                        <img src="{{ asset('assets/images/done.png') }}" alt="Checkmark" class="w-4 h-4">
                    </div>
                </div>

                <!-- User Information -->
                <div class="text-center space-y-1">
                    <p class="text-lg font-semibold text-gray-800">{{ Auth::user()->full_name }}</p>
                    <p class="text-sm text-gray-600">ID: {{ Auth::id() }}</p>
                    <p class="text-sm text-gray-600">Username: {{ Auth::user()->username }}</p>
                </div>

                <!-- Motivational Message -->
                <div class="bg-blue-100 p-3 rounded-lg text-center shadow-sm">
                    <p class="text-sm text-blue-700 font-medium">"Great job! Consistency is the key to success. Keep up
                        the good work!"</p>
                </div>

                <!-- Checkmark Icon -->
                <img src="{{ asset('assets/images/done.png') }}" id="completeIcon"
                    class="w-32 h-32 opacity-0 transition-opacity duration-500 ease-in-out" alt="Completion Icon">

                <div class="flex justify-center items-center space-x-4">
                    <!-- OK Button -->
                    {{-- <button id="retryButton" type="button"
                        class="mt-4 px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-md transition-all duration-300">
                        Retry
                    </button> --}}
                    <button id="okButton"
                        class="mt-4 px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-md transition-all duration-300">
                        OK
                    </button>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.7.4/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <script src="{{ asset('assets/js/attendanceAct.js') }}"></script>

</body>

</html>
