@extends('layouts.app')

@section('title', 'Teks Berjalan & Profil Sekolah')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- Kolom Kiri: Profil & Logo Sekolah -->
    <div class="lg:col-span-1">
        <div class="bg-gray-900 border border-gray-800 rounded-3xl p-6 shadow-xl sticky top-24">
            <h2 class="text-lg font-black text-white mb-4">Profil Layar TV</h2>
            <form action="{{ route('settings.updateProfile') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Nama Sekolah / Instansi</label>
                    <input type="text" name="school_name" value="{{ $schoolName }}" required class="w-full px-4 py-2.5 rounded-xl bg-gray-950 border border-gray-800 text-white text-sm focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Slogan / Tagline TV</label>
                    <input type="text" name="school_tagline" value="{{ $schoolTagline }}" required class="w-full px-4 py-2.5 rounded-xl bg-gray-950 border border-gray-800 text-white text-sm focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-2">Ganti Logo Sekolah</label>
                    <input type="file" name="school_logo" accept="image/*" class="w-full px-3 py-2 rounded-xl bg-gray-950 border border-gray-800 text-xs text-gray-400 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:bg-blue-600 file:text-white">
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-blue-600 text-white font-bold text-sm hover:bg-blue-500 transition shadow-lg shadow-blue-600/30">
                    Simpan Profil TV
                </button>
            </form>
        </div>
    </div>

    <!-- Kolom Kanan: Running Text Management -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-gray-900 border border-gray-800 rounded-3xl p-6 shadow-xl">
            <h2 class="text-lg font-black text-white mb-4">Tambah Teks Berjalan (Running Text)</h2>
            <form action="{{ route('running_texts.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <textarea name="text" rows="3" required placeholder="Ketik pengumuman yang akan berjalan di footer bawah TV..." class="w-full px-4 py-3 rounded-xl bg-gray-950 border border-gray-800 text-white text-sm focus:outline-none focus:border-blue-500"></textarea>
                </div>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 text-white font-bold text-sm hover:bg-blue-500 transition shadow-lg shadow-blue-600/30">
                    ➕ Tambah Pengumuman
                </button>
            </form>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden shadow-xl">
            <div class="p-6 border-b border-gray-800">
                <h3 class="text-base font-bold text-white">Daftar Pengumuman Running Text</h3>
            </div>
            <div class="divide-y divide-gray-800/60">
                @forelse($texts as $t)
                    <div class="p-6 flex items-center justify-between gap-4 hover:bg-gray-800/40 transition">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-100 mb-1">{{ $t->text }}</p>
                            <span class="text-xs text-gray-500">Dibuat oleh: {{ $t->creator->name }} • {{ $t->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <form action="{{ route('running_texts.toggle', $t->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold transition {{ $t->is_active ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : 'bg-gray-800 text-gray-400' }}">
                                    {{ $t->is_active ? 'Aktif Tayang' : 'Nonaktif' }}
                                </button>
                            </form>

                            <form action="{{ route('running_texts.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-400 hover:text-red-300">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center text-gray-500">
                        Belum ada teks berjalan.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection
