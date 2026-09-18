<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;
use App\Models\RunningText;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        Setting::set('school_name', 'SMK Komputer Indonesia');
        Setting::set('school_tagline', 'Mading Digital & Informasi Terpadu');
        Setting::set('school_logo', '/images/logo-sekolah.png');

        User::create(['name' => 'Admin Mading', 'email' => 'admin@smk.local', 'password' => Hash::make('password123'), 'role' => 'admin']);
        $guru = User::create(['name' => 'Guru Pembimbing', 'email' => 'guru@smk.local', 'password' => Hash::make('password123'), 'role' => 'guru']);
        User::create(['name' => 'Siswa TKJ', 'email' => 'siswa@smk.local', 'password' => Hash::make('password123'), 'role' => 'siswa']);

        RunningText::create(['text' => 'Selamat datang di Mading TV Digital SMK!', 'is_active' => true, 'created_by' => $guru->id]);
    }
}
