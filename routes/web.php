<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NasabahAktifController;

Route::get('/login', function () {
    return view('auth.login');
});


Route::middleware( 'auth')->group(function (){
    Route::get('/dash',[PagesController::class,'Dashboard'])->name('dash');
    Route::get('/ManageLunas',[PagesController::class,'ManageLunas'])->name('NasabahLunas');
    Route::get('/ManageMusnh',[PagesController::class,'ManageMusnah'])->name('NasabahMusnah');
    Route::get('/PinjamDokumen',[PagesController::class,'PinjamDokumen'])->name('PinjamDokumen');
});


// =======================================================Manage Dokumen Aktif=======================================
Route::middleware('auth')->group(function () {
    Route::get('/ManageAktif', [PagesController::class, 'ManageAktif'])->name('NasabahAktif');
    Route::post('/ManageAktif/store', [NasabahAktifController::class, 'store'])->name('NasabahAktif.store');
    Route::get('/ManageAktif/{id}/edit', [NasabahAktifController::class, 'edit'])->name('nasabah.edit');
    Route::put('/ManageAktif/{id}', [NasabahAktifController::class, 'update'])->name('nasabah.update');
    Route::delete('/ManageAktif/{id}', [NasabahAktifController::class, 'destroy'])->name('nasabah.destroy');
    Route::get('/ManageAktif/{id}', [NasabahAktifController::class, 'show'])->name('nasabah.show');
});
// =====================================================================================================================
Route::get('/dashboard', function () {
    return view('layouts.base');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
