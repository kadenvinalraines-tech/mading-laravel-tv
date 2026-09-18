@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-2xl border border-blue-100 shadow-xl">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-black text-blue-950">Masuk Mading TV</h2>
        <p class="text-xs text-slate-500 mt-1">Silakan masuk menggunakan akun terdaftar</p>
    </div>
    <form method="POST" action="{{ route('login') }}" class="space-y-4">@csrf
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Email</label>
            <input type="email" name="email" placeholder="nama@sekolah.sch.id" required class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Password</label>
            <input type="password" name="password" placeholder="••••••••" required class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800">
        </div>
        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-md transition text-sm">Masuk</button>
    </form>
    <div class="mt-6 pt-6 border-t border-slate-100 text-center">
        <a href="{{ route('register') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Belum punya akun? Daftar Siswa Baru</a>
    </div>
</div>
@endsection
