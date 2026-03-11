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
Route::resource('admin', PostController::class);

// Progress routes


Route::get('/cash-draw', [ProgressController::class, 'index']);
Route::get('/product_draws', [ProgressController::class, 'index2']);
Route::get('/winners', [ProgressController::class, 'index3']);
Route::get('/fAQs', [ProgressController::class, 'index4']);
Route::get('/contact', [ProgressController::class, 'index5']);




Route::get('login/{provider}', [SocialController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
require __DIR__.'/settings.php';


