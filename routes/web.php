<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/layanan/{slug}', [LayananController::class, 'show'])->name('layanan.show');
Route::post('/layanan/{slug}/order', [LayananController::class, 'store'])->name('layanan.store');

