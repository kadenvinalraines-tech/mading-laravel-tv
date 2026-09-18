# Product Requirement Document (PRD)
## Mading TV Digital Sekolah (Kiosk Mode Full-Screen)

---

### 1. Ringkasan & Problem Statement
* **Masalah:** Mading fisik konvensional di sekolah lambat diperbarui, boros kertas, tidak bisa memutar multimedia (video/audio/animasi), dan penyebaran pengumuman penting sering terlambat sampai ke siswa.
* **Solusi:** Sistem Mading TV Digital berbasis web yang ditayangkan pada Smart TV lobi/koridor sekolah (Kiosk Mode Full-Screen) dengan pembaruan data real-time, auto-slide multimedia, dan teks berjalan.
* **Pilihan Arsitektur:** **Vertical Slice Architecture** (modular per kapabilitas bisnis terpadu) untuk menjamin isolasi modul dan kemudahan penambahan fitur.

---

### 2. User Persona & Hak Akses (Multi-Auth)
Tabel Tunggal: `users` dengan kolom `role`:
* **Admin (Super Admin):**
  * Hak akses penuh konfigurasi profil sekolah (nama, tagline, logo).
  * Manajemen pengguna (Admin, Guru, Siswa).
  * Manajemen teks pengumuman berjalan (*Running Text*).
  * Manajemen konten dan persetujuan langsung.
* **Guru (Moderator & Kontributor):**
  * Memposting konten/pengumuman resmi tanpa moderasi (langsung berstatus `approved` dan tayang di TV).
  * Memvalidasi (*Pusat Moderasi*) karya siswa: Menyetujui (*Approve*) atau Menolak (*Reject*) draf karya siswa.
* **Siswa (Kontributor Karya):**
  * Registrasi mandiri akun siswa.
  * Mengunggah draf karya (teks, cover gambar, file PDF karya tulis/cerpen, audio, atau link embed video YouTube).
  * Status awal draf adalah `pending` dan **wajib di-ACC Guru** sebelum tayang di TV.
* **Display TV (Public / Read-Only):**
  * Menampilkan antarmuka Kiosk TV tanpa tombol interaksi, murni tayangan visual terpadu.

---

### 3. Front-End Specification (Kiosk TV Display & Panel)
* **Display Kiosk TV (`/`):**
  * **Header:** Logo sekolah, nama instansi, tagline, jam digital & tanggal dinamis real-time (WIB).
  * **Main Display (Hampir Full-Screen):** Auto-slider transisi halus (CSS opacity), pendukung embed YouTube, video lokal MP4, poster gambar, viewer PDF, dan audio player.
  * **Footer Bar:** Teks berjalan (*marquee*) dengan durasi transisi proporsional.
  * **Auto-Sync:** Auto-reload berkala di background untuk menyinkronkan postingan baru.
* **Panel Administrasi & Siswa (`/login`, `/dashboard`):**
  * Responsif (Desktop & Tablet), Tailwind dark-mode elegan.

---

### 4. Back-End Specification & Database Schema (MySQL)
* **Standar Database:** Karakter utf8mb4, Primary Key menggunakan string UUID (VARCHAR(36)).
* **Entitas:**
  1. `users`: `id` (UUID), `name`, `email`, `password`, `role` (enum: admin, guru, siswa), `timestamps`.
  2. `contents`: `id` (UUID), `title`, `media_url`, `media_type` (enum: image, video, youtube, pdf, audio), `duration_seconds`, `start_date`, `end_date`, `status` (enum: pending, approved, rejected), `notes`, `submitted_by` (FK), `approved_by` (FK), `timestamps`.
  3. `running_texts`: `id` (UUID), `text`, `is_active`, `created_by` (FK), `timestamps`.
  4. `settings`: `id`, `key`, `value`.
* **Indeksasi:** Compound index `idx_contents_slider_active (status, start_date, end_date)` untuk performa query instan di Display TV.

---

### 5. Kriteria MVP (Minimum Viable Product)
1. Siswa dapat register, login, dan mengirim karya berstatus pending.
2. Guru dapat login, melihat daftar pending di menu Moderasi, dan melakukan Approve/Reject.
3. Konten yang approved langsung muncul di rotasi slider Display TV (`/`).
4. Running text dinamis muncul dan berjalan di bagian bawah Display TV.
