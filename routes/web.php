<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// // Route untuk menampilkan list film
// Route::get('/films', [FilmController::class, 'index']);

// // Route untuk menampilkan detail film
// Route::get('/films/{id}', [FilmController::class, 'show']);

// // Route untuk menampilkan film berdasarkan kategori
// Route::get('/kategori/{kategoriId}', [FilmController::class, 'byKategori']);

Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');
