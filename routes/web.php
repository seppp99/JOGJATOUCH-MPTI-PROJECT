<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');
Route::post('/layanan/pemasangan-wifi/order', [LayananController::class, 'storeWifiOrder'])->name('layanan.wifi.order')->middleware('auth');
Route::post('/layanan/network-analyst/order', [LayananController::class, 'storeNetworkOrder'])->name('layanan.network.order')->middleware('auth');
Route::post('/layanan/perawatan-rutin/order', [LayananController::class, 'storePerawatanOrder'])->name('layanan.perawatan.order')->middleware('auth');
Route::post('/layanan/desain-grafis/order', [LayananController::class, 'storeDesainOrder'])->name('layanan.desain.order')->middleware('auth');
Route::post('/layanan/{slug}/order', [LayananController::class, 'store'])->name('layanan.store');

// Account and Auth Routes
Route::get('/daftar', [AuthController::class, 'registerPage'])->name('daftar');
Route::post('/register/send-otp', [AuthController::class, 'sendOtpRegister'])->name('register.send-otp');
Route::get('/register/verifikasi', [AuthController::class, 'verifyPage'])->name('register.verifikasi');
Route::post('/register/verify-otp', [AuthController::class, 'verifyOtpRegister'])->name('register.verify-otp');

Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login/submit', [AuthController::class, 'loginSubmit'])->name('login.submit');

Route::get('/lupa-password', [App\Http\Controllers\PasswordResetController::class, 'showForm'])->name('lupa-password');
Route::post('/lupa-password/send-otp', [App\Http\Controllers\PasswordResetController::class, 'sendOtp'])->name('lupa-password.send-otp');
Route::get('/lupa-password/verifikasi', [App\Http\Controllers\PasswordResetController::class, 'verifyPage'])->name('lupa-password.verifikasi');
Route::post('/lupa-password/verify-otp', [App\Http\Controllers\PasswordResetController::class, 'verifyOtp'])->name('lupa-password.verify-otp');
Route::get('/lupa-password/baru', [App\Http\Controllers\PasswordResetController::class, 'newPassPage'])->name('lupa-password.baru');
Route::post('/lupa-password/reset', [App\Http\Controllers\PasswordResetController::class, 'reset'])->name('lupa-password.reset');

Route::get('/akun', function () {
    return view('pages.akun');
})->middleware('auth')->name('akun');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


