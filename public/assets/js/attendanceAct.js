document.addEventListener("DOMContentLoaded", () => {
    // DOM Elements
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    const loadingGif = document.getElementById("loadingGif");
    const errorContainer = document.getElementById("errorContainer");
    const errorMessage = document.getElementById("errorMessage");
    const retryButton = document.getElementById("retryButton");
    const formButton = document.getElementById("formButton");
    const vidContainer = document.getElementById("vid");
    const statusText = document.getElementById("statusText");
    const completeContainer = document.getElementById("completeContainer");
    const videoContainer = document.getElementById("videoContainer");

    // State variables
    let currentStep = "location"; // "location", "face", "complete"
    let attempts = 0;
    let modelsLoaded = false;
    let faceVerificationInterval;
    let mediaStream = null;
    let faceAttempts = 0;
    const maxFaceAttempts = 3;

    let locationId = 0;

    function markStepCompleted(stepContainerId, stepSubcontainerId, stepCircleId, stepNameId) {
        const stepContainer = document.getElementById(stepContainerId);
        const stepSubcontainer = document.getElementById(stepSubcontainerId);
        const stepCircle = document.getElementById(stepCircleId);
        const stepName = document.getElementById(stepNameId);
        stepContainer.classList.remove("bg-blue-500/15");
        stepSubcontainer.classList.remove("border-blue-500", "bg-white", "opacity-60");
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
        currentStep = "location";
        loadingGif.classList.remove("hidden");
        errorContainer.classList.add("hidden");
        statusText.classList.remove("hidden");
        statusText.textContent = "Sedang mengambil lokasi...";
        setTimeout(() => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0,
                });
            } else {
                errorCallback("Geolocation tidak didukung oleh browser Anda.");
            }
        }, 3000);
    }

    function successCallback(position) {
        // const { latitude, longitude } = position.coords;
        const latitude = -6.88903200;
        const longitude = 107.61114700;
        fetch("../verify-location", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({ latitude, longitude }),
        })
            .then(response => {
                if (!response.ok) throw new Error("Network response was not ok");
                return response.json();
            })
            .then(data => {
                loadingGif.classList.add("hidden");
                if (data.success) {
                    attempts = 0;
                    markStepCompleted("stepContainer1", "stepSubcontainer1", "stepCircle1", "stepName1");
                    markStepWorking("stepContainer2", "stepSubcontainer2", "stepCircle2", "stepName2");
                    document.getElementById("stepLine1").classList.replace("border-gray-500", "border-blue-500");
                    document.getElementById("stepLine1").classList.remove("opacity-60");
                    statusText.textContent = "Lokasi terverifikasi. Memulai pengenalan wajah...";
                    currentStep = "face";
                    vidContainer.classList.remove("hidden"); // Tampilkan video
                    videoContainer.classList.remove("hidden");
                    startCamera(); // Mulai kamera
                    initFaceVerification(); // Mulai verifikasi wajah
                    locationId = data.locationId;
                } else {
                    errorCallback("Lokasi tidak sesuai");
                    statusText.classList.add("hidden");
                }
            })
            .catch(error => errorCallback(`Terjadi kesalahan saat verifikasi lokasi: ${error.message}`));
    }

    function errorCallback(error, type = "geofence") {
        loadingGif.classList.add("hidden");
        errorContainer.classList.remove("hidden");
        errorContainer.classList.add("flex");

        let currentAttempts, maxAttempts, baseText;
        const errorImg = document.getElementById("errorImage");

        if (type === "face") {
            faceAttempts++;
            currentAttempts = faceAttempts;
            maxAttempts = maxFaceAttempts;
            errorImg.src = `/assets/images/face_error.png`;
            errorImg.alt = "Verifikasi Wajah Gagal";
            baseText = error;
        } else {
            attempts++;
            currentAttempts = attempts;
            maxAttempts = 3;
            errorImg.src = `/assets/images/gps_error.png`;
            errorImg.alt = "Geofencing Gagal";
            baseText = "Gagal mendapatkan lokasi Anda";
        }

        if (currentAttempts < maxAttempts) {
            errorMessage.textContent = `${baseText} (Percobaan ${currentAttempts}/${maxAttempts}). Silakan periksa pengaturan dan coba lagi.`;
            retryButton.classList.remove("hidden");
            formButton.classList.add("hidden");
        } else {
            errorMessage.textContent = `${baseText} setelah ${maxAttempts} percobaan. Silakan ajukan formulir ke admin.`;
            retryButton.classList.add("hidden");
            formButton.classList.remove("hidden");
        }
    }

    // Fungsi untuk retry verifikasi wajah
    function retryFaceVerification() {
        errorContainer.classList.add("hidden");
        errorContainer.classList.remove("flex");
        // faceAttempts = 0;
        statusText.classList.remove("hidden");
        statusText.textContent = "Mencoba verifikasi wajah kembali...";
        videoContainer.classList.remove("hidden");
        startCamera();
        // Pastikan untuk menghapus interval yang lama sebelum memulai yang baru
        if (faceVerificationInterval) clearInterval(faceVerificationInterval);
        faceVerificationInterval = setInterval(verifyFace, 2000);
    }

    // Verifikasi wajah dengan maksimal 3 kesempatan
    async function verifyFace() {
        if (!modelsLoaded) return;
        try {
            const detection = await faceapi.detectSingleFace(vidContainer)
                .withFaceLandmarks()
                .withFaceDescriptor();
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
                    stopCamera();
                    videoContainer.classList.add("hidden");
                    markStepCompleted("stepContainer3", "stepSubcontainer3", "stepCircle3", "stepName3");
                    completeContainer.classList.remove("hidden");
                    statusText.classList.add("hidden");
                    currentStep = "complete";
                    console.log(locationId);

                    await fetch('../store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            location_id: locationId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Presensi berhasil coy');
                        } else {
                            console.error('Presensi gagal coy');
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                    });
                } else {
                    clearInterval(faceVerificationInterval);
                    // Wajah terdeteksi, namun tidak cocok
                    errorCallback("Wajah tidak cocok", "face");
                    videoContainer.classList.add("hidden");
                    stopCamera();
                    statusText.classList.add("hidden");
                }
            } else {
                clearInterval(faceVerificationInterval);
                // Tidak ada wajah terdeteksi
                errorCallback("Wajah tidak terdeteksi", "face");
                videoContainer.classList.add("hidden");
                stopCamera();
                statusText.classList.add("hidden");
            }
        } catch (error) {
            console.error("Error during face verification:", error);
            clearInterval(faceVerificationInterval);
            errorCallback("Terjadi kesalahan saat verifikasi wajah. Silakan coba lagi.", "face");
        }
    }


    async function initFaceVerification() {
        try {
            statusText.textContent = "Memuat model pengenalan wajah...";
            await faceapi.nets.ssdMobilenetv1.loadFromUri("/models");
            await faceapi.nets.faceLandmark68Net.loadFromUri("/models");
            await faceapi.nets.faceRecognitionNet.loadFromUri("/models");
            modelsLoaded = true;
            statusText.textContent = "Model dimuat. Memulai verifikasi wajah...";
            // Mulai verifikasi wajah secara periodik
            faceVerificationInterval = setInterval(verifyFace, 2000);
        } catch (error) {
            console.error("Error loading models:", error);
            statusText.textContent = "Gagal memuat model pengenalan wajah. Silakan muat ulang halaman.";
        }
    }

    // Kontrol kamera
    function startCamera() {
        navigator.mediaDevices.getUserMedia({ video: true, audio: false })
            .then(stream => {
                mediaStream = stream;
                vidContainer.srcObject = stream;
                vidContainer.addEventListener("loadedmetadata", () => vidContainer.play());
            })
            .catch(error => {
                console.error("Error accessing camera:", error);
                statusText.textContent = "Gagal mengakses kamera. Silakan periksa izin kamera.";
            });
    }

    function stopCamera() {
        if (mediaStream) {
            mediaStream.getTracks().forEach(track => track.stop());
            vidContainer.srcObject = null;
            mediaStream = null;
        }
    }

    window.addEventListener("beforeunload", stopCamera);

    // Event listener Retry yang memanggil fungsi berbeda sesuai step
    retryButton.addEventListener("click", () => {
        errorContainer.classList.add("hidden");
        if (currentStep === "location") {
            getLocation();
        } else if (currentStep === "face") {
            retryFaceVerification();
        }
    });

    formButton.addEventListener("click", () => window.location.href = "/attendance/form");
    document.getElementById("okButton").addEventListener("click", () => window.location.href = "/attendances");

    // Mulai proses
    getLocation();
});
