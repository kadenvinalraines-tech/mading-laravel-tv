<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Mading Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col font-sans">
    <nav class="bg-white border-b-2 border-blue-600 px-6 py-4 flex justify-between items-center shadow-sm">
        <div class="flex items-center space-x-6">
            <a href="{{ route('display.tv') }}" target="_blank" class="text-blue-600 hover:text-blue-700 font-extrabold flex items-center space-x-1.5">
                <span>📺</span><span>Layar TV</span>
            </a>
            @auth
                <a href="{{ route('contents.index') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Konten</a>
                @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                    <a href="{{ route('moderation.index') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Moderasi</a>
                    <a href="{{ route('running_texts.index') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Pengaturan TV</a>
                @endif
            @endauth
        </div>
        <div class="flex items-center space-x-4">
            @auth
                <span class="text-xs font-semibold px-3 py-1 bg-blue-50 text-blue-700 border border-blue-200 rounded-full">{{ auth()->user()->name }} ({{ strtoupper(auth()->user()->role) }})</span>
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="text-xs bg-rose-600 hover:bg-rose-700 text-white font-bold px-3 py-1.5 rounded-lg shadow-sm transition">Keluar</button></form>
            @else
                <a href="{{ route('login') }}" class="text-xs font-bold text-slate-600 hover:text-blue-600">Masuk</a>
                <a href="{{ route('register') }}" class="text-xs bg-blue-600 hover:bg-blue-700 text-white font-bold px-3 py-1.5 rounded-lg shadow-sm transition">Daftar Siswa</a>
            @endauth
        </div>
    </nav>
    <main class="flex-1 max-w-7xl w-full mx-auto p-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm flex items-center justify-between shadow-sm">
                <span>✓ {{ session('success') }}</span>
            </div>
        @endif
        @if(session('warning'))
            <div class="mb-4 p-4 bg-amber-50 border border-amber-200 text-amber-800 rounded-xl text-sm flex items-center justify-between shadow-sm">
                <span>⚠ {{ session('warning') }}</span>
            </div>
        @endif
        @if(isset($errors) && $errors->any())
            <div class="mb-4 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl text-sm shadow-sm">
                <p class="font-bold mb-1">Periksa kesalahan input berikut:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
