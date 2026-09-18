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
            <a href="{{ route('contents.index') }}" class="text-sm font-semibold">Konten</a>
            @if(auth()->user()->isAdmin() || auth()->user()->isGuru())
                <a href="{{ route('moderation.index') }}" class="text-sm font-semibold">Moderasi</a>
                <a href="{{ route('running_texts.index') }}" class="text-sm font-semibold">Pengaturan TV</a>
            @endif
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-xs text-gray-400">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
            <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="text-xs bg-red-900 px-2.5 py-1 rounded">Keluar</button></form>
        </div>
    </nav>
    <main class="flex-1 max-w-7xl w-full mx-auto p-6">@yield('content')</main>
</body>
</html>
