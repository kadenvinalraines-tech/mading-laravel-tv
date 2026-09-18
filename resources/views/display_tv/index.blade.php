<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $schoolName }} - Mading TV Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono-num { font-family: 'JetBrains Mono', monospace; font-variant-numeric: tabular-nums; }
        .marquee { display: inline-block; white-space: nowrap; animation: marq 38s linear infinite; }
        @keyframes marq { 0% { transform: translateX(100vw); } 100% { transform: translateX(-100%); } }
        .ticker-mask {
            mask-image: linear-gradient(to right, transparent, black 4%, black 96%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 4%, black 96%, transparent);
        }
    </style>
</head>
<body class="h-screen w-screen bg-[#070A12] text-slate-100 flex flex-col justify-between overflow-hidden antialiased select-none">

    <!-- Ambient Mesh Background Glow for Depth -->
    <div class="fixed inset-0 pointer-events-none z-0 opacity-25">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-600/30 rounded-full blur-[120px]"></div>
        <div class="absolute top-1/2 right-0 w-96 h-96 bg-indigo-600/20 rounded-full blur-[140px]"></div>
    </div>

    <!-- Header: Refined Institutional Frosted Bar -->
    <header class="relative h-[78px] bg-slate-900/80 backdrop-blur-xl border-b border-slate-800/80 px-8 flex justify-between items-center z-50 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.5)]">
        <div class="flex items-center space-x-4">
            <div class="relative group">
                <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl blur opacity-30"></div>
                <div class="relative h-12 w-12 rounded-xl bg-slate-900 border border-slate-700/60 p-1 flex items-center justify-center overflow-hidden shadow-inner">
                    <img src="{{ $schoolLogo }}" class="h-full w-full object-contain" onerror="this.src='https://ui-avatars.com/api/?name=SMK&bg=1e293b&color=38bdf8'">
                </div>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-[0.2em] px-2 py-0.5 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20">Portal Resmi</span>
                    <h1 class="text-base font-extrabold tracking-tight text-white uppercase">{{ $schoolName }}</h1>
                </div>
                <p class="text-[11px] font-medium tracking-wide text-slate-400 mt-1 flex items-center space-x-1.5">
                    <i data-lucide="sparkles" class="w-3 h-3 text-blue-400"></i>
                    <span>{{ $schoolTagline }}</span>
                </p>
            </div>
        </div>

        <!-- Clock & Online Status Badge -->
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3 bg-slate-800/60 backdrop-blur-md border border-slate-700/60 px-4 py-2 rounded-2xl shadow-inner">
                <div class="flex items-center space-x-2">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span class="text-[10px] font-extrabold text-slate-400 tracking-wider">LIVE</span>
                </div>
                <div class="h-4 w-px bg-slate-700/80"></div>
                <div id="clock" class="text-xl font-black text-white font-mono-num tracking-wide"></div>
            </div>
        </div>
    </header>

    <!-- Center Stage: Adaptive Media Canvas + Right Announcement Sidebar -->
    <main class="relative flex-1 w-full h-[calc(100vh-126px)] flex overflow-hidden z-10">
        <!-- Media Canvas Area (Transitions seamlessly) -->
        <div id="media-canvas" class="relative h-full flex-1 flex items-center justify-center overflow-hidden transition-all duration-700 ease-in-out">
            @forelse($activeSliders as $i => $s)
                <div class="slide absolute inset-0 w-full h-full flex items-center justify-center transition-opacity duration-1000 ease-in-out {{ $i === 0 ? 'opacity-100 z-20' : 'opacity-0 z-10' }}" 
                     data-duration="{{ $s->duration_seconds }}" 
                     data-type="{{ $s->media_type }}">
                    @if($s->media_type === 'youtube')
                        @php preg_match('/(?:youtu\.be\/|v\/|watch\?v=)([\w-]{11})/', $s->media_url, $m); @endphp
                        <iframe class="w-full h-full pointer-events-none" src="https://www.youtube-nocookie.com/embed/{{ $m[1] ?? '' }}?autoplay=1&mute=1&controls=0&loop=1&playlist={{ $m[1] ?? '' }}" frameborder="0"></iframe>
                    @elseif($s->media_type === 'video')
                        <video class="w-full h-full object-contain" autoplay muted loop playsinline><source src="{{ $s->media_url }}"></video>
                    @elseif($s->media_type === 'image')
                        <img src="{{ $s->media_url }}" class="w-full h-full object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.8)]">
                    @elseif($s->media_type === 'pdf')
                        <iframe src="{{ $s->media_url }}#toolbar=0" class="w-full h-full bg-white"></iframe>
                    @else
                        <div class="p-10 bg-slate-900/90 text-white rounded-3xl shadow-2xl text-center border border-slate-800 max-w-lg backdrop-blur-xl">
                            <div class="w-14 h-14 bg-blue-600/20 text-blue-400 rounded-2xl border border-blue-500/30 flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="radio" class="w-7 h-7"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-100">{{ $s->title }}</h2>
                            <audio src="{{ $s->media_url }}" controls autoplay class="mt-6 w-full"></audio>
                        </div>
                    @endif

                    <!-- Subtle Glass Floating Badge -->
                    <div class="absolute bottom-6 left-8 bg-slate-900/80 backdrop-blur-xl border border-white/10 text-white px-5 py-3.5 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex items-center space-x-3.5">
                        <div class="p-2 rounded-xl bg-blue-600/20 text-blue-400 border border-blue-500/30">
                            @if($s->media_type === 'video' || $s->media_type === 'youtube')
                                <i data-lucide="play-circle" class="w-4 h-4"></i>
                            @elseif($s->media_type === 'pdf')
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                            @elseif($s->media_type === 'audio')
                                <i data-lucide="volume-2" class="w-4 h-4"></i>
                            @else
                                <i data-lucide="image" class="w-4 h-4"></i>
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-widest text-slate-400 font-bold leading-none">{{ $s->media_type }}</p>
                            <p class="text-sm font-bold text-white tracking-tight mt-1.5 leading-none">{{ $s->title }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-slate-500">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-3xl bg-slate-900/80 border border-slate-800 flex items-center justify-center text-slate-400">
                        <i data-lucide="tv" class="w-8 h-8"></i>
                    </div>
                    <p class="text-base font-bold text-slate-400">Mading Digital Aktif</p>
                    <p class="text-xs text-slate-600 mt-1">Belum ada konten tayang yang disetujui</p>
                </div>
            @endforelse
        </div>

        <!-- Right Side Panel: Layered Announcement Cards (Auto-hides on Video/YouTube) -->
        <aside id="info-sidebar" class="w-[340px] h-full bg-slate-900/70 backdrop-blur-2xl border-l border-slate-800/80 p-6 flex flex-col justify-between shrink-0 transition-all duration-700 ease-in-out shadow-2xl">
            <div class="space-y-5">
                <!-- Sidebar Title -->
                <div class="flex items-center justify-between pb-3.5 border-b border-slate-800/80">
                    <div class="flex items-center space-x-2.5">
                        <div class="p-1.5 rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/20">
                            <i data-lucide="bell" class="w-4 h-4"></i>
                        </div>
                        <h3 class="text-xs font-black uppercase tracking-wider text-slate-200">Warta Sekolah</h3>
                    </div>
                    <span class="text-[10px] font-extrabold px-2.5 py-0.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-full">TERKINI</span>
                </div>

                <!-- Announcement List Cards -->
                <div class="space-y-3">
                    @forelse(array_slice($runningTexts, 0, 3) as $idx => $ann)
                        <div class="relative p-4 rounded-2xl bg-slate-800/40 border border-slate-700/40 hover:border-blue-500/40 transition group shadow-sm">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-[10px] font-mono-num font-bold text-blue-400">0{{ $idx + 1 }}</span>
                                <i data-lucide="bookmark" class="w-3.5 h-3.5 text-slate-600 group-hover:text-blue-400 transition"></i>
                            </div>
                            <p class="text-xs font-medium text-slate-300 leading-relaxed line-clamp-3">{{ $ann }}</p>
                        </div>
                    @empty
                        <div class="p-6 rounded-2xl bg-slate-800/20 border border-slate-800 text-center">
                            <p class="text-xs text-slate-500">Belum ada warta tambahan.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Date & Institutional Badge Widget -->
            <div class="p-4 rounded-2xl bg-gradient-to-br from-slate-800/50 to-slate-900/70 border border-slate-700/50 space-y-2.5 shadow-inner">
                <div class="text-[11px] font-bold text-slate-300 flex items-center space-x-2">
                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-blue-400"></i>
                    <span id="current-date" class="tracking-wide">Hari Ini</span>
                </div>
                <div class="text-[11px] font-medium text-slate-400 flex items-center space-x-2">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-500"></i>
                    <span>Koridor Utama • Smart Kiosk</span>
                </div>
            </div>
        </aside>
    </main>

    <!-- Footer: Cinematic Dark Navy Marquee with Edge Fade Mask -->
    <footer class="relative h-12 bg-slate-950 border-t border-slate-800 flex items-center overflow-hidden z-50">
        <div class="px-5 h-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-[10px] font-black tracking-widest uppercase shrink-0 flex items-center space-x-2 shadow-lg z-20">
            <i data-lucide="megaphone" class="w-4 h-4"></i>
            <span>PENGUMUMAN</span>
        </div>
        <div class="overflow-hidden w-full px-6 ticker-mask z-10">
            <div class="marquee text-xs font-semibold tracking-wide text-slate-300 space-x-14 flex items-center">
                @foreach($runningTexts as $rt)
                    <span class="inline-flex items-center space-x-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500 shadow-[0_0_6px_rgba(59,130,246,0.9)]"></span>
                        <span>{{ $rt }}</span>
                    </span>
                @endforeach
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        setInterval(() => {
            const now = new Date();
            document.getElementById('clock').innerText = now.toLocaleTimeString('id-ID', { hour12: false });
        }, 1000);
        document.getElementById('clock').innerText = new Date().toLocaleTimeString('id-ID', { hour12: false });

        // Update current date widget in sidebar
        const optionsDate = { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' };
        document.getElementById('current-date').innerText = new Date().toLocaleDateString('id-ID', optionsDate);

        const slides = document.querySelectorAll('.slide');
        const sidebar = document.getElementById('info-sidebar');
        let cur = 0;

        function updateLayoutForMediaType(type) {
            if (!sidebar) return;
            // Video and YouTube take full screen width, hiding the sidebar smoothly
            if (type === 'video' || type === 'youtube') {
                sidebar.classList.add('opacity-0', '-mr-[340px]', 'pointer-events-none');
            } else {
                sidebar.classList.remove('opacity-0', '-mr-[340px]', 'pointer-events-none');
            }
        }

        if (slides.length > 0) {
            updateLayoutForMediaType(slides[0].dataset.type);
        }

        function next() {
            if (slides.length <= 1) return;
            slides[cur].classList.replace('opacity-100', 'opacity-0');
            slides[cur].classList.replace('z-20', 'z-10');
            cur = (cur + 1) % slides.length;
            slides[cur].classList.replace('opacity-0', 'opacity-100');
            slides[cur].classList.replace('z-10', 'z-20');

            updateLayoutForMediaType(slides[cur].dataset.type);

            setTimeout(next, (parseInt(slides[cur].dataset.duration) || 15) * 1000);
        }
        if (slides.length > 1) setTimeout(next, (parseInt(slides[0].dataset.duration) || 15) * 1000);
    </script>
</body>
</html>
