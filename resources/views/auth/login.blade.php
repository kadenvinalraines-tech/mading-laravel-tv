@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-2xl border border-slate-200/80 shadow-[0_10px_30px_-5px_rgba(15,23,42,0.05)]">
    <div class="text-center mb-6">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl border border-blue-100 flex items-center justify-center mx-auto mb-3 text-xl shadow-sm">🔐</div>
        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Masuk Mading TV</h2>
        <p class="text-xs text-slate-500 mt-1">Gunakan akun Guru, Admin, atau Siswa terdaftar</p>
    </div>
    <form method="POST" action="{{ route('login') }}" class="space-y-4">@csrf
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Alamat Email</label>
            <input type="email" name="email" placeholder="nama@sekolah.sch.id" required class="w-full px-3.5 py-2.5 bg-slate-50/70 rounded-xl border border-slate-200 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/30 focus:border-blue-600 text-slate-800 transition">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Kata Sandi</label>
            <input type="password" name="password" placeholder="••••••••" required class="w-full px-3.5 py-2.5 bg-slate-50/70 rounded-xl border border-slate-200 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/30 focus:border-blue-600 text-slate-800 transition">
        </div>
        <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl font-bold shadow-md shadow-blue-600/20 transition text-sm">Masuk Sistem</button>
    </form>
    <div class="mt-6 pt-5 border-t border-slate-100 text-center">
        <a href="{{ route('register') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Belum punya akun? Daftar Siswa Baru</a>
    </div>
</div>
@endsection
