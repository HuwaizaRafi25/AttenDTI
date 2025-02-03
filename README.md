# AttenDTI - Sistem Presensi dan Pengelolaan Siswa PKL

AttenDTI adalah aplikasi berbasis web yang dirancang untuk mempermudah proses **absensi siswa PKL** di **Direktorat Teknologi Informasi ITB**. Aplikasi ini tidak hanya fokus pada presensi, tetapi juga mencakup berbagai fitur lainnya, seperti **pengelolaan data siswa**, **manajemen tugas**, **pengumuman**, dan **rekrutmen kerja**. 

Dengan menggunakan teknologi **Geofencing** dan **WiFi Address Verification**, sistem ini menawarkan keamanan dan keakuratan dalam proses absensi siswa.

---

## **Fitur Utama**
- **Absensi Geofencing**: Verifikasi kehadiran berdasarkan lokasi siswa menggunakan GPS.
- **Verifikasi WiFi Address**: Memastikan siswa terhubung dengan jaringan WiFi resmi untuk validasi kehadiran.
- **Pengelolaan Data Siswa PKL**: Admin dapat mengelola data siswa, termasuk pendaftaran, absensi, dan dokumen terkait.
- **Pengumuman dan Informasi**: Fitur untuk menyampaikan informasi penting kepada siswa secara cepat.
- **Manajemen Tugas**: Memberikan, melacak, dan menyelesaikan tugas siswa.
- **Rekrutmen Kerja**: Fitur untuk membantu siswa PKL menemukan peluang kerja terkait.

---

## **Teknologi yang Digunakan**
- **Laravel 10**: Framework PHP modern untuk pengembangan web.
- **MySQL**: Database yang digunakan untuk menyimpan data.
- **Tailwind CSS**: Membantu dalam mendesain antarmuka yang responsif dan modern.
- **Redis**: Untuk manajemen cache dan pelacakan status pengguna online.

---

## **Prasyarat**
Sebelum memulai, pastikan perangkat Anda telah menginstal:
- PHP >= 8.2
- Composer (untuk mengelola dependensi Laravel)
- MySQL
- Node.js & npm

---

## **Cara Instalasi**
1. **Clone Repository**  
   Clone proyek ini ke komputer Anda:
   ```bash
   git clone https://github.com/username/AttenDTI.git
   cd AttenDTI
   ```

2. **Install Dependensi Backend**  
   Unduh semua dependensi Laravel menggunakan Composer:
   ```bash
   composer install
   ```

3. **Install Dependensi Frontend**  
   Instal dependensi untuk frontend menggunakan npm:
   ```bash
   npm install
   npm run build
   ```

4. **Konfigurasi File `.env`**  
   Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi berikut sesuai dengan pengaturan lokal Anda:
   - **Database**: Pastikan koneksi database (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) sesuai dengan konfigurasi MySQL di perangkat Anda.
   - **Key Aplikasi**: Generate application key dengan perintah berikut:
     ```bash
     php artisan key:generate
     ```

5. **Migrasi Database**  
   Jalankan migrasi untuk membuat tabel di database:
   ```bash
   php artisan migrate
   ```

6. **Jalankan Aplikasi**  
   Jalankan server pengembangan lokal Laravel:
   ```bash
   php artisan serve
   ```
   Aplikasi akan dapat diakses melalui `http://localhost:8000`.

---

## **Cara Penggunaan**
1. **Login**  
   - Siswa: Masuk menggunakan email ITB.  
   - Admin: Mengelola data siswa, tugas, dan pengumuman.

2. **Absensi**  
   Siswa hanya dapat melakukan absensi jika dua kondisi terpenuhi:  
   - Lokasi berada di dalam radius geofencing.  
   - Terhubung ke jaringan WiFi resmi (ITB Hotspot).

3. **Manajemen Data**  
   Admin dapat menambah, mengedit, atau menghapus data siswa, tugas, dan pengumuman.

---

## **Pengembangan**
Jika ingin berkontribusi, silakan ikuti langkah berikut:
1. **Buat Cabang Baru**  
   ```bash
   git checkout -b nama-fitur-anda
   ```

2. **Lakukan Perubahan**  
   Tambahkan kode atau fitur sesuai kebutuhan.

3. **Commit dan Push**  
   ```bash
   git add .
   git commit -m "Menambahkan fitur X"
   git push origin nama-fitur-anda
   ```

4. **Kirim Pull Request**  
   Ajukan pull request untuk peninjauan tim.

---

## **Lisensi**
Proyek ini menggunakan lisensi **MIT**. Lihat file [LICENSE](./LICENSE) untuk detailnya.

---

## **Kontak**
Jika memiliki pertanyaan atau saran, hubungi kami melalui:  
- **Email**: huwaiza137@gmail.com, fauziekaputra704@gmail.com
```
