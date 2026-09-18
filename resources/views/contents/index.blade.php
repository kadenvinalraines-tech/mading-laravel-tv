@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-black text-blue-950">Daftar Konten Mading</h2>
        <p class="text-xs text-slate-500">Kelola dan pantau status publikasi materi mading</p>
    </div>
    <a href="{{ route('contents.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm shadow-md transition flex items-center space-x-2">
        <span>➕</span><span>Unggah Konten</span>
    </a>
</div>
<div class="bg-white rounded-2xl overflow-hidden border border-blue-100 shadow-md">
    <table class="w-full text-left text-sm">
        <thead class="bg-blue-50 border-b border-blue-100 text-xs font-bold text-blue-900 uppercase">
            <tr>
                <th class="p-4">Judul</th>
                <th class="p-4">Tipe Media</th>
                <th class="p-4">Status</th>
                <th class="p-4">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($contents as $c)
            <tr class="hover:bg-slate-50/80 transition">
                <td class="p-4 font-bold text-slate-800">{{ $c->title }}</td>
                <td class="p-4">
                    <span class="px-2.5 py-1 bg-slate-100 text-slate-700 rounded-md text-xs font-semibold uppercase border border-slate-200">{{ $c->media_type }}</span>
                </td>
                <td class="p-4 text-xs font-bold">
                    @if($c->status === 'approved')
                        <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full">Approved</span>
                    @elseif($c->status === 'rejected')
                        <span class="px-2.5 py-1 bg-rose-50 text-rose-700 border border-rose-200 rounded-full">Rejected</span>
                    @else
                        <span class="px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-full">Pending</span>
                    @endif
                </td>
                <td class="p-4">
                    <form action="{{ route('contents.destroy', $c->id) }}" method="POST">@csrf @method('DELETE')
                        <button class="text-rose-600 hover:text-rose-800 text-xs font-bold hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-12 text-center text-slate-400">Belum ada konten mading yang diunggah.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
