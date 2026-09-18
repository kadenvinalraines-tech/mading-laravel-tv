<?php
// tests/runnable_test.php
// Autonomous runnable verification for Mading Laravel TV (No external test framework needed)

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Boot kernel
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Content;
use App\Models\RunningText;
use App\Models\Setting;
use App\Features\Auth\Controllers\AuthController;
use App\Features\ContentSubmission\Controllers\ContentController;
use App\Features\Moderation\Controllers\ModerationController;
use App\Features\RunningText\Controllers\RunningTextController;
use App\Features\DisplayTv\Controllers\DisplayTvController;

echo "\n=======================================================\n";
echo "🚀 RUNNING COMPREHENSIVE VIBE-CODING VERIFICATION TEST\n";
echo "=======================================================\n";

// 1. Reset Database & Seed
echo "[TEST 1/8] Running Database Migration & Seeding...\n";
Artisan::call('migrate:fresh --seed');
$admin = User::where('email', 'admin@smk.local')->first();
$guru = User::where('email', 'guru@smk.local')->first();
$siswa = User::where('email', 'siswa@smk.local')->first();

assert($admin && $admin->role === 'admin', "Admin user missing or role incorrect");
assert($guru && $guru->role === 'guru', "Guru user missing or role incorrect");
assert($siswa && $siswa->role === 'siswa', "Siswa user missing or role incorrect");
echo "  ✓ Database migrated and seeded with 3 roles (admin, guru, siswa)\n";

// 2. Test Auth Flow
echo "[TEST 2/8] Testing Authentication Logic...\n";
$authController = new AuthController();

// Valid login
$reqLogin = Request::create('/login', 'POST', ['email' => 'siswa@smk.local', 'password' => 'password123']);
$reqLogin->setLaravelSession($app['session']->driver());
$resLogin = $authController->login($reqLogin);
assert($resLogin->isRedirect(), "Login should redirect on success");
assert(Auth::check() && Auth::id() === $siswa->id, "Auth session should belong to siswa");

// Logout
$reqLogout = Request::create('/logout', 'POST');
$reqLogout->setLaravelSession($app['session']->driver());
$authController->logout($reqLogout);
assert(!Auth::check(), "User should be logged out");
echo "  ✓ Login & logout session lifecycle validated\n";

// 3. Test Content Submission (Siswa -> pending status)
echo "[TEST 3/8] Testing Content Submission by Siswa (Expect Pending)...\n";
Auth::login($siswa);
$contentController = new ContentController();

$reqSiswaSubmit = Request::create('/contents', 'POST', [
    'title' => 'Poster Pameran Teknologi Siswa',
    'media_type' => 'image',
    'media_url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475',
    'duration_seconds' => 20,
    'notes' => 'Karya tugas akhir kelas XI TKJ'
]);
$contentController->store($reqSiswaSubmit);

$siswaContent = Content::where('title', 'Poster Pameran Teknologi Siswa')->first();
assert($siswaContent !== null, "Siswa content was not created in DB");
assert($siswaContent->status === 'pending', "Siswa submission must have pending status");
assert($siswaContent->submitted_by === $siswa->id, "Submitter ID must match siswa");
assert($siswaContent->approved_by === null, "Approver must be null before moderation");
echo "  ✓ Siswa submission created with status=pending\n";

// 4. Test Content Submission (Guru -> auto-approved)
echo "[TEST 4/8] Testing Content Submission by Guru (Expect Auto-Approved)...\n";
Auth::login($guru);
$reqGuruSubmit = Request::create('/contents', 'POST', [
    'title' => 'Jadwal Ujian Tengah Semester Ganjil',
    'media_type' => 'pdf',
    'media_url' => 'https://example.com/jadwal-uts.pdf',
    'duration_seconds' => 30,
]);
$contentController->store($reqGuruSubmit);

$guruContent = Content::where('title', 'Jadwal Ujian Tengah Semester Ganjil')->first();
assert($guruContent !== null, "Guru content was not created");
assert($guruContent->status === 'approved', "Guru submission must be auto-approved");
assert($guruContent->approved_by === $guru->id, "Guru must be recorded as approver");
echo "  ✓ Guru submission auto-approved with status=approved\n";

// 5. Test Moderation Flow (Approve Siswa Content)
echo "[TEST 5/8] Testing Moderation Approval by Guru...\n";
$moderationController = new ModerationController();
$moderationController->approve($siswaContent->id);

$siswaContent->refresh();
assert($siswaContent->status === 'approved', "Content status must change to approved");
assert($siswaContent->approved_by === $guru->id, "Approver must be set to guru");
echo "  ✓ Pending submission successfully approved by guru\n";

// Test Moderation Reject
$reqRejectSubmit = Request::create('/contents', 'POST', [
    'title' => 'Konten Ditolak Contoh',
    'media_type' => 'image',
    'media_url' => 'https://example.com/rejected.jpg',
    'duration_seconds' => 15,
]);
Auth::login($siswa);
$contentController->store($reqRejectSubmit);
$rejectTarget = Content::where('title', 'Konten Ditolak Contoh')->first();

Auth::login($guru);
$reqReject = Request::create('/moderation/' . $rejectTarget->id . '/reject', 'POST', [
    'notes' => 'Format gambar kurang jelas, mohon unggah resolusi tinggi.'
]);
$moderationController->reject($reqReject, $rejectTarget->id);
$rejectTarget->refresh();
assert($rejectTarget->status === 'rejected', "Content status must be rejected");
assert($rejectTarget->notes === 'Format gambar kurang jelas, mohon unggah resolusi tinggi.', "Rejection note must be saved");
echo "  ✓ Rejection workflow verified with rejection notes\n";

// 6. Test Running Text Management
echo "[TEST 6/8] Testing Running Text CRUD & Toggle...\n";
$runningTextController = new RunningTextController();
$reqRT = Request::create('/running-texts', 'POST', [
    'text' => 'Peringatan: Seluruh siswa dilarang membawa ponsel saat ujian.'
]);
$runningTextController->store($reqRT);

$rt = RunningText::where('text', 'Peringatan: Seluruh siswa dilarang membawa ponsel saat ujian.')->first();
assert($rt !== null, "Running text should be created in DB");
assert($rt->is_active === true, "New running text should default to active");

// Toggle to inactive
$runningTextController->toggle($rt->id);
$rt->refresh();
assert($rt->is_active === false, "Running text should be toggled to inactive");

// Toggle back to active
$runningTextController->toggle($rt->id);
$rt->refresh();
assert($rt->is_active === true, "Running text should be toggled back to active");
echo "  ✓ Running text store & toggle active state verified\n";

// 7. Test Settings Management
echo "[TEST 7/8] Testing School Profile & TV Settings...\n";
$reqSettings = Request::create('/profile-settings', 'POST', [
    'school_name' => 'SMK Negeri 1 Digital Excellence',
    'school_tagline' => 'Pusat Keunggulan Teknologi Masa Depan'
]);
$runningTextController->updateProfile($reqSettings);
assert(Setting::get('school_name') === 'SMK Negeri 1 Digital Excellence', "School name setting update failed");
assert(Setting::get('school_tagline') === 'Pusat Keunggulan Teknologi Masa Depan', "School tagline setting update failed");
echo "  ✓ TV profile settings saved and retrievable\n";

// 8. Test Display TV Kiosk API Feed
echo "[TEST 8/8] Testing Display TV Kiosk Feed...\n";
$displayController = new DisplayTvController();
$feedResponse = $displayController->apiFeed();
$feedData = json_decode($feedResponse->getContent(), true);

assert(isset($feedData['sliders']) && count($feedData['sliders']) >= 2, "Kiosk feed must include approved sliders");
assert(isset($feedData['running_texts']) && count($feedData['running_texts']) >= 1, "Kiosk feed must include active running texts");

// Assert rejected and pending contents are EXCLUDED from TV display
foreach ($feedData['sliders'] as $slider) {
    assert($slider['status'] === 'approved', "Non-approved content leaked into TV kiosk feed!");
}
echo "  ✓ Kiosk feed verified: only approved slides and active running text shown\n";

echo "\n=======================================================\n";
echo "✅ ALL 8 BUSINESS & SECURITY ASSERTIONS PASSED (100%)\n";
echo "=======================================================\n";
