<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Routes
    Route::resources([
        'gallery' => GalleryController::class,
        'informasi' => InformasiController::class,
        'agenda' => AgendaController::class,
        'foto' => FotoController::class,
    ]);
});

// Route publik untuk gallery
Route::get('/gallery', [FotoController::class, 'gallery'])->name('gallery');

// API route untuk informasi
Route::get('/api/informasi/{id}', [InformasiController::class, 'show']);

require __DIR__.'/auth.php';
