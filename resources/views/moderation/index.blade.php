@extends('layouts.app')

@section('title', 'Moderasi Konten Siswa')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-black text-white">Pusat Moderasi Guru & Admin</h1>
    <p class="text-sm text-gray-400">Verifikasi pengajuan karya dan draf mading dari siswa sebelum ditayangkan ke TV</p>
</div>

<!-- Pending Approvals -->
<div class="mb-12">
    <h2 class="text-lg font-bold text-blue-400 uppercase tracking-wider mb-4 flex items-center gap-2">
        <span>⏳ Menunggu Persetujuan (Pending)</span>
        <span class="px-2.5 py-0.5 rounded-full text-xs bg-blue-600 text-white">{{ $pendingContents->count() }}</span>
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($pendingContents as $p)
            <div class="bg-gray-900 border border-gray-800 rounded-3xl p-6 shadow-xl flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span class="text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-lg bg-blue-950 border border-blue-800 text-blue-300">
                            {{ $p->media_type }}
                        </span>
                        <span class="text-xs text-gray-500">{{ $p->created_at->diffForHumans() }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">{{ $p->title }}</h3>
                    <p class="text-xs text-gray-400 mb-4">Pengirim: <span class="font-bold text-gray-200">{{ $p->submitter->name }}</span> ({{ $p->submitter->email }})</p>

                    <div class="p-3 bg-gray-950 rounded-xl border border-gray-800 text-xs text-blue-300 break-all mb-4">
                        Media: <a href="{{ $p->media_url }}" target="_blank" class="underline">Lihat Lampiran / Link</a>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-800">
                    <form action="{{ route('moderation.approve', $p->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition">
                            ✅ Setujui (Tayang TV)
                        </button>
                    </form>

                    <form action="{{ route('moderation.reject', $p->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full py-2.5 rounded-xl bg-red-950 border border-red-800 hover:bg-red-900 text-red-300 text-xs font-bold transition">
                            ❌ Tolak
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-2 bg-gray-900 border border-gray-800 rounded-3xl p-12 text-center text-gray-500">
                Tidak ada draf karya siswa yang menunggu persetujuan.
            </div>
        @endforelse
    </div>
</div>

<!-- History Moderasi -->
<div>
    <h2 class="text-lg font-bold text-gray-300 uppercase tracking-wider mb-4">Riwayat Keputusan Moderasi</h2>
    <div class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden shadow-xl">
        <table class="w-full text-left text-sm text-gray-300">
            <thead class="bg-gray-950/60 border-b border-gray-800 text-xs font-bold text-gray-400 uppercase">
                <tr>
                    <th class="px-6 py-4">Judul</th>
                    <th class="px-6 py-4">Siswa</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Diverifikasi Oleh</th>
                    <th class="px-6 py-4">Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800/60">
                @foreach($historyContents as $h)
                    <tr class="hover:bg-gray-800/40">
                        <td class="px-6 py-4 font-semibold text-white">{{ $h->title }}</td>
                        <td class="px-6 py-4">{{ $h->submitter->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $h->status === 'approved' ? 'bg-emerald-950 text-emerald-300 border border-emerald-800' : 'bg-red-950 text-red-300 border border-red-800' }}">
                                {{ strtoupper($h->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $h->approver->name ?? 'Sistem' }}</td>
                        <td class="px-6 py-4 text-xs text-gray-400">{{ $h->updated_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
