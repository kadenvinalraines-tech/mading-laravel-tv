# Product Requirement Document (PRD) - Mading TV Digital Sekolah
## 1. Problem Statement
Mading fisik lambat update, boros kertas, tanpa dukungan multimedia (video/audio). Butuh solusi digital terpusat untuk Smart TV koridor sekolah.

## 2. Pilihan Arsitektur
Vertical Slice Architecture. Kode dibagi per kapabilitas fitur bisnis (Auth, DisplayTv, ContentSubmission, Moderation, RunningText).

## 3. User Roles (Multi-Auth)
- Super Admin: Kontrol penuh sistem, user, profil TV.
- Guru: Post langsung approved, moderasi karya siswa (approve/reject).
- Siswa: Register mandiri, submit draft konten (status pending).
- Kiosk Display: Read-only, auto-slide video/gambar/PDF/audio, running text footer.

## 4. Skema Database (MySQL UUID PK)
- `users`: id (UUID), name, email, password, role ('admin','guru','siswa').
- `contents`: id (UUID), title, media_url, media_type ('youtube','image','video','pdf','audio'), duration_seconds, start_date, end_date, status ('pending','approved','rejected'), notes, submitted_by, approved_by.
- `running_texts`: id (UUID), text, is_active, created_by.
- `settings`: id, key, value.
