<?php

namespace App\Features\Moderation\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ModerationController extends Controller
{
    public function index()
    {
        $pendingContents = Content::with('submitter')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();

        $historyContents = Content::with(['submitter', 'approver'])
            ->whereIn('status', ['approved', 'rejected'])
            ->orderBy('updated_at', 'desc')
            ->take(20)
            ->get();

        return view('moderation.index', compact('pendingContents', 'historyContents'));
    }

    public function approve($id)
    {
        $content = Content::findOrFail($id);
        $content->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', "Konten '{$content->title}' telah disetujui untuk tayang di Mading TV!");
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['notes' => 'nullable|string']);
        $content = Content::findOrFail($id);
        $content->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'notes' => $request->notes,
        ]);

        return back()->with('warning', "Konten '{$content->title}' ditolak.");
    }
}
