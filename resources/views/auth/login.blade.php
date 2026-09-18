@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto bg-gray-900 p-8 rounded-2xl border border-gray-800">
    <h2 class="text-xl font-bold mb-4">Login Mading TV</h2>
    <form method="POST" action="{{ route('login') }}" class="space-y-4">@csrf
        <input type="email" name="email" placeholder="Email" required class="w-full p-3 bg-gray-950 rounded border border-gray-800">
        <input type="password" name="password" placeholder="Password" required class="w-full p-3 bg-gray-950 rounded border border-gray-800">
        <button type="submit" class="w-full py-3 bg-blue-600 rounded font-bold">Masuk</button>
    </form>
    <a href="{{ route('register') }}" class="block text-xs text-blue-400 mt-4 text-center">Daftar Siswa Baru</a>
</div>
@endsection
