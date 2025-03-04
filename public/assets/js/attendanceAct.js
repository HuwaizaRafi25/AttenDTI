const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");
const loadingGif = document.getElementById("loadingGif");
loadingGif.classList.remove("hidden");
loadingGif.classList.add("flex");
const locationId = null;
const longitude = null;
const latitude = null;

function attendanceStore(locationId, longitude, latitude) {
    fetch("../store", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            locationId: locationId,
            latitude: latitude,
            longitude: longitude,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            setTimeout(() => {
                loadingGif.classList.remove("hidden");
                loadingGif.classList.add("flex");
                if (data.success) {
                    loadingGif.classList.add("hidden");
                    loadingGif.classList.remove("flex");
                    markStepCompleted(
                        "stepContainer1",
                        "stepSubcontainer1",
                        "stepCircle1",
                        "stepName1"
                    );
                    const stepLine1 = document.getElementById("stepLine1");
                    const vidContainer = document.getElementById("vid");
                    vidContainer.classList.remove("hidden");
                    stepLine1.classList.remove("border-gray-500");
                    stepLine1.classList.remove("opacity-60");
                    stepLine1.classList.add("border-blue-500");
                    markStepWorking(
                        "stepContainer2",
                        "stepSubcontainer2",
                        "stepCircle2",
                        "stepName2"
                    );
                    verifyFace();
                } else {
                    document.getElementById(
                        "content"
                    ).innerHTML = `<p>Gagal</p>`;
                }
            }, 3000);
        })
        .catch((error) => {
            loadingGif.classList.remove("hidden");
            loadingGif.classList.add("flex");
            console.error("Error:", error);
            document.getElementById(
                "content"
            ).innerHTML = `<p>Terjadi kesalahan. Silakan coba lagi.</p>`;
        });
}

function markStepCompleted(
    stepContainerId,
    stepSubcontainerId,
    stepCircleId,
    stepNameId
) {
    const stepContainer = document.getElementById(stepContainerId);
    const stepSubcontainer = document.getElementById(stepSubcontainerId);
    const stepCircle = document.getElementById(stepCircleId);
    const stepName = document.getElementById(stepNameId);

    stepContainer.classList.remove("bg-blue-500/15");
    stepSubcontainer.classList.remove("border-blue-500");
    stepSubcontainer.classList.remove("bg-white");
    stepSubcontainer.classList.add("bg-blue-500");
    stepSubcontainer.classList.add("border-blue-500");
    stepCircle.classList.remove("bg-blue-500");
    stepCircle.classList.add("bg-white");
    stepName.classList.remove("font-semibold");
}

function markStepWorking(
    stepContainerId,
    stepSubcontainerId,
    stepCircleId,
    stepNameId
) {
    const stepContainer = document.getElementById(stepContainerId);
    const stepSubcontainer = document.getElementById(stepSubcontainerId);
    const stepCircle = document.getElementById(stepCircleId);
    const stepName = document.getElementById(stepNameId);

    stepContainer.classList.add("bg-blue-500/15");
    stepSubcontainer.classList.remove("border-gray-500");
    stepSubcontainer.classList.remove("opacity-60");
    stepSubcontainer.classList.add("border-blue-500");
    stepCircle.classList.remove("bg-gray-500");
    stepCircle.classList.add("bg-blue-500");
    stepName.classList.add("font-semibold");
}

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {
        enableHighAccuracy: true,
        timeout: 10000,
        maximumAge: 0,
    });
} else {
    alert("Geolocation tidak didukung oleh browser Anda.");
}

function successCallback(position) {
    const latitude = -6.887633;
    const longitude = 107.611791;

    fetch("../verify-location", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            latitude: latitude,
            longitude: longitude,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            setTimeout(() => {
                loadingGif.classList.remove("hidden");
                loadingGif.classList.add("flex");
                if (data.success) {
                    loadingGif.classList.add("hidden");
                    loadingGif.classList.remove("flex");
                    markStepCompleted(
                        "stepContainer1",
                        "stepSubcontainer1",
                        "stepCircle1",
                        "stepName1"
                    );
                    const stepLine1 = document.getElementById("stepLine1");
                    const vidContainer = document.getElementById("vid");
                    vidContainer.classList.remove("hidden");
                    stepLine1.classList.remove("border-gray-500");
                    stepLine1.classList.remove("opacity-60");
                    stepLine1.classList.add("border-blue-500");
                    markStepWorking(
                        "stepContainer2",
                        "stepSubcontainer2",
                        "stepCircle2",
                        "stepName2"
                    );
                    verifyFace();
                } else {
                    document.getElementById(
                        "content"
                    ).innerHTML = `<p>Gagal</p>`;
                }
            }, 3000);
        })
        .catch((error) => {
            loadingGif.classList.remove("hidden");
            loadingGif.classList.add("flex");
            console.error("Error:", error);
            document.getElementById(
                "content"
            ).innerHTML = `<p>Terjadi kesalahan. Silakan coba lagi.</p>`;
        });
}

function errorCallback(error) {
    loadingGif.classList.add("hidden");
    console.error("Error mendapatkan lokasi: ", error);
    document.getElementById(
        "content"
    ).innerHTML = `<p>Gagal mendapatkan lokasi Anda. Silakan periksa pengaturan GPS dan coba lagi.</p>`;
}

document.addEventListener("DOMContentLoaded", () => {
    let video = document.getElementById("vid");
    let mediaDevices = navigator.mediaDevices;
    vid.muted = true;
    mediaDevices
        .getUserMedia({
            video: true,
            audio: false,
        })
        .then((stream) => {
            video.srcObject = stream;
            video.addEventListener("loadedmetadata", () => {
                video.play();
            });
        })
        .catch(alert);

    initFaceVerification();
});

let modelsLoaded = false;
let faceVerificationInterval;

async function verifyFace() {
    if (!modelsLoaded) {
        console.warn("Models are not loaded yet. Skipping verification.");
        return;
    }

    const videoEl = document.getElementById("vid");
    try {
        const detection = await faceapi
            .detectSingleFace(videoEl)
            .withFaceLandmarks()
            .withFaceDescriptor();

        if (detection) {
            const descriptor = new Float32Array(detection.descriptor);
            const binaryString = btoa(
                String.fromCharCode(...new Uint8Array(descriptor.buffer))
            );
            const response = await fetch("/verify-face", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({
                    face_code: binaryString,
                }),
            });
            const result = await response.json();
            if (result.match) {
                clearInterval(faceVerificationInterval);
                markStepCompleted(
                    "stepContainer2",
                    "stepSubcontainer2",
                    "stepCircle2",
                    "stepName2"
                );
                const stepLine2 = document.getElementById("stepLine2");
                const vidContainer = document.getElementById("vid");
                vidContainer.classList.add("hidden");
                stepLine2.classList.remove("border-gray-500");
                stepLine2.classList.remove("opacity-60");
                stepLine2.classList.add("border-blue-500");
                document.getElementById("statusText").classList.add("hidden");
                markStepWorking(
                    "stepContainer3",
                    "stepSubcontainer3",
                    "stepCircle3",
                    "stepName3"
                );
                markStepCompleted(
                    "stepContainer3",
                    "stepSubcontainer3",
                    "stepCircle3",
                    "stepName3"
                );
                document
                    .getElementById("completeContainer")
                    .classList.remove("hidden");
                document
                    .getElementById("completeContainer")
                    .classList.add("flex");

                document
                    .getElementById("okButton")
                    .addEventListener("click", () => {
                        window.location.href('/attendances');
                    });
            } else {
                document
                    .getElementById("statusText")
                    .classList.remove("hidden");
                document.getElementById("statusText").textContent =
                    "Wajah tidak cocok. Silakan coba lagi.";
                //  Beri pilihan buttin retry atau ganti metode
                // document
                //     .getElementById("retryButton")
                //     .addEventListener("click", () => {
                //         window.location.reload();
                //     });
                // document
                //     .getElementById("alternativeButton1")
                //     .addEventListener("click", () => {
                //         alternativeMethod1();
                //     });
            }
        } else {
            console.warn("No face detected.");
        }
    } catch (error) {
        console.error("Error during face verification:", error);
    }
}

async function initFaceVerification() {
    try {
        console.log("Loading face-api models...");
        await faceapi.nets.ssdMobilenetv1.loadFromUri("/models");
        await faceapi.nets.faceLandmark68Net.loadFromUri("/models");
        await faceapi.nets.faceRecognitionNet.loadFromUri("/models");
        console.log("Models loaded successfully.");
        modelsLoaded = true;
        faceVerificationInterval = setInterval(verifyFace, 2000);
    } catch (error) {
        console.error("Error loading models:", error);
    }
}

function alternativeMethod1() {
    // Slot for alternative method 1
}

function alternativeMethod2() {
    // Slot for alternative method 2
}
