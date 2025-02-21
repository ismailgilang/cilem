<?php

use App\Http\Controllers\CilemController;
use App\Http\Controllers\HargaController;
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

    Route::resource('harga', HargaController::class);
    Route::post('cetak/harga', [HargaController::class, 'cetak'])->name('cetak.harga');
    Route::resource('cilem', CilemController::class);
    Route::post('cetak/cilem', [CilemController::class, 'cetak'])->name('cetak.cilem');
    Route::resource('user', UserController::class);
});

require __DIR__ . '/auth.php';
