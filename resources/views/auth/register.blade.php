<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa - Panel Mading Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-gray-900 border border-gray-800 rounded-3xl p-8 shadow-2xl">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-black text-white tracking-tight">Registrasi Siswa</h1>
            <p class="text-xs text-gray-400 mt-1">Kirim karya & artikel untuk ditayangkan di Mading TV</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-950/80 border border-red-800 text-red-300 text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Email Siswa</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500 transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Ulangi Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500 transition">
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-500 transition shadow-lg shadow-blue-600/30">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-800 text-center text-xs text-gray-400">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-400 font-bold hover:underline">Login ke Panel</a>
        </div>
    </div>
</body>
</html>
