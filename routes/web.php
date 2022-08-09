<?php

use App\Http\Controllers\CallbackController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GedungController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ReservasiController::class, 'index'])->name('home');

//route biasa
Route::get('/reservasi', [ReservasiController::class, 'reservasi']);
Route::get('/cari', [ReservasiController::class, 'search']);
Route::post('/booking', [ReservasiController::class, 'booking']);
Route::get('/order', [ReservasiController::class, 'order']);
Route::get('/gallery', [GaleriController::class, 'index']);

//route login, gatau jangan diubah
Auth::routes();

//route admin lur
Route::middleware(['is_admin','auth'])->group(function() {
    Route::prefix('admin')->group(function() {
        Route::get('home', [HomeController::class, 'index'])->name('admin.home');
        Route::resource('gedung', GedungController::class);
    });
});