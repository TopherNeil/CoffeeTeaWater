<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NotificationController;

Route::get('**', function () {
    return view('errors.404');
});

Route::middleware('guest')->group(function() {

    // Authentication
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Guest Home
    Route::get('/', [PostController::class, 'index'])->name('home');
});



Route::middleware('auth')->group(function() {
    
    // Home
    Route::get('/home', [PostController::class, 'index'])->name('home');
    // Route::get('/home/#{post_id}', [PostController::class, 'index']);
    
    // Post
    Route::get('/post', [PostController::class, 'create'])->name('post');
    Route::get('/post/{id}', [PostController::class, 'show']);
    Route::get('/post/edit/{id}', [PostController::class, 'edit']);
    Route::put('/post/edit/{id}', [PostController::class, 'update']);
    Route::post('/post', [PostController::class, 'store']);
    Route::delete('/post/delete/{id}', [PostController::class, 'destroy']);

    // Search
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/@{username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Notification
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');

    // Comment
    Route::post('/comments/{post_id}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/comment/edit/{post_id}/{comment_id}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::put('/comment/update/{post_id}/{comment_id}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comment/{comment_id}', [CommentController::class, 'destroy'])->name('comment.destroy');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::get('/clear-session', function() {
    AuthController::clearMessage();
    return redirect()->back();
});

