<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Mading Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 min-h-screen flex flex-col antialiased">
    <nav class="bg-white border-b border-slate-200/80 px-8 py-3.5 flex justify-between items-center shadow-[0_2px_10px_rgba(15,23,42,0.03)]">
        <div class="flex items-center space-x-8">
            <a href="{{ route('display.tv') }}" target="_blank" class="text-blue-600 hover:text-blue-700 font-extrabold flex items-center space-x-2 text-sm tracking-tight">
                <span class="p-1.5 bg-blue-50 text-blue-600 rounded-lg border border-blue-100">📺</span>
                <span>Layar Kiosk TV</span>
            </a>
            @auth
                <div class="flex items-center space-x-1">
                    <a href="{{ route('contents.index') }}" class="px-3 py-1.5 rounded-lg text-xs font-bold {{ request()->routeIs('contents.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }} transition">Konten</a>
                    @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                        <a href="{{ route('moderation.index') }}" class="px-3 py-1.5 rounded-lg text-xs font-bold {{ request()->routeIs('moderation.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }} transition">Moderasi</a>
                        <a href="{{ route('running_texts.index') }}" class="px-3 py-1.5 rounded-lg text-xs font-bold {{ request()->routeIs('running_texts.*') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }} transition">Pengaturan TV</a>
                    @endif
                </div>
            @endauth
        </div>
        <div class="flex items-center space-x-4">
            @auth
                <div class="flex items-center space-x-2 px-3 py-1 bg-slate-100 rounded-full border border-slate-200/80">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="text-xs font-semibold text-slate-700">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] font-extrabold uppercase px-1.5 py-0.5 bg-white text-slate-600 rounded border border-slate-200">{{ auth()->user()->role }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">@csrf
                    <button type="submit" class="text-xs text-slate-500 hover:text-rose-600 font-semibold px-2 py-1 rounded transition">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-xs font-bold text-slate-600 hover:text-blue-600">Masuk</a>
                <a href="{{ route('register') }}" class="text-xs bg-blue-600 hover:bg-blue-700 text-white font-bold px-3.5 py-1.5 rounded-lg shadow-sm transition">Daftar Siswa</a>
            @endauth
        </div>
    </nav>
    <main class="flex-1 max-w-7xl w-full mx-auto p-8">
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
