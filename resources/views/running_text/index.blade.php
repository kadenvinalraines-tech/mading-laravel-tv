@extends('layouts.app')
@section('content')
<div class="mb-6">
    <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Kelola Running Text & Profil TV</h2>
    <p class="text-xs text-slate-500 mt-0.5">Pengaturan identitas instansi dan warta berjalan di layar mading</p>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-4px_rgba(15,23,42,0.04)]">
        <h3 class="font-bold text-slate-900 mb-4">Profil Sekolah</h3>
        @if($schoolLogo = \App\Models\Setting::get('school_logo'))
            <div class="mb-4 flex items-center space-x-3 bg-slate-50 p-3 rounded-xl border border-slate-200/80">
                <img src="{{ $schoolLogo }}" class="h-10 w-10 object-contain rounded-lg bg-white p-1 border border-slate-200/80" onerror="this.style.display='none'">
                <div>
                    <span class="block text-xs font-bold text-slate-800">Logo Aktif</span>
                    <span class="block text-[10px] text-slate-400">Ditampilkan di header TV</span>
                </div>
            </div>
        @endif
        <form action="{{ route('settings.updateProfile') }}" method="POST" enctype="multipart/form-data" class="space-y-4">@csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Sekolah</label>
                <input type="text" name="school_name" value="{{ $schoolName }}" class="w-full px-3 py-2 bg-slate-50/70 rounded-xl border border-slate-200 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/30 focus:border-blue-600 text-slate-800 font-medium transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Tagline / Slogan</label>
                <input type="text" name="school_tagline" value="{{ $schoolTagline }}" class="w-full px-3 py-2 bg-slate-50/70 rounded-xl border border-slate-200 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/30 focus:border-blue-600 text-slate-800 font-medium transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Unggah Logo Baru</label>
                <input type="file" name="school_logo" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
            </div>
            <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl font-bold text-xs shadow-sm shadow-blue-600/20 transition">Simpan Profil</button>
        </form>
    </div>
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-4px_rgba(15,23,42,0.04)]">
        <h3 class="font-bold text-slate-900 mb-4">Tambah Pengumuman Running Text</h3>
        <form action="{{ route('running_texts.store') }}" method="POST" class="space-y-3">@csrf
            <textarea name="text" required rows="2" class="w-full p-3 bg-slate-50/70 rounded-xl border border-slate-200 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/30 focus:border-blue-600 text-slate-800 transition" placeholder="Tuliskan pengumuman yang akan berjalan di footer TV..."></textarea>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl font-bold text-xs shadow-sm shadow-blue-600/20 transition">Tambah Pengumuman</button>
        </form>
        <div class="mt-6 divide-y divide-slate-100">
            @forelse($texts as $t)
                <div class="py-3.5 flex justify-between items-center gap-4">
                    <p class="text-xs font-medium text-slate-700 leading-relaxed">{{ $t->text }}</p>
                    <div class="flex items-center space-x-2 shrink-0">
                        <form action="{{ route('running_texts.toggle', $t->id) }}" method="POST">@csrf
                            <button class="text-[11px] px-2.5 py-1 rounded-full font-bold transition {{ $t->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100' : 'bg-slate-100 text-slate-500 border border-slate-200 hover:bg-slate-200' }}">
                                {{ $t->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                        <form action="{{ route('running_texts.destroy', $t->id) }}" method="POST">@csrf @method('DELETE')
                            <button class="text-slate-400 hover:text-rose-600 text-xs font-semibold hover:underline transition">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="py-8 text-center text-slate-400 text-xs">Belum ada pengumuman running text.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
