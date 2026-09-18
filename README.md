# Mading TV Digital Sekolah (Laravel Vertical Slice)

Sistem Informasi Majalah Dinding (Mading) Digital Sekolah berbasis **PHP Laravel 11** dan **Vertical Slice Architecture**. Dirancang khusus untuk layar Smart TV koridor sekolah dan panel web interaktif untuk interaksi Siswa, Guru, dan Admin.

Dibangun dengan mematuhi disiplin **Vibe Coding**: PRD lengkap, pemetaan dependensi AST (Graphify), referensi API spesifik (Context7), serta eksekusi modular *native-first* (Ponytail).

---

## 🌟 Fitur Utama

- **📺 Display Kiosk TV (Layar Penuh):**
  - Auto-slide multimedia: YouTube Video, Gambar/Poster, Video MP4, Dokumen PDF, dan Audio.
  - Running text marquee pengumuman berjalan di footer layar.
  - Jam digital realtime waktu Indonesia.
  - Endpoint REST API feed (`/api/mading/feed`) untuk integrasi kiosk pihak ketiga.
- **👥 Multi-Role Authentication:**
  - **Siswa:** Registrasi mandiri, submit draft karya (status `pending`).
  - **Guru:** Pengunggahan konten langsung disetujui (`approved`), moderasi karya siswa (setujui/tolak dengan catatan).
  - **Admin:** Akses penuh manajemen konten, moderasi, running text, dan pengaturan profil sekolah.
- **🛡️ Keamanan & Validasi Input:**
  - Validasi ketat format file media (`mimes:jpg,jpeg,png,webp,mp4,webm,pdf,mp3`).
  - Proteksi otorisasi berbasis Role Middleware.
  - UUID Primary Key di seluruh tabel database untuk mencegah IDOR.
- **⚡ Vertical Slice Architecture:**
  - Struktur modular per kapabilitas bisnis di direktori `app/Features/` (`Auth`, `ContentSubmission`, `DisplayTv`, `Moderation`, `RunningText`).

---

## 🏗️ Struktur Arsitektur (Vertical Slice)

```text
app/
├── Features/
│   ├── Auth/
│   │   ├── Controllers/AuthController.php
│   │   └── Middleware/RoleMiddleware.php
│   ├── ContentSubmission/
│   │   └── Controllers/ContentController.php
│   ├── DisplayTv/
│   │   └── Controllers/DisplayTvController.php
│   ├── Moderation/
│   │   └── Controllers/ModerationController.php
│   └── RunningText/
│       └── Controllers/RunningTextController.php
├── Models/
│   ├── Content.php
│   ├── RunningText.php
│   ├── Setting.php
│   └── User.php
└── bootstrap/
    └── app.php
```

---

## 🚀 Panduan Instalasi & Menjalankan

### 1. Prasyarat Sistem
- PHP >= 8.2 (ekstensi `php-sqlite3`, `php-mbstring`, `php-xml`, `php-curl`)
- Composer
- Git

### 2. Clone & Setup Dependensi
```bash
git clone https://github.com/kadenvinalraines-tech/mading-laravel-tv.git
cd mading-laravel-tv
composer install
```

### 3. Konfigurasi Environment & Database
Salin berkas `.env.example` ke `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

Secara default, konfigurasi siap memakai SQLite lokal:
```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan storage:link
```

*(Opsi MySQL: ubah `DB_CONNECTION=mysql`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` di `.env`)*

### 4. Jalankan Server Development
```bash
php artisan serve
```
Akses di browser:
- **Tampilan TV Kiosk:** `http://localhost:8000/`
- **Panel Login Admin/Guru/Siswa:** `http://localhost:8000/login`

---

## 🔑 Akun Bawaan (Database Seeder)

Semua akun default memiliki password: `password123`

| Role | Email | Hak Akses |
| :--- | :--- | :--- |
| **Admin** | `admin@smk.local` | Kontrol penuh sistem, profil TV, running text, moderasi, konten |
| **Guru** | `guru@smk.local` | Moderasi karya siswa, unggah materi langsung approved, running text |
| **Siswa** | `siswa@smk.local` | Mengirim karya siswa (status menunggu persetujuan) |

---

## 🧪 Pengujian & Verifikasi Otomatis

Proyek ini dilengkapi test suite native tanpa ketergantungan framework pengujian luar:

```bash
# Menjalankan verifikasi 4 tahap Vibe Coding & live test suite:
python3 tests/runnable_check.py

# Atau menjalankan assertions PHP langsung:
php tests/runnable_test.php
```

Cakupan pengujian mencakup 8 assertion otomatis:
1. Migrasi dan seeding database multi-role.
2. Siklus hidup sesi login & logout.
3. Submisi karya siswa (status pending).
4. Submisi guru (auto-approved).
5. Alur moderasi guru (approval & reject dengan catatan).
6. Manajemen CRUD & toggle status aktif running text.
7. Pengaturan identitas dan profil sekolah di TV.
8. Filter integritas API Feed Display Kiosk TV.

---

## 🗺️ Pemetaan Dependensi (Graphify)

Untuk melihat dependensi dan analisis god-nodes modul:
```bash
graphify . --code-only
graphify cluster-only .
```
Laporan pemetaan dependensi lengkap tersedia di berkas `graphify-out/GRAPH_REPORT.md` dan visualisasi interaktif di `graphify-out/graph.html`.

---

## 📜 Lisensi
Open-source di bawah lisensi [MIT](LICENSE).
