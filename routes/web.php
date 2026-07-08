<?php

use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $links = Link::where('user_id', Auth::user()->id)->get();
    return view('dashboard', compact('links'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/links', [LinkController::class, 'store'])->name('links.store');
    Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');

    Route::post('/profile/experiences', [ProfileController::class, 'storeExperience'])->name('experiences.store');
    Route::delete('/profile/experiences/{experience}', [ProfileController::class, 'destroyExperience'])->name('experiences.destroy');

    Route::post('/profile/skills', [ProfileController::class, 'storeSkill'])->name('skills.store');
    Route::delete('/profile/skills/{skill}', [ProfileController::class, 'destroySkill'])->name('skills.destroy');

    Route::post('/profile/portfolios', [ProfileController::class, 'storePortfolio'])->name('portfolios.store');
    Route::delete('/profile/portfolios/{portfolio}', [ProfileController::class, 'destroyPortfolio'])->name('portfolios.destroy');

    Route::post('/profile/testimonials', [ProfileController::class, 'storeTestimonial'])->name('testimonials.store');
    Route::delete('/profile/testimonials/{testimonial}', [ProfileController::class, 'destroyTestimonial'])->name('testimonials.destroy');

    Route::post('/profile/services', [ProfileController::class, 'storeService'])->name('services.store');
    Route::delete('/profile/services/{service}', [ProfileController::class, 'destroyService'])->name('services.destroy');

    Route::post('/profile/clients', [ProfileController::class, 'storeClient'])->name('clients.store');
    Route::delete('/profile/clients/{client}', [ProfileController::class, 'destroyClient'])->name('clients.destroy');

    Route::put('/profile/resume', [ProfileController::class, 'updateResume'])->name('resume.update');
    Route::put('/profile/resume-title', [ProfileController::class, 'updateResumeTitle'])->name('resume.update_title');
    Route::delete('/profile/resume', [ProfileController::class, 'destroyResume'])->name('resume.destroy');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});

Route::get('/p/{token}', [ProfileController::class, 'showPublicProfile'])->name('public.profile');
Route::post('/p/{token}/message', [MessageController::class, 'storePublicMessage'])->name('messages.public.store');

Route::view('/scan', 'scan')->name('qr.scanner');

require __DIR__.'/auth.php';