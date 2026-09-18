@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold">Daftar Konten Mading</h2>
    <a href="{{ route('contents.create') }}" class="px-4 py-2 bg-blue-600 rounded font-bold text-sm">Unggah Konten</a>
</div>
<div class="bg-gray-900 rounded-xl overflow-hidden border border-gray-800">
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-950 border-b border-gray-800 text-xs text-gray-400 uppercase"><tr><th class="p-4">Judul</th><th class="p-4">Tipe</th><th class="p-4">Status</th><th class="p-4">Aksi</th></tr></thead>
        <tbody>
            @forelse($contents as $c)
            <tr class="border-b border-gray-800/40">
                <td class="p-4 font-bold">{{ $c->title }}</td>
                <td class="p-4 uppercase text-xs">{{ $c->media_type }}</td>
                <td class="p-4 text-xs font-bold {{ $c->status === 'approved' ? 'text-emerald-400' : ($c->status === 'rejected' ? 'text-rose-400' : 'text-amber-400') }}">{{ $c->status }}</td>
                <td class="p-4"><form action="{{ route('contents.destroy', $c->id) }}" method="POST">@csrf @method('DELETE')<button class="text-red-400 text-xs font-bold hover:underline">Hapus</button></form></td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-8 text-center text-gray-500">Belum ada konten mading yang diunggah.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
