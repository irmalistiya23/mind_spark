<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [BlogController::class, 'home'])->name('home');
Route::get('/account', [BlogController::class, 'account'])->name('account');
Route::get('/favorite', [BlogController::class, 'favorite'])->name('favorite');
Route::get('/chatcs', [BlogController::class, 'chatcs'])->name('chatcs');


?>