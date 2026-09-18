<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $schoolName }} - Mading TV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .marquee { display: inline-block; white-space: nowrap; animation: marq 30s linear infinite; }
        @keyframes marq { 0% { transform: translateX(100vw); } 100% { transform: translateX(-100%); } }
    </style>
</head>
<body class="h-screen w-screen bg-slate-100 text-slate-800 flex flex-col justify-between overflow-hidden font-sans">
    <header class="h-20 bg-white border-b-2 border-blue-600 px-8 flex justify-between items-center shadow-md z-50">
        <div class="flex items-center space-x-4">
            <div class="p-1 bg-blue-50 rounded-xl border border-blue-100 shadow-sm flex items-center justify-center">
                <img src="{{ $schoolLogo }}" class="h-12 w-12 object-contain" onerror="this.src='https://ui-avatars.com/api/?name=SMK&bg=2563eb&color=fff'">
            </div>
            <div>
                <h1 class="text-xl font-extrabold uppercase tracking-wide text-blue-950">{{ $schoolName }}</h1>
                <p class="text-xs font-semibold text-blue-600 tracking-wider">{{ $schoolTagline }}</p>
            </div>
        </div>
        <div class="flex items-center space-x-3 bg-blue-50 px-4 py-2 rounded-xl border border-blue-100 shadow-inner">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">WAKTU</span>
            <div id="clock" class="text-2xl font-black text-blue-900 tracking-wider"></div>
        </div>
    </header>

    <main class="flex-1 relative w-full h-[calc(100vh-8.5rem)] flex items-center justify-center overflow-hidden bg-slate-900">
        @forelse($activeSliders as $i => $s)
            <div class="slide absolute inset-0 w-full h-full flex items-center justify-center transition-opacity duration-700 {{ $i === 0 ? 'opacity-100 z-20' : 'opacity-0 z-10' }}" data-duration="{{ $s->duration_seconds }}">
                @if($s->media_type === 'youtube')
                    @php preg_match('/(?:youtu\.be\/|v\/|watch\?v=)([\w-]{11})/', $s->media_url, $m); @endphp
                    <iframe class="w-full h-full" src="https://www.youtube-nocookie.com/embed/{{ $m[1] ?? '' }}?autoplay=1&mute=1&controls=0&loop=1&playlist={{ $m[1] ?? '' }}" frameborder="0"></iframe>
                @elseif($s->media_type === 'video')
                    <video class="w-full h-full object-contain" autoplay muted loop><source src="{{ $s->media_url }}"></video>
                @elseif($s->media_type === 'image')
                    <img src="{{ $s->media_url }}" class="w-full h-full object-contain">
                @elseif($s->media_type === 'pdf')
                    <iframe src="{{ $s->media_url }}#toolbar=0" class="w-full h-full bg-white"></iframe>
                @else
                    <div class="p-8 bg-white text-slate-800 rounded-2xl shadow-xl text-center border border-blue-100"><h2 class="text-2xl font-bold text-blue-900">{{ $s->title }}</h2><audio src="{{ $s->media_url }}" controls autoplay class="mt-4"></audio></div>
                @endif
                <div class="absolute bottom-6 left-8 bg-white/95 backdrop-blur-md border border-blue-200 text-blue-950 px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg flex items-center space-x-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-600 animate-pulse"></span>
                    <span>{{ $s->title }}</span>
                </div>
            </div>
        @empty
            <div class="text-slate-400 text-xl font-medium">Mading Digital Aktif</div>
        @endforelse
    </main>

    <footer class="h-14 bg-blue-700 border-t-2 border-blue-500 flex items-center overflow-hidden z-50 shadow-inner">
        <span class="px-5 py-2 bg-blue-900 text-white text-xs font-black tracking-wider shrink-0 flex items-center space-x-1.5 shadow-md">
            <span>⚡</span><span>PENGUMUMAN</span>
        </span>
        <div class="overflow-hidden w-full"><div class="marquee text-sm font-bold text-white space-x-12">
            @foreach($runningTexts as $rt)<span>📢 {{ $rt }}</span>@endforeach
        </div></div>
    </footer>

    <script>
        setInterval(() => { document.getElementById('clock').innerText = new Date().toLocaleTimeString('id-ID'); }, 1000);
        const slides = document.querySelectorAll('.slide');
        let cur = 0;
        function next() {
            if (slides.length <= 1) return;
            slides[cur].classList.replace('opacity-100', 'opacity-0');
            cur = (cur + 1) % slides.length;
            slides[cur].classList.replace('opacity-0', 'opacity-100');
            setTimeout(next, (parseInt(slides[cur].dataset.duration) || 15) * 1000);
        }
        if (slides.length > 1) setTimeout(next, (parseInt(slides[0].dataset.duration) || 15) * 1000);
    </script>
</body>
</html>
