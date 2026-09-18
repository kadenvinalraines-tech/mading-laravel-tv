@extends('layouts.app')
@section('content')
<h2 class="text-xl font-bold mb-6">Kelola Running Text & Profil TV</h2>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-gray-900 p-6 rounded-xl border border-gray-800">
        <h3 class="font-bold mb-4">Profil Sekolah</h3>
        <form action="{{ route('settings.updateProfile') }}" method="POST" enctype="multipart/form-data" class="space-y-3">@csrf
            <input type="text" name="school_name" value="{{ $schoolName }}" class="w-full p-2 bg-gray-950 rounded border border-gray-800 text-sm">
            <input type="text" name="school_tagline" value="{{ $schoolTagline }}" class="w-full p-2 bg-gray-950 rounded border border-gray-800 text-sm">
            <input type="file" name="school_logo" class="w-full text-xs text-gray-400">
            <button type="submit" class="w-full py-2 bg-blue-600 rounded font-bold text-sm">Simpan</button>
        </form>
    </div>
    <div class="lg:col-span-2 bg-gray-900 p-6 rounded-xl border border-gray-800">
        <h3 class="font-bold mb-4">Tambah Pengumuman</h3>
        <form action="{{ route('running_texts.store') }}" method="POST" class="space-y-3">@csrf
            <textarea name="text" required class="w-full p-3 bg-gray-950 rounded border border-gray-800 text-sm" placeholder="Teks pengumuman running text..."></textarea>
            <button type="submit" class="px-4 py-2 bg-blue-600 rounded font-bold text-sm">Tambah</button>
        </form>
        <div class="mt-6 divide-y divide-gray-800">
            @foreach($texts as $t)
                <div class="py-3 flex justify-between items-center">
                    <p class="text-sm">{{ $t->text }}</p>
                    <form action="{{ route('running_texts.toggle', $t->id) }}" method="POST">@csrf<button class="text-xs px-2.5 py-1 rounded {{ $t->is_active ? 'bg-emerald-900' : 'bg-gray-800' }}">{{ $t->is_active ? 'Aktif' : 'Off' }}</button></form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
