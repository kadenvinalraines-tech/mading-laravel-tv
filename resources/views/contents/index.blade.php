@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Daftar Konten Mading</h2>
        <p class="text-xs text-slate-500 mt-0.5">Kelola dan pantau status publikasi materi mading</p>
    </div>
    <a href="{{ route('contents.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl font-bold text-xs shadow-sm shadow-blue-600/20 transition flex items-center space-x-1.5">
        <span>➕</span><span>Unggah Konten</span>
    </a>
</div>
<div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-[0_4px_20px_-4px_rgba(15,23,42,0.04)]">
    <table class="w-full text-left text-sm">
        <thead class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
            <tr>
                <th class="py-3.5 px-6">Judul Materi</th>
                <th class="py-3.5 px-6">Format</th>
                <th class="py-3.5 px-6">Status Tayang</th>
                <th class="py-3.5 px-6 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($contents as $c)
            <tr class="hover:bg-slate-50/60 transition">
                <td class="py-4 px-6 font-semibold text-slate-800">{{ $c->title }}</td>
                <td class="py-4 px-6">
                    <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-md text-[10px] font-extrabold uppercase tracking-wider border border-slate-200/60">{{ $c->media_type }}</span>
                </td>
                <td class="py-4 px-6 text-xs">
                    @if($c->status === 'approved')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-emerald-500"></span>Tayang
                        </span>
                    @elseif($c->status === 'rejected')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-rose-500"></span>Ditolak
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-amber-500"></span>Menunggu
                        </span>
                    @endif
                </td>
                <td class="py-4 px-6 text-right">
                    <form action="{{ route('contents.destroy', $c->id) }}" method="POST">@csrf @method('DELETE')
                        <button class="text-slate-400 hover:text-rose-600 text-xs font-semibold hover:underline transition">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-14 text-center text-slate-400 text-xs">Belum ada materi mading yang diunggah.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
