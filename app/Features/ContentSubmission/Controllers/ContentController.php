<?php
namespace App\Features\ContentSubmission\Controllers;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

// ponytail: local disk storage for uploaded media; add AWS S3 and queue job when large 4K videos are uploaded.
class ContentController extends Controller {
    public function index() {
        $user = Auth::user();
        $contents = Content::when($user->isSiswa(), fn($q) => $q->where('submitted_by', $user->id))
            ->orderBy('created_at', 'desc')->paginate(10);
        return view('contents.index', compact('contents'));
    }
    public function create() { return view('contents.create'); }
    public function store(Request $request) {
        $val = $request->validate([
            'title' => 'required|string|max:200',
            'media_type' => 'required|in:image,video,youtube,pdf,audio',
            'media_url' => 'nullable|string',
            'media_file' => 'nullable|file|max:51200',
            'duration_seconds' => 'required|integer|min:5|max:300',
            'notes' => 'nullable|string',
        ]);
        $user = Auth::user();
        $mediaUrl = $val['media_url'] ?? '';
        if ($request->hasFile('media_file')) {
            $path = $request->file('media_file')->store('mading_uploads', 'public');
            $mediaUrl = '/storage/' . $path;
        }

        // Siswa pending, Guru/Admin langsung approved
        $status = $user->isSiswa() ? 'pending' : 'approved';
        $approvedBy = $user->isSiswa() ? null : $user->id;

        Content::create([
            'title' => $val['title'],
            'media_type' => $val['media_type'],
            'media_url' => $mediaUrl,
            'duration_seconds' => $val['duration_seconds'],
            'status' => $status,
            'notes' => $val['notes'] ?? null,
            'submitted_by' => $user->id,
            'approved_by' => $approvedBy,
        ]);
        return redirect()->route('contents.index')->with('success', 'Konten berhasil disimpan.');
    }
    public function destroy($id) {
        $content = Content::findOrFail($id);
        if (Auth::user()->isSiswa() && $content->submitted_by !== Auth::id()) { abort(403); }
        $content->delete();
        return back()->with('success', 'Konten dihapus.');
    }
}
