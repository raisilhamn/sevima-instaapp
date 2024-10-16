<?php

use App\Http\Controllers\DeleteTempController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TempUploaderController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->middleware(['auth'])->name(name: 'home');

Route::get('/profile', function () {
    return Inertia::render('Profile');
})->middleware(['auth'])->name('profile');

Route::get('/create-post', function () {
    return Inertia::render('CreatePost');
})->middleware(['auth'])->name('create.post');

Route::middleware(['auth'])->group(function () {
    Route::post('/create', [PostController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/upload', [TempUploaderController::class, '__invoke']);
    Route::delete('/revert/{folder}', [DeleteTempController::class, 'delete'])->name('revert');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
