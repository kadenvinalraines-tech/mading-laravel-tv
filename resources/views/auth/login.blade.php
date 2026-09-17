<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panel Mading Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-gray-900 border border-gray-800 rounded-3xl p-8 shadow-2xl">
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-blue-600/20 border border-blue-500 flex items-center justify-center text-3xl">
                📺
            </div>
            <h1 class="text-2xl font-black text-white tracking-tight">Login Portal Mading</h1>
            <p class="text-xs text-gray-400 mt-1">Masuk sebagai Siswa, Guru Pembimbing, atau Admin</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-950/80 border border-red-800 text-red-300 text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500 transition">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center space-x-2 text-gray-400 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded bg-gray-950 border-gray-800 text-blue-600">
                    <span>Ingat Saya</span>
                </label>
                <a href="{{ route('display.tv') }}" class="text-blue-400 hover:underline">Lihat Layar TV</a>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-500 transition shadow-lg shadow-blue-600/30">
                Masuk ke Panel
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-800 text-center text-xs text-gray-400">
            Siswa belum punya akun? <a href="{{ route('register') }}" class="text-blue-400 font-bold hover:underline">Daftar Akun Siswa</a>
        </div>
    </div>
</body>
</html>
