<?php
namespace App\Features\Moderation\Controllers;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

// ponytail: single-tier approval workflow; add multi-role approval matrix when department heads review independently.
class ModerationController extends Controller {
    public function index() {
        $pendingContents = Content::with('submitter')->where('status', 'pending')->orderBy('created_at', 'asc')->get();
        return view('moderation.index', compact('pendingContents'));
    }
    public function approve($id) {
        Content::findOrFail($id)->update(['status' => 'approved', 'approved_by' => Auth::id()]);
        return back()->with('success', 'Konten disetujui tayang di TV.');
    }
    public function reject(Request $request, $id) {
        Content::findOrFail($id)->update(['status' => 'rejected', 'approved_by' => Auth::id(), 'notes' => $request->notes]);
        return back()->with('warning', 'Konten ditolak.');
    }
}
