@extends('layouts.app')

@section('title', 'Unggah Konten Mading')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('contents.index') }}" class="text-sm font-semibold text-blue-400 hover:underline">← Kembali ke Daftar</a>
        <h1 class="text-2xl font-black text-white mt-2">Unggah Karya Mading TV</h1>
        @if(auth()->user()->isSiswa())
            <p class="text-xs text-amber-400 mt-1">ℹ️ Karya yang Anda submit akan dimoderasi (di-ACC) terlebih dahulu oleh Guru Pembimbing sebelum tayang di TV.</p>
        @else
            <p class="text-xs text-emerald-400 mt-1">ℹ️ Konten dari Guru/Admin langsung berstatus Approved dan otomatis masuk antrean TV.</p>
        @endif
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-red-950/80 border border-red-800 text-red-300 text-xs font-semibold">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="bg-gray-900 border border-gray-800 rounded-3xl p-8 shadow-2xl">
        <form action="{{ route('contents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Judul Konten / Karya</label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Video Profil Jurusan TJKT atau Poster Lomba" class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Tipe Media</label>
                    <select name="media_type" id="media_type" required class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500" onchange="toggleInputs(this.value)">
                        <option value="youtube">Video YouTube (Embed Link)</option>
                        <option value="image">Gambar / Poster Karya (File/URL)</option>
                        <option value="video">Video Lokal MP4</option>
                        <option value="pdf">Dokumen PDF (E-Mading / Cerpen)</option>
                        <option value="audio">Audio Informasi / Podcast</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Durasi Tayang Slide (Detik)</label>
                    <input type="number" name="duration_seconds" value="15" min="5" max="300" required class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div id="url_container">
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">URL / Link YouTube / Link Gambar</label>
                <input type="url" name="media_url" value="{{ old('media_url') }}" placeholder="https://www.youtube.com/watch?v=..." class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500">
            </div>

            <div id="file_container" class="hidden">
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Upload File Media (Gambar, MP4, PDF, MP3)</label>
                <input type="file" name="media_file" class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Tanggal Mulai Tayang (Opsional)</label>
                    <input type="datetime-local" name="start_date" class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Tanggal Berhenti Tayang (Opsional)</label>
                    <input type="datetime-local" name="end_date" class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-500 transition shadow-lg shadow-blue-600/30">
                Kirim Konten Sekarang
            </button>
        </form>
    </div>
</div>

<script>
function toggleInputs(type) {
    const urlCont = document.getElementById('url_container');
    const fileCont = document.getElementById('file_container');

    if (type === 'youtube') {
        urlCont.classList.remove('hidden');
        fileCont.classList.add('hidden');
    } else {
        urlCont.classList.remove('hidden');
        fileCont.classList.remove('hidden');
    }
}
</script>
@endsection
