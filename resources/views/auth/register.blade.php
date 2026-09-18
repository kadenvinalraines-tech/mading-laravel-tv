@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-2xl border border-blue-100 shadow-xl">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-black text-blue-950">Registrasi Siswa</h2>
        <p class="text-xs text-slate-500 mt-1">Daftarkan akun siswa untuk kirim karya mading</p>
    </div>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">@csrf
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap</label>
            <input type="text" name="name" placeholder="Nama Lengkap" required class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
            <input type="email" name="email" placeholder="siswa@sekolah.sch.id" required class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Password</label>
            <input type="password" name="password" placeholder="••••••••" required class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="••••••••" required class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800">
        </div>
        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-md transition text-sm">Daftar Sekarang</button>
    </form>
    <div class="mt-6 pt-6 border-t border-slate-100 text-center">
        <a href="{{ route('login') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Sudah punya akun? Masuk</a>
    </div>
</div>
@endsection
