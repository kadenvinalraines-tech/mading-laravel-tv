<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RunningText;
use App\Models\Content;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Settings Default
        Setting::set('school_name', 'SMK Komputer Indonesia');
        Setting::set('school_tagline', 'Mading Digital & Informasi Terpadu');
        Setting::set('school_logo', '/images/logo-sekolah.png');

        // Users
        $admin = User::create([
            'name' => 'Administrator Mading',
            'email' => 'admin@smk.local',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $guru = User::create([
            'name' => 'Bapak Pembimbing Guru',
            'email' => 'guru@smk.local',
            'password' => Hash::make('password123'),
            'role' => 'guru',
        ]);

        $siswa = User::create([
            'name' => 'Billy Siswa TKJ',
            'email' => 'siswa@smk.local',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);

        // Running Texts
        RunningText::create([
            'text' => 'Selamat Datang di Mading Digital TV SMK Komputer Indonesia! Disiplin, Kreatif, Berprestasi.',
            'is_active' => true,
            'created_by' => $guru->id,
        ]);

        RunningText::create([
            'text' => 'Pengumuman: Pengumpulan draf laporan PKL/Prakerin gelombang 1 paling lambat Jumat depan.',
            'is_active' => true,
            'created_by' => $guru->id,
        ]);

        // Contents
        Content::create([
            'title' => 'Video Profil Jurusan Teknik Jaringan Komputer',
            'media_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'media_type' => 'youtube',
            'duration_seconds' => 30,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDays(30),
            'status' => 'approved',
            'submitted_by' => $guru->id,
            'approved_by' => $admin->id,
        ]);

        Content::create([
            'title' => 'Poster Prestasi Lomba Network Automation 2026',
            'media_url' => 'https://picsum.photos/1920/1080?random=1',
            'media_type' => 'image',
            'duration_seconds' => 15,
            'start_date' => now()->subDay(),
            'end_date' => now()->addDays(14),
            'status' => 'approved',
            'submitted_by' => $siswa->id,
            'approved_by' => $guru->id,
        ]);
    }
}
