<?php
namespace App\Features\RunningText\Controllers;
use App\Models\RunningText;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

// ponytail: sequential active marquee list; add schedule timestamps when emergency alert overrides are needed.
class RunningTextController extends Controller {
    public function index() {
        $texts = RunningText::with('creator')->orderBy('created_at', 'desc')->get();
        $schoolName = Setting::get('school_name', 'SMK Komputer Indonesia');
        $schoolTagline = Setting::get('school_tagline', 'Informasi & Karya Siswa Terpadu');
        return view('running_text.index', compact('texts', 'schoolName', 'schoolTagline'));
    }
    public function store(Request $request) {
        $request->validate(['text' => 'required|string|max:500']);
        RunningText::create(['text' => $request->text, 'is_active' => true, 'created_by' => Auth::id()]);
        return back()->with('success', 'Running text ditambahkan.');
    }
    public function toggle($id) {
        $rt = RunningText::findOrFail($id);
        $rt->is_active = !$rt->is_active;
        $rt->save();
        return back()->with('success', 'Status running text diubah.');
    }
    public function destroy($id) {
        RunningText::findOrFail($id)->delete();
        return back()->with('success', 'Running text dihapus.');
    }
    public function updateProfile(Request $request) {
        $val = $request->validate([
            'school_name' => 'required|string|max:100',
            'school_tagline' => 'nullable|string|max:200',
            'school_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048'
        ]);
        Setting::set('school_name', $val['school_name']);
        if (isset($val['school_tagline'])) {
            Setting::set('school_tagline', $val['school_tagline']);
        }
        if ($request->hasFile('school_logo')) {
            $path = $request->file('school_logo')->store('mading_assets', 'public');
            Setting::set('school_logo', '/storage/' . $path);
        }
        return back()->with('success', 'Profil mading disimpan.');
    }
}
