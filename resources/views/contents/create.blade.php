@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl border border-slate-200/80 shadow-[0_10px_30px_-5px_rgba(15,23,42,0.05)]">
    <div class="mb-6">
        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Unggah Materi Mading</h2>
        <p class="text-xs text-slate-500 mt-1">Karya dan materi pengumuman yang diunggah akan tayang di Display TV</p>
    </div>
    <form method="POST" action="{{ route('contents.store') }}" enctype="multipart/form-data" class="space-y-5">@csrf
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Materi / Pengumuman</label>
            <input type="text" name="title" placeholder="Contoh: Prestasi Juara 1 Lomba Inovasi Teknologi" required class="w-full px-3.5 py-2.5 bg-slate-50/70 rounded-xl border border-slate-200 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/30 focus:border-blue-600 text-slate-800 transition">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Format Tampilan</label>
                <select name="media_type" required class="w-full px-3.5 py-2.5 bg-slate-50/70 rounded-xl border border-slate-200 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/30 focus:border-blue-600 text-slate-800 font-medium transition">
                    <option value="image">Gambar / Poster Digital</option>
                    <option value="youtube">YouTube Video Streaming</option>
                    <option value="video">Video MP4 File</option>
                    <option value="pdf">Dokumen PDF Pengumuman</option>
                    <option value="audio">Siaran Audio Informasi</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Durasi Tayang Tiap Slide (Detik)</label>
                <input type="number" name="duration_seconds" value="15" min="5" max="300" class="w-full px-3.5 py-2.5 bg-slate-50/70 rounded-xl border border-slate-200 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/30 focus:border-blue-600 text-slate-800 transition">
            </div>
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Tautan URL Media (Wajib jika YouTube / Sumber Daring)</label>
            <input type="url" name="media_url" placeholder="https://www.youtube.com/watch?v=..." class="w-full px-3.5 py-2.5 bg-slate-50/70 rounded-xl border border-slate-200 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/30 focus:border-blue-600 text-slate-800 transition">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Unggah Berkas Langsung (JPG, PNG, WEBP, MP4, PDF, MP3)</label>
            <input type="file" name="media_file" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Catatan Tambahan (Opsional)</label>
            <textarea name="notes" rows="3" placeholder="Informasi singkat atau kredit karya..." class="w-full px-3.5 py-2.5 bg-slate-50/70 rounded-xl border border-slate-200 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/30 focus:border-blue-600 text-slate-800 transition"></textarea>
        </div>
        <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl font-bold shadow-md shadow-blue-600/20 transition text-sm">Simpan & Ajukan Materi</button>
    </form>
</div>
@endsection
