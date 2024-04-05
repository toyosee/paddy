<?php

use App\Http\Controllers\FriendDashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConnectionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Default route
Route::view('/', 'home');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Home page route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Profile page route
Route::get('/profile', 'ProfileController@index')->name('profile');

// Dashboard routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/pending-friend-requests', [DashboardController::class, 'pendingFriendRequests'])->name('pending-friend-requests');

// Resourceful routes for rides
Route::resource('rides', RideController::class);

// Resourceful routes for posts
Route::resource('posts', PostController::class);
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Nested routes for comments
Route::post('/posts/{post}/comments', [PostController::class, 'addComment'])->name('comments.add');
Route::put('/comments/{comment}', [PostController::class, 'editComment'])->name('comments.edit');
Route::delete('/comments/{comment}', [PostController::class, 'deleteComment'])->name('comments.delete');

// Profile routes
Route::get('/profile/edit', [DashboardController::class, 'showProfileForm'])->name('profile.edit');
Route::post('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
// friend dashboard
// routes/web.php
Route::get('/friend-dashboard/{userId}', [FriendDashboardController::class, 'show'])->name('friend.dashboard');


// Friend requests
Route::post('/friend-requests/send', [FriendRequestController::class, 'send'])->name('friend-requests.send');
Route::put('/friend-requests/{friendRequest}/accept', [FriendRequestController::class, 'accept'])->name('friend-requests.accept');
Route::put('/friend-requests/{friendRequest}/reject', [FriendRequestController::class, 'reject'])->name('friend-requests.reject');
Route::get('/friends', [ConnectionController::class, 'listFriends'])->name('friends.index');
// Route::put('/friend-requests/{id}/accept', [FriendRequestController::class, 'accept'])->name('friend-requests.accept');
// Route::put('/friend-requests/{id}/reject', [FriendRequestController::class, 'reject'])->name('friend-requests.reject');

// Connections
Route::post('/connections/make', [ConnectionController::class, 'send'])->name('connections.make');
Route::put('/connections/{connection}/accept', [ConnectionController::class, 'accept'])->name('connections.accept');
Route::put('/connections/{connection}/reject', [ConnectionController::class, 'reject'])->name('connections.reject');
Route::delete('/connections/{connection}/cancel', [ConnectionController::class, 'cancel'])->name('connections.cancel');

// Manage search
Route::get('/users/search', [DashboardController::class, 'search'])->name('users.search');
// Route::post('/friend-requests/send/{user}', [FriendRequestController::class, 'send'])->name('friend-requests.send');

// user profile 
Route::get('/users/{user}', [DashboardController::class, 'profile'])->name('users.profile');

