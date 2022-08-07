<?php

use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ReservasiController;
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

Route::get('/', [ReservasiController::class, 'index']);

Route::get('/reservasi', [ReservasiController::class, 'reservasi']);
Route::get('/cari', [ReservasiController::class, 'search']);
Route::get('/gallery', [GaleriController::class, 'index']);
