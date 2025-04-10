// Dropdown tahun
const yearButton = document.getElementById('yearButton');
const yearDropdown = document.getElementById('yearDropdown');
const selectedYear = document.getElementById('selectedYear');
const yearOptions = document.querySelectorAll('.year-option');
const yearInput = document.getElementById('yearInput');

yearButton.addEventListener('click', function () {
    yearDropdown.classList.toggle('hidden');
});

yearOptions.forEach(option => {
    option.addEventListener('click', function () {
        const year = this.getAttribute('data-year');
        selectedYear.textContent = year;
        yearInput.value = year;

        yearOptions.forEach(opt => {
            opt.classList.remove('bg-blue-50', 'text-blue-600', 'font-medium');
        });
        this.classList.add('bg-blue-50', 'text-blue-600', 'font-medium');

        yearDropdown.classList.add('hidden');
        let currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('year', year);
        window.location.href = currentUrl.toString();
    });
});

document.addEventListener('click', function (event) {
    if (!yearButton.contains(event.target) && !yearDropdown.contains(event.target)) {
        yearDropdown.classList.add('hidden');
    }
});

function getURLParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

// Modal dan status pembayaran
let user = null;
let statuses = {};

// Event listener untuk membuka modal (pastikan setiap tombol yang memicu modal memiliki class "open-modal")
document.querySelectorAll('.open-modal').forEach(button => {
    button.addEventListener('click', function () {
        user = JSON.parse(this.getAttribute('data-user'));
        document.getElementById('userFullname').innerText = user.full_name ?? '-';
        document.getElementById('userInstitution').innerText = user.institution ?? '-';
        document.getElementById('userMajor').innerText = user.major ?? '-';
        document.getElementById('userProfileImage').src = user.profile_image ?? '{{ asset("assets/images/default.png") }}';

        // Ambil status pembayaran dari database (nilai true/false)
        statuses = { ...user.payment_statuses };

        const monthInputs = document.getElementById('monthInputs');
        monthInputs.innerHTML = '';

        const startDate = new Date(user.period_start_date);
        const endDate = new Date(user.period_end_date);
        const currentDate = new Date(startDate);

        while (currentDate <= endDate) {
            const month = currentDate.toLocaleString('default', { month: 'long' });
            const year = currentDate.getFullYear();
            const monthYear = `${month} ${year}`;
            const monthKey = `${year}-${String(currentDate.getMonth() + 1).padStart(2, '0')}`;
            // Gunakan nilai boolean dari statuses untuk menentukan tampilan
            const status = statuses[monthKey] === true;
            // Jika diperlukan, Anda dapat menampilkan teks status misalnya "Lunas" atau "Belum lunas"
            const statusText = status ? 'Lunas' : 'Belum lunas';
            const statusColor = status ? 'text-green-600' : 'text-black';
            const iconColor = status ? 'text-green-600' : 'text-black';

            const inputDiv = document.createElement('div');
            inputDiv.classList.add('flex', 'items-center', 'justify-between', 'gap-x-2', 'mb-2');
            inputDiv.innerHTML = `
                <label class="text-sm text-gray-700">${monthYear}</label>
                <span class="${statusColor}">${statusText}</span>
                <button data-month="${monthKey}" class="toggle-status">
                    <i class="fa-solid fa-money-bill ${iconColor} transition-all duration-300 transform hover:scale-125 hover:text-emerald-500"></i>
                </button>
            `;
            monthInputs.appendChild(inputDiv);

            currentDate.setMonth(currentDate.getMonth() + 1);
        }

        // Tambahkan event listener untuk toggle status pada setiap button yang baru dibuat
        document.querySelectorAll('.toggle-status').forEach(btn => {
            btn.addEventListener('click', function () {
                const month = this.getAttribute('data-month');
                statuses[month] = !statuses[month]; // Toggle status
                const statusSpan = this.previousElementSibling;
                const icon = this.querySelector('i');
                // Ubah teks dan warna berdasarkan status terbaru
                statusSpan.textContent = statuses[month] ? 'Lunas' : 'Belum lunas';
                statusSpan.className = statuses[month] ? 'text-green-600' : 'text-black';
                icon.className = statuses[month] ?
                    'fa-solid fa-money-bill text-green-600 transition-all duration-300 transform hover:scale-125 hover:text-emerald-500' :
                    'fa-solid fa-money-bill text-black transition-all duration-300 transform hover:scale-125 hover:text-emerald-500';
            });
        });

        // Tampilkan modal
        document.getElementById('cashModal').classList.remove('hidden');
        document.getElementById('cashModal').classList.add('flex');
    });
});

// Tutup modal pembayaran
document.getElementById('closeViewcashModal').addEventListener('click', function () {
    document.getElementById('cashModal').classList.remove('flex');
    document.getElementById('cashModal').classList.add('hidden');
});

// Tampilan full screen image saat profile image di klik
document.getElementById('userProfileImage').addEventListener('click', function () {
    const overlay = document.getElementById('imageOverlay');
    document.getElementById('fullScreenImage').src = this.src;
    overlay.classList.remove('hidden');
    overlay.classList.add('flex');
});

document.getElementById('imageOverlay').addEventListener('click', function () {
    this.classList.add('hidden');
    this.classList.remove('flex');
});

// Simpan perubahan status pembayaran
document.querySelector('.save-button').addEventListener('click', function () {
    fetch('{{ route("update.payment.status") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            user_id: user.id,
            statuses: statuses
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data berhasil disimpan');
                document.getElementById('cashModal').classList.remove('flex');
                document.getElementById('cashModal').classList.add('hidden');
                location.reload();
            } else {
                alert('Gagal menyimpan data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
});

// Menu More pada tampilan mobile (toggle menu)
document.getElementById("moreButton").addEventListener("click", function () {
    var optionsMenu = document.getElementById("optionsMenu");
    optionsMenu.classList.toggle("show");
});
window.addEventListener("resize", function () {
    var optionsMenu = document.getElementById("optionsMenu");
    if (optionsMenu.classList.contains("show")) {
        optionsMenu.classList.remove("show");
    }
});
