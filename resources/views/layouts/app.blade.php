<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Mading Digital') - Portal Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-gray-900 border-b border-gray-800 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-6">
                    <a href="{{ route('display.tv') }}" target="_blank" class="flex items-center space-x-2 text-blue-400 font-extrabold text-lg">
                        <span>📺 Buka TV Mading</span>
                    </a>
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('contents.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('contents.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                            Daftar Konten
                        </a>
                        @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                            <a href="{{ route('moderation.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('moderation.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                                Moderasi Siswa
                            </a>
                            <a href="{{ route('running_texts.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('running_texts.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                                Teks Berjalan & Profil
                            </a>
                        @endif
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <div class="text-sm font-bold text-white">{{ auth()->user()->name }}</div>
                        <div class="text-xs uppercase font-extrabold tracking-wider text-blue-400">{{ auth()->user()->role }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-950 border border-red-800 text-red-300 text-xs font-bold hover:bg-red-900 transition">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-950/80 border border-emerald-800 text-emerald-300 flex items-center justify-between">
                <span>✅ {{ session('success') }}</span>
            </div>
        @endif

        @if(session('warning'))
            <div class="mb-6 p-4 rounded-xl bg-amber-950/80 border border-amber-800 text-amber-300 flex items-center justify-between">
                <span>⚠️ {{ session('warning') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 py-4 text-center text-xs text-gray-500">
        Mading TV Digital Sekolah • Vertical Slice Architecture (PHP Laravel 11 & MySQL)
    </footer>

</body>
</html>
