<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroomingController;
use App\Http\Controllers\PethotelController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk menampilkan produk groomingg
Route::get('/grooming', [GroomingController::class, 'index'])->name('grooming.index');
// Route untuk menampilkan formulir tambah layanan grooming
Route::get('/grooming/create', [GroomingController::class, 'create'])->name('grooming.create');
Route::post('/grooming/store', [GroomingController::class, 'store'])->name('grooming.store');

//PETHOTEL
Route::resource('pethotel', PethotelController::class);
// Route untuk menampilkan halaman daftar produk
Route::get('/pethotels', [PethotelController::class, 'index'])->name('pethotels.index');

// Route untuk menampilkan form tambah produk
Route::get('/pethotels/create', [PethotelController::class, 'create'])->name('pethotels.create');

// Route untuk menyimpan produk baru dari form tambah
Route::post('/pethotels', [PethotelController::class, 'store'])->name('pethotels.store');

// Route untuk menampilkan detail produk
Route::get('/pethotels/{id}', [PethotelController::class, 'show'])->name('pethotels.show');

// Route untuk menampilkan form edit produk
Route::get('/pethotels/{id}/edit', [PethotelController::class, 'edit'])->name('pethotels.edit');

// Route untuk menyimpan perubahan pada produk dari form edit
Route::put('/pethotels/{id}', [PethotelController::class, 'update'])->name('pethotels.update');

// Route untuk menghapus produk
Route::delete('/pethotels/{id}', [PethotelController::class, 'destroy'])->name('pethotels.destroy');


Route::get('/papa','PethotelController@index');
