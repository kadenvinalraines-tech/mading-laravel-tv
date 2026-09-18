<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Mading Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen flex flex-col">
    <nav class="bg-gray-900 border-b border-gray-800 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <a href="{{ route('display.tv') }}" target="_blank" class="text-blue-400 font-bold">📺 Layar TV</a>
            @auth
                <a href="{{ route('contents.index') }}" class="text-sm font-semibold">Konten</a>
                @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                    <a href="{{ route('moderation.index') }}" class="text-sm font-semibold">Moderasi</a>
                    <a href="{{ route('running_texts.index') }}" class="text-sm font-semibold">Pengaturan TV</a>
                @endif
            @endauth
        </div>
        <div class="flex items-center space-x-4">
            @auth
                <span class="text-xs text-gray-400">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="text-xs bg-red-900 px-2.5 py-1 rounded">Keluar</button></form>
            @else
                <a href="{{ route('login') }}" class="text-xs text-gray-300 hover:text-white">Masuk</a>
                <a href="{{ route('register') }}" class="text-xs bg-blue-600 px-2.5 py-1 rounded">Daftar Siswa</a>
            @endauth
        </div>
    </nav>
    <main class="flex-1 max-w-7xl w-full mx-auto p-6">
        @if(session('success'))
            <div class="mb-4 p-3 bg-emerald-950/80 border border-emerald-600 text-emerald-300 rounded-lg text-sm flex items-center justify-between">
                <span>✓ {{ session('success') }}</span>
            </div>
        @endif
        @if(session('warning'))
            <div class="mb-4 p-3 bg-amber-950/80 border border-amber-600 text-amber-300 rounded-lg text-sm flex items-center justify-between">
                <span>⚠ {{ session('warning') }}</span>
            </div>
        @endif
        @if(isset($errors) && $errors->any())
            <div class="mb-4 p-3 bg-rose-950/80 border border-rose-600 text-rose-300 rounded-lg text-sm">
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
