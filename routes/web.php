<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroomingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ConfirmPasswordController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [HomeController::class, 'index'])->name('home');


// Route untuk menampilkan produk groomingg
Route::get('/grooming', [GroomingController::class, 'index'])->name('grooming.index');
// Route untuk menampilkan formulir tambah layanan grooming
Route::get('/grooming/create', [GroomingController::class, 'create'])->name('grooming.create');
Route::post('/grooming/store', [GroomingController::class, 'store'])->name('grooming.store');


// Rute untuk otentikasi
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
});

// Rute untuk registrasi dan login
Route::middleware('guest')->group(function () {
    Route::get('/register', [HomeController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [HomeController::class, 'register']);
    Route::get('/login', [HomeController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [HomeController::class, 'login']);
});

Auth::routes();


