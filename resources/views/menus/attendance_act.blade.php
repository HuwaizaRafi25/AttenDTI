<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Kehadiran</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Contoh styling progress bar */
        .progress-container {
            display: flex;
            align-items: center;
            margin: 20px;
        }

        .progress-step {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .progress-step::before {
            content: '';
            display: block;
            margin: 0 auto 10px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ccc;
            line-height: 40px;
            color: white;
            text-align: center;
            font-weight: bold;
        }

        .progress-step.active::before {
            background-color: #28a745;
        }

        .progress-step span {
            display: block;
        }

        .progress-line {
            position: absolute;
            top: 20px;
            left: 50%;
            height: 5px;
            background-color: #ccc;
            z-index: -1;
        }

        .progress-step:first-child .progress-line {
            display: none;
        }
    </style>
</head>

<body>
    <h1>Verifikasi Kehadiran</h1>

    <!-- Progress Bar -->
    <div class="progress-container">
        <div class="progress-step" id="step1">
            <span>Geofencing</span>
            <div class="progress-line" style="width: 100%;"></div>
        </div>
        <div class="progress-step" id="step2">
            <span>Verifikasi Gerakan</span>
        </div>
    </div>

    <!-- Panel utama -->
    <div id="content">
        <p>Mencari lokasi Anda...</p>
        <!-- Tempat animasi gif loading -->
        <img id="loadingGif" src="/images/loading.gif" alt="Loading..." style="display: none; width:50px;">
    </div>

    <script>
        // Pastikan CSRF token tersedia untuk ajax request
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Tampilkan loading gif
        const loadingGif = document.getElementById('loadingGif');
        loadingGif.style.display = 'block';

        // Fungsi untuk mengupdate progress bar
        function markStepCompleted(stepId) {
            document.getElementById(stepId).classList.add('active');
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
                    loadingGif.style.display = 'none'; // sembunyikan animasi loading
                    if (data.success) {
                        // Tampilkan pesan sukses dan update progress bar
                        document.getElementById('content').innerHTML = `<p>${data.message}</p>`;
                        markStepCompleted('step1');
                        // Selanjutnya, munculkan instruksi untuk verifikasi gerakan
                        // checkWiFi();
                        showMotionVerification();
                    } else {
                        document.getElementById('content').innerHTML = `<p>${data.message}</p>`;
                    }
                })
                .catch(error => {
                    loadingGif.style.display = 'none';
                    console.error('Error:', error);
                    document.getElementById('content').innerHTML = `<p>Terjadi kesalahan. Silakan coba lagi.</p>`;
                });
        }

        function errorCallback(error) {
            // loadingGif.style.display = 'none';
            // console.error('Error mendapatkan lokasi: ', error);
            // document.getElementById('content').innerHTML = `<p>Gagal mendapatkan lokasi Anda. Silakan periksa pengaturan GPS dan coba lagi.</p>`;
        }

        // Contoh dengan Capacitor (untuk aplikasi hybrid)
        // import {
        //     Network
        // } from '@capacitor/network';

        async function checkWiFi() {
            const status = await Network.getStatus();
            if (status.connected && status.ssid === "Office-WiFi") {
                console.log("Terhubung ke Wi-Fi yang valid:", status.ssid);
                // Kirim data ke backend Laravel
                fetch('/api/verify-wifi', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        ssid: status.ssid
                    })
                });
            } else {
                console.log("Tidak terhubung ke Wi-Fi yang valid.");
                alert("Silakan hubungkan ke jaringan Wi-Fi kantor.");
            }
        }

        // Fungsi untuk menampilkan verifikasi gerakan
        function showMotionVerification() {
            // Contoh sederhana: tampilkan pesan instruksi untuk menggeser layar
            const contentDiv = document.getElementById('content');
            contentDiv.innerHTML += `
                <p>Geser layar dari kiri ke kanan untuk verifikasi gerakan.</p>
                <!-- Tempat animasi untuk verifikasi gerakan -->
                <img id="motionLoadingGif" src="/images/motion_loading.gif" alt="Loading Motion..." style="display: none; width:50px;">
                <div id="motionArea" style="border: 1px solid #ccc; padding: 20px; margin-top: 10px;">
                    Geser di area ini...
                </div>
            `;

            // Inisialisasi mekanisme pengambilan koordinat gerakan
            initMotionDetection();
        }

        // Contoh sederhana pendeteksi gerakan menggunakan touch events
        function initMotionDetection() {
            const motionArea = document.getElementById('motionArea');
            const motionLoadingGif = document.getElementById('motionLoadingGif');
            let positions = [];

            motionArea.addEventListener('touchstart', function(e) {
                positions = []; // reset posisi
            });

            motionArea.addEventListener('touchmove', function(e) {
                // Tangkap koordinat sentuhan
                const touch = e.touches[0];
                positions.push({
                    x: touch.clientX,
                    y: touch.clientY
                });
                // Tampilkan animasi loading kecil jika ingin memberi umpan balik visual
                motionLoadingGif.style.display = 'block';
            });

            motionArea.addEventListener('touchend', function(e) {
                motionLoadingGif.style.display = 'none';
                // Validasi apakah posisi gerakan cukup bervariasi (contoh: minimal 3 koordinat berbeda)
                if (positions.length >= 3 && isMotionValid(positions)) {
                    markStepCompleted('step2');
                    document.getElementById('content').innerHTML += `<p>Verifikasi gerakan berhasil!</p>`;
                    // Lanjutkan ke langkah selanjutnya (misalnya simpan data attendance atau tampilkan instruksi tambahan)
                } else {
                    document.getElementById('content').innerHTML +=
                        `<p>Verifikasi gerakan gagal. Silakan coba lagi.</p>`;
                }
            });
        }

        // Fungsi sederhana untuk validasi koordinat gerakan (cek apakah gerakan tidak monoton)
        function isMotionValid(positions) {
            // Misal: hitung jarak total yang ditempuh minimal
            let totalDistance = 0;
            for (let i = 1; i < positions.length; i++) {
                totalDistance += Math.hypot(
                    positions[i].x - positions[i - 1].x,
                    positions[i].y - positions[i - 1].y
                );
            }
            // Misal ambil nilai threshold 100px sebagai validasi awal
            return totalDistance > 100;
        }
    </script>
</body>

</html>
