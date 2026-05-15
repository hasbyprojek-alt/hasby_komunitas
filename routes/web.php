<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Redirect ke halaman utama
Route::get('/', function () {
    return redirect()->route('posts.index');
});

// Auth Routes via Breeze (login, register, logout, dll)
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    // CRUD Diskusi
    Route::resource('posts', PostController::class);

    // Like Post
    Route::post('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
});

// Route Home setelah login
Route::get('/home', function () {
    return redirect()->route('posts.index');
})->name('home');