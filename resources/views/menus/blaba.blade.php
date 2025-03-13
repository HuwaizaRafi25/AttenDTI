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
                <img id="loadingGif" src="{{ asset('assets/images/deals_radar2.gif') }}" class="hidden" alt="Loading..." style="width:480px;">
                <div>
                    <video id="vid" class="rounded-lg shadow-md w-96 h-64 object-cover bg-black -scale-x-[1] mt-10 hidden"></video>
                </div>
                <div id="errorContainer" class="hidden flex-col items-center mt-4">
                    <img id="errorImage" src="{{ asset('assets/images/gps_error.png') }}" alt="Geofencing Gagal" class="w-48 h-48">
                    <p id="errorMessage" class="text-red-500 text-center mt-2"></p>
                    <button id="retryButton" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Coba Lagi</button>
                    <button id="formButton" class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 hidden">Ajukan Formulir</button>
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



const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
const loadingGif = document.getElementById("loadingGif");
const errorContainer = document.getElementById("errorContainer");
const errorMessage = document.getElementById("errorMessage");
const retryButton = document.getElementById("retryButton");
const formButton = document.getElementById("formButton");
const vidContainer = document.getElementById("vid");
const statusText = document.getElementById("statusText");
let attempts = 0;
let modelsLoaded = false;
let faceVerificationInterval;

function markStepCompleted(stepContainerId, stepSubcontainerId, stepCircleId, stepNameId) {
    const stepContainer = document.getElementById(stepContainerId);
    const stepSubcontainer = document.getElementById(stepSubcontainerId);
    const stepCircle = document.getElementById(stepCircleId);
    const stepName = document.getElementById(stepNameId);
    stepContainer.classList.remove("bg-blue-500/15");
    stepSubcontainer.classList.remove("border-blue-500", "bg-white");
    stepSubcontainer.classList.add("bg-blue-500", "border-blue-500");
    stepCircle.classList.remove("bg-blue-500");
    stepCircle.classList.add("bg-white");
    stepName.classList.remove("font-semibold");
}

function markStepWorking(stepContainerId, stepSubcontainerId, stepCircleId, stepNameId) {
    const stepContainer = document.getElementById(stepContainerId);
    const stepSubcontainer = document.getElementById(stepSubcontainerId);
    const stepCircle = document.getElementById(stepCircleId);
    const stepName = document.getElementById(stepNameId);
    stepContainer.classList.add("bg-blue-500/15");
    stepSubcontainer.classList.remove("border-gray-500", "opacity-60");
    stepSubcontainer.classList.add("border-blue-500");
    stepCircle.classList.remove("bg-gray-500");
    stepCircle.classList.add("bg-blue-500");
    stepName.classList.add("font-semibold");
}

function getLocation() {
    loadingGif.classList.remove("hidden");
    errorContainer.classList.add("hidden");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0,
        });
    } else {
        errorCallback("Geolocation tidak didukung oleh browser Anda.");
    }
}

function successCallback(position) {
    // const { latitude, longitude } = position.coords;
    const latitude = -6.88763300;
    const longitude = 107.61179100;
    fetch("../verify-location", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({ latitude, longitude }),
    })
        .then(response => response.json())
        .then(data => {
            loadingGif.classList.add("hidden");
            if (data.success) {
                attempts = 0;
                markStepCompleted("stepContainer1", "stepSubcontainer1", "stepCircle1", "stepName1");
                document.getElementById("stepLine1").classList.replace("border-gray-500", "border-blue-500");
                document.getElementById("stepLine1").classList.remove("opacity-60");
                vidContainer.classList.remove("hidden");
                markStepWorking("stepContainer2", "stepSubcontainer2", "stepCircle2", "stepName2");
                verifyFace();
            } else {
                errorCallback("Lokasi tidak sesuai");
            }
        })
        .catch(error => errorCallback("Terjadi kesalahan saat verifikasi lokasi"));
}

function errorCallback(error) {
    attempts++;
    loadingGif.classList.add("hidden");
    errorContainer.classList.remove("hidden");
    errorContainer.classList.add("flex");
    if (attempts < 3) {
        errorMessage.textContent = `Gagal mendapatkan lokasi Anda (Percobaan ${attempts}/3). Silakan periksa pengaturan GPS dan coba lagi.`;
        retryButton.classList.remove("hidden");
        formButton.classList.add("hidden");
    } else {
        errorMessage.textContent = "Gagal mendapatkan lokasi Anda setelah 3 percobaan. Silakan ajukan formulir ke admin.";
        retryButton.classList.add("hidden");
        formButton.classList.remove("hidden");
    }
}

async function verifyFace() {
    if (!modelsLoaded) return;
    const videoEl = vidContainer;
    try {
        const detection = await faceapi.detectSingleFace(videoEl).withFaceLandmarks().withFaceDescriptor();
        if (detection) {
            const descriptor = new Float32Array(detection.descriptor);
            const binaryString = btoa(String.fromCharCode(...new Uint8Array(descriptor.buffer)));
            const response = await fetch("/verify-face", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({ face_code: binaryString }),
            });
            const result = await response.json();
            if (result.match) {
                clearInterval(faceVerificationInterval);
                markStepCompleted("stepContainer2", "stepSubcontainer2", "stepCircle2", "stepName2");
                document.getElementById("stepLine2").classList.replace("border-gray-500", "border-blue-500");
                document.getElementById("stepLine2").classList.remove("opacity-60");
                vidContainer.classList.add("hidden");
                markStepWorking("stepContainer3", "stepSubcontainer3", "stepCircle3", "stepName3");
                markStepCompleted("stepContainer3", "stepSubcontainer3", "stepCircle3", "stepName3");
                document.getElementById("completeContainer").classList.remove("hidden");
            } else {
                statusText.classList.remove("hidden");
                statusText.textContent = "Wajah tidak cocok. Silakan coba lagi.";
            }
        }
    } catch (error) {
        console.error("Error during face verification:", error);
    }
}

async function initFaceVerification() {
    try {
        await faceapi.nets.ssdMobilenetv1.loadFromUri("/models");
        await faceapi.nets.faceLandmark68Net.loadFromUri("/models");
        await faceapi.nets.faceRecognitionNet.loadFromUri("/models");
        modelsLoaded = true;
        faceVerificationInterval = setInterval(verifyFace, 2000);
    } catch (error) {
        console.error("Error loading models:", error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then(stream => {
            vidContainer.srcObject = stream;
            vidContainer.addEventListener("loadedmetadata", () => vidContainer.play());
        })
        .catch(error => console.error("Error accessing camera:", error));
    initFaceVerification();
    getLocation();
});

retryButton.addEventListener("click", getLocation);
formButton.addEventListener("click", () => window.location.href = "/formulir");
document.getElementById("okButton").addEventListener("click", () => window.location.href = "/attendances");

fix and make the desain be better, change the camera view when analyzing face recog be rounded and give scanning animation, make the attendance algorithm become perfect too, don't forget to give the code with html and pure javascript cause this is laravel project, not next js
