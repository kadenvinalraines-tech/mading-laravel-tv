@extends('layouts.app')
@section('content')
<h2 class="text-xl font-bold mb-6">Pusat Moderasi Guru</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @forelse($pendingContents as $p)
        <div class="bg-gray-900 p-6 rounded-xl border border-gray-800 flex flex-col justify-between">
            <div>
                <span class="text-xs uppercase bg-blue-900 px-2 py-1 rounded">{{ $p->media_type }}</span>
                <h3 class="text-lg font-bold mt-2">{{ $p->title }}</h3>
                <p class="text-xs text-gray-400 mt-1">Oleh: {{ $p->submitter->name }}</p>
            </div>
            <div class="flex gap-2 mt-4">
                <form action="{{ route('moderation.approve', $p->id) }}" method="POST" class="flex-1">@csrf<button class="w-full py-2 bg-emerald-600 rounded font-bold text-xs">Setujui</button></form>
                <form action="{{ route('moderation.reject', $p->id) }}" method="POST" class="flex-1">@csrf<button class="w-full py-2 bg-red-900 rounded font-bold text-xs">Tolak</button></form>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Tidak ada pengajuan pending.</p>
    @endforelse
</div>
@endsection
