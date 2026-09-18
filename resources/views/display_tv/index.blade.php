<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $schoolName }} - Mading TV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono-num { font-family: 'JetBrains Mono', monospace; font-variant-numeric: tabular-nums; }
        .marquee { display: inline-block; white-space: nowrap; animation: marq 35s linear infinite; }
        @keyframes marq { 0% { transform: translateX(100vw); } 100% { transform: translateX(-100%); } }
    </style>
</head>
<body class="h-screen w-screen bg-[#F8FAFC] text-slate-800 flex flex-col justify-between overflow-hidden antialiased select-none">
    <!-- Header: Corporate Slate & White -->
    <header class="h-[76px] bg-white border-b border-slate-200/80 px-8 flex justify-between items-center z-50 shadow-[0_4px_20px_-4px_rgba(15,23,42,0.06)]">
        <div class="flex items-center space-x-4">
            <div class="h-12 w-12 rounded-xl bg-slate-50 border border-slate-200/80 p-1 flex items-center justify-center shadow-sm overflow-hidden">
                <img src="{{ $schoolLogo }}" class="h-full w-full object-contain" onerror="this.src='https://ui-avatars.com/api/?name=SMK&bg=1e3a8a&color=fff'">
            </div>
            <div>
                <h1 class="text-lg font-extrabold tracking-tight text-slate-900 uppercase leading-none">{{ $schoolName }}</h1>
                <p class="text-[11px] font-semibold tracking-widest text-slate-500 uppercase mt-1.5 leading-none">{{ $schoolTagline }}</p>
            </div>
        </div>

        <div class="flex items-center space-x-3 bg-slate-100/80 border border-slate-200/90 px-4 py-2 rounded-xl shadow-inner">
            <div class="flex items-center space-x-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[10px] font-bold text-slate-500 tracking-wider uppercase">WIB</span>
            </div>
            <div class="h-4 w-px bg-slate-300"></div>
            <div id="clock" class="text-xl font-extrabold text-slate-900 font-mono-num tracking-wide"></div>
        </div>
    </header>

    <!-- Center Stage: Deep Matte Canvas for Optimal Media Viewing -->
    <main class="flex-1 relative w-full h-[calc(100vh-124px)] flex items-center justify-center overflow-hidden bg-[#0B0F19]">
        @forelse($activeSliders as $i => $s)
            <div class="slide absolute inset-0 w-full h-full flex items-center justify-center transition-opacity duration-1000 ease-in-out {{ $i === 0 ? 'opacity-100 z-20' : 'opacity-0 z-10' }}" data-duration="{{ $s->duration_seconds }}">
                @if($s->media_type === 'youtube')
                    @php preg_match('/(?:youtu\.be\/|v\/|watch\?v=)([\w-]{11})/', $s->media_url, $m); @endphp
                    <iframe class="w-full h-full pointer-events-none" src="https://www.youtube-nocookie.com/embed/{{ $m[1] ?? '' }}?autoplay=1&mute=1&controls=0&loop=1&playlist={{ $m[1] ?? '' }}" frameborder="0"></iframe>
                @elseif($s->media_type === 'video')
                    <video class="w-full h-full object-contain" autoplay muted loop playsinline><source src="{{ $s->media_url }}"></video>
                @elseif($s->media_type === 'image')
                    <img src="{{ $s->media_url }}" class="w-full h-full object-contain">
                @elseif($s->media_type === 'pdf')
                    <iframe src="{{ $s->media_url }}#toolbar=0" class="w-full h-full bg-white"></iframe>
                @else
                    <div class="p-10 bg-slate-900/90 text-white rounded-2xl shadow-2xl text-center border border-slate-800 max-w-lg">
                        <div class="text-xs uppercase tracking-widest text-blue-400 font-bold mb-2">Siaran Suara</div>
                        <h2 class="text-2xl font-bold text-slate-100">{{ $s->title }}</h2>
                        <audio src="{{ $s->media_url }}" controls autoplay class="mt-6 w-full"></audio>
                    </div>
                @endif

                <!-- Subtle Glass Floating Badge -->
                <div class="absolute bottom-6 left-8 bg-slate-950/80 backdrop-blur-md border border-slate-700/60 text-white px-5 py-3 rounded-xl shadow-2xl flex items-center space-x-3">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.8)]"></span>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-slate-400 font-semibold leading-none">{{ $s->media_type }}</p>
                        <p class="text-sm font-bold text-slate-100 tracking-wide mt-1 leading-none">{{ $s->title }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-slate-500">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-slate-900/80 border border-slate-800 flex items-center justify-center text-2xl">📺</div>
                <p class="text-lg font-semibold text-slate-400">Mading Digital Aktif</p>
                <p class="text-xs text-slate-600 mt-1">Belum ada konten tayang yang disetujui</p>
            </div>
        @endforelse
    </main>

    <!-- Footer: Executive Dark Navy Marquee -->
    <footer class="h-12 bg-[#0F172A] border-t border-slate-800 flex items-center overflow-hidden z-50">
        <div class="px-5 h-full bg-blue-600 text-white text-[11px] font-extrabold tracking-widest uppercase shrink-0 flex items-center space-x-2 shadow-md">
            <span>📢</span><span>PENGUMUMAN</span>
        </div>
        <div class="overflow-hidden w-full px-4">
            <div class="marquee text-xs font-medium tracking-wide text-slate-200 space-x-14 flex items-center">
                @foreach($runningTexts as $rt)
                    <span class="inline-flex items-center space-x-2">
                        <span class="text-blue-400 font-bold">•</span>
                        <span>{{ $rt }}</span>
                    </span>
                @endforeach
            </div>
        </div>
    </footer>

    <script>
        setInterval(() => {
            const now = new Date();
            document.getElementById('clock').innerText = now.toLocaleTimeString('id-ID', { hour12: false });
        }, 1000);
        document.getElementById('clock').innerText = new Date().toLocaleTimeString('id-ID', { hour12: false });

        const slides = document.querySelectorAll('.slide');
        let cur = 0;
        function next() {
            if (slides.length <= 1) return;
            slides[cur].classList.replace('opacity-100', 'opacity-0');
            slides[cur].classList.replace('z-20', 'z-10');
            cur = (cur + 1) % slides.length;
            slides[cur].classList.replace('opacity-0', 'opacity-100');
            slides[cur].classList.replace('z-10', 'z-20');
            setTimeout(next, (parseInt(slides[cur].dataset.duration) || 15) * 1000);
        }
        if (slides.length > 1) setTimeout(next, (parseInt(slides[0].dataset.duration) || 15) * 1000);
    </script>
</body>
</html>
