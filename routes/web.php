<?php

use App\Http\Controllers\CallbackController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\HomeController;
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

Route::get('/reservasi', [ReservasiController::class, 'reservasi']);
Route::get('/cari', [ReservasiController::class, 'search']);
Route::post('/booking', [ReservasiController::class, 'booking']);
Route::get('/order', [ReservasiController::class, 'order']);
Route::get('/gallery', [GaleriController::class, 'index']);

Auth::routes();

Route::get('admin/home', [HomeController::class, 'index'])->name('admin.home')->middleware('is_admin');
