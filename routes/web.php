<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RideController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('home');
});

// Show login form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Handle login form submission
Route::post('/login', [LoginController::class, 'login']);
// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// routes/web.php

// Show registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Handle registration form submission
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');


// Route::auth();
Route::resource('rides', RideController::class);
// Custom route for home page
Route::get('/home', [HomeController::class, 'index'])->name('home');
// Custom route for profile page
Route::get('/profile', 'ProfileController@index')->name('profile');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// Profile routes
Route::get('/profile/edit', [DashboardController::class, 'showProfileForm'])->name('profile.edit');
Route::post('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');


