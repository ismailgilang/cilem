<?php

use App\Http\Controllers\NasabahController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Harga;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('perhitungan', PerhitunganController::class);
    Route::post('upload/perhitungan', [PerhitunganController::class, 'upload'])->name('upload.perhitungan');
    Route::get('/perhitungan/pdf/{id}', [perhitunganController::class, 'cetak'])->name('cetak.persetujuan');
    Route::resource('nasabah', NasabahController::class);
    Route::resource('user', UserController::class);
});

require __DIR__ . '/auth.php';
