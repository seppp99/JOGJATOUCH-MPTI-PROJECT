<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');
Route::post('/layanan/{slug}/order', [LayananController::class, 'store'])->name('layanan.store');

// Account and Auth Routes
Route::get('/daftar', [AuthController::class, 'registerPage'])->name('daftar');
Route::post('/register/send-otp', [AuthController::class, 'sendOtpRegister'])->name('register.send-otp');
Route::post('/register/verify-otp', [AuthController::class, 'verifyOtpRegister'])->name('register.verify-otp');

// Backwards-compatible aliases for existing login modal (some views still call these names)
Route::post('/login/send-otp', [AuthController::class, 'sendOtpRegister'])->name('login.send-otp');
Route::post('/login/verify-otp', [AuthController::class, 'verifyOtpRegister'])->name('login.verify-otp');

Route::get('/akun', function () {
    if (!session()->has('user')) {
        return redirect()->route('daftar')->with('error', 'Silakan login terlebih dahulu.');
    }
    return view('pages.akun');
})->name('akun');

Route::get('/logout', function () {
    session()->forget('user');
    return redirect('/');
})->name('logout');




