@extends('layouts.app')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-black text-blue-950">Kelola Running Text & Profil TV</h2>
    <p class="text-xs text-slate-500">Sesuaikan identitas sekolah dan pengumuman teks berjalan di layar mading</p>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-2xl border border-blue-100 shadow-md">
        <h3 class="font-black text-blue-950 mb-4">Profil Sekolah</h3>
        @if($schoolLogo = \App\Models\Setting::get('school_logo'))
            <div class="mb-4 flex items-center space-x-3 bg-blue-50/60 p-3 rounded-xl border border-blue-100">
                <img src="{{ $schoolLogo }}" class="h-10 w-10 object-contain rounded-lg bg-white p-1 border border-blue-100" onerror="this.style.display='none'">
                <div>
                    <span class="block text-xs font-bold text-blue-900">Logo Aktif</span>
                    <span class="block text-[10px] text-slate-500">Tayang di header TV</span>
                </div>
            </div>
        @endif
        <form action="{{ route('settings.updateProfile') }}" method="POST" enctype="multipart/form-data" class="space-y-4">@csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Sekolah</label>
                <input type="text" name="school_name" value="{{ $schoolName }}" class="w-full p-2.5 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800 font-medium">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Tagline / Slogan</label>
                <input type="text" name="school_tagline" value="{{ $schoolTagline }}" class="w-full p-2.5 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800 font-medium">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Ganti Logo Sekolah</label>
                <input type="file" name="school_logo" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            </div>
            <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm shadow-md transition">Simpan Profil</button>
        </form>
    </div>
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-blue-100 shadow-md">
        <h3 class="font-black text-blue-950 mb-4">Tambah Pengumuman Running Text</h3>
        <form action="{{ route('running_texts.store') }}" method="POST" class="space-y-3">@csrf
            <textarea name="text" required rows="2" class="w-full p-3 bg-slate-50 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 text-slate-800" placeholder="Tuliskan pengumuman baru yang akan berjalan di footer TV..."></textarea>
            <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm shadow-md transition">Tambah Pengumuman</button>
        </form>
        <div class="mt-6 divide-y divide-slate-100">
            @forelse($texts as $t)
                <div class="py-3.5 flex justify-between items-center gap-4">
                    <p class="text-sm font-medium text-slate-700">{{ $t->text }}</p>
                    <div class="flex items-center space-x-2 shrink-0">
                        <form action="{{ route('running_texts.toggle', $t->id) }}" method="POST">@csrf
                            <button class="text-xs px-3 py-1 rounded-full font-bold transition {{ $t->is_active ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                                {{ $t->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                        <form action="{{ route('running_texts.destroy', $t->id) }}" method="POST">@csrf @method('DELETE')
                            <button class="text-rose-600 hover:text-rose-800 text-xs font-bold hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="py-6 text-center text-slate-400 text-sm">Belum ada pengumuman running text.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
