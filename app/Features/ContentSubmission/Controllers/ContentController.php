<?php

namespace App\Features\ContentSubmission\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $contents = Content::when($user->isSiswa(), function ($q) use ($user) {
                return $q->where('submitted_by', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('contents.index', compact('contents'));
    }

    public function create()
    {
        return view('contents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'media_type' => 'required|in:image,video,youtube,pdf,audio',
            'media_url' => 'nullable|string',
            'media_file' => 'nullable|file|max:51200', // max 50MB
            'duration_seconds' => 'required|integer|min:5|max:300',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'notes' => 'nullable|string',
        ]);

        $user = Auth::user();
        $mediaUrl = $validated['media_url'] ?? '';

        if ($request->hasFile('media_file')) {
            $path = $request->file('media_file')->store('mading_uploads', 'public');
            $mediaUrl = '/storage/' . $path;
        }

        // Siswa butuh approve (status: pending). Guru & Admin langsung approved!
        $status = $user->isSiswa() ? 'pending' : 'approved';
        $approvedBy = $user->isSiswa() ? null : $user->id;

        Content::create([
            'title' => $validated['title'],
            'media_type' => $validated['media_type'],
            'media_url' => $mediaUrl,
            'duration_seconds' => $validated['duration_seconds'],
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'status' => $status,
            'notes' => $validated['notes'] ?? null,
            'submitted_by' => $user->id,
            'approved_by' => $approvedBy,
        ]);

        $msg = $user->isSiswa() 
            ? 'Karya mading berhasil dikirim! Menunggu persetujuan Guru Pembimbing.' 
            : 'Konten mading berhasil diterbitkan langsung ke Layar TV.';

        return redirect()->route('contents.index')->with('success', $msg);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $content = Content::findOrFail($id);

        if ($user->isSiswa() && $content->submitted_by !== $user->id) {
            abort(403);
        }

        $content->delete();
        return back()->with('success', 'Konten berhasil dihapus.');
    }
}
