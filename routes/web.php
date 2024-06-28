<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KategoriPropertiController;
use App\Http\Controllers\PropertiController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserController;
use App\Models\FotoProperti;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'index'])->name('landing');
Route::get('/perumahan/{id}', [UserController::class, 'perumahan'])->name('perumahan');
Route::get('/detail/{id}', [UserController::class, 'detail'])->name('detail');
Route::get('/pembayaran/{id}', [UserController::class, 'pembayaran'])->name('pembayaran');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'auth'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.register');
});

Route::middleware(['web:admin,user'])->prefix('dashboard')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/checkout/{id}', [BookingController::class, 'store'])->name('checkout.store');
    Route::post('/checkout/update/{id}', [PembayaranController::class, 'update'])->name('checkout.update');
});

Route::middleware(['web:admin'])->prefix('dashboard')->group(function () {
    Route::get('/', [ViewController::class, 'dashboard'])->name('dashboard');
    Route::get('/riwayat', [BookingController::class, 'index'])->name('dashbord.riwayat');
    Route::get('/pembayaran', [PembayaranController::class, 'index_admin'])->name('dashbord.pembayaran');
    Route::post('/pembayaran/{id}', [PembayaranController::class, 'update_status'])->name('dashbord.update_status');
    Route::get('/akun-user', [UserController::class, 'index'])->name('user.index');
    Route::resource('/kategori', KategoriPropertiController::class);
    Route::resource('/properti', PropertiController::class);
    Route::get('/detail', [BookingController::class, 'detail'])->name('dashboard.detail');
    Route::get('/properti/{id}/set-banner', [PropertiController::class, 'set_banner'])->name('kategori.set_banner');
});

Route::middleware(['web:user'])->group(function () {
    Route::get('/akun', [UserController::class, 'akun'])->name('akun');
    Route::get('/checkout/{id}', [UserController::class, 'checkout'])->name('booking');
    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('riwayat');
    Route::get('/detail-booking/{id}', [UserController::class, 'detail_booking'])->name('detail_booking');
    Route::get('/booking/{id}', [UserController::class, 'booking'])->name('checkout');
});

