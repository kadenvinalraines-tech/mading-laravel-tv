@extends('layouts.app')

@section('title', 'Daftar Konten Mading')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-2xl font-black text-white">Konten Mading Digital</h1>
        <p class="text-sm text-gray-400">Kelola artikel, video, gambar, dan dokumen tayang TV</p>
    </div>
    <a href="{{ route('contents.create') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-blue-600 text-white font-bold text-sm hover:bg-blue-500 transition shadow-lg shadow-blue-600/30">
        ➕ Unggah Konten Baru
    </a>
</div>

<div class="bg-gray-900 border border-gray-800 rounded-3xl overflow-hidden shadow-xl">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-300">
            <thead class="bg-gray-950/60 border-b border-gray-800 text-xs font-bold text-gray-400 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">Judul & Media</th>
                    <th class="px-6 py-4">Tipe</th>
                    <th class="px-6 py-4">Durasi</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Tanggal Unggah</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800/60">
                @forelse($contents as $c)
                    <tr class="hover:bg-gray-800/40 transition">
                        <td class="px-6 py-4 font-semibold text-white">
                            {{ $c->title }}
                            @if($c->notes)
                                <div class="text-xs font-normal text-amber-400 mt-1">Catatan: {{ $c->notes }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-950 border border-blue-800 text-blue-300 uppercase">
                                {{ $c->media_type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-300">{{ $c->duration_seconds }} Detik</td>
                        <td class="px-6 py-4">
                            @if($c->status === 'approved')
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-950 text-emerald-300 border border-emerald-800">
                                    Tayang di TV
                                </span>
                            @elseif($c->status === 'pending')
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-950 text-amber-300 border border-amber-800">
                                    Menunggu Guru
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-red-950 text-red-300 border border-red-800">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-400">{{ $c->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('contents.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus konten ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-red-400 hover:text-red-300">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            Belum ada konten yang diunggah. Klik tombol "Unggah Konten Baru".
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($contents->hasPages())
        <div class="px-6 py-4 border-t border-gray-800">
            {{ $contents->links() }}
        </div>
    @endif
</div>
@endsection
