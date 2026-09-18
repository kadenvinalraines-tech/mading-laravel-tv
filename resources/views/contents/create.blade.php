@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto bg-gray-900 p-6 rounded-2xl border border-gray-800">
    <h2 class="text-lg font-bold mb-4">Unggah Karya Mading</h2>
    <form method="POST" action="{{ route('contents.store') }}" enctype="multipart/form-data" class="space-y-4">@csrf
        <input type="text" name="title" placeholder="Judul Karya" required class="w-full p-3 bg-gray-950 rounded border border-gray-800">
        <select name="media_type" required class="w-full p-3 bg-gray-950 rounded border border-gray-800">
            <option value="youtube">YouTube Embed</option>
            <option value="image">Gambar / Poster</option>
            <option value="video">Video MP4</option>
            <option value="pdf">Dokumen PDF</option>
            <option value="audio">Audio</option>
        </select>
        <input type="url" name="media_url" placeholder="URL Media / YouTube" class="w-full p-3 bg-gray-950 rounded border border-gray-800">
        <input type="file" name="media_file" class="w-full text-xs text-gray-400">
        <input type="number" name="duration_seconds" value="15" min="5" max="300" class="w-full p-3 bg-gray-950 rounded border border-gray-800">
        <button type="submit" class="w-full py-3 bg-blue-600 rounded font-bold">Kirim</button>
    </form>
</div>
@endsection
