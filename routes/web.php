<?php
use Illuminate\Support\Facades\Route;
use App\Features\DisplayTv\Controllers\DisplayTvController;
use App\Features\Auth\Controllers\AuthController;
use App\Features\ContentSubmission\Controllers\ContentController;
use App\Features\Moderation\Controllers\ModerationController;
use App\Features\RunningText\Controllers\RunningTextController;

Route::get('/', [DisplayTvController::class, 'index'])->name('display.tv');
Route::get('/api/mading/feed', [DisplayTvController::class, 'apiFeed'])->name('api.mading.feed');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ContentController::class, 'index'])->name('dashboard');
    Route::get('/contents', [ContentController::class, 'index'])->name('contents.index');
    Route::get('/contents/create', [ContentController::class, 'create'])->name('contents.create');
    Route::post('/contents', [ContentController::class, 'store'])->name('contents.store');
    Route::delete('/contents/{id}', [ContentController::class, 'destroy'])->name('contents.destroy');

    Route::middleware('role:admin,guru')->group(function () {
        Route::get('/moderation', [ModerationController::class, 'index'])->name('moderation.index');
        Route::post('/moderation/{id}/approve', [ModerationController::class, 'approve'])->name('moderation.approve');
        Route::post('/moderation/{id}/reject', [ModerationController::class, 'reject'])->name('moderation.reject');

        Route::get('/running-texts', [RunningTextController::class, 'index'])->name('running_texts.index');
        Route::post('/running-texts', [RunningTextController::class, 'store'])->name('running_texts.store');
        Route::post('/running-texts/{id}/toggle', [RunningTextController::class, 'toggle'])->name('running_texts.toggle');
        Route::delete('/running-texts/{id}', [RunningTextController::class, 'destroy'])->name('running_texts.destroy');
        Route::post('/profile-settings', [RunningTextController::class, 'updateProfile'])->name('settings.updateProfile');
    });
});
