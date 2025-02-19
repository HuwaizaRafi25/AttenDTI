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
        <div class="bg-[#F5F7F3] w-[64vw] h-[90vh] flex justify-start items-center flex-col rounded-lg shadow-lg p-6">
            <h1 class="font-bold text-2xl text-gray-700">ATTENDANCE VERIFICATION</h1>

            <!-- Progress Bar -->
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
                        <span class="absolute text-nowrap -bottom-6 text-base font-semibold">Geofencing</span>
                        <span class="absolute text-nowrap -bottom-10 italic text-sm" id="statusGeofence"></span>
                    </div>
                    <hr class="border-2 border-gray-500 opacity-60 w-full mx-[1px] rounded-full" id="stepLine1">
                    <div class="relative flex justify-center items-center">
                        <div class="flex justify-center items-center w-8 h-8 rounded-full" id="stepContainer2">
                            <div class="bg-white border-2 border-gray-500 opacity-60 w-6 h-6 rounded-full flex justify-center items-center"
                                id="stepSubcontainer2">
                                <div class="bg-gray-500 w-2 h-2 rounded-full" id="stepCircle2"></div>
                            </div>
                            <span class="absolute text-nowrap -bottom-6">Face Recognition</span>
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
                        <span class="absolute text-nowrap -bottom-6">Complete</span>
                    </div>
                </div>
            </div>

            <!-- Panel utama -->
            <div class="mt-8 relative flex flex-col w-full items-center" id="content">
                <!-- Tempat animasi gif loading -->
                <img id="loadingGif" src="{{ asset('assets/images/deals_radar2.gif') }}" class="hidden" alt="Loading..."
                    style="width:480px;">
                <p class="text-lg font-semibold absolute bottom-6">Mencari lokasi Anda...</p>
            </div>
            <div>
                <video id="vid"
                    class="rounded-lg shadow-md w-96 h-64 object-cover bg-black -scale-x-[1] hidden"></video>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.7.4/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // Tampilkan loading gif
        const loadingGif = document.getElementById('loadingGif');
        loadingGif.classList.remove('hidden');
        loadingGif.classList.add('flex');

        // Fungsi untuk mengupdate progress bar
        function markStepCompleted(stepContainer1, stepSubcontainer1, stepCircle1) {
            const stepContainer = document.getElementById(stepContainer1);
            const stepSubcontainer = document.getElementById(stepSubcontainer1);
            const stepCircle = document.getElementById(stepCircle1);

            stepContainer.classList.remove('bg-blue-500/15');
            stepSubcontainer.classList.remove('border-blue-500');
            stepSubcontainer.classList.remove('bg-white');
            stepSubcontainer.classList.add('bg-blue-500');
            stepSubcontainer.classList.add('border-blue-500');
            stepCircle.classList.remove('bg-blue-500');
            stepCircle.classList.add('bg-white');
        }

        function markStepWorking(stepContainer1, stepSubcontainer1, stepCircle1) {
            const stepContainer = document.getElementById(stepContainer1);
            const stepSubcontainer = document.getElementById(stepSubcontainer1);
            const stepCircle = document.getElementById(stepCircle1);

            stepContainer.classList.add('bg-blue-500/15');
            stepSubcontainer.classList.remove('border-gray-500');
            stepSubcontainer.classList.remove('opacity-60');
            stepSubcontainer.classList.add('border-blue-500');
            stepCircle.classList.remove('bg-gray-500');
            stepCircle.classList.add('bg-blue-500');
        }

        // Mengambil lokasi pengguna
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, successCallback, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            });
        } else {
            alert("Geolocation tidak didukung oleh browser Anda.");
        }

        function successCallback(position) {
            // const latitude = position.coords.latitude;
            // const longitude = position.coords.longitude;
            const latitude = -6.88763300;
            const longitude = 107.61179100;

            // Kirim data lokasi ke backend untuk verifikasi
            fetch("{{ url('attendance/verify-location') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        latitude: latitude,
                        longitude: longitude
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // tunggu 3 detik untuk menghapus loadingGif
                    setTimeout(() => {
                        loadingGif.classList.remove('hidden');
                        loadingGif.classList.add('flex');
                        // sembunyikan animasi loading
                        if (data.success) {
                            // Tampilkan pesan sukses dan update progress bar
                            document.getElementById('content').innerHTML = `
                            <p>${data.message}</p>
                            <p>you're doing attendance at ${data.location}</p>
                            `;
                            markStepCompleted('stepContainer1', 'stepSubcontainer1', 'stepCircle1');
                            const stepLine1 = document.getElementById('stepLine1');
                            const vidContainer = document.getElementById('vid');
                            vidContainer.classList.remove('hidden');
                            stepLine1.classList.remove('border-gray-500');
                            stepLine1.classList.remove('opacity-60');
                            stepLine1.classList.add('border-blue-500');

                            markStepWorking('stepContainer2', 'stepSubcontainer2', 'stepCircle2');
                            // Selanjutnya, munculkan instruksi untuk verifikasi gerakan
                            verifyFace()
                            // showMotionVerification();
                        } else {
                            document.getElementById('content').innerHTML = `<p>${data.message}</p>`;
                        }
                    }, 3000);
                })
                .catch(error => {
                    loadingGif.classList.remove('hidden');
                    loadingGif.classList.add('flex');
                    console.error('Error:', error);
                    document.getElementById('content').innerHTML = `<p>Terjadi kesalahan. Silakan coba lagi.</p>`;
                });
        }

        function errorCallback(error) {
            // loadingGif.style.display = 'none';
            // console.error('Error mendapatkan lokasi: ', error);
            // document.getElementById('content').innerHTML = `<p>Gagal mendapatkan lokasi Anda. Silakan periksa pengaturan GPS dan coba lagi.</p>`;
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let video = document.getElementById("vid");
            let mediaDevices = navigator.mediaDevices;
            vid.muted = true;
            // Accessing the user camera and video.
            mediaDevices
                .getUserMedia({
                    video: true,
                    audio: false,
                })
                .then((stream) => {
                    // Changing the source of video to current stream.
                    video.srcObject = stream;
                    video.addEventListener("loadedmetadata", () => {
                        video.play();
                    });
                })
                .catch(alert);
        });
    </script>

    <script>
        let modelsLoaded = false; // Track whether models are loaded

        async function verifyFace() {
            if (!modelsLoaded) {
                console.warn('Models are not loaded yet. Skipping verification.');
                return;
            }

            const videoEl = document.getElementById('vid');
            try {
                const detection = await faceapi.detectSingleFace(videoEl)
                    .withFaceLandmarks()
                    .withFaceDescriptor();

                if (detection) {
                    const descriptor = new Float32Array(detection.descriptor);
                    const binaryString = btoa(String.fromCharCode(...new Uint8Array(descriptor.buffer)));
                    const response = await fetch('/verify-face', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            face_code: binaryString
                        })
                    });
                    const result = await response.json();
                    if (result.match) {
                        // Lanjutkan proses presensi
                        markStepCompleted('stepContainer2', 'stepSubcontainer2', 'stepCircle2');
                        document.getElementById('content').innerHTML = '<p>Verifikasi wajah berhasil!</p>';
                        markStepCompleted('stepContainer2', 'stepSubcontainer2', 'stepCircle2');
                        const stepLine2 = document.getElementById('stepLine2');
                        const vidContainer = document.getElementById('vid');
                        vidContainer.classList.remove('hidden');
                        stepLine2.classList.remove('border-gray-500');
                        stepLine2.classList.remove('opacity-60');
                        stepLine2.classList.add('border-blue-500');
                        markStepWorking('stepContainer3', 'stepSubcontainer3', 'stepCircle3');
                        // nonaktifkan initFaceVerification

                    } else {
                        // Tampilkan pesan error
                        document.getElementById('content').innerHTML =
                            '<p>Verifikasi wajah gagal. Wajah tidak cocok.</p>';
                    }
                } else {
                    console.warn('No face detected.');
                }
            } catch (error) {
                console.error('Error during face verification:', error);
            }
        }

        async function initFaceVerification() {
            try {
                console.log('Loading face-api models...');
                await faceapi.nets.ssdMobilenetv1.loadFromUri('/models');
                await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
                await faceapi.nets.faceRecognitionNet.loadFromUri('/models');
                console.log('Models loaded successfully.');
                modelsLoaded = true; // Mark models as loaded

                // Start periodic face verification
                setInterval(verifyFace, 2000); // Cek setiap 5 detik
            } catch (error) {
                console.error('Error loading models:', error);
            }
        }

        // Initialize face verification when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            initFaceVerification();
        });
    </script>
</body>

</html>
