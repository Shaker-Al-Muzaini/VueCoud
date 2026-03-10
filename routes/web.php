<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProgressController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\Auth\SocialController;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});
Route::resource('posts', PostController::class);

// Progress routes

Route::post('/start', [ProgressController::class, 'start']);
Route::get('/progress', [ProgressController::class, 'progress']);
Route::get('/recommendations', [ProgressController::class, 'showRecommendations'])
    ->name('recommendations');




Route::get('login/{provider}', [SocialController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
require __DIR__.'/settings.php';


