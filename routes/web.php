<?php

use App\Http\Controllers\CallbackController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GedungController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\ReservasiController as AdminReservasiController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\RekeningController as AdminRekeningController;
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
Route::get('reservasi', [ReservasiController::class, 'reservasi']);
Route::get('cari', [ReservasiController::class, 'search']);
Route::post('booking', [ReservasiController::class, 'booking']);
Route::get('order', [ReservasiController::class, 'order']);
Route::get('gallery', [GaleriController::class, 'index']);
Route::post('booking/cancel', [ReservasiController::class, 'cancel'])->name('cancel');
Route::post('booking/payment', [ReservasiController::class, 'payment'])->name('payment');
Route::post('booking/proof', [ReservasiController::class, 'proof'])->name('proof');
Route::get('syarat-ketentuan', [SiteController::class, 'syaratUser']);
Route::get('about', [SiteController::class, 'aboutUser']);
Route::get('jadwal', [ReservasiController::class, 'cekGedungTersedia']);

//route login, gatau jangan diubah
// Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Route::auth();
});

//route admin lur
Route::middleware(['is_admin', 'auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('admin.index');
        Route::get('home', [HomeController::class, 'index'])->name('admin.home');
        Route::resource('gedung', GedungController::class);
        Route::resource('user', UserController::class);
        Route::resource('reservasi', AdminReservasiController::class);
        Route::post('reservasi/{reservasi}/proses', AdminReservasiController::class . '@proses')->name('reservasi.proses');
        Route::resource('galeri', AdminGaleriController::class);
        Route::resource('bank', BankController::class);
        Route::resource('rekening', AdminRekeningController::class);

        Route::get('website', [SiteController::class, 'index'])->name('admin.website');
        Route::patch('website/{site}', [SiteController::class, 'update'])->name('admin.website.update');
        Route::get('syarat-ketentuan', [SiteController::class, 'syarat'])->name('sk.website');
        Route::patch('syarat-ketentuan/{site}', [SiteController::class, 'syaratUpdate'])->name('sk.website.update');
    });
});
