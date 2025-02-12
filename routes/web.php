<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageController;
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

// Route Autentikasi
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Route Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Route Kategori dan Buku
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/buku/{id}', [BukuController::class, 'show'])->name('buku.show');

// Route Ulasan
Route::middleware(['auth'])->group(function () {
    Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
});

//Route Manage User oleh Admin
Route::prefix('manage')->group(function () {
    Route::get('/', [ManageController::class, 'index'])->name('manage');
    Route::get('/books/create', [ManageController::class, 'create'])->name('manage.books.create');
    Route::post('/books', [ManageController::class, 'store'])->name('manage.books.store');
    Route::get('/books/{id}/edit', [ManageController::class, 'edit'])->name('manage.books.edit');
    Route::put('/books/{id}', [ManageController::class, 'update'])->name('manage.books.update');
    Route::delete('/users/{id}', [ManageController::class, 'destroy'])->name('manage.destroy');
    Route::delete('/books/{id}', [ManageController::class, 'destroyBook'])->name('manage.books.destroy');
});

?>