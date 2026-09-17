<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $schoolName }} - Mading Digital TV</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #030712;
            color: #f9fafb;
            overflow: hidden;
            user-select: none;
        }
        .marquee-content {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 35s linear infinite;
        }
        @keyframes marquee {
            0% { transform: translateX(100vw); }
            100% { transform: translateX(-100%); }
        }
        .fade-enter {
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
        }
        .fade-enter-active {
            opacity: 1;
        }
    </style>
</head>
<body class="h-screen w-screen flex flex-col justify-between">

    <!-- 1. TOP BAR: LOGO, NAMA SEKOLAH, JAM DIGITAL REAL-TIME -->
    <header class="h-20 bg-gray-900/90 backdrop-blur border-b border-gray-800 px-8 flex items-center justify-between z-50">
        <div class="flex items-center space-x-4">
            <div class="w-14 h-14 rounded-xl bg-blue-600/20 border border-blue-500/30 flex items-center justify-center overflow-hidden p-1 shadow-lg">
                <img src="{{ $schoolLogo }}" alt="Logo" class="max-h-full max-w-full object-contain" onerror="this.src='https://ui-avatars.com/api/?name=SMK&background=2563eb&color=fff&bold=true'">
            </div>
            <div>
                <h1 class="text-2xl font-black tracking-tight text-white uppercase">{{ $schoolName }}</h1>
                <p class="text-xs font-semibold text-blue-400 tracking-wider uppercase">{{ $schoolTagline }}</p>
            </div>
        </div>

        <div class="flex items-center space-x-6 text-right">
            <div class="hidden md:block">
                <div id="clock-date" class="text-xs font-medium text-gray-400">Memuat tanggal...</div>
                <div id="clock-time" class="text-3xl font-extrabold text-blue-400 tracking-wider">00:00:00</div>
            </div>
            <a href="{{ route('login') }}" class="opacity-10 hover:opacity-100 transition text-xs text-gray-500 hover:text-white px-2 py-1 rounded bg-gray-800">
                Panel
            </a>
        </div>
    </header>

    <!-- 2. MAIN DISPLAY: HAMPIR FULL SCREEN (VIDEO / SLIDER / GAMBAR / PDF / YOUTUBE) -->
    <main id="slider-container" class="flex-1 relative w-full h-[calc(100vh-10rem)] flex items-center justify-center bg-black overflow-hidden">
        @if($activeSliders->isEmpty())
            <div class="text-center p-12 max-w-lg">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-blue-950/40 border border-blue-500/20 flex items-center justify-center text-blue-400 text-4xl">
                    📺
                </div>
                <h2 class="text-3xl font-bold mb-3 text-white">Mading Digital Aktif</h2>
                <p class="text-gray-400 leading-relaxed">Belum ada karya atau pengumuman yang dijadwalkan tayang saat ini. Silakan login ke panel untuk mengunggah konten.</p>
            </div>
        @else
            @foreach($activeSliders as $index => $item)
                <div class="slide-item absolute inset-0 w-full h-full flex flex-col items-center justify-center transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100 z-20' : 'opacity-0 z-10 pointer-events-none' }}" 
                     data-duration="{{ $item->duration_seconds }}" 
                     data-type="{{ $item->media_type }}">
                    
                    @if($item->media_type === 'youtube')
                        @php
                            preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))([\w-]{11})/', $item->media_url, $matches);
                            $youtubeId = $matches[1] ?? null;
                        @endphp
                        @if($youtubeId)
                            <iframe class="w-full h-full border-0 pointer-events-auto" 
                                    src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}?autoplay=1&mute=1&controls=0&loop=1&playlist={{ $youtubeId }}&modestbranding=1" 
                                    allow="autoplay; encrypted-media">
                            </iframe>
                        @endif

                    @elseif($item->media_type === 'video')
                        <video class="w-full h-full object-contain bg-black" autoplay muted loop playsinline>
                            <source src="{{ $item->media_url }}" type="video/mp4">
                        </video>

                    @elseif($item->media_type === 'image')
                        <img src="{{ $item->media_url }}" alt="{{ $item->title }}" class="w-full h-full object-contain bg-black">

                    @elseif($item->media_type === 'pdf')
                        <iframe src="{{ $item->media_url }}#toolbar=0&navpanes=0&scrollbar=0" class="w-full h-full border-0 bg-white"></iframe>

                    @elseif($item->media_type === 'audio')
                        <div class="flex flex-col items-center justify-center p-12 bg-gradient-to-br from-gray-900 to-blue-950 rounded-3xl border border-blue-500/20 shadow-2xl max-w-xl text-center">
                            <div class="w-32 h-32 rounded-full bg-blue-600/20 border-2 border-blue-400 flex items-center justify-center text-5xl mb-6 animate-pulse">
                                🎵
                            </div>
                            <h3 class="text-3xl font-bold mb-2 text-white">{{ $item->title }}</h3>
                            <p class="text-blue-300 text-sm mb-6">Siaran Suara Informasi Sekolah</p>
                            <audio controls autoplay loop class="w-full">
                                <source src="{{ $item->media_url }}">
                            </audio>
                        </div>
                    @endif

                    <!-- Title Overlay Card (Bottom Left) -->
                    <div class="absolute bottom-6 left-8 bg-gray-950/80 backdrop-blur-md border border-gray-800/80 px-6 py-3 rounded-2xl max-w-2xl shadow-2xl z-30">
                        <span class="text-[10px] font-extrabold uppercase px-2.5 py-0.5 rounded-full bg-blue-600 text-white tracking-wider mr-2">{{ strtoupper($item->media_type) }}</span>
                        <h2 class="text-lg font-bold text-white inline">{{ $item->title }}</h2>
                    </div>
                </div>
            @endforeach
        @endif
    </main>

    <!-- 3. FOOTER BAR: RUNNING TEXT (TEKS BERJALAN) DINAMIS -->
    <footer class="h-16 bg-blue-950 border-t-2 border-blue-600 flex items-center overflow-hidden relative z-50 shadow-2xl">
        <div class="h-full px-6 bg-blue-600 flex items-center justify-center text-xs font-black uppercase tracking-widest text-white shrink-0 z-10 shadow-lg">
            ⚡ PENGUMUMAN
        </div>
        <div class="overflow-hidden whitespace-nowrap w-full flex items-center">
            <div class="marquee-content text-base font-bold text-blue-100 flex items-center space-x-16">
                @forelse($runningTexts as $text)
                    <span>📢 {{ $text }}</span>
                @empty
                    <span>Selamat Datang di Portal Mading Digital Sekolah • Media Informasi Terpadu Siswa & Guru</span>
                @endforelse
            </div>
        </div>
    </footer>

    <!-- REAL-TIME CLOCK & AUTO-SLIDER ENGINE -->
    <script>
        // Jam Digital Real-Time
        function updateClock() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const dayName = days[now.getDay()];
            const day = String(now.getDate()).padStart(2, '0');
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            document.getElementById('clock-date').innerText = `${dayName}, ${day} ${month} ${year}`;
            document.getElementById('clock-time').innerText = `${hours}:${minutes}:${seconds}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Auto Slider Engine
        const slides = document.querySelectorAll('.slide-item');
        let currentSlide = 0;

        function showNextSlide() {
            if (slides.length <= 1) return;

            slides[currentSlide].classList.remove('opacity-100', 'z-20');
            slides[currentSlide].classList.add('opacity-0', 'z-10', 'pointer-events-none');

            currentSlide = (currentSlide + 1) % slides.length;

            slides[currentSlide].classList.remove('opacity-0', 'z-10', 'pointer-events-none');
            slides[currentSlide].classList.add('opacity-100', 'z-20');

            const durationSec = parseInt(slides[currentSlide].getAttribute('data-duration')) || 15;
            setTimeout(showNextSlide, durationSec * 1000);
        }

        if (slides.length > 1) {
            const firstDuration = parseInt(slides[0].getAttribute('data-duration')) || 15;
            setTimeout(showNextSlide, firstDuration * 1000);
        }

        // Auto Refresh Halaman Tiap 15 Menit agar sinkron dengan data baru dari guru/siswa
        setTimeout(() => {
            window.location.reload();
        }, 15 * 60 * 1000);
    </script>
</body>
</html>
