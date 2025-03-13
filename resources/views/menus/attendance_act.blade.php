<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AttenDTI') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/radar.css') }}">
    @notifyCss
    <style>
        /* Base styles */
        body {
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
        }

        /* Video filter and styles */
        #vid {
            filter: contrast(1.2) brightness(1.1) sepia(0.2) grayscale(0.1) saturate(1.3) hue-rotate(10deg);
            width: 320px;
            height: 320px;
            object-fit: cover;
            transform: scale(-1, 1);
            border-radius: 50%;
            border: 4px solid #3b82f6;
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.5);
            background-color: #000;
        }

        /* Main card */
        .attendance-card {
            background-color: #ffffff;
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        /* Header section */
        .card-header {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            padding: 1.5rem;
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        /* Video overlay effects */
        .video-container {
            position: relative;
            width: 320px;
            height: 320px;
            margin: 2rem auto;
            overflow: hidden;
            clip-path: circle(50% at 50% 50%);
        }


        .scan-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(to bottom,
                    rgba(59, 130, 246, 0) 0%,
                    rgba(59, 130, 246, 0.3) 50%,
                    rgba(59, 130, 246, 0) 100%);
            animation: scanAnimation 2s ease-in-out infinite;
            pointer-events: none;
            z-index: 10;
        }

        .scan-border {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid rgba(59, 130, 246, 0.5);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.5), inset 0 0 15px rgba(59, 130, 246, 0.5);
            animation: pulseBorder 2s ease-in-out infinite;
            pointer-events: none;
            z-index: 10;
        }

        .scan-dots {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: radial-gradient(circle, transparent 60%, rgba(59, 130, 246, 0.1) 100%);
            animation: rotateDots 10s linear infinite;
            pointer-events: none;
            z-index: 9;
        }

        .scan-dots::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle, rgba(59, 130, 246, 0.6) 1px, transparent 1px),
                radial-gradient(circle, rgba(59, 130, 246, 0.6) 1px, transparent 1px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.3;
        }

        .face-target {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 180px;
            height: 220px;
            border: 2px dashed rgba(59, 130, 246, 0.7);
            border-radius: 100px / 120px;
            z-index: 11;
            pointer-events: none;
            animation: targetPulse 3s ease-in-out infinite;
        }

        .face-target::before,
        .face-target::after {
            content: '';
            position: absolute;
            background-color: rgba(59, 130, 246, 0.7);
        }

        .face-target::before {
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 2px;
        }

        .face-target::after {
            top: 50%;
            left: -10px;
            transform: translateY(-50%);
            width: 2px;
            height: 40px;
        }

        /* Corner markers for face target */
        .corner-marker {
            position: absolute;
            width: 10px;
            height: 10px;
            border: 2px solid rgba(59, 130, 246, 0.9);
            z-index: 12;
        }

        .top-left {
            top: -5px;
            left: -5px;
            border-right: none;
            border-bottom: none;
        }

        .top-right {
            top: -5px;
            right: -5px;
            border-left: none;
            border-bottom: none;
        }

        .bottom-left {
            bottom: -5px;
            left: -5px;
            border-right: none;
            border-top: none;
        }

        .bottom-right {
            bottom: -5px;
            right: -5px;
            border-left: none;
            border-top: none;
        }

        /* Step indicators */
        .steps-container {
            height: auto;
            position: relative;
            padding: 1rem 3rem 2.5rem 3rem;
            background-color: #f8fafc;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            /* margin-bottom: 2rem; */
        }

        .step-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-line {
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            height: 3px;
        }

        .step-circle {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-name {
            transition: all 0.3s ease;
        }

        /* Animations */
        @keyframes scanAnimation {
            0% {
                transform: translateY(-100%);
                opacity: 0.7;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(100%);
                opacity: 0.7;
            }
        }

        @keyframes pulseBorder {
            0% {
                opacity: 0.5;
                transform: scale(0.95);
            }

            50% {
                opacity: 1;
                transform: scale(1.02);
            }

            100% {
                opacity: 0.5;
                transform: scale(0.95);
            }
        }

        @keyframes rotateDots {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes targetPulse {
            0% {
                opacity: 0.7;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.7;
            }
        }

        /* Button styles */
        .btn-primary {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.4);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.2));
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 10px -1px rgba(59, 130, 246, 0.5);
        }

        .btn-primary:hover::after {
            transform: translateX(0);
        }

        .btn-primary:active {
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: linear-gradient(to right, #10b981, #059669);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.4);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-secondary::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.2));
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 10px -1px rgba(16, 185, 129, 0.5);
        }

        .btn-secondary:hover::after {
            transform: translateX(0);
        }

        .btn-secondary:active {
            transform: translateY(-1px);
        }

        /* Loading animation */
        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .loading-text {
            margin-top: 1rem;
            color: #4b5563;
            font-size: 1rem;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        /* Error container */
        .error-container {
            animation: fadeIn 0.5s ease-in-out;
            background-color: #fee2e2;
            border-radius: 1rem;
            padding: 1.5rem;
            border-left: 5px solid #ef4444;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Status text */
        .status-text {
            margin-top: 1rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            font-weight: 600;
            text-align: center;
            animation: fadeIn 0.3s ease-in-out;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-left: 3px solid #3b82f6;
        }

        /* Completion container */
        .completion-container {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(186, 230, 253, 0.5);
        }

        /* Profile image container */
        .profile-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #3b82f6;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }

        .profile-badge {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 40px;
            height: 40px;
            background: linear-gradient(to right, #3b82f6, #2563eb);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: badgePulse 2s infinite;
        }

        @keyframes badgePulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        /* User info card */
        .user-info-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* Motivational message */
        .motivational-message {
            background: linear-gradient(to right, #dbeafe, #eff6ff);
            border-radius: 0.75rem;
            padding: 1.25rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-left: 4px solid #3b82f6;
            position: relative;
            overflow: hidden;
        }

        .motivational-message::before {
            content: '"';
            position: absolute;
            top: -20px;
            left: 10px;
            font-size: 80px;
            color: rgba(59, 130, 246, 0.1);
            font-family: serif;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            #vid {
                width: 250px;
                height: 250px;
            }

            .video-container {
                width: 250px;
                height: 250px;
            }

            .face-target {
                width: 150px;
                height: 180px;
            }

            .btn-primary,
            .btn-secondary {
                padding: 0.6rem 1.5rem;
            }
        }
    </style>
</head>

<body class="font-sans min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl">
        <div class="attendance-card w-full min-h-[90vh] flex flex-col">
            <!-- Header -->
            <div class="card-header">
                <h1 class="font-bold text-2xl md:text-3xl">ATTENDANCE VERIFICATION</h1>
                <p class="text-blue-100 text-sm md:text-base mt-2">Complete all steps to verify your attendance</p>
            </div>

            <!-- Content -->
            <div class="flex-1 p-6 md:p-8 flex flex-col">
                <!-- Progress Steps -->
                <div class="steps-container">
                    <div class="w-full flex justify-between items-center">
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

                <!-- Main Content Area -->
                <div class="mt-4 flex-1 flex flex-col items-center justify-center" id="content">
                    <!-- Loading Animation -->
                    <div class="loading-container">
                        {{-- <img id="loadingGif" src="{{ asset('assets/images/deals_radar2.gif') }}" class="w-64 md:w-80"
                            alt="Loading..."> --}}
                            <div class="radar" id="loadingGif">
                                <div class="radar__grid"></div>
                                <div class="radar__line"></div>
                                <div class="radar__trail"></div>
                                <div class="radar__dots">
                                    <div class="radar__dot" style="top: 20%; left: 30%;"></div>
                                    <div class="radar__dot" style="top: 50%; left: 70%;"></div>
                                    <div class="radar__dot" style="top: 80%; left: 20%;"></div>
                                    <div class="radar__dot" style="top: 30%; left: 90%;"></div>
                                    <div class="radar__dot" style="top: 60%; left: 40%;"></div>
                                    <div class="radar__dot" style="top: 40%; left: 20%;"></div>
                                </div>
                                <div class="radar__icon">🏢</div>
                            </div>
                    </div>

                    <!-- Video Element - IMPORTANT: This is the main video element that needs to be shown/hidden -->
                    <div id="videoContainer" class="video-container hidden">
                        <video id="vid" class="hidden" autoplay muted playsinline></video>
                        <div class="scan-animation"></div>
                        <div class="scan-border"></div>
                        <div class="scan-dots"></div>
                        <div class="face-target">
                            <div class="corner-marker top-left"></div>
                            <div class="corner-marker top-right"></div>
                            <div class="corner-marker bottom-left"></div>
                            <div class="corner-marker bottom-right"></div>
                        </div>
                    </div>

                    <!-- Status Text -->
                    <div class="status-text hidden max-w-md mx-auto" id="statusText">Getting your location...</div>

                    <!-- Error Container -->
                    <div id="errorContainer" class="hidden flex-col items-center mt-8 error-container max-w-md mx-auto">
                        <img id="errorImage" src="{{ asset('assets/images/gps_error.png') }}" alt="Geofencing Gagal"
                            class="w-32 h-32 md:w-40 md:h-40 mb-4">
                        <p id="errorMessage" class="text-red-700 text-center font-medium mb-6"></p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button id="retryButton" class="btn-primary">
                                <i class="fas fa-redo mr-2"></i>Coba Lagi
                            </button>
                            <button id="formButton" class="btn-secondary hidden">
                                <i class="fas fa-file-alt mr-2"></i>Ajukan Formulir
                            </button>
                        </div>
                    </div>

                    <!-- Completion Container -->
                    <div class="completion-container flex-col items-center justify-center space-y-6 max-w-md mx-auto hidden"
                        id="completeContainer">
                        <!-- Header -->
                        <div class="flex flex-col items-center space-y-2 text-center">
                            <div class="w-20 h-20 bg-blue-500 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-check text-white text-3xl"></i>
                            </div>
                            <p class="text-2xl font-bold text-blue-600">Attendance Completed!</p>
                            <p class="text-sm text-gray-500">You've successfully recorded your attendance for today.</p>
                        </div>

                        <!-- Profile Picture -->
                        <div class="profile-container mt-4">
                            <img src="{{ asset('storage/profilePics/' . Auth::user()->profile_pic) }}"
                                alt="Profile Picture" class="profile-image">
                            <div class="profile-badge">
                                <i class="fas fa-check text-white text-lg"></i>
                            </div>
                        </div>

                        <!-- User Information -->
                        <div class="user-info-card text-center space-y-3">
                            <p class="text-xl font-bold text-gray-800">{{ Auth::user()->full_name }}</p>
                            <div class="flex justify-center space-x-4 text-sm text-gray-600">
                                <span><i class="fas fa-id-badge mr-1 text-blue-500"></i> {{ Auth::id() }}</span>
                                <span><i class="fas fa-user mr-1 text-blue-500"></i>
                                    {{ Auth::user()->username }}</span>
                            </div>
                            <div class="border-t border-blue-100 my-3 pt-3">
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="bg-blue-50 p-2 rounded-lg">
                                        <p class="text-xs text-gray-500">Date</p>
                                        <p class="text-sm font-medium text-gray-700">
                                            <i class="fas fa-calendar-check mr-1 text-blue-500"></i>
                                            <span id="attendanceDate">{{ date('d M Y') }}</span>
                                        </p>
                                    </div>
                                    <div class="bg-blue-50 p-2 rounded-lg">
                                        <p class="text-xs text-gray-500">Time</p>
                                        <p class="text-sm font-medium text-gray-700">
                                            <i class="fas fa-clock mr-1 text-blue-500"></i>
                                            <span id="attendanceTime">{{ date('H:i:s') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Motivational Message -->
                        <div class="motivational-message text-center">
                            <p class="text-sm text-blue-700 font-medium">"Great job! Consistency is the key to success.
                                Keep up the good work!"</p>
                        </div>

                        <div class="flex justify-center items-center mt-4">
                            <!-- OK Button -->
                            <button id="okButton" class="btn-primary">
                                <i class="fas fa-check-circle mr-2"></i>Done
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.7.4/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <script src="{{ asset('assets/js/attendanceAct.js') }}"></script>
</body>

</html>
