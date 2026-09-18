<?php

namespace App\Features\RunningText\Controllers;

// ponytail: running text uses simple boolean flag and created_at sorting; add scheduling timestamps and priority weights when announcement queues become congested.

use App\Models\RunningText;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class RunningTextController extends Controller
{
    public function index()
    {
        $texts = RunningText::with('creator')->orderBy('created_at', 'desc')->get();
        $schoolName = Setting::get('school_name', 'SMK Komputer Indonesia');
        $schoolTagline = Setting::get('school_tagline', 'Mading Digital & Informasi Terpadu');
        return view('running_text.index', compact('texts', 'schoolName', 'schoolTagline'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:500',
        ]);

        RunningText::create([
            'text' => $request->text,
            'is_active' => true,
            'created_by' => Auth::id(),
        ]);

        return back()->with('success', 'Pengumuman teks berjalan berhasil ditambahkan!');
    }

    public function toggle($id)
    {
        $rt = RunningText::findOrFail($id);
        $rt->is_active = !$rt->is_active;
        $rt->save();

        return back()->with('success', 'Status teks berjalan diperbarui.');
    }

    public function destroy($id)
    {
        RunningText::findOrFail($id)->delete();
        return back()->with('success', 'Teks berjalan berhasil dihapus.');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:100',
            'school_tagline' => 'required|string|max:200',
            'school_logo' => 'nullable|image|max:4096',
        ]);

        Setting::set('school_name', $request->school_name);
        Setting::set('school_tagline', $request->school_tagline);

        if ($request->hasFile('school_logo')) {
            $path = $request->file('school_logo')->store('mading_assets', 'public');
            Setting::set('school_logo', '/storage/' . $path);
        }

        return back()->with('success', 'Pengaturan profil sekolah mading berhasil disimpan!');
    }
}
