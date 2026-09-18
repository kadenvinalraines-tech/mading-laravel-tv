@extends('layouts.app')
@section('content')
<div class="mb-6">
    <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Pusat Moderasi Guru</h2>
    <p class="text-xs text-slate-500 mt-0.5">Tinjau dan kurasi materi siswa sebelum disiarkan ke Layar TV</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($pendingContents as $p)
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-4px_rgba(15,23,42,0.04)] flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md border border-blue-200/60">{{ $p->media_type }}</span>
                    <span class="text-[11px] text-slate-400 font-medium">⏱ {{ $p->duration_seconds }}s</span>
                </div>
                <h3 class="text-base font-bold text-slate-900 mt-3.5 leading-snug">{{ $p->title }}</h3>
                <p class="text-xs text-slate-500 mt-1">Diajukan oleh: <span class="font-semibold text-slate-700">{{ $p->submitter->name }}</span></p>
                @if($p->notes)
                    <p class="text-xs text-slate-600 bg-slate-50 p-2.5 rounded-xl mt-3 border border-slate-200/60 italic leading-relaxed">"{{ $p->notes }}"</p>
                @endif
            </div>
            <div class="flex gap-2.5 mt-6 pt-4 border-t border-slate-100">
                <form action="{{ route('moderation.approve', $p->id) }}" method="POST" class="flex-1">@csrf
                    <button class="w-full py-2 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-xl font-bold text-xs shadow-sm transition">Setujui</button>
                </form>
                <form action="{{ route('moderation.reject', $p->id) }}" method="POST" class="flex-1">@csrf
                    <button class="w-full py-2 bg-slate-100 hover:bg-rose-50 text-slate-700 hover:text-rose-700 border border-slate-200/80 hover:border-rose-200 rounded-xl font-bold text-xs transition">Tolak</button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white p-14 rounded-2xl border border-slate-200/80 shadow-[0_4px_20px_-4px_rgba(15,23,42,0.03)] text-center">
            <p class="text-slate-400 text-xs font-medium">Tidak ada materi karya siswa yang sedang menunggu moderasi.</p>
        </div>
    @endforelse
</div>
@endsection
