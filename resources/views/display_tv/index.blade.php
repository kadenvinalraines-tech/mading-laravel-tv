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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono-num { font-family: 'JetBrains Mono', monospace; font-variant-numeric: tabular-nums; }
        .marquee { display: inline-block; white-space: nowrap; animation: marq 36s linear infinite; }
        @keyframes marq { 0% { transform: translateX(100vw); } 100% { transform: translateX(-100%); } }
        .ticker-mask {
            mask-image: linear-gradient(to right, transparent, black 3%, black 97%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 3%, black 97%, transparent);
        }
    </style>
</head>
<body class="h-screen w-screen bg-[#EEF4FF] text-slate-900 flex flex-col justify-between overflow-hidden antialiased select-none">

    <!-- Ambient Light Mesh Background -->
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-blue-400/20 rounded-full blur-[130px]"></div>
        <div class="absolute top-1/3 -right-20 w-[450px] h-[450px] bg-sky-300/25 rounded-full blur-[140px]"></div>
        <div class="absolute -bottom-20 left-1/3 w-[600px] h-[400px] bg-indigo-200/30 rounded-full blur-[150px]"></div>
    </div>

    <!-- Header: Vibrant Electric Royal Blue -->
    <header class="relative h-[80px] bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-600 px-8 flex justify-between items-center z-50 shadow-[0_8px_30px_rgba(37,99,235,0.25)] border-b border-blue-400/30">
        <div class="flex items-center space-x-4">
            <div class="relative group">
                <div class="h-13 w-13 rounded-2xl bg-white p-1.5 flex items-center justify-center shadow-lg border-2 border-white/80">
                    <img src="{{ $schoolLogo }}" class="h-10 w-10 object-contain" onerror="this.src='https://ui-avatars.com/api/?name=SMK&bg=2563eb&color=fff'">
                </div>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] px-2.5 py-0.5 rounded-full bg-white/20 text-white backdrop-blur-sm border border-white/30">Portal Resmi</span>
                    <h1 class="text-lg font-black tracking-tight text-white uppercase drop-shadow-sm">{{ $schoolName }}</h1>
                </div>
                <p class="text-[11px] font-semibold tracking-wide text-blue-100 mt-1 flex items-center space-x-1.5 drop-shadow-sm">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5 text-yellow-300"></i>
                    <span>{{ $schoolTagline }}</span>
                </p>
            </div>
        </div>

        <!-- Clock & Live Status Badge -->
        <div class="flex items-center space-x-3">
            <div class="flex items-center space-x-3 bg-white/15 backdrop-blur-md border border-white/30 px-4 py-2 rounded-2xl shadow-inner text-white">
                <div class="flex items-center space-x-2">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-300 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-400"></span>
                    </span>
                    <span class="text-[10px] font-black text-white tracking-widest uppercase">LIVE</span>
                </div>
                <div class="h-4 w-px bg-white/30"></div>
                <div id="clock" class="text-2xl font-black text-white font-mono-num tracking-wide drop-shadow-sm"></div>
            </div>
        </div>
    </header>

    <!-- Center Stage: Adaptive Media Canvas + Right Announcement Sidebar -->
    <main class="relative flex-1 w-full h-[calc(100vh-128px)] flex overflow-hidden z-10 p-4 gap-4">
        <!-- Media Canvas Area (Expands seamlessly to full width) -->
        <div id="media-canvas" class="relative h-full flex-1 flex items-center justify-center overflow-hidden rounded-3xl bg-slate-950 shadow-xl border border-slate-200/60 transition-all duration-700 ease-in-out">
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
                        <div class="p-10 bg-slate-900/95 text-white rounded-3xl shadow-2xl text-center border border-slate-800 max-w-lg backdrop-blur-xl">
                            <div class="w-16 h-16 bg-blue-600/20 text-blue-400 rounded-2xl border border-blue-500/30 flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="radio" class="w-8 h-8"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-100">{{ $s->title }}</h2>
                            <audio src="{{ $s->media_url }}" controls autoplay class="mt-6 w-full"></audio>
                        </div>
                    @endif

                    <!-- Crisp Floating Media Pill -->
                    <div class="absolute bottom-6 left-6 bg-slate-900/85 backdrop-blur-xl border border-white/20 text-white px-5 py-3.5 rounded-2xl shadow-2xl flex items-center space-x-3.5">
                        <div class="p-2.5 rounded-xl bg-blue-600 text-white shadow-md">
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
                            <p class="text-[10px] uppercase tracking-widest text-blue-300 font-bold leading-none">{{ $s->media_type }}</p>
                            <p class="text-sm font-extrabold text-white tracking-tight mt-1.5 leading-none">{{ $s->title }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-slate-400">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-3xl bg-slate-800/80 border border-slate-700 flex items-center justify-center text-blue-400">
                        <i data-lucide="tv" class="w-8 h-8"></i>
                    </div>
                    <p class="text-base font-bold text-slate-300">Mading Digital Aktif</p>
                    <p class="text-xs text-slate-500 mt-1">Belum ada konten tayang yang disetujui</p>
                </div>
            @endforelse
        </div>

        <!-- Right Side Panel: Clean Crisp White Cards (Auto-hides on Video/YouTube) -->
        <aside id="info-sidebar" class="w-[350px] h-full bg-white/90 backdrop-blur-xl border border-blue-200/80 rounded-3xl p-6 flex flex-col justify-between shrink-0 transition-all duration-700 ease-in-out shadow-xl">
            <div class="space-y-4">
                <!-- Sidebar Title -->
                <div class="flex items-center justify-between pb-3.5 border-b border-slate-100">
                    <div class="flex items-center space-x-2.5">
                        <div class="p-2 rounded-xl bg-blue-50 text-blue-600 border border-blue-200 shadow-sm">
                            <i data-lucide="bell" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-black uppercase tracking-wider text-slate-900">Warta Sekolah</h3>
                            <p class="text-[10px] font-semibold text-slate-400">Informasi Resmi Terkini</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-black px-2.5 py-1 bg-blue-600 text-white rounded-full shadow-sm">BARU</span>
                </div>

                <!-- Announcement Cards -->
                <div class="space-y-3">
                    @forelse(array_slice($runningTexts, 0, 3) as $idx => $ann)
                        <div class="relative p-4 rounded-2xl bg-blue-50/50 border-l-4 border-blue-600 border-y border-r border-blue-100 shadow-sm hover:shadow-md hover:bg-blue-50 transition group">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[10px] font-mono-num font-extrabold text-blue-700 bg-blue-100/70 px-2 py-0.5 rounded-md">#0{{ $idx + 1 }}</span>
                                <i data-lucide="bookmark" class="w-3.5 h-3.5 text-blue-400 group-hover:text-blue-600 transition"></i>
                            </div>
                            <p class="text-xs font-semibold text-slate-700 leading-relaxed line-clamp-3">{{ $ann }}</p>
                        </div>
                    @empty
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100 text-center">
                            <p class="text-xs text-slate-400">Belum ada warta tambahan.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Date & Institutional Badge Widget -->
            <div class="p-4 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white space-y-2 shadow-lg shadow-blue-500/20">
                <div class="text-xs font-black flex items-center space-x-2">
                    <i data-lucide="calendar" class="w-4 h-4 text-yellow-300"></i>
                    <span id="current-date" class="tracking-wide">Hari Ini</span>
                </div>
                <div class="text-[11px] font-medium text-blue-100 flex items-center space-x-2">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-blue-200"></i>
                    <span>Koridor Utama • Smart Display Kiosk</span>
                </div>
            </div>
        </aside>
    </main>

    <!-- Footer: Bright Vibrant Blue Marquee Ticker -->
    <footer class="relative h-12 bg-blue-600 border-t-2 border-blue-500 flex items-center overflow-hidden z-50 shadow-2xl">
        <div class="px-6 h-full bg-slate-900 text-white text-[11px] font-black tracking-widest uppercase shrink-0 flex items-center space-x-2.5 shadow-xl z-20">
            <i data-lucide="megaphone" class="w-4 h-4 text-yellow-400"></i>
            <span>PENGUMUMAN</span>
        </div>
        <div class="overflow-hidden w-full px-6 ticker-mask z-10">
            <div class="marquee text-xs font-bold tracking-wide text-white space-x-14 flex items-center drop-shadow-sm">
                @foreach($runningTexts as $rt)
                    <span class="inline-flex items-center space-x-3">
                        <span class="w-2 h-2 rounded-full bg-yellow-300 shadow-[0_0_8px_rgba(253,224,71,0.9)]"></span>
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
                sidebar.classList.add('opacity-0', '-mr-[370px]', 'pointer-events-none');
            } else {
                sidebar.classList.remove('opacity-0', '-mr-[370px]', 'pointer-events-none');
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
