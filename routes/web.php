<?php

use App\Http\Controllers\DeleteTempController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TempUploaderController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->middleware(['auth'])->name('home');

Route::get('/profile', [ProfileController::class, 'view'])->middleware(['auth'])->name('profile');

Route::get('/create-post', function () {
    return Inertia::render('CreatePost');
})->middleware(['auth'])->name('create.post');

Route::middleware(['auth'])->group(function () {
    Route::post('/create', [PostController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
    Route::post('/upload', [TempUploaderController::class, '__invoke']);
    Route::post('/comment', action: [PostController::class, 'comment'])->name('comment');
    Route::delete('/revert/{folder}', [DeleteTempController::class, 'delete'])->name('revert');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
