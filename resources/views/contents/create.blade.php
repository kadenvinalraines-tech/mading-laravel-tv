@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl border border-blue-100 shadow-xl">
    <div class="mb-6">
        <h2 class="text-2xl font-black text-blue-950">Unggah Karya Mading</h2>
        <p class="text-xs text-slate-500">Materi yang diunggah akan tayang di Display TV</p>
    </div>
    <form method="POST" action="{{ route('contents.store') }}" enctype="multipart/form-data" class="space-y-5">@csrf
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Judul Karya / Pengumuman</label>
            <input type="text" name="title" placeholder="Contoh: Juara 1 Lomba Robotik Nasional" required class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Tipe Media</label>
                <select name="media_type" required class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800 font-medium">
                    <option value="image">Gambar / Poster</option>
                    <option value="youtube">YouTube Video</option>
                    <option value="video">Video MP4</option>
                    <option value="pdf">Dokumen PDF</option>
                    <option value="audio">Audio</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Durasi Tayang (Detik)</label>
                <input type="number" name="duration_seconds" value="15" min="5" max="300" class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800">
            </div>
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">URL Media (Wajib jika YouTube / Link Luar)</label>
            <input type="url" name="media_url" placeholder="https://www.youtube.com/watch?v=..." class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Unggah Berkas (JPG, PNG, WEBP, MP4, PDF, MP3)</label>
            <input type="file" name="media_file" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
        </div>
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Catatan Tambahan (Opsional)</label>
            <textarea name="notes" rows="3" placeholder="Informasi singkat atau kredit karya..." class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800"></textarea>
        </div>
        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-md transition text-sm">Kirim Karya</button>
    </form>
</div>
@endsection
