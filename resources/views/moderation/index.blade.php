@extends('layouts.app')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-black text-blue-950">Pusat Moderasi Guru</h2>
    <p class="text-xs text-slate-500">Tinjau dan setujui karya siswa sebelum ditayangkan ke Layar TV</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($pendingContents as $p)
        <div class="bg-white p-6 rounded-2xl border border-blue-100 shadow-md flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md border border-blue-200">{{ $p->media_type }}</span>
                    <span class="text-xs text-slate-400 font-medium">⏱ {{ $p->duration_seconds }}s</span>
                </div>
                <h3 class="text-lg font-black text-blue-950 mt-3">{{ $p->title }}</h3>
                <p class="text-xs text-slate-500 mt-1">Diajukan oleh: <span class="font-bold text-slate-700">{{ $p->submitter->name }}</span></p>
                @if($p->notes)
                    <p class="text-xs text-slate-600 bg-slate-50 p-2 rounded-lg mt-3 border border-slate-100 italic">"{{ $p->notes }}"</p>
                @endif
            </div>
            <div class="flex gap-2 mt-6 pt-4 border-t border-slate-100">
                <form action="{{ route('moderation.approve', $p->id) }}" method="POST" class="flex-1">@csrf
                    <button class="w-full py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-xs shadow-sm transition">Setujui</button>
                </form>
                <form action="{{ route('moderation.reject', $p->id) }}" method="POST" class="flex-1">@csrf
                    <button class="w-full py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-bold text-xs shadow-sm transition">Tolak</button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white p-12 rounded-2xl border border-blue-100 shadow-sm text-center">
            <p class="text-slate-400 font-medium">Tidak ada pengajuan karya siswa yang berstatus pending.</p>
        </div>
    @endforelse
</div>
@endsection
