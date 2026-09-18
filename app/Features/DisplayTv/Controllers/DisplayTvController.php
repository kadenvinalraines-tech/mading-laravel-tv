<?php
namespace App\Features\DisplayTv\Controllers;
use App\Models\Content;
use App\Models\RunningText;
use App\Models\Setting;
use Illuminate\Routing\Controller;

// ponytail: client-side interval timer for slide cycling; add WebSockets (Reverb) when instant remote control is required.
class DisplayTvController extends Controller {
    public function index() {
        $schoolName = Setting::get('school_name', 'Mading TV Digital SMK');
        $schoolTagline = Setting::get('school_tagline', 'Informasi & Karya Siswa Terpadu');
        $schoolLogo = Setting::get('school_logo', '/images/logo.png');

        $activeSliders = Content::where('status', 'approved')
            ->where(function ($q) { $q->whereNull('start_date')->orWhere('start_date', '<=', now()); })
            ->where(function ($q) { $q->whereNull('end_date')->orWhere('end_date', '>=', now()); })
            ->orderBy('created_at', 'desc')->get();

        $runningTexts = RunningText::where('is_active', true)->pluck('text')->toArray();
        return view('display_tv.index', compact('schoolName', 'schoolTagline', 'schoolLogo', 'activeSliders', 'runningTexts'));
    }

    public function apiFeed() {
        return response()->json([
            'sliders' => Content::where('status', 'approved')->get(),
            'running_texts' => RunningText::where('is_active', true)->pluck('text')
        ]);
    }
}
