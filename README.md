# Mading TV Digital Sekolah (Vertical Slice Architecture)

Platform Mading TV Digital Sekolah modern berbasis **PHP Laravel 11** dan **MySQL** yang didesain khusus untuk mode **Display TV Kiosk Full-Screen** di lobi/koridor sekolah, dilengkapi portal kolaborasi antara **Siswa, Guru, dan Administrator**.

Diadaptasi dan dikembangkan dari konsep referensi repositori [`kadenvinalraines-tech/mading`](https://github.com/kadenvinalraines-tech/mading).

---

## 📺 Fitur Utama

1. **Display TV Kiosk Mode (Halaman Depan `/`):**
   - **Header:** Logo sekolah, nama instansi, slogan mading, serta jam digital & tanggal real-time.
   - **Main Screen (Hampir Full Screen):** Penayangan otomatis (*auto-slider*) video YouTube embed, video lokal MP4, poster gambar karya siswa, dokumen PDF mading, dan audio suara informasi.
   - **Footer Bar:** Teks pengumuman berjalan (*marquee / running text*) yang dapat diatur on/off dari panel.
   - **Auto-Sync:** Refresh otomatis berkala untuk menyinkronkan konten terbaru tanpa perlu disentuh manual.

2. **Alur Kerja & Hak Akses (Multi-Role):**
   - **Siswa:** Registrasi mandiri, submit draf karya (teks, cover gambar, file PDF/MP4, atau link video YouTube). Karya siswa masuk ke status `pending` dan **wajib di-ACC oleh Guru/Admin** sebelum tayang di layar TV.
   - **Guru Pembimbing:** Dapat memposting pengumuman langsung tanpa moderasi (otomatis tayang), serta memiliki dashboard **Pusat Moderasi** untuk *Approve* atau *Reject* karya siswa.
   - **Administrator:** Hak akses penuh atas pengelolaan user, moderasi konten, manajemen teks berjalan, serta kustomisasi profil sekolah dan logo mading.

---

## 🏗️ Arsitektur Sistem: Vertical Slice Architecture

Berbeda dari MVC monolitik standar yang memecah file berdasarkan layer teknis, proyek ini menggunakan **Vertical Slice Architecture** di mana setiap fitur bisnis dikelompokkan ke dalam satu modul terpadu:

```text
app/Features/
├── Auth/                   # Login, Registrasi Siswa, Role Middleware, Logout
├── DisplayTv/              # Controller & Real-Time Feed Kiosk TV Full-Screen
├── ContentSubmission/      # Pengajuan karya siswa & posting langsung guru
├── Moderation/             # Panel moderasi guru (Approve/Reject draf karya siswa)
└── RunningText/            # Manajemen teks berjalan footer TV & profil logo sekolah
```

### Skema Database MySQL (UUID Primary Key)
- `users`: id (UUID), name, email, password, role (`admin`, `guru`, `siswa`).
- `contents`: id (UUID), title, media_url, media_type (`image`, `video`, `youtube`, `pdf`, `audio`), duration_seconds, start_date, end_date, status (`pending`, `approved`, `rejected`), submitted_by, approved_by.
- `running_texts`: id (UUID), text, is_active, created_by.
- `settings`: key, value (Profil sekolah, tagline, path logo).

---

## 🚀 Cara Menjalankan Project

### 1. Kloning Repository
```bash
git clone https://github.com/kadenvinalraines-tech/mading-laravel-tv.git
cd mading-laravel-tv
```

### 2. Konfigurasi Environment & Install Dependency
```bash
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Konfigurasi Database MySQL
Buka `.env` dan sesuaikan koneksi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mading_digital
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Jalankan Migrasi & Data Seeder Awal
```bash
php artisan migrate --seed
php artisan storage:link
```

### 5. Jalankan Server
```bash
php artisan serve
```
Akses di browser:
- **Layar TV Koridor / Kiosk:** `http://localhost:8000/`
- **Panel Login:** `http://localhost:8000/login`

### Akun Bawaan Seeder:
| Role | Email | Password |
|---|---|---|
| **Super Admin** | `admin@smk.local` | `password123` |
| **Guru Pembimbing** | `guru@smk.local` | `password123` |
| **Siswa** | `siswa@smk.local` | `password123` |

---

## 📄 Lisensi
Proyek ini dilisensikan di bawah lisensi MIT.
