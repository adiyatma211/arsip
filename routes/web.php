<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NasabahAktifController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dash', [PagesController::class, 'Dashboard'])->name('dash');
    Route::get('/ManageLunas', [PagesController::class, 'ManageLunas'])->name('NasabahLunas');
    Route::get('/ManageMusnh', [PagesController::class, 'ManageMusnah'])->name('NasabahMusnah');
    Route::get('/PinjamDokumen', [PagesController::class, 'PinjamDokumen'])->name('PinjamDokumen');
});

// Routes untuk Manage Dokumen Aktif
Route::middleware('auth')->group(function () {
    // Halaman index dengan fitur pencarian dan pagination
    Route::get('/ManageAktif', [PagesController::class, 'ManageAktif'])->name('NasabahAktif');

    // Proses penyimpanan data
    Route::post('/ManageAktif/store', [NasabahAktifController::class, 'store'])->name('NasabahAktif.store');

    // Halaman detail, edit, update, dan delete
    Route::get('/ManageAktif/{id}', [NasabahAktifController::class, 'show'])->name('nasabah.show');
    Route::get('/ManageAktif/{id}/edit', [NasabahAktifController::class, 'edit'])->name('nasabah.edit');
    Route::put('/ManageAktif/{id}', [NasabahAktifController::class, 'update'])->name('nasabah.update');
    Route::delete('/ManageAktif/{id}', [NasabahAktifController::class, 'destroy'])->name('nasabah.destroy');
});

Auth::routes();
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
