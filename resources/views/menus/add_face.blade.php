<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Face Registration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f0f2f5;
            font-family: system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .camera-card {
            width: 100%;
            max-width: 500px;
            margin: 20px auto;
            padding: 24px;
            border-radius: 16px;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .camera-container {
            position: relative;
            width: 100%;
            aspect-ratio: 4/3;
            margin: 20px 0;
            overflow: hidden;
            border-radius: 12px;
            background: #000;
        }

        video,
        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #overlay {
            position: absolute;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 10;
            /* Pastikan canvas berada di atas video */
        }

        #scanCanvas {
            z-index: 3;
        }

        .title {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 16px;
            text-align: center;
        }

        #registerBtn {
            width: 100%;
            padding: 12px 24px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        #registerBtn:hover {
            background: #1d4ed8;
        }

        #registerBtn:disabled {
            background: #93c5fd;
            cursor: not-allowed;
        }

        #registerStatus {
            margin-top: 16px;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
        }

        .status-success {
            background: #dcfce7;
            color: #166534;
        }

        .status-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-loading {
            background: #e0f2fe;
            color: #075985;
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 4;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #2563eb;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #vid {
            filter: contrast(1.2) brightness(1.1) sepia(0.2) grayscale(0.1) saturate(1.3) hue-rotate(10deg);
        }
    </style>
</head>

<body>
    <div class="camera-card">
        <h2 class="title">Face Registration</h2>
        <div class="camera-container">
            <video id="vid" autoplay muted playsinline class="-scale-x-[1]"></video>
            <canvas id="overlay"></canvas>
            <canvas id="scanCanvas"></canvas>
            <div id="loadingOverlay" class="loading-overlay" style="display: none;">
                <div class="loading-spinner"></div>
            </div>
        </div>
        <button id="registerBtn" disabled>Register Face</button>
        <div id="registerStatus"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@1.7.4/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <script>
        let scanPosition = 0;
        let modelsLoaded = false;
        let isFaceDetected = false;

        async function loadModels() {
            const loadingOverlay = document.getElementById('loadingOverlay');
            const registerStatus = document.getElementById('registerStatus');
            loadingOverlay.style.display = 'flex';
            registerStatus.className = 'status-loading';
            registerStatus.textContent = 'Loading face detection models...';

            const MODEL_URL = '/models';
            try {
                await faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL);
                await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
                await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);
                modelsLoaded = true;
                registerStatus.className = 'status-success';
                registerStatus.textContent = 'Models loaded successfully';
            } catch (error) {
                registerStatus.className = 'status-error';
                registerStatus.textContent = 'Failed to load models. Please refresh the page.';
                throw error;
            } finally {
                loadingOverlay.style.display = 'none';
            }
        }

        async function startCamera() {
            const videoEl = document.getElementById('vid');
            const registerStatus = document.getElementById('registerStatus');

            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        width: {
                            ideal: 1280
                        },
                        height: {
                            ideal: 720
                        },
                        facingMode: "user"
                    }
                });
                videoEl.srcObject = stream;

                await new Promise(resolve => {
                    videoEl.addEventListener('loadedmetadata', resolve, {
                        once: true
                    });
                });

                registerStatus.className = 'status-success';
                registerStatus.textContent = 'Camera initialized. Please position your face in the frame.';
            } catch (error) {
                registerStatus.className = 'status-error';
                registerStatus.textContent = 'Cannot access camera. Please check permissions.';
                throw error;
            }
        }

function animateScanLine(videoEl) {
    const scanCanvas = document.getElementById('scanCanvas');
    const ctx = scanCanvas.getContext('2d');

    if (!videoEl.videoWidth || !videoEl.videoHeight) {
        console.warn('Video dimensions not available yet. Retrying...');
        setTimeout(() => animateScanLine(videoEl), 100);
        return;
    }

    scanCanvas.width = videoEl.videoWidth;
    scanCanvas.height = videoEl.videoHeight;

    function draw() {
        if (!ctx) {
            console.error('Canvas context not available.');
            return;
        }
        ctx.clearRect(0, 0, scanCanvas.width, scanCanvas.height);
        ctx.beginPath();
        ctx.strokeStyle = 'red';
        ctx.lineWidth = 2;
        ctx.moveTo(0, scanPosition);
        ctx.lineTo(scanCanvas.width, scanPosition);
        ctx.stroke();

        scanPosition += 2;
        if (scanPosition > scanCanvas.height) {
            scanPosition = 0;
        }
        requestAnimationFrame(draw);
    }
    draw();
}

async function detectFaceAndDrawLandmarks() {
    const videoEl = document.getElementById('vid');
    const canvas = document.getElementById('overlay');
    const ctx = canvas.getContext('2d');

    if (!videoEl.videoWidth || !videoEl.videoHeight || !modelsLoaded) {
        requestAnimationFrame(detectFaceAndDrawLandmarks);
        console.log('Waiting for video or models to load...');
        return;
    }

    canvas.width = videoEl.videoWidth;
    canvas.height = videoEl.videoHeight;

    try {
        const detections = await faceapi.detectAllFaces(videoEl).withFaceLandmarks();

        ctx.clearRect(0, 0, canvas.width, canvas.height);

        if (detections.length > 0) {
            isFaceDetected = true;

            detections.forEach(detection => {
                const positions = detection.landmarks.positions;

                ctx.beginPath();
                ctx.strokeStyle = 'white';
                ctx.lineWidth = 1;

                for (let i = 0; i < positions.length; i++) {
                    const p1 = positions[i];
                    if (i + 1 < positions.length && Math.abs(p1.y - positions[i + 1].y) < 50) {
                        ctx.moveTo(p1.x, p1.y);
                        ctx.lineTo(positions[i + 1].x, positions[i + 1].y);
                    }
                    if (i - 1 >= 0 && Math.abs(p1.x - positions[i - 1].x) < 50) {
                        ctx.moveTo(p1.x, p1.y);
                        ctx.lineTo(positions[i - 1].x, positions[i - 1].y);
                    }
                }

                ctx.beginPath();
                ctx.strokeStyle = 'red';
                ctx.lineWidth = 2;

                const midX = (positions[0].x + positions[16].x) / 2;
                ctx.moveTo(midX, 0);
                ctx.lineTo(midX, canvas.height);

                const midY = (positions[0].y + positions[16].y) / 2;
                ctx.moveTo(0, midY);
                ctx.lineTo(canvas.width, midY);

                ctx.stroke();

                positions.forEach(point => {
                    ctx.beginPath();
                    ctx.arc(point.x, point.y, 2, 0, 2 * Math.PI);
                    ctx.fillStyle = 'lime';
                    ctx.fill();
                });
            });
        } else {
            isFaceDetected = false;
        }
    } catch (error) {
        console.error('Face detection error:', error);
    }

    requestAnimationFrame(detectFaceAndDrawLandmarks);
}

        async function registerFace() {
            const videoEl = document.getElementById('vid');
            const registerStatus = document.getElementById('registerStatus');
            const loadingOverlay = document.getElementById('loadingOverlay');

            try {
                loadingOverlay.style.display = 'flex';
                registerStatus.className = 'status-loading';
                registerStatus.textContent = 'Processing face...';

                const detection = await faceapi.detectSingleFace(videoEl)
                    .withFaceLandmarks()
                    .withFaceDescriptor();

                if (detection) {
                    const descriptorArray = new Float32Array(detection.descriptor);
                    const binaryString = btoa(String.fromCharCode(...new Uint8Array(descriptorArray.buffer)));

                    await fetch('/register-face', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                face_code: binaryString,
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                registerStatus.className = 'status-success';
                                registerStatus.textContent = 'Pendaftaran wajah berhasil!';
                            } else {
                                registerStatus.className = 'status-error';
                                registerStatus.textContent = 'Pendaftaran wajah gagal!';
                            }
                        })
                        .catch(error => {
                            registerStatus.className = 'status-error';
                            registerStatus.textContent = 'Terjadi kesalahan pada server.';
                            console.error('Fetch error:', error);
                        });
                } else {
                    registerStatus.className = 'status-error';
                    registerStatus.textContent = 'No face detected. Please try again.';
                }
            } catch (error) {
                registerStatus.className = 'status-error';
                registerStatus.textContent = 'Error registering face. Please try again.';
                console.error('Registration error:', error);
            } finally {
                loadingOverlay.style.display = 'none';
            }
        }

        // Fungsi init
        async function init() {
            try {
                await loadModels();
                await startCamera();

                await new Promise(resolve => setTimeout(resolve, 1000));

                const registerBtn = document.getElementById('registerBtn');
                registerBtn.disabled = false;

                const videoEl = document.getElementById('vid');
                animateScanLine(videoEl);
                detectFaceAndDrawLandmarks();

                registerBtn.addEventListener('click', registerFace);

                console.log('Initialization complete');
            } catch (error) {
                console.error('Initialization error:', error);
            }
        }

        // Panggil init saat DOM siap
        document.addEventListener('DOMContentLoaded', init);
    </script>
</body>

</html>
